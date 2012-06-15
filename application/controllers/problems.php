<?php
	class Problems extends CI_CONTROLLER {
		public function view() {
			$this->load->model('Problem_model');
			$this->load->model('Collection_model');
			$this->load->model('Generator_model');


			$this->load->view('templates/header');
			$data['problems'] = $this->Problem_model->get_problem()->result();

			$collections_data = array();
			foreach ($this->Collection_model->get_collection()->result() as $collection) {
				$collections_data[$collection->id] = $collection->name;
			}

			$generators_data = array();
			foreach ($this->Generator_model->get_generator()->result() as $generator) {
				$generators_data[$generator->id] = array($generator->name, $generator->collection_id);
			}

			$data['collections'] = $collections_data;
			$data['generators'] = $generators_data;
			$this->load->view('problems/view', $data);
			$this->load->view('templates/footer');
		}

		public function profile($problem_id) {
			$this->load->model('Problem_model');
			$this->load->model('Collection_model');
			$this->load->model('Generator_model');
			$this->load->model('Argument_model');
			$this->load->model('Resource_model');

			$problems = array_shift($this->Problem_model->get_problem('id', $problem_id)->result());
			$generators = array_shift($this->Generator_model->get_generator('id', $problems->generator_id)->result());
			$collections = array_shift($this->Collection_model->get_collection($generators->collection_id)->result());
			
			$arguments = array();
			foreach ($this->Argument_model->get_problem_argument('problem_id', $problem_id)->result() as $argument) {
				$gen_arg = array_shift($this->Argument_model->get_generator_argument('id', $argument->argument_id)->result());
				$arguments[$gen_arg->variable] = $argument->value;
			}

			$data['problems'] = $problems;
			$data['generators'] = $generators;
			$data['collections'] = $collections;
			$data['arguments'] = $arguments;
			$data['images'] = $this->Resource_model->get_resources_by_reference_id('image', 'problem', $problem_id)->result();

			if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/problems/' . $problems->identifier)) {
				$data['files'] = scandir($_SERVER['DOCUMENT_ROOT'] . '/problems/' . $problems->identifier);
			}

			$this->load->view('templates/header');
			$this->load->view('problems/profile', $data);
			$this->load->view('templates/footer');

		}

		public function download($identifier, $problem_id) {
			$this->load->helper('download');
			$data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/problems/' . $identifier . '/' . $identifier . "_" . $problem_id . ".txt");

			if ($data != "" && force_download($file_name, $data)) {
				force_download($file_name, $data);
			} else {
				print "This file is empty.";
			}
		}

		public function menu() {
			$this->load->view('templates/header');
			$this->load->view('problems/menu');
			$this->load->view('templates/footer');

		}

		public function delete($problem_id) {
			$this->load->model('Problem_model');
			$this->Problem_model->delete_problem($problem_id);
		}

		public function add($generator_id) {
			if ($this->ion_auth->logged_in()) {
				$this->load->model('Generator_model');
				$this->load->model('Problem_model');
				$this->load->model('Argument_model');
				$this->load->library('form_validation');

				$data['generator'] = array_shift($this->Generator_model->get_generator('id',$generator_id)->result());
				$arguments = $this->Argument_model->get_generator_argument('generator_id', $generator_id)->result();
				
				$data['generator_id'] = $generator_id;
				$data['arguments'] = $arguments;
				$this->form_validation->set_rules('generator_id', 'Generator', 'required');

				foreach ($arguments as $argument) {
					$validation_rules = '';
					if (!$argument->optional) {
						$validation_rules .= 'required|';
					}

					if ($argument->type == 'INTEGER') {
						$validation_rules .= 'integer';

					} else if ($argument->type == 'DECIMAL' || $argument->type == 'FLOAT') {
						$validation_rules .= 'decimal';

					} else if ($argument->type == 'STRING') {
						$validation_rules .= 'string';
					}

					$this->form_validation->set_rules($argument->id, $argument->name, $validation_rules);
				}

				if ($this->input->post('add_problem') && $this->form_validation->run()) {
					$this->load->helper('string');
					$new_problem = array(
						'identifier' => random_string('alnum', 6),
						'generator_id' => $this->input->post('generator_id'),
						'description' => $this->input->post('problem_description'),
						'user_id' => $this->ion_auth->user()->row()->id,
						'created_datetime' => time()
					);

					$problem = array_shift($this->Problem_model->add_problem($new_problem)->result());
					$script_args = array();

					foreach ($arguments as $argument) {
						$new_problem_arguments = array(
							'problem_id' => $problem->id,
							'argument_id' => $argument->id,
							'value' => $this->input->post($argument->id)
						);
						
						$script_args[$argument->variable] = $this->input->post($argument->id);

						$this->Argument_model->add_problem_argument($new_problem_arguments);
					}

					$run_generator = array_shift($this->Generator_model->get_generator('id', $this->input->post('generator_id'))->result());

					//@TODO: we need to run the generator, then store files, images, etc that are outputted.
					if ($this->generate_problem($run_generator, $problem->id, $script_args)) {
						$this->load->helper('url');
						redirect('/problems/profile/' . $problem->id);
					} else {
						error_log("ERROR MESSAGE!");
					}
				}

				$this->load->view('templates/header');
				$this->load->view('problems/add', $data);
				$this->load->view('templates/footer');
			} else {
				$this->load->helper('url');
				redirect('/users/login');
			}

		}

		private function generate_problem($generator, $problem_id, $args) {
			$arg_list = "";
			foreach($args as $name=>$value){
				$arg_list .=" -$name $value";
			}			

			$problem = array_shift($this->Problem_model->get_problem('id', $problem_id)->result());
			$problem_file_dir = $_SERVER['DOCUMENT_ROOT'] . "/problems/" . $problem->identifier . "/";
			$problem_file_name = $problem->identifier . "_" . $problem->id . ".txt";

			if(mkdir($problem_file_dir)) {

				$shell_command = "python $generator->script " . $arg_list ." > " . $problem_file_dir . $problem_file_name;
				error_log($shell_command);
				shell_exec($shell_command);
				
				$this->load->library('email');
				$user = $this->ion_auth->user()->row();

				$message = "Your problem has been generated. Please click <a href='" 
				. $_SERVER['SERVER_NAME'] . "/problems/profile/" 
				. $problem_id . "'>here</a> to view it, or <a href='" 
				. $_SERVER['SERVER_NAME'] . "/problems/download/" . $problem->identifier
				. "/" . $problem_id . "'>here</a> to download it.";

				$this->email->from('admin@localhost', 'TxTPS');
				$this->email->to($user->email);
				$this->email->subject("Your problem has been generated.");
				$this->email->message($message);

				if ($this->email->send()) {
					return true;
				} 

				echo $this->email->print_debugger();
				return false;
			} 			
				
			error_log("Could not run the generator...cannot mkdir");
			return false;
		}
		
		/** The images for files are generated...so we get rid of the add
		********
		public function add_images($problem_id) {
			$this->load->model('Resource_model');
			$data['problem_id'] = $problem_id;
			$data['images'] = $this->Resource_model->get_resources_by_reference_id('image','problem',$problem_id)->result();

			if ($this->input->post('add_image')) {
				$config['upload_path'] = getEnv('DOCUMENT_ROOT') . "/assets/image/resource/";
				$config['allowed_types'] = "jpg|png|gif";
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('problem_image')) {
					$file_data = $this->upload->data();
					if ($file_data['file_name']) {
						$new_image = array(
							'resource_type' => 'image',
							'reference_id' => $this->input->post('problem_id'),
							'reference_type' => 'problem',
							'name' => $file_data['file_name']
						);

						$this->Resource_model->add_resource($new_image);
						$this->load->helper('url');
						redirect('/problems/add_images/' . $problem_id);
					} else {
						$data['error'] = "ERROR: No file specified";
					}
				} else {
					$data['error'] = "ERROR: " . $this->upload->display_errors();
				}

			}
			$this->load->view('templates/header');
			$this->load->view('problems/add_images', $data);
			$this->load->view('templates/footer');
		}

		public function delete_image($image_id, $problem_id) {
			$this->load->model('Resource_model');
			$this->Resource_model->delete_resource($image_id);
			$this->load->helper('url');
			redirect('/problems/profile/' . $problem_id);
		}

		**/
		public function edit($problem_id) {
			$this->load->model('Problem_model');
			$problem = array_shift($this->Problem_model->get_problem('id', $problem_id)->result());

			if (($this->ion_auth->logged_in() && $problem->user_id == $this->ion_auth->user()->row()->id) || $this->ion_auth->is_admin()) {
				$this->load->model('Generator_model');
				$this->load->model('Argument_model');
				$this->load->library('form_validation');

				$data['generator'] = array_shift($this->Generator_model->get_generator('id', $problem->generator_id)->result());
				$data['problem'] = $problem;
				$problem_arguments = $this->Argument_model->get_problem_argument('problem_id', $problem_id)->result();

				$arguments = array();
				$problem_args = array();
				foreach ($problem_arguments as $problem_argument) {
					$arg = array_shift($this->Argument_model->get_generator_argument('id', $problem_argument->argument_id)->result());
					$problem_args[$problem_argument->argument_id] = $problem_argument->value;
					$arguments[] = $arg;

					$validation_rules = '';
					if (!$arg->optional) {
						$validation_rules .= 'required|';
					}

					if ($arg->type == 'INTEGER') {
						$validation_rules .= 'integer';

					} else if ($arg->type == 'DECIMAL' || $arg->type == 'FLOAT') {
						$validation_rules .= 'decimal';

					} else if ($arg->type == 'STRING') {
						$validation_rules .= 'string';
					}

					$this->form_validation->set_rules($problem_argument->argument_id, $arg->name, $validation_rules);
				}

				$data['arguments'] = $arguments;
				$data['problem_args'] = $problem_args;				

				if ($this->input->post('problem_id') && $this->form_validation->run()) {
					$updated_problem = array(
						'description' => $this->input->post('problem_description')
					);
					
					foreach ($problem_arguments as $problem_argument) {
						$updated_argument = array(
							'value' => $this->input->post($problem_argument->argument_id)
						);

						$this->Argument_model->update_problem_argument($updated_argument, $problem_argument->id);
					}

					if ($this->Problem_model->update_problem($updated_problem, $this->input->post('problem_id'))) {
						//@TODO: Run the generator again here
						$this->load->helper('url');
						redirect('/problems/profile/' . $this->input->post('problem_id'));
					}
				}

				$this->load->view('templates/header');
				$this->load->view('problems/edit', $data);
				$this->load->view('templates/footer');
			} else {
				$this->load->helper('url');
				redirect('/pages/view/permission');
			}
		}
	}
?>

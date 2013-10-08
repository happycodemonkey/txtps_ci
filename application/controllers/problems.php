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

		public function search() {
			if ($this->ion_auth->logged_in()) {
				$this->load->model('Autocomplete_model');
				$rows = $this->Autocomplete_model->GetAnamodColumns();
				$anamod_options = array();

				foreach($rows as $row) {
					$anamod_options[$row->Field] = $row->Field;
				}

				$data['dropdown_options'] = $anamod_options;
				$data['num_vars'] = 1;

				if ($this->input->post('search_problems')) {
					$this->load->model('Problem_model');
					
					$search_options = array();
					$num_vars = $this->input->post('num_vars');
					$data['num_vars'] = $num_vars;
					while ($num_vars > 0) {
						$range = array(
							'less_than' => $this->input->post('value_less_than_' . $num_vars),
							'greater_than' => $this->input->post('value_greater_than_' . $num_vars)
						);

						$search_options[$this->input->post('problem_variable_' . $num_vars)] = $range;
						$num_vars--;
					}	

					$problems = $this->Problem_model->search_problem($search_options)->result();
					$data['problems'] = $problems;
				}
				
				$this->load->view('templates/header');
				$this->load->view('problems/search', isset($data) ? $data : '');
				$this->load->view('templates/footer');

			} else {
				$this->load->helper('url');
				redirect('/users/login');
			}
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

			if (file_exists('/data/files/problems/' . $problem_id)) {
				foreach (scandir('/data/files/problems/' . $problem_id . '/public') as $file) {
					if (preg_match("/^.*\.pdf$/i", $file)) {
						$data['pdfs'][] = $file;
					} else if (preg_match("/^.*\.png$/i", $file)) {
						$data['pngs'][] = $file;				
					} else if (preg_match("/ERROR\.txt/i", $file)) {
						$data['error_file'][] = $file;
					} else {
						$data['files'][] = $file;
					}
				}
			}

			$this->load->view('templates/header');
			$this->load->view('problems/profile', $data);
			$this->load->view('templates/footer');

		}

		public function download($problem_id, $file_name) {
			$this->load->helper('download');
			$file = '/data/files/problems/' . $problem_id . '/public/' . $file_name;

			if (file_exists($file)) {
				$data = file_get_contents($file);

				if ($data != "" && force_download($file_name, $data)) {
					force_download($file_name, $data);
				} else {
					print "This file is empty.";
				}
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

		public function add($generator_id = null) {
			if ($this->ion_auth->logged_in()) {
				$this->load->model('Generator_model');
				$this->load->model('Problem_model');
				$this->load->model('Argument_model');
				$this->load->library('form_validation');

				if ($generator_id != null) {
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
							if ($argument->min_value) {
								$validation_rules .= '|callback_check_min[' . $argument->min_value . ']';
							}
							if ($argument->max_value) {
								$validation_rules .= '|callback_check_max[' . $argument->max_value . ']';
							}
							

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
							'created_datetime' => null
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

						if ($this->generate_problem($run_generator, $problem->id, $script_args)) {
							$this->load->helper('url');
							redirect('/problems/profile/' . $problem->id);
						} else {
							$this->load->library('email');
							$user = $this->ion_auth->user()->row();

							$message = "Your generator has produced no output and may have encountered an error."
								. " Please check your script and inputs and try again. If the problem persists" 
								. "please contact an administrator."
								. " <a href='http://" 
								. $_SERVER['SERVER_NAME'] . "/problems/profile/" 
								. $problem->id . "'>Click here</a> to view the problem.";

							$this->email->from('admin@txtps.tacc.utexas.edu', 'TxTPS');
							$this->email->reply_to('help@tacc.utexas.edu', 'TACC Help');
							$this->email->to($user->email);
							$this->email->bcc("eijkhout@tacc.utexas.edu");
							$this->email->subject("There was a problem running your generator.");
							$this->email->message($message);

							if ($this->email->send()) {
								error_log("Generator produced no output, email sent to " . $user->email);
								error_log($message);
							}  else {
								error_log($this->email->print_debugger());
							}
							
							$data['error'] = "Generator produced no output.";
						}
					}
				}

				$this->load->view('templates/header');
				$this->load->view('problems/add', isset($data) ? $data : '');
				$this->load->view('templates/footer');
			} else {
				$this->load->helper('url');
				redirect('/users/login');
			}

		}

		public function check_min($value, $arg_min) {
			if ($value >= $arg_min) {
				return true;
			} else {
				$this->form_validation->set_message('check_min', 'The %s field must be greater than or equal to the argument minimum.');
				return false;
			}
		}
		
		public function check_max($value, $arg_max) {
			if ($value <= $arg_max) {
				return true;
			} else {
				$this->form_validation->set_message('check_min', 'The %s field must be less than or equal to the argument maximum.');
				return false;
			}
		}

		private function generate_problem($generator, $problem_id, $args) {
			$arg_list = array();
			foreach($args as $name=>$value){
				$arg_list[$name] = $value;
			}			

			$problem_file_dir = "/data/files/problems/" . $problem_id;

			if(mkdir($problem_file_dir) && mkdir($problem_file_dir . "/public") && mkdir($problem_file_dir . "/private")) {

				$shell_command = "python $generator->script " . $problem_file_dir . " '" . json_encode($arg_list) . "' > " 
					. $problem_file_dir . "/private/stdout 2>&1";
				error_log($shell_command);
				shell_exec($shell_command);

				if (count(scandir($problem_file_dir . "/public")) <= 2) {
					error_log(count(scandir($problem_file_dir . "/public")));
					return false;	
				} else {
				
					$this->load->library('email');
					$user = $this->ion_auth->user()->row();

					$message = "Your problem has been generated. Please click the following link"
					. " to view and download your files: <a href='http://" 
					. $_SERVER['SERVER_NAME'] . "/problems/profile/" 
					. $problem_id . "'>http://" . $_SERVER['SERVER_NAME']
					. "/problems/profile/" . $problem_id . "</a>";

					$this->email->from('admin@txtps.tacc.utexas.edu', 'TxTPS');
					$this->email->to($user->email);
					$this->email->subject("Your problem has been generated.");
					$this->email->message($message);

					if ($this->email->send()) {
						error_log("Problem generated, email sent to " . $user->email);
						return true;
					} 

					error_log($this->email->print_debugger());
					return false;
				}
			} 			
				
			error_log("Could not run the generator...cannot mkdir");
			return false;
		}
		
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

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

			$problems = array_shift($this->Problem_model->get_problem($problem_id)->result());
			$generators = array_shift($this->Generator_model->get_generator($problems->generator_id)->result());
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
			$this->load->view('templates/header');
			$this->load->view('problems/profile', $data);
			$this->load->view('templates/footer');

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

				$data['generator'] = array_shift($this->Generator_model->get_generator($generator_id)->result());
				$arguments = $this->Argument_model->get_generator_argument('generator_id', $generator_id)->result();
				
				$data['generator_id'] = $generator_id;
				$data['arguments'] = $arguments;

				if ($this->input->post('add_problem')) {
					$this->load->helper('string');
					$new_problem = array(
						'identifier' => random_string('alnum', 6),
						'generator_id' => $this->input->post('generator_id'),
						'description' => $this->input->post('problem_description')
					);

					$problem = array_shift($this->Problem_model->add_problem($new_problem)->result());

					foreach ($arguments as $argument) {
						$new_problem_arguments = array(
							'problem_id' => $problem->id,
							'argument_id' => $argument->id,
							'value' => $this->input->post($argument->id)
						);
						
						$this->Argument_model->add_problem_argument($new_problem_arguments);
					}

					$this->load->helper('url');
					redirect('/problems/profile/' . $problem->id);
				}

				$this->load->view('templates/header');
				$this->load->view('problems/add', $data);
				$this->load->view('templates/footer');
			} else {
				show_404();
			}

		}
		
		//@TODO: generalize this more?
		function add_images($problem_id) {
			$this->load->model('Resource_model');
			$data['problem_id'] = $problem_id;
			$data['images'] = $this->Resource_model->get_resources_by_reference_id('image','problem',$problem_id)->result();

			if ($this->input->post('add_image')) {
				$config['upload_path'] = getEnv('DOCUMENT_ROOT') . "/assets/image/";
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

		function delete_image($image_id, $problem_id) {
			$this->load->model('Resource_model');
			$this->Resource_model->delete_resource($image_id);
			$this->load->helper('url');
			redirect('/problems/profile/' . $problem_id);
		}
	}
?>

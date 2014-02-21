<?php
	class Generators extends CI_CONTROLLER {
		public function view() {
			$this->load->model('Generator_model');
			$this->load->model('Collection_model');

			$data['generators'] = $this->Generator_model->get_generator()->result();
			
			$this->load->view('templates/header');

			$collections_data = array();
			foreach ($this->Collection_model->get_collection()->result() as $collection) {
				$collections_data[$collection->id] = $collection->name;
			}

			$data['collections'] = $collections_data;
			$this->load->view('generators/view', $data);
			$this->load->view('templates/footer');
		}

		public function profile($generator_id) {
			$this->load->model('Generator_model');
			$this->load->model('Collection_model');

			$generators = array_shift($this->Generator_model->get_generator('id',$generator_id)->result());
			
			$this->load->view('templates/header');
			$this->load->model('Problem_model');
			$this->load->model('Resource_model');
			$this->load->model('Argument_model');

			$data['generators'] = $generators;
			$data['collections'] = array_shift($this->Collection_model->get_collection($generators->collection_id)->result());
			$data['problems'] = $this->Problem_model->get_problem('generator_id', $generator_id)->result();
			$data['images'] = $this->Resource_model->get_resources_by_reference_id('image', 'generator', $generator_id)->result();
			$data['arguments'] = $this->Argument_model->get_generator_argument('generator_id', $generator_id)->result();
			$this->load->view('generators/profile', $data);
			$this->load->view('templates/footer');

		}

		public function delete($generator_id) {
			$this->load->model('Generator_model');
			$this->Generator_model->delete_generator($generator_id);
			
			$this->load->helper('url');
			redirect('generators/view');
		}

		public function add($collection_id = null) {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Collection_model');
				$this->load->model('Generator_model');
				$this->load->library('form_validation');

				$this->form_validation->set_rules('generator_name', 'Generator name', 'required');
				$this->form_validation->set_rules('collection_id', 'Collection', 'required');
				$this->form_validation->set_rules('generator_script', 'Script', 'required');

				if ($this->input->post('add_generator') && $this->form_validation->run()) {
					$data['generator_name'] = $this->input->post('generator_name');
					$data['collection_id'] = $this->input->post('collection_id');
					$data['generator_description'] = $this->input->post('generator_description');
					error_log($this->input->post('generator_description'));
					$data['generator_script'] = $this->input->post('generator_script');

					$new_generator = array(
						'name' => $this->input->post('generator_name'),
						'collection_id' => $this->input->post('collection_id'),
						'description' => $this->input->post('generator_description'),
						'script' => $this->input->post('generator_script'),
						'published' => $this->input->post('publish')
					);

					$generator = array_shift($this->Generator_model->add_generator($new_generator)->result());
					if ($generator->id) {
							$this->load->helper('url');
							redirect('/generators/add_arguments/' . $generator->id);
					} else {
						$data['error'] = "There was a problem saving your generator.";
					}
				}

				if ($collection_id) {
					$data['collection_id'] = $collection_id;
				}

				$dropdown_options = array();
				foreach ($this->Collection_model->get_collection()->result() as $collection) {
					$dropdown_options[$collection->id] = $collection->name;
				}

				$data['options'] = $dropdown_options;

				$this->load->view('templates/header');
				$this->load->view('generators/add', $data);
				$this->load->view('templates/footer');
			} else {
				$this->load->helper('url');
				redirect('/pages/view/permission');
			}
		}

		public function add_arguments($generator_id) {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Generator_model');
				$this->load->model('Argument_model');
				$this->load->library('form_validation');

				$data['arguments'] = $this->Argument_model->get_generator_argument('generator_id', $generator_id)->result();
				$data['generator_id'] = $generator_id;
				$data['generator_name'] = array_shift($this->Generator_model->get_generator('id', $generator_id)->result())->name;

				$this->form_validation->set_rules('argument_name', 'Argument name', 'required');
				$this->form_validation->set_rules('argument_variable', 'Argument variable', 'required');
				$this->form_validation->set_rules('argument_type', 'Argument type', 'required');
				$this->form_validation->set_rules('argument_min_value', 'Argument Minimum Value', 
					'callback_check_gt_lt[' . $this->input->post('argument_max_value') . ']');
				$this->form_validation->set_rules('argument_default', 'Argument Default Value', 
					'callback_check_default_gt[' . $this->input->post('argument_min_value') . ']
					|callback_check_default_lt[' . $this->input->post('argument_max_value') . ']');
				
				
				if ($this->input->post('add_arguments') && $this->form_validation->run()) {
					$new_argument = array(
						'name' => $this->input->post('argument_name'),
						'description' => $this->input->post('argument_description'),
						'generator_id' => $this->input->post('generator_id'),
						'variable' => $this->input->post('argument_variable'),
						'type' => $this->input->post('argument_type'),
						'options' => $this->input->post('argument_options'),
						'optional' => $this->input->post('argument_optional'),
						'min_value' => $this->input->post('argument_min_value'),
						'max_value' => $this->input->post('argument_max_value'),
						'default_value' => $this->input->post('argument_default')
					);				

					$this->Argument_model->add_generator_argument($new_argument);
					$this->load->helper('url');
					redirect('/generators/add_arguments/' . $generator_id);
				} else if ($this->form_validation->run() == FALSE) {
					$data['argument_name'] = $this->input->post('argument_name');
					$data['argument_description'] = $this->input->post('argument_description');
					$data['argument_variable'] = $this->input->post('argument_variable');
					$data['argument_type'] = $this->input->post('argument_type');
					$data['argument_options'] = $this->input->post('argument_options');
					$data['argument_optional'] = $this->input->post('argument_optional');
					$data['argument_min_value'] = $this->input->post('argument_min_value');
					$data['argument_max_value'] = $this->input->post('argument_max_value');
					$data['argument_default'] = $this->input->post('argument_default');
				}

				$this->load->view('templates/header');
				$this->load->view('generators/add_arguments', $data);
				$this->load->view('templates/footer');
			} else {
				$this->load->helper('url');
				redirect('/pages/view/permission');
			}
		}

		public function check_gt_lt($min_value, $max_value) {
			if ($min_value != '' && $max_value != '' && $min_value > $max_value) {
				$this->form_validation->set_message(
					'check_gt_lt',
					'The minumum value must be less than the maximum value'
				);

				return false;
			} else {
				return true;
			}
		}

		public function check_default_gt($default, $min_value) {
			if ($min_value != '' && $default != '') {
				if ($min_value <= $default) {
					return true;
				} else {
					$this->form_validation->set_message(
						'check_default_gt',
						'The minimum value must be less than or equal to the default value'
					);

					return false;
				}
			} else {
				return true;
			}
		}

		public function check_default_lt($default, $max_value) {
			if ($max_value != '' && $default != '') {
				if ($max_value >= $default) {
					return true;
				} else {
					$this->form_validation->set_message(
						'check_default_lt',
						'The maximum value must be greater than or equal to the default value'
					);

					return false;
				}
			} else {
				return true;
			}
		}

		public function edit_argument($argument_id, $generator_id) {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Generator_model');
				$this->load->model('Argument_model');
				$this->load->library('form_validation');

				$data['argument'] = array_shift($this->Argument_model->get_generator_argument('id', $argument_id)->result());
				$data['generator_id'] = $generator_id;
				$data['generator_name'] = array_shift($this->Generator_model->get_generator('id', $generator_id)->result())->name;

				$this->form_validation->set_rules('argument_name', 'Argument name', 'required');
				$this->form_validation->set_rules('argument_variable', 'Argument variable', 'required');
				$this->form_validation->set_rules('argument_type', 'Argument type', 'required');
				$this->form_validation->set_rules('argument_min_value', 'Argument Minimum Value', 
					'callback_check_gt_lt[' . $this->input->post('argument_max_value') . ']');
				$this->form_validation->set_rules('argument_default', 'Argument Default Value', 
					'callback_check_default_gt[' . $this->input->post('argument_min_value') . ']
					|callback_check_default_lt[' . $this->input->post('argument_max_value') . ']');
				
				if ($this->input->post('edit_argument') && $this->form_validation->run()) {
					$updated_argument = array(
						'name' => $this->input->post('argument_name'),
						'description' => $this->input->post('argument_description'),
						'generator_id' => $this->input->post('generator_id'),
						'variable' => $this->input->post('argument_variable'),
						'type' => $this->input->post('argument_type'),
						'options' => $this->input->post('argument_options'),
						'optional' => $this->input->post('argument_optional'),
						'min_value' => $this->input->post('argument_min_value'),
						'max_value' => $this->input->post('argument_max_value'),
						'default_value' => $this->input->post('argument_default')
					);				

					$this->Argument_model->update_generator_argument($updated_argument, $argument_id);
					$this->load->helper('url');
					redirect('/generators/add_arguments/' . $generator_id);
				}

				$this->load->view('templates/header');
				$this->load->view('generators/edit_argument', $data);
				$this->load->view('templates/footer');
			} else {
				$this->load->helper('url');
				redirect('/pages/view/permission');
			}
		}

		public function delete_argument($argument_id, $generator_id, $redirect_url = 'add_arguments') {
			$this->load->model('Argument_model');
			$this->Argument_model->delete_generator_argument($argument_id);
			$this->load->helper('url');
			redirect('/generators/' . $redirect_url . '/' . $generator_id);
			
		}


		public function edit($generator_id) {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Generator_model');
				$this->load->model('Argument_model');
				$this->load->model('Collection_model');
				$this->load->library('form_validation');

				$generator = array_shift($this->Generator_model->get_generator('id', $generator_id)->result());
				$data['arguments'] = $this->Argument_model->get_generator_argument('generator_id', $generator_id)->result();
				$data['generator'] = $generator;
				$data['collection'] = array_shift($this->Collection_model->get_collection($generator->collection_id)->result());

				$this->load->view('templates/header');
				$this->load->view('generators/edit', $data);
				$this->load->view('templates/footer');

				$this->form_validation->set_rules('generator_name', 'Generator name', 'required');
				if ($this->input->post('generator_id') && $this->form_validation->run()) {
					error_log($this->input->post('generator_description'));
					$updated_generator = array(
						'description' => $this->input->post('generator_description'),
						'name' => $this->input->post('generator_name'),
						'script' => $this->input->post('generator_script')
					);

					if ($this->Generator_model->update_generator($updated_generator, $this->input->post('generator_id'))) {
						$this->load->helper('url');
						redirect('/generators/profile/' . $this->input->post('generator_id'));
					}
				}
			}
		}

		public function unpublished() {
			$this->load->model('Generator_model');

			$data['generators'] = array_shift($this->Generator_model->get_generator('published', 'false')->result());
			
			$this->load->view('templates/header');
			$this->load->view('generators/unpublished', $data);
			$this->load->view('templates/footer');
		}

	}
?>

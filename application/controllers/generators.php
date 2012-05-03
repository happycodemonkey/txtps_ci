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

			$generators = array_shift($this->Generator_model->get_generator($generator_id)->result());
			
			$this->load->view('templates/header');
			$this->load->model('Problem_model');
			$this->load->model('Resource_model');
			$data['generators'] = $generators;
			$data['collections'] = array_shift($this->Collection_model->get_collection($generators->collection_id)->result());
			$data['problems'] = $this->Problem_model->get_problem('generator_id', $generator_id)->result();
			$data['images'] = $this->Resource_model->get_resource('image', 'generator', $generator_id)->result();
			$this->load->view('generators/profile', $data);
			$this->load->view('templates/footer');

		}

		public function delete($generator_id) {
			$this->load->model('Generator_model');
			$this->Generator_model->delete_generator($generator_id);
		}

		public function add($collection_id = null) {
			$this->load->model('Collection_model');
			$this->load->model('Generator_model');
			if ($this->input->post('add_generator')) {
				$data['generator_name'] = $this->input->post('generator_name');
				$data['collection_id'] = $this->input->post('collection_id');
				$data['generator_description'] = $this->input->post('generator_description');
				$data['generator_script'] = $this->input->post('generator_script');

				$config['upload_path'] = "/opt/apps/";
				$config['allowed_types'] = "py|txt|sh";
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('generator_script')) {
					$file_data = $this->upload->data();
				} else {
					$data['error'] = "ERROR: " . $this->upload->display_errors();
				}

				$new_generator = array(
					'name' => $this->input->post('generator_name'),
					'collection_id' => $this->input->post('collection_id'),
					'description' => $this->input->post('generator_description'),
					'script' => $file_data['file_name']
				);

				$generator = $this->Generator_model->add_generator($new_generator);

				if (isset($generator->result()->id)) {
						$data['saved'] = "Yes";
						$this->load->helper('url');
						redirect('/generators/add_arguments/' . $generator->result()->id);
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

		}

		public function add_arguments($generator_id) {
			$this->load->model('Generator_model');
			$data['arguments'] = $this->Generator_model->get_arguments($generator_id)->result();
			$data['generator_id'] = $generator_id;
			
			if ($this->input->post('add_arguments')) {
				$new_argument = array(
					'name' => $this->input->post('argument_name'),
					'description' => $this->input->post('argument_description'),
					'generator_id' => $this->input->post('generator_id'),
					'variable' => $this->input->post('argument_variable'),
					'type' => $this->input->post('argument_type'),
					'options' => $this->input->post('argument_options'),
					'optional' => $this->input->post('argument_optional')
				);				

				$this->Generator_model->add_argument($new_argument);
				$this->load->helper('url');
				redirect('/generators/add_arguments/' . $generator_id);
			} else if ($this->input->post('continue')) {
				$this->load->helper('url');
				redirect('/generators/add_images/' . $this->input->post('generator_id'));
			}

			$this->load->view('templates/header');
			$this->load->view('generators/add_arguments', $data);
			$this->load->view('templates/footer');

		}

		public function delete_argument($argument_id, $generator_id) {
			$this->load->model('Generator_model');
			$this->Generator_model->delete_argument($argument_id);
			$this->load->helper('url');
			redirect('/generators/add_arguments/' . $generator_id);
			
		}

		public function add_images($generator_id) {
			$this->load->model('Resource_model');
			$data['generator_id'] = $generator_id;
			$data['images'] = $this->Resource_model->get_resources_by_resource_id('image','generator',$generator_id)->result();

			if ($this->input->post('add_image')) {
				$config['upload_path'] = getEnv('DOCUMENT_ROOT') . "/assets/image/";
				$config['allowed_types'] = "py|txt|sh";
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('generator_image')) {
					$file_data = $this->upload->data();
				} else {
					$data['error'] = "ERROR: " . $this->upload->display_errors();
				}

				$new_image = array(
					'resource_id' => $this->input->post('generator_id'),
					'resource_type' => 'generator',
					'name' => $file_data['file_name']
				);

				$this->Resource_model->add_resource('image', $new_image);
			}

			$this->load->view('templates/header');
			$this->load->view('generators/add_images', $data);
			$this->load->view('templates/footer');

		}

		public function delete_image($image_id, $generator_id) {
			$this->load->model('Resource_model');
			$this->Resource_model->delete_resource('image',$image_id);
			$this->load->helper('url');
			redirect('/generators/add_images/' . $generator_id);
			
		}

	}
?>

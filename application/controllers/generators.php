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
			$data['generator_id'] = $generator_id;
			error_log($generator_id);

			if ($this->input->post('add_arguments')) {
				$this->load->helper('url');
				$url = '/generators/add_images/' . $this->input->post('generator_id');
				redirect($url);
			}

			$this->load->view('templates/header');
			$this->load->view('generators/add_arguments', $data);
			$this->load->view('templates/footer');

		}

		public function add_images($generator_id) {
			$data['generator_id'] = $generator_id;

			$this->load->view('templates/header');
			$this->load->view('generators/add_images', $data);
			$this->load->view('templates/footer');

		}

	}
?>

<?php
	class Generators extends CI_CONTROLLER {
		public function manage($filter = null, $key = null) {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Generator_model');
				$this->load->model('Collection_model');

				$data['generators'] = $this->Generator_model->get_generator($filter, $key);
				
				$collections_data = array();
				foreach ($this->Collection_model->get_collection()->result() as $collection) {
					$collections_data[$collection->id] = $collection->name;
				}

				$data['collections'] = $collections_data;
				$data['title'] = 'Manage Generators';

				$this->load->view('templates/header', $data);
				$this->load->view('generators/manage', $data);
				$this->load->view('templates/footer', $data);
			} else {
				show_404();
			}
		}

		public function view($filter = null, $key = null) {
			$this->load->model('Generator_model');

		 	$data['generators'] = $this->Generator_model->get_generator($filter, $key);
			if ($filter == "collection_id") {
				$this->load->model('Collection_model');
				$data['collection'] = $this->Collection_model->get_collection($key)->result();
			} else {
				$this->load->model('Problem_model');
				$data['problems'] = $this->Problem_model->get_problem('generator_id', $key);
			}
			$data['title'] = 'Generators';
			
			$this->load->view('templates/header', $data);
			$this->load->view('generators/view', $data);
			$this->load->view('templates/footer', $data);
			
		}

		public function delete($generator_id) {
			$this->load->model('Generator_model');
			$this->Generator_model->delete_generator($generator_id);
		}

		public function add() {
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
				
				if ($this->Generator_model->add_generator($new_generator)) {
					$data['saved'] = "Yes";
				} else {
					$data['error'] = "There was a problem saving your generator.";
				}
			}

			$dropdown_options = array();
			foreach ($this->Collection_model->get_collection()->result() as $collection) {
				$dropdown_options[$collection->id] = $collection->name;
			}

			$data['options'] = $dropdown_options;

			$this->load->view('templates/header', $data);
			$this->load->view('generators/add', $data);
			$this->load->view('templates/footer', $data);

		}

	}
?>

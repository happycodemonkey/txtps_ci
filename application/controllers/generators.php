<?php
	class Generators extends CI_CONTROLLER {
		public function manage($filter = null, $key = null) {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Generator_model');
				$this->load->model('Collection_model');

				$data['generators'] = $this->Generator_model->get_generators($filter, $key);
				
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

		 	$data['generators'] = $this->Generator_model->get_generators($filter, $key);
			$data['title'] = 'Generators';
			
			$this->load->view('templates/header', $data);
			$this->load->view('generators/view', $data);
			$this->load->view('templates/footer', $data);
			
		}

	}
?>

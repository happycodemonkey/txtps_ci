<?php
	class Problems extends CI_CONTROLLER {
		public function manage() {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Problem_model');
				$this->load->model('Collection_model');
				$this->load->model('Generator_model');

				$data['title'] = 'Manage Problems';
				$data['problems'] = $this->Problem_model->get_problems();

				$collections_data = array();
                                foreach ($this->Collection_model->get_collection()->result() as $collection) {
                                        $collections_data[$collection->id] = $collection->name;
                                }

				$generators_data = array();
				foreach ($this->Generator_model->get_generators()->result() as $generator) {
					$generators_data[$generator->id] = $generator->name;
				}

				$data['collections'] = $collections_data;
				$data['generators'] = $generators_data;

				$this->load->view('templates/header', $data);
				$this->load->view('problems/manage', $data);
				$this->load->view('templates/footer', $data);
			}

		}

		public function menu() {
			$data['title'] = 'Problems Menu';
			$this->load->view('templates/header', $data);
			$this->load->view('problems/menu', $data);
			$this->load->view('templates/footer', $data);

		}
	}
?>

<?php
	class Collections extends CI_CONTROLLER {
		public function view() {
			$this->load->model('Collection_model');
			$this->load->model('Generator_model');
			$collections = $this->Collection_model->get_collection()->result();
			$data['collections'] = $collections;

			$this->load->view('templates/header');
			$gens_data = array();
			foreach ($collections as $collection) {
				$gens_data[$collection->id] = $this->Generator_model->get_num_generators($collection->id)->result();
			}

			$data['num_gens'] = $gens_data;
			$this->load->view('collections/view', $data);
			$this->load->view('templates/footer');
		}

		public function profile($collection_id) {
			$this->load->model('Collection_model');
			$this->load->model('Generator_model');
			$data['collections'] = array_shift($this->Collection_model->get_collection($collection_id)->result());

			$this->load->view('templates/header');
			$data['generators'] = $this->Generator_model->get_generator('collection_id', $collection_id)->result();
			$this->load->view('collections/profile', $data);
			$this->load->view('templates/footer');
		}

		public function add() {
			if ($this->input->post('add_collection')) {
				$this->load->model('Collection_model');
				$new_collection = array(
					'name' => $this->input->post('collection_name'),
					'description' => $this->input->post('collection_description')
				);

				$collection = array_shift($this->Collection_model->create_collection($new_collection)->result());

				if ($collection->id) { 
					$this->load->helper('url');
					redirect('/collections/profile/' . $collection->id);
				}
			}

			$this->load->view('templates/header');
			$this->load->view('collections/add');
			$this->load->view('templates/footer');

		}
	}
?>

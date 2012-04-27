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
				if ($this->Collection_model->create_collection(
					$this->input->post('collection_name'), 
					$this->input->post('collection_description'))
				) { 
					$data['success'] = "Successfully added the collection.";
				} else {
					$data['error'] = "There was a problem adding your collection";
				}
			}

			$this->load->view('templates/header');
			$this->load->view('collections/add', $data);
			$this->load->view('templates/footer');

		}
	}
?>

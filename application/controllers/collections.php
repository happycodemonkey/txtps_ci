<?php
	class Collections extends CI_CONTROLLER {
		public function manage() {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Collection_model');
				$this->load->model('Generator_model');
				$collections = $this->Collection_model->get_collection();
				if ($collections) {
					$collection_data = array();
					$gens_data = array();
					foreach ($collections->result() as $collection) {
						$gens_data[$collection->id] = $this->Generator_model->get_num_generators($collection->id)->result();
						$collection_data[$collection->id] = $collection->name;
					}
				}

				$data['title'] = 'Manage Collections';
				$data['collections'] = $collection_data;
				$data['generators'] = $gens_data;

				$this->load->view('templates/header', $data);
				$this->load->view('collections/manage', $data);
				$this->load->view('templates/footer', $data);
			} else {
				show_404();
			}
		}

		public function add() {

			if($this->input->post('collection_name') && $this->input->post('collection_description')) {
				$this->load->model('Collection_model');
				if ($this->Collection_model->create_collection(
					$this->input->post('collection_name'), 
					$this->input->post('collection_description'))
				) { 
					print "Successfully added the collection.";
				} else {
					print "There was a problem adding your collection";
				}
			}

			$data['title'] = 'Add a New Collection';
			$this->load->view('templates/header', $data);
			$this->load->view('collections/add', $data);
			$this->load->view('templates/footer', $data);

		}

		public function view($collection_id = null) {
			$this->load->model('Collection_model');

		 	$data['collections'] = $this->Collection_model->get_collection($collection_id);
			$data['title'] = 'Collection';
			
			$this->load->view('templates/header', $data);
			$this->load->view('collections/view', $data);
			$this->load->view('templates/footer', $data);
			
		}
	}
?>

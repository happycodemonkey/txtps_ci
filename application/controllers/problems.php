<?php
	class Problems extends CI_CONTROLLER {
		public function manage() {
			if ($this->ion_auth->is_admin()) {
				$this->load->model('Problem_model');
				$this->load->model('Collection_model');
				$this->load->model('Generator_model');

				$data['title'] = 'Manage Problems';
				$data['problems'] = $this->Problem_model->get_problem();

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

				$this->load->view('templates/header', $data);
				$this->load->view('problems/manage', $data);
				$this->load->view('templates/footer', $data);
			}

		}

		public function view($problem_id = null) {
                        $this->load->model('Problem_model');
			$this->load->model('Generator_model');
			$this->load->model('Collection_model');
			$this->load->model('Resource_model');

                        $problem = $this->Problem_model->get_problem('id', $problem_id)->result();
			$generator = $this->Generator_model->get_generator('id', $problem[0]->generator_id)->result();
			$collection = $this->Collection_model->get_collection($generator[0]->collection_id)->result();

			$data['collection'] = $collection[0];
			$data['generator'] = $generator[0];
			$data['problem'] = $problem[0];
                        $data['title'] = 'Problem';
			$data['images'] = $this->Resource_model->get_resource('image', 'problem', $problem_id)->result();
			$data['files'] = $this->Resource_model->get_resource('file', 'problem', $problem_id)->result();

                        $this->load->view('templates/header', $data);
                        $this->load->view('problems/view', $data);
                        $this->load->view('templates/footer', $data);

		}

		public function menu() {
			$data['title'] = 'Problems Menu';
			$this->load->view('templates/header', $data);
			$this->load->view('problems/menu', $data);
			$this->load->view('templates/footer', $data);

		}

		public function delete($problem_id) {
			$this->load->model('Problem_model');
			$this->Problem_model->delete_problem($problem_id);
		}

		public function add($generator_id) {
			$this->load->model('Generator_model');
			$this->load->model('Problem_model');


                        $generator = $this->Generator_model->get_generator($generator_id)->result();
                        
			$data['generator_name'] = $generator[0]->name;
			$data['generator_id'] = $generator_id;
			$data['arguments'] = $this->Generator_model->get_arguments($generator_id)->result();

			$this->load->view('templates/header', $data);
			$this->load->view('problems/add', $data);
			$this->load->view('templates/footer', $data);
		}
	}
?>

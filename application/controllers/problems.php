<?php
	class Problems extends CI_CONTROLLER {
		public function view($problem_id = null) {
			$this->load->model('Problem_model');
			$this->load->model('Collection_model');
			$this->load->model('Generator_model');


			$this->load->view('templates/header');
			if ($problem_id) {
				$problems = $this->Problem_model->get_problem($problem_id)->result();
				$generators = $this->Generator_model->get_generator($problems[0]->generator_id)->result();
				$collections = $this->Collection_model->get_collection($generators[0]->collection_id)->result();

				$data['problems'] = $problems[0];
				$data['generators'] = $generators[0];
				$data['collections'] = $collections[0];
				$this->load->view('problems/profile', $data);
			} else {
				$data['problems'] = $this->Problem_model->get_problem()->result();

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
				$this->load->view('problems/view', $data);
			}
			$this->load->view('templates/footer');
		}

		public function menu() {
			$this->load->view('templates/header');
			$this->load->view('problems/menu');
			$this->load->view('templates/footer');

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

			$this->load->view('templates/header');
			$this->load->view('problems/add', $data);
			$this->load->view('templates/footer');
		}
	}
?>

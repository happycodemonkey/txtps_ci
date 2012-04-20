<?php
	class Problems extends CI_CONTROLLER {
		public function manage() {
			if ($this->ion_auth->is_admin()) {
				$data['title'] = 'Manage Problems';
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

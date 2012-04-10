<?php
/**
	Placeholder code for "static" pages (about, contact, faq, etc).
	Will be re-written and probably eliminated later, just getting
	content up right now.
**/

	class Pages extends CI_CONTROLLER {

		public function view($page = 'home') {
			if (!file_exists('application/views/pages/' . $page . '.php')) {
				show_404();
			}

			$this->load->helper('url');
			$data['title'] = ucfirst($page);
			
			$this->load->view('templates/header', $data);
			$this->load->view('pages/' . $page, $data);
			$this->load->view('templates/footer', $data);
		}
	}
?>

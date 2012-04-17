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

		public function contact($send = null) {
			if (!file_exists('application/views/pages/contact.php')) {
				show_404();
			}

			if ($send) {
				$email = $this->input->post('from_email');
				$subject = $this->input->post('subject');
				$message = $this->input->post('message');

				$this->load->library('email');

				$this->email->from($email);
				$this->email->to('cmarnold@tacc.utexas.edu');
				$this->email->subject($subject);
				$this->email->message($message);

				$this->email->send();
			}

			$this->load->helper('url');
			$data['title'] = 'Contact Us';
			
			$this->load->view('templates/header', $data);
			$this->load->view('pages/contact.php', $data);
			$this->load->view('templates/footer', $data);
		}
	}
?>
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
	
			if ($page == 'home') {
				$this->load->model('Collection_model');
				$this->load->model('Generator_model');
				$this->load->model('Problem_model');

				$data['recent_problems'] = $this->Problem_model->get_recent_problems()->result();
				$data['recent_collections'] = $this->Collection_model->get_recent_collections()->result();
				$data['recent_generators'] = $this->Generator_model->get_recent_generators()->result();
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
				$subject = "[TXTPS]" . $this->input->post('subject');
				$message = $this->input->post('message');

				$this->load->library('email');

				$this->email->from($email);
				$this->email->to('eijkhout@tacc.utexas.edu');
				$this->email->bcc('cmarnold@tacc.utexas.edu');
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

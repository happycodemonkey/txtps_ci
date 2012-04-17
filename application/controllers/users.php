<?php
	class Users extends CI_CONTROLLER {
		public function login() {
			$data['title'] = 'Login';

			$this->load->view('templates/header', $data);
			$this->load->view('users/login.php', $data);
			$this->load->view('templates/footer', $data);

			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if ($username && $password) {
				$this->load->library('ion_auth');
				$this->load->helper('url');
				if($this->ion_auth->login($username, $password, TRUE)) {
					redirect('pages/view/home');
				} else {
					redirect('users/register/login');
				}
			}
		}

		public function register($login = null) {
			$data['title'] = 'Register';

			if ($login) {
				echo "Please register.";
			}

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			if ($username && $password) {

				$addit_info = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name')
				);

				$this->load->helper('url');

				if ($this->ion_auth->register($username, $password, $username, $addit_info)) {
					redirect('users/login');
				} else {
					echo "There was an issue with your registration.";
				}
			}

			$this->load->view('templates/header', $data);
			$this->load->view('users/register.php', $data);
			$this->load->view('templates/footer', $data);
		}

		public function logout() {
			$data['title'] = 'Logout';

			$this->ion_auth->logout();
			$this->load->helper('url');
			redirect('pages/view/home');
		}

		public function manage($action = null, $id = null) {
			if ($this->ion_auth->is_admin()) {
				if ($action && $id) {
					if ($action == 'admin') {
						if (!$this->ion_auth->in_group('admin', $id)) {
							// @TODO: don't hardcode....
							$this->ion_auth->add_to_group(1, $id);
						} else {
							$this->ion_auth->remove_from_group(1, $id);
						}
					} else if ($action == 'delete') {
						$this->ion_auth->delete_user($id);
					}
				} 
				$this->load->view('templates/header');
				$this->load->view('users/manage');
				$this->load->view('templates/footer');
			} else {
				show_404();
			}
		}
	}
?>

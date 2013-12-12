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
			$email = $this->input->post('email');

			$this->load->library('form_validation');

			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('username', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('retype_password', 'Retype Password', 'required|matches[password]');

			if ($username && $password && $this->form_validation->run()) {
				if (!$this->ion_auth->email_check($username)) {
					if (!$this->ion_auth->username_check($username)) {

						$addit_info = array(
							'first_name' => $this->input->post('first_name'),
							'last_name' => $this->input->post('last_name')
						);

						$this->load->helper('url');

						if ($this->ion_auth->register($username, $password, $username, $addit_info)) {
							redirect('users/login');
						} else {
							$data['errors'][] = "There was an issue with your registration.";
						}
					} else {
						$data['errors'][] = 'This username is already registered with this site.';
					}
				} else {
					$data['errors'][] = 'This email is already registered with this site.';
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
				$this->load->library('url');
				redirect('pages/view/permission');
			}
		}

		public function change_password() {
			if ($this->ion_auth->logged_in()) {
				$data['title'] = "Change your password.";
				$this->load->library('form_validation');
				$this->form_validation->set_rules('password', 'Password', 'required|matches[retype]|min_length[5]');
				$this->form_validation->set_rules('retype', 'Retype Password', 'required');
				if ($this->input->post('password') && $this->form_validation->run()) {
					$user_id = $this->ion_auth->user()->row()->id;
					$updated = array(
						'password' => $this->input->post('password')
					);
					
					if ($this->ion_auth->update($user_id, $updated)) {
						$data['success'] = "Your password was successfully updated.";
					} else {
						$data['error'] = "There was an issue changing your password.";
					}					
				}
				$this->load->view('templates/header');
				$this->load->view('users/change_password', $data);
				$this->load->view('templates/footer');
			} else {
				$this->load->library('url');
				redirect('pages/view/permission');
			}
		}
	}
?>

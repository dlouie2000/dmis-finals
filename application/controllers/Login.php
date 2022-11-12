<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Login_model');
		//$this->load->model('usermanagment_model');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

	function auth() {
		
		$this->form_validation->set_rules('mainusername', 'Username' ,'required');
		$this->form_validation->set_rules('mainpassword', 'Password' ,'required'); //callback_[function name]

		if ($this->form_validation->run() === true) {

			$username  = $this->input->post('mainusername',TRUE);
			$password  = $this->input->post('mainpassword',TRUE);
			$result    = $this->Login_model->check_user($username, $password);

			if($result->num_rows() > 0) {
				$data  = $result->row_array();
				$name  = $data['username'];
				// $email = $data['email'];
				$level = $data['level'];
				$sesdata = array(
					'userid'  => $data['userId'],
					'username'  => $username,
					// 'email'		=> $email,
					'level'     => $level,
					'logged_in' => TRUE
				);
				$this->session->set_userdata($sesdata);
				if($level === '1') {
					redirect('Main');
				} elseif($level === '2') {
					redirect('products');
				} else {
					redirect('Project_leader');
				}
			} else {
				$this->session->set_flashdata('error','Incorrect Email or Password.');
				redirect('');
			}	
		} else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('');
		}
	}

	function checkusername($name = '') {
		if (strlen ($name) < 8 ) {
			$this->form_validation->set_message('checkusername', 'The {field} field can should be 8 characters long');
			return false; 
		} else if (preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $name)) {
			$this->form_validation->set_message('checkusername', 'The {field} should not contain special characters');
			return false; 	
		}
		else {
			return true;
		}	
	}

	function logout() {
		$this->session->sess_destroy();
		redirect('Login');
	}
}

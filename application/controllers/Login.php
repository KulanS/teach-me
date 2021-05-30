<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
	  $this->load->library('session');
	  
	  $this->load->model('User', 'user_model');

  }

  public function load_login_view() {
    $this->load->view('/login/index.html');
  }

  public function user_login() {
	$response = array();
	$user_details = array();
	$session_data = array();
	$user_details['email'] = $this->input->post('email');
	$user_details['password'] = $this->input->post('password');
	//$this->session->sess_destroy();
		$login_details = $this->user_model->get_user_login_details($user_details);
		if($login_details != null) {
			$session_data['email'] = $login_details['email'];
			$session_data['role'] = $login_details['role'];
			$session_data['status'] = $login_details['status'];
			$this->session->set_userdata('logged_in', TRUE);
			$this->session->set_userdata('session_data', $session_data);
			if($session_data['status'] !== 'pending') {
				if($session_data['role'] === 'admin') {
					$response['responseCode'] = 00;
					$response['status'] = 'Login Successful';
					//$response['status'] = 'Hi, you have successfully registered with us. Stay tuned with us';
					$response['redirect_url'] = base_url('admin');
					echo json_encode($response);
				}else if($session_data['role'] == 'regular') {
					$response['responseCode'] = 00;
					$response['status'] = 'Hi, you have successfully registered with us. Stay tuned with us';
				//$this->load->view(''); yet to build
				}
			}else {
			//send pending
			$response['responseCode'] = 06;
			$response['status'] = 'Can not login now. This user under review';
			echo json_encode($response);
			}
		}else {
			$this->session->set_userdata('logged_in', FALSE);
			$this->session->set_userdata('session_data', $session_data);
			$response['responseCode'] = 05;
			$response['status'] = 'Login Failed';
			echo json_encode($response);
		}
  }

}

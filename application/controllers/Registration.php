<?php

class Registration extends CI_Controller {

  public function __construct() {
    parent::__construct();
	$this->load->helper('url');
    $this->load->model('User', 'user_model');
  }

  public function load_registration_view() {
    $this->load->view('/registration/index.html');
  }

  public function register_user() {
	  $user_details = array();
	  $user_details['firstName'] = $this->input->post('firstName');
	  $user_details['lastName'] = $this->input->post('lastName');
	  $user_details['nic'] = $this->input->post('nic');
	  $user_details['phone'] = $this->input->post('phone');
	  $user_details['qualifications'] = $this->input->post('qualifications');
	  $user_details['email'] = $this->input->post('email');
	  $user_details['password'] = $this->input->post('password');
	  $user_details['mediumList'] = $this->input->post('mediumList');
	  $user_details['gradeList'] = $this->input->post('gradeList');
	  $user_details['subjectList'] = $this->input->post('subjectList');
    $user_details['districtList'] = $this->input->post('districtList');

	  $insert_success = true;
    $no_of_users = $this->user_model->user_exists($user_details['nic']);
    $response = array();


    if($no_of_users == 0) {
      $this->user_model->insert_user_personal_information($user_details);
      $user_details['userid'] = $this->user_model->get_last_user_id();
      $this->user_model->insert_user_login($user_details);
      $this->user_model->insert_user_medium($user_details);
      $this->user_model->insert_user_audience($user_details);
      $this->user_model->insert_user_subject($user_details);
      $this->user_model->insert_user_district($user_details);
      $response['responseCode'] = '00';
      $response['status'] = 'Registration Success';
    }else if($no_of_users == 1) {
      $response['responseCode'] = '01';
      $response['status'] = 'Registration Failed : User Already Exists';
    }else {
      $response['responseCode'] = '02';
  	  $response['status'] = 'Registration Failed : Multiple Users Exists For NIC';
    }
    echo json_encode($response);
  }

}

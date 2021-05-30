<?php
class User extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->library('session');
  }

  public function insert_user_personal_information($user_details) {
  	$this->db->set('firstname', $user_details['firstName']);
  	$this->db->set('lastname', $user_details['lastName']);
  	$this->db->set('nic', $user_details['nic']);
  	$this->db->set('phone', $user_details['phone']);
  	$this->db->set('qualifications', $user_details['qualifications']);
  	$this->db->insert('personal_information');

  	return ($this->db->affected_rows() > 0) ? false : true;
  }

  public function insert_user_login($user_details) {
    $encoded_password = base64_encode($user_details['password']);
    $regular_user = 'regular';
    $pending_status = 'pending';

  	$this->db->set('userid', $user_details['userid']);
  	$this->db->set('email', $user_details['email']);
  	$this->db->set('password', $encoded_password);
  	$this->db->set('role', $regular_user);
  	$this->db->set('status', $pending_status);

  	$this->db->insert('user_login');

  	return ($this->db->affected_rows() > 0) ? false : true;
  }

  public function insert_user_medium($user_details) {
    foreach ($user_details['mediumList'] as $mediumId) {
      $this->db->set('useridfk', $user_details['userid']);
  	  $this->db->set('mediumidfk', $mediumId);
  	  $this->db->insert('mp_user_medium');
    }
    return ($this->db->affected_rows() > 0) ? false : true;
  }

  public function insert_user_audience($user_details) {
    foreach($user_details['gradeList'] as $gradeId) {
      $this->db->set('useridfk', $user_details['userid']);
  	  $this->db->set('audienceidfk', $gradeId);
  	  $this->db->insert('mp_user_audience');
    }
    return ($this->db->affected_rows() > 0) ? false : true;
  }

  public function insert_user_subject($user_details) {
    foreach($user_details['subjectList'] as $subjectId) {
      $this->db->set('useridfk', $user_details['userid']);
  	  $this->db->set('subjectidfk', $subjectId);
  	  $this->db->insert('mp_user_subject');
    }
    return ($this->db->affected_rows() > 0) ? false : true;
  }

  public function insert_user_district($user_details) {
    foreach($user_details['districtList'] as $districtId) {
      $this->db->set('useridfk', $user_details['userid']);
  	  $this->db->set('districtid', $districtId);
  	  $this->db->insert('mp_user_district');
    }
    return ($this->db->affected_rows() > 0) ? false : true;
  }

  public function user_exists($nic) {
    return $this->db->where('nic', $nic)->count_all_results('personal_information');
  }

public function get_last_user_id() {
	$this->db->select_max('userid', 'id');
	$query = $this->db->get('personal_information');
	return $query->row()->id;
}

  public function get_user_login_details($user_details) {
    $login_details = array();
	$this->db->select('email');
	$this->db->select('password');
	$this->db->select('role');
	$this->db->select('status');
	$this->db->from('user_login');
	$this->db->where('email', $user_details['email']);
	$this->db->where('password', base64_encode($user_details['password']));
	$query = $this->db->get();

	if($query->num_rows() > 0) {
    $login_details['email'] = $query->row()->email;
		$login_details['role'] = $query->row()->role;
		$login_details['status'] = $query->row()->status;

    return $login_details;
	}else {
	  return null;
	}

  }

  public function email_validation($email) {
    return $this->db->where('email', $email)->count_all_results('user_login');
  }
}

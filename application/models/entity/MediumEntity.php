<?php

class MediumEntity extends CI_Model {

  public function __construct () {
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->library('session');
  }

  public function get_medium_list () {
    $sql = 'SELECT mediumid, mediumname FROM medium';
    $query = $this->db->query($sql);
    return $query->result();
  }

}

<?php
class AudienceEntity extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->library('session');
  }

  public function get_audience_list() {
    $sql = 'SELECT audienceid, audiencename FROM audience';
    $query = $this->db->query($sql);
    return $query->result();
  }
}

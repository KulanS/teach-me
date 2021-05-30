<?php
class DistrictEntity extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->library('session');
  }

  public function get_district_list() {
    $sql = 'SELECT districtid, districtname
            FROM district';
    $query = $this->db->query($sql);
    return $query->result();
  }
}

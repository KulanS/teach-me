<?php
class Data extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('/entity/MediumEntity', 'medium_entity');
    $this->load->model('/entity/AudienceEntity', 'audience_entity');
    $this->load->model('/entity/SubjectEntity', 'subject_entity');
    $this->load->model('/entity/DistrictEntity', 'district_entity');
    $this->load->helper('url');
  }

  public function get_medium_list() {
    $medium_list = $this->medium_entity->get_medium_list();
    echo json_encode($medium_list);
  }

  public function get_audience_list() {
    $audience_list = $this->audience_entity->get_audience_list();
    echo json_encode($audience_list);
  }

  public function get_subject_list_against_audience() {
	  $audience_list = $this->input->post('audience_list');
    $subject_list = $this->subject_entity->get_subject_list_against_audience($audience_list);
    echo json_encode($subject_list);
  }

  public function get_district_list() {
    $district_list = $this->district_entity->get_district_list();
    echo json_encode($district_list);
  }
}

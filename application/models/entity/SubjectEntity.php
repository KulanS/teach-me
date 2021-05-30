<?php
class SubjectEntity extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->helper('url');
    $this->load->library('session');
  }

  public function get_subject_list_against_audience($audience_list) {

		$result_object = array();
		foreach($audience_list as $audienceid){
			$sql = 'SELECT DISTINCT subjectid, subjectname
               FROM subject
               INNER JOIN mp_subject_audience
               ON subject.subjectid = mp_subject_audience.subjectidfk
               WHERE mp_subject_audience.audienceidfk = '.$audienceid.'';
      $query = $this->db->query($sql);
		foreach($query->result() as $row){
			$result_object[] = $row;
		  }
		}

       return $result_object;
   }
}

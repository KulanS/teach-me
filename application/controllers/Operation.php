<?php
class Data extends CI_Controller {

  public function __construct() {
    parent::__construct();
    
    $this->load->helper('url');
  }

  public function go_in_service() {
	define('SERVICE_STATUS', '1');
	redirect(base_url(''));
  }

  
}

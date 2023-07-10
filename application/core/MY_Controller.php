<?php
header('Access-Control-Allow-Origin: *'); 
class MY_Controller extends CI_Controller {

    public $login_user;
   
    function __construct() {
        parent::__construct();
		if($this->session->userdata('user_id') != ''){
			$this->load->model('login_model');
			$login_user_id = $this->login_model->login_user_id();
			$this->login_user = (object)$this->login_model->get_access_info($login_user_id);
		}
		else{
			redirect(base_url('login'));
		}
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('login_model');   
	}

	public function index()
	{
		$this->load->view('login');
	}

	
	public function validate_login()
	{
		try {
			$this->form_validation->set_rules('username', 'Username', 'required|numeric|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('userpassword', 'Password', 'required|min_length[5]|max_length[16]');
			if($this->form_validation->run()){
				if($this->input->is_ajax_request()){

					$username = $this->input->post('username');
					$password = $this->input->post('userpassword');

					$check = $this->login_model->login_user($username, hash('sha256', $password));

					if($check){
			            // Store the user profile info into session 
				        $this->session->set_userdata('user_data', $check);
						$this->session->set_userdata('user_id', $check['user_id']);

						echo json_encode(array('status' => true, 'message' => 'Login sucessfully please wait...', 'link' => 'home'));
					}
					else echo json_encode(array('status' => false, 'message' => 'Wrong username or password'));
				}
				else echo json_encode(array('status' => false, 'message' => 'Unauthorised Access'));
			}
			else{
				$validation = $this->form_validation->error_array();
				echo json_encode(array('status' => false, 'message' => implode(',',$validation)));
			}
		}
		catch (Exception $e) {

			$response = ["status" => false, "message" => $e->getMessage()];
			echo json_encode($response);

		}
	}
}

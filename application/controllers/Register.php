<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->load->view('register');
	}

	
	public function user_registration()
	{
		try {
			$this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[2]|max_length[50]|callback_alpha_dash_space');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[2]|max_length[50]|callback_alpha_dash_space');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|numeric|min_length[10]|max_length[10]|callback_check_duplicate_mobile[mobile]');
			$this->form_validation->set_rules('email', 'Email', 'required|min_length[5]|max_length[100]|callback_check_duplicate_email[email]');
			$this->form_validation->set_rules('userpassword', 'Password', 'required|min_length[5]|max_length[16]');

			if($this->form_validation->run()){
				if($this->input->is_ajax_request()){
					$reg_data = [];
					$reg_data['firstname'] 		= $this->input->post('firstname');
					$reg_data['lastname'] 		= $this->input->post('lastname');
					$reg_data['mobile'] 		= $this->input->post('mobile');
					$reg_data['email'] 			= $this->input->post('email');
					$reg_data['password'] 		= hash('sha256', $this->input->post('userpassword'));

					$insert_id = $this->common_model->insert_one("users", $reg_data);

					if($insert_id){
						echo json_encode(array('status' => true, 'message' => 'User Registration sucessfully please wait...', 'link' => base_url().'login'));
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

	public function alpha_dash_space($fullname){
	    if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}

	// My callback function
	public function check_duplicate_email($post_email) {
	    $result = $this->common_model->get_selected_single_data('users', "user_id", ['email' => $post_email]);
	    if (!empty($result)) {
	    	$this->form_validation->set_message('check_duplicate_email', 'This email is already exist. Please write a new email.');
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}
	
	// My callback function
	public function check_duplicate_mobile($post_mobile) {
	    $result = $this->common_model->get_selected_single_data('users', "user_id", ['mobile' => $post_mobile]);
	    if (!empty($result)) {
	    	$this->form_validation->set_message('check_duplicate_mobile', 'This mobile is already exist. Please write a new mobile.');
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}
}

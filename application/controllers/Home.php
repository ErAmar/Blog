<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		if($this->session->flashdata('message')){
			$data['message'] = $this->session->flashdata('message');
 		}
		$data['blogs'] = $this->common_model->get_all_data_column("blog", "blog_id, title, description, 	thumbnail, author, created_date, updated_date", [ "user_id" => $_SESSION['user_id'] ], false, false);

		$this->load->view('home', $data);
	}

	public function logout()
	{
		try {

			$this->session->sess_destroy();
			redirect('home');
			
		}
		catch (Exception $e) {

			$response = ["status" => 500, "message" => $e->getMessage()];
			echo json_encode($response);

		}
	}
}

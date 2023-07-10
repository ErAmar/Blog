<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {

	public function index($id = null)
	{
		$data['blog'] = $this->common_model->get_selected_single_data('blog', "*", ['blog_id' => $id]);
		$this->load->view('create-blog', $data);
	}

	public function delete_blog($id)
	{
		try {
			if($id){
				$blogfound = $this->common_model->get_selected_single_data('blog', "blog_id", ['blog_id' => $id]);
				if(!empty($blogfound)){
					$delete_blog = $this->common_model->delete_where('blog', ['blog_id' => $id]);
					$this->session->set_flashdata('message', 'Blog Deleted Successfully.');
					redirect('home', 'location');
				}
				redirect('home', 'location');
			}
			redirect('home', 'location');
		}
		catch (Exception $e) {
			redirect('home', 'location');
		}
	}

	public function save_blog()
	{
		try {
			$this->form_validation->set_rules('title', 'Title', 'required|min_length[3]|max_length[100]');
			$this->form_validation->set_rules('description', 'Description', 'required|min_length[50]|max_length[500]');

			if (empty($_FILES['thumbnail']['name'][0]))
			{
				if($this->input->post('thumbnailimage') == ''){
			    	$this->form_validation->set_rules('thumbnail', 'Images', 'required');
				}
			}

			if($this->form_validation->run()){
				if($this->input->is_ajax_request()){
					$blog_data = [];
					$blog_id 						= $this->input->post('blog_id');
					$blog_data['user_id'] 			= $_SESSION['user_id'];
					$blog_data['title'] 			= $this->input->post('title');
					$blog_data['description'] 		= $this->input->post('description');
					$blog_data['created_date'] 		= date("Y-m-d H:i:s");
					$thumbnailimage 		= $this->input->post('thumbnailimage');

					if(!empty($_FILES['thumbnail'])){
						$image_result = $this->images_upload($_FILES);
						$blog_data['thumbnail'] 	= (($image_result) ? $image_result['new_filename'] : ( ($thumbnailimage) ? $thumbnailimage : ""));
					}
					else{
						$blog_data['thumbnail'] 	= ($thumbnailimage) ? $thumbnailimage : '';
					}

					if($blog_id != ''){
						$upsert_id = $this->common_model->update_data("blog", $blog_data, [ "blog_id" => $blog_id]);
						$message = "Blog updated sucessfully!";
					}
					else{
						$upsert_id = $this->common_model->insert_one("blog", $blog_data);
						$message = "Blog created sucessfully!";
					}

					if($upsert_id){
						echo json_encode(array('status' => true, 'message' => $message, 'link' => base_url().'home'));
					}
					else echo json_encode(array('status' => false, 'message' => 'Unable to create blog'));
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

	
	public function images_upload($files){

		try {

			//Get the temp file path
			$tmpFilePath = $files['thumbnail']['tmp_name'];

			$filename = basename($files['thumbnail']['name']);
			$ext = substr($filename, strrpos($filename, '.') + 1);

			//Make sure we have a filepath
			if( ( ($ext == "gif") || ($ext == "jpeg")  || ($ext == "jpg")  || ($ext == "png") ) && ( $files["thumbnail"]["size"] < (2*MB) ) ){
				if ($tmpFilePath != ""){

					$new_filename = time()."-".$files['thumbnail']['name'];
					//Setup our new file path
					$newFilePath = "assets/images/blog/".$new_filename;
					//Upload the file into the temp dir
					if(move_uploaded_file($tmpFilePath, $newFilePath)) {
						//Handle other code here
						$image_details = [ 
							"new_filename" => $new_filename,
							"name" => $files['thumbnail']['name'],
							"type" => $files['thumbnail']['type'],
							"tmp_name" => $files['thumbnail']['tmp_name'],
							"size" => $files['thumbnail']['size'],
							"error" => $files['thumbnail']['error']
						];
						return $image_details; //"All Images Uploaded.";
					}
					else{
						return false; 
					}
				}
			}
		}
		catch (Exception $e) {
			$response = ["status" => 500, "message" => $e->getMessage()];
			echo json_encode($response);
        	die;
		}
	}
}

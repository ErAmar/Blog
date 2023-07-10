<?php
class Login_model extends CI_Model
{	
	public function login_user($mobile, $pass){
		$this->db->select("mobile, firstname, lastname, email, user_id, created_date, updated_date");
		$this->db->where("mobile",		$mobile);
		$this->db->where("password",	$pass);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0){
			$result = $query->row_array();
			return $result;
		}
	}

	public function login_user_id(){
        $login_user_id = $this->session->userdata('user_id');
        return $login_user_id ? $login_user_id : false;
    }
	
	public function get_access_info($login_user_id){
		$this->db->select("mobile, firstname, lastname, email, user_id, created_date, updated_date");
		$this->db->where("user_id",$login_user_id);
		$query = $this->db->get('users');
		if ($query->num_rows() > 0)
		{
			$result = $query->row_array();
			return $result;
		}
	}
}

?>
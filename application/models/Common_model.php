<?php
class Common_model extends CI_Model
{	
	public function insert_one($table_name,$data){
		$sql = $this->db->insert($table_name,$data);
		return $sql;
	}

	public function bulk_insert($table_name, $data) {
		$sql = $this->db->insert_batch($table_name,$data);
		return $sql;	
	}
	
	public function get_all_data_column($table_name, $column_name, $where = false, $order_by = false, $order_type = false){
		$this->db->select($column_name);
		(!empty($where)) ? $this->db->where($where) : "";
		if($order_by){
			$this->db->order_by($order_by , $order_type);
		}
		$sql = $this->db->get($table_name);
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}
	
	public function get_all_data($table_name, $order_by = false, $order_type = false){

		if($order_by){
			$this->db->order_by($order_by , $order_type);
		}
		$sql = $this->db->get($table_name);
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}
	
	public function get_where_data($table_name,$where, $column_name = false){
		if($column_name){
			$this->db->select($column_name);
		}
		$sql = $this->db->get_where($table_name,$where);
		if($sql->num_rows() > 0){
			return $sql->row_array();
		}
		else{
			return false;
		}
	}
	
	public function get_where_data_with_or($table_name, $where = false, $or_where = false){
		$this->db->select("*");	
		($where) ? $this->db->where($where) : "";	
		($or_where) ? $this->db->where($or_where) : "";	
		$sql = $this->db->get($table_name);

		if($sql->num_rows() > 0){
			return $sql->row_array();
		}
		else{
			return false;
		}
	}

	public function get_where_data_group_concat($table_name,$col_name,$where){
		$this->db->select('GROUP_CONCAT('.$col_name.') as '.$col_name);
		$sql = $this->db->get_where($table_name,$where);
		if($sql->num_rows() > 0){
			return $sql->row_array();
		}
		else{
			return false;
		}
	}
	
	public function get_where_data_check($table_name,$where){
		$sql = $this->db->get_where($table_name,$where);
		// echo $this->db->last_query();
		if($sql->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function get_where_all_data($table_name, $where=false, $order_by=false, $order_type=false, $columns=false){
		$this->db->select($columns);
		if($where){
			$this->db->where($where);
		}
		if($order_by){
			$this->db->order_by($order_by , $order_type);
		}
		$sql = $this->db->get($table_name);
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}
	
	public function get_where_all_data_limit($table_name,$where,$order_by,$limit,$start){
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
	    $this->db->order_by("$order_by", "desc");
	    $this->db->limit($limit, $start);
		$sql = $this->db->get();
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}
	
	public function update_data($table_name,$data,$where){
		$sql = $this->db->update($table_name,$data,$where);
		return $sql;
	}
	
	public function delete_where($table_name,$where){
		$sql = $this->db->delete($table_name,$where);
		return $sql;
	}
	
	public function get_where_in_data($table_name,$wherein){
		$this->db->where_in('id', $wherein);
		$sql = $this->db->get($table_name);
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}
	
	public function get_where_not_in_data($table_name,$wherein){
		$this->db->where_not_in('id', $wherein);
		$sql = $this->db->get($table_name);
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}
	
	public function get_selected_data($table_name,$columns,$where=false,$limit=false,$start=false,$search=false){
		$this->db->select($columns);
		if($where){
			$this->db->where($where);
		}
		if($limit > 0 && $start >= 0){
        	$this->db->limit($limit, $start);
		}
		if($search){
			$this->db->like('page_heading',$search, 'both');
		}
		$sql = $this->db->get($table_name);
		// echo $this->db->last_query();
		// die();
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}
	
	public function last_inserted_id($table_name,$data){
		$this->db->insert($table_name, $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	
	public function get_count($table_name,$where =false){	
		if($where){
			$this->db->where($where);
		}
		$num_of_rows = $this->db->count_all_results($table_name);
		return $num_of_rows;
	}
	
	public function get_count_in($table_name,$column_val){	
		if($column_val){
			foreach($column_val as $key => $value){
				$this->db->where_in( $key, $value);
			}
		}
		
		$num_of_rows = $this->db->count_all_results($table_name);
		return $num_of_rows;
	}
	
	public function get_sum($table_name, $column_name, $where =false){	
		$this->db->select_sum($column_name);
	    // If Where is not NULL
	    if(!empty($where) && count($where) > 0 )
	    {
	       $this->db->where($where);
	    }

      	$this->db->from($table_name);
        // Return Count Column
		return $this->db->get()->row($column_name);//table_name array sub 0
	}
	
	public function get_selected_more_data($table_name,$columns,$where=false){
		$this->db->select($columns);
		if($where){
			$this->db->where($where);
		}
		$sql = $this->db->get($table_name);
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}
	
	
	public function get_selected_single_data($table_name,$columns,$where=false){
		$this->db->select($columns);
		if($where){
			$this->db->where($where);
		}
		$sql = $this->db->get($table_name);
		if($sql->num_rows() > 0){
			return $sql->row_array();
		}
		else{
			return false;
		}
	}
	
	public function truncate($table){
		$sql = $this->db->truncate($table);
		return $sql;
	}
	
	public function get_where_all_data_join($table_name,$col_name,$join_data,$where = false,$whereOR = false,$order_by = false,$limit = false, $start = false, $join_type = false, $group_by = false){
		$this->db->select($col_name);
		$this->db->from($table_name);
		foreach($join_data as $join_table_name => $on_cond){
			if(!empty($join_type)){
				$this->db->join($join_table_name, $on_cond, $join_type);
			}
			else{
				$this->db->join($join_table_name, $on_cond);
			}
		}
		(!empty($where)) ? $this->db->where($where) : "";
		(!empty($whereOR)) ? $this->db->where($whereOR) : "";
		(!empty($group_by)) ? $this->db->group_by($group_by) : "";

		if (is_array($order_by)){
			$order_clause = implode(", ", $order_by);
			$this->db->order_by($order_clause);
		}
		else{
			$this->db->order_by($order_by, "desc");
		}

	    (!empty($limit)) ? $this->db->limit($limit, $start) : "";
		$sql = $this->db->get();
		
		if($sql->num_rows() > 0){
			return $sql->result_array();
		}
		else{
			return false;
		}
	}

	public function get_count_join($table_name, $join_table, $on_cond, $where = false)
	{
		$this->db->join($join_table, $on_cond);
	   	($where) ? $this->db->where($where) : "";
	   	return $this->db->count_all_results($table_name);
	}

	public function getPincodeData($pincode)
	{
		$this->db->select('pm.pin_code, pm.area_name, cm.name as city_name, sm.name as state_name, com.name as country_name');
		$this->db->from('pincode_master pm');
		$this->db->join('state_master sm', 'sm.state_id = pm.state_id');
		$this->db->join('city_master cm', 'cm.city_id = pm.city_id');
		$this->db->join('country_master com', 'com.country_id = sm.country_id');
		$this->db->where('pm.pin_code', $pincode);
		$sql = $this->db->get();
		if($sql->num_rows() > 0) {
			return $sql->row_array();
		} else {
			return [];
		}
	}
}

?>
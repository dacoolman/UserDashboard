<?php
class DashboardModel extends CI_MODEL{
	
	function select_users(){
		return $this->db->query("select * from users;")->result_array();
	}

	function select_userid($id){
		$query = "select * from users where id = ?;";
		$values = array($id);
		return $this->db->query($query, $values)->row_array();
	}

	function delete_userid($id){
		$query = "delete from comments where user_id = ?;";
		$values = array($id);
		$this->db->query($query, $values);
		$query = "delete from messages where user_id = ?;";
		$this->db->query($query, $values);
		$query = "delete from users where id = ?;";
		$this->db->query($query, $values);
	}
}
?>
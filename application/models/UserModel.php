<?php


class UserModel extends CI_Model
{

	public function login($username,$password){
		$this->db->where(array("username"=>$username,"password"=>$password));
		$user = $this->db->get('users');
		return $user->row_array();
	}
	public function getUsers(){
		$user = $this->db->get('users');
		return $user->result_array();
	}
	public function getUser($id){
		$this->db->where('user_id',$id);
		$user = $this->db->get('users');
		return $user->row_array();
	}
	public function upStatus($id,$status){
		$this->db->set(array('status'=>$status));
		$this->db->where('user_id',$id);
		$this->db->update('users');
	}
	public function insertuser()
	{
		$fristname= $this->input->post('frist_name');
		$lastname = $this->input->post('last_name');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$type_user = $this->input->post('type_user');
		$data = array(
			'first_name' => $fristname,
			'last_name' => $lastname,
			'username' => $username,
			'password'=>$password,
			'type_user'=>$type_user
		);
		// print_r($data);
		$this->db->insert('users',$data);
    return $this->db->insert_id();
	}

	public function updat(){
		$fristname= $this->input->post('frist_name');
		$lastname = $this->input->post('last_name');
		$username = $this->input->post('username');
		$id = $this->input->post('id');
		$type_user = $this->input->post('type_user');
		$data = array(
			'first_name' => $fristname,
			'last_name' => $lastname,
			'username' => $username,
			'type_user'=>$type_user
		);
		$this->db->set($data);
		$this->db->where('user_id',$id);
		$this->db->update('users');
	}
	public function move(){
		$this->db->where('user_id',$this->session->userdata("user_id"));
		$this->db->set(["move"=>1]);
		$this->db->update("users");
	}
	public function delet($id){
		$move = $this->db->get_where("users",['user_id'=>$id])->row_array()['move'];
		if($move == 1){
			return 2;
		}else{
			return $this->db->delete('users', array('user_id' => $id));
		}
	}
}


?>
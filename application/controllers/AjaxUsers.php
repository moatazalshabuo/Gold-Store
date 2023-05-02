<?php

class AjaxUsers extends CI_Controller
{
	public function ShowUsers()
	{
		$result = $this->UserModel->getUsers();

		foreach ($result as $value) {
			echo "<tr>
			  	<td><input type='radio' class='use' name='check' value='$value[user_id]'></td>
			    <td>$value[first_name] $value[last_name]</td>
			    <td>$value[username]</td>
			  </tr>";
		}
	}
	public function datauser()
	{
		$id = $this->input->post('id');
		// echo $id;
		$result = $this->UserModel->getUser($id);
		if ($result['type_user'] == 0) :
			$type = "مسؤوول";
		elseif ($result['type_user'] == 1) :
			$type = "ادارة ";
		elseif ($result['type_user'] == 2) :
			$type = "مبيعات";
		endif;
		echo '<li class="list-group-item">الاسم : <span id="fullname">' . $result['first_name'] . ' ' . $result['last_name'] . '</span></li>
			  <li class="list-group-item">اسم المستخدم : <span id="username">' . $result['username'] . '</span></li>
			  
			  <li class="list-group-item">نوع المستخدم : <span>' . $type . '</span></li>';

		echo ($result['status'] == 0) ? "<li class='list-group-item'>الحالة : <span>غير مفعل</span></li><li class='list-group-item'>
			  <button class='btn btn-info m-1 status' data-status=1 id=$result[user_id]>تفعيل</button>" : "<li class='list-group-item'>الحالة : <span>مفعل</span></li><li class='list-group-item'>
			  <button class='btn btn-info m-1 status' data-status=0 id=$result[user_id]>غير مفعل</button>";

		echo '<button class="btn btn-danger m-1 dele" id=' . $result['user_id'] . '>حذف</button><button class="btn btn-warning m-1 update" data-toggle="modal" data-target="#update" id=' . $result['user_id'] . '>تعديل</button> </li>';
	}
	public function active()
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		// echo $id . ' '.$status;
		$this->UserModel->upStatus($id, $status);
		return TRUE;
	}
	public function addUser()
	{

		$this->form_validation->set_rules('frist_name', "الاسم الاول", "required");
		$this->form_validation->set_rules('last_name', "الاسم الاخير", "required");
		$this->form_validation->set_rules('username', "اسم المستخدم", "required|is_unique[users.username]");
		$this->form_validation->set_rules('password', "كلمة المرور", "required");
		$this->form_validation->set_rules('type_user', 'نوع المستخدم ', "required");

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			if ($this->UserModel->insertuser() > 0) :
				echo 1;
			else :
				echo "يوجد خطاء في الادخال";
			endif;
		}
	}

	public function getData_up()
	{
		$id = $this->input->post('id');
		echo json_encode($this->UserModel->getUser($id));
	}
	public function updata_data()
	{
		$id = $this->input->post('id');
		$user = $this->UserModel->getUser($id);
		$uniq = "";
		if ($user['username'] != $this->input->post('username')) {
			$uniq = "|is_unique[users.username]";
		}
		$this->form_validation->set_rules('frist_name', "الاسم الاول", "required");
		$this->form_validation->set_rules('last_name', "الاسم الاخير", "required");
		$this->form_validation->set_rules('username', "اسم المستخدم", "required$uniq");
		$this->form_validation->set_rules('type_user', 'نوع المستخدم ', "required");
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$this->UserModel->updat();
			echo '1';
		}
	}
	public function delete_user($id)
	{
		// $id = $this->input->post('id');
		echo $this->UserModel->delet($id);
	}
}

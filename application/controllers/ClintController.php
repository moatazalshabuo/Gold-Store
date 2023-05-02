<?php

class ClintController extends CI_Controller
{
	public function addClint()
	{
		$this->form_validation->set_rules("name", "الاسم", "required");
		$this->form_validation->set_rules("phone", "قم الهاتف ", "required|is_unique[client.phone_number]");
		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$this->ClintModel->insertClint();
			echo 1;
		}
	}
	public function get_clint()
	{
		$cous = isset($_GET['custm']) ? $_GET['custm'] : "";
		// echo $cous;
		$data = $this->ClintModel->clints();
		$sele = (!empty($cous) && $cous == '10000007') ? "selected" : "";
		echo "<option value=''>عملاء </option>
		<option $sele value='10000007'>كسر</option>
		";

		foreach ($data as $item) {
			$sele = (!empty($cous) && $cous == $item['client_id']) ? "selected" : "";
			echo "<option $sele value=" . $item['client_id'] . ">" . $item['name'] . " - " . $item['phone_number'] . "</option>";
		}
	}

	public function ShowClient()
	{
		$client = $this->ClintModel->clints();
		foreach ($client as $value) {
			echo "<tr>
			  	<td><input type='radio' class='use' name='check' value='$value[client_id]'></td>
			    <td>$value[name]</td>
			    <td>$value[phone_number]</td>
			  </tr>";
		}
	}


	public function dataclient()
	{
		$id = $this->input->post('id');

		$result = $this->ClintModel->clint($id);

		echo '<li class="list-group-item">الاسم : <span id="fullname">' . $result['name'] . ' </span></li>
			  <li class="list-group-item">رقم الهاتف : <span id="username">' . $result['phone_number'] . '</span></li>';
		echo '<button class="btn btn-danger m-1 dele" id=' . $result['client_id'] . '>حذف</button><button class="btn btn-warning m-1 update" data-toggle="modal" data-target="#update" id=' . $result['client_id'] . '>تعديل</button> </li>';
	}
	public function getdataup()
	{
		$id = $this->input->post('id');
		echo json_encode($this->ClintModel->clint($id));
	}

	public function updata_data()
	{
		$id = $this->input->post('id');
		$user = $this->ClintModel->clint($id);
		$uniq = "";
		if ($user['phone_number'] != $this->input->post('phone')) {
			$uniq = "|is_unique[client.phone_number]";
		}
		$this->form_validation->set_rules('name', "الاسم ", "required");
		$this->form_validation->set_rules('phone', "رقم الهاتف", "required$uniq");

		if ($this->form_validation->run() == FALSE) {
			echo validation_errors();
		} else {
			$this->ClintModel->updat();
			echo '1';
		}
	}

	public function delete_client($id)
	{
		// $id = $this->input->post('id');
		echo $this->ClintModel->delete_client($id);
	}

	public function client()
	{
		$this->load->view('include/header');
		$this->load->view('clients/clients');
		$this->load->view('include/footer');
		$this->load->view('clients/ajax.php');
	}
}

<?php

class ClintModel extends CI_Model
{

	public function insertClint()
	{
		$name = $this->input->post("name");
		$phone = $this->input->post("phone");
		$this->db->insert("client", ['name' => $name, "phone_number" => $phone]);
	}
	public function clints()
	{
		return $this->db->get("client")->result_array();
	}
	public function clint($id)
	{
		$this->db->where('client_id', $id);
		return $this->db->get("client")->row_array();
	}

	public function updat(){

		$fristname= $this->input->post('name');
		$lastname = $this->input->post('phone');
		$id = $this->input->post('id');
		$data = array(
			'name' => $fristname,
			'phone_number' => $lastname,
		);
		$this->db->set($data);
		$this->db->where('client_id',$id);
		$this->db->update('client');
	}

	public function delete_client($id){
		$prus = $this->db->get_where("purchases",['client'=>$id])->num_rows();
		if($prus > 0){
			return 2;
		}else{
			return $this->db->delete('client', array('client_id' => $id));
		}
	}

	public function up($insert, $id)
	{
		$this->db->set($insert);
		$this->db->where("client_id", $id);
		$this->db->update("client");
		// $this->db->insert("exchange_receipt",$insert_ex);
	}
	public function insert_ex_db($insert_ex)
	{
		$this->db->insert("exchange_receipt", $insert_ex);
		return $this->db->insert_id();
	}
	public function getstack()
	{
		return isset($this->db->get("cash_stock")->row_array()['value_total']) ? $this->db->get("cash_stock")->row_array()['value_total'] : 0;
	}
	public function up_val($value)
	{
		$chash = $this->db->get("cash_stock")->row_array()['value_total'];
		$this->db->set(['value_total' => $chash - $value]);
		$this->db->where('id', 1);
		$this->db->update("cash_stock");
	}
	public function up_val_add($value)
	{
		$chash = $this->db->get("cash_stock")->row_array()['value_total'];
		$this->db->set(['value_total' => $chash + $value]);
		$this->db->where('id', 1);
		$this->db->update("cash_stock");
	}
	public function up_stack($vari, $vari_id)
	{
		$current_val = $this->VarietiesModel->get_qu($vari_id)['Quantity'];
		$this->db->set(['Quantity' => ($current_val - $vari)]);
		$this->db->where('varieties_id', $vari_id);
		$this->db->update("varieties");
	}
	public function up_stack_add($vari, $vari_id)
	{
		$current_val = $this->VarietiesModel->get_qu($vari_id)['Quantity'];
		$this->db->set(['Quantity' => ($current_val + $vari)]);
		$this->db->where('varieties_id', $vari_id);
		$this->db->update("varieties");
	}
	public function get_ex($id)
	{
		$this->db->where($id);
		return $this->db->get("exchange_receipt")->result_array();
	}

	public function delete_ex($id)
	{
		// $this->db->where("used_id",$id);
		$this->db->delete("exchange_receipt", array("used_id" => $id));
	}


	public function search_exc($client = "", $date = "")
	{
		$this->db->select("exchange_receipt.*,users.username");
		if (!empty($client)) {
			$this->db->where('client_id', $client);
		}
		if (!empty($date)) {
			$this->db->where('cr_at >=', $date['0']);
			$this->db->where('cr_at <=', $date['1']);
		}
		$this->db->join("users", "users.user_id = exchange_receipt.cr_by", "left");
		return $this->db->get("exchange_receipt")->result_array();
	}


	public function search_exc_1($client = "", $date = "")
	{
		$this->db->select("exchange_receipt.*,users.username,client.name");
		if (!empty($client)) {
			$this->db->where('type', $client);
		}
		if (!empty($date)) {
			$this->db->where('cr_at >=', $date['0']);
			$this->db->where('cr_at <=', $date['1']);
		}
		$this->db->join("users", "users.user_id = exchange_receipt.cr_by", "left");
		$this->db->join("client","client.client_id = exchange_receipt.client_id","left");
		return $this->db->get("exchange_receipt")->result_array();
	}


	public function client_account($client = "", $date = "")
	{
		$this->db->select("purchases.*,users.username");
		if (!empty($client)) {
			$this->db->where('client', $client);
		}
		if (!empty($date)) {
			$this->db->where('cr_at >=', $date['0']);
			$this->db->where('cr_at <=', $date['1']);
		}
		$this->db->join("users", "users.user_id = purchases.cr_by", "left");
		return $this->db->get("purchases")->result_array();
	}

	public function getexports($from = "", $to = "")
	{
		$data = array();

		$this->db->select("sum(totel_value) as totel");
		if (!empty($from) && !empty($to)) {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}
		// $this->db->where("type);
		$data['totel_export1'] = $this->db->get("exchange_receipt")->row_array()["totel"];

		$this->db->select("sum(value_clint) as totel");

		if (!empty($from) && !empty($to)) {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}

		$this->db->where(["client"=>10000007,"status"=>0]);

		$data['totel_export2'] = $this->db->get("purchases")->row_array()["totel"];

		$data['totel'] = $data['totel_export1'] + $data['totel_export2'];

		return $data;
	}

	public function getimport($from = "", $to = "")
	{
		$data = array();

		$this->db->select("sum(Total_value) as totle");

		if (!empty($from) && !empty($to)) {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}
		$this->db->where("status",0);

		$data['totel_sales'] = $this->db->get("sales_bill")->row_array()['totle'];

		$this->db->select("sum(value) as totle");

		if (!empty($from) && !empty($to)) {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}
		

		$data['totel_deposit'] = $this->db->get("deposit")->row_array()['totle'];


		$data['totel'] = $data["totel_deposit"] + $data['totel_sales'];

		return $data;
	}

	public function getoldimport($from = "", $to = "")
	{
		$this->db->select("sum(purchasing_items.Quantity) as Quantity,varieties.caliber");
		$this->db->join("varieties", "varieties.varieties_id = purchasing_items.varieties_id");

		if (!empty($from) && !empty($to)) {
			$this->db->where('purchasing_items.cr_at >=', $from);
			$this->db->where('purchasing_items.cr_at <=', $to);
		}

		$this->db->where("varieties.type_varie", 2);
		$this->db->group_by('varieties.caliber');
		$res1 = $this->db->get("purchasing_items")->result_array();


		$this->db->select("sum(barren.Quantity) as Quantity,varieties.caliber");
		$this->db->join("varieties", "varieties.varieties_id = barren.varieties_id");

		if (!empty($from) && !empty($to)) {
			$this->db->where('barren.cr_at >=', $from);
			$this->db->where('barren.cr_at <=', $to);
		}

		$this->db->where("varieties.type_varie", 2);
		$this->db->group_by('varieties.caliber');
		$res2 = $this->db->get("barren")->result_array();

		return array($res1, $res2);
	}

	public function getoldexport($from = "", $to = "")
	{

		$this->db->select("sum(sales_items.Quantity) as Quantity,varieties.caliber");
		$this->db->join("varieties", "varieties.varieties_id = sales_items.varieties_id");

		if (!empty($from) && !empty($to)) {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}

		$this->db->where("varieties.type_varie", 2);
		$this->db->group_by('varieties.caliber');
		$res1 = $this->db->get("sales_items")->result_array();

		$this->db->select("sum(exchange_receipt.Quantity) as Quantity,varieties.caliber");
		$this->db->join("varieties", "varieties.varieties_id = exchange_receipt.varieties_id");

		if (!empty($from) && !empty($to)) {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}

		$this->db->where("varieties.type_varie", 2);
		$this->db->group_by('varieties.caliber');
		$res2 = $this->db->get("exchange_receipt")->result_array();

		return array($res1, $res2);
	}


	public function getnewimport($from = "", $to = "")
	{
		$this->db->select("sum(purchasing_items.Quantity) as Quantity,varieties.caliber");
		$this->db->join("varieties", "varieties.varieties_id = purchasing_items.varieties_id");

		if (!empty($from) && !empty($to)) {
			$this->db->where('purchasing_items.cr_at >=', $from);
			$this->db->where('purchasing_items.cr_at <=', $to);
		}

		$this->db->where("varieties.type_varie", 1);
		$this->db->group_by('varieties.caliber');
		$res1 = $this->db->get("purchasing_items")->result_array();
		//==========================================
		$this->db->select("sum(barren.Quantity) as Quantity,varieties.caliber");
		$this->db->join("varieties", "varieties.varieties_id = barren.varieties_id");

		if (!empty($from) && !empty($to)) {
			$this->db->where('barren.cr_at >=', $from);
			$this->db->where('barren.cr_at <=', $to);
		}

		$this->db->where("varieties.type_varie", 1);
		$this->db->group_by('varieties.caliber');
		$res2 = $this->db->get("barren")->result_array();
		return array($res1, $res2);
	}

	public function getnewexport($from = "", $to = "")
	{

		$this->db->select("sum(sales_items.Quantity) as Quantity,varieties.caliber");
		$this->db->join("varieties", "varieties.varieties_id = sales_items.varieties_id");

		if (!empty($from) && !empty($to)) {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}

		$this->db->where("varieties.type_varie", 1);
		$this->db->group_by('varieties.caliber');
		$res1 = $this->db->get("sales_items")->result_array();

		return $res1;
	}
}

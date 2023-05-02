<?php


class VarietiesModel extends CI_Model
{

	//============================
	public function show_data($where = '')
	{
		if ($where != '') {
			$this->db->where($where);
		}
		//$this->db->where('id', $user_id);
		$query = $this->db->get('varieties');
		return $query->result_array();
	}
	public function show_row($where = "")
	{
		$this->db->like('varieties_name', $where);
		$query = $this->db->get('varieties');
		return $query->row_array();
	}
	//============================
	public function additem()
	{
		$var = $this->VarietiesModel->show_row($this->input->post('varieties_name') . " " . $this->input->post('caliber'));
		if (empty($var['varieties_name'])) {
			$insert = array(
				'varieties_name' => $this->input->post('varieties_name') . " " . $this->input->post('caliber'),
				'caliber' => $this->input->post('caliber'),
				"type_varie" => $this->input->post('type')
			);
			$this->db->insert('varieties', $insert);
			return $this->db->insert_id();
		} else {
			return "الصنف موجود مسبقا";
		}
	}

	public function get_qu($id)
	{
		$this->db->where('varieties_id', $id);
		$query = $this->db->get('varieties');
		return $query->row_array();
	}
	public function update($data, $id)
	{
		$this->db->set($data);
		$this->db->where('varieties_id', $id);
		$this->db->update("varieties");
	}
	public function dele($value)
	{
		$this->db->delete("varieties", array('varieties_id' => $value));
	}
	// public function ed_q($id,$q)
	public function report_sales($id, $from = "", $to = "")
	{
		$this->db->where('varieties_id', $id);
		if ($from != "" && $to != "") {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}
		return $this->db->get("sales_items")->result_array();
	}
	public function report_purs($id, $from = "", $to = "")
	{
		$this->db->where('varieties_id', $id);
		if ($from != "" && $to != "") {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}
		return $this->db->get("purchasing_items")->result_array();
	}
	public function report_exchange($id, $from = "", $to = "")
	{
		$this->db->where('varieties_id', $id);
		if ($from != "" && $to != "") {
			$this->db->where('cr_at >=', $from);
			$this->db->where('cr_at <=', $to);
		}
		return $this->db->get("exchange_receipt")->result_array();
	}
	public function addvari($qu,$id){
		$old_q = $this->db->get_where("varieties",['varieties_id'=>$id])->row_array()['Quantity'];
		$this->db->set(array('Quantity'=>$old_q+$qu));
		$this->db->where('varieties_id',$id);
		$this->db->update('varieties');
	}
	public function minvari($qu,$id){
		$old_q = $this->db->get_where("varieties",['varieties_id'=>$id])->row_array()['Quantity'];
		$this->db->set(array('Quantity'=>$old_q-$qu));
		$this->db->where('varieties_id',$id);
		$this->db->update('varieties');
	}
	public function store_barren()
	{
		$vari_id = $this->input->post('vari_id');
		$Quantity = $this->input->post("Quantity");
		$var = $this->VarietiesModel->addvari($Quantity,$vari_id);
		$this->db->insert(
			"barren",
			[
				'varieties_id' => $vari_id,
				"Quantity" => $Quantity,
				"cr_by" => $this->session->userdata('user_id')
			]
		);
		return 1;
	}
	public function show_barren()
	{
		$this->db->select("barren.*,varieties.varieties_name,CONCAT(users.first_name,' ',users.last_name) as user");
		$this->db->join("varieties","varieties.varieties_id = barren.varieties_id");
		$this->db->join("users","users.user_id = barren.cr_by","left");
		return  $this->db->get("barren")->result_array();
	}
	public function delete_barren($value)
	{
		$vare = $this->db->get_where("barren",['id'=>$value])->row_array();
		$this->VarietiesModel->minvari($vare['Quantity'],$vare['varieties_id']);
		$this->db->delete("barren", array('id' => $value));
	}
}

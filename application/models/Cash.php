<?php


class Cash extends CI_Model
{

	public function add_to_cash($value)
	{
		$row = $this->db->get('cash_stock');
		if ($row->num_rows() > 0) {
			$result = $row->row_array();
			$this->db->set(array('value_total' => ($result['value_total'] + $value)));
			$this->db->where("id", 1);
			$this->db->update("cash_stock");
		} else {
			$this->db->insert('cash_stock', array('id' => 1, 'value_total' => $value));
		}
	}
	public function remove_from_cash($value)
	{
		$row = $this->db->get('cash_stock');
		$result = $row->row_array();
		$this->db->set(array('value_total' => ($result['value_total'] - $value)));
		$this->db->where("id", 1);
		$this->db->update("cash_stock");
	}

	public function store_deposit()
	{
		$descripe = $this->input->post('descripe');
		$value = $this->input->post("value");
		// $var = $this->VarietiesModel->addvari($Quantity);
		$this->Cash->add_to_cash($value);
		$this->db->insert(
			"deposit",
			[
				'descripe' => $descripe,
				"value" => $value,
				"cr_by" => $this->session->userdata('user_id')
			]
		);
		return 1;
	}
	public function show_barren()
	{
		$this->db->select("deposit.*,CONCAT(users.first_name,' ',users.last_name) as user");
		$this->db->join("users", "users.user_id = deposit.cr_by","left");
		return  $this->db->get("deposit")->result_array();
	}
	public function delete_deposit($value)
	{
		$vare = $this->db->get_where("deposit", ['id' => $value])->row_array();
		$this->Cash->remove_from_cash($vare['value']);
		$this->db->delete("deposit", array('id' => $value));
	}
}

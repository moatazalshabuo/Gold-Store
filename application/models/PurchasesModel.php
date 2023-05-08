<?php


class PurchasesModel extends CI_Model
{

	public function get_bill_i()
	{
		$this->db->order_by('id_bill', 'DESC');
		$this->db->limit(1);
		$result = $this->db->get("purchases");
		return $result->row_array();
	}

	public function get_bill($id = "")
	{
		if ($id != "") {
			$this->db->where(array("id_bill" => $id));
			$result = $this->db->get("purchases");
			if ($result->num_rows() > 0) {
				return $result->row_array();
			} else {
				return $this->PurchasesModel->get_bill_i();
			}
		} else {
			return $this->PurchasesModel->get_bill_i();
		}
	}
	public function get_numItem($id)
	{
		$this->db->select("id_bill");
		return $this->db->get('purchases')->result_array();
	}
	public function create_bill()
	{
		$this->db->insert('purchases', array('cr_at' => date("Y-m-d h:i:s"), 'cr_by' => $this->session->userdata('user_id')));
		return $this->db->insert_id();
	}
	public function up_to_bil($id)
	{
		$this->db->select('SUM(value_total) as `to`,SUM(Quantity) as `q`,SUM(after_trans) as `after`');
		$this->db->where('id_bill', $id);
		$result = $this->db->get('purchasing_items');
		$row = $result->row_array();
		$this->db->set(array('value_clint' => $row['to'], "Quantity" => $row['q'], "After_trans" => $row['after']));
		$this->db->where('id_bill', $id);
		$this->db->update('purchases');
	}

	public function inser_item()
	{

		$id_bill = $this->input->post('id_bill');

		$descr = $this->input->post('varieties');
		$price = $this->input->post('price');
		$qwant = $this->input->post('qwant');
		// $total = 0;
		$total = round(($price * $qwant), 2);
		$vari = $this->VarietiesModel->show_data(array("varieties_id" => $descr))[0];
		if ($vari['caliber'] != 18) {
			$after = $qwant * $vari['caliber'] / 18;
		} else {
			$after = $qwant;
		}
		$data = array(
			"id_bill" => $id_bill,
			'after_trans' => $after,
			'cr_by' => $this->session->userdata('user_id'),
			'value_total' => $total,
			'value_gram' => $price,
			'Quantity' => $qwant,
			"varieties_id" => $descr,
			"cr_at" => date('Y-m-d h:i:s')
		);
		$n = $this->db->insert("purchasing_items", $data);


		$this->VarietiesModel->update(array('Quantity' => ($vari['Quantity'] + $qwant)), $descr);
		$this->PurchasesModel->up_to_bil($id_bill);
		return $n;
	}

	public function get_prod($id)
	{
		$this->db->select('varieties.varieties_name,varieties.caliber,purchasing_items.*,users.first_name');
		$this->db->join('varieties', "purchasing_items.varieties_id = varieties.varieties_id");
		$this->db->join('users', "users.user_id = purchasing_items.cr_by","left");
		$this->db->where('purchasing_items.id_bill', $id);
		$result = $this->db->get("purchasing_items");
		return $result->result_array();
	}

	public function get_item($id)
	{
		$this->db->where("id", $id);
		return $this->db->get('purchasing_items')->row_array();
	}

	public function delete_item($id)
	{
		$row = $this->PurchasesModel->get_item($id);
		$this->db->delete("purchasing_items", array('id' => $id));
		$vari = $this->VarietiesModel->show_data(array("varieties_id" => $row['varieties_id']))[0];
		$this->VarietiesModel->update(array('Quantity' => ($vari['Quantity'] - $row['Quantity'])), $row['varieties_id']);
		$this->PurchasesModel->up_to_bil($row['id_bill']);
	}
	public function get_id_v($id)
	{
		$this->db->where("id", $id);
		$q = $this->db->get("purchasing_items");
		return $q->row_array()['varieties_id'];
	}
	public function close_bill($id, $type,$cust, $where)
	{
		$this->db->set(array('status' => 0, "client" => $cust,"type_price"=>$type));
		$this->db->where('id_bill', $id);
		$this->db->update("purchases");
		if ($cust != "10000007") {
			
			$this->db->set($where);
			$this->db->where("client_id", $cust);
			$this->db->update("client");
		}else{
			$this->Cash->remove_from_cash($where['value']);
		}
	}
	public function edit_bill($id, $cust, $where)
	{
		$this->db->set(array('status' => 1));
		$this->db->where('id_bill', $id);
		$this->db->update("purchases");
		if ($cust != "10000007") {
		$this->db->set($where);
		$this->db->where("client_id", $cust);
		$this->db->update("client");
		}else{
			$this->Cash->add_to_cash($where['value']);
		}
	}
}

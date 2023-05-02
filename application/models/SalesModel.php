<?php

class SalesModel extends CI_Model
{

	public function get_bill_i()
	{
		if ($this->session->userdata('type_user') != 0) {
			$this->db->where(array("cr_py" => $this->session->userdata('user_id')));
			$this->db->order_by('sales_id', 'DESC');
		} elseif ($this->session->userdata('type_user') == 0) {
			$this->db->order_by('sales_id', 'DESC');
		}
		$this->db->limit(1);
		$result = $this->db->get("sales_bill");
		return $result->row_array();
	}

	public function get_bill($id = "")
	{
		if ($id != "") {
			if ($this->session->userdata('type_user') != 0) {
				$this->db->where(array("cr_py" => $this->session->userdata('user_id'), "sales_id" => $id));
				$result = $this->db->get("sales_bill");
				if ($result->num_rows() > 0) {
					return $result->row_array();
				} else {
					return $this->SalesModel->get_bill_i();
				}
			} elseif ($this->session->userdata('type_user') == 0) {
				$this->db->where(array("sales_id" => $id));
				$result = $this->db->get("sales_bill");
				if ($result->num_rows() > 0) {
					return $result->row_array();
				} else {
					return $this->SalesModel->get_bill_i();
				}
			}
		} else {
			return $this->SalesModel->get_bill_i();
		}
	}

	public function get_numItem($id)
	{
		$this->db->select("sales_id");
		if ($this->session->userdata('type_user') != 0) {
			$this->db->where("cr_py", $this->session->userdata('user_id'));
		}
		return $this->db->get('sales_bill')->result_array();
	}

	public function create_bill()
	{
		
		$this->db->insert('sales_bill', array('cr_at' => date("Y-m-d h:i:s"), 'cr_py' => $this->session->userdata('user_id')));
		return $this->db->insert_id();
	}
	
	public function close_bill($id, $cust)
	{
		// $cust = $this->input->post("custm");
		$this->db->set(array('status' => 0, "customer" => $cust));
		$this->db->where('sales_id', $id);
		$this->db->update("sales_bill");
	}
	public function edit_bill($id)
	{
		$this->db->set(array('status' => 1));
		$this->db->where('sales_id', $id);
		$this->db->update("sales_bill");
	}
	public function get_prod($id)
	{
		$this->db->select('varieties.varieties_name,varieties.caliber,sales_items.*,users.first_name');
		$this->db->join('varieties', "sales_items.varieties_id = varieties.varieties_id");
		$this->db->join('users', "users.user_id = sales_items.cr_by","left");
		$this->db->where('sales_items.sales_id', $id);
		$result = $this->db->get("sales_items");
		return $result->result_array();
	}

	public function inser_item()
	{
		if ($this->VarietiesModel->show_data(array("varieties_id" => $this->input->post('state')))[0]['Quantity'] >= $this->input->post('qwant')) {
			$sales_id = $this->input->post('sales_id');
			$descr = $this->input->post('state');
			$price = $this->input->post('price');
			$qwant = $this->input->post('qwant');
			// $total = 0;
			$total = round(($price * $qwant), 2);
			$desc = !empty($this->input->post('des')) ? $this->input->post('des') : 0;
			if ($desc != 0) {
				$total = $total - $desc;
				$price = round($total / $qwant, 2);
			}
			$data = array(
				"sales_id" => $sales_id,
				'descount' => $desc,
				'cr_by' => $this->session->userdata('user_id'),
				'totel_value' => $total,
				'price_gram' => $price,
				'Quantity' => $qwant,
				"varieties_id" => $descr,
				'descripe'=>$this->input->post("descripe"),
			);
			$n = $this->db->insert("sales_items", $data);

			$vari = $this->VarietiesModel->show_data(array("varieties_id" => $descr))[0];
			$this->VarietiesModel->update(array('Quantity' => ($vari['Quantity'] - $qwant)), $descr);
			$this->SalesModel->up_to_bil($sales_id);
			return $n;
		} else {
			return "الكمية اكبر من الموجود في المخزن";
		}
	}
	public function up_to_bil($id)
	{
		$this->db->select('SUM(totel_value) as `to`,SUM(Quantity) as `q`');
		$this->db->where('sales_id', $id);
		$result = $this->db->get('sales_items');
		$row = $result->row_array();
		$this->db->set(array('Total_value' => $row['to'], "Quantity" => $row['q']));
		$this->db->where('sales_id', $id);
		$this->db->update('sales_bill');
	}
	public function get_item($id)
	{
		$this->db->where("id", $id);
		return $this->db->get('sales_items')->row_array();
	}
	public function delete_item($id)
	{
		$row = $this->SalesModel->get_item($id);
		$this->db->delete("sales_items", array('id' => $id));
		$vari = $this->VarietiesModel->show_data(array("varieties_id" => $row['varieties_id']))[0];
		$this->VarietiesModel->update(array('Quantity' => ($vari['Quantity'] + $row['Quantity'])), $row['varieties_id']);
		$this->SalesModel->up_to_bil($row['sales_id']);
	}
	// public function get_items{}
}

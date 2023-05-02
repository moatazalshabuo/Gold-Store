<?php


class SalesCon extends CI_Controller
{
	public function salesbill($id = "")
	{
		$data = array();
		$data['databill'] = $this->SalesModel->get_bill($id);
		if ($data['databill']) {
			if ($data['databill']['sales_id']) {
				$index = array();
				foreach ($this->SalesModel->get_numItem($data['databill']['sales_id']) as $val) {
					array_push($index, $val['sales_id']);
				}
				$current = array_search($data['databill']['sales_id'], $index);
				$data['next'] = isset($index[$current + 1]) ? $index[$current + 1] : "";
				$data['prev'] = isset($index[$current - 1]) ? $index[$current - 1] : "";
			}
		}
		$data['varieties'] = $this->VarietiesModel->show_data(array('Quantity >' => 0));
		
		$this->load->view('include/header');
		$this->load->view('sales/salesbill', $data);
		$this->load->view('include/footer');
		$this->load->view('sales/ajax');
	}

	public function new_bill()
	{
		$this->UserModel->move();
		$id = $this->SalesModel->create_bill();
		redirect("SalesCon/salesbill/$id");
	}



	public function closeBill($value, $coust)
	{
		$row = $this->SalesModel->get_bill($value);
		if ($row['Total_value'] > 0) {
			$this->SalesModel->close_bill($value, $coust);

			$this->Cash->add_to_cash($row['Total_value']);
			redirect("SalesCon/salesbill/$value");
		}
		redirect("SalesCon/salesbill/$value");
	}




	public function editBill($value)
	{
		$this->SalesModel->edit_bill($value);
		$row = $this->SalesModel->get_bill($value);
		$this->Cash->remove_from_cash($row['Total_value']);
		redirect("SalesCon/salesbill/$value");
	}


	public function insertitem()
	{
		$row = $this->SalesModel->get_bill($this->input->post('sales_id'));
		if ($row['status'] == 1) {
			$this->form_validation->set_rules("state", "اسم الصنف", "required|numeric");
			$this->form_validation->set_rules("qwant", "الكمية", "required");
			$this->form_validation->set_rules("price", "السعر", "required");

			if ($this->form_validation->run() == FALSE) {
				echo validation_errors();
			} else {
				echo $this->SalesModel->inser_item();
			}
		} else {
			echo "الفاتورة مغلقة لايمكن الاضافة";
		}
	}

	public function get_items($id)
	{
		foreach ($this->SalesModel->get_prod($id) as $val) {
			echo "<tr>
					<td><input type='checkbox' value=$val[id] class='control'></td>
                  <td scope='row'>$val[descripe] - $val[varieties_name]</td>
                  <td>$val[caliber]</td>
                  <td>$val[Quantity]</td>
                  <td>$val[price_gram]</td>
                  <td>$val[totel_value]</td>
                  <td>$val[cr_at]</td>
                </tr>";
		}
	}



	public function totals($id)
	{
		echo json_encode($this->SalesModel->get_bill($id));
	}



	public function delete_item()
	{
		$data = explode(',', $this->input->post('ids'));
		foreach ($data as $val) {
			// echo $val;
			$this->SalesModel->delete_item($val);
		}
		echo 1;
		// 
	}

	public function print($id)
	{
		$this->load->view("sales/print", ['value' => $id]);
	}
	public function get_v()
	{
		$val = $this->VarietiesModel->show_data(array('Quantity >' => 0));
		echo "<option >البحث</option>";
		foreach ($val as $value) {
			echo "<option value='$value[varieties_id]'>$value[varieties_name]</option>";
		}
	}
}

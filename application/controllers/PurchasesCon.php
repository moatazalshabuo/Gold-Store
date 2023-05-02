<?php


class PurchasesCon extends CI_Controller
{
	public function purchasesbill($id = "")
	{
		$data = array();
		$data['databill'] = $this->PurchasesModel->get_bill($id);
		if (isset($data['databill']) && $data['databill']['id_bill']) {
			$index = array();
			foreach ($this->PurchasesModel->get_numItem($data['databill']['id_bill']) as $val) {
				array_push($index, $val['id_bill']);
			}
			$current = array_search($data['databill']['id_bill'], $index);
			// print_r($this->PurchasesModel->get_numItem($data['databill']['id_bill']));
			$data['next'] = isset($index[$current + 1]) ? $index[$current + 1] : "";
			$data['prev'] = isset($index[$current - 1]) ? $index[$current - 1] : "";
		}
		$data['varieties'] = $this->VarietiesModel->show_data();
		// print_r($data);
		$this->load->view('include/header');
		$this->load->view('purchases/purchasesbill', $data);
		$this->load->view('include/footer');
		$this->load->view('purchases/ajax');
	}
	public function new_bill()
	{
		$this->UserModel->move();
		$id = $this->PurchasesModel->create_bill();
		redirect("PurchasesCon/purchasesbill/$id");
	}
	public function closeBill($value, $type, $coust = NULL)
	{
		if (!empty($coust)) {
			// echo $coust;
			$row = $this->PurchasesModel->get_bill($value);
			if ($row['Quantity'] > 0) {
				$clint = $this->ClintModel->clint($coust);
				if ($type == 1) {
					$where = array("Quantity" => ($clint['Quantity'] + $row['After_trans']), "value" => ($clint['value'] + $row['value_clint']));
				} elseif ($type == 2) {
					$where = array("value" => ($clint['value'] + $row['value_clint']));
				}

				$this->PurchasesModel->close_bill($value, $type, $coust, $where);

				// $this->Cash->add_to_cash($row['Total_value']);
				$this->session->set_flashdata(["message" => "<p class='alert alert-danger'>تم  الاغلاق بنجاح  </p>"]);
				redirect("PurchasesCon/purchasesbill/$value");
			}
			$this->session->set_flashdata(["message" => "<p class='alert alert-danger'>لايمكن اغلاق فاتورة فارغة<</p>"]);
			redirect("PurchasesCon/purchasesbill/$value");
		}

		$this->session->set_flashdata(["message" => "<p class='alert alert-danger'>يرجى اختيار عميل</p>"]);
		redirect("PurchasesCon/purchasesbill/$value");
	}
	public function editBill($value)
	{
		$row = $this->PurchasesModel->get_bill($value);
		if ($row['status'] == 0) {
			$clint = $this->ClintModel->clint($row['client']);
			if ($row['type_price'] == 1) {
				$where = array("Quantity" => ($clint['Quantity'] - $row['After_trans']), "value" => ($clint['value'] - $row['value_clint']));
			} elseif ($row['type_price'] == 2) {
				$where = array("value" => ($clint['value'] - $row['value_clint']));
			}
			$this->PurchasesModel->edit_bill($value, $row['client'], $where);
			$this->session->set_flashdata(["message" => "<p class='alert alert-success'>تتم فتح الفاتورة للتعديل</p>"]);
			redirect("PurchasesCon/purchasesbill/$value");
		}
		$this->session->set_flashdata(["message" => "<p class='alert alert-danger'>الفاتورة مغلقة</p>"]);
		redirect("PurchasesCon/purchasesbill/$value");
		// $this->Cash->remove_from_cash($row['Total_value']);

	}

	// public function get_q($id){
	// 	$id = $id;
	// 	// $this->input->post('id')
	// 	$row = $this->VarietiesModel->show_data(array('varieties_id'=>$id))[0]['Quantity'];
	// 	echo $row;
	// }

	public function insertitem()
	{
		$row = $this->PurchasesModel->get_bill($this->input->post('id_bill'));
		if ($row['status'] == 1) {
			// print_r($_POST);
			$this->form_validation->set_message('required', '{field} لايمكن ان يكون فارغ.');
			$this->form_validation->set_rules("varieties", "اسم الصنف", "required|numeric");
			$this->form_validation->set_rules("qwant", "الكمية", "required");
			$this->form_validation->set_rules("price", "السعر", "required");
			// $this->form_validation->set_rules("custm","العميل ","required");
			if ($this->form_validation->run() == FALSE) {
				echo validation_errors();
			} else {
				echo $this->PurchasesModel->inser_item();

				// echo 1;
			}
		} else {
			echo "الفاتورة مغلقة لايمكن الاضافة";
		}
	}
	public function get_items($id)
	{
		foreach ($this->PurchasesModel->get_prod($id) as $val) {
			echo "<tr>
					<td><input type='checkbox' value=$val[id] class='control'></td>
                  <td scope='row'>$val[varieties_name]</td>
                  <td>$val[caliber]</td>
                  <td>$val[Quantity]</td>
                  <td>$val[value_gram]</td>
                  <td>$val[value_total]</td>
                  <td>$val[cr_at]</td>
                </tr>";
		}
	}
	// public function totals($id){
	// 	echo json_encode($this->SalesModel->get_bill($id));
	// }

	public function delete_item()
	{

		$data = explode(',', $this->input->post('ids'));
		foreach ($data as $val) {
			// echo $val;
			$pur = $this->PurchasesModel->get_item($val);
			if ($this->PurchasesModel->get_bill($pur['id_bill'])['status'] == 1) {
				$var = $this->VarietiesModel->get_qu($this->PurchasesModel->get_id_v($val));
				if ($pur['Quantity'] <= $var['Quantity']) {
					$this->PurchasesModel->delete_item($val);
					echo '';
				} else {
					$error = "لايمكن الغاء صنف كميتة اكثر من الموجود في المخزن" . " " . $var["varieties_name"];
				}
			} else {
				$error = "الفاتورة مغلقة";
			}
		}
		if (isset($error))
			echo $error;
		else
			echo 1;
		// 
	}


	// public function print($id){
	// 	$this->load->view("sales/print",['value'=>$id]);
	// }
	// public function get_v(){
	// 	$val = $this->VarietiesModel->show_data(array('Quantity >'=>0));
	// 	echo "<option >البحث</option>";
	// 	 foreach($val as $value){
	//       echo "<option value='$value[varieties_id]'>$value[varieties_name]</option>";
	//     }
	// }
}

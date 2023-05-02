<?php 



class ExchangeReceipt extends CI_Controller{

	public function add(){
		$this->UserModel->move();
		$this->form_validation->set_rules("name_clint","العميل","required|numeric");
		$data =array("error"=>"","success"=>"","id"=>"");
		$insert = array();
		$i = 0;
		if($this->form_validation->run() == FALSE){
			$data['error'] .= validation_errors();
		}else{
			$clint = $this->ClintModel->clint($this->input->post("name_clint"));
			// $data['success'] .="تم الاضافة بنجاح ";
			$insert_ex = array("cr_by"=>$this->session->userdata("user_id"),"type"=>1,"client_id"=>$clint['client_id']);
			if($this->input->post("value")){
				$i = $i+1;
				$value = $this->input->post("value");
				if($value <= $clint['value'] && $value > 0){

					if($value <= $this->ClintModel->getstack()){
						// $data['id'] = 10;
						$insert_ex['totel_value'] = $value;
						$insert['value'] = $clint['value'] - $value;						
					}else{
						$data['error'] .="القيمة المدخلة اكبر من اموجود بالمخرزن  ";
					}
				}else{
					$data['error'] .= "القيمة المدخلوة اكبر من قيمة العميل  ";
				}
				// $data['success'] .="تم الاضافة بنجاح ";

			}
			$type_gram = $this->input->post("type_gram");
			$val_gram = $this->input->post("gram_val");
			if (!empty($type_gram) && !empty($val_gram)) {
				$i = $i+1;
				// $data['success'] .="تم الاضافة بنجاح ";
				$type_gram = $this->VarietiesModel->get_qu($this->input->post("type_gram"))['caliber'];

				$qwant = ($this->input->post("gram_val")*$type_gram)/18;
				if($qwant <= $clint['Quantity'] && $qwant > 0){
					// $data['id'] =$this->VarietiesModel->get_qu($this->input->post("type_gram"))['Quantity'] > $this->input->post("gram_val");

				if($this->VarietiesModel->get_qu($this->input->post("type_gram"))['Quantity'] > $this->input->post("gram_val")){

					$insert['Quantity'] = number_format((float)($clint['Quantity'] - $qwant),2,".","");;
					$insert_ex['Quantity'] = $this->input->post("gram_val");
					$insert_ex['varieties_id'] = $this->input->post("type_gram");

					}else{
						$data["error"] .="القيمة المدخلة اكبر من الموجودة في المخزن  ";
					}
				}else{
					$data['error'] .="كمية  الكسر المدخلة اكبر من  حساب العميل  "; 
				}
			}else{

				if(empty($type_gram) && !empty($val_gram)){
					$data['error'] .="يرجى اختيار نوع الكسر"; 
				}
				if(empty($val_gram) && !empty($type_gram)){
					$data['error'] .="يرجى ادخال كمية الكسر";
				}
			}
			if($i == 0){
			$data['error'] .= "يرجى ادخال اما القيمة او الكمية ";
		}	
		}
		
		if(!empty($insert) && empty($data['error'])){ 
			// $data['id'] = 10;
			// echo json_encode($clint);
			// die();
			$this->ClintModel->up($insert,$clint['client_id']);

			$data['id'] = $this->ClintModel->insert_ex_db($insert_ex);
			if(isset($insert_ex['totel_value']))
			$this->ClintModel->up_val($insert_ex['totel_value']);
			if(isset($insert_ex['Quantity']))
			$this->ClintModel->up_stack($insert_ex['Quantity'],$this->input->post("type_gram"));
		// echo $insert_ex['Quantity'] . " ".$this->input->post("type_gram");
			$data['success'] .="تم ادخال البيانات بنجاح ";
		}
		echo json_encode($data);
	}
	public function get_ex()
	{
		$cous = (isset($_GET['custm']) && $_GET['custm'] != 0)?$_GET['custm']:"";
		// echo $cous;
		$date = $this->ClintModel->clints();
		// $sele = (!empty($cous) && $cous == '10000007')?"selected":"";
		$data=array("clint"=>"","ks"=>"");
		$data['clint'] .="<option value=''>عملاء </option>";

		foreach($date as $item){
			$sele = (!empty($cous) && $cous == $item['client_id'] )?"selected":"";
			$data['clint'].="<option $sele value=".$item['client_id'].">".$item['name']." - ".$item['phone_number']."</option>";
		}
		$vari = $this->VarietiesModel->show_data(array('type_varie'=>2));
		$data["ks"] .= "<option value=''>اختر الكسر</option>";
		foreach($vari as $item){
			// $sele = (!empty($cous) && $cous == $item['varieties_id'] )?"selected":"";
			$data["ks"] .="<option value=".$item['varieties_id']." id='".$item['caliber']."'>".$item['varieties_name']."</option>";
		}
		echo json_encode($data);
	}

	public function Get_clint_row($id){
		echo json_encode($this->ClintModel->clint($id));
	}
	public function add_ex(){
		$this->form_validation->set_rules("type_ex","نوع العملية","required|numeric");
		$this->form_validation->set_rules("descrip","بيان الايصال","required");
		$this->form_validation->set_rules("value","القيمة","required");
		$data=array("error"=>"","success"=>"","id"=>"");
		$insert_ex = array("cr_by"=>$this->session->userdata("user_id"));
		if($this->form_validation->run() == FALSE){
			$data['error'] = validation_errors();
		}else{
			$insert_ex['type'] = $this->input->post("type_ex");
			$insert_ex['descripe'] = $this->input->post("descrip");
			$value = $this->input->post("value");
		if($value <= $this->ClintModel->getstack()){
			$insert_ex['totel_value'] = $value;
		}else{
			$data['error'] .= "القيمة اكبر من المخزون";
		}
		}
		if(empty($data['error'])){
			// die();
			$id = $this->ClintModel->insert_ex_db($insert_ex);
			$this->ClintModel->up_val($insert_ex['totel_value']);
			$data['success'] .= "تم ادخال ابيانات بنجاح ";
			$data['id'] = $id;
		}
		echo json_encode($data);
	}
	public function delete_clint_ex($id)
	{
		// code...
		if(is_numeric($id)){

			$data_ex = $this->ClintModel->get_ex(array('used_id'=>$id))[0];
			$this->ClintModel->delete_ex($id);
			$insert =array();

			$clint = $this->ClintModel->clint($data_ex['client_id']);
			if(!empty($data_ex['totel_value'])){
				$insert['value'] = $clint['value'] +$data_ex['totel_value'] ;	
			}
			if (!empty($data_ex['Quantity'])) {
			$cl = $this->VarietiesModel->show_data(array("varieties_id"=>$data_ex['varieties_id']))[0]['caliber'];
				$insert['Quantity'] = $clint['Quantity'] + (($data_ex['Quantity']*$cl)/18);
			// $cl = $this->VarietiesModel->show_data(array("varieties_id"=>$data_ex['varieties_id']))[0]['caliber'];
			$vari = $data_ex["Quantity"];
			}
			$this->ClintModel->up($insert,$clint['client_id']);
			if(!empty($data_ex['totel_value']))
			$this->ClintModel->up_val_add($data_ex['totel_value']);
			if(!empty($data_ex['Quantity']))
			$this->ClintModel->up_stack_add($vari,$data_ex['varieties_id']);
		echo 1;
		}
	}
	public function delete_ex($id){
		if(is_numeric($id)){
			$data_ex = $this->ClintModel->get_ex(array('used_id'=>$id));
			$this->ClintModel->delete_ex($data_ex[0]["used_id"]);
			$this->ClintModel->up_val_add($data_ex[0]['totel_value']);
			echo 1;
		}
	}
}

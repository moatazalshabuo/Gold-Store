<?php

class Varieties extends CI_Controller
{

    public function item()
    {
		$this->UserModel->move();
        $this->form_validation->set_rules('varieties_name', 'تأكد من بيانات الصنف', 'required|is_unique[varieties.varieties_name]');
        $this->form_validation->set_rules('caliber', 'تأكد من تحديد العيار', 'required');
        $this->form_validation->set_rules('type', 'يجب اختيار نوع الصنف', 'required');
        $this->load->view('include/header');
        if ($this->form_validation->run() ==  FALSE) {
            $data["error"] = validation_errors();
        } else {
            $result = $this->VarietiesModel->additem();
            if ($result > 0 && is_numeric($result)) {
                $data['success'] = "تم حفظ البيانات بنجاح";
            } else {
                $data['error'] = $result;
            }
        }
        $data['show_item'] = $this->VarietiesModel->show_data();
        $this->load->view('varieties/item_input', $data);
        $this->load->view('include/footer');
        $this->load->view('varieties/ajax');
    }
    public function delete_var($id)
    {
        $this->VarietiesModel->dele($id);
        return redirect("Varieties/item");
    }

    public function get_q($id)
    {
        $id = $id;
        // $this->input->post('id')
        $row = $this->VarietiesModel->show_data(array('varieties_id' => $id))[0]['Quantity'];
        echo $row;
    }

    public function barren()
    {
        $this->UserModel->move();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->VarietiesModel->store_barren() == 1) {
                $success = "تمت الاضافة بنجاح";
            }
        }
        $data = [
            "varieties" => $this->VarietiesModel->show_data(),
            "insert_value" => $this->VarietiesModel->show_barren(),
            "success"=>isset($success)?$success:""
        ];
        $this->load->view('include/header');
        $this->load->view('varieties/barren', $data);
        $this->load->view('include/footer');
        $this->load->view('varieties/ajaxbarren', $data);
    }

    public function delete_barren()
    {
        $my = explode(",",$_GET['id']);
        // print_r($my);die();
        foreach($my as $i){
                $this->VarietiesModel->delete_barren($i);
            
        }
        return redirect("Varieties/barren");
    }
}

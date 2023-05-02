<?php


class CashController extends CI_Controller
{

    public function CashDeposit()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->Cash->store_deposit() == 1) {
                $success = "تم الاضافة بنجاح";
            }
        }
        $data = [
            "insert_value" => $this->Cash->show_barren(),
            "success" => isset($success) ? $success : ""
        ];
        $this->load->view('include/header');
        $this->load->view('varieties/Cash_deposit', $data);
        $this->load->view('include/footer');
        $this->load->view('varieties/ajaxdeposit');
    }
    public function delete_deposit()
    {
        $my = explode(",", $_GET['id']);
        foreach ($my as $i) {
            $this->Cash->delete_deposit($i);
        }
        return redirect("CashController/CashDeposit");
    }
}

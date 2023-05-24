<?php


class Reports extends CI_Controller
{
    public function pay()
    {
        $client = $this->ClintModel->clints();
        $data = array();
        $date = '';
        $client_p = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->input->post('client')) {
                $client_p = $this->input->post('client');
            }
            if ($this->input->post('form')) {
                $to = empty($this->input->post('to')) ? date("h:i:s Y-m-d") : $this->input->post('to');
                $date = array(
                    $this->input->post('form'),
                    $to
                );
            }
            if (!empty($client_p) || !empty($date)) {
                $data = $this->ClintModel->search_exc($client_p, $date);
            }
        }
        $this->load->view('include/header');
        $this->load->view('reports/pay_report', ['client' => $client, 'data' => $data]);
        $this->load->view('include/footer');
    }

    public function exchange()
    {
        $data = array();
        $date = '';
        $client_p = "";
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($this->input->post('type_ex')) {
                $client_p = $this->input->post('type_ex');
            }
            if ($this->input->post('form')) {
                $to = empty($this->input->post('to')) ? date("h:i:s Y-m-d") : $this->input->post('to');
                $date = array(
                    $this->input->post('form'),
                    $to
                );
            }
            if (!empty($client_p) || !empty($date)) {

                $data = $this->ClintModel->search_exc_1($client_p, $date);
            }
        }
        $this->load->view('include/header');
        $this->load->view('reports/exchange_report', ['data' => $data]);
        $this->load->view('include/footer');
        $this->load->view('reports/js');
    }

    public function client()
    {
        $client = $this->ClintModel->clints();
        $data = array();
        $data1 = array();
        $value = array();
        $date = '';
        $client_p = "";
        $error = "";
        $current_client = array();
        $this->form_validation->set_rules('client', "المورد", "required");

        if ($this->form_validation->run() == FALSE) {
            $error = validation_errors();
        } else {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if ($this->input->post('client')) {
                    $client_p = $this->input->post('client');
                }
                if ($this->input->post('form')) {
                    $to = empty($this->input->post('to')) ? date("h:i:s Y-m-d") : $this->input->post('to');
                    $date = array(
                        $this->input->post('form'),
                        $to
                    );
                }
                if (!empty($client_p) || !empty($date)) {

                    $data = $this->ClintModel->search_exc($client_p, $date);
                    $data1 = $this->ClintModel->client_account($client_p, $date);
                    $current_client = $this->ClintModel->clint($client_p);
                    $i = 0;
                    foreach ($data as $val) {
                        $value[$i] = [
                            'id_bill' => $val['used_id'],
                            'Quantity' => $val['Quantity'],
                            'value' => $val['totel_value'],
                            'username' => $val['username'],
                            'date' => $val['cr_at'],
                            'type' => 1
                        ];
                        $i += 1;
                    }
                    foreach ($data1 as $val) {
                        $value[$i] = [
                            'id_bill' => $val['id_bill'],
                            'Quantity' => $val['After_trans'],
                            'value' => $val['value_clint'],
                            'username' => $val['username'],
                            'date' => $val['cr_at'],
                            'type' => 2
                        ];
                        $i += 1;
                    }
                    usort($value, fn ($a, $b) => $a['date'] <=> $b['date']);
                }
            }
        }
        $this->load->view('include/header');
        $this->load->view('reports/client_report', ["data" => $value, 'error' => $error, 'client' => $client, "myclient" => $current_client]);
        $this->load->view('include/footer');
    }


    public function Treasury_account()
    {
        if (empty($this->input->post("all"))) {
            $from = date("Y-m-d") . " 00:00:00";
            $to = date("Y-m-d") . " 23:59:59";
        } else {
            $from = "";
            $to = "";
        }

        if ($this->input->post("from")) {
            $from = $this->input->post("from");
        }
        if ($this->input->post("to")) {
            $to = $this->input->post("to");
        }

        $export = $this->ClintModel->getexports($from, $to);
        $impot = $this->ClintModel->getimport($from, $to);
        $old_export = $this->ClintModel->getoldexport($from, $to);
        $old_impot = $this->ClintModel->getoldimport($from, $to);
        // print_r($impot
		$cash = $this->db->get('cash_stock')->row_array()['value_total'];
        $this->load->view("include/header");
        $this->load->view("reports/treasury_account", [
            "from" => $from,
            "to" => $to,
            "import" => $impot,
            "export" => $export,
            "old_ex" => $old_export,
            "old_im" => $old_impot,
            "new_ex" => $this->ClintModel->getnewexport($from, $to),
            "new_im" => $this->ClintModel->getnewimport($from, $to),
			"cash"=>$cash
        ]);
        $this->load->view("include/footer");
    }
    public function move_vari()
    {
        $vari_id = "";
        $from = "";
        $to = "";
        $data = array();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $vari_id = $this->input->post("varieties");
            if ($this->input->post("from")) {
                $from = $this->input->post("from");
            }
            if ($this->input->post("to")) {
                $to = $this->input->post("to");
            }
            $sales = $this->VarietiesModel->report_sales($vari_id, $from, $to);
            $report_purs = $this->VarietiesModel->report_purs($vari_id, $from, $to);
            $report_exchange = $this->VarietiesModel->report_exchange($vari_id, $from, $to);
            $i = 0;
            foreach ($sales as $val) {
                $data[$i] = [
                    'id_bill' => $val['sales_id'],
                    'Quantity' => $val['Quantity'],
                    "cr_at" => $val['cr_at'],
                    "user" => $this->UserModel->getUser($val['cr_by'])['username'],
                    "type_" => 1
                ];
                $i++;
            }

            foreach ($report_purs as $val) {
                $data[$i] = [
                    'id_bill' => $val['id_bill'],
                    'Quantity' => $val['Quantity'],
                    "cr_at" => $val['cr_at'],
                    "user" => $this->UserModel->getUser($val['cr_by'])['username'],
                    "type_" => 2
                ];
                $i++;
            }

            foreach ($report_exchange as $val) {
                $data[$i] = [
                    'id_bill' => $val['used_id'],
                    'Quantity' => $val['Quantity'],
                    "cr_at" => $val['cr_at'],
                    "user" => $this->UserModel->getUser($val['cr_by'])['username'],
                    "type_" => 3
                ];
                $i++;
            }
            usort($data, fn ($a, $b) => $a['cr_at'] <=> $b['cr_at']);
        }
        $this->load->view("include/header");
        $this->load->view("reports/move_vari", [
            'varieties' => $this->VarietiesModel->show_data(),
            'data' => $data,
            'vari_id' => $vari_id
        ]);
        $this->load->view("include/footer");
    }
}

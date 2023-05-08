<?php

class Home extends CI_Controller
{

	public function index()
	{
		$row = $this->db->get('cash_stock');
		if ($row->num_rows() > 0) {
			$x = ":)";
		} else {
			$this->db->insert('cash_stock', array('id' => 1, 'value_total' => 0));
		}
		$this->load->view('include/header');
		$this->load->view('index');
		$this->load->view('include/footer');
	}
}

<?php

class Home extends CI_Controller
{

	public function index()
	{
		$this->load->view('include/header');
		$this->load->view('index');
		$this->load->view('include/footer');
	}
}

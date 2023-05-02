<?php 


class UserController extends CI_Controller
{
	public function login(){
		if($this->session->userdata('username')){
			redirect('home/index');
		}else{
		$this->form_validation->set_rules('username',"Username","trim|required");
		$this->form_validation->set_rules('password',"Password","required");
		if($this->form_validation->run() == FALSE){

			$this->load->view('users/login', array('error'=>validation_errors() ) );
		}else{
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$result = $this->UserModel->login($username,$password);
			if($result){
				$this->session->set_userdata($result);
				redirect("home/index");
			}else{
				$this->load->view('users/login', array('error'=>'اسم المستخدم او كلمة المرور خاطا' ) );
			}
		}
		}
	}
	public function register(){

	}
	public function usersManage(){
		$this->load->view('include/header');		
		$this->load->view('users/users');
		$this->load->view('include/footer');
		$this->load->view('users/ajax.php');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('home/index');
	}
}

?>
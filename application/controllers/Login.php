<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function index(){
		view('login');
	}

	public function proses(){
        $post = $this->input->post();
		$password = $post['password'];
        $username = $post['username'];
        // $show = $this->M_crud->getById('pelanggan',array('username' => $username));
        // // die(print_r($show));
        // $pass = "";
        // foreach($show as $s){
        //     $pass = $s->password;
        // }
        // if(password_verify($password,$pass)){
        if($password == 'admin' && $username == 'admin'){
            $this->session->set_userdata('nama_admin','Admin');
            // $this->session->set_userdata('id_admin',$s->id_admin);
            // $this->session->set_userdata('user_admin',$s->username);
            // $this->session->set_userdata('nama_admin',$s->nama_admin);
            // echo $this->session->userdata('nama_user');
            redirect('home');
        }else{
            echo '<script>alert("gagal login"); window.history.back()</script>';
        }
    }
    public function logout(){
        $this->session->unset_userdata('nama_admin');
        redirect('/');
    }
}

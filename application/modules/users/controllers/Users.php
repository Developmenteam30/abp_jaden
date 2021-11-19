<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function index() {
        echo "dada";
    }
    public function login() {
		if ($this->session->userdata('user')) {
			redirect(base_url());
		}
        $data = array();
		if(isset($_POST['email'])){
			$query = $this->db->get_where('users', array('email'=>$_POST['email'], 'password'=>md5($_POST['password'])))->row();
			if($query){
				$this->session->set_userdata('user',$query);
				redirect(base_url());
			}else{
                $data['failure'] = "email or password is wrong";
			}
		}
        $this->load->view('signin', $data);
    }
}
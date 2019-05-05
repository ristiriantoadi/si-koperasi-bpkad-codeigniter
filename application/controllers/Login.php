<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends CI_Controller{
        function __construct(){
            parent::__construct();
            if($this->session->userdata('admin')){
                redirect(site_url('anggota/aktif'));
            }
        }
        public function index(){
            $this->load->view('Login');
        }
        
        public function autentikasi(){
            $username = $this->input->post("username");
            $password = $this->input->post('password');
            $query = $this->db->query("SELECT * from admin")->row();

            if($username == $query->username && $password == $query->password){
                $this->session->set_userdata('admin','1');
                redirect(site_url('anggota/aktif'));
            }
            else{
                redirect(site_url('login?'+'0'));
            }
        }

        

        
    }
?>
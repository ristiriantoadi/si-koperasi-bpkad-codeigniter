<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Login extends CI_Controller{
        public function index(){
            $this->load->view('Login');
        }
        public function autentikasi(){
            $username = $this->input->post("username");
            $password = $this->input->post('password');
            $query = $this->db->query("SELECT * from admin")->row();

            if($username == $query->username && $password == $query->password){
                redirect(site_url('anggota'));
            }
            else echo "gagal";
        }
        
    }
?>
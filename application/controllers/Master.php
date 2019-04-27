<?php 
    class Master extends CI_Controller{
    
        public function __construct(){
            parent::__construct();
            if(!$this->session->userdata('admin')){
                redirect(site_url('login'));
            }
            
        }
        
        public function data_bidang()
        {
            $this->load->model('Model_anggota');
            $data = array(
                'halaman' => 'data_bidang',
                'bidang'=> $this->Model_anggota->get_data_bidang()
            );
            $this->load->view('templates/header', $data);
            $this->load->view('edit_data_bidang', $data);
            $this->load->view('templates/footer');
        }

        public function data_master_iuran_wajib()
        {
            $this->load->model('Model_anggota');
            $data = array(
                'halaman' => 'data_master_iuran_wajib',
                'jumlah_iuran_wajib'=> $this->Model_anggota->get_data_master_iuran_wajib()
            );
            $this->load->view('templates/header', $data);
            $this->load->view('edit_data_master_iuran_wajib', $data);
            $this->load->view('templates/footer');
        }

        public function data_master_biaya_admin()
        {
            $this->load->model('Model_anggota');
            $data = array(
                'halaman' => 'data_master_biaya_admin',
                'jumlah_biaya_admin'=> $this->Model_anggota->get_data_master_biaya_admin()
            );
            $this->load->view('templates/header', $data);
            $this->load->view('edit_data_master_biaya_admin', $data);
            $this->load->view('templates/footer');
        }

    }
?>
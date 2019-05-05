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

        public function edit_data_master_iuran_wajib(){
            $this->load->model('Model_master');
            //$data
            //$this->db->insert()
        
            if($this->Model_master->edit_data_master_iuran_wajib())
                redirect(site_url('anggota/aktif'));
            else echo "gagal";
        }
    
        public function edit_data_master_biaya_admin(){
            $this->load->model('Model_master');
            //$data
            //$this->db->insert()
            /*
            $data = array(
                'jumlah_iuran_wajib' => str_replace(array("Rp. ","."),'',$this->input->post("jumlah_iuran_wajib"))
            );
            */
            if($this->Model_master->edit_data_master_biaya_admin())
                redirect(site_url('anggota/aktif'));
            else echo "gagal";
        }

        public function edit_data_bidang(){
            $this->load->model('Model_master');
            print_r($this->input->post('nama_bidang'));
            //echo count($this->input->post('nama_bidang'));
            //exit();
            if($this->Model_master->edit_data_bidang())
                redirect(site_url('anggota/aktif'));
            else echo "gagal";
        }
    

    }
?>
<?php
class Model_anggota extends CI_Model {

        public function tambah_anggota(){
                $this->load->model('Model_iuran_wajib');
                $tanggal = date('y-m-d', strtotime($this->input->post('tanggal')));        

                $data = array(
                        'id_anggota' => $this->input->post('id_anggota'),
                        'nama' => $this->input->post('nama'),
                        'no_telepon' => $this->input->post('no_telepon'),
                        'no_ktp' => $this->input->post('no_ktp'),
                        'tempat_tanggal_lahir' => $this->input->post('tempat_tanggal_lahir'),     
                        'id_bidang' => $this->input->post('bidang'),
                        'alamat' => $this->input->post('alamat'),
                        'tanggal' => $tanggal,
                        'status' => 'aktif',
                        'iuran_pokok' => 500000
                    );

                if(!$this->Model_iuran_wajib->tambah_iuran_wajib())
                    return false;

                return $this->db->insert('anggota', $data);    
        }

        public function get_data_iuran_pokok($id_anggota=null){
                if($id_anggota == null){
                        $query = $this->db->get_where('anggota', array('status'=>'aktif'));
                        return $query->result_array(); 
                }
                else{
                        $query = $this->db->get_where('anggota', array('id_anggota' => $id_anggota)); 
                        return $query->result_array();                
                }
        }

        public function get_data_anggota($id_anggota=null){

                if($id_anggota==null){
                        //$this->db->order_by('id_anggota', 'ASC');
                        $this->db->select('*');
                        $this->db->from('bidang');
                        $this->db->join('anggota', 'bidang.id_bidang = anggota.id_bidang');
                        $query = $this->db->get_where('', array('anggota.status'=>'aktif'));
                        
                        //$query = $this->db->get_where('anggota', array('status'=>'aktif'));
                        return $query->result_array();
                }
                else {
                        $this->db->select('*');
                        $this->db->from('bidang');
                        $this->db->join('anggota', 'bidang.id_bidang = anggota.id_bidang');
                        $query = $this->db->get_where('', array('anggota.id_anggota' => $id_anggota)); 
                        return $query->row_array();
                }
        }

        public function get_data_anggota_nonaktif($id_anggota=null){

                if($id_anggota==null){
                        //$this->db->order_by('id_anggota', 'ASC');
                        $this->db->select('*');
                        $this->db->from('bidang');
                        $this->db->join('anggota', 'bidang.id_bidang = anggota.id_bidang');
                        $query = $this->db->get_where('', array('anggota.status'=>'nonaktif'));
                        
                        //$query = $this->db->get_where('anggota', array('status'=>'aktif'));
                        return $query->result_array();
                }
                else {
                        $this->db->select('*');
                        $this->db->from('bidang');
                        $this->db->join('anggota', 'bidang.id_bidang = anggota.id_bidang');
                        $query = $this->db->get_where('', array('anggota.id_anggota' => $id_anggota)); 
                        return $query->row_array();
                }
        }

        public function cari_iuran_pokok_by_date($tanggal_awal, $tanggal_akhir){
                $result = $this->db->query("SELECT * from anggota 
                        WHERE (tanggal >= '$tanggal_awal' AND tanggal <= '$tanggal_akhir') 
                        AND status='aktif'");
                return $result->result_array();
        }
        
        public function cari_iuran_pokok($cari=null){
                //$this->db->order_by('id_iuran_wajib', 'ASC');        
                if($cari==null){
                        //$this->db->select('*');
                        //$this->db->from('anggota');
                        //$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        //$this->db->order_by('id_iuran_wajib', 'ASC');
                        $query = $this->db->get_where('anggota',array('status'=>'aktif'));
                        return $query->result_array();

                }
                else {
                        $cari = str_replace('-',' ',$cari);
                
                        //$this->db->select('*');
                        //$this->db->from('iuran_wajib');
                        //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
                        //$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        //$this->db->like('anggota', $cari)
                        //return $query->result_array();
                        $this->db->like('nama', $cari);
                        $query = $this->db->get_where('anggota',array('status'=>'aktif'));
                        
                        //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 
                        return $query->result_array();
                }
        }

        
        public function get_edit_anggota($id_anggota){
                $query = $this->db->get_where('anggota', array('id_anggota' => $id_anggota));
                return $query->row_array();

        }

        public function hapus_anggota($id_anggota){
                return $this->db->delete('anggota', array('id_anggota' => $id_anggota)); 
                

        }
        public function nonaktifkan_anggota($id_anggota){
                $data = array(
                        'id_anggota' => $id_anggota,
                        'status'  => 'nonaktif',
                        'tanggal_non_aktif'=>date('y-m-d')
                );
                
                $tanggal=date('Y-m-d');
                return $this->db->query("UPDATE anggota set status='nonaktif', tanggal_nonaktif='$tanggal' where id_anggota=$id_anggota");
        }

        public function cari_anggota_aktif($cari){
                $cari = str_replace('-',' ',$cari);
                $this->db->select('*');
                $this->db->from('bidang');
                $this->db->join('anggota', 'bidang.id_bidang = anggota.id_bidang');                        
                $this->db->like('anggota.id_anggota', $cari); $this->db->or_like('anggota.nama', $cari);
                //$this->db->order_by('id_anggota', 'ASC');
                $query = $this->db->get_where('', array('anggota.status'=>'aktif'));
                return $query->result_array();

        }

        
        public function cari_anggota_non_aktif($cari){
                $cari = str_replace('-',' ',$cari);
                $this->db->select('*');
                $this->db->from('bidang');
                $this->db->join('anggota', 'bidang.id_bidang = anggota.id_bidang');                        
                $this->db->like('anggota.id_anggota', $cari); $this->db->or_like('anggota.nama', $cari);
                //$this->db->order_by('id_anggota', 'ASC');
                $query = $this->db->get_where('', array('status'=>'nonaktif'));
                return $query->result_array();

        }

        
        public function cari_nama_anggota($id_anggota){
                $query = $this->db->get_where('anggota', array('id_anggota' => $id_anggota));
                return $query->row_array();

                
        }

        
        public function get_data_bidang(){
                //$this->db->select('*');
                //$this->db->from('iuran_wajib');
                $query = $this->db->get('bidang');
                return $query->result_array();
                //$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                
        }


        public function edit_anggota(){
                $data = array(
                        'id_anggota' => $this->input->post('id_anggota'),
                        'nama' => $this->input->post('nama'),
                        'no_telepon' => $this->input->post('no_telepon'),
                        'no_ktp' => $this->input->post('no_ktp'),
                        'tempat_tanggal_lahir' => $this->input->post('tempat_tanggal_lahir'),
                        'id_bidang' => $this->input->post('bidang'),
                        'alamat' => $this->input->post('alamat'),
                        'tanggal' => $this->input->post('tanggal'),
                        'status' =>'aktif'
                    );
                echo $this->input->post('no_telepon');
                return $this->db->replace('anggota', $data);

        }

        
        public function get_data_master_iuran_wajib(){
                $hasil = $this->db->query('SELECT    *
                FROM      master_iuran_wajib
                ORDER BY  id_iuran_wajib DESC
                LIMIT     1;')->row();
                //print_r($hasil);
                //exit();
                return $hasil->jumlah_iuran_wajib;
        }

        public function get_data_master_biaya_admin(){
                $hasil = $this->db->query('SELECT * FROM master_biaya_admin')->row();
                //print_r($hasil);
                //exit();
                return $hasil->jumlah_biaya_admin;
        }
        
}
<?php 
    class Model_master extends CI_Model{

        public function get_data_bidang(){
            //$this->db->select('*');
            //$this->db->from('iuran_wajib');
            $query = $this->db->get('bidang');
            return $query->result_array();
            //$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
            
        }
        public function edit_data_bidang(){
            $data = array();
		    for($i = 0;$i<count($this->input->post('nama_bidang'));$i++){
			    $data[$i]['id_bidang'] = ($i+1);
			    $data[$i]['nama_bidang'] = $this->input->post('nama_bidang')[$i];
		    }
		    $this->db->query('TRUNCATE bidang');
            $this->db->insert_batch('bidang', $data);
            return true;
        }

        public function edit_data_master_iuran_wajib(){
            $data = array(
                'jumlah_iuran_wajib' => str_replace(array("Rp. ","."),'',$this->input->post("jumlah_iuran_wajib"))
            );
            
            $this->db->replace('master_iuran_wajib', $data);
            return true;
        }

        public function edit_data_master_biaya_admin(){
            $jumlah_biaya_admin = str_replace(array("Rp. ","."),'',$this->input->post("jumlah_biaya_admin"));

		    //$this->db->replace('master_iuran_wajib', $data);
		    $this->db->query("UPDATE master_biaya_admin SET jumlah_biaya_admin=$jumlah_biaya_admin");
            return true;
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
?>
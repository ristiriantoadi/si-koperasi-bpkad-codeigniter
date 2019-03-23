<?php
class Model_anggota extends CI_Model {

        public function tambah_anggota(){
                
                $tanggal = date('y-m-d', strtotime($this->input->post('tanggal')));        

                $data = array(
                        'id_anggota' => $this->input->post('id_anggota'),
                        'nama' => $this->input->post('nama'),
                        'no_telepon' => $this->input->post('no_telepon'),
                        'no_ktp' => $this->input->post('no_ktp'),
                        'tempat_tanggal_lahir' => $this->input->post('tempat_tanggal_lahir'),     
                        'bidang' => $this->input->post('bidang'),
                        'alamat' => $this->input->post('alamat'),
                        'tanggal' => $tanggal,
                        'status' => 'aktif'
                    );

                if(!$this->tambah_iuran_wajib())
                    return false;

                return $this->db->insert('anggota', $data);    
        }

        public function tambah_iuran_wajib(){
                
                $tanggal = date('y-m-d', strtotime($this->input->post('tanggal')));        
                echo $tanggal;
                //exit();
                $data = array(
                        'id_anggota' => $this->input->post('id_anggota'),
                        'tanggal_transaksi' => $tanggal

                    );

                return $this->db->insert('iuran_wajib', $data);    
        }

        public function tambah_pembiayaan(){
                
                $tanggal = date('y-m-d', strtotime($this->input->post('tanggal')));        
                echo $tanggal;
                //exit();
                $data = array(
                        'id_anggota' => $this->input->post('id_anggota'),
                        'tanggal' => $tanggal,
                        'jumlah' =>str_replace('.','',$this->input->post('jumlah')),
                        'jangka_waktu'=>$this->input->post('jangka_waktu'),
                        'ijarah'=>str_replace(array("Rp. ","."),'',$this->input->post("ijarah")),
                        'pengembalian_pokok'=>str_replace(array("Rp. ","."),'',$this->input->post("pengembalian_pokok")),
                        'keterangan'=>$this->input->post("keterangan"),
                        'status_pembiayaan' =>'Belum Lunas'
                    );

                return $this->db->insert('pembiayaan', $data);    
        }


        public function tambah_angsuran(){
                
                $tanggal = date('y-m-d', strtotime($this->input->post('tanggal')));        
                //echo $tanggal;
                echo $this->input->post('total_angsuran');
                //exit();
                $data = array(
                        'id_pembiayaan' => $this->input->post('id_pembiayaan'),
                        'id_anggota' => $this->input->post('id_anggota'),
                        'tanggal' => $tanggal,
                        'jumlah_angsuran' =>str_replace(array("Rp. ","."),'',$this->input->post("angsuran"))
                    );

                return $this->db->insert('angsuran', $data);    
        }

        public function get_total_angsuran($id_anggota){
                $this->db->select("(SELECT SUM(jumlah_angsuran) FROM angsuran WHERE id_anggota=$id_anggota) AS total_angsuran");
                $query = $this->db->get();
                return $query->row_array();
        }



        public function get_data_anggota($id_anggota=null){

                if($id_anggota==null){
                        //$this->db->order_by('id_anggota', 'ASC');
                        $query = $this->db->get_where('anggota', array('status'=>'aktif'));
                        return $query->result_array();
                }
                else {
                        $query = $this->db->get_where('anggota', array('id_anggota' => $id_anggota)); 
                        return $query->row_array();
                }
        }

        public function get_data_angsuran($id_pembiayaan){
                $this->db->select('*');
                $this->db->from('angsuran');
                $this->db->join('pembiayaan', 'pembiayaan.id_pembiayaan = angsuran.id_pembiayaan');
                        
                $query = $this->db->get_where('', array('angsuran.id_pembiayaan' => $id_pembiayaan)); 
                return $query->result_array();
                
        }

        public function get_data_anggota_pembiayaan($id_anggota=null){

                if($id_anggota==null){
                        //$this->db->order_by('id_anggota', 'ASC');
                        $this->db->select('*');
                        $this->db->from('pembiayaan');
                        $this->db->join('anggota', 'pembiayaan.id_anggota = anggota.id_anggota');
                        $query = $this->db->get();
                        return $query->result_array();

                }
                else {
                        $query = $this->db->get_where('anggota', array('id_anggota' => $id_anggota)); 
                        return $query->row_array();
                }
        }

        public function get_data_anggota_non_aktif(){
                $query = $this->db->get_where('anggota', array('status'=>'nonaktif'));
                        return $query->result_array();
        }

        public function get_id_pembiayaan($id_anggota){
                $query = $this->db->get_where('pembiayaan', array('id_anggota'=>$id_anggota));
                return $query->row_array();        
        }
        public function get_pembiayaan($id_anggota=null){

                if($id_anggota==null){
                        $this->db->select('*');
                        $this->db->from('pembiayaan');
                        $this->db->join('anggota', 'pembiayaan.id_anggota = anggota.id_anggota');
                        $query = $this->db->get();
                        return $query->result_array();

                }
                else {
                        //$this->db->select('*');
                        //$this->db->from('pembiayaan');
                        //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
                        //$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        //$this->db->like('anggota', $cari)
                        //return $query->result_array();
                        $this->db->select('*');
                        $this->db->from('pembiayaan');
                        $this->db->join('anggota', 'pembiayaan.id_anggota = anggota.id_anggota');
                        $query = $this->db->get_where('', array('pembiayaan.id_anggota'=>$id_anggota));
                        //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 
                        return $query->result_array();
                }
        }

        public function get_jumlah_pembiayaan($id_pembiayaan){
                $this->db->select('jumlah');
                $this->db->from('pembiayaan');
                $query = $this->db->get_where('',array('id_pembiayaan'=>$id_pembiayaan));
                return $query->row_array();
        }



        public function get_iuran_wajib($id_anggota=null){

                if($id_anggota==null){
                        $this->db->select('*');
                        $this->db->from('iuran_wajib');
                        $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        $this->db->order_by('id_iuran_wajib', 'ASC');
                        $query = $this->db->get_where('',array('status'=>'aktif'));
                        return $query->result_array();

                }
                else {
                        $this->db->select('*');
                        $this->db->from('iuran_wajib');
                        $this->db->where('iuran_wajib.id_anggota', $id_anggota);
                        $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        //$this->db->like('anggota', $cari)
                        //return $query->result_array();
                        $query = $this->db->get();
                        //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 
                        return $query->result_array();
                }
        }

        public function get_total_iuran_wajib($id_anggota){

                $this->db->select('*');
                $this->db->from('iuran_wajib');
                $this->db->where('iuran_wajib.id_anggota', $id_anggota);
               // $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        //$this->db->like('anggota', $cari)
                        //return $query->result_array();
                $total = $this->db->count_all_results()*200000;
                        //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 


                return $total;
                
        }

        public function get_sisa_pembiayaan($id_anggota){

                $this->db->select('jumlah');
                $this->db->from('pembiayaan');
                $this->db->where('pembiayaan.id_anggota', $id_anggota);
                //$this->db->join('anggota', 'pembiayaan.id_anggota = anggota.id_anggota');
                        //$this->db->like('anggota', $cari)
                        //return $query->result_array();
                //$total = $this->db->count_all_results()*200000;
                        //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 
                        $query = $this->db->get();
                        

                return $query->row_array();
                
        }

        public function cari_iuran_wajib($cari=null){
                $this->db->order_by('id_iuran_wajib', 'ASC');        
                if($cari==null){
                        $this->db->select('*');
                        $this->db->from('iuran_wajib');
                        $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        //$this->db->order_by('id_iuran_wajib', 'ASC');
                        $query = $this->db->get_where('',array('status'=>'aktif'));
                        return $query->result_array();

                }
                else {
                        $cari = str_replace('-',' ',$cari);
                
                        $this->db->select('*');
                        $this->db->from('iuran_wajib');
                        //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
                        $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        //$this->db->like('anggota', $cari)
                        //return $query->result_array();
                        $this->db->like('anggota.nama', $cari);
                        $query = $this->db->get_where('',array('status'=>'aktif'));
                        
                        //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 
                        return $query->result_array();
                }
        }
        
        public function hapus_iuran_wajib($id_iuran_wajib){
                return $this->db->delete('iuran_wajib', array('id_iuran_wajib' => $id_iuran_wajib)); 
                

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
                $this->db->like('id_anggota', $cari); $this->db->or_like('nama', $cari);
                //$this->db->order_by('id_anggota', 'ASC');
                $query = $this->db->get_where('anggota', array('status'=>'aktif'));
                return $query->result_array();

        }

        public function cari_anggota_pembiayaan($cari){  
                $cari = str_replace('-',' ',$cari);
                
                //$this->db->like('id_anggota', $cari); $this->db->or_like('nama', $cari);
                $this->db->select('*');
                $this->db->from('iuran_wajib');
                $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                $this->db->like('id_anggota', $cari); $this->db->or_like('nama', $cari);      
                //$this->db->order_by('id_anggota', 'ASC');
                $query = $this->db->get_where('anggota', array('status'=>'aktif'));
                return $query->result_array();

        }

        public function cari_nama_anggota($id_anggota){
                $query = $this->db->get_where('anggota', array('id_anggota' => $id_anggota));
                return $query->row_array();

                
        }

        public function get_data_pembiayaan_individu($cari){
                //$this->db->select('*');
                //$this->db->from('iuran_wajib');
                $query = $this->db->get_where('pembiayaan', array('id_anggota'=>$cari));
                return $query->row_array();
                //$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                
        }


        public function edit_anggota(){
                $data = array(
                        'id_anggota' => $this->input->post('id_anggota'),
                        'nama' => $this->input->post('nama'),
                        'no_telepon' => $this->input->post('no_telepon'),
                        'no_ktp' => $this->input->post('no_ktp'),
                        'tempat_tanggal_lahir' => $this->input->post('tempat_tanggal_lahir'),
                        'bidang' => $this->input->post('bidang'),
                        'alamat' => $this->input->post('alamat'),
                        'tanggal' => $this->input->post('tanggal'),
                        'status' =>'aktif'
                    );
                echo $this->input->post('no_telepon');
                return $this->db->replace('anggota', $data);

        }
        
}
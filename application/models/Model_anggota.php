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
                        'status' => 'aktif',
                        'iuran_pokok' => 500000
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
                //echo $this->input->post('total_angsuran');
                //exit();
                $data = array(
                        'id_pembiayaan' => $this->input->post('id_pembiayaan'),
                        'id_anggota' => $this->input->post('id_anggota'),
                        'tanggal' => $tanggal,
                        'jumlah_angsuran' =>str_replace(array("Rp. ","."),'',$this->input->post("angsuran"))
                    );

                return $this->db->insert('angsuran', $data);    
        }

        public function tambah_ijarah(){
                
                $tanggal = date('y-m-d', strtotime($this->input->post('tanggal')));        
                //echo $tanggal;
                //echo $this->input->post('total_angsuran');
                //exit();
                $data = array(
                        //'id_pembiayaan' => $this->input->post('id_pembiayaan'),
                        'id_anggota' => $this->input->post('id_anggota'),
                        'tanggal' => $tanggal,
                        //'jumlah_angsuran' =>str_replace(array("Rp. ","."),'',$this->input->post("angsuran"))
                        'jumlah' => str_replace(array("Rp. ","."),'',$this->input->post("ijarah"))
                );

                return $this->db->insert('ijarah', $data);    
        }


        public function get_total_angsuran($id_anggota){
                $this->db->select("(SELECT SUM(jumlah_angsuran) FROM angsuran WHERE id_anggota=$id_anggota) AS total_angsuran");
                $query = $this->db->get();
                return $query->row_array();
        }

        public function get_total_angsuran_by_id_pembiayaan($id_pembiayaan){
                $this->db->select("(SELECT SUM(jumlah_angsuran) FROM angsuran WHERE id_pembiayaan=$id_pembiayaan) AS total_angsuran");
                $result = $this->db->get()->row();
                return $result->total_angsuran;
                //return $query->row_array();
        }       

        public function get_total_ijarah($id_anggota=null){
                if($id_anggota == null){
                        $this->db->select("(SELECT SUM(jumlah) FROM ijarah) AS total_angsuran");
                        $result = $this->db->get()->row();
                        return $result->total_angsuran;        
                }
                $this->db->join('anggota', 'ijarah.id = anggota.id');
                $this->db->select("(SELECT SUM(jumlah) FROM ijarah WHERE id_anggota=$id_anggota) AS total_angsuran");
                $this->db->select_sum('jumlah');
                return $result->total_angsuran;
        }

        public function get_total_ijarah_by_keyword($cari=null){
                if($cari == null){
                        $this->db->select("(SELECT SUM(jumlah) FROM ijarah) AS total_angsuran");
                        $result = $this->db->get()->row();
                        return $result->total_angsuran;        
                }
                //$this->db->join('anggota', 'ijarah.id = anggota.id');
                //$this->db->select("(SELECT SUM(jumlah) FROM ijarah WHERE id_anggota=$id_anggota) AS total_angsuran");
                //$this->db->select_sum('jumlah');
                $result = $this->db->query("SELECT SUM(jumlah) AS total_angsuran FROM ijarah INNER JOIN anggota ON anggota.id_anggota = ijarah.id_anggota
                WHERE anggota.id_anggota like '%$cari%' OR anggota.nama like '%$cari%' ")->row();
                return $result->total_angsuran;
        }


        public function get_data_iuran_pokok($id_anggota=null){
                if($id_anggota==null){
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
                        $query = $this->db->get_where('anggota', array('status'=>'aktif'));
                        return $query->result_array();
                }
                else {
                        $query = $this->db->get_where('anggota', array('id_anggota' => $id_anggota)); 
                        return $query->row_array();
                }
        }

        public function get_data_anggota_nonaktif($id_anggota=null){

                if($id_anggota==null){
                        //$this->db->order_by('id_anggota', 'ASC');
                        $query = $this->db->get_where('anggota', array('status'=>'nonaktif'));
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
                        $query = $this->db->get_where('', array('anggota.status'=>"aktif"));
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
                        $query = $this->db->get_where('', array('pembiayaan.id_anggota'=>$id_anggota, 'pembiayaan.status_pembiayaan'=>'Belum Lunas'));
                        //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 
                        return $query->row_array();
                }
        }

        public function is_lunas($id_pembiayaan){
                $result = $this->db->get_where('pembiayaan', array('id_pembiayaan'=>$id_pembiayaan))->row();
                $status_pembiayaan = $result->status_pembiayaan;
                //echo $status_pembiayaan;
                //exit();
                if($status_pembiayaan == "lunas"){
                        //echo "yes";
                        return true;
                        
                }
                else return false;
        }

        public function set_lunas($id_pembiayaan){
                return $this->db->query("UPDATE pembiayaan SET status_pembiayaan='Lunas' WHERE id_pembiayaan=$id_pembiayaan");
        }

        public function get_pembiayaan_by_id_pembiayaan($id_pembiayaan=null){
                $result = $this->db->get_where('pembiayaan', array('id_pembiayaan'=>$id_pembiayaan))->row();
                return $result->jumlah;       
        }

        public function get_semua_pembiayaan_by_id_anggota($id_anggota=null){
                //$result = $this->db->get_where('pembiayaan', array('id_anggota'=>$id_anggota));
                //$result->result_array();
                if($id_anggota==null){
                        $this->db->select('*');
                        $this->db->from('pembiayaan');
                        $this->db->join('anggota', 'pembiayaan.id_anggota = anggota.id_anggota');
                        $query = $this->db->get_where('', array('anggota.status'=>"aktif"));
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

        public function get_ijarah($id_anggota=null){

                if($id_anggota==null){
                        $this->db->select('*');
                        $this->db->from('ijarah');
                        $this->db->join('anggota', 'ijarah.id_anggota = anggota.id_anggota');
                        //$this->db->order_by('id_iuran_wajib', 'ASC');
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

                $this->db->select('*');
                $this->db->from('pembiayaan');
                $this->db->where(array('pembiayaan.id_anggota', $id_anggota, 'pembiayaan.status_pembiayaan'=>'Belum Lunas'));
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

        public function cari_pembiayaan($cari){
                //$this->db->order_by('id_iuran_wajib', 'ASC');        
                $cari = str_replace('-',' ',$cari);
                
                $this->db->select('*');
                $this->db->from('pembiayaan');
                //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
                $this->db->join('anggota', 'pembiayaan.id_anggota = anggota.id_anggota');
                //$this->db->like('anggota', $cari)
                //return $query->result_array();
                $this->db->like('anggota.nama', $cari);
                $query = $this->db->get_where('',array('status'=>'aktif'));
                        
                //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 
                return $query->result_array();
                
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

        public function cari_ijarah($cari=null){
                if($cari==null){
                        $this->db->select('*');
                        $this->db->from('ijarah');
                        $this->db->join('anggota', 'ijarah.id_anggota = anggota.id_anggota');
                        //$this->db->order_by('id_iuran_wajib', 'ASC');
                        $query = $this->db->get_where('',array('status'=>'aktif'));
                        return $query->result_array();

                }
                else {
                        $cari = str_replace('-',' ',$cari);
                
                        $this->db->select('*');
                        $this->db->from('ijarah');
                        //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
                        $this->db->join('anggota', 'ijarah.id_anggota = anggota.id_anggota');
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

        public function hapus_pembiayaan($id_pembiayaan){
                return $this->db->delete('pembiayaan', array('id_pembiayaan' => $id_pembiayaan)); 
                

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

        public function cari_anggota_boleh_mendapat_pembiayaan($cari=null){
                //$data_anggota = $this->db->query("SELECT * FROM anggota LEFT JOIN pembiayaan 
                  //                              ON anggota.id_anggota = pembiayaan.id_anggota 
                    //                            WHERE pembiayaan.id_anggota IS NULL 
                      //                          or pembiayaan.status_pembiayaan = 'Lunas'");
                //$data_anggota1 = $this->db->query("SELECT * FROM pembiayaan WHERE sta")
                //print_r($data_anggota->result_array());
                //exit();
                $data_anggota = $this->db->query("SELECT anggota.id_anggota, anggota.nama
                                                 FROM anggota LEFT JOIN pembiayaan
                                                ON anggota.id_anggota = pembiayaan.id_anggota
                                                WHERE anggota.nama LIKE '%$cari%' 
                                                AND anggota.status = 'aktif' 
                                                AND (pembiayaan.id_pembiayaan IS NULL
                                                OR pembiayaan.status_pembiayaan = 'Lunas')");
                return $data_anggota->result_array();
        }

        public function cari_anggota_nonaktif($cari){
                $cari = str_replace('-',' ',$cari);
                $this->db->like('id_anggota', $cari); $this->db->or_like('nama', $cari);
                //$this->db->order_by('id_anggota', 'ASC');
                $query = $this->db->get_where('anggota', array('status'=>'nonaktif'));
                return $query->result_array();

        }

        public function cari_anggota_pembiayaan($cari){  
                $cari = str_replace('-',' ',$cari);
                
                //$this->db->like('id_anggota', $cari); $this->db->or_like('nama', $cari);
                $this->db->select('*');
                $this->db->from('pembiayaan');
                $this->db->join('anggota', 'pembiayaan.id_anggota = anggota.id_anggota');
                $this->db->like('anggota.id_anggota', $cari); $this->db->or_like('anggota.nama', $cari);      
                //$this->db->order_by('id_anggota', 'ASC');
                $query = $this->db->get_where('', array('anggota.status'=>'aktif', 'pembiayaan.status_pembiayaan'=>'Belum Lunas'));
                print_r($query->result_array());
                return $query->result_array();

        }

        public function cari_nama_anggota($id_anggota){
                $query = $this->db->get_where('anggota', array('id_anggota' => $id_anggota));
                return $query->row_array();

                
        }

        public function get_data_pembiayaan_individu($cari){
                //$this->db->select('*');
                //$this->db->from('iuran_wajib');
                $query = $this->db->get_where('pembiayaan', array('id_anggota'=>$cari, 'status_pembiayaan'=>'Belum Lunas'));
                return $query->row_array();
                //$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                
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
                        'bidang' => $this->input->post('bidang'),
                        'alamat' => $this->input->post('alamat'),
                        'tanggal' => $this->input->post('tanggal'),
                        'status' =>'aktif'
                    );
                echo $this->input->post('no_telepon');
                return $this->db->replace('anggota', $data);

        }

        public function get_sisa_pembiayaan_by_id_anggota($id_anggota){
                $data_pembiayaan = $this->db->get_where('pembiayaan', array('id_anggota'=>$id_anggota, 
                'status_pembiayaan'=>"Belum Lunas"))->row_array();
                //$total_angsuran = 
               //echo $data_pembiayaan['id_pembiayaan'];
                //exit();
                $total_angsuran = $this->get_total_angsuran_by_id_pembiayaan($data_pembiayaan['id_pembiayaan']);
                $jumlah_pembiayaan = $data_pembiayaan['jumlah'];
                $sisa_pembiayaan = $jumlah_pembiayaan - $total_angsuran;
                echo $sisa_pembiayaan;
                exit();
                return $sisa_pembiayaan;
                
        }
        
}
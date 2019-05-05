<?php 
    class Model_pembiayaan extends CI_Model{
        public function tambah_pembiayaan(){
                
            $tanggal = date('y-m-d', strtotime($this->input->post('tanggal')));        
            echo $tanggal;
            //exit();
            $data = array(
                    'id_anggota' => $this->input->post('id_anggota'),
                    'tanggal_pembiayaan' => $tanggal,
                    'jumlah' =>str_replace('.','',$this->input->post('jumlah')),
                    'jangka_waktu'=>$this->input->post('jangka_waktu'),
                    'ijarah'=>str_replace(array("Rp. ","."),'',$this->input->post("ijarah")),
                    'pengembalian_pokok'=>str_replace(array("Rp. ","."),'',$this->input->post("pengembalian_pokok")),
                    'keterangan'=>$this->input->post("keterangan"),
                    'status_pembiayaan' =>'Belum Lunas'
                );
            $data1 = array(
                    'id_anggota' => $this->input->post('id_anggota'),
                    'jumlah'=>str_replace(array("Rp. ","."),'',$this->input->post("biaya_administrasi")),
                    'tanggal_transaksi'=> $tanggal
            );
            if($this->db->insert('biaya_admin',$data1)){
                    return $this->db->insert('pembiayaan', $data);
            }    
            else return false;
        }

        public function get_total_biaya_admin_by_date($tanggal_awal,$tanggal_akhir){
            $total = $this->db->query("SELECT SUM('jumlah') AS total_biaya_admin from anggota inner join biaya_admin 
                        on anggota.id_anggota = biaya_admin.id_anggota
                        WHERE (biaya_admin.tanggal_transaksi >= '$tanggal_awal' AND biaya_admin.tanggal_transaksi <= '$tanggal_akhir')
                        AND anggota.status='aktif'")->row()->total_biaya_admin;
            if(empty($total))
                return 0;
            return $total;
        }

        public function get_total_biaya_admin_by_pencarian($cari){
                /*
                $this->db->select('*');
                $this->db->from('iuran_wajib');
                //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
                $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                $this->db->like('anggota.nama', $cari);
                */
                $cari = str_replace('-',' ',$cari);
                //$query = $this->db->query("SELECT *
                //FROM biaya_admin WHERE biaya_admin.id_anggota= ANY(
                //      SELECT id_anggota FROM anggota where nama like '%$cari%')");
                //print_r($query->result_array());
                $total = $this->db->query("SELECT SUM(jumlah) AS total_biaya_admin
                FROM biaya_admin WHERE biaya_admin.id_anggota= ANY(
                        SELECT id_anggota FROM anggota where nama like '%$cari%')")->row()->total_biaya_admin;
                //$total = $this->db->query("SELECT SUM(jumlah_iuran_wajib) as total_iuran_wajib 
                //FROM iuran_wajib ")->row()->total_iuran_wajib;
                echo $total;
                //exit();
                //exit();
                if(empty($total))
                        return 0;
                return $total;
                        
        }

        public function get_total_biaya_admin($id_anggota=null){

                if($id_anggota == null){
                        $this->db->select("(SELECT SUM(jumlah) FROM biaya_admin INNER JOIN
                        anggota on anggota.id_anggota = biaya_admin.id_anggota 
                        WHERE anggota.status='aktif' ) AS total_biaya_admin");
                        $result = $this->db->get()->row();
                        return $result->total_biaya_admin;        
                }
                /*
                $this->db->join('anggota', 'ijarah.id = anggota.id');
                $this->db->select("(SELECT SUM(jumlah) FROM ijarah WHERE id_anggota=$id_anggota) AS total_angsuran");
                $this->db->select_sum('jumlah');
                return $result->total_angsuran;
                */
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
            echo $id_pembiayaan;
            //exit();
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

        public function get_total_pembiayaan(){
            $this->db->from('pembiayaan');
            $this->db->join('anggota', 'anggota.id_anggota=pembiayaan.id_anggota');
            $this->db->where('anggota.status','aktif');
            $this->db->select_sum('jumlah');
            $query = $this->db->get()->row();
            return $query->jumlah;
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

        public function get_biaya_admin($id_anggota=null){

            if($id_anggota==null){
                    $this->db->select('*');
                    $this->db->from('biaya_admin');
                    $this->db->join('anggota', 'biaya_admin.id_anggota = anggota.id_anggota');
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

        public function cari_biaya_admin_by_date($tanggal_awal, $tanggal_akhir){
            $result = $this->db->query("SELECT * from anggota inner join biaya_admin 
            on anggota.id_anggota = biaya_admin.id_anggota
            WHERE (biaya_admin.tanggal_transaksi >= '$tanggal_awal' AND biaya_admin.tanggal_transaksi <= '$tanggal_akhir')
            AND anggota.status='aktif'");
            return $result->result_array();
        }

        public function cari_biaya_admin($cari){
            //$this->db->order_by('id_iuran_wajib', 'ASC');        
            $cari = str_replace('-',' ',$cari);
            
            $this->db->select('*');
            $this->db->from('biaya_admin');
            //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
            $this->db->join('anggota', 'biaya_admin.id_anggota = anggota.id_anggota');
            //$this->db->like('anggota', $cari)
            //return $query->result_array();
            $this->db->like('anggota.nama', $cari);
            $query = $this->db->get_where('',array('status'=>'aktif'));
                    
            //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 
            return $query->result_array();
            
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
        public function hapus_pembiayaan($id_pembiayaan){
            return $this->db->delete('pembiayaan', array('id_pembiayaan' => $id_pembiayaan)); 
            
        }

        public function cari_anggota_boleh_mendapat_pembiayaan($cari=null){
            //$data_anggota = $this->db->query("SELECT * FROM anggota LEFT JOIN pembiayaan 
              //                              ON anggota.id_anggota = pembiayaan.id_anggota 
                //                            WHERE pembiayaan.id_anggota IS NULL 
                  //                          or pembiayaan.status_pembiayaan = 'Lunas'");
            //$data_anggota1 = $this->db->query("SELECT * FROM pembiayaan WHERE sta")
            //print_r($data_anggota->result_array());
            //exit();
            $data_anggota = $this->db->query("SELECT distinct anggota.id_anggota, anggota.nama
                                             FROM anggota LEFT JOIN pembiayaan
                                            ON anggota.id_anggota = pembiayaan.id_anggota
                                            WHERE anggota.status = 'aktif'
                                            AND anggota.id_anggota <> ALL(
                                                    SELECT id_anggota FROM pembiayaan 
                                                    WHERE status_pembiayaan ='Belum Lunas'
                                            ) ");
                                            
            print_r($data_anggota->result_array());
            //exit();
            return $data_anggota->result_array();
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

        public function get_data_pembiayaan_individu($cari){
            //$this->db->select('*');
            //$this->db->from('iuran_wajib');
            $query = $this->db->get_where('pembiayaan', array('id_anggota'=>$cari, 'status_pembiayaan'=>'Belum Lunas'));
            return $query->row_array();
            //$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
            
        }

        public function get_sisa_pembiayaan_by_id_anggota($id_anggota){
            $this->load->model('Model_angsuran');
            $data_pembiayaan = $this->db->get_where('pembiayaan', array('id_anggota'=>$id_anggota, 
            'status_pembiayaan'=>"Belum Lunas"))->row_array();
            //$total_angsuran = 
           //echo $data_pembiayaan['id_pembiayaan'];
            //exit();
            $total_angsuran = $this->Model_angsuran->get_total_angsuran_by_id_pembiayaan($data_pembiayaan['id_pembiayaan']);
            $jumlah_pembiayaan = $data_pembiayaan['jumlah'];
            $sisa_pembiayaan = $jumlah_pembiayaan - $total_angsuran;
            echo $sisa_pembiayaan;
            exit();
            return $sisa_pembiayaan;
            
        }



}
?>
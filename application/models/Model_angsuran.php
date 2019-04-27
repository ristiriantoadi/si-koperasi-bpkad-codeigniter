<?php 
    class Model_angsuran extends CI_Model{
        
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
                        'tanggal_transaksi' => $tanggal,
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

        public function get_data_angsuran($id_pembiayaan){
            $this->db->select('*');
            $this->db->from('angsuran');
            $this->db->join('pembiayaan', 'pembiayaan.id_pembiayaan = angsuran.id_pembiayaan');
                    
            $query = $this->db->get_where('', array('angsuran.id_pembiayaan' => $id_pembiayaan)); 
            return $query->result_array();
            
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

        public function hapus_angsuran($id_angsuran){
            return $this->db->delete('angsuran', array('id_angsuran' => $id_angsuran)); 
            
        }





    }
?>
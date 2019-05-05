<?php
class Model_iuran_wajib extends CI_Model {

    public function tambah_iuran_wajib(){
                
        $tanggal = date('y-m-d', strtotime($this->input->post('tanggal')));        
        echo $tanggal;
        //exit();
        echo $this->input->post('jumlah');
        //exit();
        $data = array(
                'id_anggota' => $this->input->post('id_anggota'),
                'tanggal_transaksi' => $tanggal,
                'jumlah_iuran_wajib' => str_replace(array("Rp. ","."),'',$this->input->post("jumlah"))

            );

        return $this->db->insert('iuran_wajib', $data);    
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
    
    public function get_total_iuran_wajib_by_pencarian($cari){
                /*
                $this->db->select('*');
                $this->db->from('iuran_wajib');
                //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
                $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                $this->db->like('anggota.nama', $cari);
                */
                $cari = str_replace('-',' ',$cari);
                $query = $this->db->query("SELECT *
                FROM iuran_wajib WHERE iuran_wajib.id_anggota= ANY(
                        SELECT id_anggota FROM anggota where nama like '%$cari%')");
                print_r($query->result_array());
                $total = $this->db->query("SELECT SUM(jumlah_iuran_wajib) AS total_iuran_wajib
                FROM iuran_wajib WHERE iuran_wajib.id_anggota= ANY(
                        SELECT id_anggota FROM anggota where nama like '%$cari%' 
                        AND status='aktif')")->row()->total_iuran_wajib;
                //$total = $this->db->query("SELECT SUM(jumlah_iuran_wajib) as total_iuran_wajib 
                //FROM iuran_wajib ")->row()->total_iuran_wajib;
                echo $total;
                //exit();
                //exit();
                if(empty($total))
                        return 0;
                return $total;
                        
    }

    public function get_total_iuran_wajib_by_pencarian_by_date($tanggal_awal, $tanggal_akhir){
        /*
        $this->db->select('*');
        $this->db->from('iuran_wajib');
        //$this->db->where('iuran_wajib.id_anggota', $id_anggota);
        $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
        $this->db->like('anggota.nama', $cari);
        */
        //$cari = str_replace('-',' ',$cari);
        $total = $this->db->query("SELECT SUM(iuran_wajib.jumlah_iuran_wajib) 
                        AS total_iuran_wajib from anggota INNER JOIN iuran_wajib
                        ON anggota.id_anggota = iuran_wajib.id_anggota 
                        WHERE (iuran_wajib.tanggal_transaksi >= '$tanggal_awal' 
                        AND iuran_wajib.tanggal_transaksi <= '$tanggal_akhir') 
                        AND anggota.status = 'aktif'")->row()->total_iuran_wajib;

        //$total = $this->db->query("SELECT SUM(jumlah_iuran_wajib) as total_iuran_wajib 
        //FROM iuran_wajib ")->row()->total_iuran_wajib;
        echo $total;
        //exit();
        //exit();
        if(empty($total))
                return 0;
        return $total;
                
}


    public function get_total_iuran_wajib($id_anggota=null){

        if($id_anggota==null){
                        /*
                        $this->db->select('*');
                        $this->db->from('iuran_wajib');
                        $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        $this->db->order_by('id_iuran_wajib', 'ASC');
                        //$query = $this->db->get_where('',array('status'=>'aktif'));
                        $this->db->where('anggota.status', 'aktif');
                        */
            $total = $this->db->query("SELECT SUM(jumlah_iuran_wajib) as total_iuran_wajib 
                    FROM iuran_wajib INNER JOIN anggota on iuran_wajib.id_anggota=anggota.id_anggota
                    WHERE anggota.status='aktif' ")->row()->total_iuran_wajib;
            if(empty($total))
                return 0;
            return $total;
        }        
        $total = $this->db->query("SELECT SUM(jumlah_iuran_wajib) as total_iuran_wajib 
                FROM iuran_wajib WHERE id_anggota=$id_anggota")->row()->total_iuran_wajib;
               // $this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
                        //$this->db->like('anggota', $cari)
                        //return $query->result_array();
                //$total = $this->db->count_all_results()*200000;
                        //$query = $this->db->get_where('iuran_wajib', array('id_anggota' => $id_anggota)); 


        return $total;
                
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
                //$cari = str_replace('-',' ',$cari);
        
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

    public function cari_iuran_wajib_by_date($tanggal_awal, $tanggal_akhir){
        //$this->db->order_by('id_iuran_wajib', 'ASC');        
        $result = $this->db->query("SELECT * from anggota INNER JOIN iuran_wajib
                        ON anggota.id_anggota = iuran_wajib.id_anggota 
                        WHERE (iuran_wajib.tanggal_transaksi >= '$tanggal_awal' 
                        AND iuran_wajib.tanggal_transaksi <= '$tanggal_akhir') 
                        AND anggota.status = 'aktif'");
        return $result->result_array();
     }

    public function hapus_iuran_wajib($id_iuran_wajib){
        return $this->db->delete('iuran_wajib', array('id_iuran_wajib' => $id_iuran_wajib)); 
    }

}

?>
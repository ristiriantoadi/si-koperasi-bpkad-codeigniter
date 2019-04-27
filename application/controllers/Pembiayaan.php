<?php 
    class Pembiayaan extends CI_Controller{

        public function __construct(){
            parent::__construct();
            if(!$this->session->userdata('admin')){
                redirect(site_url('login'));
            }
            
        }

        public function biaya_admin($id_anggota=null){
		
            $this->load->model('Model_pembiayaan');
            
            $data = array(
                'halaman' => 'biaya_admin',
                //'ijarah'=>$this->Model_anggota->get_ijarah($id_anggota),
                //'total_ijarah' =>$this->Model_anggota->get_total_ijarah($id_anggota)
                //'biaya_admin'
                'biaya_admin'=>$this->Model_pembiayaan->get_biaya_admin($id_anggota),
                'total_biaya_admin'=>$this->Model_pembiayaan->get_total_biaya_admin($id_anggota)
            );
    
            //print_r($data['iuran_wajib']);
            //exit();
    
            $this->load->view('templates/header', $data);
            $this->load->view('data_biaya_admin', $data);
            $this->load->view('templates/footer');
    
        }

        public function data_pembiayaan($id_anggota=null){
            $this->load->model('Model_anggota');
            $this->load->model('Model_pembiayaan');
            $data = array(
                'halaman' => 'pembiayaan',
                'pembiayaan'=>$this->Model_pembiayaan->get_semua_pembiayaan_by_id_anggota($id_anggota)
            );
    
            //print_r($data['iuran_wajib']);
            //exit();
    
            $this->load->view('templates/header', $data);
            $this->load->view('data_pembiayaan', $data);
            $this->load->view('templates/footer');
    
        }

        public function cari_biaya_admin($cari=null){
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            if($cari==null){
                $data=$this->Model_pembiayaan->get_biaya_admin();
                $total_biaya_admin = $this->Model_pembiayaan->get_total_biaya_admin();
            }
            else {
                $data = $this->Model_pembiayaan->cari_biaya_admin($cari);
                $total_biaya_admin = $this->Model_pembiayaan->get_total_biaya_admin_by_pencarian($cari);
            }
            $text="";
            $count=0;  	
            foreach ($data as $data_biaya_admin):
    
                    $text.='<tr>
                          <td>'.($count+1).'</td>
                      <td>'.$data_biaya_admin['nama'].'</td>
                      <td>'.$data_biaya_admin['tanggal_transaksi'].'</td>
                      <td class="uang">'.$data_biaya_admin['jumlah'].'</td>
                                    </tr>';
                    $count++;
                endforeach;
                //$count = $count*200000;
                $text.='<tr>
                                    <td colspan="3"><b>Total Jumlah</b></td>
                                    <td class="uang">'.$total_biaya_admin.'</td>
                                </tr>';
                echo $text;
                //exit();
                return $text;
        }

        public function cari_biaya_admin_by_date($tanggal_awal, $tanggal_akhir){
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');

            $data = $this->Model_pembiayaan->cari_biaya_admin_by_date($tanggal_awal, $tanggal_akhir);
            $total_biaya_admin = $this->Model_pembiayaan->get_total_biaya_admin_by_date($tanggal_awal,$tanggal_akhir);
            $text="";
            $count=0;  	
            foreach ($data as $data_biaya_admin):
    
                    $text.='<tr>
                          <td>'.($count+1).'</td>
                      <td>'.$data_biaya_admin['nama'].'</td>
                      <td>'.$data_biaya_admin['tanggal'].'</td>
                      <td class="uang">'.$data_biaya_admin['jumlah'].'</td>
                                    </tr>';
                    $count++;
                endforeach;
                //$count = $count*200000;
                $text.='<tr>
                                    <td colspan="3"><b>Total Jumlah</b></td>
                                    <td class="uang">'.$total_biaya_admin.'</td>
                                </tr>';
                echo $text;
                //exit();
                return $text;
        }

        public function hapus_pembiayaan($id_pembiayaan){
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            if($this->Model_pembiayaan->hapus_pembiayaan($id_pembiayaan)){
                //echo "sukses";
                $data = $this->Model_pembiayaan->get_pembiayaan();
                $text="";
            $count=0;  	
            foreach ($data as $data_pembiayaan):
                    $count++;
                    $text.='
                    <tr>
                            <td>'.$count.'</td>
                            <td>'.$data_pembiayaan['nama'].'</td>
                            <td class="uang">'.$data_pembiayaan['jumlah'].'</td>
                            <td>'.$data_pembiayaan['jangka_waktu'].' bulan</td>
                            <td class="uang">'.$data_pembiayaan['ijarah'].'</td>
                            <td class="uang">'.$data_pembiayaan['pengembalian_pokok'].'</td>         
                            <td>'.$data_pembiayaan['tanggal'].'</td>
                            <td>'.$data_pembiayaan['keterangan'].'</td>
                            <td class="'.($data_pembiayaan['status_pembiayaan'] == "Belum Lunas" ? 'belum-lunas':'lunas').'">'.$data_pembiayaan['status_pembiayaan'].'</td>
                            <td>
                              <div class="btn-group btn-group-sm">
                                <a href="'.site_url('proses/data_angsuran/'.$data_pembiayaan['id_pembiayaan']).'" class="btn btn-info">
                                  <i class="fa fa-fw fa-info"></i>Lihat detail angsuran</a>
                                <button type="button" class="btn btn-danger hapus-pembiayaan" id="'.$data_pembiayaan['id_pembiayaan'].'">
                                  <i class="fa fa-fw fa-trash-o"></i>Hapus</button>
                              </div>
                            </td>
                          </tr>';
                    //$count++;
                endforeach;
                echo $text;
                //exit();
                return $text;
            }
            else echo "gagal";
    
        }

        public function cari_anggota_boleh_mendapat_pembiayaan($cari=null){
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            //if($cari==null){
                //$data = $this->Model_anggota->cari_anggota_boleh_mendapat_pembiayaan()
            //}
                //$data=$this->Model_anggota->get_data_anggota();
            //else $data = $this->Model_anggota->cari_anggota($cari);
            $data = $this->Model_pembiayaan->cari_anggota_boleh_mendapat_pembiayaan($cari);
            //print_r($data);
            //exit();
            $text="";
            $text1="";
                foreach ($data as $data_anggota):
                    $text.='
                        <option value="'.$data_anggota['id_anggota'].' '.$data_anggota['nama'].'">
    
                    ';
                    //$text1 .=$data_anggota['id_anggota'].' '.$data_anggota['nama'].'\n'; 
                    //echo $data_anggota['id_anggota'];
                    //echo " ";
                endforeach;
                echo $text;
                //echo "y";
                //exit();
                return $text;
        }

        public function cari_jumlah_pembiayaan($cari=null){
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            if($cari==null)
                return "";
            else $data = $this->Model_pembiayaan->get_data_pembiayaan_individu($cari);
            $text="";
                //foreach ($data as $data_anggota):
                    //$text=$data_anggota['nama'];
                //endforeach;
            $text = $data['jumlah'];
                echo $text;
                //exit();
                return $text;
        }

        public function cari_id_pembiayaan($cari=null){
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            if($cari==null)
                return "";
            else $data = $this->Model_pembiayaan->get_data_pembiayaan_individu($cari);
            $text="";
                //foreach ($data as $data_anggota):
                    //$text=$data_anggota['nama'];
                //endforeach;
            $text = $data['id_pembiayaan'];
                echo $text;
                //exit();
                return $text;
        }
    
        public function cari_pembiayaan_pokok($cari=null){
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            if($cari==null)
                return "";
            else $data = $this->Model_pembiayaan->get_data_pembiayaan_individu($cari);
            $text="";
                //foreach ($data as $data_anggota):
                    //$text=$data_anggota['nama'];
                //endforeach;
            $text = $data['pengembalian_pokok'];
                echo $text;
                //exit();
                return $text;
        }

        public function get_sisa_pembiayaan_by_id_anggota($id_anggota){
            $this->load->model('Model_pembiayaan');
            $sisa_pembiayaan = $this->Model_pembiayaan->get_sisa_pembiayaan_by_id_anggota($id_anggota);
            return $sisa_pembiayaan;
        }
    

        public function cari_pembiayaan($cari=null){
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            if($cari==null)
                $data=$this->Model_pembiayaan->get_pembiayaan();
            else $data = $this->Model_pembiayaan->cari_pembiayaan($cari);
            $text="";
            $count=0;
            foreach ($data as $data_pembiayaan):
                    $count++;
                    $text.='
                    <tr>
                            <td>'.$count.'</td>
                            <td>'.$data_pembiayaan['nama'].'</td>
                            <td class="uang">'.$data_pembiayaan['jumlah'].'</td>
                            <td>'.$data_pembiayaan['jangka_waktu'].' bulan</td>
                            <td class="uang">'.$data_pembiayaan['ijarah'].'</td>
                            <td class="uang">'.$data_pembiayaan['pengembalian_pokok'].'</td>         
                            <td>'.$data_pembiayaan['tanggal'].'</td>
                            <td>'.$data_pembiayaan['keterangan'].'</td>
                            <td class="'.($data_pembiayaan['status_pembiayaan'] == "Belum Lunas" ? 'belum-lunas':'lunas').'">'.$data_pembiayaan['status_pembiayaan'].'</td>
                            <td>
                              <div class="btn-group btn-group-sm">
                                <a href="'.site_url('angsuran/data_angsuran/'.$data_pembiayaan['id_pembiayaan']).'" class="btn btn-info">
                                  <i class="fa fa-fw fa-info"></i>Lihat detail angsuran</a>
                                <button type="button" class="btn btn-danger hapus-pembiayaan" id="'.$data_pembiayaan['id_pembiayaan'].'">
                                  <i class="fa fa-fw fa-trash-o"></i>Hapus</button>
                              </div>
                            </td>
                          </tr>';
                endforeach;
                echo $text;
                //exit();
                return $text;
        }
    

        public function page_tambah_pembiayaan(){
            $this->load->model('Model_anggota');
            $this->load->model('Model_master');
            
            $data = array(
                'halaman' => 'tambah_pembiayaan',
                'biaya_admin' => $this->Model_master->get_data_master_biaya_admin()
            );
    
            $this->load->view('templates/header', $data);
            $this->load->view('tambah_pembiayaan', $data);
            $this->load->view('templates/footer');
    
        }

        public function tambah_pembiayaan(){
            $this->load->model('Model_pembiayaan');
            if($this->Model_pembiayaan->tambah_pembiayaan()){
                redirect(site_url('pembiayaan/data_pembiayaan'));
            }else echo "gagal";
        }

    }
?>
<?php 
    class Iuran_wajib extends CI_Controller{

        public function __construct(){
            parent::__construct();
            if(!$this->session->userdata('admin')){
                redirect(site_url('login'));
            }
            
        }

        public function data_iuran_wajib($id_anggota=null){
            $this->load->model('Model_anggota');
            $this->load->model('Model_iuran_wajib');
            
            $data = array(
                'halaman' => 'iuran_wajib',
                'iuran_wajib'=>$this->Model_iuran_wajib->get_iuran_wajib($id_anggota),
                'total_iuran_wajib'=>$this->Model_iuran_wajib->get_total_iuran_wajib($id_anggota)
            );
    
            //print_r($data['iuran_wajib']);
            //exit();
    
            $this->load->view('templates/header', $data);
            $this->load->view('iuran_wajib', $data);
            $this->load->view('templates/footer');
    
        }
    
        
        public function page_tambah_iuran_wajib(){
            $this->load->model('Model_anggota');
            $this->load->model('Model_iuran_wajib');
            $this->load->model('Model_master');
            
            $data = array(
                'halaman' => 'tambah_iuran_wajib',
                'jumlah_iuran_wajib' => $this->Model_master->get_data_master_iuran_wajib()
            );
    
            $this->load->view('templates/header', $data);
            $this->load->view('tambah_iuran_wajib', $data);
            $this->load->view('templates/footer');
    
        }

        public function tambah_iuran_wajib(){
            $this->load->model('Model_anggota');
            $this->load->model('Model_iuran_wajib');
            //echo $this->input->post('anggota');
            if($this->Model_iuran_wajib->tambah_iuran_wajib()){
                //echo "sukses";
                $this->load->helper('url'); 
                redirect(site_url('iuran_wajib/data_iuran_wajib'));
            }
            else echo "gagal";
    
        }

        public function cari_iuran_wajib($cari=null){
            $this->load->model('Model_iuran_wajib');
            //echo $this->input->post('anggota');
            if($cari==null){
                $data=$this->Model_iuran_wajib->get_iuran_wajib();
                $total_iuran_wajib = $this->Model_iuran_wajib->get_total_iuran_wajib();
            }
            else {
                $cari = str_replace('-', ' ',$cari);
                $data = $this->Model_iuran_wajib->cari_iuran_wajib($cari);
                $total_iuran_wajib = $this->Model_iuran_wajib->get_total_iuran_wajib_by_pencarian($cari);
            }
            $text="";
            $count=0;  	
            foreach ($data as $data_iuran):
    
                    $text.='<tr>
                          <td>'.($count+1).'</td>
                      <td>'.$data_iuran['nama'].'</td>
                      <td>'.$data_iuran['tanggal_transaksi'].'</td>
                      <td class="uang">'.$data_iuran['jumlah_iuran_wajib'].'</td>
                                    </tr>';
                    $count++;
                endforeach;
                $count = $count*200000;
                $text.='<tr>
                                    <td colspan="3"><b>Total Jumlah</b></td>
                                    <td class="uang">'.$total_iuran_wajib.'</td>
                                </tr>';
                echo $text;
                //exit();
                return $text;
        }

        public function cari_iuran_wajib_by_date($tanggal_awal, $tanggal_akhir){
            $this->load->model('Model_iuran_wajib');
            //echo $this->input->post('anggota');
            $data = $this->Model_iuran_wajib->cari_iuran_wajib_by_date($tanggal_awal, $tanggal_akhir);
            $total_iuran_wajib = $this->Model_iuran_wajib->get_total_iuran_wajib_by_pencarian_by_date($tanggal_awal,$tanggal_akhir);
            $text="";
            $count=0;  	
            foreach ($data as $data_iuran):
    
                    $text.='<tr>
                          <td>'.($count+1).'</td>
                      <td>'.$data_iuran['nama'].'</td>
                      <td>'.$data_iuran['tanggal_transaksi'].'</td>
                      <td class="uang">'.$data_iuran['jumlah_iuran_wajib'].'</td>
                                    </tr>';
                    $count++;
                endforeach;
                //$count = $count*200000;
                $text.='<tr>
                                    <td colspan="3"><b>Total Jumlah</b></td>
                                    <td class="uang">'.$total_iuran_wajib.'</td>
                                </tr>';
                echo $text;
                //exit();
                return $text;
        }

        public function hapus_iuran_wajib($id_anggota){
            $this->load->model('Model_anggota');
            $this->load->model('Model_iuran_wajib');
            //echo $this->input->post('anggota');
            if($this->Model_iuran_wajib->hapus_iuran_wajib($id_anggota)){
                //echo "sukses";
                $data = $this->Model_iuran_wajib->get_iuran_wajib();
                $text="";
                $total_iuran_wajib = $this->Model_iuran_wajib->get_total_iuran_wajib();
            $count=0;  	
            foreach ($data as $data_iuran):
                    $count++;
                    $text.='<tr>
                          <td>'.($count).'</td>
                      <td>'.$data_iuran['nama'].'</td>
                      <td>'.$data_iuran['tanggal_transaksi'].'</td>
                      <td class="uang">'.$data_iuran['jumlah_iuran_wajib'].'</td>
                      <td>
                          <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-danger hapus-iuran-wajib" id="'.$data_iuran['id_iuran_wajib'].'">
                                    <i class="fa fa-fw fa-trash-o"></i>Hapus</button>
                                </div>
                              </td>
                                    </tr>';
                    //$count++;
                endforeach;
                $count = $count*200000;
                $text.='<tr>
                                    <td colspan="3"><b>Total Jumlah</b></td>
                                    <td class="uang">'.$total_iuran_wajib.'</td>
                                </tr>';
                echo $text;
                //exit();
                return $text;
            }
            else echo "gagal";
    
        }
    
        public function cari_anggota_iuran($cari=null){
            $this->load->model('Model_anggota');
            //echo $this->input->post('anggota');
            if($cari==null)
                $data=$this->Model_anggota->get_data_anggota();
            else $data = $this->Model_anggota->cari_anggota_aktif($cari);
            $text="";
                foreach ($data as $data_anggota):
                    $text.='
                        <option value="'.$data_anggota['id_anggota'].' '.$data_anggota['nama'].'">
    
                    ';
                endforeach;
                echo $text;
                //exit();
                return $text;
        }
    }
?>
<?php 
    class Angsuran extends CI_Controller{

        public function __construct(){
            parent::__construct();
            if(!$this->session->userdata('admin')){
                redirect(site_url('login'));
            }
            
        }

        public function data_angsuran($id_pembiayaan){
            $this->load->model('Model_anggota');
            $this->load->model('Model_angsuran');
            $this->load->model('Model_pembiayaan');
            $data = array(
                'halaman' => 'data_angsuran',
                'angsuran'=> $this->Model_angsuran->get_data_angsuran($id_pembiayaan)
            );
            //$data['sisa_pembia']
            //$data['total_angsuran']=$this->Model_anggota->get_total_angsuran($id_anggota);
            //$data['sisa_pembiayaan']=$this->Model_anggota->get_sisa_pembiayaan($id_anggota);
            //echo $data['sisa_pembiayaan'];
            //exit();
            $data['pembiayaan'] = $this->Model_pembiayaan->get_jumlah_pembiayaan($id_pembiayaan);

            $this->load->view('templates/header', $data);
            $this->load->view('data_angsuran', $data);
            $this->load->view('templates/footer');
        }
        
        public function ijarah($id_anggota=null){
            $this->load->model('Model_anggota');
            $this->load->model('Model_angsuran');
            
            $data = array(
                'halaman' => 'ijarah',
                'ijarah'=>$this->Model_angsuran->get_ijarah($id_anggota),
                'total_ijarah' =>$this->Model_angsuran->get_total_ijarah($id_anggota)
            );
    
            //print_r($data['iuran_wajib']);
            //exit();
    
            $this->load->view('templates/header', $data);
            $this->load->view('data_ijarah', $data);
            $this->load->view('templates/footer');
    
        }

        public function cek_lunas($id_pembiayaan){
            $this->load->model('Model_anggota');
            $this->load->model('Model_angsuran');
            $this->load->model('Model_pembiayaan');
            //echo "yes";
            //exit();
            if($this->Model_pembiayaan->is_lunas($id_pembiayaan)){
                return true;
            }
            else{
                //echo "yes";
                //exit();
                $total_angsuran = $this->Model_angsuran->get_total_angsuran_by_id_pembiayaan($id_pembiayaan);
                $jumlah_pembiayaan = $this->Model_pembiayaan->get_pembiayaan_by_id_pembiayaan($id_pembiayaan);
                $sisa_pembiayaan = $jumlah_pembiayaan-$total_angsuran;
    
                if($sisa_pembiayaan == 0){
                            if($this->Model_pembiayaan->set_lunas($id_pembiayaan))
                                return true;
                }
            }	
    
        }

        public function page_tambah_angsuran(){
            $data = array(
                'halaman' => 'tambah_angsuran'
            );
    
            $this->load->view('templates/header', $data);
            $this->load->view('tambah_angsuran', $data);
            $this->load->view('templates/footer');
    
        }

        public function tambah_angsuran(){
            $this->load->model('Model_anggota');
            $this->load->model('Model_angsuran');
            
            if($this->Model_angsuran->tambah_angsuran()){
                if($this->Model_angsuran->tambah_ijarah()){
                    if($this->cek_lunas($this->input->post('id_pembiayaan'))){
                        //return "lunas";
                    }
                    //else return "belum lunas";
                    //exit();
                    redirect(site_url('pembiayaan/data_pembiayaan'));
                }
            }else echo "gagal";
        }

        public function hapus_angsuran($id_angsuran, $id_pembiayaan){
            $this->load->model('Model_angsuran');
            $this->Model_angsuran->hapus_angsuran($id_angsuran);
            redirect(site_url('anggota/data_angsuran/'.$id_pembiayaan));
        }

        public function cari_anggota_angsuran($cari=null){
            $this->load->model('Model_anggota');
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            if($cari==null)
                $data=$this->Model_pembiayaan->get_data_anggota_pembiayaan();
            else $data = $this->Model_pembiayaan->cari_anggota_pembiayaan($cari);
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

        public function cari_ijarah($cari=null){//apa gunanya ini? bukan pencarian ijarah yg jelas
            $this->load->model('Model_pembiayaan');
            //echo $this->input->post('anggota');
            if($cari==null)
                return "";
            else $data = $this->Model_pembiayaan->get_data_pembiayaan_individu($cari);
            $text="";
                //foreach ($data as $data_anggota):
                    //$text=$data_anggota['nama'];
                //endforeach;
            $text = $data['ijarah'];
                echo $text;
                //exit();
                return $text;
        }

        public function cari_data_ijarah($cari=null){
            $this->load->model('Model_anggota');
            $this->load->model('Model_angsuran');
    
    
            //echo $this->input->post('anggota');
            //if($cari==null)
                //$data=$this->Model_anggota->get_data_anggota($cari)
            //else 
            $data = $this->Model_angsuran->cari_ijarah($cari);
            $cari = str_replace('-', ' ',$cari);
            $total_ijarah = $this->Model_angsuran->get_total_ijarah_by_keyword($cari);
            $text="";
            $count=0;  	
            foreach ($data as $data_ijarah):
                    $count++;
                    $text.='<tr>
                          <td>'.($count).'</td>
                      <td>'.$data_ijarah['nama'].'</td>
                      <td>'.$data_ijarah['tanggal_transaksi'].'</td>
                      <td class="uang">'.$data_ijarah['jumlah'].'</td>
                      
                                    </tr>';
                    //$count++;
                endforeach;
                //$count = $count*200000;
                $text.='<tr>
                                    <td colspan="3"><b>Total Jumlah</b></td>
                                    <td class="uang">'.$total_ijarah.'</td>
                                </tr>';
                echo $text;
                //exit();
                return $text;
        }
        
        

    }
?>
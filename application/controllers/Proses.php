<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function tambah_anggota(){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($this->Model_anggota->tambah_anggota()){
			//echo "sukses";
			$this->load->helper('url'); 
			redirect(site_url('anggota'));
		}
		else echo "gagal";

	}

	public function tambah_pembiayaan(){
		$this->load->model('Model_anggota');
		if($this->Model_anggota->tambah_pembiayaan()){
			redirect(site_url('anggota/pembiayaan'));
		}else echo "gagal";
	}

	public function tambah_angsuran(){
		$this->load->model('Model_anggota');
		if($this->Model_anggota->tambah_angsuran()){
			redirect(site_url('anggota/pembiayaan'));
		}else echo "gagal";
	}

	public function tambah_iuran_wajib(){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($this->Model_anggota->tambah_iuran_wajib()){
			//echo "sukses";
			$this->load->helper('url'); 
			redirect(site_url('anggota/iuran_wajib'));
		}
		else echo "gagal";

	}

	public function edit_anggota(){
		$this->load->model('Model_anggota');
		//echo $this->input->post('id-anggota');
		//exit();
		if($this->Model_anggota->edit_anggota()){
			//echo "sukses";
			$this->load->helper('url'); 
			redirect(site_url('anggota/data/'.$this->input->post('id_anggota')));
		}
		else echo "gagal";

	}

	public function nonaktifkan_anggota($id_anggota){
		$this->load->model('Model_anggota');
		if($this->Model_anggota->nonaktifkan_anggota($id_anggota)){
			//echo "sukses";
			$data = $this->Model_anggota->get_data_anggota();
			$text="";
			foreach ($data as $data_anggota):
				$text.='
				<tr>
					<td>'.$data_anggota['id_anggota'].'</td>
					<td>'.$data_anggota['nama'].'</td>
					<td>'.$data_anggota['no_telepon'].'</td>
					<td>'.$data_anggota['bidang'].'</td>
					<td>'.$data_anggota['alamat'].'</td>
					<td>'.$data_anggota['tanggal'].'</td>
					<td>
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info">
						<i class="fa fa-fw fa-info"></i>Lihat selengkapnya</button>
						<button type="button" class="btn btn-danger hapus" id="'.$data_anggota['id_anggota'].'">
						<i class="fa fa-fw fa-trash-o"></i>Nonaktif</button>
					</div>
					</td>
			 	 </tr>';
			endforeach;
			echo $text;
			//exit();
			return $text;
		}
		else echo "gagal";
	}

	public function hapus_anggota($id_anggota){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($this->Model_anggota->hapus_anggota($id_anggota)){
			//echo "sukses";
			$data = $this->Model_anggota->get_data_anggota();
			$text="";
			foreach ($data as $data_anggota):
				$text.='
				<tr>
					<td>'.$data_anggota['id_anggota'].'</td>
					<td>'.$data_anggota['nama'].'</td>
					<td>'.$data_anggota['no_telepon'].'</td>
					<td>'.$data_anggota['bidang'].'</td>
					<td>'.$data_anggota['alamat'].'</td>
					<td>'.$data_anggota['tanggal'].'</td>
					<td>
					<div class="btn-group btn-group-sm">
						<button type="button" class="btn btn-info">
						<i class="fa fa-fw fa-info"></i>Lihat selengkapnya</button>
						<button type="button" class="btn btn-danger hapus" id="'.$data_anggota['id_anggota'].'">
						<i class="fa fa-fw fa-trash-o"></i>Hapus</button>
					</div>
					</td>
			 	 </tr>';
			endforeach;
			echo $text;
			//exit();
			return $text;
		}
		else echo "gagal";

	}
	public function cari_anggota_aktif($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			$data=$this->Model_anggota->get_data_anggota();
		else $data = $this->Model_anggota->cari_anggota_aktif($cari);
		$text="";
			foreach ($data as $data_anggota):
				$text.='
				<tr>
					<td>'.$data_anggota['id_anggota'].'</td>
					<td>'.$data_anggota['nama'].'</td>
					<td>'.$data_anggota['no_telepon'].'</td>
					<td>'.$data_anggota['bidang'].'</td>
					<td>'.$data_anggota['alamat'].'</td>
					<td>'.$data_anggota['tanggal'].'</td>
					<td>
					<div class="btn-group btn-group-sm">
                            <a href="'.site_url('anggota/data/'.$data_anggota['id_anggota']).'" class="btn btn-info">
                              <i class="fa fa-fw fa-info"></i>Lihat selengkapnya</a>
                            <button type="button" class="btn btn-danger hapus" id="'.$data_anggota['id_anggota'].'">
                              <i class="fa fa-fw fa-trash-o"></i>Nonaktif</button>
                          </div>
					</td>
			 	 </tr>';
			endforeach;
			echo $text;
			//exit();
			return $text;
	}

	public function cari_iuran_wajib($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			$data=$this->Model_anggota->get_iuran_wajib();
		else $data = $this->Model_anggota->cari_iuran_wajib($cari);
		$text="";
		$count=0;  	
		foreach ($data as $data_iuran):

				$text.='<tr>
              		<td>'.($count+1).'</td>
                  <td>'.$data_iuran['nama'].'</td>
                  <td>'.$data_iuran['tanggal_transaksi'].'</td>
                  <td>Rp. 200.000</td>
                  <td>
                  	<div class="btn-group btn-group-sm">
                    	<button type="button" class="btn btn-danger hapus-iuran-wajib" id="'.$data_iuran['id_iuran_wajib'].'">
                                <i class="fa fa-fw fa-trash-o"></i>Hapus</button>
                            </div>
                          </td>
								</tr>';
				$count++;
			endforeach;
			$count = $count*200000;
			$text.='<tr>
								<td colspan="3"><b>Total Jumlah</b></td>
								<td class="uang">'.$count.'</td>
							</tr>';
			echo $text;
			//exit();
			return $text;
	}

	public function hapus_iuran_wajib($id_anggota){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($this->Model_anggota->hapus_iuran_wajib($id_anggota)){
			//echo "sukses";
			$data = $this->Model_anggota->get_iuran_wajib();
			$text="";
		$count=0;  	
		foreach ($data as $data_iuran):

				$text.='<tr>
              		<td>'.$data_iuran['id_iuran_wajib'].'</td>
                  <td>'.$data_iuran['nama'].'</td>
                  <td>'.$data_iuran['tanggal_transaksi'].'</td>
                  <td>Rp. 200.000</td>
                  <td>
                  	<div class="btn-group btn-group-sm">
                    	<button type="button" class="btn btn-danger hapus-iuran-wajib" id="'.$data_iuran['id_iuran_wajib'].'">
                                <i class="fa fa-fw fa-trash-o"></i>Hapus</button>
                            </div>
                          </td>
								</tr>';
				$count++;
			endforeach;
			$count = $count*200000;
			$text.='<tr>
								<td colspan="3"><b>Total Jumlah</b></td>
								<td class="uang">'.$count.'</td>
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
		else $data = $this->Model_anggota->cari_anggota($cari);
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

	public function cari_anggota_angsuran($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			$data=$this->Model_anggota->get_data_anggota_pembiayaan();
		else $data = $this->Model_anggota->cari_anggota_pembiayaan($cari);
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
	public function cari_nama_anggota($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			return "";
		else $data = $this->Model_anggota->cari_nama_anggota($cari);
		$text="";
			//foreach ($data as $data_anggota):
				//$text=$data_anggota['nama'];
			//endforeach;
		$text = $data['nama'];
			echo $text;
			//exit();
			return $text;
	}

	public function cari_jumlah_pembiayaan($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			return "";
		else $data = $this->Model_anggota->get_data_pembiayaan_individu($cari);
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
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			return "";
		else $data = $this->Model_anggota->get_data_pembiayaan_individu($cari);
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
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			return "";
		else $data = $this->Model_anggota->get_data_pembiayaan_individu($cari);
		$text="";
			//foreach ($data as $data_anggota):
				//$text=$data_anggota['nama'];
			//endforeach;
		$text = $data['pengembalian_pokok'];
			echo $text;
			//exit();
			return $text;
	}

	public function cari_ijarah($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			return "";
		else $data = $this->Model_anggota->get_data_pembiayaan_individu($cari);
		$text="";
			//foreach ($data as $data_anggota):
				//$text=$data_anggota['nama'];
			//endforeach;
		$text = $data['ijarah'];
			echo $text;
			//exit();
			return $text;
	}


	
}

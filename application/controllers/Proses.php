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
					<td>'.$data_anggota['nama_bidang'].'</td>
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
					<td>'.$data_anggota['nama_bidang'].'</td>
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

	public function cari_anggota_nonaktif($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			$data=$this->Model_anggota->get_data_anggota_non_aktif();
		else $data = $this->Model_anggota->cari_anggota_non_aktif($cari);
		$text="";
			foreach ($data as $data_anggota):
				$text.='
				<tr>
					<td>'.$data_anggota['id_anggota'].'</td>
					<td>'.$data_anggota['nama'].'</td>
					<td>'.$data_anggota['no_telepon'].'</td>
					<td>'.$data_anggota['nama_bidang'].'</td>
					<td>'.$data_anggota['alamat'].'</td>
					<td>'.$data_anggota['tanggal'].'</td>
					<td>
						<div class="btn-group btn-group-sm">
                            <a href="'.site_url('anggota/data/'.$data_anggota['id_anggota']).'" class="btn btn-info">
                              <i class="fa fa-fw fa-info"></i>Lihat selengkapnya</a>
          	</div>
					</td>
			 	 </tr>';
			endforeach;
			echo $text;
			//exit();
			return $text;
	}

	public function cari_iuran_pokok($cari=null){
		$this->load->model('Model_anggota');
		$cari = str_replace('-',' ',$cari);
		//echo $this->input->post('anggota');
		//if($cari==null)
			//$data=$this->Model_anggota->get_data_anggota($cari)
		//else 
		$data = $this->Model_anggota->cari_iuran_pokok($cari);
		$text="";
		$count=0;
		$total_iuran_pokok=0;  	
		foreach ($data as $data_iuran_pokok):

				$text.='<tr>
              		<td>'.($count+1).'</td>
                  <td>'.$data_iuran_pokok['nama'].'</td>
                  <td>'.$data_iuran_pokok['tanggal'].'</td>
                  <td class="uang">'.$data_iuran_pokok['iuran_pokok'].'</td>
                  
								</tr>';
				$count++;
				$total_iuran_pokok += (int) $data_iuran_pokok['iuran_pokok'];


			endforeach;
			$count = $count*200000;
			$text.='<tr>
								<td colspan="3"><b>Total Jumlah</b></td>
								<td class="uang">'.$total_iuran_pokok.'</td>
							</tr>';
			echo $text;
			//exit();
			return $text;
	}
	
	public function edit_data_bidang(){
		$this->load->model('Model_master');
		print_r($this->input->post('nama_bidang'));
		//echo count($this->input->post('nama_bidang'));
		//exit();
		if($this->Model_master->edit_data_bidang())
			redirect(site_url('anggota'));
		else echo "gagal";
	}

	public function edit_data_master_iuran_wajib(){
		$this->load->model('Model_master');
		//$data
		//$this->db->insert()
	
		if($this->Model_master->edit_data_master_iuran_wajib())
			redirect(site_url('anggota'));
		else echo "gagal";
	}

	public function edit_data_master_biaya_admin(){
		$this->load->model('Model_master');
		//$data
		//$this->db->insert()
		/*
		$data = array(
			'jumlah_iuran_wajib' => str_replace(array("Rp. ","."),'',$this->input->post("jumlah_iuran_wajib"))
		);
		*/
		if($this->Model_master->edit_data_master_biaya_admin())
			redirect(site_url('anggota'));
		else echo "gagal";
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

	
}

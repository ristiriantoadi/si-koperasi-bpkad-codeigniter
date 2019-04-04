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
			if($this->Model_anggota->tambah_ijarah()){
				if($this->cek_lunas($this->input->post('id_pembiayaan'))){
					//return "lunas";
				}
				//else return "belum lunas";
				//exit();
				redirect(site_url('anggota/pembiayaan'));
			}
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

	public function cari_pembiayaan($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($cari==null)
			$data=$this->Model_anggota->get_pembiayaan();
		else $data = $this->Model_anggota->cari_pembiayaan($cari);
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
                            <a href="'.site_url('anggota/data_angsuran/'.$data_pembiayaan['id_pembiayaan']).'" class="btn btn-info">
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

	public function cari_iuran_pokok($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		//if($cari==null)
			//$data=$this->Model_anggota->get_data_anggota($cari)
		//else 
		$data = $this->Model_anggota->cari_iuran_pokok($cari);
		$text="";
		$count=0;  	
		foreach ($data as $data_iuran_pokok):

				$text.='<tr>
              		<td>'.($count+1).'</td>
                  <td>'.$data_iuran_pokok['nama'].'</td>
                  <td>'.$data_iuran_pokok['tanggal'].'</td>
                  <td class="uang">'.$data_iuran_pokok['iuran_pokok'].'</td>
                  
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

	public function cari_data_ijarah($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		//if($cari==null)
			//$data=$this->Model_anggota->get_data_anggota($cari)
		//else 
		$data = $this->Model_anggota->cari_ijarah($cari);
		$total_ijarah = $this->Model_anggota->get_total_ijarah_by_keyword($cari);
		$text="";
		$count=0;  	
		foreach ($data as $data_ijarah):
				$count++;
				$text.='<tr>
              		<td>'.($count).'</td>
                  <td>'.$data_ijarah['nama'].'</td>
                  <td>'.$data_ijarah['tanggal'].'</td>
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

	public function hapus_pembiayaan($id_pembiayaan){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($this->Model_anggota->hapus_pembiayaan($id_pembiayaan)){
			//echo "sukses";
			$data = $this->Model_anggota->get_pembiayaan();
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
                            <a href="'.site_url('anggota/data_angsuran/'.$data_pembiayaan['id_pembiayaan']).'" class="btn btn-info">
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

	public function hapus_iuran_wajib($id_anggota){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($this->Model_anggota->hapus_iuran_wajib($id_anggota)){
			//echo "sukses";
			$data = $this->Model_anggota->get_iuran_wajib();
			$text="";
		$count=0;  	
		foreach ($data as $data_iuran):
				$count++;
				$text.='<tr>
              		<td>'.($count).'</td>
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
				//$count++;
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

	public function cari_anggota_boleh_mendapat_pembiayaan($cari=null){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		//if($cari==null){
			//$data = $this->Model_anggota->cari_anggota_boleh_mendapat_pembiayaan()
		//}
			//$data=$this->Model_anggota->get_data_anggota();
		//else $data = $this->Model_anggota->cari_anggota($cari);
		$data = $this->Model_anggota->cari_anggota_boleh_mendapat_pembiayaan($cari);
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

	public function edit_data_bidang(){
		$this->load->model('Model_anggota');
		print_r($this->input->post('nama_bidang'));
		//echo count($this->input->post('nama_bidang'));
		//exit();
		$data = array();
		for($i = 0;$i<count($this->input->post('nama_bidang'));$i++){
			$data[$i]['id_bidang'] = ($i+1);
			$data[$i]['nama_bidang'] = $this->input->post('nama_bidang')[$i];
		}
		$this->db->query('TRUNCATE bidang');
		$this->db->insert_batch('bidang', $data);
		redirect(site_url('anggota'));
		
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

	public function cek_lunas($id_pembiayaan){
		$this->load->model('Model_anggota');
		//echo "yes";
		//exit();
		if($this->Model_anggota->is_lunas($id_pembiayaan)){
			return true;
		}
		else{
			//echo "yes";
			//exit();
			$total_angsuran = $this->Model_anggota->get_total_angsuran_by_id_pembiayaan($id_pembiayaan);
			$jumlah_pembiayaan = $this->Model_anggota->get_pembiayaan_by_id_pembiayaan($id_pembiayaan);
			$sisa_pembiayaan = $jumlah_pembiayaan-$total_angsuran;

			if($sisa_pembiayaan == 0){
						if($this->Model_anggota->set_lunas($id_pembiayaan))
							return true;
			}
		}	

	}

	public function get_sisa_pembiayaan_by_id_anggota($id_anggota){
		$this->load->model('Model_anggota');
		$sisa_pembiayaan = $this->Model_anggota->get_sisa_pembiayaan_by_id_anggota($id_anggota);
		return $sisa_pembiayaan;
	}


	
}

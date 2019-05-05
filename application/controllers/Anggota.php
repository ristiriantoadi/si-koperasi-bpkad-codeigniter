<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

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
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin')){
			redirect(site_url('login'));
		}
		
	}

	public function index()//data keseluruhan semua anggota aktif koperasi BPKAD
	{
		$this->load->model('Model_anggota');
		$this->load->model('Model_iuran_wajib');
		$this->load->model('Model_pembiayaan');
		$this->load->model('Model_angsuran');
		
		$data = array(
			'halaman' => 'beranda',
			//'anggota'=> $this->Model_anggota->get_data_anggota()
			'jumlah_anggota_aktif'=> $this->Model_anggota->get_total_jumlah_anggota_aktif(),
			'jumlah_anggota_nonaktif' => $this->Model_anggota->get_total_jumlah_anggota_nonaktif(),
			'jumlah_iuran_wajib' => $this->Model_iuran_wajib->get_total_iuran_wajib(),
			'jumlah_iuran_pokok' => $this->Model_anggota->get_total_iuran_pokok(),
			'jumlah_pembiayaan' => $this->Model_pembiayaan->get_total_pembiayaan(),
			'jumlah_ijarah' => $this->Model_angsuran->get_total_ijarah(),
			'jumlah_biaya_administrasi' => $this->Model_pembiayaan->get_total_biaya_admin()
		);
		//print_r($data);
		//exit();

		$this->load->view('templates/header', $data);
		$this->load->view('beranda', $data);
		$this->load->view('templates/footer');
	}

	public function aktif(){//data keseluruhan anggota aktif koperasi BPKAD
		$this->load->model('Model_anggota');
		$data = array(
			'halaman' => 'data_anggota_aktif',
			'anggota'=> $this->Model_anggota->get_data_anggota()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('data_anggota', $data);
		$this->load->view('templates/footer');
	}

	/*
	public function get_total_jumlah_anggota_aktif(){
		$this->load->model('Model_anggota');
		echo $this->Model_anggota->get_total_jumlah_anggota_aktif();
		exit();
	}
	*/

	
	public function nonaktif(){//data keseluruhan anggota nonaktif BPKAD
		$this->load->model('Model_anggota');
		$data = array(
			'halaman' => 'data_anggota_non_aktif',
			'anggota'=> $this->Model_anggota->get_data_anggota_nonaktif()
		);
		//print_r($data['anggota']);
		//exit();
		$this->load->view('templates/header', $data);
		$this->load->view('data_anggota_non_aktif', $data);
		$this->load->view('templates/footer');
	}

	public function data($id_anggota)//data individu anggota
	{
		$this->load->model('Model_anggota');
		$this->load->model('Model_angsuran');
		$this->load->model('Model_pembiayaan');
		
		$this->load->model('Model_iuran_wajib');
		$data = array(
			'halaman' => 'data_anggota_aktif',
			'anggota'=> $this->Model_anggota->get_data_anggota($id_anggota)
		);
		//$data['sisa_pembia']
		$data['total_iuran_wajib']=$this->Model_iuran_wajib->get_total_iuran_wajib($id_anggota);
		//$data['pembiayaan'] = $this->Model_anggota->
		//$data['sisa_pembiayaan']=$this->Model_anggota->get_sisa_pembiayaan($id_anggota);

		//$pembiayaan = $this->Model_anggota->get_sisa_pembiayaan($id_anggota);
		$pembiayaan  = $this->Model_pembiayaan->get_pembiayaan($id_anggota);
		//print_r($pembiayaan);
		//exit();
		if(!empty($pembiayaan)){
			//echo print_r($pembiayaan);
			//exit();
			$angsuran = $this->Model_angsuran->get_total_angsuran_by_id_pembiayaan($pembiayaan['id_pembiayaan']);
			$data['sisa_pembiayaan'] = $pembiayaan['jumlah']-$angsuran;
			//echo $data['sisa_pembiayaan'];
			//exit();
			$data['total_angsuran'] = $angsuran;
			$data['pembiayaan']['id_pembiayaan'] = $pembiayaan['id_pembiayaan'];
			
			//kalau ternyata sudah lunas pembiayaan, maka data reset ke awal
			if($data['sisa_pembiayaan'] < 0){
				$data['total_angsuran'] = 0; 
				$data['sisa_pembiayaan'] = 0;
			}
		}
		else{
			$data['total_angsuran'] = 0;
			$data['sisa_pembiayaan'] = 0;
			$data['pembiayaan']['id_pembiayaan'] = -1;
 		}

		$this->load->view('templates/header', $data);
		$this->load->view('data_individu', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_anggota(){
		$this->load->model('Model_anggota');
		$this->load->model('Model_master');
		
		$data = array(
			'halaman' => 'tambah_anggota',
			'bidang'=> $this->Model_anggota->get_data_bidang(),
			'jumlah_iuran_wajib' => $this->Model_master->get_data_master_iuran_wajib()
		);

		$this->db->select('*');
		$this->db->from('anggota');
		//$this->db->where('iuran_wajib.id_anggota', $id_anggota);
		//$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
		$this->db->limit(1);
		$this->db->order_by('id_anggota', 'DESC');
		$data['anggota'] = $this->db->get()->row_array();
		if(empty($data['anggota'])){
			$data['anggota']['id_anggota'] = 1;
			
		}
		else $data['anggota']['id_anggota'] += 1;
		
		$this->load->view('templates/header', $data);
		$this->load->view('tambah_anggota');
		$this->load->view('templates/footer');

	}

	public function proses_tambah_anggota(){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		if($this->Model_anggota->tambah_anggota()){
			//echo "sukses";
			$this->load->helper('url'); 
			redirect(site_url('anggota/aktif'));
		}
		else echo "gagal";

	}


	public function edit_anggota($id_anggota){
		$this->load->model('Model_anggota');
		
		$data = array(
			'halaman' => 'data_anggota',
			'anggota'=> $this->Model_anggota->get_data_anggota($id_anggota),
			'bidang' => $this->Model_anggota->get_data_bidang()
		);
		$this->load->view('templates/header', $data);
		$this->load->view('edit_anggota', $data);
		$this->load->view('templates/footer');
	}
	
	public function cari_iuran_pokok_by_date($tanggal_awal, $tanggal_akhir){
		$this->load->model('Model_anggota');
		//echo $this->input->post('anggota');
		$data = $this->Model_anggota->cari_iuran_pokok_by_date($tanggal_awal, $tanggal_akhir);
		
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

	public function iuran_pokok($id_anggota=null){
		$this->load->model('Model_anggota');
		
		$data = array(
			'halaman' => 'iuran_pokok',
			'iuran_pokok' => $this->Model_anggota->get_data_iuran_pokok($id_anggota),
			'total_iuran_pokok'=> $this->Model_anggota->get_total_iuran_pokok()
		);
		
		/*
		if($id_anggota==null){
			$this->load->view('templates/header', $data);
			$this->load->view('iuran_pokok', $data);
			$this->load->view('templates/footer');

		}
		else{
			$this->load->view('templates/header', $data);
			$this->load->view('iuran_pokok_individu', $data);
			$this->load->view('templates/footer');
		}
		*/
			$this->load->view('templates/header', $data);
			$this->load->view('iuran_pokok', $data);
			$this->load->view('templates/footer');


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

	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url('login'));
	}

}

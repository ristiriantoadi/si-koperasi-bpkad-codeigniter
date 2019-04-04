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
	public function index()
	{
		$this->load->model('Model_anggota');
		$data = array(
			'halaman' => 'data_anggota_aktif',
			'anggota'=> $this->Model_anggota->get_data_anggota()
		);

		$this->load->view('templates/header', $data);
		$this->load->view('data_anggota', $data);
		$this->load->view('templates/footer');
	}

	public function nonaktif(){
		$this->load->model('Model_anggota');
		$data = array(
			'halaman' => 'data_anggota_non_aktif',
			'anggota'=> $this->Model_anggota->get_data_anggota_non_aktif()
		);
		$this->load->view('templates/header', $data);
		$this->load->view('data_anggota_non_aktif', $data);
		$this->load->view('templates/footer');
	}

	public function data($id_anggota)
	{
		$this->load->model('Model_anggota');
		$data = array(
			'halaman' => 'data_anggota_aktif',
			'anggota'=> $this->Model_anggota->get_data_anggota($id_anggota)
		);
		//$data['sisa_pembia']
		$data['total_iuran_wajib']=$this->Model_anggota->get_total_iuran_wajib($id_anggota);
		//$data['pembiayaan'] = $this->Model_anggota->
		//$data['sisa_pembiayaan']=$this->Model_anggota->get_sisa_pembiayaan($id_anggota);

		//$pembiayaan = $this->Model_anggota->get_sisa_pembiayaan($id_anggota);
		$pembiayaan  = $this->Model_anggota->get_pembiayaan($id_anggota);
		print_r($pembiayaan);
		//exit();
		if(!empty($pembiayaan)){
			//echo print_r($pembiayaan);
			//exit();
			$angsuran = $this->Model_anggota->get_total_angsuran_by_id_pembiayaan($pembiayaan['id_pembiayaan']);
			$data['sisa_pembiayaan'] = $pembiayaan['jumlah']-$angsuran;
			//echo $data['sisa_pembiayaan'];
			//exit();
			$data['total_angsuran'] = $angsuran;
			$data['pembiayaan'] = $this->Model_anggota->get_id_pembiayaan($id_anggota);
			
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

	public function data_bidang()
	{
		$this->load->model('Model_anggota');
		$data = array(
			'halaman' => 'data_bidang',
			'bidang'=> $this->Model_anggota->get_data_bidang()
		);
		$this->load->view('templates/header', $data);
		$this->load->view('edit_data_bidang', $data);
		$this->load->view('templates/footer');
	}



	public function data_angsuran($id_pembiayaan)
	{
		$this->load->model('Model_anggota');
		$data = array(
			'halaman' => 'data_angsuran',
			'angsuran'=> $this->Model_anggota->get_data_angsuran($id_pembiayaan)
		);
		//$data['sisa_pembia']
		//$data['total_angsuran']=$this->Model_anggota->get_total_angsuran($id_anggota);
		//$data['sisa_pembiayaan']=$this->Model_anggota->get_sisa_pembiayaan($id_anggota);
		//echo $data['sisa_pembiayaan'];
		//exit();
		$data['pembiayaan'] = $this->Model_anggota->get_jumlah_pembiayaan($id_pembiayaan);

		$this->load->view('templates/header', $data);
		$this->load->view('data_angsuran', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_anggota(){
		$this->load->model('Model_anggota');
		
		$data = array(
			'halaman' => 'tambah_anggota',
			'bidang'=> $this->Model_anggota->get_data_bidang()
		);

		$this->db->select('*');
		$this->db->from('anggota');
		//$this->db->where('iuran_wajib.id_anggota', $id_anggota);
		//$this->db->join('anggota', 'iuran_wajib.id_anggota = anggota.id_anggota');
		$this->db->limit(1);
		$this->db->order_by('id_anggota', 'DESC');
		$data['anggota'] = $this->db->get()->row_array();
		$data['anggota']['id_anggota'] += 1;
		
		$this->load->view('templates/header', $data);
		$this->load->view('tambah_anggota');
		$this->load->view('templates/footer');

	}

	public function edit_anggota($id_anggota){
		$this->load->model('Model_anggota');
		
		$data = array(
			'halaman' => 'data_anggota',
			'anggota'=> $this->Model_anggota->get_edit_anggota($id_anggota),
			'bidang' => $this->Model_anggota->get_data_bidang()
		);
		$this->load->view('templates/header', $data);
		$this->load->view('edit_anggota', $data);
		$this->load->view('templates/footer');
	}
	
	public function iuran_pokok($id_anggota=null){
		$this->load->model('Model_anggota');
		
		$data = array(
			'halaman' => 'iuran_pokok',
			'iuran_pokok' => $this->Model_anggota->get_data_iuran_pokok($id_anggota)
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

	
	public function iuran_wajib($id_anggota=null){
		$this->load->model('Model_anggota');
		
		$data = array(
			'halaman' => 'iuran_wajib',
			'iuran_wajib'=>$this->Model_anggota->get_iuran_wajib($id_anggota)
		);

		//print_r($data['iuran_wajib']);
		//exit();

		$this->load->view('templates/header', $data);
		$this->load->view('iuran_wajib', $data);
		$this->load->view('templates/footer');

	}

	public function ijarah($id_anggota=null){
		$this->load->model('Model_anggota');
		
		$data = array(
			'halaman' => 'ijarah',
			'ijarah'=>$this->Model_anggota->get_ijarah($id_anggota),
			'total_ijarah' =>$this->Model_anggota->get_total_ijarah($id_anggota)
		);

		//print_r($data['iuran_wajib']);
		//exit();

		$this->load->view('templates/header', $data);
		$this->load->view('data_ijarah', $data);
		$this->load->view('templates/footer');

	}
	
	public function pembiayaan($id_anggota=null){
		$this->load->model('Model_anggota');
		$data = array(
			'halaman' => 'pembiayaan',
			'pembiayaan'=>$this->Model_anggota->get_semua_pembiayaan_by_id_anggota($id_anggota)
		);

		//print_r($data['iuran_wajib']);
		//exit();

		$this->load->view('templates/header', $data);
		$this->load->view('data_pembiayaan', $data);
		$this->load->view('templates/footer');

	}
	


	public function tambah_iuran_wajib(){
		$data = array(
			'halaman' => 'tambah_iuran_wajib'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('tambah_iuran_wajib');
		$this->load->view('templates/footer');

	}

	public function tambah_pembiayaan(){
		$data = array(
			'halaman' => 'tambah_pembiayaan'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('tambah_pembiayaan', $data);
		$this->load->view('templates/footer');

	}
	public function tambah_angsuran(){
		$data = array(
			'halaman' => 'tambah_angsuran'
		);

		$this->load->view('templates/header', $data);
		$this->load->view('tambah_angsuran', $data);
		$this->load->view('templates/footer');

	}

}

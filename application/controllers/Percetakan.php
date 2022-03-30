<?php
require_once 'General_controller.php';

class Percetakan extends General_controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('percetakan_model');
		$this->load->model('album_model');
		$this->load->model('foto_model');
	}
	
	public function index(){
		$this->load_view('percetakan/daftar_paket', 'Beranda');
	}
	public function pesanan(){
		$this->load_view('percetakan/daftar_pesanan', 'Beranda');
	}
	public function tambah_paket_cetak(){
		$this->get_session();
		$this->load_view('percetakan/tambah_paket_cetak', 'Tambah Paket cetak');
	}
	public function insert_paket_cetak(){
		if(!$this->cek_peran_pengguna(2)){
			echo json_encode($this->fail_hak_akses());
			return;
		}
		
		$field_names = array('nama_paket_cetak', 'deskripsi_paket_cetak', 'ringkasan_paket_cetak', 'harga_dasar', 'harga_per_halaman');
		$fields = $this->get_fields($field_names);
		
		if(!$this->basic_field_validation($fields)) return;
			
		$result = $this->percetakan_model->insert_paket_cetak($fields);
		if($result){
			echo json_encode($this->ok('', base_url('percetakan')));
		}else{
			echo json_encode($this->fail('Unknown error'));
		}
	}
	
	public function fetch_paket_cetak(){
		$data = $this->percetakan_model->fetch_paket_cetak();
		
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('percetakan/entri_paket_cetak', $data['entries'][$i], TRUE);
		}
		
		$data['entries'] = $output;
		
		echo json_encode($data);
	}
	
	public function fetch_pesanan(){
		$data = $this->album_model->fetch_pesanan_percetakan();
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('percetakan/entri_pesanan', $data['entries'][$i], TRUE);
		}
		
		$data['entries'] = $output;
		
		echo json_encode($data);
		
	}
}
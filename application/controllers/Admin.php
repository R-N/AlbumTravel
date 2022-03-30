<?php
require_once 'General_controller.php';

class Admin extends General_controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('paket_travel_model');
		$this->load->model('album_model');
		$this->load->model('foto_model');
		$this->load->model('percetakan_model');
	}
	
	public function index(){
		redirect(base_url("admin/pesanan"));
	}
	
	public function pesanan($id_album=''){
		if($id_album==null || $id_album==''){
			$this->load_view("admin/daftar_pesanan", "Daftar Pesanan");
		}else{
			$album = $this->album_model->get_album_admin($id_album);
			$this->load_view("admin/daftar_pesanan_rinci", "Daftar Pesanan Album", $album);
		}
	}
	
	public function fetch_percetakan(){
		
		$data = $this->percetakan_model->fetch_percetakan();
		
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('dialogs/entri_percetakan', $data['entries'][$i], TRUE);
		}
		
		$data['raw_entries'] = $data['entries'];
		$data['entries'] = $output;
		
		echo json_encode($data);
	}
	public function fetch_pesanan_rinci(){
		$id_album = $this->input->post("id_album");
		$data = $this->album_model->fetch_pesanan_rinci($id_album);
		$data['raw_entries'] = $data['entries'];
		
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('admin/entri_pesanan_rinci', $data['entries'][$i], TRUE);
		}
		
		$data['entries'] = $output;
		
		echo json_encode($data);
	}
	public function fetch_paket_cetak(){
		$id_percetakan = $this->input->post("id_percetakan");
		$data = $this->percetakan_model->fetch_paket_cetak_public($id_percetakan);
		$data['raw_entries'] = $data['entries'];
		
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('dialogs/entri_paket_cetak', $data['entries'][$i], TRUE);
		}
		
		$data['entries'] = $output;
		
		echo json_encode($data);
	}
	public function fetch_pesanan(){
		
		$data = $this->album_model->fetch_pesanan_admin();
		$data['raw_entries'] = $data['entries'];
		
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('admin/entri_pesanan', $data['entries'][$i], TRUE);
		}
		
		$data['entries'] = $output;
		
		echo json_encode($data);
	}
	public function set_paket_cetak(){
		$id_album = $this->input->post("id_album");
		$id_paket_cetak = $this->input->post("id_paket_cetak");
		
		$ret = $this->album_model->set_paket_cetak($id_album, $id_paket_cetak);
		
		echo json_encode($ret);
	}
}
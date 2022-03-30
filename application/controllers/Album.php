<?php
require_once 'General_controller.php';

class Album extends General_controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('album_model');
		$this->load->model('foto_model');
	}
	
	public function index($id_album){
		$data = $this->album_model->get_album($id_album);
		$this->load_view('album/daftar_halaman', $data['judul_album'], $data);
		$this->load->view("dialogs/template_picker");
		$this->load->view("dialogs/preview_halaman");
	}
	
	function fetch_grup_template(){
		echo json_encode($this->album_model->fetch_grup_template());
	}
	
	function fetch_template(){
		$id_grup_template=$this->input->post('id_grup_template');
		echo json_encode($this->album_model->fetch_template_halaman($id_grup_template));
	}
	
	function fetch_template_saudara(){
		$id_template=$this->input->post('id_template');
		echo json_encode($this->album_model->fetch_template_halaman_saudara($id_template));
	}
	function get_id_grup_template(){
		$id_template=$this->input->post('id_template');
		echo json_encode($this->album_model->get_id_grup_template($id_template));
	}
	
	public function get_template_preview($id_template=null){
		$result = $this->album_model->get_template_halaman($id_template);
		$url = $result['url_template'] . '.png';
		
		$this->show_image('./' . $url);
	}
	
	function fetch_halaman(){
		$id_album=$this->input->post('id_album');
		$raw = $this->input->post('raw');
		$result = $this->album_model->fetch_halaman($id_album);
		
		
		if($raw != true){
			$output = array();
			$len = count($result['entries']);
			for($i = 0; $i < $len; ++$i){
				$result['entries'][$i]['nomor'] = $i+1;
				array_push($output, $this->load->view('album/entri_halaman', $result['entries'][$i], TRUE));
			}
			$result['entries'] = $output;
		}
		
		echo json_encode($result);
	}
	
	function edit_halaman($id_album, $nomor_halaman){
		$data = $this->album_model->get_halaman($id_album, $nomor_halaman);
		$data_foto_pool=array(
			'id_foto_pool'=>'foto_pool_album'
		);
		$data['data'] = array_merge(array(), $data);
		$data['data_foto_pool'] = $data_foto_pool;
		$this->load_view("album/edit_halaman", $data['text'], $data);
		$this->load->view("dialogs/template_picker");
	}
	
	function fetch_foto(){
		$id_album = $this->input->post('id_album');
		$result = $this->foto_model->fetch_foto_album($id_album);
		
		
		$output = array();
		$len = count($result['entries']);
		
		for($i = 0; $i < $len; ++$i){
			$result['entries'][$i]['nomor'] = $i+1;
			array_push($output, $this->load->view('album/entri_foto', $result['entries'][$i], TRUE));
		}
		$result['entries'] = $output;
		
		echo json_encode($result);
	}
	
	function set_foto_halaman(){
		$id_halaman = $this->input->post('id_halaman');
		$id_foto = $this->input->post('id_foto');
		$urutan_foto = $this->input->post('urutan_foto');
		
		$ret = $this->album_model->set_foto_halaman($id_halaman, $urutan_foto, $id_foto);
		echo json_encode($ret);
	}
	
	function fetch_foto_halaman(){
		$id_halaman = $this->input->post('id_halaman');
		$ret = $this->album_model->fetch_foto_halaman($id_halaman);
		echo json_encode($ret);
	}
	
	function set_template(){
		$id_halaman = $this->input->post('id_halaman');
		$id_template = $this->input->post('id_template');
		
		$ret = $this->album_model->set_template($id_halaman, $id_template);
		
		echo json_encode($ret);
	}
	
	function tambah_halaman(){
		$id_album = $this->input->post('id_album');
		$id_template = $this->input->post('id_template');
		$ret = $this->album_model->tambah_halaman($id_album, $id_template);
		
		echo json_encode($ret);
	}
	
	function preview_halaman($id_album='', $nomor_halaman=''){
		if($id_album=='') $id_album = $this->input->post('id_album');
		if($nomor_halaman=='') $nomor_halaman = $this->input->post('nomor_halaman');
		$data = $this->album_model->get_halaman($id_album, $nomor_halaman);
		$data['view'] = $this->load->view("album/preview_halaman", $data, TRUE);
		echo json_encode($data);
	}
	function full($id_album=''){
		if($id_album=='') $id_album = $this->input->post('id_album');
		$data = $this->album_model->get_halaman_full($id_album);
		$this->load->view("album/album_full", $data);
	}
}
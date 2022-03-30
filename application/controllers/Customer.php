<?php
require_once 'General_controller.php';

class Customer extends General_controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('paket_travel_model');
		$this->load->model('anggota_grup_model');
		$this->load->model('travel_model');
		$this->load->model('foto_model');
		$this->load->model('album_model');
	}
	
	public function index(){
		redirect(base_url('customer/paket'));
	}
	
	public function paket(){
		$this->load_view('customer/daftar_paket', 'Paket');
	}
	
	
	
	public function fetch_paket_travel(){
		$data = $this->paket_travel_model->fetch_paket_travel_customer();
		
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('customer/entri_paket_travel', $data['entries'][$i], TRUE);
		}
		
		$data['entries'] = $output;
		
		echo json_encode($data);
	}
	
	public function travel(){
		$this->load_view('customer/daftar_travel', 'Travel');
	}
	
	public function fetch_travel(){
		$page = $this->input->post('page');
		$search = $this->input->post('search');
		
		$data = $this->travel_model->fetch_travel();
		
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('customer/entri_travel', $data['entries'][$i], TRUE);
		}
		
		$data['entries'] = $output;
		
		echo json_encode($data);
	}
	public function detail_travel($id_travel){
		$this->load_view('customer/daftar_travel', 'Travel');
	
	}
	public function detail_paket($id_paket_travel){
		$data = $this->paket_travel_model->get_paket_customer($id_paket_travel);
		$this->load_view('customer/detail_paket', 'Travel', $data);
	}
	
	public function paket_travel_public($id_travel){
		
		$data = $this->travel_model->get_travel($id_travel);
		$this->load_view('customer/daftar_paket_public', 'Travel', $data);
	}
	
	public function fetch_paket_travel_public(){
		$id_travel = $this->input->post('id_travel');
		$data = $this->paket_travel_model->fetch_paket_travel_public($id_travel);
		
		$len = count($data['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$data['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('customer/entri_paket_travel_public', $data['entries'][$i], TRUE);
		}
		
		$data['entries'] = $output;
		
		echo json_encode($data);
	}
	
	public function join_grup(){
		$id_paket_travel = $this->input->post('id_paket_travel');
		$data = $this->anggota_grup_model->join_grup($id_paket_travel);
		
		echo json_encode($data);
	}
	public function fetch_album_anggota($id_paket_travel=null){
		if($id_paket_travel==null) $id_paket_travel = $this->input->post('id_paket_travel');
		if($id_paket_travel==null){
			echo json_encode($this->fail('invalid argument'));
			return;
		}
		
		$result = $this->album_model->fetch_album_anggota($id_paket_travel);
		$output = array();
		$len = count($result['entries']);
		
		for($i = 0; $i < $len; ++$i){
			$result['entries'][$i]['nomor'] = $i+1;
			array_push($output, $this->load->view('customer/entri_album_anggota', $result['entries'][$i], TRUE));
		}
		$result['entries'] = $output;
		
		echo json_encode($result);
	}
	
	public function tambah_album(){
		$id_paket_travel = $this->input->post('id_paket_travel');
		$judul_album = $this->input->post('judul_album');
		
		$ret = $this->anggota_grup_model->tambah_album_anggota($id_paket_travel, $judul_album);
		echo json_encode($ret);
	}
	
	public function upload_foto($id_paket_travel){
		//$id_paket_travel = $this->input->post('id_paket_travel');
		$id_anggota_grup = 0;
		$peran_pengguna = $this->get_peran_pengguna();
		$id_anggota_grup = $this->anggota_grup_model->get_id_anggota($id_paket_travel);
		
		$file_path0 = "assets/uploads/foto/". $id_paket_travel;
		$file_path = $file_path0 . "/" . $id_anggota_grup."/";
		
		if(!is_dir($file_path0)) mkdir($file_path0);
		if(!is_dir($file_path)) mkdir($file_path);
		
        $config['upload_path']="./" . $file_path;
		$file_name = $this->input->post('file_name');
		$splitted = explode('.', $file_name);
		$last = count($splitted)-1;
		$ext =  $splitted[$last];
		unset($splitted[$last]);
		$title = implode('.', $splitted);
		do{
			$config['file_name']=uniqid() . '.' . $ext;
			$full_file_name = $file_path . $config['file_name'];
		}while(file_exists($full_file_name));
        $config['allowed_types']='jpg|png';
		
         
        $this->load->library('upload',$config);
        if($this->upload->do_upload("foto")){
            $data = $this->upload->data();
			
            //Resize and Compress Image
			$this->foto_model->create_thumbnail($full_file_name);
 
            $image= $data['file_name']; 
			
			$result = array(
				'id_paket_travel' => $id_paket_travel,
				'url_foto' => $full_file_name,
				'judul_foto' => $title
			);
             
            
			
			$result['id_foto'] = $this->foto_model->insert_foto_anggota($result);
			
			
             $result['view'] = $this->load->view('gallery/photo-box', $result, TRUE);
			 
			unset($result['url_foto']);
			
			 echo json_encode($result);
        }else{
			echo json_encode($this->fail('Unknown failure'));
			return;
		}
	}
	public function admin_paket($id_paket_travel, $mode='foto'){
		
		$data_paket = $this->paket_travel_model->get_paket_lite($id_paket_travel);
		if($data_paket == null){
			show_404();
			return;
		}
		
		
		$data = array(
			'data_paket' => $data_paket,
			'mode' => $mode,
			'data_photo_crud' => array(
				'id_paket_travel' => $data_paket['id_paket_travel'],
				'id_photo_crud' => 'foto_paket_travel',
				'url_photo_crud' => base_url("customer/paket/" . $data_paket['id_paket_travel'] . "/foto/fetch"),
				'url_upload_foto' => base_url('customer/paket/'.$data_paket['id_paket_travel'].'/foto/upload')
			)
		);
		
		$this->load_view('customer/admin_paket', 'Admin Paket Travel', $data);
		$this->load->view('dialogs/image_preview');
		$this->load->view('dialogs/preview_album');
		$this->load->view('dialogs/input');
	}
	public function fetch_foto($id_paket_travel=null){
		$this->load->model('foto_model');
		if($id_paket_travel==null) $id_paket_travel = $this->input->post('id_paket_travel');
		if($id_paket_travel==null){
			echo json_encode($this->fail('invalid argument'));
			return;
		}
		
		$result = $this->foto_model->fetch_foto_anggota($id_paket_travel);
		
		$len = count($result);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$output[$i] = $this->load->view('gallery/photo-box', $result[$i], TRUE);
		}
		
		echo json_encode(array(
			'entries' => $output
		)); 
	}
	
	public function pesan_album(){
		$id_album = $this->input->post('id_album');
		$id_paket_travel = $this->input->post('id_paket_travel');
		$ret = $this->album_model->pesan_album($id_album, $id_paket_travel);
		echo json_encode($ret);
	}
	
	public function pesanan(){
		$this->load_view('customer/daftar_pesanan', 'Pesanan');
	}
	
	public function fetch_pesanan(){
		
		$result = $this->album_model->fetch_pesanan_customer();
		
		$len = count($result['entries']);
		
		$output = array();
		
		for($i = 0; $i < $len; ++$i){
			$result['entries'][$i]['nomor'] = $i+1;
			$output[$i] = $this->load->view('customer/entri_pesanan', $result['entries'][$i], TRUE);
		}
		
		$result['entries'] = $output;
		
		echo json_encode($result); 
	}
}

?>
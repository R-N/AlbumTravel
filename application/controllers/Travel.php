<?php
require_once 'General_controller.php';

class Travel extends General_controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('paket_travel_model');
        $this->load->model('album_model');
        $this->load->model('foto_model');
    }
    
    public function index(){
        session_write_close();
        $this->load_view('travel/daftar_paket', 'Beranda');
    }
    
    public function admin($id_paket_travel, $mode='foto'){
        session_write_close();
        
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
                'url_photo_crud' => base_url("travel/paket/" . $data_paket['id_paket_travel'] . "/foto/fetch"),
                'url_upload_foto' => base_url('travel/paket/'.$data_paket['id_paket_travel'].'/foto/upload')
            )
        );
        
        $this->load_view('travel/admin_paket', 'Admin Paket Travel', $data);
        $this->load->view('dialogs/image_preview');
        $this->load->view('dialogs/preview_album');
        $this->load->view('dialogs/input');
    }
    
    public function fetch_anggota_grup($id_paket_travel=null){
        session_write_close();
        if($id_paket_travel==null) $id_paket_travel = $this->input->post('id_paket_travel');
        if($id_paket_travel==null){
            echo json_encode($this->fail('invalid argument'));
            return;
        }
        
        $result = $this->paket_travel_model->fetch_anggota_grup($id_paket_travel);
        $output = array();
        $len = count($result['entries']);
        
        for($i = 0; $i < $len; ++$i){
            $result['entries'][$i]['nomor'] = $i+1;
            array_push($output, $this->load->view('travel/entri_anggota_grup', $result['entries'][$i], TRUE));
        }
        $result['entries'] = $output;
        
        echo json_encode($result);
    }
    public function upload_foto($id_paket_travel){
        //$id_paket_travel = $this->input->post('id_paket_travel');
        $id_anggota_grup = 0;
        $peran_pengguna = $this->get_peran_pengguna();
        session_write_close();
        if($peran_pengguna == 1) $id_anggota = $this->paket_travel_model->get_id_anggota_grup($id_paket_travel);
        
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
             
            
            
            $result['id_foto'] = $this->foto_model->insert_foto_grup($result);
            
            
             $result['view'] = $this->load->view('gallery/photo-box', $result, TRUE);
             
            unset($result['url_foto']);
            
             echo json_encode($result);
        }else{
            echo json_encode($this->fail('Unknown failure'));
            return;
        }
    }
    public function fetch_foto($id_paket_travel=null){
        session_write_close();
        $this->load->model('foto_model');
        if($id_paket_travel==null) $id_paket_travel = $this->input->post('id_paket_travel');
        if($id_paket_travel==null){
            echo json_encode($this->fail('invalid argument'));
            return;
        }
        
        $result = $this->foto_model->fetch_foto_grup($id_paket_travel);
        
        $len = count($result);
        
        $output = array();
        
        for($i = 0; $i < $len; ++$i){
            $output[$i] = $this->load->view('gallery/photo-box', $result[$i], TRUE);
        }
        
        echo json_encode(array(
            'entries' => $output
        )); 
    }
    
    public function anggota_grup($id_anggota_grup){
        $this->get_session();
        session_write_close();
        
        
        $data_paket = $this->paket_travel_model->get_anggota_grup($id_anggota_grup);
        if($data_paket == null){
            show_404();
            return;
        }
        
        
        
        $this->load_view('travel/anggota_grup', 'Anggota Grup', $data_paket);
    }
    
    public function terima_anggota_grup($id_anggota_grup){
        session_write_close();
        if($this->paket_travel_model->terima_anggota_grup($id_anggota_grup)){
            echo json_encode($this->ok());
        }else{
            echo json_encode($this->fail());
        }
    }
    
    public function hapus_anggota_grup($id_anggota_grup){
        session_write_close();
        if($this->paket_travel_model->hapus_anggota_grup($id_anggota_grup)){
            echo json_encode($this->ok());
        }else{
            echo json_encode($this->fail($this->db->error()));
        }
    }
    public function tambah_paket_travel(){
        $this->get_session();
        session_write_close();
        $this->load_view('travel/tambah_paket_travel', 'Tambah Paket Travel');
    }
    public function insert_paket_travel(){
        session_write_close();
        if(!$this->cek_peran_pengguna(2)){
            echo json_encode($this->fail_hak_akses());
            return;
        }
        
        $field_names = array('nama_paket_travel', 'tanggal_keberangkatan', 'lama_keberangkatan', 'deskripsi_paket_travel', 'ringkasan_paket_travel', 'harga_paket_travel');
        $fields = $this->get_fields($field_names);
        
        if(!$this->basic_field_validation($fields)) return;
            
        $result = $this->paket_travel_model->insert_paket_travel($fields);
        if($result){
            echo json_encode($this->ok('', base_url('travel')));
        }else{
            echo json_encode($this->fail('Unknown error'));
        }
    }
    
    public function fetch_paket_travel(){
        session_write_close();
        $data = $this->paket_travel_model->fetch_paket_travel();
        
        $len = count($data['entries']);
        
        $output = array();
        
        for($i = 0; $i < $len; ++$i){
            $data['entries'][$i]['nomor'] = $i+1;
            $output[$i] = $this->load->view('travel/entri_paket_travel', $data['entries'][$i], TRUE);
        }
        
        $data['entries'] = $output;
        
        echo json_encode($data);
    }
    
    public function fetch_album_grup($id_paket_travel=null){
        session_write_close();
        if($id_paket_travel==null) $id_paket_travel = $this->input->post('id_paket_travel');
        if($id_paket_travel==null){
            echo json_encode($this->fail('invalid argument'));
            return;
        }
        
        $result = $this->album_model->fetch_album_grup($id_paket_travel);
        $output = array();
        $len = count($result['entries']);
        
        for($i = 0; $i < $len; ++$i){
            $result['entries'][$i]['nomor'] = $i+1;
            array_push($output, $this->load->view('travel/entri_album_grup', $result['entries'][$i], TRUE));
        }
        $result['entries'] = $output;
        
        echo json_encode($result);
    }
    
    public function tambah_album(){
        session_write_close();
        $id_paket_travel = $this->input->post('id_paket_travel');
        $judul_album = $this->input->post('judul_album');
        
        $ret = $this->paket_travel_model->tambah_album_grup($id_paket_travel, $judul_album);
        echo json_encode($ret);
    }
}

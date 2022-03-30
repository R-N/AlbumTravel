<?php
require_once 'General_controller.php';

class Foto extends General_controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('foto_model');
	}
	public function show_foto($id_foto=null){
		$this->get_session();
		if($id_foto==null) $id_foto = $this->input->post('id_foto');
		if($id_foto==null){
			echo json_encode($this->fail('invalid argument'));
			return;
		}
		
		$url = $this->foto_model->get_url_foto($id_foto);
		
		if($url == null) return show_404();
		
		
		$this->show_image('./' . $url);
	}
	public function show_thumb($id_foto=null){
		$this->get_session();
		if($id_foto==null) $id_foto = $this->input->post('id_foto');
		if($id_foto==null){
			echo json_encode($this->fail('invalid argument'));
			return;
		}
		
		$url = $this->foto_model->get_url_foto($id_foto);
		
		
		if($url == null) return show_404();
		
		
		$splitted = explode('/',$url);
		$last = count($splitted)-1;
		$splitted2 = explode('.', $splitted[$last]);
		$last2 = count($splitted2)-2;
		$splitted2[$last2] = $splitted2[$last2] . '_thumb';
		$splitted[$last] = implode('.', $splitted2);
		
		$url = implode('/', $splitted);
		
		
		
		$this->show_image('./' . $url);
	}
}
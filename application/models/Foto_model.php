<?php
require_once 'General_model.php';

class Foto_model extends General_model {

	
	public function __construct()
	{
        	parent::__construct();
	}
	
	function fetch_foto_album($id_album, $limit=20, $offset=0, $search=null){
		$sql = "SELECT F.id_foto, F.url_foto, F.judul_foto, 1 AS jenis_foto FROM ALBUM_GRUP ABG, FOTO F, FOTO_GRUP FG, PAKET_TRAVEL PT, TRAVEL T WHERE F.id_foto=FG.id_foto AND ABG.id_album=? AND ABG.id_paket_travel=PT.id_paket_travel AND FG.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?";
		$sql2 = "SELECT F.id_foto, F.url_foto, F.judul_foto, 2 AS jenis_foto FROM ALBUM_ANGGOTA ABA, FOTO F, FOTO_ANGGOTA FA, ANGGOTA_GRUP AG, PAKET_TRAVEL PT, CUSTOMER C WHERE F.id_foto=FA.id_foto AND FA.id_anggota=AG.id_anggota_grup AND AG.id_anggota_grup=ABA.id_anggota AND ABA.id_album=? AND AG.id_customer=C.id_customer AND C.id_pengguna=?";
		$sql3 = "SELECT F.id_foto, F.url_foto, F.judul_foto, 1 AS jenis_foto FROM ALBUM_GRUP ABG, FOTO F, FOTO_GRUP FG, ANGGOTA_GRUP AG, CUSTOMER C WHERE F.id_foto=FG.id_foto AND ABG.id_album=? AND ABG.id_paket_travel=AG.id_paket_travel AND FG.id_paket_travel=AG.id_paket_travel AND AG.id_customer=C.id_customer AND C.id_pengguna=?";
		$sql4 = "SELECT F.id_foto, F.url_foto, F.judul_foto, 2 AS jenis_foto FROM ALBUM_ANGGOTA ABA, FOTO F, FOTO_GRUP FG, ANGGOTA_GRUP AG, PAKET_TRAVEL PT, CUSTOMER C WHERE F.id_foto=FG.id_foto AND FG.id_paket_travel=AG.id_paket_travel AND AG.id_anggota_grup=ABA.id_anggota AND ABA.id_album=? AND AG.id_customer=C.id_customer AND C.id_pengguna=?";
		
		
		$arg = array(
			$id_album,
			$this->get_id_pengguna()
		);
		if($search != null){
			$sql = $sql . " WHERE (id_foto=? OR judul_foto LIKE '%?%')";
			$sql2 = $sql2 . " WHERE (id_foto=? OR judul_foto LIKE '%?%')";
			$sql3 = $sql3 . " WHERE (id_foto=? OR judul_foto LIKE '%?%')";
			$sql4 = $sql4 . " WHERE (id_foto=? OR judul_foto LIKE '%?%')";
			array_push($arg, $search);
			array_push($arg, $search);
		}
		$sql5 = "SELECT DISTINCT * FROM (({$sql}) UNION ({$sql2}) UNION ({$sql3}) UNION ({$sql4})) ASD";
		
		$sql5 = $sql5 . " ORDER BY id_foto DESC";
		//$sql = $sql . " LIMIT " . $limit . " OFFSET " . $offset;
		
		$data = array_merge(array(), $arg);
		$data = array_merge($data, $arg);
		$data = array_merge($data, $arg);
		$data = array_merge($data, $arg);
		
		$query = $this->db->query($sql5, $data);
		return array(
			'result'=>'OK',
			'entries'=>$query->result_array()
		);
	}
	
	
	function fetch_foto_grup($id_paket_travel, $limit=20, $offset=0, $search=null){
		$sql = 'SELECT F.id_foto, F.url_foto, F.judul_foto FROM FOTO F, FOTO_GRUP FG, PAKET_TRAVEL PT, TRAVEL T WHERE F.id_foto=FG.id_foto AND FG.id_paket_travel=? AND FG.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?';
		
		$arg = array(
			$id_paket_travel,
			$this->get_id_pengguna()
		);
		if($search != null){
			$sql = $sql . " AND (F.id_foto=? OR F.judul_foto LIKE '%?%')";
			array_push($arg, $search);
		}
		
		$sql = $sql . " ORDER BY F.id_foto DESC";
		//$sql = $sql . " LIMIT " . $limit . " OFFSET " . $offset;
		
		
		$query = $this->db->query($sql, $arg);
		return $query->result_array();
	}
	
	function fetch_foto_anggota($id_paket_travel, $limit=20, $offset=0, $search=null){
		$sql = 'SELECT F.id_foto, F.url_foto, F.judul_foto FROM FOTO F, FOTO_GRUP FG, ANGGOTA_GRUP AG, CUSTOMER C WHERE F.id_foto=FG.id_foto AND FG.id_paket_travel=? AND FG.id_paket_travel=AG.id_paket_travel AND AG.id_customer=C.id_customer AND C.id_pengguna=?';
		$sql2 = 'SELECT F.id_foto, F.url_foto, F.judul_foto FROM FOTO F, FOTO_ANGGOTA FA, ANGGOTA_GRUP AG, CUSTOMER C WHERE F.id_foto=FA.id_foto AND FA.id_anggota=AG.id_anggota_grup AND AG.id_paket_travel=? AND AG.id_customer=C.id_customer AND C.id_pengguna=?';
		
		$arg = array(
			$id_paket_travel,
			$this->get_id_pengguna()
		);
		if($search != null){
			$sql = $sql . " AND (F.id_foto=? OR F.judul_foto LIKE '%?%')";
			array_push($arg, $search);
		}
		
		$sql3 = "SELECT * FROM (({$sql}) UNION ({$sql2})) ASD";
		
		$data = array_merge(array(), $arg);
		$data = array_merge($data, $arg);
		
		$sql3 = $sql3 . " ORDER BY id_foto DESC";
		//$sql = $sql . " LIMIT " . $limit . " OFFSET " . $offset;
		
		$query = $this->db->query($sql3, $data);
		return $query->result_array();
	}
	
	
	function get_url_foto_grup($id_foto){
		$sql = 'SELECT F.url_foto FROM FOTO F, FOTO_GRUP FG, PAKET_TRAVEL PT, TRAVEL T WHERE F.id_foto=? AND F.id_foto=FG.id_foto AND FG.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?';
		
		$query = $this->db->query($sql, array(
			$id_foto,
			$this->get_id_pengguna()
		));
		$row = $query->row();
		if($row==null) return null;
		return $row->url_foto;
	}
	
	function get_url_foto_anggota($id_foto){
		$sql = 'SELECT F.url_foto FROM FOTO F, FOTO_ANGGOTA FG, ANGGOTA_GRUP AG, CUSTOMER C WHERE F.id_foto=? AND F.id_foto=FG.id_foto AND FG.id_anggota=AG.id_anggota_grup AND AG.id_customer=C.id_customer AND C.id_pengguna=?';
		$sql2 = 'SELECT F.url_foto FROM FOTO F, FOTO_ANGGOTA FA, ANGGOTA_GRUP AG, CUSTOMER C WHERE F.id_foto=? AND F.id_foto=FA.id_foto AND FA.id_anggota=AG.id_anggota_grup AND AG.id_customer=C.id_customer AND C.id_pengguna=?';
		
		$arg = array(
			$id_foto,
			$this->get_id_pengguna()
		);
		
		$sql3 = "SELECT * FROM (({$sql}) UNION ({$sql2})) ASD";
		
		$data = array_merge(array(), $arg);
		$data = array_merge($data, $arg);
		
		$query = $this->db->query($sql3, $data);
		$row = $query->row();
		if($row==null) return null;
		return $row->url_foto;
	}
	
	public function get_url_foto($id_foto){
		$peran_pengguna = $this->get_peran_pengguna();
		$ret = null;
		if($peran_pengguna == 2 || ($peran_pengguna == 4 && $ret==null)) $ret= $this->get_url_foto_grup($id_foto);
		if($peran_pengguna == 1 || ($peran_pengguna == 4 && $ret==null)) $ret= $this->get_url_foto_anggota($id_foto);
		return $ret;
	}
	
	function insert_foto_anggota($data){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT AG.id_anggota_grup FROM ANGGOTA_GRUP AG, CUSTOMER C WHERE AG.id_paket_travel=? AND AG.id_customer=C.id_customer AND C.id_pengguna=?';
		$query = $this->db->query($sql, array(
			$data['id_paket_travel'],
			$id_pengguna
		));
		$result = $query->row();
		$id_anggota_grup = $result->id_anggota_grup;
		
		$this->db->trans_start();
		
		$this->db->insert('FOTO', array(
			'url_foto' => $data['url_foto'],
			'judul_foto' => $data['judul_foto'],
			'prioritas_foto' => 0
		));
		
		$id_foto = $this->db->insert_id();
		
		$this->db->insert('FOTO_ANGGOTA', array(
			'id_foto' => $id_foto,
			'id_anggota' => $id_anggota_grup
		));
		
		$this->db->trans_commit();
		
		return $id_foto;
	}
	
	function insert_foto_grup($data){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT PT.id_paket_travel FROM PAKET_TRAVEL PT, TRAVEL T WHERE PT.id_paket_travel=? AND PT.id_travel=T.id_travel AND T.id_pengguna=?';
		$query = $this->db->query($sql, array(
			$data['id_paket_travel'],
			$id_pengguna
		));
		$result = $query->row();
		$id_paket_travel = $result->id_paket_travel;
		
		$this->db->trans_start();
		
		$this->db->insert('FOTO', array(
			'url_foto' => $data['url_foto'],
			'judul_foto' => $data['judul_foto'],
			'prioritas_foto' => 0
		));
		
		$id_foto = $this->db->insert_id();
		
		$this->db->insert('FOTO_GRUP', array(
			'id_foto' => $id_foto,
			'id_paket_travel' => $id_paket_travel
		));
		
	
		$this->db->trans_commit();
		
		return $id_foto;
	}
	
	function delete_foto_anggota($id_foto){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT FA.id_foto FROM FOTO_ANGGOTA FA, ANGGOTA_GRUP AG, CUSTOMER C WHERE FA.id_foto=? AND FA.id_customer=C.id_customer AND C.id_pengguna=?';
		
		$query = $this->db->query($sql, array(
			$id_foto,
			$id_pengguna
		));
		
		$result = $query->row();
		$id_foto = $result->id_foto;
		
		$this->db->trans_start();
		
		$this->db->where('id_foto', $id_foto);
		$this->db->delete('FOTO');
		
		$this->db->trans_commit();
	}
	
	function delete_foto_grup($id_foto){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT FG.id_foto FROM FOTO_GRUP FG, PAKET_TRAVEL PT, TRAVEL T WHERE FG.id_foto=? AND FG.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?';
		
		$query = $this->db->query($sql, array(
			$id_foto,
			$id_pengguna
		));
		
		$result = $query->row();
		$id_foto = $result->id_foto;
		
		$this->db->trans_start();
		
		$this->db->where('id_foto', $id_foto);
		$this->db->delete('FOTO');
		
		$this->db->trans_commit();
	}
	
	public function create_thumbnail($full_file_name){
		
		$config['image_library']='gd2';
		$config['source_image']=$full_file_name;
		$config['create_thumb']= TRUE;
		$config['maintain_ratio']= TRUE;
		$config['quality']= '100%';
		$config['width']= 200;
		$config['height']= 200;
		$config['new_image']=$full_file_name;
		$this->load->library('image_lib', $config);
		if(!$this->image_lib->resize()){
			echo json_encode($this->fail("Thumbnail creation error : " . $this->image_lib->display_errors()));
			return;
		}
	}
}
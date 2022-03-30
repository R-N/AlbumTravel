<?php
require_once 'General_model.php';

class Paket_travel_model extends General_model {

	
	public function __construct()
	{
        	parent::__construct();
	}
	
	public function count_paket_travel_customer($search=null){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT count(*) AS count FROM TRAVEL T, PAKET_TRAVEL PT, ANGGOTA_GRUP AG, CUSTOMER C WHERE T.id_travel=PT.id_travel AND PT.id_paket_travel=AG.id_paket_travel AND AG.id_customer=C.id_customer AND C.id_pengguna=?';
		
		$arg = array(
			$id_pengguna
		);
		
		if($search != null && $search != ''){
			$sql = $sql . ' AND (PT.id_paket_travel=? OR PT.nama_paket_travel LIKE "%?%" OR DATE_FORMAT(PT.tanggal_keberangkatan, "%Y-%m-%d") LIKE "%?%" OR T.nama_travel LIKE "%?%")';
			array_push($arg, $search, $search, $search, $search);
		}
		
		$query = $this->db->query($sql, $arg);
		return $query->row()->count;
	}
	
	public function _fetch_paket_travel_customer($limit=10, $offset=0, $search=null){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT PT.id_travel, PT.id_paket_travel, T.nama_travel, PT.nama_paket_travel, PT.tanggal_keberangkatan, PT.ringkasan_paket_travel, lama_keberangkatan, harga_paket_travel, AG.status_anggota_grup FROM TRAVEL T, PAKET_TRAVEL PT, ANGGOTA_GRUP AG, CUSTOMER C WHERE T.id_travel=PT.id_travel AND PT.id_paket_travel=AG.id_paket_travel AND AG.id_customer=C.id_customer AND C.id_pengguna=?';
		
		$arg = array(
			$id_pengguna
		);
		
		if($search != null && $search != ''){
			$sql = $sql . ' AND (PT.id_paket_travel=? OR PT.nama_paket_travel LIKE "%?%" OR DATE_FORMAT(PT.tanggal_keberangkatan, "%Y-%m-%d") LIKE "%?%" OR T.nama_travel LIKE "%?%")';
			array_push($arg, $search, $search, $search, $search);
		}
		
		$sql = $sql . '  ORDER BY AG.status_anggota_grup ASC, PT.id_paket_travel DESC';// LIMIT ' . $limit . ' OFFSET ' . $offset;
		
		$query = $this->db->query($sql, $arg);
		
		$result = $query->result_array();
		
		return $result;
	}
	public function fetch_paket_travel_customer($page=1, $search=null){
		
		$limit=10;
		$offset = ($page-1) * $limit;
		
		$result = $this->_fetch_paket_travel_customer($limit, $offset, $search);
		
		$count = $this->count_paket_travel_customer();
		
		return array(
			'entries' => $result,
			'start'=>$offset+($count>0?1:0),
			'end'=>$offset+count($result),
			'count'=>$count
		);
	}
	
	
	public function count_paket_travel_public($id_travel, $search=null){
		$sql = 'SELECT count(*) AS count FROM TRAVEL T, PAKET_TRAVEL PT WHERE T.id_travel=? AND T.id_travel=PT.id_travel';
		
		$arg = array(
			$id_travel
		);
		
		if($search != null && $search != ''){
			$sql = $sql . ' AND (PT.id_paket_travel=? OR PT.nama_paket_travel LIKE "%?%" OR DATE_FORMAT(PT.tanggal_keberangkatan, "%Y-%m-%d") LIKE "%?%" OR T.nama_travel LIKE "%?%")';
			array_push($arg, $search, $search, $search, $search);
		}
		
		$query = $this->db->query($sql, $arg);
		return $query->row()->count;
	}
	
	public function _fetch_paket_travel_public($id_travel, $limit=10, $offset=0, $search=null){
		$sql = 'SELECT PT.id_travel, PT.id_paket_travel, T.nama_travel, PT.nama_paket_travel, PT.tanggal_keberangkatan, lama_keberangkatan, harga_paket_travel, PT.ringkasan_paket_travel, AG.status_anggota_grup FROM TRAVEL T, PAKET_TRAVEL PT LEFT JOIN (SELECT AG0.id_anggota_grup, AG0.status_anggota_grup, AG0.id_paket_travel FROM ANGGOTA_GRUP AG0, CUSTOMER C WHERE AG0.id_customer=C.id_customer AND C.id_pengguna=?) AG ON AG.id_paket_travel=PT.id_paket_travel WHERE T.id_travel=? AND T.id_travel=PT.id_travel';
		
		$arg = array(
			$this->get_id_pengguna(),
			$id_travel
		);
		
		if($search != null && $search != ''){
			$sql = $sql . ' AND (PT.id_paket_travel=? OR PT.nama_paket_travel LIKE "%?%" OR DATE_FORMAT(PT.tanggal_keberangkatan, "%Y-%m-%d") LIKE "%?%" OR T.nama_travel LIKE "%?%")';
			array_push($arg, $search, $search, $search, $search);
		}
		
		$sql = $sql . '  ORDER BY AG.status_anggota_grup ASC, PT.id_paket_travel DESC';// LIMIT ' . $limit . ' OFFSET ' . $offset;
		
		$query = $this->db->query($sql, $arg);
		
		$result = $query->result_array();
		
		return $result;
	}
	public function fetch_paket_travel_public($id_travel, $page=1, $search=null){
		
		$limit=10;
		$offset = ($page-1) * $limit;
		
		$result = $this->_fetch_paket_travel_public($id_travel, $limit, $offset, $search);
		
		$count = $this->count_paket_travel_public($id_travel, $search);
		
		return array(
			'entries' => $result,
			'start'=>$offset+($count>0?1:0),
			'end'=>$offset+count($result),
			'count'=>$count
		);
	}
	
	public function count_paket_travel($search=null){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT count(*) AS count FROM TRAVEL T, PAKET_TRAVEL PT WHERE T.id_pengguna=? AND T.id_travel=PT.id_travel';
		
		$arg = array(
			$id_pengguna
		);
		
		if($search != null && $search != ''){
			$sql = $sql . ' AND (PT.id_paket_travel=? OR PT.nama_paket_travel LIKE "%?%" OR DATE_FORMAT(PT.tanggal_keberangkatan, "%Y-%m-%d") LIKE "%?%")';
			array_push($arg, $search, $search, $search);
		}
		
		$query = $this->db->query($sql, $arg);
		return $query->row()->count;
	}
	
	public function _fetch_paket_travel($limit=10, $offset=0, $search=null){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT PT.id_travel, PT.id_paket_travel, nama_paket_travel, tanggal_keberangkatan, lama_keberangkatan, harga_paket_travel FROM TRAVEL T, PAKET_TRAVEL PT WHERE T.id_pengguna=? AND T.id_travel=PT.id_travel';
		
		$arg = array(
			$id_pengguna
		);
		
		if($search != null && $search != ''){
			$sql = $sql . ' AND (PT.id_paket_travel=? OR PT.nama_paket_travel LIKE "%?%" OR DATE_FORMAT(PT.tanggal_keberangkatan, "%Y-%m-%d") LIKE "%?%")';
			array_push($arg, $search, $search, $search);
		}
		
		$sql = $sql . '  ORDER BY PT.id_paket_travel DESC';// LIMIT ' . $limit . ' OFFSET ' . $offset;
		
		$query = $this->db->query($sql, $arg);
		
		$result = $query->result_array();
		
		return $result;
	}
	public function fetch_paket_travel($page=1, $search=null){
		
		$limit=10;
		$offset = ($page-1) * $limit;
		
		$result = $this->_fetch_paket_travel($limit, $offset, $search);
		
		$count = $this->count_paket_travel();
		
		return array(
			'entries' => $result,
			'start'=>$offset+($count>0?1:0),
			'end'=>$offset+count($result),
			'count'=>$count
		);
	}
	
	public function get_paket_lite($id_paket_travel){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT PT.id_paket_travel, nama_paket_travel, tanggal_keberangkatan, lama_keberangkatan, harga_paket_travel, ringkasan_paket_travel FROM TRAVEL T, PAKET_TRAVEL PT WHERE T.id_travel=PT.id_travel AND T.id_pengguna=? AND PT.id_paket_travel=?';
		
		$query = $this->db->query($sql,array(
			$id_pengguna,
			$id_paket_travel
		));
		
		if($query->num_rows() <= 0){
			return null;
		}else{
			$result = $query->row_array();
			return $result;
		}
	}
	
	public function get_paket_customer($id_paket_travel){
		$id_paket_travel = $this->verify_id_paket_travel_customer($id_paket_travel);
		
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT PT.id_paket_travel, nama_paket_travel, tanggal_keberangkatan, lama_keberangkatan, harga_paket_travel, ringkasan_paket_travel, deskripsi_paket_travel, T.nama_travel, T.id_travel FROM TRAVEL T, PAKET_TRAVEL PT WHERE T.id_travel=PT.id_travel AND PT.id_paket_travel=?';
		
		$query = $this->db->query($sql,array(
			$id_paket_travel
		));
		
		if($query->num_rows() <= 0){
			return null;
		}else{
			$result = $query->row_array();
			return $result;
		}
	}
	public function _fetch_anggota_grup($id_paket_travel, $limit=10, $offset=0, $search=null){
		$id_pengguna = $this->get_id_pengguna();
		
		$sql = 'SELECT AG.id_anggota_grup, C.id_customer, C.nama_customer, C.telepon_customer, AG.rating_paket_travel, AG.status_anggota_grup FROM ANGGOTA_GRUP AG, CUSTOMER C WHERE AG.id_paket_travel=? AND C.id_customer=AG.id_customer';

		if($this->cek_peran_pengguna(2)){
			$sql = $sql . ' AND AG.id_paket_travel IN (SELECT AG2.id_paket_travel FROM ANGGOTA_GRUP AG2, PAKET_TRAVEL PT, TRAVEL T WHERE AG2.id_paket_travel=? AND AG2.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?)';
		}else if ($this->cek_peran_pengguna(1)){
			$sql = $sql . ' AND AG.id_customer IN (SELECT AG2.id_paket_travel FROM ANGGOTA_GRUP AG2, CUSTOMER C2 WHERE AG2.id_paket_travel=? AND AG2.id_customer=C.id_customer AND C.id_pengguna=?)';
		}
		
		$sql = $sql . ' ORDER BY C.nama_customer ASC ';
		//$sql = $sql . ' LIMIT ' . $limit . ' OFFSET ' . $offset;
		
		$query = $this->db->query($sql,array(
			$id_paket_travel,
			$id_paket_travel,
			$id_pengguna
		));
		
		if($query->num_rows() <= 0){
			return null;
		}else{
			$result = $query->result_array();
			return $result;
		}
	}
	
	public function count_anggota_grup($id_paket_travel, $search=null){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT COUNT(*) AS count FROM ANGGOTA_GRUP AG2, PAKET_TRAVEL PT, TRAVEL T WHERE AG2.id_anggota_grup=? AND AG2.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?';
		
		$query = $this->db->query($sql,array(
			$id_paket_travel,
			$id_pengguna
		));
		
		return $query->row()->count;
	}
	public function fetch_anggota_grup($id_paket_travel, $page=1, $search=null){
		$id_pengguna = $this->get_id_pengguna();
		
		$limit=10;
		$offset = ($page-1) * $limit;
		
		$result = $this->_fetch_anggota_grup($id_paket_travel, $limit, $offset, $search);
		
		$count = $this->count_anggota_grup($id_paket_travel);
		
		return array(
			'entries' => $result,
			'start'=>$offset+($count>0?1:0),
			'end'=>$offset+count($result),
			'count'=>$count
		);
	}
	
	public function get_anggota_grup($id_anggota_grup){
		$id_pengguna = $this->get_id_pengguna();
		
		$sql = 'SELECT AG.id_anggota_grup, C.id_customer, C.nama_customer, C.telepon_customer, C.alamat_customer, AG.status_anggota_grup, PT.nama_paket_travel, PT.tanggal_keberangkatan, PT.lama_keberangkatan FROM ANGGOTA_GRUP AG, CUSTOMER C, PAKET_TRAVEL PT, TRAVEL T WHERE AG.id_anggota_grup=? AND C.id_customer=AG.id_customer AND AG.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?';
		
		//$sql = $sql . ' ASC LIMIT ' . $limit . ' OFFSET ' . $offset;
		
		$query = $this->db->query($sql,array(
			$id_anggota_grup,
			$id_pengguna
		));
		
		if($query->num_rows() <= 0){
			return null;
		}else{
			$result = $query->row_array();
			
			$riwayat = $this->get_riwayat_grup_customer($id_anggota_grup);
			
			$result['riwayat'] = $riwayat;
			
			return $result;
		}
		
	}
	public function get_riwayat_grup_customer($id_anggota_grup){
		$id_pengguna = $this->get_id_pengguna();
		
		$sql = 'SELECT AG.id_anggota_grup, AG.status_anggota_grup, PT.id_travel, T.nama_travel, PT.id_paket_travel, PT.nama_paket_travel, PT.tanggal_keberangkatan, AG.rating_paket_travel FROM ANGGOTA_GRUP AG, PAKET_TRAVEL PT, TRAVEL T WHERE AG.id_anggota_grup=? AND AG.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND AG.id_customer IN (SELECT AG2.id_customer FROM ANGGOTA_GRUP AG2, PAKET_TRAVEL PT2, TRAVEL T2 WHERE AG2.id_anggota_grup=? AND AG2.id_paket_travel=PT2.id_paket_travel AND PT2.id_travel=T2.id_travel AND T2.id_pengguna=?)';
		
		$sql = $sql . ' ORDER BY PT.id_travel ASC ';
		//$sql = $sql . ' ASC LIMIT ' . $limit . ' OFFSET ' . $offset; 
		
		$query = $this->db->query($sql,array(
			$id_anggota_grup,
			$id_anggota_grup,
			$id_pengguna
		));
		
		if($query->num_rows() <= 0){
			return null;
		}else{
			$result = $query->result_array();
			return $result;
		}
		
	}
	
	
	public function get_id_anggota_grup($id_paket_travel){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'SELECT AG.id_anggota_grup FROM ANGGOTA_GRUP AG, CUSTOMER C WHERE AG.id_paket_travel=? AND AG.id_customer=C.id_customer AND C.id_pengguna=?';
		$query = $this->db->query($sql, array(
			$id_paket_travel,
			$id_pengguna
		));
		$result = $query->row();
		return $result->id_anggota_grup;
	}
	
	
	public function terima_anggota_grup($id_anggota_grup){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'UPDATE ANGGOTA_GRUP AG SET AG.status_anggota_grup=1 WHERE AG.id_anggota_grup=? AND AG.status_anggota_grup=0 AND AG.id_anggota_grup IN (SELECT AG2.id_anggota_grup FROM (SELECT * FROM ANGGOTA_GRUP) AG2, PAKET_TRAVEL PT, TRAVEL T WHERE AG2.id_anggota_grup=? AND AG2.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?)';
		$query = $this->db->query($sql, array(
			$id_anggota_grup,
			$id_anggota_grup,
			$id_pengguna
		));
		return $query && $this->db->affected_rows();
	}
	public function hapus_anggota_grup($id_anggota_grup){
		$id_pengguna = $this->get_id_pengguna();
		$sql = 'DELETE FROM ANGGOTA_GRUP WHERE id_anggota_grup=? AND id_anggota_grup IN (SELECT AG2.id_anggota_grup FROM (SELECT AG3.id_anggota_grup, AG3.id_paket_travel FROM ANGGOTA_GRUP AG3 WHERE AG3.id_anggota_grup=?) AG2, PAKET_TRAVEL PT, TRAVEL T WHERE AG2.id_paket_travel=PT.id_paket_travel AND PT.id_travel=T.id_travel AND T.id_pengguna=?)';
		$query = $this->db->query($sql, array(
			$id_anggota_grup,
			$id_anggota_grup,
			$id_pengguna
		));
		return $query && $this->db->affected_rows();
	}
	
	public function insert_paket_travel($data){
		$id_pengguna = $this->get_id_pengguna();
		$sql1 = 'SELECT T.id_travel FROM TRAVEL T WHERE T.id_pengguna=?';
		$query = $this->db->query($sql1, array($id_pengguna));
		$data['id_travel'] = $query->row()->id_travel;
		
		
		$query = $this->db->insert("PAKET_TRAVEL", $data);
		
		return $query && $this->db->affected_rows();
	}
	function verify_id_paket_travel($id_paket_travel){
		$sql = "SELECT PT.id_paket_travel FROM PAKET_TRAVEL PT, TRAVEL T WHERE PT.id_paket_travel=? AND PT.id_travel=T.id_travel AND T.id_pengguna=?";
		
		$query = $this->db->query($sql, array(
			$id_paket_travel,
			$this->get_id_pengguna()
		));
		
		return $query->row()->id_paket_travel;
	}
	function verify_id_paket_travel_customer($id_paket_travel){
		$sql = "SELECT PT.id_paket_travel FROM PAKET_TRAVEL PT, ANGGOTA_GRUP AG, CUSTOMER C WHERE PT.id_paket_travel=? AND PT.id_paket_travel=AG.id_paket_travel AND AG.id_customer=C.id_customer AND C.id_pengguna=?";
		
		$query = $this->db->query($sql, array(
			$id_paket_travel,
			$this->get_id_pengguna()
		));
		
		return $query->row()->id_paket_travel;
	}
	function tambah_album_grup($id_paket_travel, $judul_album){
		$id_paket_travel = $this->verify_id_paket_travel($id_paket_travel);
		
		$this->db->trans_start();
		
		$sql = "INSERT INTO ALBUM(judul_album) VALUES(?)";
		$query = $this->db->query($sql, array($judul_album));
		if(!$query){
			$this->trans_rollback();
			return $this->fail("Gagal insert album");
		}
		$id_album = $this->db->insert_id();
		$sql = "INSERT INTO ALBUM_GRUP(id_album, id_paket_travel) VALUES(?,?)";
		$query = $this->db->query($sql, array(
			$id_album,
			$id_paket_travel
		));
		
		if(!$query){
			$this->trans_rollback();
			return $this->fail("Gagal insert album_grup");
		}
		
		$this->db->trans_commit();
		
		return $this->ok();
	}
	
}
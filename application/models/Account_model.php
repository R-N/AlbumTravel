<?php
require_once 'General_model.php';

class Account_model extends General_model {

	public static $tabel_per_peran = array(
		1 => 'customer',
		2 => 'travel',
		3 => 'percetakan'
	);
	
	public static $teks_peran = array(
		1 => 'Customer',
		2 => 'Agen Travel',
		3 => 'Percetakan'
	);
	
	public static $salt = 'albumbum';
	
	public function __construct()
	{
        	parent::__construct();
	}

	function hash_password($password){
		return MD5($password . Account_model::$salt);
	}
	
	public function login($data) {
		$sql = 'SELECT id_pengguna, peran_pengguna, username, status_akun FROM AKUN WHERE username=? AND password=?';
		$query = $this->db->query($sql, array(
			$data['username'],
			 $this->hash_password($data['password'])
		));

		if ($query->num_rows() > 0) {
			$row = $query->row();
			$ret = array(
				'id_pengguna' => $row->id_pengguna, 
				'peran_pengguna' => $row->peran_pengguna,
				'nama_pengguna' => $row->username,
				'status_akun' => $row->status_akun
			);
			$peran = $ret['peran_pengguna'];
			if(array_key_exists($peran, Account_model::$tabel_per_peran)){
				$tabel = Account_model::$tabel_per_peran[$peran];
				
				$sql = 'SELECT nama_'.$tabel.' FROM '.strtoupper($tabel).' WHERE id_pengguna=?';
				$query = $this->db->query($sql, array($ret['id_pengguna']));
				if($query->num_rows() == 1){
					$nama_col = 'nama_' . $tabel;
					$ret['nama_pengguna'] = $query->row_array()[$nama_col];
				}
			}
			
			return $ret;
		} else {
			return NULL;
		}
	}
	public function register_customer($data){
		$customer = array(
			'nama_customer' => $data['nama'],
			'alamat_customer' => $data['alamat'],
			'telepon_customer' => $data['telepon']
		);
		
		$this->db->trans_start();
		
		$ret = $this->insert_akun($data, 1);
		if($ret != NULL) return $ret;
		
		$id = $this->db->insert_id();
		
		$customer['id_pengguna'] = $id;
		$this->db->insert('CUSTOMER', $customer);
		
		$kode = $this->insert_konfirmasi_akun($id);
		
		$this->db->trans_complete();
		
		return array(
			'result' => 'OK',
			'kode_konfirmasi' => $kode
		);
	}
	
	
	public function register_travel($data){
		$travel = array(
			'nama_travel' => $data['nama'],
			'alamat_travel' => $data['alamat'],
			'telepon_travel' => $data['telepon'],
			'email_travel' => $data['contact_email'],
			'deskripsi_travel' => $data['deskripsi'],
			'ringkasan_travel' => $data['ringkasan']
		);
		
		$this->db->trans_start();
		
		$ret = $this->insert_akun($data, 2);
		if($ret != NULL) return $ret;
		
		$id = $this->db->insert_id();
		
		$travel['id_pengguna'] = $id;
		$this->db->insert('TRAVEL', $travel);
		
		$kode = $this->insert_konfirmasi_akun($id);
		
		$this->db->trans_complete();
		
		return array(
			'result' => 'OK',
			'kode_konfirmasi' => $kode
		);
	}
	
	
	public function register_percetakan($data){
		$percetakan = array(
			'nama_percetakan' => $data['nama'],
			'alamat_percetakan' => $data['alamat'],
			'telepon_percetakan' => $data['telepon'],
			'email_percetakan' => $data['contact_email'],
			'deskripsi_percetakan' => $data['deskripsi'],
			'ringkasan_percetakan' => $data['ringkasan']
		);
		
		$this->db->trans_start();
		
		$ret = $this->insert_akun($data, 3);
		if($ret != NULL) return $ret;
		
		$id = $this->db->insert_id();
		
		$percetakan['id_pengguna'] = $id;
		$this->db->insert('PERCETAKAN', $percetakan);
		
		$kode = $this->insert_konfirmasi_akun($id);
		
		$this->db->trans_complete();
		
		return array(
			'result' => 'OK',
			'kode_konfirmasi' => $kode
		);
	}
	
	function insert_akun($data, $peran){
		$akun = array(
			'username' => $data['username'],
			'password' => $this->hash_password($data['password']),
			'peran_pengguna' => $peran,
			'email_pengguna' => $data['email'],
			'status_akun' => 0
		);
		if(!$this->db->insert('AKUN', $akun)){
			return array(
				'result' => 'FAIL',
				'error' => $this->db->error()
			);
		}
		return null;
	}
	
	function insert_konfirmasi_akun($id){
		$rand_result = FALSE;
		$kode = '';
		
		$sql = "INSERT INTO KONFIRMASI_AKUN(id_pengguna, kode_konfirmasi, tanggal_kadaluarsa) VALUES(?, ?, CURDATE() + 3) ON DUPLICATE KEY UPDATE id_pengguna=VALUES(id_pengguna), kode_konfirmasi=VALUES(kode_konfirmasi), tanggal_kadaluarsa=VALUES(tanggal_kadaluarsa)";
		do{
			$kode = strval(MD5($id . microtime() . Account_model::$salt));
			
			
			
			$rand_result = $this->db->query($sql, array(
				$id,
				$kode
			));
		}while(!$rand_result);
		return $kode;
	}
	
	public function konfirmasi_akun($kode){
		$sql = 'SELECT id_pengguna, peran_pengguna FROM AKUN WHERE status_akun=0 AND id_pengguna=(SELECT k.id_pengguna FROM KONFIRMASI_AKUN k WHERE k.kode_konfirmasi=? AND k.tanggal_kadaluarsa > CURDATE())';
		$query = $this->db->query($sql, array($kode));
		
		if($query->num_rows() > 0){
			$row = $query->row_array();
			$id = $row['id_pengguna'];
			$peran = $row['peran_pengguna'];
			$stat = 1;
			if($peran == 1) $stat = 2;
			

			
			$this->db->trans_start();
			$sql = 'UPDATE AKUN SET status_akun=? WHERE id_pengguna=?';
			if(!$this->db->query($sql, array(
				$stat,
				$id
			))){
				return array(
					'result'=>'FAIL',
					'error'=>'akun tidak ditemukan'
				);
			}
			
			$sql = 'DELETE FROM KONFIRMASI_AKUN WHERE id_pengguna=?';
			if(!$this->db->query($sql, array($id))){
				return array(
					'result' => 'FAIL',
					'error'=>'gagal menghapus konfirmasi'
				);
			}
			$this->db->trans_complete();
			return array(
				'result' => 'OK',
				'peran' => Account_model::$teks_peran[$peran]
			);
		}else{
			return array(
				'result' => 'FAIL',
				'error' => 'Kode tidak ditemukan, sudah terpakai, atau sudah hangus'
			);
		}
	}
}
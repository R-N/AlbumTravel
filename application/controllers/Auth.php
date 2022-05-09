<?php
require_once 'General_controller.php';

class Auth extends General_controller{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('account_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('email');
		$this->email->set_newline("\r\n");
	}
	
	
	public function login(){
		if($this->util->isUserLoggedIn($this->session)){
			redirect(base_url('home'));
			return;
		}

		$data = array(
			'message' => $this->session->flashdata('message')
		);
		$this->load_view('auth/login', 'Login', $data);

	}

	public function login_process(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if($username == NULL || !(trim($username))){
			$fail = $this->fail('Username tidak boleh kosong');
			$fail['field'] = 'username';
			echo json_encode($fail);
			return;
		}
		if($password == NULL || !(trim($password))){
			echo json_encode(array(
				'result' => 'FAIL',
				'field' => 'password',
				'error' => 'Password tidak boleh kosong'
			));
			return;
		}

		$login = array(
			'username' => $username,
			'password' => $this->input->post('password')
		);
			
		$result = $this->account_model->login($login);
		if($result != NULL){
			if($result['status_akun'] == 0){
				echo json_encode($this->fail('Anda belum mengkonfirmasi email akun Anda.'));
				return;
			}
			if($result['status_akun'] == 1){
				echo json_encode($this->fail('Akun Anda masih belum disetujui oleh admin kami.'));
				return;
			}
			if($result['status_akun'] == 2){
				$this->session->set_userdata('session', $result);
				echo json_encode($this->ok('', base_url('home')));
				return;
			}
		}
		echo json_encode($this->fail('Username atau password salah'));
	}
	
	
	public function logout() {
		if($this->is_user_logged_in()){
			$this->session->unset_userdata('session');
			$this->session->set_flashdata('message', 'Anda telah terlogout');
		}
		echo json_encode(array(
			'result'=>'OK',
			'redirect'=> base_url('login')
		));
	}

	public function register($peran=''){
		if($this->is_user_logged_in()){
			redirect(base_url('home'));
			return;
		}
		if($peran=='') redirect(base_url('register/customer'));
		$page = 'auth/register/'.$peran;
        if (!$this->view_exists($page))
        {
                // Whoops, we don't have a page for that!
                show_404();
				return;
        }
		
		$this->load_view($page, 'Daftar sebagai ' . $peran);
	}
	

	public function email_confirmation(){
		$peran = $this->input->post('peran');
		$email = $this->input->post('email');
		$nama = $this->input->post('nama');
		
		$title = "Hampir selesai";
		$text = "Anda hampir selesai mendaftar sebagai {$peran}. Anda perlu membuka link konfirmasi yang telah kami kirim melalui email kepada Anda ({$email})";
		$this->load_notice('Konfirmasi Email', $title, $text);
	}
	public function confirm_email($key){
		$data = array(
			'nama' => $this->input->post('nama'),
			'peran' => $this->input->post('peran')
		);
		$result = $this->account_model->konfirmasi_akun($key);
		if($result['result'] == 'OK'){
			$this->load_view('auth/email_confirmed', 'Pendaftaran selesai', $data);
		}else{
			$this->load_notice('Error', 'Konfirmasi email gagal', $result['error']);
		}
	}
	public function register_process($peran){
		if($peran=='customer'){
			return $this->register_customer_process();
		}
		if($peran=='travel'){
			return $this->register_travel_process();
		}
		if($peran=='percetakan'){
			return $this->register_percetakan_process();
		}
		show_404();
	}
	
	public function register_customer_process(){
		$peran = 'customer';
		$field_names = array('username', 'password', 'password_confirm', 'email', 'nama', 'alamat', 'telepon');
		$fields = $this->get_fields($field_names);
		
		if(!$this->basic_field_validation($fields)) return;
			
		$result = $this->account_model->register_customer($fields);
		if($result['result'] == 'OK'){
			$data = array(
				'nama' => $fields['nama'],
				'email' => $fields['email'],
				'peran' => $peran
			);
			$this->send_confirmation($data, $result['kode_konfirmasi']);
			unset($result['kode_konfirmasi']);
			$result['redirect'] = base_url('email/confirm');
			$result['data'] = $data;
		}
		echo json_encode($result);
	}
	
	
	public function register_travel_process(){
		$peran = 'travel';
		$field_names = array('username', 'password', 'password_confirm', 'email', 'contact_email', 'nama', 'alamat', 'telepon', 'deskripsi', 'ringkasan');
		$fields = $this->get_fields($field_names);
		
		if(!$this->basic_field_validation($fields)) return;
			
		$result = $this->account_model->register_travel($fields);
		if($result['result'] == 'OK'){
			$data = array(
				'nama' => $fields['nama'],
				'email' => $fields['email'],
				'peran' => $peran
			);
			$this->send_confirmation($data, $result['kode_konfirmasi']);
			unset($result['kode_konfirmasi']);
			$result['redirect'] = base_url('email/confirm');
			$result['data'] = $data;
		}
		echo json_encode($result);
	}
	
	
	public function register_percetakan_process(){
		$peran = 'percetakan';
		$field_names = array('username', 'password', 'password_confirm', 'email', 'contact_email', 'nama', 'alamat', 'telepon', 'deskripsi', 'ringkasan');
		
		$fields = $this->get_fields($field_names);
		
		if(!$this->basic_field_validation($fields)) return;
			
		$result = $this->account_model->register_percetakan($fields);
		if($result['result'] == 'OK'){
			$data = array(
				'nama' => $fields['nama'],
				'email' => $fields['email'],
				'peran' => $peran
			);
			$this->send_confirmation($data, $result['kode_konfirmasi']);
			unset($result['kode_konfirmasi']);
			$result['redirect'] = base_url('email/confirm');
			$result['data'] = $data;
		}
		echo json_encode($result);
	}
	
	protected function send_confirmation($data, $kode){
		$this->email->from('admin_uas4b@uas4b.sekolahq.id');
		$this->email->to($data['email']);
		$this->email->subject('Konfirmasi pembuatan akun customer Album UAS4B');
		$this->email->message(base_url('email/confirm/' . $kode));
		$this->email->send();
	}
}

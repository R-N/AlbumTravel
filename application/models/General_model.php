<?php

class General_model extends CI_Model {

    
    public function __construct()
    {
            parent::__construct();
    }
    
    protected function is_user_logged_in(){
        return isset($this->session->userdata['session']) && $this->session->userdata['session'] !== NULL && $this->session->userdata['session']['id_pengguna'] !== NULL;
    }
    protected function get_session(){
        if(isset($this->session->userdata['session'])){
            return $this->session->userdata['session'];
        }else{
            session_write_close();
            redirect(base_url('login'));
        }
    }
    
    protected function get_nama_pengguna(){
        return $this->get_session()['nama_pengguna'];
    }
    
    protected function get_id_pengguna(){
        return $this->get_session()['id_pengguna'];
    }
    
    protected function get_peran_pengguna(){
        return $this->get_session()['peran_pengguna'];
    }
    
    protected function get_status_akun(){
        return $this->get_session()['status_akun'];
    }

    protected function cek_peran_pengguna($peran){
        $peranq = $this->get_peran_pengguna();
        return $peranq == $peran || $peranq==4;
    }
    
    protected function get_fields($field_names){
        $fields = array();
        foreach($field_names as $field_name){
            $field = $this->input->post($field_name);
            if($field == NULL || !(trim($field))){
                echo json_encode(array(
                    'result' => 'FAIL',
                    'field' => $field_name,
                    'error' => ucfirst($field_name) . ' tidak boleh kosong'
                ));
                return false;
            }
            $fields[$field_name] = $field;
        }
        return $fields;
    }
    protected function basic_field_validation($fields){
        if(!$fields) return false;
        
        if(array_key_exists('email', $fields) && !filter_var($fields['email'], FILTER_VALIDATE_EMAIL)){
            echo json_encode(array(
                'result' => 'FAIL',
                'field' => 'email',
                'error' => 'Email tidak valid'
            ));
            return false;
        }
        if(array_key_exists('contact_email', $fields) && !filter_var($fields['contact_email'], FILTER_VALIDATE_EMAIL)){
            echo json_encode(array(
                'result' => 'FAIL',
                'field' => 'contact_email',
                'error' => 'Contact email tidak valid'
            ));
            return false;
        }
        if(array_key_exists('password_confirm', $fields) && $fields['password'] != $fields['password_confirm']){
            echo json_encode(array(
                'result' => 'FAIL',
                'field' => 'password_confirm',
                'error' => 'Konfirmasi password tidak sama'
            ));
            return false;
        }
        return true;
    }
    
    protected function fail($err='', $redirect=null){
        $ret = array('result'=>'FAIL');
        $ret['error'] = $err;
        $ret['redirect'] = $redirect;
        return $ret;
    }
    
    protected function ok($message='', $redirect=null){
        $ret = array('result'=>'OK');
        $ret['message'] = $message;
        $ret['redirect'] = $redirect;
        return $ret;
    }
}

?>
<?php

#[\AllowDynamicProperties]
class General_controller extends HungNG_CI_Base_Controllers {
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function is_user_logged_in(){
        return isset($this->session->userdata['session']) && $this->session->userdata['session'] !== NULL && $this->session->userdata['session']['id_pengguna'] !== NULL;
    }
    
    protected function show_image($file_path)
    {
        $this->load->helper('file');

        $image_content = read_file($file_path);
        
        $mime = mime_content_type($file_path); //<-- detect file type

        // Image was not found
        if($image_content === FALSE)
        {
            show_404();
            return FALSE;
        }
        header('Content-Length: '.strlen($image_content)); // sends filesize header
        header('Content-Type: '.$mime); // send mime-type header
        header('Content-Disposition: inline; filename="'.basename($file_path).'";'); // sends filename header
        
        exit($image_content); // reads and outputs the file onto the output buffer
    }
    
    protected function get_session(){
        if(isset($this->session->userdata['session'])){
            consoleLog($this->session->userdata);
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
    
    
    protected function load_header($title=''){
        session_write_close();
        $data = array(
            'title' => $title
        );
        $this->load->view('misc/head', $data);
        if($this->is_user_logged_in()){
            $data['nama_pengguna'] = $this->get_session()['nama_pengguna'];
        }
        $this->load->view('misc/header', $data);
        if($this->is_user_logged_in()){
            $nav_groups = array();
            if($this->cek_peran_pengguna(1)){
                $nav_items = array();
                array_push($nav_items, array(
                    'text'=>'Paket',
                    'url'=>base_url('customer/paket')
                ));
                array_push($nav_items, array(
                    'text'=>'Pesanan',
                    'url'=>base_url('customer/pesanan')
                ));
                $nav_group = array(
                    'text'=>'Customer',
                    'url'=>base_url('customer'),
                    'nav_items' => $nav_items
                );
                array_push($nav_groups, $nav_group);
            }
            if($this->cek_peran_pengguna(2)){
                $nav_items = array();
                array_push($nav_items, array(
                    'text'=>'Paket',
                    'url'=>base_url('travel')
                ));
                $nav_group = array(
                    'text'=>'Travel',
                    'url'=>base_url('travel'),
                    'nav_items' => $nav_items
                );
                array_push($nav_groups, $nav_group);
            }
            if($this->cek_peran_pengguna(3)){
                $nav_items = array();
                array_push($nav_items, array(
                    'text'=>'Paket',
                    'url'=>base_url('percetakan')
                ));
                array_push($nav_items, array(
                    'text'=>'Pesanan',
                    'url'=>base_url('percetakan/pesanan')
                ));
                $nav_group = array(
                    'text'=>'Percetakan',
                    'url'=>base_url('percetakan'),
                    'nav_items' => $nav_items
                );
                array_push($nav_groups, $nav_group);
            }
            if($this->cek_peran_pengguna(4)){
                $nav_items = array();
                array_push($nav_items, array(
                    'text'=>'Pesanan',
                    'url'=>base_url('admin/pesanan')
                ));
                $nav_group = array(
                    'text'=>'Admin',
                    'url'=>base_url('admin'),
                    'nav_items' => $nav_items
                );
                array_push($nav_groups, $nav_group);
            }
            $this->load->view('misc/sidebar', array('nav_groups'=> $nav_groups));
        }
    }
    
    protected function load_footer(){
        $this->load->view('misc/footer');
    }
    
    protected function load_view($view, $title='', $data=array()){
        session_write_close();
        $this->load_header($title);
        $this->load->view($view, $data);
        $this->load_footer();
    }

    protected function create_confirmation_dialog($id, $on_confirm, $body='Apa Anda yakin?', $title='Konfirmasi', $confirm_text='Ya', $cancel_text='Batal'){
        $data = array(
            'dialog_on_confirm' => $on_confirm,
            'dialog_id' => $id,
            'dialog_body' => $body,
            'dialog_title' => $title,
            'dialog_confirm_text' => $confirm_text,
            'dialog_cancel_text' => $cancel_text
        );
        return $data;
    }
    
    protected function load_notice($title, $notice_title, $notice_text){
        session_write_close();
        $this->load_view('notice', $title, array(
            'notice_title' => $notice_title,
            'notice_text' => $notice_text
        ));
    }
    
    protected function view_exists($view){
        return file_exists(APPPATH.'views/' . $view . '.php');
    }
    
    protected function fail($error='', $redirect=null){
        session_write_close();
        $result = array('result'=>'FAIL');
        $result['error'] = $error;
        $result['redirect']=$redirect;
        return $result;
    }
    
    protected function fail_hak_akses($redirect=null){
        return $this->fail("Anda tidak memiliki hak akses yang cukup", $redirect);
    }
    
    protected function ok($message='', $redirect=null){
        session_write_close();
        $result = array('result'=>'OK');
        $result['message'] = $message;
        $result['redirect']=$redirect;
        return $result;
    }
    
    protected function get_fields($field_names){
        $fields = array();
        foreach($field_names as $field_name){
            $field = $this->input->post($field_name);
            if($field == NULL || !trim($field)){
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
    
}

?>
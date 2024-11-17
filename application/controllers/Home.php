<?php
require_once 'General_controller.php';

class Home extends General_controller{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $this->get_session();
        $peran = $this->get_peran_pengguna();
        session_write_close();
        $this->home($peran);
    }
    public function home($peran){
        session_write_close();
        if($peran == 1){
            $this->home_customer();
        }else if ($peran == 2){
            $this->home_travel();
        }else if ($peran == 3){
            $this->home_percetakan();
        }else if ($peran == 4){
            $this->home_admin();
        }
    }
    
    function home_admin(){
        session_write_close();
        $this->load_view('admin/front');
    }
    
    function home_customer(){
        session_write_close();
        redirect(base_url('customer'));
    }
    
    function home_travel(){
        session_write_close();
        redirect(base_url('travel'));
    }
    
    
    function home_percetakan(){
        session_write_close();
        redirect(base_url('percetakan'));
    }
}

<?php
require_once 'General_controller.php';

class Debug extends General_controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('foto_model');
    }
    
    public function index($path, $path2=null, $path3=null){
        session_write_close();
        if($path2 != null) $path = $path . '/' . $path2;
        if($path3 != null) $path = $path . '/' . $path3;
        $this->load_view($path);
    }
}
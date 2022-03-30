<?php
class MY_Loader extends CI_Loader {
	
    public function __construct() {
        $this->_ci_view_paths[FCPATH . 'assets/']=TRUE;
        $this->_ci_view_paths[FCPATH . '/']=TRUE;
    }
	
}
?>
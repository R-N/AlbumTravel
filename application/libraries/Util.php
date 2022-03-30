<?php
class Util{
	protected $ci;
	public function __construct(){
		$ci = &get_instance();
	}
	public function isUserLoggedIn($session){
		return isset($session->userdata['session']) && $session->userdata['session'] !== NULL && $session->userdata['session']['id_pengguna'] !== NULL;
	}
	
	public function getHeaderData($session){
		return array();
	}
	public function getFooterData($session){
		return array();
	}
}
?>
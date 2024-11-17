<?php
require_once 'General_model.php';

class Travel_model extends General_model {

    
    public function __construct()
    {
            parent::__construct();
    }
    
    public function fetch_travel($page=1, $search=null){
        $sql = "
            SELECT 
                T.id_travel, 
                T.nama_travel, 
                T.alamat_travel, 
                T.telepon_travel, 
                T.email_travel, 
                T.ringkasan_travel 
            FROM TRAVEL T
        ";
        $data = array();
        if($search != null){
            $sql = $sql . " 
                WHERE (
                    T.nama_travel LIKE '%?%' 
                    OR T.alamat_travel LIKE '%?%' 
                    OR T.telepon_travel LIKE '%?%' 
                    OR T.email_travel LIKE '%?%' 
                    OR T.ringkasan_travel LIKE '%?%' 
                    OR T.deskripsi_travel LIKE '%?%'
                )
            ";
            $data = array(
                $search,
                $search,
                $search,
                $search,
                $search,
                $search
            );
        }
        $limit = 100;
        //$sql = $sql . " LIMIT {$limit} OFFSET " . (($page-1) * $limit);
        
        $query = $this->db->query($sql, $data);
        $result = $query->result_array();
        $return = array(
            'result'=>'OK',
            'entries'=>$result
        );
        return $return;
    }
    public function get_travel($id_travel){
        $sql = "
            SELECT 
                T.id_travel, 
                T.nama_travel, 
                T.alamat_travel, 
                T.telepon_travel, 
                T.email_travel, 
                T.ringkasan_travel 
            FROM TRAVEL T 
            WHERE T.id_travel=?
        ";
        $query = $this->db->query($sql, array($id_travel));
        $result = $query->row_array();
        $result['result'] = 'OK';
        return $result;
    }
}
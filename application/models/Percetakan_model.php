<?php
require_once 'General_model.php';

class Percetakan_model extends General_model {

    
    public function __construct()
    {
            parent::__construct();
    }
    
    public function count_paket_cetak($search=null){
        $id_pengguna = $this->get_id_pengguna();
        $sql = '
            SELECT count(*) AS count 
            FROM 
                percetakan PC, 
                paket_cetak PCT 
            WHERE 
                PC.id_pengguna=? 
                AND PC.id_percetakan=PCT.id_percetakan
        ';
        
        $arg = array(
            $id_pengguna
        );
        
        
        $query = $this->db->query($sql, $arg);
        return $query->row()->count;
    }
    
    public function _fetch_paket_cetak($limit=10, $offset=0, $search=null){
        $id_pengguna = $this->get_id_pengguna();
        $sql = '
            SELECT 
                PCT.id_paket_cetak, 
                nama_paket_cetak, 
                harga_dasar, 
                harga_per_halaman 
            FROM 
                percetakan PC, 
                PAKET_cetak PCT 
            WHERE 
                PC.id_pengguna=? 
                AND PC.id_percetakan=PCT.id_percetakan
        ';
        
        $arg = array(
            $id_pengguna
        );
        
        $sql = $sql . '  ORDER BY PCT.id_paket_cetak DESC';// LIMIT ' . $limit . ' OFFSET ' . $offset;
        
        $query = $this->db->query($sql, $arg);
        
        $result = $query->result_array();
        
        return $result;
    }
    public function fetch_paket_cetak($page=1, $search=null){
        
        $limit=10;
        $offset = ($page-1) * $limit;
        
        $result = $this->_fetch_paket_cetak($limit, $offset, $search);
        
        $count = $this->count_paket_cetak();
        
        return array(
            'entries' => $result,
            'start'=>$offset+($count>0?1:0),
            'end'=>$offset+count($result),
            'count'=>$count
        );
    }
    
    public function get_paket_lite($id_paket_cetak){
        $id_pengguna = $this->get_id_pengguna();
        $sql = '
            SELECT 
                PCT.id_paket_cetak, 
                nama_paket_cetak, 
                harga_dasar, 
                harga_per_halaman, 
                ringkasan_paket_cetak 
            FROM 
                percetakan PC, 
                PAKET_cetak PCT 
            WHERE 
                PC.id_percetakan=PCT.id_percetakan 
                AND PC.id_pengguna=? 
                AND PCT.id_paket_cetak=?
        ';
        
        $query = $this->db->query($sql,array(
            $id_pengguna,
            $id_paket_cetak
        ));
        
        if($query->num_rows() <= 0){
            return null;
        }else{
            $result = $query->row_array();
            return $result;
        }
    }
    public function insert_paket_cetak($data){
        $id_pengguna = $this->get_id_pengguna();
        $sql1 = '
            SELECT PC.id_percetakan 
            FROM percetakan PC 
            WHERE PC.id_pengguna=?
        ';
        $query = $this->db->query($sql1, array($id_pengguna));
        $data['id_percetakan'] = $query->row()->id_percetakan;
        
        
        $query = $this->db->insert("PAKET_CETAK", $data);
        
        return $query && $this->db->affected_rows();
    }
    function verify_id_paket_cetak($id_paket_cetak){
        $sql = "
            SELECT PCT.id_paket_cetak 
            FROM 
                paket_cetak PCT, 
                percetakan PC 
            WHERE 
                PCT.id_paket_cetak=? 
                AND PCT.id_percetakan=PC.id_percetakan 
                AND PC.id_pengguna=?
        ";
        
        $query = $this->db->query($sql, array(
            $id_paket_cetak,
            $this->get_id_pengguna()
        ));
        
        return $query->row()->id_paket_cetak;
    }
    public function fetch_percetakan(){
        $sql = "
            SELECT 
                PC.id_percetakan, 
                PC.nama_percetakan, 
                PC.alamat_percetakan, 
                PC.telepon_percetakan, 
                PC.email_percetakan, 
                PC.ringkasan_percetakan 
            FROM percetakan PC 
            ORDER BY PC.nama_percetakan ASC
        ";
        $query = $this->db->query($sql);
        return array(
            'result' => "OK",
            'entries' => $query->result_array()
        );
    }
    public function fetch_paket_cetak_public($id_percetakan){
        $sql = '
            SELECT 
                PCT.id_paket_cetak, 
                nama_paket_cetak, 
                harga_dasar, 
                harga_per_halaman, 
                ringkasan_paket_cetak, 
                PC.id_percetakan, 
                PC.nama_percetakan 
            FROM 
                percetakan PC, 
                paket_cetak PCT 
            WHERE 
                PC.id_pengguna=? 
                AND PC.id_percetakan=PCT.id_percetakan
        ';
        
        $arg = array(
            $id_percetakan
        );
        
        $sql = $sql . '  ORDER BY PCT.id_paket_cetak DESC';// LIMIT ' . $limit . ' OFFSET ' . $offset;
        
        $query = $this->db->query($sql, $arg);
        
        $result = $query->result_array();
        
        return array(
            'result'=>'OK',
            'entries'=>$result
        );
    }
}
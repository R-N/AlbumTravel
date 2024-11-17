<?php
require_once 'General_model.php';

class Pesanan_model extends General_model {

    
    public function __construct()
    {
            parent::__construct();
    }
    
    public function fetch_pesanan_customer(){
        $id_pengguna = $this->get_id_pengguna();
        $sql = "
            SELECT 
                PS.id_pesanan, 
                ANGGOTA_GRUP AG, 
                CUSTOEMR C, 
                A.judul_album, 
                PT.nama_paket_travel, 
                T.paket_travel, 
            FROM 
                PESANAN PS, 
                ALBUM A, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                PS.id_anggota=AG.id_anggota_grup 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=? 
                AND AG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel
        ";
        $query = $this->db->query($sql, array($id_pengguna));
        
        return array(
            'result'=>'OK',
            'entries'=>$query->result_array()
        );
    }
}
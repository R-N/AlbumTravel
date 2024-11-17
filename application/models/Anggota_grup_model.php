<?php
require_once 'General_model.php';

class Anggota_grup_model extends General_model {

    
    public function __construct()
    {
            parent::__construct();
    }
    
    function get_id_anggota($id_paket_travel){
        $sql = "
            SELECT AG.id_anggota_grup 
            FROM 
                PAKET_TRAVEL PT, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                PT.id_paket_travel=? 
                AND PT.id_paket_travel=AG.id_paket_travel 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=?
        ";
        
        $query = $this->db->query($sql, array(
            $id_paket_travel,
            $this->get_id_pengguna()
        ));
        
        return $query->row()->id_anggota_grup;
    }
    function get_id_anggota_grup($id_paket_travel){
        return $this->get_id_anggota($id_paket_travel);
    }
    public function join_grup($id_paket_travel){
        $sql = "
            INSERT INTO 
            ANGGOTA_GRUP(id_customer, id_paket_travel) 
            SELECT C.id_customer, ? 
            FROM CUSTOMER C 
            WHERE C.id_pengguna=?
        ";
        $query = $this->db->query($sql, array(
            $id_paket_travel,
            $this->get_id_pengguna()
        ));
        if($query){
            return $this->ok('', base_url('customer'));
        }else{
            return $this->fail("Gagal join grup");
        }
    }
    function tambah_album_anggota($id_paket_travel, $judul_album){
        $id_anggota_grup = $this->get_id_anggota($id_paket_travel);
        
        $this->db->trans_start();
        
        $sql = "
            INSERT INTO 
            ALBUM(judul_album) 
            VALUES(?)
        ";
        $query = $this->db->query($sql, array($judul_album));
        if(!$query){
            $this->trans_rollback();
            return $this->fail("Gagal insert album");
        }
        $id_album = $this->db->insert_id();
        $sql = "
            INSERT INTO 
            ALBUM_ANGGOTA(id_album, id_anggota) 
            VALUES(?,?)
        ";
        $query = $this->db->query($sql, array(
            $id_album,
            $id_anggota_grup
        ));
        
        if(!$query){
            $this->trans_rollback();
            return $this->fail("Gagal tambah_album_anggota");
        }
        
        $this->db->trans_commit();
        
        return $this->ok();
    }
}
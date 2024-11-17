<?php
require_once 'General_model.php';

class Album_model extends General_model {

    
    public function __construct()
    {
            parent::__construct();
            $this->load->model('anggota_grup_model');
    }
    
    function count_album_grup($id_paket_travel, $search=null){
        $sql = '
            SELECT COUNT(*) AS count 
            FROM 
                ALBUM A, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                ABG.id_paket_travel=? 
                AND A.id_album=ABG.id_album 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND T.id_pengguna=?
        ';
        
        $arg = array(
            $id_paket_travel,
            $this->get_id_pengguna()
        );
        if($search != null){
            $sql = $sql . " AND (A.id_album=? OR A.judul_album LIKE '%?%')";
            array_push($arg, $search);
        }
        
        $query = $this->db->query($sql, $arg);
        return $query->row()->count;
    }
    
    function _fetch_album_grup($id_paket_travel, $limit=10, $offset=0, $search=null){
        
        $sql = '
            SELECT 
                T.id_travel, 
                A.id_album, 
                A.judul_album, 
                0 AS jumlah_pesanan_album 
            FROM 
                ALBUM A, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                A.id_album=ABG.id_album 
                AND ABG.id_paket_travel=? 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND T.id_pengguna=?
        ';
        
        $arg = array(
            $id_paket_travel,
            $this->get_id_pengguna()
        );
        if($search != null){
            $sql = $sql . " AND (F.id_foto=? OR F.judul_foto LIKE '%?%')";
            array_push($arg, $search);
        }
        
        $sql = $sql . " ORDER BY A.id_album DESC";
        //$sql = $sql . " LIMIT " . $limit . " OFFSET " . $offset;
        
        $query = $this->db->query($sql, $arg);
        return $query->result_array();
    }
    
    
    function fetch_album_grup($id_paket_travel, $page=1, $search=null){
        $limit = 10;
        $offset = ($page-1)*$limit;
        
        $result = $this->_fetch_album_grup($id_paket_travel, $limit, $offset, $search);
        $count = $this->count_album_grup($id_paket_travel, $search);
        
        
        return array(
            'entries' => $result,
            'start'=>$offset+($count>0?1:0),
            'end'=>$offset+count($result),
            'count'=>$count
        );
    }
    
    function delete_album_grup($id_album){
        $id_pengguna = $this->get_id_pengguna();
        $sql = '
            SELECT A.id_album 
            FROM 
                ALBUM A, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                A.id_album=? 
                AND A.id_album=ABG.id_album 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND T.id_pengguna=?
        ';
        
        $query = $this->db->query($sql, array(
            $id_album,
            $id_pengguna
        ));
        
        $result = $query->row();
        $id_album = $result->id_album;
        
        $this->db->trans_start();
        
        $this->db->where('id_album', $id_album);
        $this->db->delete('ALBUM');
        
        $this->db->trans_commit();
    }
    
    function fetch_grup_template(){
        $sql = 'SELECT GT.id_grup_template, GT.nama_grup_template FROM GRUP_TEMPLATE GT ORDER BY GT.id_grup_template ASC;';
        $query = $this->db->query($sql);
        return array(
            'result'=>'OK',
            'entries'=>$query->result_array()
        );
    }
    
    
    function count_album_anggota($id_paket_travel, $search=null){
        $sql = '
            SELECT A.id_album 
            FROM 
                ALBUM A, 
                ALBUM_GRUP ABG, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                ABG.id_paket_travel=? 
                AND A.id_album=ABG.id_album 
                AND ABG.id_paket_travel=AG.id_paket_travel 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=?
        ';
        $sql2 = '
            SELECT A.id_album 
            FROM 
                ALBUM A, 
                ALBUM_ANGGOTA ABA, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                A.id_album=ABA.id_album 
                AND ABA.id_anggota=AG.id_anggota_grup 
                AND AG.id_customer=C.id_customer 
                AND AG.id_paket_travel=? 
                AND C.id_pengguna=?
        ';
        
        $arg = array(
            $id_paket_travel,
            $this->get_id_pengguna()
        );
        if($search != null){
            $sql = $sql . " AND (A.id_album=? OR A.judul_album LIKE '%?%')";
            $sql2 = $sql2 . " AND (A.id_album=? OR A.judul_album LIKE '%?%')";
            array_push($arg, $search);
        }
        $sql3 = "SELECT COUNT(*) AS count FROM (({$sql}) UNION ({$sql2})) ASD";
        
        $data = array_merge(array(), $arg);
        $data = array_merge($data, $arg);
        
        
        $query = $this->db->query($sql3, $data);
        return $query->row()->count;
    }
    
    function _fetch_album_anggota($id_paket_travel, $limit=10, $offset=0, $search=null){
        
        $sql = '
            SELECT 
                T.id_travel, 
                A.id_album, 
                A.judul_album, 
                0 AS jumlah_pesanan_album, 
                1 AS jenis_album 
            FROM 
                ALBUM A, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                A.id_album=ABG.id_album 
                AND ABG.id_paket_travel=? 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND AG.id_paket_travel=PT.id_paket_travel 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=?
        ';
        $sql2 = '
            SELECT 
                T.id_travel, 
                A.id_album, 
                A.judul_album, 
                0 AS jumlah_pesanan_album, 
                2 AS jenis_album 
            FROM 
                ALBUM A, 
                ALBUM_ANGGOTA ABA, 
                PAKET_TRAVEL PT, 
                TRAVEL T, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                A.id_album=ABA.id_album 
                AND ABA.id_anggota=AG.id_anggota_grup 
                AND AG.id_paket_travel=? 
                AND PT.id_travel=T.id_travel 
                AND AG.id_paket_travel=PT.id_paket_travel 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=?
        ';
        
        $arg = array(
            $id_paket_travel,
            $this->get_id_pengguna()
        );
        if($search != null){
            $sql = $sql . " AND (A.id_album=? OR A.judul_album LIKE '%?%')";
            $sql2 = $sql2 . " AND (A.id_album=? OR A.judul_album LIKE '%?%')";
            array_push($arg, $search);
        }
        $sql3 = "SELECT * FROM (({$sql}) UNION ({$sql2})) ASD";
        
        $data = array_merge(array(), $arg);
        $data = array_merge($data, $arg);
        
        $sql3 = $sql3 . " ORDER BY id_album DESC";
        //$sql = $sql . " LIMIT " . $limit . " OFFSET " . $offset;
        
        $query = $this->db->query($sql3, $data);
        return $query->result_array();
    }
    
    
    function fetch_album_anggota($id_paket_travel, $page=1, $search=null){
        $limit = 10;
        $offset = ($page-1)*$limit;
        
        $result = $this->_fetch_album_anggota($id_paket_travel, $limit, $offset, $search);
        $count = $this->count_album_anggota($id_paket_travel, $search);
        
        
        return array(
            'entries' => $result,
            'start'=>$offset+($count>0?1:0),
            'end'=>$offset+count($result),
            'count'=>$count
        );
    }
    
    function verify_id_album_anggota($id_album){
        $sql = '
            SELECT id_album 
            FROM 
                ALBUM_GRUP ABG, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                ABG.id_album=? 
                AND ABG.id_paket_travel=AG.id_paket_travel 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=?
        ';
        $sql2 = '
            SELECT id_album 
            FROM 
                ALBUM_ANGGOTA ABA, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                ABA.id_album=? 
                AND ABA.id_anggota=AG.id_anggota_grup 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=?
        ';
        
        $arg = array(
            $id_paket_travel,
            $this->get_id_pengguna()
        );
        $sql3 = "
            SELECT COUNT(*) 
            FROM (
                ({$sql}) 
                UNION 
                ({$sql2})
            ) ASD
        ";
        
        $sql = '
            SELECT A.id_album 
            FROM 
                ALBUM A, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                A.id_album=? 
                AND A.id_album=ABG.id_album 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND T.id_pengguna=?
        ';
        
        $data = array_merge(array(), $arg);
        $data = array_merge($data, $arg);
        $query = $this->db->query($sql, $data);
        
        $result = $query->row();
        $id_album = $result->id_album;
        
        return $id_album;
    }
    
    function delete_album_anggota($id_album){
        $id_pengguna = $this->get_id_pengguna();
        
        $id_album = $this->verify_id_album_anggota($id_album);
        
        $this->db->trans_start();
        
        $this->db->where('id_album', $id_album);
        $this->db->delete('ALBUM');
        
        $this->db->trans_commit();
    }
    
    
    
    function _fetch_template_halaman($sql, $arg){
        $query = $this->db->query($sql, $arg);
        $entries = $query->result_array();
        $len = count($entries);
        for($i = 0; $i < $len; ++$i){
            $entry = $entries[$i];
            $entry['url_template'] = base_url($entry['url_template']);
            $entry['text'] = $entry['nama_template'] . " ({$entry['jumlah_foto']} foto)";
            $entries[$i] = $entry;
        }
        return array(
            'result'=>'OK',
            'entries'=>$entries
        );
    }
    
    function fetch_template_halaman($id_grup_template){
        $sql = '
            SELECT 
                TH.id_template, 
                TH.id_grup_template, 
                TH.nama_template, 
                TH.jumlah_foto, 
                TH.url_template 
            FROM TEMPLATE_HALAMAN TH 
            WHERE TH.id_grup_template=? 
            ORDER BY TH.id_template ASC;
        ';
        return $this->_fetch_template_halaman($sql, array($id_grup_template));
    }
    function fetch_template_halaman_saudara($id_template){
        $sql = '
            SELECT 
                TH.id_template, 
                TH.id_grup_template, 
                TH.nama_template, 
                TH.jumlah_foto, 
                TH.url_template 
            FROM TEMPLATE_HALAMAN TH 
            WHERE TH.id_grup_template=(
                SELECT TH2.id_grup_template 
                FROM TEMPLATE_HALAMAN TH2 
                WHERE TH2.id_template=?
            ) ORDER BY TH.id_template ASC;';
        return $this->_fetch_template_halaman($sql, array($id_template));
    }
    function get_id_grup_template($id_template){
        $sql = '
            SELECT TH.id_grup_template 
            FROM TEMPLATE_HALAMAN TH 
            WHERE TH.id_template=?;
        ';
        $ret =  $this->db->query($sql, array($id_template))->row_array();
        $ret['result'] = 'OK';
        return $ret;   
    }
    function get_template_halaman($id_template){
        $sql = '
            SELECT 
                TH.id_template, 
                TH.id_grup_template, 
                TH.nama_template, 
                TH.jumlah_foto, 
                TH.url_template 
            FROM TEMPLATE_HALAMAN TH 
            WHERE TH.id_template=?;
        ';
        $query = $this->db->query($sql, array($id_template));
        $result = $query->row_array();
        $result['result'] = 'OK';
        return $result;
    }
    
    function get_album($id_album){
        $sql = "
            SELECT * 
            FROM (
                (
                    SELECT 
                        AB.id_album, 
                        AB.judul_album, 
                        PT.nama_paket_travel, 
                        T.nama_travel 
                    FROM 
                        ALBUM AB, 
                        ALBUM_GRUP ABG, 
                        PAKET_TRAVEL PT, 
                        TRAVEL T 
                    WHERE 
                        AB.id_album=? 
                        AND AB.id_album=ABG.id_album 
                        AND ABG.id_paket_travel=PT.id_paket_travel 
                        AND PT.id_travel=T.id_travel 
                        AND T.id_pengguna=?
                ) 
                UNION 
                (
                    SELECT 
                        AB.id_album, 
                        AB.judul_album, 
                        PT.nama_paket_travel, 
                        T.nama_travel 
                    FROM 
                        ALBUM AB, 
                        ALBUM_ANGGOTA ABA, 
                        ANGGOTA_GRUP AG, 
                        PAKET_TRAVEL PT, 
                        TRAVEL T, 
                        CUSTOMER C 
                    WHERE 
                        AB.id_album=? 
                        AND AB.id_album=ABA.id_album 
                        AND ABA.id_anggota=AG.id_anggota_grup 
                        AND AG.id_paket_travel=PT.id_paket_travel 
                        AND PT.id_travel=T.id_travel 
                        AND AG.id_customer=C.id_customer 
                        AND C.id_pengguna=?
                )
            ) RET
        ";
        $data = array(
            $id_album,
            $this->get_id_pengguna(),
            $id_album,
            $this->get_id_pengguna()
        );
        $query = $this->db->query($sql, $data);
        
        $row = $query->row_array();
        
        $row['result'] = 'OK';
        
        return $row;
    }
    
    function get_album_admin($id_album){
        $sql = "
            SELECT * 
            FROM (
                (
                    SELECT 
                        AB.id_album, 
                        AB.judul_album, 
                        PT.nama_paket_travel, 
                        T.nama_travel 
                    FROM 
                        ALBUM AB, 
                        ALBUM_GRUP ABG, 
                        PAKET_TRAVEL PT, 
                        TRAVEL T 
                    WHERE 
                        AB.id_album=? 
                        AND AB.id_album=ABG.id_album 
                        AND ABG.id_paket_travel=PT.id_paket_travel 
                        AND PT.id_travel=T.id_travel
                ) 
                UNION 
                (
                    SELECT 
                        AB.id_album, 
                        AB.judul_album, 
                        PT.nama_paket_travel, 
                        T.nama_travel 
                    FROM 
                        ALBUM AB, 
                        ALBUM_ANGGOTA ABA, 
                        ANGGOTA_GRUP AG, 
                        PAKET_TRAVEL PT, 
                        TRAVEL T 
                    WHERE 
                        AB.id_album=? 
                        AND AB.id_album=ABA.id_album 
                        AND ABA.id_anggota=AG.id_anggota_grup 
                        AND AG.id_paket_travel=PT.id_paket_travel 
                        AND PT.id_travel=T.id_travel
                )
            ) RET
        ";
        $data = array(
            $id_album,
            $id_album
        );
        $query = $this->db->query($sql, $data);
        
        $row = $query->row_array();
        
        $row['result'] = 'OK';
        
        return $row;
    }
    
    function fetch_halaman($id_album){
        $sql = "
            SELECT 
                H.id_halaman, 
                H.id_album, 
                H.nomor_halaman, 
                TP.id_template, 
                TP.nama_template, 
                TP.jumlah_foto, 
                GT.nama_grup_template, 
                (
                    SELECT COUNT(*) 
                    FROM FOTO_HALAMAN FH 
                    WHERE FH.id_halaman=H.id_halaman
                ) AS jumlah_foto_halaman 
            FROM 
                HALAMAN H 
                LEFT JOIN TEMPLATE_HALAMAN TP 
                    ON H.id_template=TP.id_template 
                LEFT JOIN GRUP_TEMPLATE GT 
                    ON TP.id_grup_template=GT.id_grup_template, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                ABG.id_album=H.id_album 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND T.id_pengguna=? 
                AND H.id_album=?
        ";
        $sql2 = "
            SELECT 
                H.id_halaman, 
                H.id_album, 
                H.nomor_halaman, 
                TP.id_template, 
                TP.nama_template, 
                TP.jumlah_foto, 
                GT.nama_grup_template, 
                (
                    SELECT COUNT(*) 
                    FROM FOTO_HALAMAN FH 
                    WHERE FH.id_halaman=H.id_halaman
                ) AS jumlah_foto_halaman 
            FROM 
                HALAMAN H 
                LEFT JOIN TEMPLATE_HALAMAN TP 
                    ON H.id_template=TP.id_template 
                LEFT JOIN GRUP_TEMPLATE GT 
                    ON TP.id_grup_template=GT.id_grup_template, 
                ALBUM_ANGGOTA ABA, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                ABA.id_album=H.id_album 
                AND ABA.id_anggota=AG.id_anggota_grup 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=? 
                AND H.id_album=?
        ";
        
        $peran_pengguna = $this->get_peran_pengguna();
        $id_pengguna = $this->get_id_pengguna();
        $data = array(
            $id_pengguna,
            $id_album,
            $id_pengguna,
            $id_album
        );
        
        $sql3 = "
            SELECT * 
            FROM (
                (
                    {$sql}
                ) 
                UNION 
                (
                    {$sql2}
                )
            ) ASD 
            ORDER BY id_album, nomor_halaman, id_halaman
        ";
        
        $query = $this->db->query($sql3, $data);
        
        return array(
            'result'=>'OK',
            'entries'=>$query->result_array()
        );
        
    }
    
    
    function get_halaman($id_album, $nomor_halaman){
        
        $sql = "
            SELECT 
                A.judul_album, 
                H.id_halaman, 
                H.id_album, 
                H.id_template, 
                H.nomor_halaman, 
                TP.nama_template, 
                TP.url_template, 
                TP.jumlah_foto, 
                GT.id_grup_template, 
                GT.nama_grup_template, 
                GT.url_grup_template, 
                PT.nama_paket_travel, 
                T.nama_travel, 
                PT.tanggal_keberangkatan, 
                PT.lama_keberangkatan, 
                DATE_ADD(PT.tanggal_keberangkatan, 
                INTERVAL PT.lama_keberangkatan DAY) AS tanggal_kembali 
            FROM 
                HALAMAN H 
                LEFT JOIN TEMPLATE_HALAMAN TP 
                    ON H.id_template=TP.id_template 
                LEFT JOIN GRUP_TEMPLATE GT 
                    ON TP.id_grup_template=GT.id_grup_template, 
                ALBUM A, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                ABG.id_album=H.id_album 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND T.id_pengguna=? 
                AND H.id_album=? 
                AND H.nomor_halaman=? 
                AND A.id_album=ABG.id_album
        ";
        $sql2 = "
            SELECT 
                A.judul_album, 
                H.id_halaman, 
                H.id_album, 
                H.id_template, 
                H.nomor_halaman, 
                TP.nama_template, 
                TP.url_template, 
                TP.jumlah_foto, 
                GT.id_grup_template, 
                GT.nama_grup_template, 
                GT.url_grup_template, 
                PT.nama_paket_travel, 
                T.nama_travel, 
                PT.tanggal_keberangkatan, 
                PT.lama_keberangkatan, 
                DATE_ADD(
                    PT.tanggal_keberangkatan, 
                    INTERVAL PT.lama_keberangkatan DAY
                ) AS tanggal_kembali 
            FROM 
                HALAMAN H 
                LEFT JOIN TEMPLATE_HALAMAN TP 
                    ON H.id_template=TP.id_template 
                LEFT JOIN GRUP_TEMPLATE GT 
                    ON TP.id_grup_template=GT.id_grup_template, 
                ALBUM A, 
                ALBUM_ANGGOTA ABA, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                ABA.id_album=H.id_album 
                AND ABA.id_anggota=AG.id_anggota_grup 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=? 
                AND H.id_album=? 
                AND H.nomor_halaman=? 
                AND AG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND A.id_album=ABA.id_album
        ";
        
        $peran_pengguna = $this->get_peran_pengguna();
        $id_pengguna = $this->get_id_pengguna();
        $data = array(
            $id_pengguna,
            $id_album,
            $nomor_halaman,
            $id_pengguna,
            $id_album,
            $nomor_halaman
        );
        
        $sql3 = "
            SELECT * 
            FROM (
                (
                    {$sql}
                ) 
                UNION 
                (
                    {$sql2}
                )
            ) ASD 
            ORDER BY id_album, nomor_halaman, id_halaman
        ";
        
        $query = $this->db->query($sql3, $data);
        $row = $query->row_array();
        $row['result'] = 'OK';
        $row['text'] = 'Halaman ' . $row['nomor_halaman'];
        return $row;
    }
    
    function get_halaman_full($id_album){
        
        $sql = "
            SELECT 
                A.judul_album, 
                H.id_halaman, 
                H.id_album, 
                H.id_template, 
                H.nomor_halaman, 
                TP.nama_template, 
                TP.url_template, 
                TP.jumlah_foto, 
                GT.id_grup_template, 
                GT.nama_grup_template, 
                GT.url_grup_template, 
                PT.nama_paket_travel, 
                T.nama_travel, 
                PT.tanggal_keberangkatan, 
                PT.lama_keberangkatan, 
                DATE_ADD(
                    PT.tanggal_keberangkatan, 
                    INTERVAL PT.lama_keberangkatan DAY
                ) AS tanggal_kembali 
            FROM 
                HALAMAN H 
                LEFT JOIN TEMPLATE_HALAMAN TP 
                    ON H.id_template=TP.id_template 
                LEFT JOIN GRUP_TEMPLATE GT 
                    ON TP.id_grup_template=GT.id_grup_template, 
                ALBUM A, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                ABG.id_album=H.id_album 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND T.id_pengguna=? 
                AND H.id_album=? 
                AND A.id_album=ABG.id_album
        ";
        $sql2 = "
            SELECT 
                A.judul_album, 
                H.id_halaman, 
                H.id_album, 
                H.id_template, 
                H.nomor_halaman, 
                TP.nama_template, 
                TP.url_template, 
                TP.jumlah_foto, 
                GT.id_grup_template, 
                GT.nama_grup_template, 
                GT.url_grup_template, 
                PT.nama_paket_travel, 
                T.nama_travel, 
                PT.tanggal_keberangkatan, 
                PT.lama_keberangkatan, 
                DATE_ADD(
                    PT.tanggal_keberangkatan, 
                    INTERVAL PT.lama_keberangkatan DAY
                ) AS tanggal_kembali 
            FROM 
                HALAMAN H 
                LEFT JOIN TEMPLATE_HALAMAN TP 
                    ON H.id_template=TP.id_template 
                LEFT JOIN GRUP_TEMPLATE GT 
                    ON TP.id_grup_template=GT.id_grup_template, 
                ALBUM A, 
                ALBUM_ANGGOTA ABA, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                ABA.id_album=H.id_album 
                AND ABA.id_anggota=AG.id_anggota_grup 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=? 
                AND H.id_album=? 
                AND AG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND A.id_album=ABA.id_album
        ";
        
        $peran_pengguna = $this->get_peran_pengguna();
        $id_pengguna = $this->get_id_pengguna();
        $data = array(
            $id_pengguna,
            $id_album,
            $id_pengguna,
            $id_album
        );
        
        $sql3 = "
            SELECT * 
            FROM (
                (
                    {$sql}
                ) 
                UNION 
                (
                    {$sql2}
                )
            ) ASD 
            ORDER BY id_album, nomor_halaman, id_halaman
        ";
        
        $query = $this->db->query($sql3, $data);
        $result = $query->result_array();
        return array(
            'result'=>'OK',
            'entries'=>$result
        );
    }
    
    function verify_id_halaman($id_halaman){
        $sql = "
            SELECT H.id_halaman 
            FROM 
                HALAMAN H, 
                ALBUM_GRUP ABG, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                ABG.id_album=H.id_album 
                AND ABG.id_paket_travel=PT.id_paket_travel 
                AND PT.id_travel=T.id_travel 
                AND T.id_pengguna=? 
                AND H.id_halaman=?
        ";
        $sql2 = "
            SELECT H.id_halaman 
            FROM 
                HALAMAN H, 
                ALBUM_ANGGOTA ABA, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                ABA.id_album=H.id_album 
                AND ABA.id_anggota=AG.id_anggota_grup 
                AND AG.id_customer=C.id_customer 
                AND C.id_pengguna=? 
            AND H.id_halaman=?
        ";
        
        $peran_pengguna = $this->get_peran_pengguna();
        $id_pengguna = $this->get_id_pengguna();
        
        $data = array(
            $id_pengguna,
            $id_halaman,
            $id_pengguna,
            $id_halaman
        );
        $sql3 = "
            SELECT * 
            FROM (
                (
                    {$sql}
                ) 
                UNION 
                (
                    {$sql2}
                )
            ) ASD
        ";
        
        $query = $this->db->query($sql3, $data);
        $id_halaman = $query->row()->id_halaman;
        return $id_halaman;
    }
    
    function fetch_foto_halaman($id_halaman){
        $id_halaman = $this->verify_id_halaman($id_halaman);
        
        $sql = "
            SELECT 
                FH.id_foto, 
                FH.urutan_foto_halaman, 
                FH.id_halaman 
            FROM FOTO_HALAMAN FH 
            WHERE FH.id_halaman=?
        ";
        
        $query = $this->db->query($sql, array($id_halaman));
        
        return array(
            'result'=>'OK',
            'entries'=>$query->result_array()
        );
    }
    function set_foto_halaman($id_halaman, $urutan_foto_halaman, $id_foto){
        $id_halaman = $this->verify_id_halaman($id_halaman);
        
        $sql = "
            INSERT INTO FOTO_HALAMAN(
                id_foto, id_halaman, urutan_foto_halaman
            ) VALUES(?, ?, ?) 
            ON DUPLICATE KEY UPDATE id_foto=?
        ";
        
        $query = $this->db->query($sql, array(
            $id_foto,
            $id_halaman,
            $urutan_foto_halaman,
            $id_foto
        ));
        
        if($query){
            return $this->ok();
        }else{
            return $this->fail('hlm tidak ditemukan');
        }
    }
    
    function set_template($id_halaman, $id_template){
        $old_id=$id_halaman;
        $id_halaman = $this->verify_id_halaman($id_halaman);
        
        $this->db->trans_start();
        
        $sql = "
            UPDATE HALAMAN 
            SET id_template=? 
            WHERE id_halaman=?
        ";
        
        $query = $this->db->query($sql, array(
            $id_template,
            $id_halaman
        ));
        
        if($this->db->affected_rows()==0){
            return $this->fail("Id halaman tidak ditemukan: "  . $old_id . ", " . $id_halaman);
        }
        
        $sql = "
            DELETE FROM FOTO_HALAMAN 
            WHERE 
                id_halaman=? 
                AND urutan_foto_halaman > (
                    SELECT jumlah_foto 
                    FROM TEMPLATE_HALAMAN 
                    WHERE id_template=?
                )
        ";
        $query = $this->db->query($sql, array(
            $id_halaman,
            $id_template
        ));
        
        $this->db->trans_commit();
        
        return $this->ok();
            
    }
    
    function verify_id_album($id_album){
        $sql = "
            SELECT * 
            FROM (
                (
                    SELECT AB.id_album 
                    FROM 
                        ALBUM AB, 
                        ALBUM_GRUP ABG, 
                        PAKET_TRAVEL PT, 
                        TRAVEL T 
                    WHERE 
                        AB.id_album=? 
                        AND AB.id_album=ABG.id_album 
                        AND ABG.id_paket_travel=PT.id_paket_travel 
                        AND PT.id_travel=T.id_travel 
                        AND T.id_pengguna=?
                ) 
                UNION 
                (
                    SELECT AB.id_album 
                    FROM 
                        ALBUM AB, 
                        ALBUM_ANGGOTA ABA, 
                        ANGGOTA_GRUP AG, 
                        PAKET_TRAVEL PT, 
                        TRAVEL T, 
                        CUSTOMER C 
                    WHERE 
                        AB.id_album=? 
                        AND AB.id_album=ABA.id_album 
                        AND ABA.id_anggota=AG.id_anggota_grup 
                        AND AG.id_paket_travel=PT.id_paket_travel 
                        AND PT.id_travel=T.id_travel 
                        AND AG.id_customer=C.id_customer 
                        AND C.id_pengguna=?
                )
            ) RET
        ";
        $query = $this->db->query($sql, array(
            $id_album,
            $this->get_id_pengguna(),
            $id_album,
            $this->get_id_pengguna()
        ));
        $id_album = $query->row()->id_album;
        return $id_album;
    }
    function tambah_halaman($id_album, $id_template=null){
        $id_album = $this->verify_id_album($id_album);
        
        $sql = "
            INSERT INTO 
            HALAMAN(
                id_album, 
                id_template, 
                nomor_halaman
            ) 
            SELECT 
                ?, ?, COUNT(*)+1 
                FROM HALAMAN 
                WHERE id_album=?
        ";
        
        $query = $this->db->query($sql, array(
            $id_album, 
            $id_template, 
            $id_album
        ));
        
        if(!$query){
            return $this->fail("Gagal menambah halaman");
        }
        
        $id_halaman = $this->db->insert_id();
        
        return $this->ok();
    }
    function pesan_album($id_album, $id_paket_travel){
        $id_album = $this->verify_id_album($id_album);
        $id_anggota = $this->anggota_grup_model->get_id_anggota_grup($id_paket_travel);
        
        $sql = "
            INSERT INTO 
            PESANAN_ALBUM(
                id_anggota, 
                id_album
            ) 
            VALUES(?, ?)
        ";
        $query = $this->db->query($sql, array(
            $id_anggota,
            $id_album
        ));
        
        if($query){
            return $this->ok();
        }else{
            return $this->fail("Gagal pesan");
        }
    }
    public function fetch_pesanan_customer(){
        $id_pengguna = $this->get_id_pengguna();
        $sql = "
            SELECT 
                PS.id_pesanan, 
                A.judul_album, 
                PT.nama_paket_travel, 
                T.nama_travel 
            FROM 
                PESANAN_ALBUM PS, 
                ALBUM A, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C, 
                PAKET_TRAVEL PT, 
                TRAVEL T 
            WHERE 
                PS.id_anggota=AG.id_anggota_grup 
                AND A.id_album=PS.id_album 
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
    public function set_paket_cetak($id_album, $id_paket_cetak){
        if(!$this->cek_peran_pengguna(4)){
            return $this->fail_hak_akses();
        }
        $sql = "
            UPDATE ALBUM 
            SET id_paket_cetak=? 
            WHERE id_album=?
        ";
        $query = $this->db->query($sql, array(
            $id_paket_cetak,
            $id_album
        ));
        
        if($this->db->affected_rows() > 0){
            return $this->ok();
        }else{
            return $this->fail("Gagal set paket cetak : ({$id_album}, {$id_paket_cetak})");
        }
    }
    public function fetch_pesanan_admin(){
        if(!$this->cek_peran_pengguna(4)){
            return $this->fail_hak_akses();
        }
        $sql = "
            SELECT 
                RET.*, 
                PCT.nama_paket_cetak, 
                PC.id_percetakan, 
                PC.nama_percetakan 
            FROM (
                (
                    SELECT 
                        AB.id_album, 
                        AB.judul_album, 
                        AB.id_paket_cetak, 
                        PT.nama_paket_travel, 
                        T.nama_travel, 
                        (
                            SELECT COUNT(*) 
                            FROM PESANAN_ALBUM PA 
                            WHERE PA.id_album=AB.id_album
                        ) AS jumlah_pesanan 
                    FROM 
                        ALBUM AB, 
                        ALBUM_GRUP ABG, 
                        PAKET_TRAVEL PT, 
                        TRAVEL T 
                    WHERE 
                        AB.id_album=ABG.id_album 
                        AND ABG.id_paket_travel=PT.id_paket_travel 
                        AND PT.id_travel=T.id_travel
                ) 
                UNION 
                (
                    SELECT 
                        AB.id_album, 
                        AB.judul_album, 
                        AB.id_paket_cetak, 
                        PT.nama_paket_travel, 
                        T.nama_travel, 
                        (
                            SELECT COUNT(*) 
                            FROM PESANAN_ALBUM PA 
                            WHERE PA.id_album=AB.id_album
                        ) AS jumlah_pesanan 
                    FROM 
                        ALBUM AB, 
                        ALBUM_ANGGOTA ABA, 
                        ANGGOTA_GRUP AG, 
                        PAKET_TRAVEL PT, 
                        TRAVEL T 
                    WHERE 
                        AB.id_album=ABA.id_album 
                        AND ABA.id_anggota=AG.id_anggota_grup 
                        AND AG.id_paket_travel=PT.id_paket_travel 
                        AND PT.id_travel=T.id_travel
                )
            ) RET 
            LEFT JOIN PAKET_CETAK PCT 
                ON RET.id_paket_cetak=PCT.id_paket_cetak 
            LEFT JOIN PERCETAKAN PC 
                ON PCT.id_percetakan=PC.id_percetakan 
            WHERE RET.jumlah_pesanan > 0 
            ORDER BY (RET.id_paket_cetak IS NULL) DESC
        ";
        
        $query = $this->db->query($sql);
        
        $result = $query->result_array();
        
        return array(
            'result'=>'OK',
            'entries'=>$result
        );
    }
    public function fetch_pesanan_percetakan(){
        $sql = "
            SELECT 
                RET.*, 
                PCT.nama_paket_cetak, 
                PC.id_percetakan, 
                PC.nama_percetakan, 
                (
                    SELECT COUNT(*) 
                    FROM PESANAN_ALBUM PA 
                    WHERE PA.id_album=RET.id_album
                ) AS jumlah_pesanan 
            FROM 
                (
                    (
                        SELECT 
                            AB.id_album, 
                            AB.judul_album, 
                            AB.id_paket_cetak, 
                            PT.nama_paket_travel, 
                            T.nama_travel, 
                            (
                                SELECT COUNT(*) 
                                FROM PESANAN_ALBUM PA 
                                WHERE PA.id_album=AB.id_album
                            ) AS jumlah_pesanan 
                        FROM 
                            ALBUM AB, 
                            ALBUM_GRUP ABG, 
                            PAKET_TRAVEL PT, 
                            TRAVEL T 
                        WHERE 
                            AB.id_album=ABG.id_album 
                            AND ABG.id_paket_travel=PT.id_paket_travel 
                            AND PT.id_travel=T.id_travel
                    ) 
                    UNION 
                    (
                        SELECT 
                            AB.id_album, 
                            AB.judul_album, 
                            AB.id_paket_cetak, 
                            PT.nama_paket_travel, 
                            T.nama_travel, 
                            (
                                SELECT COUNT(*) 
                                FROM PESANAN_ALBUM PA 
                                WHERE PA.id_album=AB.id_album
                            ) AS jumlah_pesanan 
                        FROM 
                            ALBUM AB, 
                            ALBUM_ANGGOTA ABA, 
                            ANGGOTA_GRUP AG, 
                            PAKET_TRAVEL PT, 
                            TRAVEL T 
                        WHERE 
                            AB.id_album=ABA.id_album 
                            AND ABA.id_anggota=AG.id_anggota_grup 
                            AND AG.id_paket_travel=PT.id_paket_travel 
                            AND PT.id_travel=T.id_travel
                    )
                ) RET, 
                PAKET_CETAK PCT, 
                PERCETAKAN PC 
            WHERE 
                RET.id_paket_cetak=PCT.id_paket_cetak 
                AND PCT.id_percetakan=PC.id_percetakan 
                AND PC.id_pengguna=? 
                AND RET.jumlah_pesanan > 0 
            ORDER BY (RET.id_paket_cetak IS NULL) DESC
        ";
        
        $query = $this->db->query($sql, array($this->get_id_pengguna()));
        
        $result = $query->result_array();
        
        return array(
            'result'=>'OK',
            'entries'=>$result
        );
    }
    public function fetch_pesanan_rinci($id_album){
        $id_pengguna = $this->get_id_pengguna();
        $sql = "
            SELECT 
                PS.id_pesanan, 
                C.id_customer, 
                C.nama_customer, 
                C.alamat_customer, 
                C.telepon_customer, 
                PS.tanggal_lunas, 
                PS.tanggal_kirim, 
                PS.tanggal_terima, 
                COUNT(*) as jumlah_pesanan 
            FROM 
                PESANAN_ALBUM PS, 
                ANGGOTA_GRUP AG, 
                CUSTOMER C 
            WHERE 
                PS.id_anggota=AG.id_anggota_grup 
                AND AG.id_customer=C.id_customer 
                AND PS.id_album=? 
            GROUP BY 
                PS.id_pesanan, 
                C.id_customer, 
                C.nama_customer, 
                C.alamat_customer, 
                C.telepon_customer, 
                PS.tanggal_lunas, 
                PS.tanggal_kirim, 
                PS.tanggal_terima 
            ORDER BY 
                (PS.tanggal_terima IS NULL) ASC, 
                (PS.tanggal_kirim IS NULL) ASC, 
                (PS.tanggal_lunas IS NULL) DESC
        ";
        $query = $this->db->query($sql, array($id_pengguna));
        
        return array(
            'result'=>'OK',
            'entries'=>$query->result_array()
        );
    }
}
--
-- PostgreSQL database dump
--

-- Dumped from database version 14.5
-- Dumped by pg_dump version 14.2

-- Started on 2024-11-16 18:28:28

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 10 (class 2615 OID 17021)
-- Name: albumtravel; Type: SCHEMA; Schema: -; Owner: -
--

CREATE SCHEMA albumtravel;


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 249 (class 1259 OID 18507)
-- Name: akun; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.akun (
    id_pengguna integer NOT NULL,
    username character varying(20) NOT NULL,
    password character varying(32) NOT NULL,
    peran_pengguna integer NOT NULL,
    email_pengguna character varying(255) NOT NULL,
    status_akun integer NOT NULL
);


--
-- TOC entry 248 (class 1259 OID 18506)
-- Name: akun_id_pengguna_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.akun_id_pengguna_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3640 (class 0 OID 0)
-- Dependencies: 248
-- Name: akun_id_pengguna_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.akun_id_pengguna_seq OWNED BY albumtravel.akun.id_pengguna;


--
-- TOC entry 251 (class 1259 OID 18512)
-- Name: album; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.album (
    id_album integer NOT NULL,
    id_paket_cetak integer,
    judul_album character varying(20)
);


--
-- TOC entry 252 (class 1259 OID 18516)
-- Name: album_anggota; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.album_anggota (
    id_album integer NOT NULL,
    id_anggota integer NOT NULL
);


--
-- TOC entry 253 (class 1259 OID 18519)
-- Name: album_grup; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.album_grup (
    id_album integer NOT NULL,
    id_paket_travel integer NOT NULL
);


--
-- TOC entry 250 (class 1259 OID 18511)
-- Name: album_id_album_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.album_id_album_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3641 (class 0 OID 0)
-- Dependencies: 250
-- Name: album_id_album_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.album_id_album_seq OWNED BY albumtravel.album.id_album;


--
-- TOC entry 255 (class 1259 OID 18523)
-- Name: anggota_grup; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.anggota_grup (
    id_anggota_grup integer NOT NULL,
    id_customer integer NOT NULL,
    id_paket_travel integer NOT NULL,
    rating_paket_travel integer,
    review_paket_travel character varying(255),
    status_anggota_grup integer DEFAULT 0 NOT NULL
);


--
-- TOC entry 254 (class 1259 OID 18522)
-- Name: anggota_grup_id_anggota_grup_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.anggota_grup_id_anggota_grup_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3642 (class 0 OID 0)
-- Dependencies: 254
-- Name: anggota_grup_id_anggota_grup_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.anggota_grup_id_anggota_grup_seq OWNED BY albumtravel.anggota_grup.id_anggota_grup;


--
-- TOC entry 257 (class 1259 OID 18529)
-- Name: customer; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.customer (
    id_customer integer NOT NULL,
    id_pengguna integer NOT NULL,
    nama_customer character varying(50) NOT NULL,
    alamat_customer character varying(255) NOT NULL,
    telepon_customer character varying(20) NOT NULL
);


--
-- TOC entry 256 (class 1259 OID 18528)
-- Name: customer_id_customer_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.customer_id_customer_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3643 (class 0 OID 0)
-- Dependencies: 256
-- Name: customer_id_customer_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.customer_id_customer_seq OWNED BY albumtravel.customer.id_customer;


--
-- TOC entry 259 (class 1259 OID 18534)
-- Name: foto; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.foto (
    id_foto integer NOT NULL,
    url_foto character varying(255) NOT NULL,
    judul_foto character varying(50),
    prioritas_foto integer
);


--
-- TOC entry 260 (class 1259 OID 18538)
-- Name: foto_anggota; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.foto_anggota (
    id_foto integer NOT NULL,
    id_anggota integer NOT NULL
);


--
-- TOC entry 261 (class 1259 OID 18541)
-- Name: foto_grup; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.foto_grup (
    id_foto integer NOT NULL,
    id_paket_travel integer NOT NULL
);


--
-- TOC entry 262 (class 1259 OID 18544)
-- Name: foto_halaman; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.foto_halaman (
    id_foto integer NOT NULL,
    id_halaman integer NOT NULL,
    urutan_foto_halaman integer NOT NULL,
    caption_foto_halaman integer
);


--
-- TOC entry 258 (class 1259 OID 18533)
-- Name: foto_id_foto_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.foto_id_foto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3644 (class 0 OID 0)
-- Dependencies: 258
-- Name: foto_id_foto_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.foto_id_foto_seq OWNED BY albumtravel.foto.id_foto;


--
-- TOC entry 264 (class 1259 OID 18548)
-- Name: grup_template; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.grup_template (
    id_grup_template integer NOT NULL,
    nama_grup_template character varying(20) NOT NULL,
    url_grup_template character varying(255) NOT NULL
);


--
-- TOC entry 263 (class 1259 OID 18547)
-- Name: grup_template_id_grup_template_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.grup_template_id_grup_template_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3645 (class 0 OID 0)
-- Dependencies: 263
-- Name: grup_template_id_grup_template_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.grup_template_id_grup_template_seq OWNED BY albumtravel.grup_template.id_grup_template;


--
-- TOC entry 266 (class 1259 OID 18553)
-- Name: halaman; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.halaman (
    id_halaman integer NOT NULL,
    id_album integer NOT NULL,
    id_template integer,
    nomor_halaman integer NOT NULL
);


--
-- TOC entry 265 (class 1259 OID 18552)
-- Name: halaman_id_halaman_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.halaman_id_halaman_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3646 (class 0 OID 0)
-- Dependencies: 265
-- Name: halaman_id_halaman_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.halaman_id_halaman_seq OWNED BY albumtravel.halaman.id_halaman;


--
-- TOC entry 267 (class 1259 OID 18557)
-- Name: konfirmasi_akun; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.konfirmasi_akun (
    id_pengguna integer NOT NULL,
    kode_konfirmasi character(32) NOT NULL,
    tanggal_kadaluarsa date NOT NULL
);


--
-- TOC entry 269 (class 1259 OID 18561)
-- Name: paket_cetak; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.paket_cetak (
    id_paket_cetak integer NOT NULL,
    id_percetakan integer,
    nama_paket_cetak character varying(50) NOT NULL,
    deskripsi_paket_cetak character varying(1024) NOT NULL,
    ringkasan_paket_cetak character varying(255) NOT NULL,
    harga_dasar integer NOT NULL,
    harga_per_halaman integer NOT NULL
);


--
-- TOC entry 268 (class 1259 OID 18560)
-- Name: paket_cetak_id_paket_cetak_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.paket_cetak_id_paket_cetak_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3647 (class 0 OID 0)
-- Dependencies: 268
-- Name: paket_cetak_id_paket_cetak_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.paket_cetak_id_paket_cetak_seq OWNED BY albumtravel.paket_cetak.id_paket_cetak;


--
-- TOC entry 271 (class 1259 OID 18568)
-- Name: paket_travel; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.paket_travel (
    id_paket_travel integer NOT NULL,
    id_travel integer,
    nama_paket_travel character varying(50) NOT NULL,
    tanggal_keberangkatan date NOT NULL,
    lama_keberangkatan integer NOT NULL,
    deskripsi_paket_travel character varying(1024) NOT NULL,
    ringkasan_paket_travel character varying(255) NOT NULL,
    harga_paket_travel integer
);


--
-- TOC entry 270 (class 1259 OID 18567)
-- Name: paket_travel_id_paket_travel_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.paket_travel_id_paket_travel_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3648 (class 0 OID 0)
-- Dependencies: 270
-- Name: paket_travel_id_paket_travel_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.paket_travel_id_paket_travel_seq OWNED BY albumtravel.paket_travel.id_paket_travel;


--
-- TOC entry 273 (class 1259 OID 18575)
-- Name: pembayaran; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.pembayaran (
    id_pembayaran integer NOT NULL,
    id_customer integer NOT NULL,
    id_pesanan integer NOT NULL,
    tanggal_bayar date NOT NULL,
    jumlah_bayar integer NOT NULL
);


--
-- TOC entry 272 (class 1259 OID 18574)
-- Name: pembayaran_id_pembayaran_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.pembayaran_id_pembayaran_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3649 (class 0 OID 0)
-- Dependencies: 272
-- Name: pembayaran_id_pembayaran_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.pembayaran_id_pembayaran_seq OWNED BY albumtravel.pembayaran.id_pembayaran;


--
-- TOC entry 275 (class 1259 OID 18580)
-- Name: percetakan; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.percetakan (
    id_percetakan integer NOT NULL,
    id_pengguna integer NOT NULL,
    nama_percetakan character varying(50) NOT NULL,
    alamat_percetakan character varying(255) NOT NULL,
    telepon_percetakan character varying(20) NOT NULL,
    email_percetakan character varying(255),
    deskripsi_percetakan character varying(1024),
    ringkasan_percetakan character varying(255)
);


--
-- TOC entry 274 (class 1259 OID 18579)
-- Name: percetakan_id_percetakan_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.percetakan_id_percetakan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3650 (class 0 OID 0)
-- Dependencies: 274
-- Name: percetakan_id_percetakan_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.percetakan_id_percetakan_seq OWNED BY albumtravel.percetakan.id_percetakan;


--
-- TOC entry 277 (class 1259 OID 18587)
-- Name: pesanan_album; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.pesanan_album (
    id_pesanan integer NOT NULL,
    id_anggota integer NOT NULL,
    id_album integer NOT NULL,
    jumlah_tagihan integer NOT NULL,
    tanggal_lunas date,
    tanggal_kirim date,
    tanggal_terima date
);


--
-- TOC entry 276 (class 1259 OID 18586)
-- Name: pesanan_album_id_pesanan_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.pesanan_album_id_pesanan_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3651 (class 0 OID 0)
-- Dependencies: 276
-- Name: pesanan_album_id_pesanan_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.pesanan_album_id_pesanan_seq OWNED BY albumtravel.pesanan_album.id_pesanan;


--
-- TOC entry 279 (class 1259 OID 18592)
-- Name: template_halaman; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.template_halaman (
    id_template integer NOT NULL,
    id_grup_template integer,
    nama_template character varying(20) NOT NULL,
    jumlah_foto integer NOT NULL,
    url_template character varying(255) NOT NULL
);


--
-- TOC entry 278 (class 1259 OID 18591)
-- Name: template_halaman_id_template_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.template_halaman_id_template_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3652 (class 0 OID 0)
-- Dependencies: 278
-- Name: template_halaman_id_template_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.template_halaman_id_template_seq OWNED BY albumtravel.template_halaman.id_template;


--
-- TOC entry 281 (class 1259 OID 18597)
-- Name: travel; Type: TABLE; Schema: albumtravel; Owner: -
--

CREATE TABLE albumtravel.travel (
    id_travel integer NOT NULL,
    id_pengguna integer NOT NULL,
    nama_travel character varying(50) NOT NULL,
    alamat_travel character varying(255) NOT NULL,
    telepon_travel character varying(20) NOT NULL,
    email_travel character varying(255),
    deskripsi_travel character varying(1024),
    ringkasan_travel character varying(255)
);


--
-- TOC entry 280 (class 1259 OID 18596)
-- Name: travel_id_travel_seq; Type: SEQUENCE; Schema: albumtravel; Owner: -
--

CREATE SEQUENCE albumtravel.travel_id_travel_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- TOC entry 3653 (class 0 OID 0)
-- Dependencies: 280
-- Name: travel_id_travel_seq; Type: SEQUENCE OWNED BY; Schema: albumtravel; Owner: -
--

ALTER SEQUENCE albumtravel.travel_id_travel_seq OWNED BY albumtravel.travel.id_travel;


--
-- TOC entry 3352 (class 2604 OID 18510)
-- Name: akun id_pengguna; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.akun ALTER COLUMN id_pengguna SET DEFAULT nextval('albumtravel.akun_id_pengguna_seq'::regclass);


--
-- TOC entry 3353 (class 2604 OID 18515)
-- Name: album id_album; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album ALTER COLUMN id_album SET DEFAULT nextval('albumtravel.album_id_album_seq'::regclass);


--
-- TOC entry 3354 (class 2604 OID 18526)
-- Name: anggota_grup id_anggota_grup; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.anggota_grup ALTER COLUMN id_anggota_grup SET DEFAULT nextval('albumtravel.anggota_grup_id_anggota_grup_seq'::regclass);


--
-- TOC entry 3356 (class 2604 OID 18532)
-- Name: customer id_customer; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.customer ALTER COLUMN id_customer SET DEFAULT nextval('albumtravel.customer_id_customer_seq'::regclass);


--
-- TOC entry 3357 (class 2604 OID 18537)
-- Name: foto id_foto; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto ALTER COLUMN id_foto SET DEFAULT nextval('albumtravel.foto_id_foto_seq'::regclass);


--
-- TOC entry 3358 (class 2604 OID 18551)
-- Name: grup_template id_grup_template; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.grup_template ALTER COLUMN id_grup_template SET DEFAULT nextval('albumtravel.grup_template_id_grup_template_seq'::regclass);


--
-- TOC entry 3359 (class 2604 OID 18556)
-- Name: halaman id_halaman; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.halaman ALTER COLUMN id_halaman SET DEFAULT nextval('albumtravel.halaman_id_halaman_seq'::regclass);


--
-- TOC entry 3360 (class 2604 OID 18564)
-- Name: paket_cetak id_paket_cetak; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.paket_cetak ALTER COLUMN id_paket_cetak SET DEFAULT nextval('albumtravel.paket_cetak_id_paket_cetak_seq'::regclass);


--
-- TOC entry 3361 (class 2604 OID 18571)
-- Name: paket_travel id_paket_travel; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.paket_travel ALTER COLUMN id_paket_travel SET DEFAULT nextval('albumtravel.paket_travel_id_paket_travel_seq'::regclass);


--
-- TOC entry 3362 (class 2604 OID 18578)
-- Name: pembayaran id_pembayaran; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.pembayaran ALTER COLUMN id_pembayaran SET DEFAULT nextval('albumtravel.pembayaran_id_pembayaran_seq'::regclass);


--
-- TOC entry 3363 (class 2604 OID 18583)
-- Name: percetakan id_percetakan; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.percetakan ALTER COLUMN id_percetakan SET DEFAULT nextval('albumtravel.percetakan_id_percetakan_seq'::regclass);


--
-- TOC entry 3364 (class 2604 OID 18590)
-- Name: pesanan_album id_pesanan; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.pesanan_album ALTER COLUMN id_pesanan SET DEFAULT nextval('albumtravel.pesanan_album_id_pesanan_seq'::regclass);


--
-- TOC entry 3365 (class 2604 OID 18595)
-- Name: template_halaman id_template; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.template_halaman ALTER COLUMN id_template SET DEFAULT nextval('albumtravel.template_halaman_id_template_seq'::regclass);


--
-- TOC entry 3366 (class 2604 OID 18600)
-- Name: travel id_travel; Type: DEFAULT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.travel ALTER COLUMN id_travel SET DEFAULT nextval('albumtravel.travel_id_travel_seq'::regclass);


--
-- TOC entry 3602 (class 0 OID 18507)
-- Dependencies: 249
-- Data for Name: akun; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.akun VALUES (1, 'admin', 'D406C362304CDDF5856B1FEEF20A374C', 4, '', 2);
INSERT INTO albumtravel.akun VALUES (18, 'linearch', '8992022dd0580e858d9e60ec4c65f587', 1, 'rizqinur2010@gmail.com', 0);
INSERT INTO albumtravel.akun VALUES (20, 'asdfasfdasdf', '8992022dd0580e858d9e60ec4c65f587', 1, 'xstinky12@gmail.com', 0);
INSERT INTO albumtravel.akun VALUES (21, 'asdfasdfa', '8992022dd0580e858d9e60ec4c65f587', 1, 'xstinky12@gmail.com', 2);
INSERT INTO albumtravel.akun VALUES (22, 'Alifiandri', 'ff9d4684c9b49889598648152695f99f', 1, 'rashedadam31@gmail.com', 2);
INSERT INTO albumtravel.akun VALUES (23, 'rizqinur', '89e55761f6b9c46b85497788f6cf8f75', 1, 'rizqinur2010@gmail.com', 0);
INSERT INTO albumtravel.akun VALUES (58, 'user', '8992022dd0580e858d9e60ec4c65f587', 1, 'rizqinur2010@gmail.com', 0);


--
-- TOC entry 3604 (class 0 OID 18512)
-- Dependencies: 251
-- Data for Name: album; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.album VALUES (1, 5, 'Albumbum');
INSERT INTO albumtravel.album VALUES (7, NULL, 'asdfasdf');
INSERT INTO albumtravel.album VALUES (8, NULL, 'asd');
INSERT INTO albumtravel.album VALUES (9, NULL, 'qwer');
INSERT INTO albumtravel.album VALUES (11, NULL, 'cust');
INSERT INTO albumtravel.album VALUES (12, 1, 'asdf');
INSERT INTO albumtravel.album VALUES (13, 3, 'umroh');
INSERT INTO albumtravel.album VALUES (14, NULL, 'Album baru');
INSERT INTO albumtravel.album VALUES (15, NULL, 'asdasd');
INSERT INTO albumtravel.album VALUES (16, 3, 'AAAA');
INSERT INTO albumtravel.album VALUES (17, NULL, 'BBBB');
INSERT INTO albumtravel.album VALUES (18, NULL, 'Ang');
INSERT INTO albumtravel.album VALUES (19, 5, 'album baru');
INSERT INTO albumtravel.album VALUES (20, NULL, 'album anggota');


--
-- TOC entry 3605 (class 0 OID 18516)
-- Dependencies: 252
-- Data for Name: album_anggota; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.album_anggota VALUES (11, 1);
INSERT INTO albumtravel.album_anggota VALUES (15, 1);
INSERT INTO albumtravel.album_anggota VALUES (12, 10);
INSERT INTO albumtravel.album_anggota VALUES (13, 10);
INSERT INTO albumtravel.album_anggota VALUES (18, 18);
INSERT INTO albumtravel.album_anggota VALUES (20, 19);


--
-- TOC entry 3606 (class 0 OID 18519)
-- Dependencies: 253
-- Data for Name: album_grup; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.album_grup VALUES (1, 1);
INSERT INTO albumtravel.album_grup VALUES (7, 1);
INSERT INTO albumtravel.album_grup VALUES (14, 1);
INSERT INTO albumtravel.album_grup VALUES (8, 6);
INSERT INTO albumtravel.album_grup VALUES (9, 6);
INSERT INTO albumtravel.album_grup VALUES (16, 7);
INSERT INTO albumtravel.album_grup VALUES (17, 7);
INSERT INTO albumtravel.album_grup VALUES (19, 9);


--
-- TOC entry 3608 (class 0 OID 18523)
-- Dependencies: 255
-- Data for Name: anggota_grup; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.anggota_grup VALUES (1, 1, 1, 0, '', 1);
INSERT INTO albumtravel.anggota_grup VALUES (10, 1, 5, NULL, NULL, 1);
INSERT INTO albumtravel.anggota_grup VALUES (13, 1, 4, NULL, NULL, 1);
INSERT INTO albumtravel.anggota_grup VALUES (14, 1, 3, NULL, NULL, 0);
INSERT INTO albumtravel.anggota_grup VALUES (15, 22, 6, NULL, NULL, 0);
INSERT INTO albumtravel.anggota_grup VALUES (16, 22, 5, NULL, NULL, 0);
INSERT INTO albumtravel.anggota_grup VALUES (17, 1, 2, NULL, NULL, 0);
INSERT INTO albumtravel.anggota_grup VALUES (18, 1, 7, NULL, NULL, 1);
INSERT INTO albumtravel.anggota_grup VALUES (19, 1, 9, NULL, NULL, 1);


--
-- TOC entry 3610 (class 0 OID 18529)
-- Dependencies: 257
-- Data for Name: customer; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.customer VALUES (1, 1, 'Admoon', 'asdfasdfasdf', '23452345');
INSERT INTO albumtravel.customer VALUES (18, 18, 'Rizqi Nur', 'asdfasdfasfd', '0000888888');
INSERT INTO albumtravel.customer VALUES (20, 20, 'AAAAAAAAAAAAAA', 'aaaaaaaaaaaa', '808080');
INSERT INTO albumtravel.customer VALUES (21, 21, 'asdfasdf', 'asdfasdf', '3123213');
INSERT INTO albumtravel.customer VALUES (22, 22, 'Andre', 'and', '0895361406154');
INSERT INTO albumtravel.customer VALUES (27, 58, 'nama saya', 'almt', '080808080');


--
-- TOC entry 3612 (class 0 OID 18534)
-- Dependencies: 259
-- Data for Name: foto; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.foto VALUES (34, 'assets/uploads/foto/1/0/5cfc873772b30.jpg', 'Koala', 0);
INSERT INTO albumtravel.foto VALUES (35, 'assets/uploads/foto/1/0/5cfc87b48e37c.jpg', 'Chrysanthemum', 0);
INSERT INTO albumtravel.foto VALUES (36, 'assets/uploads/foto/1/0/5cfc881707ffb.jpg', 'Koala', 0);
INSERT INTO albumtravel.foto VALUES (37, 'assets/uploads/foto/1/0/5cfc8875ac163.jpg', 'Koala', 0);
INSERT INTO albumtravel.foto VALUES (38, 'assets/uploads/foto/1/0/5cfc88cdac788.jpg', 'Desert', 0);
INSERT INTO albumtravel.foto VALUES (39, 'assets/uploads/foto/1/0/5cfc8961e1a05.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (40, 'assets/uploads/foto/1/0/5cfc89a4d6e7f.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (41, 'assets/uploads/foto/1/0/5cfc89bb58b9b.jpg', 'Tulips', 0);
INSERT INTO albumtravel.foto VALUES (42, 'assets/uploads/foto/1/0/5cfc89d9bc29c.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (43, 'assets/uploads/foto/1/0/5cfc8a640ed9f.jpg', 'Chrysanthemum', 0);
INSERT INTO albumtravel.foto VALUES (44, 'assets/uploads/foto/1/0/5cfc8a886c82a.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (45, 'assets/uploads/foto/1/0/5cfc8ab16f97f.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (46, 'assets/uploads/foto/1/0/5cfc8ac09e782.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (47, 'assets/uploads/foto/1/0/5cfc8ac0b882d.jpg', 'Koala', 0);
INSERT INTO albumtravel.foto VALUES (48, 'assets/uploads/foto/1/0/5cfc8ac8508e0.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (49, 'assets/uploads/foto/1/0/5cfc8b3bdccca.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (50, 'assets/uploads/foto/1/0/5cfc8b3d804b7.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (51, 'assets/uploads/foto/1/0/5cfc8b498c9cf.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (52, 'assets/uploads/foto/1/0/5cfc8b4c85171.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (53, 'assets/uploads/foto/1/0/5cfc8b62185ba.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (54, 'assets/uploads/foto/1/0/5cfc8b6241886.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (55, 'assets/uploads/foto/1/0/5cfc8bbd0260a.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (56, 'assets/uploads/foto/1/0/5cfc8bc12fed3.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (57, 'assets/uploads/foto/1/0/5cfc8bec37f4c.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (58, 'assets/uploads/foto/1/0/5cfc90efabb79.jpg', 'Koala', 0);
INSERT INTO albumtravel.foto VALUES (59, 'assets/uploads/foto/1/0/5cfc90f236862.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (60, 'assets/uploads/foto/1/0/5cfc90f4dfcab.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (61, 'assets/uploads/foto/1/0/5cfc9b90b621f.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (62, 'assets/uploads/foto/6/0/5cfce136cd01f.jpg', 'Koala', 0);
INSERT INTO albumtravel.foto VALUES (63, 'assets/uploads/foto/6/0/5cfce14697f83.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (70, 'assets/uploads/foto/6/0/5d0491560973d.jpg', 'Lighthouse', 0);
INSERT INTO albumtravel.foto VALUES (71, 'assets/uploads/foto/6/0/5d0b1d102a1b6.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (72, 'assets/uploads/foto/1/0/5d0bbf669bec8.jpg', 'Tulips', 0);
INSERT INTO albumtravel.foto VALUES (73, 'assets/uploads/foto/1/0/5d0bbf75bc1e2.jpg', 'Jellyfish', 0);
INSERT INTO albumtravel.foto VALUES (75, 'assets/uploads/foto/1/1/5d0bc0f7d2d7d.png', '2019-05-12_15h49_08', 0);
INSERT INTO albumtravel.foto VALUES (76, 'assets/uploads/foto/1/1/5d0bc10a2a65c.png', '2019-05-12_16h03_19', 0);
INSERT INTO albumtravel.foto VALUES (77, 'assets/uploads/foto/1/1/5d0c53be1d68e.jpg', 'umroh6', 0);
INSERT INTO albumtravel.foto VALUES (78, 'assets/uploads/foto/1/0/5d0c5886a83be.jpg', 'Desert', 0);
INSERT INTO albumtravel.foto VALUES (79, 'assets/uploads/foto/7/0/5d14bf1639eab.jpg', 'Desert', 0);
INSERT INTO albumtravel.foto VALUES (80, 'assets/uploads/foto/7/0/5d14bf23e34c2.jpg', 'Hydrangeas', 0);
INSERT INTO albumtravel.foto VALUES (81, 'assets/uploads/foto/7/0/5d14bf24134ab.jpg', 'Penguins', 0);
INSERT INTO albumtravel.foto VALUES (82, 'assets/uploads/foto/7/0/5d14bf3406933.jpg', 'Tulips', 0);
INSERT INTO albumtravel.foto VALUES (83, 'assets/uploads/foto/7/18/5d14c07581790.jpg', 'IMG-20170304-WA0005', 0);
INSERT INTO albumtravel.foto VALUES (84, 'assets/uploads/foto/9/0/5d14c4f4bb8a7.jpg', 'IMG-20170304-WA0005', 0);
INSERT INTO albumtravel.foto VALUES (85, 'assets/uploads/foto/9/0/5d14c4f4d953e.jpg', 'Jamaah Umroh Arminareka Perdana Masjid Quba', 0);
INSERT INTO albumtravel.foto VALUES (86, 'assets/uploads/foto/9/0/5d14c4f50049c.jpg', 'Jamaah-IIW', 0);
INSERT INTO albumtravel.foto VALUES (87, 'assets/uploads/foto/9/0/5d14c4f513939.jpg', 'Jamaah-Umroh-Al-Aqsha', 0);
INSERT INTO albumtravel.foto VALUES (88, 'assets/uploads/foto/9/0/5d14c4f53ecab.jpg', 'Nursa-Tour', 0);
INSERT INTO albumtravel.foto VALUES (89, 'assets/uploads/foto/9/0/5d14c4f5563b0.jpg', 'pt-arminareka-perdana-muhasabah-bareng-4500-jamaah', 0);
INSERT INTO albumtravel.foto VALUES (90, 'assets/uploads/foto/9/19/5d14c5594aafd.jpg', 'Jellyfish', 0);


--
-- TOC entry 3613 (class 0 OID 18538)
-- Dependencies: 260
-- Data for Name: foto_anggota; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.foto_anggota VALUES (75, 1);
INSERT INTO albumtravel.foto_anggota VALUES (76, 1);
INSERT INTO albumtravel.foto_anggota VALUES (77, 1);
INSERT INTO albumtravel.foto_anggota VALUES (83, 18);
INSERT INTO albumtravel.foto_anggota VALUES (90, 19);


--
-- TOC entry 3614 (class 0 OID 18541)
-- Dependencies: 261
-- Data for Name: foto_grup; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.foto_grup VALUES (34, 1);
INSERT INTO albumtravel.foto_grup VALUES (35, 1);
INSERT INTO albumtravel.foto_grup VALUES (36, 1);
INSERT INTO albumtravel.foto_grup VALUES (37, 1);
INSERT INTO albumtravel.foto_grup VALUES (38, 1);
INSERT INTO albumtravel.foto_grup VALUES (39, 1);
INSERT INTO albumtravel.foto_grup VALUES (40, 1);
INSERT INTO albumtravel.foto_grup VALUES (41, 1);
INSERT INTO albumtravel.foto_grup VALUES (42, 1);
INSERT INTO albumtravel.foto_grup VALUES (43, 1);
INSERT INTO albumtravel.foto_grup VALUES (44, 1);
INSERT INTO albumtravel.foto_grup VALUES (45, 1);
INSERT INTO albumtravel.foto_grup VALUES (46, 1);
INSERT INTO albumtravel.foto_grup VALUES (47, 1);
INSERT INTO albumtravel.foto_grup VALUES (48, 1);
INSERT INTO albumtravel.foto_grup VALUES (49, 1);
INSERT INTO albumtravel.foto_grup VALUES (50, 1);
INSERT INTO albumtravel.foto_grup VALUES (51, 1);
INSERT INTO albumtravel.foto_grup VALUES (52, 1);
INSERT INTO albumtravel.foto_grup VALUES (53, 1);
INSERT INTO albumtravel.foto_grup VALUES (54, 1);
INSERT INTO albumtravel.foto_grup VALUES (55, 1);
INSERT INTO albumtravel.foto_grup VALUES (56, 1);
INSERT INTO albumtravel.foto_grup VALUES (57, 1);
INSERT INTO albumtravel.foto_grup VALUES (58, 1);
INSERT INTO albumtravel.foto_grup VALUES (59, 1);
INSERT INTO albumtravel.foto_grup VALUES (60, 1);
INSERT INTO albumtravel.foto_grup VALUES (61, 1);
INSERT INTO albumtravel.foto_grup VALUES (72, 1);
INSERT INTO albumtravel.foto_grup VALUES (73, 1);
INSERT INTO albumtravel.foto_grup VALUES (78, 1);
INSERT INTO albumtravel.foto_grup VALUES (62, 6);
INSERT INTO albumtravel.foto_grup VALUES (63, 6);
INSERT INTO albumtravel.foto_grup VALUES (70, 6);
INSERT INTO albumtravel.foto_grup VALUES (71, 6);
INSERT INTO albumtravel.foto_grup VALUES (79, 7);
INSERT INTO albumtravel.foto_grup VALUES (80, 7);
INSERT INTO albumtravel.foto_grup VALUES (81, 7);
INSERT INTO albumtravel.foto_grup VALUES (82, 7);
INSERT INTO albumtravel.foto_grup VALUES (84, 9);
INSERT INTO albumtravel.foto_grup VALUES (85, 9);
INSERT INTO albumtravel.foto_grup VALUES (86, 9);
INSERT INTO albumtravel.foto_grup VALUES (87, 9);
INSERT INTO albumtravel.foto_grup VALUES (88, 9);
INSERT INTO albumtravel.foto_grup VALUES (89, 9);


--
-- TOC entry 3615 (class 0 OID 18544)
-- Dependencies: 262
-- Data for Name: foto_halaman; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.foto_halaman VALUES (59, 1, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (78, 1, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (61, 1, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (60, 1, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (60, 6, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (58, 6, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (61, 6, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (54, 6, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (72, 7, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (71, 8, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (70, 8, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (71, 8, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (63, 8, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (75, 11, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (58, 11, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (73, 11, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (59, 11, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (78, 13, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (61, 13, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (73, 13, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (60, 13, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (80, 14, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (82, 14, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (81, 14, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (79, 14, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (80, 15, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (82, 15, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (81, 15, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (79, 15, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (81, 16, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (83, 16, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (82, 16, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (79, 16, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (88, 17, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (87, 17, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (85, 17, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (86, 17, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (89, 18, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (87, 18, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (86, 18, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (88, 18, 4, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (90, 19, 1, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (88, 19, 2, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (89, 19, 3, NULL);
INSERT INTO albumtravel.foto_halaman VALUES (85, 19, 4, NULL);


--
-- TOC entry 3617 (class 0 OID 18548)
-- Dependencies: 264
-- Data for Name: grup_template; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.grup_template VALUES (1, 'Dania', 'assets/templates/1/');


--
-- TOC entry 3619 (class 0 OID 18553)
-- Dependencies: 266
-- Data for Name: halaman; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.halaman VALUES (1, 1, 1, 1);
INSERT INTO albumtravel.halaman VALUES (2, 1, 1, 2);
INSERT INTO albumtravel.halaman VALUES (3, 1, 1, 3);
INSERT INTO albumtravel.halaman VALUES (4, 1, 1, 4);
INSERT INTO albumtravel.halaman VALUES (5, 1, 1, 5);
INSERT INTO albumtravel.halaman VALUES (6, 7, 1, 1);
INSERT INTO albumtravel.halaman VALUES (7, 1, 1, 6);
INSERT INTO albumtravel.halaman VALUES (8, 9, 1, 1);
INSERT INTO albumtravel.halaman VALUES (9, 11, 1, 1);
INSERT INTO albumtravel.halaman VALUES (10, 11, 1, 2);
INSERT INTO albumtravel.halaman VALUES (11, 11, 1, 3);
INSERT INTO albumtravel.halaman VALUES (12, 13, 1, 1);
INSERT INTO albumtravel.halaman VALUES (13, 14, 1, 1);
INSERT INTO albumtravel.halaman VALUES (14, 16, 1, 1);
INSERT INTO albumtravel.halaman VALUES (15, 16, 1, 2);
INSERT INTO albumtravel.halaman VALUES (16, 18, 1, 1);
INSERT INTO albumtravel.halaman VALUES (17, 19, 1, 1);
INSERT INTO albumtravel.halaman VALUES (18, 19, 1, 2);
INSERT INTO albumtravel.halaman VALUES (19, 20, 1, 1);


--
-- TOC entry 3620 (class 0 OID 18557)
-- Dependencies: 267
-- Data for Name: konfirmasi_akun; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.konfirmasi_akun VALUES (18, 'b8e8453cfbcc7e5ffcb9f97e63bd00cd', '2019-06-14');
INSERT INTO albumtravel.konfirmasi_akun VALUES (20, 'ae9eebc40b985ad7bc0a9244f58a1ea9', '2019-06-14');
INSERT INTO albumtravel.konfirmasi_akun VALUES (23, 'aedf6c993a417b684c9984c4e9b6b3da', '2019-06-24');
INSERT INTO albumtravel.konfirmasi_akun VALUES (58, 'b829d963c5f70cbfd7993fd69f794e35', '2019-06-30');


--
-- TOC entry 3622 (class 0 OID 18561)
-- Dependencies: 269
-- Data for Name: paket_cetak; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.paket_cetak VALUES (1, 1, 'ASDASDASD', 'qwerwqerqwerwqer', 'aasdfasdfasd', 50000, 5000);
INSERT INTO albumtravel.paket_cetak VALUES (2, 1, 'Paket cetak admin', 'asdfasdfasdf', 'qwerqwer', 50000, 5000);
INSERT INTO albumtravel.paket_cetak VALUES (3, 1, 'Paket cetak admin2', 'asdfasdfasdf', 'qwerqwer', 50000, 5000);
INSERT INTO albumtravel.paket_cetak VALUES (4, 1, 'Paket cetak baru', 'desc cetak', 'ringkasan cetak', 5000, 1000);
INSERT INTO albumtravel.paket_cetak VALUES (5, 1, 'Paket cetak baru banget', 'deskripsi paket cetak', 'ringkasan paket cetak', 5000, 1000);


--
-- TOC entry 3624 (class 0 OID 18568)
-- Dependencies: 271
-- Data for Name: paket_travel; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.paket_travel VALUES (1, 1, 'Paket admin', '2019-06-11', 2, 'asdfasdf', 'asfdasdf', 5000000);
INSERT INTO albumtravel.paket_travel VALUES (2, 1, 'Pakett2', '2019-06-13', 2, 'asdfasdf
asdfasfd', 'asdddddddddddddd', 132123);
INSERT INTO albumtravel.paket_travel VALUES (3, 1, 'Pakett3', '2019-06-13', 2, 'asdfasdf
asdfasfd', 'asdddddddddddddd', 132123);
INSERT INTO albumtravel.paket_travel VALUES (4, 1, 'Pakett4', '2019-06-13', 2, 'asdfasdf
asdfasfd', 'asdddddddddddddd', 132123);
INSERT INTO albumtravel.paket_travel VALUES (5, 1, 'Pakett5', '2019-06-13', 2, 'asdfasdf
asdfasfd', 'asdddddddddddddd', 132123);
INSERT INTO albumtravel.paket_travel VALUES (6, 1, 'Pakett6', '2019-06-13', 2, 'asdfasdf
asdfasfd', 'asdddddddddddddd', 132123);
INSERT INTO albumtravel.paket_travel VALUES (7, 1, 'qqqqqqqqq', '2019-06-13', 12, 'desc', 'r', 50000);
INSERT INTO albumtravel.paket_travel VALUES (8, 1, 'Paket cetak baru', '2019-06-13', 9, 'desc paket travel', 'ringkasan paket travel', 50000);
INSERT INTO albumtravel.paket_travel VALUES (9, 1, 'Paket travel baru banget', '2019-06-28', 9, 'deskripsi paket travel', 'ringkasan paket travel', 50000);


--
-- TOC entry 3626 (class 0 OID 18575)
-- Dependencies: 273
-- Data for Name: pembayaran; Type: TABLE DATA; Schema: albumtravel; Owner: -
--



--
-- TOC entry 3628 (class 0 OID 18580)
-- Dependencies: 275
-- Data for Name: percetakan; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.percetakan VALUES (1, 1, 'Percetakan admin', 'asdfasdf', '555', 'xdxd', 'asdfasdfasdfasdf', 'qwerqwer');


--
-- TOC entry 3630 (class 0 OID 18587)
-- Dependencies: 277
-- Data for Name: pesanan_album; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.pesanan_album VALUES (1, 10, 13, 0, NULL, NULL, NULL);
INSERT INTO albumtravel.pesanan_album VALUES (2, 10, 12, 0, NULL, NULL, NULL);
INSERT INTO albumtravel.pesanan_album VALUES (3, 1, 1, 0, NULL, NULL, NULL);
INSERT INTO albumtravel.pesanan_album VALUES (4, 18, 16, 0, NULL, NULL, NULL);
INSERT INTO albumtravel.pesanan_album VALUES (5, 19, 19, 0, NULL, NULL, NULL);


--
-- TOC entry 3632 (class 0 OID 18592)
-- Dependencies: 279
-- Data for Name: template_halaman; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.template_halaman VALUES (1, 1, 'Dania 1', 4, 'assets/templates/1/dania-1');


--
-- TOC entry 3634 (class 0 OID 18597)
-- Dependencies: 281
-- Data for Name: travel; Type: TABLE DATA; Schema: albumtravel; Owner: -
--

INSERT INTO albumtravel.travel VALUES (1, 1, 'Admin travel', 'asdfasdf', '12341234', 'zxcvzxcv', 'asdfasfasdfas', 'dfasasfdasdf');


--
-- TOC entry 3654 (class 0 OID 0)
-- Dependencies: 248
-- Name: akun_id_pengguna_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.akun_id_pengguna_seq', 58, true);


--
-- TOC entry 3655 (class 0 OID 0)
-- Dependencies: 250
-- Name: album_id_album_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.album_id_album_seq', 20, true);


--
-- TOC entry 3656 (class 0 OID 0)
-- Dependencies: 254
-- Name: anggota_grup_id_anggota_grup_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.anggota_grup_id_anggota_grup_seq', 19, true);


--
-- TOC entry 3657 (class 0 OID 0)
-- Dependencies: 256
-- Name: customer_id_customer_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.customer_id_customer_seq', 27, true);


--
-- TOC entry 3658 (class 0 OID 0)
-- Dependencies: 258
-- Name: foto_id_foto_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.foto_id_foto_seq', 90, true);


--
-- TOC entry 3659 (class 0 OID 0)
-- Dependencies: 263
-- Name: grup_template_id_grup_template_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.grup_template_id_grup_template_seq', 1, true);


--
-- TOC entry 3660 (class 0 OID 0)
-- Dependencies: 265
-- Name: halaman_id_halaman_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.halaman_id_halaman_seq', 19, true);


--
-- TOC entry 3661 (class 0 OID 0)
-- Dependencies: 268
-- Name: paket_cetak_id_paket_cetak_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.paket_cetak_id_paket_cetak_seq', 5, true);


--
-- TOC entry 3662 (class 0 OID 0)
-- Dependencies: 270
-- Name: paket_travel_id_paket_travel_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.paket_travel_id_paket_travel_seq', 9, true);


--
-- TOC entry 3663 (class 0 OID 0)
-- Dependencies: 272
-- Name: pembayaran_id_pembayaran_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.pembayaran_id_pembayaran_seq', 1, true);


--
-- TOC entry 3664 (class 0 OID 0)
-- Dependencies: 274
-- Name: percetakan_id_percetakan_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.percetakan_id_percetakan_seq', 1, true);


--
-- TOC entry 3665 (class 0 OID 0)
-- Dependencies: 276
-- Name: pesanan_album_id_pesanan_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.pesanan_album_id_pesanan_seq', 5, true);


--
-- TOC entry 3666 (class 0 OID 0)
-- Dependencies: 278
-- Name: template_halaman_id_template_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.template_halaman_id_template_seq', 1, true);


--
-- TOC entry 3667 (class 0 OID 0)
-- Dependencies: 280
-- Name: travel_id_travel_seq; Type: SEQUENCE SET; Schema: albumtravel; Owner: -
--

SELECT pg_catalog.setval('albumtravel.travel_id_travel_seq', 1, true);


--
-- TOC entry 3370 (class 2606 OID 18661)
-- Name: akun idx_18507_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.akun
    ADD CONSTRAINT idx_18507_primary PRIMARY KEY (id_pengguna);


--
-- TOC entry 3373 (class 2606 OID 18658)
-- Name: album idx_18512_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album
    ADD CONSTRAINT idx_18512_primary PRIMARY KEY (id_album);


--
-- TOC entry 3376 (class 2606 OID 18662)
-- Name: album_anggota idx_18516_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album_anggota
    ADD CONSTRAINT idx_18516_primary PRIMARY KEY (id_album);


--
-- TOC entry 3379 (class 2606 OID 18659)
-- Name: album_grup idx_18519_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album_grup
    ADD CONSTRAINT idx_18519_primary PRIMARY KEY (id_album);


--
-- TOC entry 3383 (class 2606 OID 18660)
-- Name: anggota_grup idx_18523_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.anggota_grup
    ADD CONSTRAINT idx_18523_primary PRIMARY KEY (id_anggota_grup);


--
-- TOC entry 3387 (class 2606 OID 18663)
-- Name: customer idx_18529_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.customer
    ADD CONSTRAINT idx_18529_primary PRIMARY KEY (id_customer);


--
-- TOC entry 3389 (class 2606 OID 18654)
-- Name: foto idx_18534_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto
    ADD CONSTRAINT idx_18534_primary PRIMARY KEY (id_foto);


--
-- TOC entry 3392 (class 2606 OID 18664)
-- Name: foto_anggota idx_18538_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_anggota
    ADD CONSTRAINT idx_18538_primary PRIMARY KEY (id_foto);


--
-- TOC entry 3395 (class 2606 OID 18655)
-- Name: foto_grup idx_18541_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_grup
    ADD CONSTRAINT idx_18541_primary PRIMARY KEY (id_foto);


--
-- TOC entry 3399 (class 2606 OID 18657)
-- Name: foto_halaman idx_18544_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_halaman
    ADD CONSTRAINT idx_18544_primary PRIMARY KEY (id_halaman, urutan_foto_halaman);


--
-- TOC entry 3401 (class 2606 OID 18668)
-- Name: grup_template idx_18548_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.grup_template
    ADD CONSTRAINT idx_18548_primary PRIMARY KEY (id_grup_template);


--
-- TOC entry 3405 (class 2606 OID 18656)
-- Name: halaman idx_18553_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.halaman
    ADD CONSTRAINT idx_18553_primary PRIMARY KEY (id_halaman);


--
-- TOC entry 3407 (class 2606 OID 18671)
-- Name: konfirmasi_akun idx_18557_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.konfirmasi_akun
    ADD CONSTRAINT idx_18557_primary PRIMARY KEY (id_pengguna, kode_konfirmasi);


--
-- TOC entry 3410 (class 2606 OID 18665)
-- Name: paket_cetak idx_18561_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.paket_cetak
    ADD CONSTRAINT idx_18561_primary PRIMARY KEY (id_paket_cetak);


--
-- TOC entry 3413 (class 2606 OID 18666)
-- Name: paket_travel idx_18568_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.paket_travel
    ADD CONSTRAINT idx_18568_primary PRIMARY KEY (id_paket_travel);


--
-- TOC entry 3417 (class 2606 OID 18669)
-- Name: pembayaran idx_18575_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.pembayaran
    ADD CONSTRAINT idx_18575_primary PRIMARY KEY (id_pembayaran);


--
-- TOC entry 3421 (class 2606 OID 18670)
-- Name: percetakan idx_18580_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.percetakan
    ADD CONSTRAINT idx_18580_primary PRIMARY KEY (id_percetakan);


--
-- TOC entry 3425 (class 2606 OID 18667)
-- Name: pesanan_album idx_18587_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.pesanan_album
    ADD CONSTRAINT idx_18587_primary PRIMARY KEY (id_pesanan);


--
-- TOC entry 3428 (class 2606 OID 18673)
-- Name: template_halaman idx_18592_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.template_halaman
    ADD CONSTRAINT idx_18592_primary PRIMARY KEY (id_template);


--
-- TOC entry 3432 (class 2606 OID 18672)
-- Name: travel idx_18597_primary; Type: CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.travel
    ADD CONSTRAINT idx_18597_primary PRIMARY KEY (id_travel);


--
-- TOC entry 3367 (class 1259 OID 18625)
-- Name: idx_18507_ak_identifier_2; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE UNIQUE INDEX idx_18507_ak_identifier_2 ON albumtravel.akun USING btree (username);


--
-- TOC entry 3368 (class 1259 OID 18621)
-- Name: idx_18507_ak_identifier_3; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18507_ak_identifier_3 ON albumtravel.akun USING btree (email_pengguna);


--
-- TOC entry 3371 (class 1259 OID 18610)
-- Name: idx_18512_fk_album_relations_paket_ce; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18512_fk_album_relations_paket_ce ON albumtravel.album USING btree (id_paket_cetak);


--
-- TOC entry 3374 (class 1259 OID 18622)
-- Name: idx_18516_fk_album_an_relations_anggota_; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18516_fk_album_an_relations_anggota_ ON albumtravel.album_anggota USING btree (id_anggota);


--
-- TOC entry 3377 (class 1259 OID 18615)
-- Name: idx_18519_fk_album_gr_relations_paket_tr; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18519_fk_album_gr_relations_paket_tr ON albumtravel.album_grup USING btree (id_paket_travel);


--
-- TOC entry 3380 (class 1259 OID 18616)
-- Name: idx_18523_fk_anggota__relations_customer; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18523_fk_anggota__relations_customer ON albumtravel.anggota_grup USING btree (id_customer);


--
-- TOC entry 3381 (class 1259 OID 18617)
-- Name: idx_18523_fk_anggota__relations_paket_tr; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18523_fk_anggota__relations_paket_tr ON albumtravel.anggota_grup USING btree (id_paket_travel);


--
-- TOC entry 3384 (class 1259 OID 18619)
-- Name: idx_18523_un; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE UNIQUE INDEX idx_18523_un ON albumtravel.anggota_grup USING btree (id_customer, id_paket_travel);


--
-- TOC entry 3385 (class 1259 OID 18624)
-- Name: idx_18529_fk_customer_relations_akun; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18529_fk_customer_relations_akun ON albumtravel.customer USING btree (id_pengguna);


--
-- TOC entry 3390 (class 1259 OID 18627)
-- Name: idx_18538_fk_foto_ang_relations_anggota_; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18538_fk_foto_ang_relations_anggota_ ON albumtravel.foto_anggota USING btree (id_anggota);


--
-- TOC entry 3393 (class 1259 OID 18606)
-- Name: idx_18541_fk_foto_gru_relations_paket_tr; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18541_fk_foto_gru_relations_paket_tr ON albumtravel.foto_grup USING btree (id_paket_travel);


--
-- TOC entry 3396 (class 1259 OID 18611)
-- Name: idx_18544_ak_identifier_2; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18544_ak_identifier_2 ON albumtravel.foto_halaman USING btree (id_halaman, id_foto);


--
-- TOC entry 3397 (class 1259 OID 18609)
-- Name: idx_18544_fk_foto_hal_relations_foto; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18544_fk_foto_hal_relations_foto ON albumtravel.foto_halaman USING btree (id_foto);


--
-- TOC entry 3402 (class 1259 OID 18605)
-- Name: idx_18553_ak_identifier_2; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18553_ak_identifier_2 ON albumtravel.halaman USING btree (id_album, nomor_halaman);


--
-- TOC entry 3403 (class 1259 OID 18608)
-- Name: idx_18553_fk_halaman_relations_template; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18553_fk_halaman_relations_template ON albumtravel.halaman USING btree (id_template);


--
-- TOC entry 3408 (class 1259 OID 18628)
-- Name: idx_18561_fk_paket_ce_relations_percetak; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18561_fk_paket_ce_relations_percetak ON albumtravel.paket_cetak USING btree (id_percetakan);


--
-- TOC entry 3411 (class 1259 OID 18630)
-- Name: idx_18568_fk_paket_tr_relations_travel; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18568_fk_paket_tr_relations_travel ON albumtravel.paket_travel USING btree (id_travel);


--
-- TOC entry 3414 (class 1259 OID 18638)
-- Name: idx_18575_fk_pembayar_relations_customer; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18575_fk_pembayar_relations_customer ON albumtravel.pembayaran USING btree (id_customer);


--
-- TOC entry 3415 (class 1259 OID 18637)
-- Name: idx_18575_fk_pembayar_relations_pesanan_; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18575_fk_pembayar_relations_pesanan_ ON albumtravel.pembayaran USING btree (id_pesanan);


--
-- TOC entry 3418 (class 1259 OID 18639)
-- Name: idx_18580_ak_identifier_2; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE UNIQUE INDEX idx_18580_ak_identifier_2 ON albumtravel.percetakan USING btree (nama_percetakan);


--
-- TOC entry 3419 (class 1259 OID 18642)
-- Name: idx_18580_fk_percetak_relations_akun; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18580_fk_percetak_relations_akun ON albumtravel.percetakan USING btree (id_pengguna);


--
-- TOC entry 3422 (class 1259 OID 18632)
-- Name: idx_18587_fk_pesanan__relations_album; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18587_fk_pesanan__relations_album ON albumtravel.pesanan_album USING btree (id_album);


--
-- TOC entry 3423 (class 1259 OID 18633)
-- Name: idx_18587_fk_pesanan__relations_anggota_; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18587_fk_pesanan__relations_anggota_ ON albumtravel.pesanan_album USING btree (id_anggota);


--
-- TOC entry 3426 (class 1259 OID 18647)
-- Name: idx_18592_fk_template_relations_grup_tem; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18592_fk_template_relations_grup_tem ON albumtravel.template_halaman USING btree (id_grup_template);


--
-- TOC entry 3429 (class 1259 OID 18644)
-- Name: idx_18597_ak_identifier_2; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE UNIQUE INDEX idx_18597_ak_identifier_2 ON albumtravel.travel USING btree (nama_travel);


--
-- TOC entry 3430 (class 1259 OID 18646)
-- Name: idx_18597_fk_travel_relations_akun; Type: INDEX; Schema: albumtravel; Owner: -
--

CREATE INDEX idx_18597_fk_travel_relations_akun ON albumtravel.travel USING btree (id_pengguna);


--
-- TOC entry 3434 (class 2606 OID 18679)
-- Name: album_anggota fk_album_an_inheritan_album; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album_anggota
    ADD CONSTRAINT fk_album_an_inheritan_album FOREIGN KEY (id_album) REFERENCES albumtravel.album(id_album) ON UPDATE CASCADE;


--
-- TOC entry 3435 (class 2606 OID 18684)
-- Name: album_anggota fk_album_an_relations_anggota_; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album_anggota
    ADD CONSTRAINT fk_album_an_relations_anggota_ FOREIGN KEY (id_anggota) REFERENCES albumtravel.anggota_grup(id_anggota_grup);


--
-- TOC entry 3436 (class 2606 OID 18689)
-- Name: album_grup fk_album_gr_inheritan_album; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album_grup
    ADD CONSTRAINT fk_album_gr_inheritan_album FOREIGN KEY (id_album) REFERENCES albumtravel.album(id_album) ON UPDATE CASCADE;


--
-- TOC entry 3437 (class 2606 OID 18694)
-- Name: album_grup fk_album_gr_relations_paket_tr; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album_grup
    ADD CONSTRAINT fk_album_gr_relations_paket_tr FOREIGN KEY (id_paket_travel) REFERENCES albumtravel.paket_travel(id_paket_travel);


--
-- TOC entry 3433 (class 2606 OID 18674)
-- Name: album fk_album_relations_paket_ce; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.album
    ADD CONSTRAINT fk_album_relations_paket_ce FOREIGN KEY (id_paket_cetak) REFERENCES albumtravel.paket_cetak(id_paket_cetak);


--
-- TOC entry 3438 (class 2606 OID 18699)
-- Name: anggota_grup fk_anggota__relations_customer; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.anggota_grup
    ADD CONSTRAINT fk_anggota__relations_customer FOREIGN KEY (id_customer) REFERENCES albumtravel.customer(id_customer);


--
-- TOC entry 3439 (class 2606 OID 18704)
-- Name: anggota_grup fk_anggota__relations_paket_tr; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.anggota_grup
    ADD CONSTRAINT fk_anggota__relations_paket_tr FOREIGN KEY (id_paket_travel) REFERENCES albumtravel.paket_travel(id_paket_travel);


--
-- TOC entry 3440 (class 2606 OID 18709)
-- Name: customer fk_customer_relations_akun; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.customer
    ADD CONSTRAINT fk_customer_relations_akun FOREIGN KEY (id_pengguna) REFERENCES albumtravel.akun(id_pengguna);


--
-- TOC entry 3441 (class 2606 OID 18714)
-- Name: foto_anggota fk_foto_ang_inheritan_foto; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_anggota
    ADD CONSTRAINT fk_foto_ang_inheritan_foto FOREIGN KEY (id_foto) REFERENCES albumtravel.foto(id_foto) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3442 (class 2606 OID 18719)
-- Name: foto_anggota fk_foto_ang_relations_anggota_; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_anggota
    ADD CONSTRAINT fk_foto_ang_relations_anggota_ FOREIGN KEY (id_anggota) REFERENCES albumtravel.anggota_grup(id_anggota_grup) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3443 (class 2606 OID 18724)
-- Name: foto_grup fk_foto_gru_inheritan_foto; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_grup
    ADD CONSTRAINT fk_foto_gru_inheritan_foto FOREIGN KEY (id_foto) REFERENCES albumtravel.foto(id_foto) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3444 (class 2606 OID 18729)
-- Name: foto_grup fk_foto_gru_relations_paket_tr; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_grup
    ADD CONSTRAINT fk_foto_gru_relations_paket_tr FOREIGN KEY (id_paket_travel) REFERENCES albumtravel.paket_travel(id_paket_travel) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3445 (class 2606 OID 18734)
-- Name: foto_halaman fk_foto_hal_relations_foto; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_halaman
    ADD CONSTRAINT fk_foto_hal_relations_foto FOREIGN KEY (id_foto) REFERENCES albumtravel.foto(id_foto) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3446 (class 2606 OID 18739)
-- Name: foto_halaman fk_foto_hal_relations_halaman; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.foto_halaman
    ADD CONSTRAINT fk_foto_hal_relations_halaman FOREIGN KEY (id_halaman) REFERENCES albumtravel.halaman(id_halaman) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3447 (class 2606 OID 18744)
-- Name: halaman fk_halaman_relations_album; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.halaman
    ADD CONSTRAINT fk_halaman_relations_album FOREIGN KEY (id_album) REFERENCES albumtravel.album(id_album) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- TOC entry 3448 (class 2606 OID 18749)
-- Name: halaman fk_halaman_relations_template; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.halaman
    ADD CONSTRAINT fk_halaman_relations_template FOREIGN KEY (id_template) REFERENCES albumtravel.template_halaman(id_template);


--
-- TOC entry 3449 (class 2606 OID 18754)
-- Name: konfirmasi_akun fk_konfirma_relations_akun; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.konfirmasi_akun
    ADD CONSTRAINT fk_konfirma_relations_akun FOREIGN KEY (id_pengguna) REFERENCES albumtravel.akun(id_pengguna);


--
-- TOC entry 3450 (class 2606 OID 18759)
-- Name: paket_cetak fk_paket_ce_relations_percetak; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.paket_cetak
    ADD CONSTRAINT fk_paket_ce_relations_percetak FOREIGN KEY (id_percetakan) REFERENCES albumtravel.percetakan(id_percetakan);


--
-- TOC entry 3451 (class 2606 OID 18764)
-- Name: paket_travel fk_paket_tr_relations_travel; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.paket_travel
    ADD CONSTRAINT fk_paket_tr_relations_travel FOREIGN KEY (id_travel) REFERENCES albumtravel.travel(id_travel);


--
-- TOC entry 3452 (class 2606 OID 18769)
-- Name: pembayaran fk_pembayar_relations_customer; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.pembayaran
    ADD CONSTRAINT fk_pembayar_relations_customer FOREIGN KEY (id_customer) REFERENCES albumtravel.customer(id_customer);


--
-- TOC entry 3453 (class 2606 OID 18774)
-- Name: pembayaran fk_pembayar_relations_pesanan_; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.pembayaran
    ADD CONSTRAINT fk_pembayar_relations_pesanan_ FOREIGN KEY (id_pesanan) REFERENCES albumtravel.pesanan_album(id_pesanan);


--
-- TOC entry 3454 (class 2606 OID 18779)
-- Name: percetakan fk_percetak_relations_akun; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.percetakan
    ADD CONSTRAINT fk_percetak_relations_akun FOREIGN KEY (id_pengguna) REFERENCES albumtravel.akun(id_pengguna);


--
-- TOC entry 3455 (class 2606 OID 18784)
-- Name: pesanan_album fk_pesanan__relations_album; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.pesanan_album
    ADD CONSTRAINT fk_pesanan__relations_album FOREIGN KEY (id_album) REFERENCES albumtravel.album(id_album);


--
-- TOC entry 3456 (class 2606 OID 18789)
-- Name: pesanan_album fk_pesanan__relations_anggota_; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.pesanan_album
    ADD CONSTRAINT fk_pesanan__relations_anggota_ FOREIGN KEY (id_anggota) REFERENCES albumtravel.anggota_grup(id_anggota_grup);


--
-- TOC entry 3457 (class 2606 OID 18794)
-- Name: template_halaman fk_template_relations_grup_tem; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.template_halaman
    ADD CONSTRAINT fk_template_relations_grup_tem FOREIGN KEY (id_grup_template) REFERENCES albumtravel.grup_template(id_grup_template);


--
-- TOC entry 3458 (class 2606 OID 18799)
-- Name: travel fk_travel_relations_akun; Type: FK CONSTRAINT; Schema: albumtravel; Owner: -
--

ALTER TABLE ONLY albumtravel.travel
    ADD CONSTRAINT fk_travel_relations_akun FOREIGN KEY (id_pengguna) REFERENCES albumtravel.akun(id_pengguna);


-- Completed on 2024-11-16 18:28:29

--
-- PostgreSQL database dump complete
--


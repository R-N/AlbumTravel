/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     5/29/2019 8:02:22 PM                         */
/*==============================================================*/


/*==============================================================*/
/* Table: AKUN                                                  */
/*==============================================================*/
create table AKUN
(
   ID_PENGGUNA          int not null auto_increment  comment '',
   USERNAME             varchar(20) not null  comment '',
   PASSWORD             varchar(32) not null  comment '',
   PERAN_PENGGUNA       int not null  comment '',
   EMAIL_PENGGUNA       varchar(255) not null  comment '',
   STATUS_AKUN          int not null  comment '',
   primary key (ID_PENGGUNA),
   key AK_IDENTIFIER_2 (USERNAME),
   key AK_IDENTIFIER_3 (EMAIL_PENGGUNA)
);

/*==============================================================*/
/* Table: ALBUM                                                 */
/*==============================================================*/
create table ALBUM
(
   ID_ALBUM             int not null auto_increment  comment '',
   ID_PAKET_CETAK       int  comment '',
   JUDUL_ALBUM          varchar(20)  comment '',
   primary key (ID_ALBUM)
);

/*==============================================================*/
/* Table: ALBUM_ANGGOTA                                         */
/*==============================================================*/
create table ALBUM_ANGGOTA
(
   ID_ALBUM             int not null  comment '',
   ID_ANGGOTA           int not null  comment '',
   primary key (ID_ALBUM)
);

/*==============================================================*/
/* Table: ALBUM_GRUP                                            */
/*==============================================================*/
create table ALBUM_GRUP
(
   ID_ALBUM             int not null  comment '',
   ID_PAKET_TRAVEL      int not null  comment '',
   primary key (ID_ALBUM)
);

/*==============================================================*/
/* Table: ANGGOTA_GRUP                                          */
/*==============================================================*/
create table ANGGOTA_GRUP
(
   ID_ANGGOTA           int not null auto_increment  comment '',
   ID_CUSTOMER          int not null  comment '',
   ID_PAKET_TRAVEL      int not null  comment '',
   RATING_PAKET         int not null  comment '',
   REVIEW_PAKET         varchar(255) not null  comment '',
   primary key (ID_ANGGOTA)
);

/*==============================================================*/
/* Table: CUSTOMER                                              */
/*==============================================================*/
create table CUSTOMER
(
   ID_CUSTOMER          int not null auto_increment  comment '',
   ID_PENGGUNA          int not null  comment '',
   NAMA_CUSTOMER        varchar(50) not null  comment '',
   ALAMAT_CUSTOMER      varchar(255) not null  comment '',
   TELEPON_CUSTOMER     varchar(20) not null  comment '',
   primary key (ID_CUSTOMER)
);

/*==============================================================*/
/* Table: FOTO                                                  */
/*==============================================================*/
create table FOTO
(
   ID_FOTO              int not null auto_increment  comment '',
   URL_FOTO             varchar(255) not null  comment '',
   JUDUL_FOTO           varchar(50)  comment '',
   primary key (ID_FOTO)
);

/*==============================================================*/
/* Table: FOTO_ANGGOTA                                          */
/*==============================================================*/
create table FOTO_ANGGOTA
(
   ID_FOTO              int not null  comment '',
   ID_ANGGOTA           int not null  comment '',
   primary key (ID_FOTO)
);

/*==============================================================*/
/* Table: FOTO_GRUP                                             */
/*==============================================================*/
create table FOTO_GRUP
(
   ID_FOTO              int not null  comment '',
   ID_PAKET_TRAVEL      int not null  comment '',
   primary key (ID_FOTO)
);

/*==============================================================*/
/* Table: FOTO_HALAMAN                                          */
/*==============================================================*/
create table FOTO_HALAMAN
(
   ID_FOTO_HALAMAN      int not null auto_increment  comment '',
   ID_FOTO              int not null  comment '',
   ID_HALAMAN           int not null  comment '',
   URUTAN_FOTO_HALAMAN  int not null  comment '',
   CAPTION_FOTO_HALAMAN int  comment '',
   primary key (ID_FOTO_HALAMAN),
   key AK_IDENTIFIER_2 (ID_HALAMAN, URUTAN_FOTO_HALAMAN)
);

/*==============================================================*/
/* Table: GRUP_TEMPLATE                                         */
/*==============================================================*/
create table GRUP_TEMPLATE
(
   ID_GRUP_TEMPLATE     int not null auto_increment  comment '',
   NAMA_GRUP_TEMPLATE   varchar(20) not null  comment '',
   URL_GRUP_TEMPLATE    varchar(255) not null  comment '',
   primary key (ID_GRUP_TEMPLATE)
);

/*==============================================================*/
/* Table: HALAMAN                                               */
/*==============================================================*/
create table HALAMAN
(
   ID_HALAMAN           int not null auto_increment  comment '',
   ID_ALBUM             int not null  comment '',
   ID_TEMPLATE          int  comment '',
   NOMOR_HALAMAN        int not null  comment '',
   primary key (ID_HALAMAN),
   key AK_IDENTIFIER_2 (ID_ALBUM, NOMOR_HALAMAN)
);

/*==============================================================*/
/* Table: KONFIRMASI_AKUN                                       */
/*==============================================================*/
create table KONFIRMASI_AKUN
(
   ID_PENGGUNA          int not null  comment '',
   KODE_KONFIRMASI      char(32) not null  comment '',
   TANGGAL_KADALUARSA   date not null  comment '',
   primary key (ID_PENGGUNA, KODE_KONFIRMASI)
);

/*==============================================================*/
/* Table: PAKET_CETAK                                           */
/*==============================================================*/
create table PAKET_CETAK
(
   ID_PAKET_CETAK       int not null auto_increment  comment '',
   ID_PERCETAKAN        int  comment '',
   NAMA_PAKET_CETAK     varchar(50) not null  comment '',
   DESKRIPSI_PAKET_CETAK varchar(1024) not null  comment '',
   RINGKASAN_PAKET_CETAK varchar(255) not null  comment '',
   HARGA_DASAR          int not null  comment '',
   HARGA_PER_LEMBAR     int not null  comment '',
   HARGA_PER_HALAMAN    int not null  comment '',
   primary key (ID_PAKET_CETAK)
);

/*==============================================================*/
/* Table: PAKET_TRAVEL                                          */
/*==============================================================*/
create table PAKET_TRAVEL
(
   ID_PAKET_TRAVEL      int not null auto_increment  comment '',
   ID_TRAVEL            int  comment '',
   NAMA_PAKET_TRAVEL    varchar(50) not null  comment '',
   TANGGAL_KEBERANGKATAN date not null  comment '',
   LAMA_KEBERANGKATAN   int not null  comment '',
   DESKRIPSI_PAKET_TRAVEL varchar(1024) not null  comment '',
   RINGKASAN_PAKET_TRAVEL varchar(255) not null  comment '',
   HARGA_PAKET_TRAVEL   int  comment '',
   primary key (ID_PAKET_TRAVEL)
);

/*==============================================================*/
/* Table: PEMBAYARAN                                            */
/*==============================================================*/
create table PEMBAYARAN
(
   ID_PEMBAYARAN        int not null auto_increment  comment '',
   ID_CUSTOMER          int not null  comment '',
   ID_PESANAN           int not null  comment '',
   TANGGAL_BAYAR        date not null  comment '',
   JUMLAH_BAYAR         int not null  comment '',
   primary key (ID_PEMBAYARAN)
);

/*==============================================================*/
/* Table: PERCETAKAN                                            */
/*==============================================================*/
create table PERCETAKAN
(
   ID_PERCETAKAN        int not null auto_increment  comment '',
   ID_PENGGUNA          int not null  comment '',
   NAMA_PERCETAKAN      varchar(50) not null  comment '',
   ALAMAT_PERCETAKAN    varchar(255) not null  comment '',
   TELEPON_PERCETAKAN   varchar(20) not null  comment '',
   EMAIL_PERCETAKAN     varchar(255)  comment '',
   DESKRIPSI_PERCETAKAN varchar(1024)  comment '',
   RINGKASAN_PERCETAKAN varchar(255)  comment '',
   primary key (ID_PERCETAKAN),
   key AK_IDENTIFIER_2 (NAMA_PERCETAKAN)
);

/*==============================================================*/
/* Table: PESANAN_ALBUM                                         */
/*==============================================================*/
create table PESANAN_ALBUM
(
   ID_PESANAN           int not null auto_increment  comment '',
   ID_ANGGOTA           int not null  comment '',
   ID_ALBUM             int not null  comment '',
   JUMLAH_TAGIHAN       int not null  comment '',
   TANGGAL_LUNAS        date  comment '',
   TANGGAL_KIRIM        date  comment '',
   TANGGAL_TERIMA       date  comment '',
   primary key (ID_PESANAN)
);

/*==============================================================*/
/* Table: TEMPLATE_HALAMAN                                      */
/*==============================================================*/
create table TEMPLATE_HALAMAN
(
   ID_TEMPLATE          int not null auto_increment  comment '',
   ID_GRUP_TEMPLATE     int  comment '',
   NAMA_TEMPLATE        varchar(20) not null  comment '',
   JUMLAH_FOTO          int not null  comment '',
   URL_TEMPLATE         varchar(255) not null  comment '',
   primary key (ID_TEMPLATE)
);

/*==============================================================*/
/* Table: TRAVEL                                                */
/*==============================================================*/
create table TRAVEL
(
   ID_TRAVEL            int not null auto_increment  comment '',
   ID_PENGGUNA          int not null  comment '',
   NAMA_TRAVEL          varchar(50) not null  comment '',
   ALAMAT_TRAVEL        varchar(255) not null  comment '',
   TELEPON_TRAVEL       varchar(20) not null  comment '',
   EMAIL_TRAVEL         varchar(255)  comment '',
   DESKRIPSI_TRAVEL     varchar(1024)  comment '',
   RINGKASAN_TRAVEL     varchar(255)  comment '',
   primary key (ID_TRAVEL),
   key AK_IDENTIFIER_2 (NAMA_TRAVEL)
);

alter table ALBUM add constraint FK_ALBUM_RELATIONS_PAKET_CE foreign key (ID_PAKET_CETAK)
      references PAKET_CETAK (ID_PAKET_CETAK) on delete restrict on update restrict;

alter table ALBUM_ANGGOTA add constraint FK_ALBUM_AN_INHERITAN_ALBUM foreign key (ID_ALBUM)
      references ALBUM (ID_ALBUM) on delete restrict on update restrict;

alter table ALBUM_ANGGOTA add constraint FK_ALBUM_AN_RELATIONS_ANGGOTA_ foreign key (ID_ANGGOTA)
      references ANGGOTA_GRUP (ID_ANGGOTA) on delete restrict on update restrict;

alter table ALBUM_GRUP add constraint FK_ALBUM_GR_INHERITAN_ALBUM foreign key (ID_ALBUM)
      references ALBUM (ID_ALBUM) on delete restrict on update restrict;

alter table ALBUM_GRUP add constraint FK_ALBUM_GR_RELATIONS_PAKET_TR foreign key (ID_PAKET_TRAVEL)
      references PAKET_TRAVEL (ID_PAKET_TRAVEL) on delete restrict on update restrict;

alter table ANGGOTA_GRUP add constraint FK_ANGGOTA__RELATIONS_CUSTOMER foreign key (ID_CUSTOMER)
      references CUSTOMER (ID_CUSTOMER) on delete restrict on update restrict;

alter table ANGGOTA_GRUP add constraint FK_ANGGOTA__RELATIONS_PAKET_TR foreign key (ID_PAKET_TRAVEL)
      references PAKET_TRAVEL (ID_PAKET_TRAVEL) on delete restrict on update restrict;

alter table CUSTOMER add constraint FK_CUSTOMER_RELATIONS_AKUN foreign key (ID_PENGGUNA)
      references AKUN (ID_PENGGUNA) on delete restrict on update restrict;

alter table FOTO_ANGGOTA add constraint FK_FOTO_ANG_INHERITAN_FOTO foreign key (ID_FOTO)
      references FOTO (ID_FOTO) on delete restrict on update restrict;

alter table FOTO_ANGGOTA add constraint FK_FOTO_ANG_RELATIONS_ANGGOTA_ foreign key (ID_ANGGOTA)
      references ANGGOTA_GRUP (ID_ANGGOTA) on delete restrict on update restrict;

alter table FOTO_GRUP add constraint FK_FOTO_GRU_INHERITAN_FOTO foreign key (ID_FOTO)
      references FOTO (ID_FOTO) on delete restrict on update restrict;

alter table FOTO_GRUP add constraint FK_FOTO_GRU_RELATIONS_PAKET_TR foreign key (ID_PAKET_TRAVEL)
      references PAKET_TRAVEL (ID_PAKET_TRAVEL) on delete restrict on update restrict;

alter table FOTO_HALAMAN add constraint FK_FOTO_HAL_RELATIONS_FOTO foreign key (ID_FOTO)
      references FOTO (ID_FOTO) on delete restrict on update restrict;

alter table FOTO_HALAMAN add constraint FK_FOTO_HAL_RELATIONS_HALAMAN foreign key (ID_HALAMAN)
      references HALAMAN (ID_HALAMAN) on delete restrict on update restrict;

alter table HALAMAN add constraint FK_HALAMAN_RELATIONS_TEMPLATE foreign key (ID_TEMPLATE)
      references TEMPLATE_HALAMAN (ID_TEMPLATE) on delete restrict on update restrict;

alter table HALAMAN add constraint FK_HALAMAN_RELATIONS_ALBUM foreign key (ID_ALBUM)
      references ALBUM (ID_ALBUM) on delete restrict on update restrict;

alter table KONFIRMASI_AKUN add constraint FK_KONFIRMA_RELATIONS_AKUN foreign key (ID_PENGGUNA)
      references AKUN (ID_PENGGUNA) on delete restrict on update restrict;

alter table PAKET_CETAK add constraint FK_PAKET_CE_RELATIONS_PERCETAK foreign key (ID_PERCETAKAN)
      references PERCETAKAN (ID_PERCETAKAN) on delete restrict on update restrict;

alter table PAKET_TRAVEL add constraint FK_PAKET_TR_RELATIONS_TRAVEL foreign key (ID_TRAVEL)
      references TRAVEL (ID_TRAVEL) on delete restrict on update restrict;

alter table PEMBAYARAN add constraint FK_PEMBAYAR_RELATIONS_CUSTOMER foreign key (ID_CUSTOMER)
      references CUSTOMER (ID_CUSTOMER) on delete restrict on update restrict;

alter table PEMBAYARAN add constraint FK_PEMBAYAR_RELATIONS_PESANAN_ foreign key (ID_PESANAN)
      references PESANAN_ALBUM (ID_PESANAN) on delete restrict on update restrict;

alter table PERCETAKAN add constraint FK_PERCETAK_RELATIONS_AKUN foreign key (ID_PENGGUNA)
      references AKUN (ID_PENGGUNA) on delete restrict on update restrict;

alter table PESANAN_ALBUM add constraint FK_PESANAN__RELATIONS_ANGGOTA_ foreign key (ID_ANGGOTA)
      references ANGGOTA_GRUP (ID_ANGGOTA) on delete restrict on update restrict;

alter table PESANAN_ALBUM add constraint FK_PESANAN__RELATIONS_ALBUM foreign key (ID_ALBUM)
      references ALBUM (ID_ALBUM) on delete restrict on update restrict;

alter table TEMPLATE_HALAMAN add constraint FK_TEMPLATE_RELATIONS_GRUP_TEM foreign key (ID_GRUP_TEMPLATE)
      references GRUP_TEMPLATE (ID_GRUP_TEMPLATE) on delete restrict on update restrict;

alter table TRAVEL add constraint FK_TRAVEL_RELATIONS_AKUN foreign key (ID_PENGGUNA)
      references AKUN (ID_PENGGUNA) on delete restrict on update restrict;


/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.1.34-MariaDB : Database - admin_uas4b
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`admin_uas4b` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `akun` */

DROP TABLE IF EXISTS `akun`;

CREATE TABLE `akun` (
  `ID_PENGGUNA` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(20) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  `PERAN_PENGGUNA` int(11) NOT NULL,
  `EMAIL_PENGGUNA` varchar(255) NOT NULL,
  `STATUS_AKUN` int(11) NOT NULL,
  PRIMARY KEY (`ID_PENGGUNA`),
  UNIQUE KEY `AK_IDENTIFIER_2` (`USERNAME`),
  KEY `AK_IDENTIFIER_3` (`EMAIL_PENGGUNA`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

/*Data for the table `akun` */

insert  into `akun`(`ID_PENGGUNA`,`USERNAME`,`PASSWORD`,`PERAN_PENGGUNA`,`EMAIL_PENGGUNA`,`STATUS_AKUN`) values 
(1,'admin','D406C362304CDDF5856B1FEEF20A374C',4,'',2),
(18,'linearch','8992022dd0580e858d9e60ec4c65f587',1,'rizqinur2010@gmail.com',0),
(20,'asdfasfdasdf','8992022dd0580e858d9e60ec4c65f587',1,'xstinky12@gmail.com',0),
(21,'asdfasdfa','8992022dd0580e858d9e60ec4c65f587',1,'xstinky12@gmail.com',2),
(22,'Alifiandri','ff9d4684c9b49889598648152695f99f',1,'rashedadam31@gmail.com',2),
(23,'rizqinur','89e55761f6b9c46b85497788f6cf8f75',1,'rizqinur2010@gmail.com',0),
(58,'user','8992022dd0580e858d9e60ec4c65f587',1,'rizqinur2010@gmail.com',0);

/*Table structure for table `album` */

DROP TABLE IF EXISTS `album`;

CREATE TABLE `album` (
  `ID_ALBUM` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PAKET_CETAK` int(11) DEFAULT NULL,
  `JUDUL_ALBUM` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_ALBUM`),
  KEY `FK_ALBUM_RELATIONS_PAKET_CE` (`ID_PAKET_CETAK`),
  CONSTRAINT `FK_ALBUM_RELATIONS_PAKET_CE` FOREIGN KEY (`ID_PAKET_CETAK`) REFERENCES `paket_cetak` (`ID_PAKET_CETAK`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `album` */

insert  into `album`(`ID_ALBUM`,`ID_PAKET_CETAK`,`JUDUL_ALBUM`) values 
(1,5,'Albumbum'),
(7,NULL,'asdfasdf'),
(8,NULL,'asd'),
(9,NULL,'qwer'),
(11,NULL,'cust'),
(12,1,'asdf'),
(13,3,'umroh'),
(14,NULL,'Album baru'),
(15,NULL,'asdasd'),
(16,3,'AAAA'),
(17,NULL,'BBBB'),
(18,NULL,'Ang'),
(19,5,'album baru'),
(20,NULL,'album anggota');

/*Table structure for table `album_anggota` */

DROP TABLE IF EXISTS `album_anggota`;

CREATE TABLE `album_anggota` (
  `ID_ALBUM` int(11) NOT NULL,
  `ID_ANGGOTA` int(11) NOT NULL,
  PRIMARY KEY (`ID_ALBUM`),
  KEY `FK_ALBUM_AN_RELATIONS_ANGGOTA_` (`ID_ANGGOTA`),
  CONSTRAINT `FK_ALBUM_AN_INHERITAN_ALBUM` FOREIGN KEY (`ID_ALBUM`) REFERENCES `album` (`ID_ALBUM`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ALBUM_AN_RELATIONS_ANGGOTA_` FOREIGN KEY (`ID_ANGGOTA`) REFERENCES `anggota_grup` (`ID_ANGGOTA_GRUP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `album_anggota` */

insert  into `album_anggota`(`ID_ALBUM`,`ID_ANGGOTA`) values 
(11,1),
(15,1),
(12,10),
(13,10),
(18,18),
(20,19);

/*Table structure for table `album_grup` */

DROP TABLE IF EXISTS `album_grup`;

CREATE TABLE `album_grup` (
  `ID_ALBUM` int(11) NOT NULL,
  `ID_PAKET_TRAVEL` int(11) NOT NULL,
  PRIMARY KEY (`ID_ALBUM`),
  KEY `FK_ALBUM_GR_RELATIONS_PAKET_TR` (`ID_PAKET_TRAVEL`),
  CONSTRAINT `FK_ALBUM_GR_INHERITAN_ALBUM` FOREIGN KEY (`ID_ALBUM`) REFERENCES `album` (`ID_ALBUM`) ON UPDATE CASCADE,
  CONSTRAINT `FK_ALBUM_GR_RELATIONS_PAKET_TR` FOREIGN KEY (`ID_PAKET_TRAVEL`) REFERENCES `paket_travel` (`ID_PAKET_TRAVEL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `album_grup` */

insert  into `album_grup`(`ID_ALBUM`,`ID_PAKET_TRAVEL`) values 
(1,1),
(7,1),
(14,1),
(8,6),
(9,6),
(16,7),
(17,7),
(19,9);

/*Table structure for table `anggota_grup` */

DROP TABLE IF EXISTS `anggota_grup`;

CREATE TABLE `anggota_grup` (
  `ID_ANGGOTA_GRUP` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CUSTOMER` int(11) NOT NULL,
  `ID_PAKET_TRAVEL` int(11) NOT NULL,
  `RATING_PAKET_TRAVEL` int(11) DEFAULT NULL,
  `REVIEW_PAKET_TRAVEL` varchar(255) DEFAULT NULL,
  `STATUS_ANGGOTA_GRUP` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_ANGGOTA_GRUP`),
  UNIQUE KEY `UN` (`ID_CUSTOMER`,`ID_PAKET_TRAVEL`),
  KEY `FK_ANGGOTA__RELATIONS_CUSTOMER` (`ID_CUSTOMER`),
  KEY `FK_ANGGOTA__RELATIONS_PAKET_TR` (`ID_PAKET_TRAVEL`),
  CONSTRAINT `FK_ANGGOTA__RELATIONS_CUSTOMER` FOREIGN KEY (`ID_CUSTOMER`) REFERENCES `customer` (`ID_CUSTOMER`),
  CONSTRAINT `FK_ANGGOTA__RELATIONS_PAKET_TR` FOREIGN KEY (`ID_PAKET_TRAVEL`) REFERENCES `paket_travel` (`ID_PAKET_TRAVEL`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `anggota_grup` */

insert  into `anggota_grup`(`ID_ANGGOTA_GRUP`,`ID_CUSTOMER`,`ID_PAKET_TRAVEL`,`RATING_PAKET_TRAVEL`,`REVIEW_PAKET_TRAVEL`,`STATUS_ANGGOTA_GRUP`) values 
(1,1,1,0,'',1),
(10,1,5,NULL,NULL,1),
(13,1,4,NULL,NULL,1),
(14,1,3,NULL,NULL,0),
(15,22,6,NULL,NULL,0),
(16,22,5,NULL,NULL,0),
(17,1,2,NULL,NULL,0),
(18,1,7,NULL,NULL,1),
(19,1,9,NULL,NULL,1);

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `ID_CUSTOMER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PENGGUNA` int(11) NOT NULL,
  `NAMA_CUSTOMER` varchar(50) NOT NULL,
  `ALAMAT_CUSTOMER` varchar(255) NOT NULL,
  `TELEPON_CUSTOMER` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_CUSTOMER`),
  KEY `FK_CUSTOMER_RELATIONS_AKUN` (`ID_PENGGUNA`),
  CONSTRAINT `FK_CUSTOMER_RELATIONS_AKUN` FOREIGN KEY (`ID_PENGGUNA`) REFERENCES `akun` (`ID_PENGGUNA`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

insert  into `customer`(`ID_CUSTOMER`,`ID_PENGGUNA`,`NAMA_CUSTOMER`,`ALAMAT_CUSTOMER`,`TELEPON_CUSTOMER`) values 
(1,1,'Admoon','asdfasdfasdf','23452345'),
(18,18,'Rizqi Nur','asdfasdfasfd','0000888888'),
(20,20,'AAAAAAAAAAAAAA','aaaaaaaaaaaa','808080'),
(21,21,'asdfasdf','asdfasdf','3123213'),
(22,22,'Andre','and','0895361406154'),
(27,58,'nama saya','almt','080808080');

/*Table structure for table `foto` */

DROP TABLE IF EXISTS `foto`;

CREATE TABLE `foto` (
  `ID_FOTO` int(11) NOT NULL AUTO_INCREMENT,
  `URL_FOTO` varchar(255) NOT NULL,
  `JUDUL_FOTO` varchar(50) DEFAULT NULL,
  `PRIORITAS_FOTO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_FOTO`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

/*Data for the table `foto` */

insert  into `foto`(`ID_FOTO`,`URL_FOTO`,`JUDUL_FOTO`,`PRIORITAS_FOTO`) values 
(34,'assets/uploads/foto/1/0/5cfc873772b30.jpg','Koala',0),
(35,'assets/uploads/foto/1/0/5cfc87b48e37c.jpg','Chrysanthemum',0),
(36,'assets/uploads/foto/1/0/5cfc881707ffb.jpg','Koala',0),
(37,'assets/uploads/foto/1/0/5cfc8875ac163.jpg','Koala',0),
(38,'assets/uploads/foto/1/0/5cfc88cdac788.jpg','Desert',0),
(39,'assets/uploads/foto/1/0/5cfc8961e1a05.jpg','Lighthouse',0),
(40,'assets/uploads/foto/1/0/5cfc89a4d6e7f.jpg','Penguins',0),
(41,'assets/uploads/foto/1/0/5cfc89bb58b9b.jpg','Tulips',0),
(42,'assets/uploads/foto/1/0/5cfc89d9bc29c.jpg','Penguins',0),
(43,'assets/uploads/foto/1/0/5cfc8a640ed9f.jpg','Chrysanthemum',0),
(44,'assets/uploads/foto/1/0/5cfc8a886c82a.jpg','Lighthouse',0),
(45,'assets/uploads/foto/1/0/5cfc8ab16f97f.jpg','Lighthouse',0),
(46,'assets/uploads/foto/1/0/5cfc8ac09e782.jpg','Lighthouse',0),
(47,'assets/uploads/foto/1/0/5cfc8ac0b882d.jpg','Koala',0),
(48,'assets/uploads/foto/1/0/5cfc8ac8508e0.jpg','Penguins',0),
(49,'assets/uploads/foto/1/0/5cfc8b3bdccca.jpg','Lighthouse',0),
(50,'assets/uploads/foto/1/0/5cfc8b3d804b7.jpg','Penguins',0),
(51,'assets/uploads/foto/1/0/5cfc8b498c9cf.jpg','Lighthouse',0),
(52,'assets/uploads/foto/1/0/5cfc8b4c85171.jpg','Penguins',0),
(53,'assets/uploads/foto/1/0/5cfc8b62185ba.jpg','Penguins',0),
(54,'assets/uploads/foto/1/0/5cfc8b6241886.jpg','Lighthouse',0),
(55,'assets/uploads/foto/1/0/5cfc8bbd0260a.jpg','Lighthouse',0),
(56,'assets/uploads/foto/1/0/5cfc8bc12fed3.jpg','Penguins',0),
(57,'assets/uploads/foto/1/0/5cfc8bec37f4c.jpg','Lighthouse',0),
(58,'assets/uploads/foto/1/0/5cfc90efabb79.jpg','Koala',0),
(59,'assets/uploads/foto/1/0/5cfc90f236862.jpg','Lighthouse',0),
(60,'assets/uploads/foto/1/0/5cfc90f4dfcab.jpg','Penguins',0),
(61,'assets/uploads/foto/1/0/5cfc9b90b621f.jpg','Lighthouse',0),
(62,'assets/uploads/foto/6/0/5cfce136cd01f.jpg','Koala',0),
(63,'assets/uploads/foto/6/0/5cfce14697f83.jpg','Lighthouse',0),
(70,'assets/uploads/foto/6/0/5d0491560973d.jpg','Lighthouse',0),
(71,'assets/uploads/foto/6/0/5d0b1d102a1b6.jpg','Penguins',0),
(72,'assets/uploads/foto/1/0/5d0bbf669bec8.jpg','Tulips',0),
(73,'assets/uploads/foto/1/0/5d0bbf75bc1e2.jpg','Jellyfish',0),
(75,'assets/uploads/foto/1/1/5d0bc0f7d2d7d.png','2019-05-12_15h49_08',0),
(76,'assets/uploads/foto/1/1/5d0bc10a2a65c.png','2019-05-12_16h03_19',0),
(77,'assets/uploads/foto/1/1/5d0c53be1d68e.jpg','umroh6',0),
(78,'assets/uploads/foto/1/0/5d0c5886a83be.jpg','Desert',0),
(79,'assets/uploads/foto/7/0/5d14bf1639eab.jpg','Desert',0),
(80,'assets/uploads/foto/7/0/5d14bf23e34c2.jpg','Hydrangeas',0),
(81,'assets/uploads/foto/7/0/5d14bf24134ab.jpg','Penguins',0),
(82,'assets/uploads/foto/7/0/5d14bf3406933.jpg','Tulips',0),
(83,'assets/uploads/foto/7/18/5d14c07581790.jpg','IMG-20170304-WA0005',0),
(84,'assets/uploads/foto/9/0/5d14c4f4bb8a7.jpg','IMG-20170304-WA0005',0),
(85,'assets/uploads/foto/9/0/5d14c4f4d953e.jpg','Jamaah Umroh Arminareka Perdana Masjid Quba',0),
(86,'assets/uploads/foto/9/0/5d14c4f50049c.jpg','Jamaah-IIW',0),
(87,'assets/uploads/foto/9/0/5d14c4f513939.jpg','Jamaah-Umroh-Al-Aqsha',0),
(88,'assets/uploads/foto/9/0/5d14c4f53ecab.jpg','Nursa-Tour',0),
(89,'assets/uploads/foto/9/0/5d14c4f5563b0.jpg','pt-arminareka-perdana-muhasabah-bareng-4500-jamaah',0),
(90,'assets/uploads/foto/9/19/5d14c5594aafd.jpg','Jellyfish',0);

/*Table structure for table `foto_anggota` */

DROP TABLE IF EXISTS `foto_anggota`;

CREATE TABLE `foto_anggota` (
  `ID_FOTO` int(11) NOT NULL,
  `ID_ANGGOTA` int(11) NOT NULL,
  PRIMARY KEY (`ID_FOTO`),
  KEY `FK_FOTO_ANG_RELATIONS_ANGGOTA_` (`ID_ANGGOTA`),
  CONSTRAINT `FK_FOTO_ANG_INHERITAN_FOTO` FOREIGN KEY (`ID_FOTO`) REFERENCES `foto` (`ID_FOTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_FOTO_ANG_RELATIONS_ANGGOTA_` FOREIGN KEY (`ID_ANGGOTA`) REFERENCES `anggota_grup` (`ID_ANGGOTA_GRUP`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `foto_anggota` */

insert  into `foto_anggota`(`ID_FOTO`,`ID_ANGGOTA`) values 
(75,1),
(76,1),
(77,1),
(83,18),
(90,19);

/*Table structure for table `foto_grup` */

DROP TABLE IF EXISTS `foto_grup`;

CREATE TABLE `foto_grup` (
  `ID_FOTO` int(11) NOT NULL,
  `ID_PAKET_TRAVEL` int(11) NOT NULL,
  PRIMARY KEY (`ID_FOTO`),
  KEY `FK_FOTO_GRU_RELATIONS_PAKET_TR` (`ID_PAKET_TRAVEL`),
  CONSTRAINT `FK_FOTO_GRU_INHERITAN_FOTO` FOREIGN KEY (`ID_FOTO`) REFERENCES `foto` (`ID_FOTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_FOTO_GRU_RELATIONS_PAKET_TR` FOREIGN KEY (`ID_PAKET_TRAVEL`) REFERENCES `paket_travel` (`ID_PAKET_TRAVEL`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `foto_grup` */

insert  into `foto_grup`(`ID_FOTO`,`ID_PAKET_TRAVEL`) values 
(34,1),
(35,1),
(36,1),
(37,1),
(38,1),
(39,1),
(40,1),
(41,1),
(42,1),
(43,1),
(44,1),
(45,1),
(46,1),
(47,1),
(48,1),
(49,1),
(50,1),
(51,1),
(52,1),
(53,1),
(54,1),
(55,1),
(56,1),
(57,1),
(58,1),
(59,1),
(60,1),
(61,1),
(72,1),
(73,1),
(78,1),
(62,6),
(63,6),
(70,6),
(71,6),
(79,7),
(80,7),
(81,7),
(82,7),
(84,9),
(85,9),
(86,9),
(87,9),
(88,9),
(89,9);

/*Table structure for table `foto_halaman` */

DROP TABLE IF EXISTS `foto_halaman`;

CREATE TABLE `foto_halaman` (
  `ID_FOTO` int(11) NOT NULL,
  `ID_HALAMAN` int(11) NOT NULL,
  `URUTAN_FOTO_HALAMAN` int(11) NOT NULL,
  `CAPTION_FOTO_HALAMAN` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_HALAMAN`,`URUTAN_FOTO_HALAMAN`),
  KEY `FK_FOTO_HAL_RELATIONS_FOTO` (`ID_FOTO`),
  KEY `AK_IDENTIFIER_2` (`ID_HALAMAN`,`ID_FOTO`),
  CONSTRAINT `FK_FOTO_HAL_RELATIONS_FOTO` FOREIGN KEY (`ID_FOTO`) REFERENCES `foto` (`ID_FOTO`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_FOTO_HAL_RELATIONS_HALAMAN` FOREIGN KEY (`ID_HALAMAN`) REFERENCES `halaman` (`ID_HALAMAN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `foto_halaman` */

insert  into `foto_halaman`(`ID_FOTO`,`ID_HALAMAN`,`URUTAN_FOTO_HALAMAN`,`CAPTION_FOTO_HALAMAN`) values 
(59,1,1,NULL),
(78,1,2,NULL),
(61,1,3,NULL),
(60,1,4,NULL),
(60,6,1,NULL),
(58,6,2,NULL),
(61,6,3,NULL),
(54,6,4,NULL),
(72,7,1,NULL),
(71,8,1,NULL),
(70,8,2,NULL),
(71,8,3,NULL),
(63,8,4,NULL),
(75,11,1,NULL),
(58,11,2,NULL),
(73,11,3,NULL),
(59,11,4,NULL),
(78,13,1,NULL),
(61,13,2,NULL),
(73,13,3,NULL),
(60,13,4,NULL),
(80,14,1,NULL),
(82,14,2,NULL),
(81,14,3,NULL),
(79,14,4,NULL),
(80,15,1,NULL),
(82,15,2,NULL),
(81,15,3,NULL),
(79,15,4,NULL),
(81,16,1,NULL),
(83,16,2,NULL),
(82,16,3,NULL),
(79,16,4,NULL),
(88,17,1,NULL),
(87,17,2,NULL),
(85,17,3,NULL),
(86,17,4,NULL),
(89,18,1,NULL),
(87,18,2,NULL),
(86,18,3,NULL),
(88,18,4,NULL),
(90,19,1,NULL),
(88,19,2,NULL),
(89,19,3,NULL),
(85,19,4,NULL);

/*Table structure for table `grup_template` */

DROP TABLE IF EXISTS `grup_template`;

CREATE TABLE `grup_template` (
  `ID_GRUP_TEMPLATE` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_GRUP_TEMPLATE` varchar(20) NOT NULL,
  `URL_GRUP_TEMPLATE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_GRUP_TEMPLATE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `grup_template` */

insert  into `grup_template`(`ID_GRUP_TEMPLATE`,`NAMA_GRUP_TEMPLATE`,`URL_GRUP_TEMPLATE`) values 
(1,'Dania','assets/templates/1/');

/*Table structure for table `halaman` */

DROP TABLE IF EXISTS `halaman`;

CREATE TABLE `halaman` (
  `ID_HALAMAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ALBUM` int(11) NOT NULL,
  `ID_TEMPLATE` int(11) DEFAULT NULL,
  `NOMOR_HALAMAN` int(11) NOT NULL,
  PRIMARY KEY (`ID_HALAMAN`),
  KEY `AK_IDENTIFIER_2` (`ID_ALBUM`,`NOMOR_HALAMAN`),
  KEY `FK_HALAMAN_RELATIONS_TEMPLATE` (`ID_TEMPLATE`),
  CONSTRAINT `FK_HALAMAN_RELATIONS_ALBUM` FOREIGN KEY (`ID_ALBUM`) REFERENCES `album` (`ID_ALBUM`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_HALAMAN_RELATIONS_TEMPLATE` FOREIGN KEY (`ID_TEMPLATE`) REFERENCES `template_halaman` (`ID_TEMPLATE`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `halaman` */

insert  into `halaman`(`ID_HALAMAN`,`ID_ALBUM`,`ID_TEMPLATE`,`NOMOR_HALAMAN`) values 
(1,1,1,1),
(2,1,1,2),
(3,1,1,3),
(4,1,1,4),
(5,1,1,5),
(6,7,1,1),
(7,1,1,6),
(8,9,1,1),
(9,11,1,1),
(10,11,1,2),
(11,11,1,3),
(12,13,1,1),
(13,14,1,1),
(14,16,1,1),
(15,16,1,2),
(16,18,1,1),
(17,19,1,1),
(18,19,1,2),
(19,20,1,1);

/*Table structure for table `konfirmasi_akun` */

DROP TABLE IF EXISTS `konfirmasi_akun`;

CREATE TABLE `konfirmasi_akun` (
  `ID_PENGGUNA` int(11) NOT NULL,
  `KODE_KONFIRMASI` char(32) NOT NULL,
  `TANGGAL_KADALUARSA` date NOT NULL,
  PRIMARY KEY (`ID_PENGGUNA`,`KODE_KONFIRMASI`),
  CONSTRAINT `FK_KONFIRMA_RELATIONS_AKUN` FOREIGN KEY (`ID_PENGGUNA`) REFERENCES `akun` (`ID_PENGGUNA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `konfirmasi_akun` */

insert  into `konfirmasi_akun`(`ID_PENGGUNA`,`KODE_KONFIRMASI`,`TANGGAL_KADALUARSA`) values 
(18,'b8e8453cfbcc7e5ffcb9f97e63bd00cd','2019-06-14'),
(20,'ae9eebc40b985ad7bc0a9244f58a1ea9','2019-06-14'),
(23,'aedf6c993a417b684c9984c4e9b6b3da','2019-06-24'),
(58,'b829d963c5f70cbfd7993fd69f794e35','2019-06-30');

/*Table structure for table `paket_cetak` */

DROP TABLE IF EXISTS `paket_cetak`;

CREATE TABLE `paket_cetak` (
  `ID_PAKET_CETAK` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERCETAKAN` int(11) DEFAULT NULL,
  `NAMA_PAKET_CETAK` varchar(50) NOT NULL,
  `DESKRIPSI_PAKET_CETAK` varchar(1024) NOT NULL,
  `RINGKASAN_PAKET_CETAK` varchar(255) NOT NULL,
  `HARGA_DASAR` int(11) NOT NULL,
  `HARGA_PER_HALAMAN` int(11) NOT NULL,
  PRIMARY KEY (`ID_PAKET_CETAK`),
  KEY `FK_PAKET_CE_RELATIONS_PERCETAK` (`ID_PERCETAKAN`),
  CONSTRAINT `FK_PAKET_CE_RELATIONS_PERCETAK` FOREIGN KEY (`ID_PERCETAKAN`) REFERENCES `percetakan` (`ID_PERCETAKAN`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `paket_cetak` */

insert  into `paket_cetak`(`ID_PAKET_CETAK`,`ID_PERCETAKAN`,`NAMA_PAKET_CETAK`,`DESKRIPSI_PAKET_CETAK`,`RINGKASAN_PAKET_CETAK`,`HARGA_DASAR`,`HARGA_PER_HALAMAN`) values 
(1,1,'ASDASDASD','qwerwqerqwerwqer','aasdfasdfasd',50000,5000),
(2,1,'Paket cetak admin','asdfasdfasdf','qwerqwer',50000,5000),
(3,1,'Paket cetak admin2','asdfasdfasdf','qwerqwer',50000,5000),
(4,1,'Paket cetak baru','desc cetak','ringkasan cetak',5000,1000),
(5,1,'Paket cetak baru banget','deskripsi paket cetak','ringkasan paket cetak',5000,1000);

/*Table structure for table `paket_travel` */

DROP TABLE IF EXISTS `paket_travel`;

CREATE TABLE `paket_travel` (
  `ID_PAKET_TRAVEL` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TRAVEL` int(11) DEFAULT NULL,
  `NAMA_PAKET_TRAVEL` varchar(50) NOT NULL,
  `TANGGAL_KEBERANGKATAN` date NOT NULL,
  `LAMA_KEBERANGKATAN` int(11) NOT NULL,
  `DESKRIPSI_PAKET_TRAVEL` varchar(1024) NOT NULL,
  `RINGKASAN_PAKET_TRAVEL` varchar(255) NOT NULL,
  `HARGA_PAKET_TRAVEL` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_PAKET_TRAVEL`),
  KEY `FK_PAKET_TR_RELATIONS_TRAVEL` (`ID_TRAVEL`),
  CONSTRAINT `FK_PAKET_TR_RELATIONS_TRAVEL` FOREIGN KEY (`ID_TRAVEL`) REFERENCES `travel` (`ID_TRAVEL`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `paket_travel` */

insert  into `paket_travel`(`ID_PAKET_TRAVEL`,`ID_TRAVEL`,`NAMA_PAKET_TRAVEL`,`TANGGAL_KEBERANGKATAN`,`LAMA_KEBERANGKATAN`,`DESKRIPSI_PAKET_TRAVEL`,`RINGKASAN_PAKET_TRAVEL`,`HARGA_PAKET_TRAVEL`) values 
(1,1,'Paket admin','2019-06-11',2,'asdfasdf','asfdasdf',5000000),
(2,1,'Pakett2','2019-06-13',2,'asdfasdf\nasdfasfd','asdddddddddddddd',132123),
(3,1,'Pakett3','2019-06-13',2,'asdfasdf\nasdfasfd','asdddddddddddddd',132123),
(4,1,'Pakett4','2019-06-13',2,'asdfasdf\nasdfasfd','asdddddddddddddd',132123),
(5,1,'Pakett5','2019-06-13',2,'asdfasdf\nasdfasfd','asdddddddddddddd',132123),
(6,1,'Pakett6','2019-06-13',2,'asdfasdf\nasdfasfd','asdddddddddddddd',132123),
(7,1,'qqqqqqqqq','0000-00-00',12,'desc','r',50000),
(8,1,'Paket cetak baru','0000-00-00',9,'desc paket travel','ringkasan paket travel',50000),
(9,1,'Paket travel baru banget','2019-06-28',9,'deskripsi paket travel','ringkasan paket travel',50000);

/*Table structure for table `pembayaran` */

DROP TABLE IF EXISTS `pembayaran`;

CREATE TABLE `pembayaran` (
  `ID_PEMBAYARAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CUSTOMER` int(11) NOT NULL,
  `ID_PESANAN` int(11) NOT NULL,
  `TANGGAL_BAYAR` date NOT NULL,
  `JUMLAH_BAYAR` int(11) NOT NULL,
  PRIMARY KEY (`ID_PEMBAYARAN`),
  KEY `FK_PEMBAYAR_RELATIONS_CUSTOMER` (`ID_CUSTOMER`),
  KEY `FK_PEMBAYAR_RELATIONS_PESANAN_` (`ID_PESANAN`),
  CONSTRAINT `FK_PEMBAYAR_RELATIONS_CUSTOMER` FOREIGN KEY (`ID_CUSTOMER`) REFERENCES `customer` (`ID_CUSTOMER`),
  CONSTRAINT `FK_PEMBAYAR_RELATIONS_PESANAN_` FOREIGN KEY (`ID_PESANAN`) REFERENCES `pesanan_album` (`ID_PESANAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pembayaran` */

/*Table structure for table `percetakan` */

DROP TABLE IF EXISTS `percetakan`;

CREATE TABLE `percetakan` (
  `ID_PERCETAKAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PENGGUNA` int(11) NOT NULL,
  `NAMA_PERCETAKAN` varchar(50) NOT NULL,
  `ALAMAT_PERCETAKAN` varchar(255) NOT NULL,
  `TELEPON_PERCETAKAN` varchar(20) NOT NULL,
  `EMAIL_PERCETAKAN` varchar(255) DEFAULT NULL,
  `DESKRIPSI_PERCETAKAN` varchar(1024) DEFAULT NULL,
  `RINGKASAN_PERCETAKAN` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_PERCETAKAN`),
  UNIQUE KEY `AK_IDENTIFIER_2` (`NAMA_PERCETAKAN`),
  KEY `FK_PERCETAK_RELATIONS_AKUN` (`ID_PENGGUNA`),
  CONSTRAINT `FK_PERCETAK_RELATIONS_AKUN` FOREIGN KEY (`ID_PENGGUNA`) REFERENCES `akun` (`ID_PENGGUNA`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `percetakan` */

insert  into `percetakan`(`ID_PERCETAKAN`,`ID_PENGGUNA`,`NAMA_PERCETAKAN`,`ALAMAT_PERCETAKAN`,`TELEPON_PERCETAKAN`,`EMAIL_PERCETAKAN`,`DESKRIPSI_PERCETAKAN`,`RINGKASAN_PERCETAKAN`) values 
(1,1,'Percetakan admin','asdfasdf','555','xdxd','asdfasdfasdfasdf','qwerqwer');

/*Table structure for table `pesanan_album` */

DROP TABLE IF EXISTS `pesanan_album`;

CREATE TABLE `pesanan_album` (
  `ID_PESANAN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ANGGOTA` int(11) NOT NULL,
  `ID_ALBUM` int(11) NOT NULL,
  `JUMLAH_TAGIHAN` int(11) NOT NULL,
  `TANGGAL_LUNAS` date DEFAULT NULL,
  `TANGGAL_KIRIM` date DEFAULT NULL,
  `TANGGAL_TERIMA` date DEFAULT NULL,
  PRIMARY KEY (`ID_PESANAN`),
  KEY `FK_PESANAN__RELATIONS_ANGGOTA_` (`ID_ANGGOTA`),
  KEY `FK_PESANAN__RELATIONS_ALBUM` (`ID_ALBUM`),
  CONSTRAINT `FK_PESANAN__RELATIONS_ALBUM` FOREIGN KEY (`ID_ALBUM`) REFERENCES `album` (`ID_ALBUM`),
  CONSTRAINT `FK_PESANAN__RELATIONS_ANGGOTA_` FOREIGN KEY (`ID_ANGGOTA`) REFERENCES `anggota_grup` (`ID_ANGGOTA_GRUP`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `pesanan_album` */

insert  into `pesanan_album`(`ID_PESANAN`,`ID_ANGGOTA`,`ID_ALBUM`,`JUMLAH_TAGIHAN`,`TANGGAL_LUNAS`,`TANGGAL_KIRIM`,`TANGGAL_TERIMA`) values 
(1,10,13,0,NULL,NULL,NULL),
(2,10,12,0,NULL,NULL,NULL),
(3,1,1,0,NULL,NULL,NULL),
(4,18,16,0,NULL,NULL,NULL),
(5,19,19,0,NULL,NULL,NULL);

/*Table structure for table `template_halaman` */

DROP TABLE IF EXISTS `template_halaman`;

CREATE TABLE `template_halaman` (
  `ID_TEMPLATE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_GRUP_TEMPLATE` int(11) DEFAULT NULL,
  `NAMA_TEMPLATE` varchar(20) NOT NULL,
  `JUMLAH_FOTO` int(11) NOT NULL,
  `URL_TEMPLATE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_TEMPLATE`),
  KEY `FK_TEMPLATE_RELATIONS_GRUP_TEM` (`ID_GRUP_TEMPLATE`),
  CONSTRAINT `FK_TEMPLATE_RELATIONS_GRUP_TEM` FOREIGN KEY (`ID_GRUP_TEMPLATE`) REFERENCES `grup_template` (`ID_GRUP_TEMPLATE`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `template_halaman` */

insert  into `template_halaman`(`ID_TEMPLATE`,`ID_GRUP_TEMPLATE`,`NAMA_TEMPLATE`,`JUMLAH_FOTO`,`URL_TEMPLATE`) values 
(1,1,'Dania 1',4,'assets/templates/1/dania-1');

/*Table structure for table `travel` */

DROP TABLE IF EXISTS `travel`;

CREATE TABLE `travel` (
  `ID_TRAVEL` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PENGGUNA` int(11) NOT NULL,
  `NAMA_TRAVEL` varchar(50) NOT NULL,
  `ALAMAT_TRAVEL` varchar(255) NOT NULL,
  `TELEPON_TRAVEL` varchar(20) NOT NULL,
  `EMAIL_TRAVEL` varchar(255) DEFAULT NULL,
  `DESKRIPSI_TRAVEL` varchar(1024) DEFAULT NULL,
  `RINGKASAN_TRAVEL` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_TRAVEL`),
  UNIQUE KEY `AK_IDENTIFIER_2` (`NAMA_TRAVEL`),
  KEY `FK_TRAVEL_RELATIONS_AKUN` (`ID_PENGGUNA`),
  CONSTRAINT `FK_TRAVEL_RELATIONS_AKUN` FOREIGN KEY (`ID_PENGGUNA`) REFERENCES `akun` (`ID_PENGGUNA`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `travel` */

insert  into `travel`(`ID_TRAVEL`,`ID_PENGGUNA`,`NAMA_TRAVEL`,`ALAMAT_TRAVEL`,`TELEPON_TRAVEL`,`EMAIL_TRAVEL`,`DESKRIPSI_TRAVEL`,`RINGKASAN_TRAVEL`) values 
(1,1,'Admin travel','asdfasdf','12341234','zxcvzxcv','asdfasfasdfas','dfasasfdasdf');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

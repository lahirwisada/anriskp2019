/*
SQLyog Ultimate v13.1.1 (32 bit)
MySQL - 5.7.27-0ubuntu0.18.04.1 : Database - db_arsiparis
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `backbone_coremodul` */

DROP TABLE IF EXISTS `backbone_coremodul`;

CREATE TABLE `backbone_coremodul` (
  `id_coremodul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_coremodul` varchar(300) DEFAULT NULL,
  `deskripsi_coremodul` tinytext,
  `created_date` datetime DEFAULT NULL,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_coremodul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `backbone_coremodul` */

/*Table structure for table `backbone_modul` */

DROP TABLE IF EXISTS `backbone_modul`;

CREATE TABLE `backbone_modul` (
  `id_modul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(300) DEFAULT NULL,
  `deskripsi_modul` tinytext,
  `turunan_dari` tinytext,
  `no_urut` int(11) DEFAULT NULL,
  `show_on_menu` tinyint(4) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_modul`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `backbone_modul` */

insert  into `backbone_modul`(`id_modul`,`nama_modul`,`deskripsi_modul`,`turunan_dari`,`no_urut`,`show_on_menu`,`created_date`,`created_by`,`modified_date`,`modified_by`,`record_active`) values 
(1,'system','Sistem','',90000,1,'2019-10-14 00:00:00','',NULL,NULL,NULL),
(2,'modul','Modul','system',90001,1,'2019-10-14 00:00:00','',NULL,NULL,NULL),
(3,'role','Role','system',90002,1,'2019-10-14 00:00:00','',NULL,NULL,NULL),
(4,'member','Users','system',90003,1,'2019-10-14 00:00:00','',NULL,NULL,NULL),
(5,'skp','Sasaran Kerja Pegawai','',100,1,'2019-10-15 00:00:00','','2019-10-15 00:00:00','',1),
(6,'rskp','Realisasi SKP','',200,1,'2019-10-15 00:00:00','',NULL,NULL,1),
(7,'pskp','Penilaian SKP','',300,1,'2019-10-15 00:00:00','',NULL,NULL,1),
(8,'pperilaku','Penilaian Perilaku','',400,1,'2019-10-15 00:00:00','',NULL,NULL,1),
(9,'master','Master','',80000,1,'2019-10-15 00:00:00','',NULL,NULL,1),
(10,'master-dupnk','DUPNK','master',80001,1,'2019-10-15 00:00:00','',NULL,NULL,1);

/*Table structure for table `backbone_modul_role` */

DROP TABLE IF EXISTS `backbone_modul_role`;

CREATE TABLE `backbone_modul_role` (
  `id_module_role` mediumint(9) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) DEFAULT NULL,
  `id_modul` int(11) DEFAULT NULL,
  `is_read` tinyint(4) DEFAULT '1',
  `is_write` tinyint(4) DEFAULT '1',
  `is_update` tinyint(4) DEFAULT '1',
  `is_delete` tinyint(4) DEFAULT '0',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_module_role`),
  KEY `fk_backbone_modul_role_backbone_modul` (`id_modul`),
  KEY `fk_backbone_modul_role_backbone_role` (`id_role`),
  CONSTRAINT `fk_backbone_modul_role_backbone_modul` FOREIGN KEY (`id_modul`) REFERENCES `backbone_modul` (`id_modul`),
  CONSTRAINT `fk_backbone_modul_role_backbone_role` FOREIGN KEY (`id_role`) REFERENCES `backbone_role` (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `backbone_modul_role` */

insert  into `backbone_modul_role`(`id_module_role`,`id_role`,`id_modul`,`is_read`,`is_write`,`is_update`,`is_delete`,`created_date`,`created_by`,`modified_date`,`modified_by`,`record_active`) values 
(7,1,1,1,1,1,1,'2019-10-15 09:27:09','Admin','2019-10-15 09:27:09','Admin',1),
(8,1,2,1,1,1,1,'2019-10-15 09:27:09','Admin','2019-10-15 09:27:09','Admin',1),
(9,1,3,1,1,1,1,'2019-10-15 09:27:09','Admin','2019-10-15 09:27:09','Admin',1),
(10,1,4,1,1,1,1,'2019-10-15 09:27:09','Admin','2019-10-15 09:27:09','Admin',1);

/*Table structure for table `backbone_profil` */

DROP TABLE IF EXISTS `backbone_profil`;

CREATE TABLE `backbone_profil` (
  `id_profil` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `nama_profil` varchar(200) DEFAULT NULL,
  `email_profil` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_profil`),
  KEY `fk_backbone_profil_backbone_user` (`id_user`),
  CONSTRAINT `fk_backbone_profil_backbone_user` FOREIGN KEY (`id_user`) REFERENCES `backbone_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `backbone_profil` */

insert  into `backbone_profil`(`id_profil`,`id_user`,`nama_profil`,`email_profil`,`created_date`,`created_by`,`modified_date`,`modified_by`,`record_active`) values 
(1,1,'Administrator',NULL,'2019-10-14 17:14:54',NULL,NULL,NULL,1),
(2,2,'Admin',NULL,'2019-10-14 17:15:02',NULL,NULL,NULL,1),
(3,3,'Tester',NULL,'2019-10-14 17:15:10',NULL,NULL,NULL,1),
(4,4,'Tester Sekretaris',NULL,'2019-10-14 17:15:24',NULL,NULL,NULL,1),
(5,5,'Tester Penilai',NULL,'2019-10-14 17:15:34',NULL,NULL,NULL,1),
(6,6,'Tester Arsiparis 1',NULL,'2019-10-14 17:15:45',NULL,NULL,NULL,1);

/*Table structure for table `backbone_role` */

DROP TABLE IF EXISTS `backbone_role`;

CREATE TABLE `backbone_role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nama_role` varchar(100) DEFAULT NULL,
  `is_public_role` tinyint(4) DEFAULT '1',
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `backbone_role` */

insert  into `backbone_role`(`id_role`,`nama_role`,`is_public_role`,`created_date`,`created_by`,`modified_date`,`modified_by`,`record_active`) values 
(1,'admin',0,'2019-10-14 08:35:17',NULL,'2019-10-15 00:00:00','',1),
(2,'sekretaris',1,'2019-10-14 08:35:38',NULL,NULL,NULL,1),
(3,'penilai',1,'2019-10-14 08:35:44',NULL,NULL,NULL,1),
(4,'arsiparis',1,'2019-10-14 08:35:54',NULL,NULL,NULL,1),
(5,'tester',1,'2019-10-14 10:10:57',NULL,NULL,NULL,1);

/*Table structure for table `backbone_user` */

DROP TABLE IF EXISTS `backbone_user`;

CREATE TABLE `backbone_user` (
  `id_user` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(80) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_ip` varchar(25) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `backbone_user` */

insert  into `backbone_user`(`id_user`,`username`,`password`,`last_login`,`last_ip`,`created_date`,`created_by`,`modified_date`,`modified_by`,`record_active`) values 
(1,'administrator','83bbf9a6787dd9e6e83994356f6d15fe::5OTR4Gc6kMA3iyRq',NULL,NULL,'2019-10-14 10:09:11',NULL,NULL,NULL,1),
(2,'admin','a0520e116363eee86e84cb2ac15948d4::z5xwIbxA49s6FVe1',NULL,NULL,'2019-10-14 10:09:14',NULL,NULL,NULL,1),
(3,'tester','9ae3a64d99d0fdeb703f35f2cb0d7c8b::jKMg5g5PNn0WoQRM',NULL,NULL,'2019-10-14 10:09:16',NULL,NULL,NULL,1),
(4,'testersekretaris','2bfd8762f070886e79d3d6af9af848b3::JeOhXsV9I1dgTMse',NULL,NULL,'2019-10-14 10:13:00',NULL,NULL,NULL,1),
(5,'testerpenilai','ad044a60f85da99d7fdc1ea54e28b659::R2kTHIPuH4HCEPZF',NULL,NULL,'2019-10-14 10:13:32',NULL,NULL,NULL,1),
(6,'testerarsiparis','75dd25ea9099e0e78d3407b46e8d747a::PwAe5CSBW5Q9IpeC',NULL,NULL,'2019-10-14 10:13:56',NULL,NULL,NULL,1);

/*Table structure for table `backbone_user_role` */

DROP TABLE IF EXISTS `backbone_user_role`;

CREATE TABLE `backbone_user_role` (
  `id_user_role` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_user_role`),
  KEY `fk_backbone_user_role_backbone_role` (`id_role`),
  KEY `fk_backbone_user_role_backbone_user` (`id_user`),
  CONSTRAINT `fk_backbone_user_role_backbone_role` FOREIGN KEY (`id_role`) REFERENCES `backbone_role` (`id_role`),
  CONSTRAINT `fk_backbone_user_role_backbone_user` FOREIGN KEY (`id_user`) REFERENCES `backbone_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `backbone_user_role` */

insert  into `backbone_user_role`(`id_user_role`,`id_user`,`id_role`,`created_date`,`created_by`,`modified_date`,`modified_by`,`record_active`) values 
(1,1,1,'2019-10-14 10:11:20',NULL,NULL,NULL,1),
(2,2,1,'2019-10-14 10:11:30',NULL,NULL,NULL,1),
(3,4,2,'2019-10-14 10:15:11',NULL,NULL,NULL,1),
(4,5,3,'2019-10-14 10:15:21',NULL,NULL,NULL,1),
(6,3,5,'2019-10-14 21:39:15','Admin',NULL,NULL,1),
(7,6,4,'2019-10-14 21:39:37','Admin',NULL,NULL,1);

/*Table structure for table `ci_sessions` */

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ci_sessions` */

/*Table structure for table `master_dupnk` */

DROP TABLE IF EXISTS `master_dupnk`;

CREATE TABLE `master_dupnk` (
  `id_dupnk` bigint(20) NOT NULL AUTO_INCREMENT,
  `kode_nomor` decimal(10,0) DEFAULT NULL COMMENT 'sebagai acuan turunan',
  `no_dupnk` int(11) DEFAULT NULL COMMENT 'yg ditampilkan jika di print',
  `deskripsi_dupnk` varchar(1000) DEFAULT NULL,
  `turunan_dari` decimal(10,0) DEFAULT NULL COMMENT 'jika ada turunan maka ditulis berdasarkan kode_nomor',
  `no_urut` int(11) DEFAULT '1',
  `jabfungsional` enum('mahir','muda','penyelia','pertama','terampil') DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_dupnk`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `master_dupnk` */

insert  into `master_dupnk`(`id_dupnk`,`kode_nomor`,`no_dupnk`,`deskripsi_dupnk`,`turunan_dari`,`no_urut`,`jabfungsional`,`created_date`,`created_by`,`modified_date`,`modified_by`,`record_active`) values 
(1,10000,NULL,'Tugas Pokok',NULL,1,'muda','2019-10-14 08:57:42',NULL,NULL,NULL,1),
(2,11000,NULL,'Pengelolaan Arsip Dinamis',10000,1,'muda','2019-10-14 08:57:43',NULL,NULL,NULL,1),
(3,11100,NULL,'Melakukan Identifikasi, Verifikasi, dan penyusunan daftar salinan autentik dari naskah asli arsip terjaga',11000,1,'muda','2019-10-14 08:57:41',NULL,NULL,NULL,1),
(4,11200,NULL,'Melakukan identifikasi, penilaian dan verifikasi serta menyusun Daftar Arsip yang akan dimusnahkan',11000,2,'muda','2019-10-14 08:57:40',NULL,NULL,NULL,1),
(5,11210,NULL,'menilai arsip inaktif yang akan dimusnahkan',11200,1,'muda','2019-10-14 08:57:39',NULL,NULL,NULL,1),
(6,11300,NULL,'Melakukan identifikasi, penilaian, dan verifikasi arsip dalam rangka penyerahan arsip statis',11000,3,'muda','2019-10-14 08:57:39',NULL,NULL,NULL,1),
(7,11310,NULL,'Menilai arsip inaktif yang akan diserahkan',11300,1,'muda','2019-10-14 08:57:38',NULL,NULL,NULL,1),
(8,11400,NULL,'Memberikan pelayanan penggunaan arsip dinamis',11000,4,'muda','2019-10-14 08:57:37',NULL,NULL,NULL,1),
(9,11410,NULL,'Memberikan pelayanan dan penggunaan arsip terjaga',11400,1,'muda','2019-10-14 08:57:35',NULL,NULL,NULL,1);

/*Table structure for table `master_pegawai` */

DROP TABLE IF EXISTS `master_pegawai`;

CREATE TABLE `master_pegawai` (
  `id_pegawai` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) DEFAULT NULL,
  `id_penilai` bigint(20) DEFAULT NULL,
  `pegawai_nip` varchar(20) DEFAULT NULL,
  `pegawai_nama` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_pegawai`),
  KEY `fk_bk_user_ms_peg_id_user` (`id_user`),
  KEY `fk_bk_user_ms_peg_id_penilai` (`id_penilai`),
  CONSTRAINT `fk_bk_user_ms_peg_id_penilai` FOREIGN KEY (`id_penilai`) REFERENCES `backbone_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bk_user_ms_peg_id_user` FOREIGN KEY (`id_user`) REFERENCES `backbone_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `master_pegawai` */

/*Table structure for table `master_rekomendasi` */

DROP TABLE IF EXISTS `master_rekomendasi`;

CREATE TABLE `master_rekomendasi` (
  `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT,
  `uraian_rekomendasi` varchar(3000) DEFAULT NULL,
  `keyword` varchar(200) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_rekomendasi`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `master_rekomendasi` */

insert  into `master_rekomendasi`(`id_rekomendasi`,`uraian_rekomendasi`,`keyword`,`created_date`,`created_by`,`modified_date`,`modified_by`,`record_active`) values 
(1,'Dapat dipertimbangkan untuk alih jabatan Arsiparis Ahli Pertama setelah lulus uji kompetensi yang dipersyaratkan.','alih jabatan arsiparis ahli pertama','2019-10-14 09:01:19',NULL,NULL,NULL,NULL),
(2,'Dapat dipertimbangkan untuk alih jabatan Arsiparis Ahli Muda setelah lulus uji kompetensi yang dipersyaratkan.','alih jabatan arsiparis ahli muda','2019-10-14 09:02:48',NULL,NULL,NULL,1),
(3,'Dapat dipertimbangkan untuk kenaikan pangkat/golongan ruang, Pengatur Tk. I, II/d.','naik pangkat, pengatur tk I, II/d','2019-10-14 09:04:43',NULL,NULL,NULL,1),
(4,'Dapat dipertimbangkan untuk kenaikan pangkat/golongan ruang, Penata Muda, III/a.','naik pangkat, penata muda, III/a','2019-10-14 09:05:37',NULL,NULL,NULL,1),
(5,'Dapat dipertimbangkan untuk kenaikan pangkat/golongan ruang, Penata Muda Tk. I, III/b.','naik pangkat, penata muda tk I, III/b','2019-10-14 09:06:42',NULL,NULL,NULL,1),
(6,'Dapat dipertimbangkan untuk kenaikan pangkat/golongan ruang, Penata, III/c.','naik pangkat, penata, III/c','2019-10-14 09:07:07',NULL,NULL,NULL,1);

/*Table structure for table `tr_angka_kredit_tahunan` */

DROP TABLE IF EXISTS `tr_angka_kredit_tahunan`;

CREATE TABLE `tr_angka_kredit_tahunan` (
  `id_akt` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint(20) DEFAULT NULL,
  `tahun` tinyint(4) DEFAULT NULL,
  `jabfungsional` enum('mahir','muda','penyelia','pertama','terampil') DEFAULT 'muda',
  `tmtjab` datetime DEFAULT NULL,
  `pangkatgol` varchar(30) DEFAULT NULL,
  `tmtpangkatgol` datetime DEFAULT NULL,
  `unitkerja` varchar(200) DEFAULT NULL,
  `idunitkerja` bigint(20) DEFAULT NULL,
  `nilaikinerja` decimal(10,0) DEFAULT '0',
  `akt` decimal(10,0) DEFAULT '0',
  `akk` decimal(10,0) DEFAULT '0',
  `id_rekomendasi` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_akt`),
  KEY `fk_mspeg_tr_akt_id_peg` (`id_pegawai`),
  KEY `fk_ms_rekom_tr_akt_id_rekom` (`id_rekomendasi`),
  CONSTRAINT `fk_ms_rekom_tr_akt_id_rekom` FOREIGN KEY (`id_rekomendasi`) REFERENCES `master_rekomendasi` (`id_rekomendasi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_mspeg_tr_akt_id_peg` FOREIGN KEY (`id_pegawai`) REFERENCES `master_pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tr_angka_kredit_tahunan` */

/*Table structure for table `tr_skp_tahunan` */

DROP TABLE IF EXISTS `tr_skp_tahunan`;

CREATE TABLE `tr_skp_tahunan` (
  `id_skpt` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pegawai` bigint(20) DEFAULT NULL,
  `skpt_tahun` tinyint(4) DEFAULT NULL,
  `id_dupnk` bigint(20) DEFAULT NULL,
  `skpt_waktu` tinyint(4) DEFAULT NULL,
  `skpt_kuantitas` tinyint(4) DEFAULT NULL,
  `skpt_kualitas` tinyint(100) DEFAULT NULL,
  `skpt_kredit` tinyint(4) DEFAULT NULL,
  `skpt_biaya` decimal(10,0) DEFAULT NULL,
  `skpt_status` tinyint(4) DEFAULT NULL,
  `skpt_output` tinyint(4) DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(200) DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` varchar(200) DEFAULT NULL,
  `record_active` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_skpt`),
  KEY `fk_ms_pegawai_tr_skpt_id_pegawai` (`id_pegawai`),
  KEY `fk_ms_dupnk_tr_skpt_id_dupnk` (`id_dupnk`),
  CONSTRAINT `fk_ms_dupnk_tr_skpt_id_dupnk` FOREIGN KEY (`id_dupnk`) REFERENCES `master_dupnk` (`id_dupnk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ms_pegawai_tr_skpt_id_pegawai` FOREIGN KEY (`id_pegawai`) REFERENCES `master_pegawai` (`id_pegawai`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tr_skp_tahunan` */

/* Procedure structure for procedure `fnSelectModulAccessRuleByModulNameAndRoleName` */

/*!50003 DROP PROCEDURE IF EXISTS  `fnSelectModulAccessRuleByModulNameAndRoleName` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`lahir`@`%` PROCEDURE `fnSelectModulAccessRuleByModulNameAndRoleName`(IN i_modul_name VARCHAR(300), IN i_id_user INTEGER)
BEGIN

DECLARE var_id_role INT DEFAULT 0;

 

SELECT backbone_modul_role.`id_module_role`,

backbone_modul_role.`is_read`,

backbone_modul_role.`is_write`,

backbone_modul_role.`is_delete`,

backbone_modul_role.`is_update`,

backbone_modul.`nama_modul`,

backbone_modul.`deskripsi_modul`,

backbone_role.`nama_role`,

backbone_user.`username`,

backbone_profil.`nama_profil`

FROM backbone_modul_role

JOIN backbone_modul ON backbone_modul.`id_modul` = backbone_modul_role.`id_modul` AND backbone_modul.`record_active` = '1'

JOIN backbone_role ON backbone_role.`id_role` = backbone_modul_role.`id_role` AND backbone_role.`record_active` = '1'

JOIN backbone_user_role ON backbone_user_role.`id_role` = backbone_role.`id_role` AND backbone_user_role.`record_active` = '1'

JOIN backbone_user ON backbone_user.`id_user` = backbone_user_role.`id_user` AND backbone_user.`id_user` = i_id_user

JOIN backbone_profil ON backbone_profil.id_user = backbone_user.id_user AND backbone_profil.`record_active` = '1'

WHERE backbone_modul.`nama_modul` = i_modul_name AND backbone_modul_role.`record_active` = '1'; 

    END */$$
DELIMITER ;

/*Table structure for table `v_user` */

DROP TABLE IF EXISTS `v_user`;

/*!50001 DROP VIEW IF EXISTS `v_user` */;
/*!50001 DROP TABLE IF EXISTS `v_user` */;

/*!50001 CREATE TABLE  `v_user`(
 `id_user` bigint(20) ,
 `username` varchar(60) ,
 `record_active` tinyint(4) ,
 `id_profil` bigint(20) ,
 `nama_profil` varchar(200) ,
 `email_profil` varchar(100) 
)*/;

/*View structure for view v_user */

/*!50001 DROP TABLE IF EXISTS `v_user` */;
/*!50001 DROP VIEW IF EXISTS `v_user` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`lahir`@`%` SQL SECURITY DEFINER VIEW `v_user` AS select `backbone_user`.`id_user` AS `id_user`,`backbone_user`.`username` AS `username`,`backbone_user`.`record_active` AS `record_active`,`backbone_profil`.`id_profil` AS `id_profil`,`backbone_profil`.`nama_profil` AS `nama_profil`,`backbone_profil`.`email_profil` AS `email_profil` from (`backbone_user` join `backbone_profil` on((`backbone_profil`.`id_user` = `backbone_user`.`id_user`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

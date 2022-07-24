/*
MySQL Backup
Source Server Version: 5.1.31
Source Database: beni
Date: 7/24/2022 21:47:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `advokasi`
-- ----------------------------
DROP TABLE IF EXISTS `advokasi`;
CREATE TABLE `advokasi` (
  `id_advokasi` int(11) NOT NULL DEFAULT '0',
  `advokasi` text,
  `id_aspirasi` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_advokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `aspirasi`
-- ----------------------------
DROP TABLE IF EXISTS `aspirasi`;
CREATE TABLE `aspirasi` (
  `id_aspirasi` int(11) NOT NULL DEFAULT '0',
  `aspirasi` text,
  `id_kategori` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_aspirasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `kategori`
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT NULL,
  `bidang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `mahasiswa`
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `id_mahasiswa` int(11) NOT NULL DEFAULT '0',
  `id_user` int(11) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `jenis_kelamin` enum('perempuan','laki') DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL DEFAULT '0',
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `role` enum('mahasiswa','bem','dpm') DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `advokasi` VALUES ('1','turun sebesar 10%','1','Jadwal-Pembawa-Takjil-thn-2022.pdf'), ('2','materi akan di share berupa file','4','20220208_120771507_SJURWH_id.pdf');
INSERT INTO `aspirasi` VALUES ('1','turunin spp','2','2','Selesai'), ('2','dosen jng telat','1','2','Selesai'), ('3','kurangin tugas kuliah','1','1','Selesai'), ('4','materi dosen harus bisa di share kepada mahasiswa','1','3','Selesai'), ('5','test 1','2','3','Selesai'), ('6','test 2','1','3','Selesai'), ('7','test 3','2','3','Selesai'), ('8','test 4','1','3','Selesai'), ('9','test 5','1','1','Selesai'), ('10','test 6','2','1','Selesai'), ('11','test 7','3','1','Selesai'), ('12','test 8','4','1','Selesai'), ('13','test 9','3','1','Selesai'), ('14','test 11','3','2','Selesai'), ('15','test 12','4','2','Selesai'), ('16','test 13','2','2','Selesai'), ('17','test 10\r\n','4','4','Selesai'), ('18','test 14','4','4','Selesai'), ('19','test 15','2','4','Selesai');
INSERT INTO `kategori` VALUES ('1','WAKA 1','Akademik'), ('2','WAKA 2','Keuangan'), ('3','WAKA 3','Kemahasiswaan'), ('4','WAKA 4','Pengembangan SI');
INSERT INTO `mahasiswa` VALUES ('1','3','Beni Akakom','1926177251','S1 - Sistem Informasi','beni@mail.com','62712835216','laki'), ('2','4','Ricky Rodesta','155610006','S1 - Sistem Informasi','ricky@mail.com','82163712348','laki'), ('3','5','Urip Akakom','175846662','S1 - Teknik Komputer','urip@gmail.com','82123945341','laki'), ('4','6','Dita','155612292','D3 - Rekayasa Perangkat Lunak Aplikasi','dita@mail.com','82162371234','perempuan');
INSERT INTO `user` VALUES ('1','dpm','dpm','dpm','Dewan Perwakilan Mahasiswa'), ('2','bem','bem','bem','Badan Eksekutif Mahasiswa'), ('3','beni','beni','mahasiswa',NULL), ('4','ricky','ricky','mahasiswa',NULL), ('5','urip','urip','mahasiswa',NULL), ('6','dita','dita','mahasiswa',NULL);

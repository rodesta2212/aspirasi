/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50131
Source Host           : localhost:3306
Source Database       : beni

Target Server Type    : MYSQL
Target Server Version : 50131
File Encoding         : 65001

Date: 2022-07-06 14:57:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `advokasi`
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
-- Records of advokasi
-- ----------------------------
INSERT INTO `advokasi` VALUES ('1', 'turun sebesar 10%', '1', 'Jadwal-Pembawa-Takjil-thn-2022.pdf');

-- ----------------------------
-- Table structure for `aspirasi`
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
-- Records of aspirasi
-- ----------------------------
INSERT INTO `aspirasi` VALUES ('1', 'turunin spp', '2', '2', 'Selesai');
INSERT INTO `aspirasi` VALUES ('2', 'dosen jng telat', '1', '2', 'Terverifikasi');
INSERT INTO `aspirasi` VALUES ('3', 'kurangin tugas kuliah', '1', '1', 'Menunggu Verifikasi');

-- ----------------------------
-- Table structure for `kategori`
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(255) DEFAULT NULL,
  `bidang` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES ('1', 'WAKA 1', 'Akademik');
INSERT INTO `kategori` VALUES ('2', 'WAKA 2', 'Keuangan');

-- ----------------------------
-- Table structure for `mahasiswa`
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
-- Records of mahasiswa
-- ----------------------------
INSERT INTO `mahasiswa` VALUES ('1', '3', 'Beni Akakom', '1926177251', 'S1 - Sistem Informasi', 'beni@mail.com', '62712835216', 'laki');
INSERT INTO `mahasiswa` VALUES ('2', '4', 'Ricky Rodesta', '155610006', 'S1 - Sistem Informasi', 'ricky@mail.com', '82163712348', 'laki');

-- ----------------------------
-- Table structure for `user`
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
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'dpm', 'dpm', 'dpm', 'Badan Perwakilan Mahasiswa');
INSERT INTO `user` VALUES ('2', 'bem', 'bem', 'bem', 'Badan Eksekutif Mahasiswa');
INSERT INTO `user` VALUES ('3', 'beni', 'beni', 'mahasiswa', null);
INSERT INTO `user` VALUES ('4', 'ricky', 'ricky', 'mahasiswa', null);

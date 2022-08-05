<?php

    include("config.php");
    include_once('includes/aspirasi.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $Aspirasi = new Aspirasi($db);
    $Aspirasi->id_aspirasi = $id;
	$Aspirasi->readOne();

    // post aspirasi
	$Aspirasi->id_aspirasi = $Aspirasi->id_aspirasi;
    $Aspirasi->aspirasi = $Aspirasi->aspirasi;
    $Aspirasi->id_kategori = $Aspirasi->id_kategori;
    $Aspirasi->id_mahasiswa = $Aspirasi->id_mahasiswa;
	$Aspirasi->status = "Ditolak";

    if($Aspirasi->update()){
        echo "<script>alert('Aspirasi Telah Ditolak');location.href='aspirasi.php';</script>";
    } else{
        echo "<script>alert('Gagal Kirim Data');location.href='aspirasi.php';</script>";
    }

?>

<?php

    include("config.php");
    include_once('includes/aspirasi.inc.php');

    session_start();
        if (!isset($_SESSION['id_user'])) echo "<script>location.href='login.php'</script>";
    $config = new Config(); $db = $config->getConnection();

    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    $Aspirasi = new Aspirasi($db);
    $Aspirasi->id_aspirasi = $id;

    if($Aspirasi->delete()){
        echo "<script>location.href='aspirasi.php';</script>";
    } else{
        echo "<script>alert('Gagal Hapus Data');location.href='aspirasi.php';</script>";
    }

?>

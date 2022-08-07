<?php
    include("config.php");
    include_once('includes/webservice.inc.php');

    $config = new Config(); $db = $config->getConnection();
    $webservice = new Webservice($db);
    $data = $webservice->LaporanPerkategori();

    // Menampilkan Data Web Service berupa json
    print('<pre>');
    print_r($data);
?>
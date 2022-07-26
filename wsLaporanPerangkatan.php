<?php
    include("config.php");
    include_once('includes/webservice.inc.php');

    $config = new Config(); $db = $config->getConnection();
    $webservice = new Webservice($db);
    $data = $webservice->LaporanPerangkatan();
    print('<pre>');print_r($data);
?>
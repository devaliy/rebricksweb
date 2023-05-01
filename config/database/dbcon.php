<?php
    // $servername = "mysql:host=localhost; dbname=redbrick";
    // $username = "root";
    // $password = "";

     $servername = "mysql:host=localhost; dbname=tadsengi_redbricks";
    $username = "tadsengi_ali";
    $password = "FuTa@(2017)";
    
    try{

        $pdo = new PDO($servername, $username, $password);

    }catch(PDOException $e){

        echo 'Connection error'. $e->getMessage();
        
    }
?>
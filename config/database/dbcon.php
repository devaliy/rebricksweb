<?php
    // $servername = "mysql:host=localhost; dbname=redbrick";
    // $username = "root";
    // $password = "";

     $servername = "mysql:host=localhost; dbname=farmasng_redbricks";
    $username = "farmasng_ali";
    $password = "FuTa@(2017)";
    
    try{

        $pdo = new PDO($servername, $username, $password);

    }catch(PDOException $e){

        echo 'Connection error'. $e->getMessage();
        
    }
?>
<?php
    // $servername = "mysql:host=localhost; dbname=alisam";
    // $username = "root";
    // $password = "";

   // $servername = "mysql:host=lagosulearn.cqusbzcbfvv2.us-east-2.rds.amazonaws.com; dbname=lagos_ulearn_db";
    $servername = "mysql:host=localhost; dbname=farmasng_redbricks";
    $username = "farmasng_ali";
    $password = "FuTa@(2017)";
    
    try{

        $pdo = new PDO($servername, $username, $password);

    }catch(PDOException $e){

        echo 'Connection error'. $e->getMessage();
        
    }
?>
<?php
    @session_start();
    include('configuration.php');
  
require_once('classes/Generic.php');
 
require_once('classes/Exam.php');
//var_dump($pdo);
$getFromGeneric  = new Generic($pdo);
$getFromExam  = new Exam($pdo);
    
   
?>
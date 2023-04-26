<?php 


global $pdo;
  
require_once('database/dbcon.php');
require_once('mail/class.smtp.php');
require_once('mail/class.phpmailer.php');

//require_once('autoload.php');


date_default_timezone_set('Africa/Lagos');

  @define("BASE_URL", "http://localhost/center/");
 // define("BASE_URL", "http://192.168.43.241/gtt/");
  

?>
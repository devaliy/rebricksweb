<?php
    /**
     * Database Connection
     */

     class DbConnect {
         private $server = 'localhost';
         private $dbname = 'farmasng_redbricks';
         private $user = 'farmasng_ali';
         private $pass = 'FuTa@(2017)';

         public function connect(){
             try{
                 $conn = new PDO('mysql:host='. $this->server .';dbname=' .$this->dbname, $this->user, $this->pass);
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 return $conn;

             } catch (\Exception $e){
                 echo "Database Error: " . $e->getMessage();
             }
         }

     }




?>
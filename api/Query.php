<?php

class  Query {
        
        public $pdo;
        public function __construct(){
            $db = new DbConnect;
            $this->pdo = $db->connect();

        }


    
        public function checkInput($var)
        {
            $var = htmlspecialchars($var);
            $var = trim($var);
            $var = stripcslashes($var);
            return $var;
        }
    
        
    
        public function get_count($table, $fields = array(), $sort, $order)
        {
            $columns = '';
            $i       = 1;
    
            foreach($fields as $name => $value){
                $columns .= "`{$name}` = :{$name}";
                 if($i < count($fields)){
                    $columns .= ' AND ';
                }
                $i++;
            }
            $sql = "SELECT * FROM {$table}  WHERE {$columns} ORDER BY $sort $order";
            if($stmt = $this->pdo->prepare($sql))
            {
                foreach($fields as $key => $value)
                {
                    $stmt->bindValue(':'.$key, $value);
                } 
                  $stmt->execute();
                  $count = $stmt->rowCount();
           // $single = $stmt->fetch(PDO::FETCH_OBJ);
            }
            return $count; 
        }
    
        public function get_single($table, $fields = array(), $sort, $order)
        {
            $columns = '';
            $i       = 1;
    
            foreach($fields as $name => $value){
                $columns .= "`{$name}` = :{$name}";
                 if($i < count($fields)){
                    $columns .= ' AND ';
                }
                $i++;
            }
            $sql = "SELECT * FROM {$table}  WHERE {$columns} ORDER BY $sort $order";
            if($stmt = $this->pdo->prepare($sql))
            {
                foreach($fields as $key => $value)
                {
                    $stmt->bindValue(':'.$key, $value);
                } 
                  $stmt->execute();
            $single = $stmt->fetch(PDO::FETCH_OBJ);
            }
            return $single; 
        }
    
        
        public function get_multi($table, $fields = array(), $sort, $order)
        {
            $columns = '';
            $i       = 1;
            
            foreach($fields as $name => $value){
                $columns .= "`{$name}` = :{$name}";
                 if($i < count($fields)){
                    $columns .= ' AND ';
                }
                $i++;
            }
            $sql = "SELECT * FROM {$table}  WHERE {$columns} ORDER BY $sort $order";
            if($stmt = $this->pdo->prepare($sql))
            {
                foreach($fields as $key => $value)
                {
                    $stmt->bindValue(':'.$key, $value);
                } 
                  $stmt->execute();
            $single = $stmt->fetchAll(PDO::FETCH_OBJ);
            }
            return $single; 
        }
    
        
        public function get_All($table, $sort, $order)
        {
            $stmt = $this->pdo->prepare("SELECT * FROM $table ORDER BY `$sort` $order");
            $stmt->execute();
            $multi = $stmt->fetchAll(PDO::FETCH_OBJ);
        
            return $multi;
        }

    
    
     
        public function login($table, $fields = array())
        {
            $columns = '';
            $i       = 1;
    
            foreach($fields as $name => $value){
                $columns .= "`{$name}` = :{$name}";
                 if($i < count($fields)){
                    $columns .= ' AND ';
                }
                $i++;
            }
            $sql = "SELECT * FROM {$table}  WHERE {$columns} ";
            if($stmt = $this->pdo->prepare($sql)){
                foreach($fields as $key => $value){
                    $stmt->bindValue(':'.$key, $value);
                }
                $stmt->execute();
               
               $user = $stmt->fetch(PDO::FETCH_OBJ);
                $count = $stmt->rowCount();
    
                return $user;
              
        
            }
    
          /*  if($count>0){
              
                $_SESSION['staff_id'] = $user->id;
                $_SESSION['sname'] = $user->sname;
                $_SESSION['fname'] = $user->fname;
                $_SESSION['passport'] = $user->passport;
                $_SESSION['email'] = $user->email;
                header('Location: dashboard');
            }else{
                return false;
            }
            */
        }
    
    
            
        public function uploadImage($file)
        {
            $filename = basename($file['name']);
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $error = $file['error'];
            $original =  mt_rand(1111, 9999).$filename;
    
            $ext = explode('.', $filename);
            //$ext = strtolower($ext);
            $allowed_ext = array('jpg','png','jpeg','JPG','PNG','JPEG');
    
            if(in_array($ext, $allowed_ext) === false){
                if($error === 0){
                  //  if($fileSize <= 209272152){
                            $fileRoot ='../assets/images/'. $original;
                            $fileRoots =  $original;
                            move_uploaded_file($fileTmp, $fileRoot);
                            return $fileRoots;
    
                   // }
                }
            }
        }
    
        public function uploadDoc($file)
        {
            $filename = basename($file['name']);
            $fileTmp = $file['tmp_name'];
            $fileSize = $file['size'];
            $error = $file['error'];
            $original = mt_rand(1111, 9999).$filename;
    
            $ext = explode('.', $filename);
            //$ext = strtolower($ext);
            $allowed_ext = array('pdf','doc', 'docx', 'txt');
    
            if(in_array($ext, $allowed_ext) === false){
                if($error === 0){
                  //  if($fileSize <= 209272152){
                            $fileRoot ='../assets/documents/'. $original;
                            $fileRoots =  $original;
                            move_uploaded_file($fileTmp, $fileRoot);
                            return $fileRoots;
    
                   // }
                }
            }
        }
     
    
    
        public function create($table, $fields = array()){
                $columns = implode(',', array_keys($fields));
                $values  = ':'.implode(', :', array_keys($fields));
                $sql     = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
                if($stmt = $this->pdo->prepare($sql)){
                    foreach ($fields as $key => $data){
                        $stmt->bindValue(':'.$key, $data);
                    }
                    $stmt->execute();
                    return $this->pdo->lastInsertId();
                }
        }
        
        
     
    
        public function update($table, $where, $id, $fields = array()){
            $columns = '';
            $i       = 1;
    
            foreach($fields as $name => $value){
                $columns .= "`{$name}` = :{$name}";
                 if($i < count($fields)){
                    $columns .= ', ';
                }
                $i++;
            }
         $sql = "UPDATE {$table} SET {$columns} WHERE {$where} = {$id}";
            if($stmt = $this->pdo->prepare($sql)){
                foreach($fields as $key => $value){
                    $stmt->bindValue(':'.$key, $value);
                }
                //var_dump($sql);
              if($stmt->execute()){
                return true;
              }else{
                  return false;
              }
            }
        }
    
       
        public function update_act($days, $id, $student_id){
          
         //$sql = "UPDATE 'activation_code' SET expiry_date = expiry_date + 43 WHERE id = 1";
         $sql = "UPDATE activation_code SET expiry_date = DATE_ADD(expiry_date, INTERVAL $days DAY), used = used + 1, student_id = $student_id WHERE id = $id";
          $stmt = $this->pdo->prepare($sql);               
              
              if($stmt->execute()){
                return true;
              }else{
                  return false;
              }
            
        }
    
       
        public function delete($table, $array) {
            $sql = "DELETE FROM `{$table}`";
            $where = "WHERE ";
            foreach($array as $name=>$value){
                $sql.="{$where} `{$name}` = :{$name}";
                $where = " AND ";
            }
            if($stmt = $this->pdo->prepare($sql)){
                foreach($array as $name => $value){
                    $stmt->bindvalue(':'.$name, $value);
                }
                $excex = $stmt->execute();
                if($excex){
                    return true;
                }
            }
             
        }
    
        
        // function sendmail($to,$subject,$body){
        //     // include("class.phpmailer.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"
          
        //      $mail = new PHPMailer();
         
        //      $mail->IsSMTP();
        //      $mail->SMTPAuth = true;
         
        //      $mail->Host = "mail.gmail.com";
         
        //      $mail->Username = "antumsoft@gmail.com";
        //      $mail->Password = "AntumSoftware@(2021)"; 
         
        //      $mail->From = "antumsoft@gmail.com";
        //      $mail->FromName = "Smart Tester";
         
        //      $mail->AddAddress($to);
        //      $mail->AddCC("aliuadedigba@gmail.com");
        //     // $mail->AddCC("ali@chroniclesoft.com");
        //      //$mail->AddCC("tradeacademy@3timpex.com");
        //      $mail->Subject = $subject;
        //      $mail->Body = $body;
        //      $mail->WordWrap = 50;
        //      $mail->IsHTML(true);
        //      //$mail->SMTPSecure = 'tls';
        //      $mail->Port = 25;
        //      //$mail->SetLanguage('en', 'language/');
        //      $success=$mail->Send(); 
        //      return $success;
        // }
          
        

}
<?php
   class Generic {
        protected $pdo;

        function __construct($pdo){
            
            $this->pdo = $pdo;
    
        
        }  

    public function checkInput($var)
    {
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripcslashes($var);
        return $var;
    }

    

    public function get_All ($tables, $sort, $order){
        $stmt = $this->pdo->prepare("SELECT * FROM $tables ORDER BY $sort $order");
        $stmt->execute();
        $multi = $stmt->fetchAll(PDO::FETCH_OBJ);
      
        return $multi; 
    }
   
    public function get_current_tests($tables, $class_id, $sort, $order){
        $stmt = $this->pdo->prepare("SELECT * FROM $tables WHERE class_id = $class_id AND  NOW() > startingd AND NOW() < endingd ORDER BY $sort $order");
        $stmt->execute();
        $multi = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $multi; 

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

    public function get_single($table, $fields = array(), $sort='', $order='')
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

    public function get_student_with_class($school_id, $class_id){
        $stmt = $this->pdo->prepare("SELECT * FROM user inner join usergroup_rel_user on usergroup_rel_user.user_id = user.user_id where user.school_id = $school_id and usergroup_rel_user.usergroup_id=$class_id");
        
        $stmt->execute();
        $multi = $stmt->fetchAll(PDO::FETCH_OBJ);
      
        return $multi;
    }

    

    public function get_test_score($user_id){
        $stmt = $this->pdo->prepare("SELECT DISTINCT exam_id, student_id FROM student_exam_re where student_id = $user_id");        
        $stmt->execute();
        $multi = $stmt->fetchAll(PDO::FETCH_OBJ);
      
        return $multi;
    }


    public function get_student_classes($user_id){
        $stmt = $this->pdo->prepare("SELECT DISTINCT(usergroup_id) FROM usergroup_rel_user where user_id = $user_id");
        
        $stmt->execute();
        $multi = $stmt->fetchAll(PDO::FETCH_OBJ);
      
        return $multi;
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


      

       
 public function get_promotion($school_id, $class_id)
 {
     $stmt = $this->pdo->prepare("SELECT * FROM usergroup_rel_user inner join user on user.school_id=$school_id where usergroup_rel_user.usergroup_id=$class_id");
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
                        $fileRoot ='../assets/property_img/'. $original;
                        $fileRoots =  $original;
                        move_uploaded_file($fileTmp, $fileRoot);
                        return $fileRoots;

               // }
            }
        }
    }

    public function uploadDocXml($file)
    {
        $filename = basename($file['name']);
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $error = $file['error'];
        $original = mt_rand(1111, 9999).$filename;

        $ext = explode('.', $filename);
        //$ext = strtolower($ext);
        $allowed_ext = array('xml', 'docx', 'txt');

        if(in_array($ext, $allowed_ext) === false){
            if($error === 0){
              //  if($fileSize <= 209272152){
                        $fileRoot ='../assets/documents/'. $filename;
                        $fileRoots =  $filename;
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
        $allowed_ext = array('pdf','xml', 'docx', 'txt');

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
    
    
        

    public function updates($table, $checkid, $fields = array()) {
        $columns = '';
        $i = 1;

        foreach($fields as $name => $value) {
            $columns .= "`{$name}` = :{$name}";
            if($i < count($fields)) {
                $columns .= ', ';
            }
            $i++;
        }
        $sql = "UPDATE {$table} SET {$columns} WHERE `student_id` = {$checkid}";
        if($stmt = $this->pdo->prepare($sql)) {
            foreach($fields as $key => $value) {
                $stmt->bindValue(':'.$key, $value);
            }
            //var_dump($sql);
            $stmt -> execute();
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

    
    function sendmail($to,$subject,$body){
        // include("class.phpmailer.php"); //you have to upload class files "class.phpmailer.php" and "class.smtp.php"
      
         $mail = new PHPMailer();
     
         $mail->IsSMTP();
         $mail->SMTPAuth = true;
     
         $mail->Host = "mail.gmail.com";
     
         $mail->Username = "antumsoft@gmail.com";
         $mail->Password = "AntumSoftware@(2021)"; 
     
         $mail->From = "antumsoft@gmail.com";
         $mail->FromName = "Smart Tester";
     
         $mail->AddAddress($to);
         $mail->AddCC("aliuadedigba@gmail.com");
        // $mail->AddCC("ali@chroniclesoft.com");
         //$mail->AddCC("tradeacademy@3timpex.com");
         $mail->Subject = $subject;
         $mail->Body = $body;
         $mail->WordWrap = 50;
         $mail->IsHTML(true);
         //$mail->SMTPSecure = 'tls';
         $mail->Port = 25;
         //$mail->SetLanguage('en', 'language/');
         $success=$mail->Send(); 
         return $success;
     }
      
    }
?>

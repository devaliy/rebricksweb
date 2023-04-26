<?php
   class Student extends Generic {
        protected $pdo;

        function __construct($pdo){
            
            $this->pdo = $pdo;
    
        
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
        
        }
        

        public function get_rand_images($randImages){
            $stmt = $this->pdo->prepare("SELECT `subject_images` FROM subject_pics WHERE `subject_pics_id` = :randImages");
            $stmt->bindParam(":randImages", $randImages, PDO::PARAM_INT);
            $stmt->execute();
            $exam = $stmt->fetch(PDO::FETCH_OBJ);
            return $exam;
        }

        public function logout() {
            $_SESSION = array();
            session_destroy();
            header('Location: '.BASE_URL.'');
        }

        public function loggedIn() {
           if($_SESSION){
               return true;
           }else{
               return false;
           }
           
        }


        public function get_rand_quest($subject_id, $question_no){
            $stmt = $this->pdo->prepare("SELECT * FROM question WHERE `subject_id`= :id ORDER BY RAND() LIMIT $question_no");
            $stmt->bindParam(":id", $subject_id, PDO::PARAM_INT);
            $stmt->execute();
            $exam = $stmt->fetchAll(PDO::FETCH_OBJ);          
            return $exam; 
        }

    }
?>

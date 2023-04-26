<?php
   class Exam extends Generic {
        protected $pdo;

        private $questions = array();
        private $committed = true;
    

        function __construct($pdo){
            
            $this->pdo = $pdo;


    
        
        }
        public function XtractQuestion( $filePath,  $separator=".")
        {
            
            if (file_exists($filePath)) {
                $file = new SplFileObject($filePath);
                
                // Loop until we reach the end of the file.
                $currentType='';
                $question = '';
                $options = array();
                $ans = '';
                
                while (!$file->eof()) {
                    
                    $line = trim($file->fgets());
                    if (strlen($line)==0) {
                        continue;
                    }
                    $type_value = $this->check_type($line,$separator);
    
                    if ($type_value[0] =='q') {
                        if (!$this->committed) {
                            $this->commitQuiz($question,$options,$ans);
                            $question='';
                            $ans = '';
                            $options = [];
                            $currentType ='';
                        }
                        $this->committed = false;
                        $question = $type_value[1];
                        $currentType='q';
                    }
    
                    if ($type_value[0]=='o') {
                        array_push($options,$type_value[1]);
                        $currentType = 'o';
                    }
    
                    if ($type_value[0] =='a') {
                        $ans = $type_value[1];
                        if (!$this->committed) {
                            $this->commitQuiz($question,$options,$ans);
                        }
                        
                        $question='';
                        $ans = '';
                        $options = [];
                        $currentType ='';
                    }
                    
                    if ($type_value[0]=='x') {
                        if ($currentType=='q') {
                            $question .= ' '. $type_value[1];
                        }
                        if ($currentType=='o') {
                            $op = $options[count($options)-1];
                            $options[count($options)-1] = $op.' '.$type_value[1];
                        }
                    }
    
                }
                // Unset the file to call __destruct(), closing the file handle.
                $file = null;
    
                return $this->questions;
            }else{
                return false;
            }
        }
    
        private function check_type( $line,  $separator)
        {
            //Check if it is answer
            $answer_words = explode(':',$line); 
            if (strtolower(trim($answer_words[0]))=='ans') {
                return ['a',trim($answer_words[1])];
            }
            $words = preg_split('/[\ \n\t]+/', $line, null, PREG_SPLIT_NO_EMPTY);
            $first_word = $words[0];
            $options = ['a','b','c','d','e'];
            $last_letter = substr($first_word,strlen($first_word)-1);
    
            if ($last_letter==$separator) {
                if (is_numeric(trim($first_word,$separator))) {
                    $content = explode($separator,$line);
                    return ['q',$content[1]];
                }elseif (in_array(strtolower(trim($first_word,$separator)),$options)) {
                    $content = explode($separator,$line);
                    return ['o',$content[1]];
                }else{
                    return ['x',$line];
                }
            }else{
                return ['x',$line];
            }
    
        }
    
        private function commitQuiz($question, $options, $ans )
        {
            $myQ = array(
                'question'=>$question,
                'options' => $options,
                'answer' => $ans
            );
            array_push($this->questions,$myQ);
            $this->committed = true;
        }
    
    

        public function get_mult_exams (){
            $stmt = $this->pdo->prepare("SELECT * FROM exam ORDER BY exam_name ASC");
            $stmt->execute();
            $multi = $stmt->fetchAll(PDO::FETCH_OBJ);
          
            return $multi; 
        }

        public function get_mult_courses (){
            $stmt = $this->pdo->prepare("SELECT * FROM courses ORDER BY course_name ASC");
            $stmt->execute();
            $multi = $stmt->fetchAll(PDO::FETCH_OBJ);
          
            return $multi; 
        }

        public function createOption($question_id, $correct, $option){
            foreach ($option as $key => $data){
                  if($data != ''){

                  
                      if($correct == $key){
                          $is_correct = 1;
  
                      }else{
                          $is_correct = 0;
                      }
                 
                  $stmt = $this->pdo->prepare("INSERT INTO `options` (`question_id`, `is_correct`, `options`) VALUES ( :question_id, :is_correct, :options)");
                  $stmt ->bindParam(":question_id", $question_id, PDO::PARAM_INT);
                  $stmt ->bindParam(":is_correct", $is_correct, PDO::PARAM_INT);
                  $stmt ->bindParam(":options", $data, PDO::PARAM_STR);
                  $stmt ->execute();
                }
              }
              
              return true;
          
         
            
      }

      public function check_marking($exam_id , $question_id, $round, $student_id){

        $stmt = $this->pdo->prepare("SELECT * FROM marking_up WHERE `test_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id AND `question_id` = :question_id");
        
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":question_id", $question_id, PDO::PARAM_INT);
        $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->execute();

        $marking = $stmt->fetch(PDO::FETCH_OBJ);
      
        return $marking; 
      }


      public function check_timer($exam_id, $round, $student_id){
        $stmt = $this->pdo->prepare("SELECT * FROM student_exam_re WHERE `exam_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id ORDER BY ID ASC");
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->execute();
        $get_nav_questions = $stmt->fetch(PDO::FETCH_OBJ);
      
        return $get_nav_questions; 
      }


      public function get_nav_question_live($exam_id, $round, $student_id){
        $stmt = $this->pdo->prepare("SELECT * FROM live_question WHERE `exam_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id ORDER BY ID ASC");
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->execute();
        $get_nav_questions = $stmt->fetchAll(PDO::FETCH_OBJ);
      
        return $get_nav_questions; 
      }

      public function get_navs_question_live($exam_id, $round, $student_id, $current_id){
        $stmt = $this->pdo->prepare("SELECT * FROM live_question WHERE `exam_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id AND `question_id` = :current_id ");
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->bindParam(":current_id", $current_id, PDO::PARAM_INT);
        $stmt->execute();
        $live_questions = $stmt->fetch(PDO::FETCH_OBJ);
      
        return $live_questions; 
      }

        public function check_correct_option($exam_id, $round,$question_id,$student_id){
          $stmt = $this->pdo->prepare("SELECT * FROM marking_up WHERE `exam_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id AND `question_id` = :current_id AND `mark` = 1 ");
          $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
          $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
          $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
          $stmt->bindParam(":current_id", $question_id, PDO::PARAM_INT);
          $stmt->execute();
          $live_questions = $stmt->fetch(PDO::FETCH_OBJ);
        
          return $live_questions; 
        }

       public function get_question_upload($exam_id)
        {
          $stmt = $this->pdo->prepare("SELECT * FROM question_upload WHERE `exam_id`= :exam_id ORDER BY ID DESC LIMIT 1");
          $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
          $stmt->execute();
          $exmas = $stmt->fetch(PDO::FETCH_OBJ);
        
          return $exmas; 

        }

        public function check_sched($course_id, $student_id)
        {
          $stmt = $this->pdo->prepare("SELECT * FROM schedule_final WHERE `course_id`= :course_id AND `student_id` = :student_id");
          $stmt->bindParam(":course_id", $course_id, PDO::PARAM_INT);
          $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
          $stmt->execute();
          $sched = $stmt->fetch(PDO::FETCH_OBJ);
        
          return $sched; 
        }

        public function check_choosen_option($exam_id, $round,$question_id,$student_id){
          $stmt = $this->pdo->prepare("SELECT * FROM marking_up WHERE `exam_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id AND `question_id` = :current_id ");
          $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
          $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
          $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
          $stmt->bindParam(":current_id", $question_id, PDO::PARAM_INT);
          $stmt->execute();
          $live_questions = $stmt->fetch(PDO::FETCH_OBJ);
        
          return $live_questions; 
        }
      public function get_nav_color_live($exam_id, $round, $student_id, $current_id){
        $stmt = $this->pdo->prepare("SELECT * FROM marking_up WHERE `exam_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id AND `question_id` = :current_id ");
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->bindParam(":current_id", $current_id, PDO::PARAM_INT);
        $stmt->execute();
        $live_questions = $stmt->fetch(PDO::FETCH_OBJ);
      
        return $live_questions; 
      }

      public function get_first_question_live($exam_id, $round, $student_id){
        $stmt = $this->pdo->prepare("SELECT * FROM live_question WHERE `test_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id ORDER BY ID ASC LIMIT 1 ");
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->execute();
        $live_questions = $stmt->fetch(PDO::FETCH_OBJ);
      
        return $live_questions; 
      }

      public function get_next_question_live($exam_id, $round, $student_id, $current_id){
        $stmt = $this->pdo->prepare("SELECT * FROM live_question WHERE `test_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id AND `id` > :current_id ORDER BY ID ASC LIMIT 1 ");
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->bindParam(":current_id", $current_id, PDO::PARAM_INT);
        $stmt->execute();
        $live_questions = $stmt->fetch(PDO::FETCH_OBJ);
      
        return $live_questions; 
      }
      
      public function get_previous_question_live($exam_id, $round, $student_id, $current_id){
        $stmt = $this->pdo->prepare("SELECT * FROM live_question WHERE `test_id`= :exam_id AND `round` = :rounds AND `student_id` = :student_id AND `id` < :current_id ORDER BY ID DESC LIMIT 1 ");
        $stmt->bindParam(":exam_id", $exam_id, PDO::PARAM_INT);
        $stmt->bindParam(":rounds", $round, PDO::PARAM_INT);
        $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->bindParam(":current_id", $current_id, PDO::PARAM_INT);
        $stmt->execute();
        $live_questions = $stmt->fetch(PDO::FETCH_OBJ);
      
        return $live_questions; 
      }
  

        public function get_exams($std_id){
            $stmt = $this->pdo->prepare("SELECT `course_exam`.`id` AS id, `course_exam`.`course_id` AS course_id,`course_exam`.`exam_id` AS exam_id  FROM `course_exam` INNER JOIN `student_courses` ON `course_exam`.`course_id` = `student_courses`.`course_id` WHERE `student_courses`.student_id = $std_id ");
            $stmt->execute();
            $exams = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $exams;  
        }

        public function get_std_results($student_id, $course_id){
          $stmt = $this->pdo->prepare("SELECT * FROM result WHERE `student_id`= :student_id AND `course_id`= :course_id");
          $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
          $stmt->bindParam(":course_id", $course_id, PDO::PARAM_INT);
          $stmt->execute();
          $results = $stmt->fetch(PDO::FETCH_OBJ);
        
          return $results; 
        }

        public function get_std_results_dip($student_id, $course_id){
            $stmt = $this->pdo->prepare("SELECT * FROM diploma_result WHERE `student_id`= :student_id AND `course_id`= :course_id");
            $stmt->bindParam(":student_id", $student_id, PDO::PARAM_INT);
            $stmt->bindParam(":course_id", $course_id, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetch(PDO::FETCH_OBJ);
          
            return $results; 
          }

        public function exam_details($exam_id){
            $stmt = $this->pdo->prepare("SELECT * FROM exam WHERE `id`= :id");
            $stmt->bindParam(":id", $exam_id, PDO::PARAM_INT);
            $stmt->execute();
            $exam = $stmt->fetch(PDO::FETCH_OBJ);
          
            return $exam; 
        }

        public function get_student_exam_details($exam_id, $student_id){
            $stmt = $this->pdo->prepare("SELECT * FROM student_exam WHERE `exam_id`= :id AND `student_id` = :std_id");
            $stmt->bindParam(":id", $exam_id, PDO::PARAM_INT);
            $stmt->bindParam(":std_id", $student_id, PDO::PARAM_INT);
            $stmt->execute();
            $exam = $stmt->fetch(PDO::FETCH_OBJ);
          
            return $exam; 
        }
       

      

        public function update_exam_std($exam_id, $std_id){
            $stmt = $this->pdo->prepare("UPDATE student_exam SET `round` = `round` + 1  WHERE `exam_id`= :id AND `student_id` = :std_id");
            $stmt->bindParam(":id", $exam_id, PDO::PARAM_INT);
            $stmt->bindParam(":std_id", $std_id, PDO::PARAM_INT);
           if( $stmt->execute()){
               return true;
           }
        }

        public function get_rand_quest($exam_id, $question_no){
            $stmt = $this->pdo->prepare("SELECT * FROM questions WHERE `test_id`= :id ORDER BY RAND() LIMIT $question_no");
            $stmt->bindParam(":id", $exam_id, PDO::PARAM_INT);
            $stmt->execute();
            $exam = $stmt->fetchAll(PDO::FETCH_OBJ);
          
            return $exam; 

        }

        public function get_rand_option($question_id){
            $stmt = $this->pdo->prepare("SELECT * FROM options WHERE `question_id`= :id ORDER BY RAND()");
            $stmt->bindParam(":id", $question_id, PDO::PARAM_INT);
            $stmt->execute();
            $exam = $stmt->fetchAll(PDO::FETCH_OBJ);
          
            return $exam; 

        }

      

       

      
    }
?>
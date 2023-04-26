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
            $words = preg_split('/[\ \n\t]+/', $line, -1, PREG_SPLIT_NO_EMPTY);
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
    
    
        
        // public function XtractQuestion( $filePath,  $separator=".")
        // {
            
        //     if (file_exists($filePath)) {
        //         $file = new SplFileObject($filePath);
                
        //         // Loop until we reach the end of the file.
        //         $currentType='';
        //         $question = '';
        //         $options = array();
        //         $ans = '';
                
        //         while (!$file->eof()) {
                    
        //             $line = trim($file->fgets());
        //             if (strlen($line)==0) {
        //                 continue;
        //             }
        //             $type_value = $this->check_type($line,$separator);
    
        //             if ($type_value[0] =='q') {
        //                 if (!$this->committed) {
        //                     $this->commitQuiz($question,$options,$ans);
        //                     $question='';
        //                     $ans = '';
        //                     $options = [];
        //                     $currentType ='';
        //                 }
        //                 $this->committed = false;
        //                 $question = $type_value[1];
        //                 $currentType='q';
        //             }
    
        //             if ($type_value[0]=='o') {
        //                 array_push($options,$type_value[1]);
        //                 $currentType = 'o';
        //             }
    
        //             if ($type_value[0] =='a') {
        //                 $ans = $type_value[1];
        //                 if (!$this->committed) {
        //                     $this->commitQuiz($question,$options,$ans);
        //                 }
                        
        //                 $question='';
        //                 $ans = '';
        //                 $options = [];
        //                 $currentType ='';
        //             }
                    
        //             if ($type_value[0]=='x') {
        //                 if ($currentType=='q') {
        //                     $question .= ' '. $type_value[1];
        //                 }
        //                 if ($currentType=='o') {
        //                     $op = $options[count($options)-1];
        //                     $options[count($options)-1] = $op.' '.$type_value[1];
        //                 }
        //             }
    
        //         }
        //         // Unset the file to call __destruct(), closing the file handle.
        //         $file = null;
    
        //         return $this->questions;
        //     }else{
        //         return false;
        //     }
        // }
    
        // private function check_type(string $line, string $separator)
        // {
        //     //Check if it is answer
        //     $answer_words = explode(':',$line); 
        //     if (strtolower(trim($answer_words[0]))=='ans') {
        //         return ['a',trim($answer_words[1])];
        //     }
        //     $words = preg_split('/[\ \n\t]+/', $line, null, PREG_SPLIT_NO_EMPTY);
        //     $first_word = $words[0];
        //     $options = ['a','b','c','d','e'];
        //     $last_letter = substr($first_word,strlen($first_word)-1);
    
        //     if ($last_letter==$separator) {
        //         if (is_numeric(trim($first_word,$separator))) {
        //             $content = explode($separator,$line);
        //             return ['q',$content[1]];
        //         }elseif (in_array(strtolower(trim($first_word,$separator)),$options)) {
        //             $content = explode($separator,$line);
        //             return ['o',$content[1]];
        //         }else{
        //             return ['x',$line];
        //         }
        //     }else{
        //         return ['x',$line];
        //     }
    
        // }
        
     

        // private function commitQuiz($question, $options, $ans )
        // {
        //     $myQ = array(
        //         'question'=>$question,
        //         'options' => $options,
        //         'answer' => $ans
        //     );
        //     array_push($this->questions,$myQ);
        //     $this->committed = true;
        // }  
         
    }
?>
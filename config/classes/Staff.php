<?php
   class Staff extends Generic {
        protected $pdo;

        function __construct($pdo){
            
            $this->pdo = $pdo;
    
        
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
  


    }
?>

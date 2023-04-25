<?php
   require_once('Rest.php');
    require_once('Query.php');
    
    require_once('dbConnect.php');
  

    class  Api extends Rest {
        
        public $dbConn;
        
        public function __construct(){
            parent::__construct();
            
            $db = new DbConnect;
            $this->dbConn = $db->connect();

            

        }
        
  

           
        // public function activate() {
        //     $act_code = $this->validateParameter('act_code', $this->param['act_code'], STRING, false);
            
        //     $student_id = $this->validateParameter('student_id', $this->param['student_id'], STRING, false);
           
         
        //     $query = new Query;
        //     try {
                    
        //             $results = $query->get_single('activation_code', array('activation_code' =>$act_code), 'id','desc');

        //           if($results){
        //             $days = $results->months * 30;
                   
                 
                 
        //             if(($results->used) < ($results->num_user)){
        //                 $edit =  $query->update_act($days, $results->id);

        //                 if($edit){
        //                     $data = ['results' => $results];
        //                     $this->returnResponse(SUCCESS_RESPONSE, $data); 
    
        //                 }else{
        //                     $this->returnResponse(FAILED_RESPONSE, "Error Please Try Again.");
        //                 }
        //             }else{
        //                 $this->returnResponse(FAILED_RESPONSE, "This Activation Code has been Used.");
                      
        //               }

                   
        //           }else{
        //             $this->returnResponse(FAILED_RESPONSE, "Invalid Activation Code.");
        //           }
                             
                    
                
               
        //     } catch (Exception $e){
        //         $this->throwError(FAILED_RESPONSE, $e->getMessage());
        //     }
        // }
     

           

        public function register() {
            $fullname = $this->validateParameter('fullname', $this->param['fullname'], STRING, false);
            $email = $this->validateParameter('email', $this->param['email'], STRING, false);
            $phone = $this->validateParameter('phone', $this->param['phone'], STRING, false);       
            $password = $this->validateParameter('password', $this->param['password'], STRING, false);
          
               
                $query = new Query;
                $register = $query->create('register', array('fullname'=>$fullname, 'password'=>$password, 'email'=>$email,  'phone'=>$phone));
                if($register){
                    $message = 'User Created Successfully';
                    $this->returnResponse(SUCCESS_RESPONSE, $register);
                }else{
                    $message = 'Failed to Create User';
                    $this->returnResponse(FAILED_RESPONSE, $message);
                }
           //     $this->returnResponse(SUCCESS_RESPONSE, $message);
           
        }
        // public function school() {
        //     $school_name = $this->validateParameter('school_name', $this->param['schoolname'], STRING, false);
        //     $fullname = $this->validateParameter('fullname', $this->param['fullname'], STRING, false);
        //     $email = $this->validateParameter('email', $this->param['email'], STRING, false);
        //     $phone = $this->validateParameter('phone', $this->param['phone'], STRING, false);       
        //     $class = $this->validateParameter('class', $this->param['class'], STRING, false);
          
               
        //         $query = new Query;
        //         $student = $query->create('student', array('fullname'=>$fullname, 'class'=>$class, 'school_name'=>$school_name));
        //         if($student){
        //            $school=  $query->create('school_reg', array('school_name'=>$school_name, 'student_id'=>$student, 'email'=>$email,  'phone'=>$phone));

        //            if($school){
        //             $message = 'User Created Successfully';
        //             $this->returnResponse(SUCCESS_RESPONSE, $student);
        //            }

                   
        //         }else{
        //             $message = 'Failed to Create User';
        //             $this->returnResponse(FAILED_RESPONSE, $message);
        //         }
               
           
        // }




    }



?>
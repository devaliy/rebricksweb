<?php
include_once('../config/init.php');



if(isset($_POST['exam_id'])){
    

    $exam_id  = $_POST['exam_id'];
    $student_id  = $_POST['student_id'];
    $type  = $_POST['types'];
    $round  = $_POST['round'];
    
        if($type == 'first'){
        
            $get = $getFromExam->get_first_question_live($exam_id,$round, $student_id);
            $current_ids = $get->question_id;

        }elseif($type == 'nav'){
            $current_id = $_POST['question_id'];      
            $get = $getFromExam->get_navs_question_live($exam_id, $student_id, $current_id);
            $current_ids = $get->question_id;
        
     
       
        }elseif($type == 'next'){
            $current_id = $_POST['current'];
           // $get_active = $getFromExam->get_single('live_question', $current_id);
             
    
                
            $get = $getFromExam->get_next_question_live($exam_id,  $student_id, $current_id);
            $current_ids = $get->question_id;
            
           
        }elseif($type == 'previous'){
            $current_id = $_POST['current'];
           
           // $get_active = $getFromExam->get_single('live_question', $current_id);
           
         
            
                $get = $getFromExam->get_previous_question_live($exam_id,  $student_id, $current_id);
                $current_ids = $get->question_id;
    
           }


  
    

    // $get_nav = $getFromExam->get_nav_question_live($exam_id,  $student_id);
    // $nav_html ='';
    // $num = 0;
    // $count_nav = 0;
    // foreach($get_nav as $nav){
    //     $colors = $getFromExam->get_nav_color_live($exam_id,  $student_id,  $nav->question_id);
    //     if(!empty($colors)){
    //         $color = 'btn-warning';
    //     }else{
    //         $color = 'btn-light';
    //     }

    //     if($nav->question_id  == $current_ids){
    //         $color = 'btn-info'; 
    //     }
    //     $count_nav +=1;
    //     $get_nav_question = $getFromGeneric->get_single('question', array('id'=>$nav->question_id), 'id', 'desc');
    //     $nav_html .= '
    
    //     <a href="#" id="nav_plane_btn"  onclick="topFunction()" style="width: 60px; height: 30px; margin: 2px;"    class=" nav_plane_btn btn '.$color.'"    my_question="'.$get_nav_question->id.'">
    //              '.$count_nav.'
               
    //     </a>
    //     ';
   

    // }
   
     
   

     //  var_dump($get);
       $current = $get->id;
       $num = $get->numbering;
      
       $get_question = $getFromGeneric->get_single('questions', array('id'=>$get->question_id),'id', 'desc');
       //$get_attache = $getFromExam->get_single('attachement', array('question_id'=>$get->question_id), 'question_id', 'desc');
    
       $htmlb ='';
       $htmlh= '
           <div class="media align-items-center">
               <div class="media-left">
                   <h3 class="m-0 text-primary mr-2"><strong></strong></h3>
               </div>
              <div class="media-body" id=" '.$get_question->question.'">
             


                   <h5 class="card-title m-0">
                   <strong style="color: red">('.$num. '). </strong> ' .$get_question->question.'
                   </h5>
               </div>
           </div>
          
      ';

      if( !empty($get_attache)){

     
      
      $htmlb .='
      <div class="row">
            
     
           <div class="col-12" ><img class="img-fluid" src="admin/'.@$get_attache->file.'"></div>
           <h3 style="color: red">'.@$get_attache->instruction.'</h3><br>
    
    
           </div>   
 ';
}

           $options = $getFromExam->get_rand_option($get->question_id);
           foreach($options as $option){ 
            $check = '';
                $option_check = $getFromExam->check_choosen_option($exam_id,  $get->question_id, $student_id);
                if($option_check){
                    if($option_check->option_id == $option->id){
                        $check = 'checked';
                    }
                }
  
       
           
           $htmlb .='
               <div class="form-group">
                    <div class="custom-control custom-checkbox ">
                            <input type="radio"  id="'.$option->id.'" '.$check.'   my_question="'.$get->question_id.'"  my_id="'.$option->id.'" name="option_button" class="answer_opt" >
                            <label for="'.$option->id.'">'.$option->options.'</label>

                        </div>
                </div>
        
          ';

        }
       
      
        
        
     

     
      if(!empty($current_ids)){
         $output = array(
               'success'	=>	true, 
                'htmlh' => $htmlh,  
                'htmlb' => $htmlb,
                'nav_html' => $nav_html,   
                'current' => $current
                
            );
    }else{
          $output = array(
               'success'	=>	false, 
              
                
            );
    }

    $output = array(
        'success'	=>	true, 
       
         
     );

    
       
        echo json_encode($output);
}

    
if(isset($_POST['option_id'])){

        $option_id = $_POST['option_id'];
        $question_id = $_POST['question_id'];
        $exam_id = $_POST['exam_id'];
        $student_id = $_POST['student_id'];
   

        $check_option = $getFromExam->check_marking($exam_id , $question_id,  $student_id);
        
        $mark_opt = $getFromExam->get_single('options', array('id'=>$option_id), 'id', 'desc');

        if(!empty($check_option)){

            $marking_id = $check_option->id;
            $create_marking = $getFromExam->update('marking_up', 'id', $marking_id, array('option_id'=>$option_id, 'mark'=>$mark_opt->is_correct));
    
        }else{
            $create_marking = $getFromExam->create('marking_up', array('student_id'=>$student_id, 'exam_id'=>$exam_id, 'question_id'=>$question_id,'option_id'=>$option_id, 'mark'=>$mark_opt->is_correct));
    
        }


  


}



if(isset($_POST['c_id'])){
     
     
    $c_id = $_POST['c_id'];
    $course_id = $_POST['course_id'];
   
   
   
    $check = $getFromCourse->check_student_course_prog($_SESSION['login_id'], $course_id, $c_id);

    if($check > 0){
           $outputs = array(
                   'success'	=>	true,
                  
                  
                  
               );
       
     
    }else{
        $save = $getFromGeneric->create('student_course_progress', array('student_id' => $_SESSION['login_id'], 'course_id' =>$course_id, 'course_content_id' =>$c_id,'status'=>1));
    
   
        if($save){
            $outputs = array(
                   'success'	=>	true,
                  
                  
                  
               );
       }
     
    }

      
    

    echo json_encode($outputs);

  


}








































// if(isset($_POST['exam_id'])){
    

//     $exam_id  = $_POST['exam_id'];
//     $student_id  = $_POST['student_id'];
//     $type  = $_POST['types'];
    
//         if($type == 'first'){
        
//             $get = $getFromExam->get_first_question_live($exam_id, $student_id);
//             $current_ids = $get->question_id;

//         }elseif($type == 'nav'){
//             $current_id = $_POST['question_id'];      
//             $get = $getFromExam->get_navs_question_live($exam_id, $student_id, $current_id);
//             $current_ids = $get->question_id;
        
     
       
//         }elseif($type == 'next'){
//             $current_id = $_POST['current'];
//            // $get_active = $getFromExam->get_single('live_question', $current_id);
             
    
                
//             $get = $getFromExam->get_next_question_live($exam_id,  $student_id, $current_id);
//             $current_ids = $get->question_id;
            
           
//         }elseif($type == 'previous'){
//             $current_id = $_POST['current'];
           
//            // $get_active = $getFromExam->get_single('live_question', $current_id);
           
         
            
//                 $get = $getFromExam->get_previous_question_live($exam_id,  $student_id, $current_id);
//                 $current_ids = $get->question_id;
    
//            }


  
    

//     $get_nav = $getFromExam->get_nav_question_live($exam_id,  $student_id);
//     $nav_html ='';
//     $num = 0;
//     $count_nav = 0;
//     foreach($get_nav as $nav){
//         $colors = $getFromExam->get_nav_color_live($exam_id,  $student_id,  $nav->question_id);
//         if(!empty($colors)){
//             $color = 'btn-warning';
//         }else{
//             $color = 'btn-light';
//         }

//         if($nav->question_id  == $current_ids){
//             $color = 'btn-info'; 
//         }
//         $count_nav +=1;
//         $get_nav_question = $getFromGeneric->get_single('question', array('id'=>$nav->question_id), 'id', 'desc');
//         $nav_html .= '
    
//         <a href="#" id="nav_plane_btn"  onclick="topFunction()" style="width: 60px; height: 30px; margin: 2px;"    class=" nav_plane_btn btn '.$color.'"    my_question="'.$get_nav_question->id.'">
//                  '.$count_nav.'
               
//         </a>
//         ';
   

//     }
   
     
   

//      //  var_dump($get);
//        $current = $get->id;
//        $num = $get->numbering;
      
//        $get_question = $getFromGeneric->get_single('question', array('id'=>$get->question_id),'id', 'desc');
//        $get_attache = $getFromExam->get_single('attachement', array('question_id'=>$get->question_id), 'question_id', 'desc');
    
//        $htmlb ='';
//        $htmlh= '
//            <div class="media align-items-center">
//                <div class="media-left">
//                    <h3 class="m-0 text-primary mr-2"><strong></strong></h3>
//                </div>
//               <div class="media-body" id=" '.$get_question->question.'">
             


//                    <h5 class="card-title m-0">
//                    <strong style="color: red">('.$num. '). </strong> ' .$get_question->question.'
//                    </h5>
//                </div>
//            </div>
          
//       ';

//       if( !empty($get_attache)){

     
      
//       $htmlb .='
//       <div class="row">
            
     
//            <div class="col-12" ><img class="img-fluid" src="admin/'.@$get_attache->file.'"></div>
//            <h3 style="color: red">'.@$get_attache->instruction.'</h3><br>
    
    
//            </div>   
//  ';
// }

//            $options = $getFromExam->get_rand_option($get->question_id);
//            foreach($options as $option){ 
//             $check = '';
//                 $option_check = $getFromExam->check_choosen_option($exam_id,  $get->question_id, $student_id);
//                 if($option_check){
//                     if($option_check->option_id == $option->id){
//                         $check = 'checked';
//                     }
//                 }
  
       
           
//            $htmlb .='
//                <div class="form-group">
//                     <div class="custom-control custom-checkbox ">
//                             <input type="radio"  id="'.$option->id.'" '.$check.'   my_question="'.$get->question_id.'"  my_id="'.$option->id.'" name="option_button" class="answer_opt" >
//                             <label for="'.$option->id.'">'.$option->options.'</label>

//                         </div>
//                 </div>
        
//           ';

//         }
       
      
        
        
     

     
//       if(!empty($current_ids)){
//          $output = array(
//                'success'	=>	true, 
//                 'htmlh' => $htmlh,  
//                 'htmlb' => $htmlb,
//                 'nav_html' => $nav_html,   
//                 'current' => $current
                
//             );
//     }else{
//           $output = array(
//                'success'	=>	false, 
              
                
//             );
//     }

    
       
//         echo json_encode($output);
// }

    
// if(isset($_POST['option_id'])){

//         $option_id = $_POST['option_id'];
//         $question_id = $_POST['question_id'];
//         $exam_id = $_POST['exam_id'];
//         $student_id = $_POST['student_id'];
   

//         $check_option = $getFromExam->check_marking($exam_id , $question_id,  $student_id);
        
//         $mark_opt = $getFromExam->get_single('options', array('id'=>$option_id), 'id', 'desc');

//         if(!empty($check_option)){

//             $marking_id = $check_option->id;
//             $create_marking = $getFromExam->update('marking_up', 'id', $marking_id, array('option_id'=>$option_id, 'mark'=>$mark_opt->is_correct));
    
//         }else{
//             $create_marking = $getFromExam->create('marking_up', array('student_id'=>$student_id, 'exam_id'=>$exam_id, 'question_id'=>$question_id,'option_id'=>$option_id, 'mark'=>$mark_opt->is_correct));
    
//         }


  


// }



// if(isset($_POST['c_id'])){
     
     
//     $c_id = $_POST['c_id'];
//     $course_id = $_POST['course_id'];
   
   
   
//     $check = $getFromCourse->check_student_course_prog($_SESSION['login_id'], $course_id, $c_id);

//     if($check > 0){
//            $outputs = array(
//                    'success'	=>	true,
                  
                  
                  
//                );
       
     
//     }else{
//         $save = $getFromGeneric->create('student_course_progress', array('student_id' => $_SESSION['login_id'], 'course_id' =>$course_id, 'course_content_id' =>$c_id,'status'=>1));
    
   
//         if($save){
//             $outputs = array(
//                    'success'	=>	true,
                  
                  
                  
//                );
//        }
     
//     }

      
    

//     echo json_encode($outputs);

  


// }

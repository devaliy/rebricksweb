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
  

        public function register() {
            $fullname = $this->validateParameter('fullname', $this->param['fullname'], STRING, false);
            $email = $this->validateParameter('email', $this->param['email'], STRING, false);
            $phone = $this->validateParameter('phone', $this->param['phone'], STRING, false);       
            $password = $this->validateParameter('password', $this->param['password'], STRING, false);
          
               
                $query = new Query;
                $register = $query->create('user', array('fullname'=>$fullname, 'password'=>md5($password), 'email'=>$email,  'phone'=>$phone));
                if($register){
                    $message = 'User Created Successfully';
                    $this->returnResponse(SUCCESS_RESPONSE, $message);
                }else{
                    $message = 'Failed to Create User';
                    $this->returnResponse(FAILED_RESPONSE, $message);
                }
                  
        }

        public function addToCart() {
            $prop_id = $this->validateParameter('prop_id', $this->param['prop_id'], INTEGER, false);
            $cust_id = $this->validateParameter('cust_id', $this->param['cust_id'], INTEGER, false);
           
               
                $query = new Query;
                $register = $query->create('cart', array('prop_id'=>$prop_id, 'cust_id'=>$cust_id));
                if($register){
                    $message = 'Cart Added Successfully';
                    $this->returnResponse(SUCCESS_RESPONSE, $message);
                }else{
                    $message = 'Failed to Create Cart';
                    $this->returnResponse(FAILED_RESPONSE, $message);
                }
                  
        }

        public function properties() {
              
            $query = new Query;
            $property = $query->get_property();
            if($property){
               // $message = 'User Created Successfully';
                $this->returnResponse(SUCCESS_RESPONSE, $property);
            }else{
               // $message = 'Failed to Create User';
                $this->returnResponse(FAILED_RESPONSE, $property);
            }
              
    }
    public function carts() {
          
            $query = new Query;
            $cart = $query->get_cart();
            if($cart){
               // $message = 'User Created Successfully';
                $this->returnResponse(SUCCESS_RESPONSE, $cart);
            }else{
               // $message = 'Failed to Create User';
                $this->returnResponse(FAILED_RESPONSE, $cart);
            }
              
    }

    public function cartAmount() {
          
        $query = new Query;
        $cart = $query->get_cart_amt();
        if($cart){
           // $message = 'User Created Successfully';
            $this->returnResponse(SUCCESS_RESPONSE, $cart);
        }else{
           // $message = 'Failed to Create User';
            $this->returnResponse(FAILED_RESPONSE, $cart);
        }
          
}

    public function property() {
        $prop_id = $this->validateParameter('prop_id', $this->param['prop_id'], INTEGER, false);           
        
            $query = new Query;
            $property = $query->get_single('images', array('property_id'=>$prop_id),'id', 'asc');
            if($property){
            // $message = 'User Created Successfully';
                $this->returnResponse(SUCCESS_RESPONSE, $property);
            }else{
            // $message = 'Failed to Create User';
                $this->returnResponse(FAILED_RESPONSE, $property);
            }
            
    }

    public function propById() {
        $prop_id = $this->validateParameter('prop_id', $this->param['prop_id'], INTEGER, false);           
        
            $query = new Query;
            $property = $query->get_single('property', array('id'=>$prop_id),'id', 'asc');
            if($property){
            // $message = 'User Created Successfully';
                $this->returnResponse(SUCCESS_RESPONSE, $property);
            }else{
            // $message = 'Failed to Create User';
                $this->returnResponse(FAILED_RESPONSE, $property);
            }
            
    }
   public  function searchProperty() {
        $term = $this->validateParameter('term', $this->param['term'], STRING, false);           
        
            $query = new Query;
            $property = $query->search_property($term);
            if($property){
            // $message = 'User Created Successfully';
                $this->returnResponse(SUCCESS_RESPONSE, $property);
            }else{
            // $message = 'Failed to Create User';
                $this->returnResponse(FAILED_RESPONSE, $property);
            }
            
    }




    public function propImageById() {
        $prop_id = $this->validateParameter('prop_id', $this->param['prop_id'], INTEGER, false);           
        
            $query = new Query;
            $property = $query->get_multi('images', array('property_id'=>$prop_id),'id', 'asc');
            if($property){
            // $message = 'User Created Successfully';
                $this->returnResponse(SUCCESS_RESPONSE, $property);
            }else{
            // $message = 'Failed to Create User';
                $this->returnResponse(FAILED_RESPONSE, $property);
            }
            
    }


    }



?>
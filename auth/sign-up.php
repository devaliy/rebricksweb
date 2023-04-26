<?php

require('../config/init.php');


if(isset($_POST['register']) && !empty($_POST['register'])){
	$email = $_POST['email'];
	$fullname = $_POST['fullname'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	        $register = $getFromGeneric->create('user', array('fullname' => $fullname, 'email' => $email, 'password' => md5($password)));
           
            if(!$register){
                echo "<script type='text/javascript'>
            alert('Registration Failed.') </script>";
              
          
			
			    }else{

           
            echo "<script type='text/javascript'>
                   alert(' Registration Successful') </script>";
          }

	//	}



}


?>
<!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from www.wrraptheme.com/templates/RedBricks/estate/sign-up by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 31 Dec 2022 10:08:06 GMT -->
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>:: RedBricks RealEstate  Admin | SIGN UP::</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/authentication.css">
    <link rel="stylesheet" href="../assets/css/color_skins.css">
    
   <!-- SweetAlert2 -->
   <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../assets/plugins/toastr/toastr.min.css">
</head>

<body class="theme-purple authentication sidebar-collapse">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
    <div class="container">        
        <div class="navbar-translate n_logo">
            <a class="navbar-brand" href="#" title="" target="_blank"><h4 class="text-light mt-0">RedBricks</h4></a>
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
            </button>
        </div>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Search Result</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="Follow us on Twitter" href="#" target="_blank">
                        <i class="zmdi zmdi-twitter"></i>
                        <p class="d-lg-none d-xl-none">Twitter</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="Like us on Facebook" href="#" target="_blank">
                        <i class="zmdi zmdi-facebook"></i>
                        <p class="d-lg-none d-xl-none">Facebook</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" title="Follow us on Instagram" href="#" target="_blank">                        
                        <i class="zmdi zmdi-instagram"></i>
                        <p class="d-lg-none d-xl-none">Instagram</p>
                    </a>
                </li>                
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-round" href="sign-in">SIGN IN</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<div class="page-header">
    <div class="page-header-image" style="background-image:url(../assets/images/login.jpg)"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="post" action="sign-up" enctype="multipart/form-data">
                    <div class="header">
                        <div class="logo-container">
                            <img src="../assets/images/logo.svg" alt="">
                        </div>
                        <h5>Sign Up</h5>
                        <span>Register a new membership</span>
                    </div>
                    <div class="content">                                                
                        <div class="input-group">
                            <input type="text" name="fullname" class="form-control" placeholder="Enter Full Name">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-account-circle"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="text" name="email" class="form-control" placeholder="Enter Email">
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-email"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" placeholder="Password" class="form-control" />
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>
                        <div class="input-group">
                            <input type="password" name="cpassword" placeholder="Confirm Password" class="form-control" />
                            <span class="input-group-addon">
                                <i class="zmdi zmdi-lock"></i>
                            </span>
                        </div>                        
                    </div>
                    <div class="checkbox">
                            <input id="terms" type="checkbox">
                            <label for="terms">
                                    I read and agree to the <a href="javascript:void(0);">terms of usage</a>
                            </label>
                        </div>
                    <div class="footer text-center">
                        <input type="submit" name="register" class="btn l-cyan btn-round btn-lg btn-block waves-effect waves-light" value="SIGN UP">
                        <h6 class="m-t-20"><a class="link" href="sign-in">You already have a membership?</a></h6>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
</div>

<!-- Jquery Core Js -->
<script src="../assets/bundles/libscripts.bundle.js"></script>
<script src="../assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<!-- SweetAlert2 -->
<script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../assets/plugins/toastr/toastr.min.js"></script>

<script>
   $(".navbar-toggler").on('click',function() {
    $("html").toggleClass("nav-open");
});
</script>
</body>

<!-- Mirrored from www.wrraptheme.com/templates/RedBricks/estate/sign-up by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 31 Dec 2022 10:08:06 GMT -->
</html>
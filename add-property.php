

<?php 
require("config/init.php");
include('includes/header.php');

include('includes/sidebar.php');


?>

<!-- Main Content -->
<section class="content home">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Add Property
                <small class="text-muted">Welcome to Compass</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index"><i class="zmdi zmdi-home"></i> Compass</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Property</a></li>
                    <li class="breadcrumb-item active">Add Property</li>
                </ul>                
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <form method="post" action="add-property" enctype="multipart/form-data">
                <div class="card">
                    <div class="header">
                        <h2><strong>Basic</strong> Information <small>Description text here...</small> </h2>
                        
                    </div>
                    <div class="body">                   
                                       
                    <div class="row clearfix  ">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input  required type="text" name="prop_name" class="form-control" placeholder="Property Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input  required type="text" name="prop_location" class="form-control" placeholder="Property Location">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea required  rows="4" name="prop_desc" class="form-control no-resize" placeholder="Property Description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Property</strong> For <small>Description text here...</small> </h2>
                        
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="radio inlineblock m-r-25">
                                    <input  required type="radio" name="prop_offer" id="radio1" value="rent" checked="">
                                    <label for="radio1">For Rent</label>
                                </div>
                                <div class="radio inlineblock">
                                    <input  required type="radio" name="prop_offer" id="radio2" value="sale">
                                    <label for="radio2">For Sale</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input  required type="text" name="prop_amount" class="form-control" placeholder="Price / Rent">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea required  rows="4" name="prop_address" class="form-control no-resize" placeholder="Property Address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-lg-3 col-dm-3 col-sm-6">
                                <div class="form-group">
                                    <input  required type="text" name="prop_bedroom" class="form-control" placeholder="Bedrooms">
                                </div>
                            </div>
                            <div class="col-lg-3 col-dm-3 col-sm-6">
                                <div class="form-group">
                                    <input  required type="text" class="form-control" name="prop_squareft"  placeholder="Square ft">
                                </div>
                            </div>
                            <div class="col-lg-3 col-dm-3 col-sm-6">
                                <div class="form-group">
                                    <input  required type="text" class="form-control" name="prop_car_park"  placeholder="Car Parking">
                                </div>
                            </div>
                            <div class="col-lg-3 col-dm-3 col-sm-6">
                                <div class="form-group">
                                    <input  required type="text" class="form-control" name="prop_year_built"  placeholder="Year Built">
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Dimensions</strong> <small>Description text here...</small> </h2>
                        
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input  required type="text" name="dining_room"  class="form-control" placeholder="Dining Room">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input  required type="text"  name="prop_kitchen"  class="form-control" placeholder="Kitchen">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-line">
                                    <input  required type="text"  name="prop_living_room"  class="form-control" placeholder="Living Room">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input  required type="text"  name="prop_master_bedroom"  class="form-control" placeholder="Master Bedroom">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input  required type="text"  name="prop_beedroom_2"  class="form-control" placeholder="Bedroom 2">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input  required type="text"  name="prop_other_room"  class="form-control" placeholder="Other Room">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>General</strong> Amenities<small>Description text here...</small> </h2>
                        
                    </div>
                    <div class="body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox21"  name="prop_swimming_pool"  type="checkbox">
                                    <label for="checkbox21">Swimming pool</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox22"  name="prop_terrace"  type="checkbox">
                                    <label for="checkbox22">Terrace</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox23" type="checkbox"  name="prop_air_conditioning"  checked="">
                                    <label for="checkbox23">Air conditioning</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox24" type="checkbox"  name="prop_internet"  checked="">
                                    <label for="checkbox24">Internet</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox25"  name="prop_balcony"  type="checkbox">
                                    <label for="checkbox25">Balcony</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox26"  name="prop_cable_tv"  type="checkbox">
                                    <label for="checkbox26">Cable TV</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox27"  name="prop_computer"  type="checkbox">
                                    <label for="checkbox27">Computer</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox28"  name="prop_dishwasher"  type="checkbox" checked="">
                                    <label for="checkbox28">Dishwasher</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox29"  name="prop_near_green_zone"  type="checkbox" checked="">
                                    <label for="checkbox29">Near Green Zone</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox30"  name="prop_near_church"  type="checkbox">
                                    <label for="checkbox30">Near Church</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox31"  name="prop_near_estate"  type="checkbox">
                                    <label for="checkbox31">Near Estate</label>
                                </div>
                                <div class="checkbox inlineblock m-r-20">
                                    <input   id="checkbox32"  name="prop_coffe_shop"  type="checkbox">
                                    <label for="checkbox32">Cofee pot</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12">
                                    <button type="submit" name="register" class="btn btn-primary btn-round">Submit</button>
                                    <button type="submit" class="btn btn-default btn-round btn-simple">Cancel</button>
                                </div>
                       
                    </div>
                </div>

                </form>

                
                <div class="card">
                    <div class="header">
                        <h2><strong>Basic</strong> Information <small>Description text here...</small> </h2>
                        
                    </div>
                        <div class="body">
                            <form action="add-property?id=<?=$_GET['id']?>" id="frmFileUpload" class="dropzone m-b-15 m-t-15" method="post" enctype="multipart/form-data">                           
                               
                                <div class="row clearfix"> 
                                        <div class="col-sm-12">
                                        
                                              <div class="row">
                                              <?php
                                              
                                                $imgs =   $getFromGeneric->get_multi('images', array('property_id'=>$_GET['id']), 'id', 'desc');
                                                foreach($imgs as $img):
                                              ?>
                                              <div class="col-md-3">
                                                <img src="<?=$img->image_url?>">
                                              </div>

                                              <?php endforeach ?>
                                              </div>
                                                <div class="fallback">
                                                <input type="file" name="image" class="form-control" placeholder="Property Image" required>
                                                    <!-- <input  required name="image" type="file" multiple /> -->
                                                    <input type="hidden" name="prop_id" value="<?=$_GET['id']?>" >
                                                </div>
                                        
                                        </div>
                                        <div class="col-sm-12">
                                            <button type="submit" name="upload_image" class="btn btn-primary btn-round">Add Image</button>
                                            <button type="submit" class="btn btn-default btn-round btn-simple">Cancel</button>
                                        </div>
                                
                                </div>
                            </form>
                        </div>
                </div>
                    
            </div>
        </div>
    </div>
</section>


<?php 
include('includes/footer.php');

if(isset($_POST['register'])){
    $prop_name = $_POST['prop_name'];
    $prop_swimming_pool = $_POST['prop_swimming_pool'];
    $prop_terrace = $_POST['prop_terrace'];
    $prop_air_conditioning = $_POST['prop_air_conditioning'];
    $prop_internet = $_POST['prop_internet'];
    $prop_balcony = $_POST['prop_balcony'];
    $prop_cable_tv = $_POST['prop_cable_tv'];
    $prop_computer = $_POST['prop_computer'];
    $prop_dishwasher = $_POST['prop_dishwasher'];
    $prop_near_green_zone = $_POST['prop_near_green_zone'];
    $prop_near_church = $_POST['prop_near_church'];
    $prop_near_estate = $_POST['prop_near_estate'];
    $prop_coffe_shop = $_POST['prop_coffe_shop'];
    $dining_room = $_POST['dining_room'];
    $prop_kitchen = $_POST['prop_kitchen'];
    $prop_living_room = $_POST['prop_living_room'];
    $prop_master_bedroom = $_POST['prop_master_bedroom'];
    $prop_beedroom_2 = $_POST['prop_beedroom_2'];
    $prop_other_room = $_POST['prop_other_room'];
    $prop_year_built = $_POST['prop_year_built'];
    $prop_car_park = $_POST['prop_car_park'];
    $prop_squareft = $_POST['prop_squareft'];
    $prop_bedroom = $_POST['prop_bedroom'];
    $prop_address = $_POST['prop_address'];
    $prop_amount = $_POST['prop_amount'];
    $prop_offer = $_POST['prop_offer'];
    $prop_desc = $_POST['prop_desc'];
    $prop_location = $_POST['prop_location'];


    $create = $getFromGeneric->create('property', array('prop_name'=>$prop_name,'prop_swimming_pool'=>$prop_swimming_pool,'prop_terrace'=>$prop_terrace,'prop_air_conditioning'=>$prop_air_conditioning,'prop_internet'=>$prop_internet,'prop_balcony'=>$prop_balcony,'prop_cable_tv'=>$prop_cable_tv,'prop_computer'=>$prop_computer,'prop_dishwasher'=>$prop_dishwasher,'prop_living_room'=>$prop_living_room,'prop_kitchen'=>$prop_kitchen,'dining_room'=>$dining_room,'prop_coffe_shop'=>$prop_coffe_shop,'prop_other_room'=>$prop_other_room,'prop_beedroom_2'=>$prop_beedroom_2,'prop_master_bedroom'=>$prop_master_bedroom,'prop_near_estate'=>$prop_near_estate,'prop_squareft'=>$prop_squareft,'prop_car_park'=>$prop_car_park,'prop_year_built'=>$prop_year_built,'prop_near_green_zone'=>$prop_near_green_zone,'prop_amount'=>$prop_amount,'prop_address'=>$prop_address,'prop_bedroom'=>$prop_bedroom,'prop_near_church'=>$prop_near_church,'prop_offer'=>$prop_offer,'prop_desc'=>$prop_desc,'prop_location'=>$prop_location ));

    if($create){
        echo "<script type='text/javascript'>
        $(function() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });
        
            Toast.fire({
                type: 'success',
                title: 'Property Created Successfully',
            })
        
        });
        
        setInterval(() => {
            window.location.assign('add-property?id=".$create."','_self');
        }, 2000);
        </script>";


        // echo '<script>alert("Property Created Successfully")</script>';
        // echo '<script>
        //     window.location.assign("add-property?id="'.$create.');
        // </script>';
        
    }else{
        echo "<script type='text/javascript'>
        $(function() {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
      
            Toast.fire({
              type: 'error',
              title: 'Failed to Create Property Try again.'
            })
        
        });
      
      </script>";
    }
    
}





if(isset($_POST['upload_image'])){
    $prop_id = $_POST['prop_id'];
    $file = $_FILES["image"];
    $filename = $file["name"];
    $tmp_name = $file["tmp_name"];
    $original = mt_rand(1111, 9999).$filename;



   $image_url = 'assets/property_img/'.$original;  
    
  move_uploaded_file($tmp_name, "assets/property_img/" . $original);     
 
   //$image_url = $getFromGeneric->uploadImage($filename);


    $create = $getFromGeneric->create('images', array('property_id'=>$prop_id,'image_url'=>$image_url ));

    if($create){
        echo "<script type='text/javascript'>
        $(function() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });
        
            Toast.fire({
                type: 'success',
                title: 'Image Added Successfully',
            })
        
        });
        
        setInterval(() => {
            window.location.assign('add-property?id=".$prop_id."','_self')
        }, 2000);
        </script>";


        // echo '<script>alert("Property Created Successfully")</script>';
        // echo '<script>
        //     window.location.assign("add-property?id="'.$create.');
        // </script>';
        
    }else{
        echo "<script type='text/javascript'>
        $(function() {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
      
            Toast.fire({
              type: 'error',
              title: 'Failed to Add Image Try again.'
            })
        
        });
      
      </script>";
    }
    
}

                           
?>

<?php 
    include('includes/header.php');
    include('includes/sidebar.php');

    $get_prop = $getFromGeneric->get_single('property', array('id'=>$_GET['id']), 'id', 'asc');
?>
<!-- Main Content -->
<section class="content home">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Property Detail
                <small class="text-muted">Welcome to RedBrick</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">                
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index"><i class="zmdi zmdi-home"></i> RedBrick</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Property</a></li>
                    <li class="breadcrumb-item active">Property Detail</li>
                </ul>                
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="body">
                    <div id="demo2" class="carousel slide" data-ride="carousel">
                        <ul class="carousel-indicators">
                            <?php
                                $get_images = $getFromGeneric->get_multi('images', array('property_id'=>$get_prop->id), 'id', 'asc');
                                $sn = 0;
                                foreach($get_images as $img):

                                    if($sn == 0){
                                        $class = 'active';
                                    }else{
                                        $class = '';
                                    }
                            ?>
                            <li data-target="#demo2" data-slide-to="<?=$sn?>" class="<?=$class?>"></li>
                         

                            <?php 
                                $sn ++;
                                endforeach;
                            ?>
                        </ul>


                        <div class="carousel-inner">

                        <?php
                                $get_images = $getFromGeneric->get_multi('images', array('property_id'=>$get_prop->id), 'id', 'asc');
                                $sn = 0;
                                foreach($get_images as $img):

                                    if($sn == 0){
                                        $class = 'active';
                                    }else{
                                        $class = '';
                                    }
                            ?>
                            <div class="carousel-item <?=$class?>">
                                <img src="<?=$img->image_url?>" width="100%" height="100%" class="img-fluid" alt="">
                                <!-- <div class="carousel-caption">
                                    <h3>Chicago</h3>
                                    <p>Thank you, Chicago!</p>
                                </div> -->
                            </div>

                            <?php 
                                $sn ++;
                                endforeach;
                            ?>
                           
                        </div>
                        <!-- Left and right controls -->
                        <a class="carousel-control-prev" href="#demo2" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                        <a class="carousel-control-next" href="#demo2" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                    </div>
                    </div>
                </div>
                <div class="card property_list">
                    <div class="body">
                        <div class="property-content">
                            <div class="detail">
                                <h5 class="text-success m-t-0 m-b-0">&#8358; <?=$get_prop->prop_amount?></h5>
                                <h4 class="m-t-0"><a href="#" class="col-blue-grey"> <?=$get_prop->prop_address?></a></h4>
                                <p class="text-muted"><i class="zmdi zmdi-pin m-r-5"></i> <?=$get_prop->prop_location?></p>
                                <p class="text-muted m-b-0"> <?=$get_prop->prop_desc?></p>
                            </div>
                            <div class="property-action m-t-15">
                                <a href="#" title="Square Feet"><i class="zmdi zmdi-view-dashboard"></i><span> <?=$get_prop->prop_squareft?></span></a>
                                <a href="#" title="Bedroom"><i class="zmdi zmdi-hotel"></i><span> <?=$get_prop->prop_bedroom?></span></a>
                                <a href="#" title="Parking space"><i class="zmdi zmdi-car-taxi"></i><span> <?=$get_prop->prop_car_park?></span></a>
                                <!-- <a href="#" title="Garages"><i class="zmdi zmdi-home"></i><span> 24H</span></a> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="card">
                    <div class="header">
                        <h2><strong>General</strong> Amenities<small >Description Text Here...</small></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul> 
                    </div>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <ul class="list-unstyled proprerty-features">
                                <li><i class="zmdi zmdi-check-circle text-success m-r-5"></i>Swimming pool</li>
                                <li><i class="zmdi zmdi-check-circle text-success m-r-5"></i>Air conditioning</li>
                                <li><i class="zmdi zmdi-check-circle text-success m-r-5"></i>Internet</li>
                                <li><i class="zmdi zmdi-check-circle text-success m-r-5"></i>Radio</li>
                                <li><i class="zmdi zmdi-check-circle text-success m-r-5"></i>Balcony</li>
                                <li><i class="zmdi zmdi-check-circle text-success m-r-5"></i>Roof terrace</li>
                                <li><i class="zmdi zmdi-check-circle text-success m-r-5"></i>Cable TV</li>
                                <li><i class="zmdi zmdi-check-circle text-success m-r-5"></i>Electricity</li>
                            </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled proprerty-features">
                                    <li><i class="zmdi zmdi-star text-warning m-r-5"></i>Terrace</li>
                                    <li><i class="zmdi zmdi-star text-warning m-r-5"></i>Cofee pot</li>
                                    <li><i class="zmdi zmdi-star text-warning m-r-5"></i>Oven</li>
                                    <li><i class="zmdi zmdi-star text-warning m-r-5"></i>Towelwes</li>
                                    <li><i class="zmdi zmdi-star text-warning m-r-5"></i>Computer</li>
                                    <li><i class="zmdi zmdi-star text-warning m-r-5"></i>Grill</li>
                                    <li><i class="zmdi zmdi-star text-warning m-r-5"></i>Parquet</li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <ul class="list-unstyled proprerty-features">
                                    <li><i class="zmdi zmdi-check-circle text-info m-r-5"></i>Dishwasher</li>
                                    <li><i class="zmdi zmdi-check-circle text-info m-r-5"></i>Near Green Zone</li>
                                    <li><i class="zmdi zmdi-check-circle text-info m-r-5"></i>Near Church</li>
                                    <li><i class="zmdi zmdi-check-circle text-info m-r-5"></i>Near Hospital</li>
                                    <li><i class="zmdi zmdi-check-circle text-info m-r-5"></i>Near School</li>
                                    <li><i class="zmdi zmdi-check-circle text-info m-r-5"></i>Near Shop</li>
                                    <li><i class="zmdi zmdi-check-circle text-info m-r-5"></i>Natural Gas</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="card">
                    <div class="header">
                        <h2><strong>Location</strong> <small>Description text here...</small> </h2>
                    </div>
                    <div class="body">
                        <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=svdezAlqZP2WIeKGiLW4EUnoJvnxVP7i&amp;width=100%&amp;height=400&amp;lang=tr_TR&amp;sourceType=constructor&amp;scroll=true"></script>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card member-card">
                    <div class="header l-parpl">
                        <h4 class="m-t-10">Aliy Adedigba</h4>
                    </div>
                    <div class="member-img">
                        <a href="profile"><img src="assets/images/lg/avatar2.jpg" class="rounded-circle" alt="profile-image"></a>
                    </div>
                    <div class="body">
                        <div class="col-12">
                            <ul class="social-links list-unstyled">
                                <li><a title="facebook" href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a title="twitter" href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a title="instagram" href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                            </ul>
                            <p class="text-muted">Block 32, Flat 4, LSDPC Estate Ebute Metta, Lagos </p>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h5>18</h5>
                                <small>Property</small>
                            </div>
                            <div class="col-4">
                                <h5>2</h5>
                                <small>Rent</small>
                            </div>
                            <div class="col-4">
                                <h5>65</h5>
                                <small>Sale</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Request</strong> Inquiry</h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Mobile No.">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <textarea rows="4" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-round">Submit</button>
                        <button type="submit" class="btn btn-default btn-round btn-simple">Cancel</button>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2><strong>Location</strong></h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">                        
                        <div class="table-responsive">
                            <table class="table table-bordered m-b-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Price:</th>
                                        <td>&#8358; <?=number_format($get_prop->prop_amount, 2)?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Contract type: </th>
                                        <td><span class="badge badge-primary">For  <?=$get_prop->prop_offer?></span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Bathrooms:</th>
                                        <td> <?=$get_prop->prop_bedroom?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Square ft:</th>
                                        <td> <?=$get_prop->prop_squareft?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Swimming Pool:</th>
                                        <td> <?=$get_prop->prop_swimming_pool?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Internet:</th>
                                        <td> <?=$get_prop->prop_internet?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Balcony:</th>
                                        <td> <?=$get_prop->prop_balcony?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Year Built:</th>
                                        <td> <?=$get_prop->prop_year_built?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Available:</th>
                                        <td>Immediately</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pets:</th>
                                        <td>Pets Allowed</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Master Bedrooms:</th>
                                        <td> <?=$get_prop->prop_master_bedroom?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php 
    include('includes/footer.php');
 
?>
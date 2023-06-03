    <div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="<?=base_url();?>"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">User Dashboard</a></li>
        </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                    <?php include 'usersidebar.php';?>
                </aside>
                 <div id="content" class="col-sm-9 user-rightpart">
                    <h2 class="title">My profile</h2>
                    <div class="user-gridpoints">
                       <div class="module">
                            <ul class="block-infos">
                                <li class="info1">
                                    <div class="inner">
                                        <i class="fa fa-file-text-o"></i>
                                        <div class="info-cont">
                                            <a href="#">Total Order</a>
                                            <p>0 Order Update in your Profile</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="info2">
                                    <div class="inner">
                                        <i class="fa fa-shield"></i>
                                        <div class="info-cont">
                                            <a href="#">Total Booking</a>
                                            <p>0 Booking Completed</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="info-contact">
                       <address>
                                <div class="address clearfix form-group">
                                    <div class="icon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="text">User Name : <?=$user_data['name'];?></div>
                                </div>
                                <div class="phone form-group">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="text">Mobile No : +<?=$user_data['country_code'];?> <?=$user_data['mobile'];?></div>
                                </div>
                                <div class="phone form-group">
                                    <div class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="text">Email Id : <?=$user_data['email'];?></div>
                                </div>
                                <!-- <div class="phone form-group">
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="text">Address : 101 Mall Road Mortal Libya</div>
                                </div> -->
                            </address>
                    </div>
                </div>
            </div>
    </div>
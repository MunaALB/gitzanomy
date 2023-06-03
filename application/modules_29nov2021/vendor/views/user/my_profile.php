<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>My Account</h1> 
    </div>
    <div class="content">  
        <div class="row">
            <div class="col-lg-12"> 
                <?= $this->session->flashdata('response') ?>
            </div>
            <div class="col-lg-12"> 
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user"> 
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gray"> 
                    </div>
                    <div class="widget-user-image"> <img class="img-circle" style="width:100px;height:100px" src="<?= $vendor['image'] ? $vendor['image'] : base_url() . 'assets/vendor/images/user.png' ?>" alt="User Avatar"> </div>
                    <div class="box-footer">
                        <div class="text-center mb-4"> 
                            <a href="<?php echo site_url('vendor/change-password'); ?>" class="btn btn-facebook btn-rounded margin-bottom">Change Password</a>
                            <a href="<?php echo site_url('vendor/edit-profile'); ?>" class="btn btn-facebook btn-rounded margin-bottom">Edit My Profile</a></div>
                        <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Vendor Full Name</h5>
                                    <span class=""><?= ucwords($vendor['name']) ?></span> </div>
                                <!-- /.description-block --> 
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Email Address</h5>
                                    <span class=""><?= $vendor['email'] ?></span> 
                                </div>
                                
                                <!-- /.description-block --> 
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Mobile Number</h5>
                                    <span class="description-text">+<?= $vendor['country_code'] . " " . $vendor['mobile'] ?></span> </div>
                                <!-- /.description-block --> 
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header">Business Type</h5>
                                    <span class="description-text"><?= $vendor['business_type'] == 1 ? 'Product' : 'Service' ?></span> </div>
                                <!-- /.description-block --> 
                            </div>
                            <!-- /.col --> 
                        </div>

                        <?php if ($vendor['business_type'] == 1 && $vendor['hub_id']): ?>
                            <div class="row">
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Selected Hub</h5>
                                        <span class=""><?= $vendor['hub_name'] ?></span> 
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- /.row --> 
                        <?php if ($vendor['business_type'] == 2) { ?>
                            <br>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">ID Proof</h5>
                                        <?php if ($vendor['id_proof']) { ?>
                                            <a href="<?= $vendor['id_proof'] ?>" title="view image" target="_blank"><img alt="id proof image" src="<?= $vendor['id_proof'] ?>" style="width:50px;height:50px;"></a>
                                        <?php
                                        } else {
                                            echo "N/A";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">City</h5>
                                        <span><?= $vendor['city_name'] ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Open Time</h5>
                                        <span><?= date('H:i',strtotime($vendor['start_time'])) ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Close Time</h5>
                                        <span><?= date('H:i',strtotime($vendor['end_time'])) ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.col -->
                            <div class="row mt-3">
                                <div class="col-sm-12 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Address</h5>
                                        <span><?= $vendor['address'] ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
<?php } ?>
                    </div>
                </div>
                <!-- /.widget-user --> 

            </div> 
        </div>

    </div>
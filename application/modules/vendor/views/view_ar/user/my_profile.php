<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>حسابي</h1> 
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
                            <a href="<?php echo site_url('vendor/change-password'); ?>" class="btn btn-facebook btn-rounded margin-bottom">غير كلمة السر</a>
                            <a href="<?php echo site_url('vendor/edit-profile'); ?>" class="btn btn-facebook btn-rounded margin-bottom">تعديل ملفي الشخصي</a></div>
                        <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">اسم البائع بالكامل</h5>
                                    <span class=""><?= ucwords($vendor['name']) ?></span> </div>
                                <!-- /.description-block --> 
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">عنوان البريد الالكترونى</h5>
                                    <span class=""><?= $vendor['email'] ?></span> 
                                </div>
                                
                                <!-- /.description-block --> 
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">رقم الهاتف المحمول</h5>
                                    <span class="description-text">+<?= $vendor['country_code'] . " " . $vendor['mobile'] ?></span> </div>
                                <!-- /.description-block --> 
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header">نوع العمل</h5>
                                    <span class="description-text"><?= $vendor['business_type'] == 1 ? 'بيع المنتج' : 'تقديم الخدمات' ?></span> </div>
                                <!-- /.description-block --> 
                            </div>
                            <!-- /.col --> 
                        </div>
                        <?php if ($vendor['business_type'] == 1 && $vendor['hub_id']): ?>
                            <div class="row">
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">اختر مدينة</h5>
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
                                        <h5 class="description-header">إثبات الهوية</h5>
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
                                        <h5 class="description-header">مدينة</h5>
                                        <span><?= $vendor['city_name'] ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">من</h5>
                                        <span><?= date('H:i',strtotime($vendor['start_time'])) ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">الى</h5>
                                        <span><?= date('H:i',strtotime($vendor['end_time'])) ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.col -->
                            <div class="row mt-3">
                                <div class="col-sm-12 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">عنوان</h5>
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
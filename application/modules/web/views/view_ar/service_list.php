<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
                <li><a href="#">فئات الخدمات</a></li>
                <li><a href="#">الفئات الفرعية للخدمات</a></li>
                <li><a href="#">مقدم الخدمة</a></li>
                <li><a href="#">قائمة الخدمات</a></li>
            </ul>
            <div class="row">
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="products-category">
                        <h3 class="title-category ">قائمة الخدمات</h3>
                        <?php if(isset($banner) and $banner): ?>
                            <div class="category-derc">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="banners">
                                            <div>
                                                <a href="#">
                                                    <!-- <img src="<?php echo base_url(); ?>assets/web/images/banner/salonbanner.jpg" alt="1370 x 300"><br> -->
                                                    <img src="<?=$banner;?>" alt="1370 x 300"><br>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="products-list row nopadding-xs so-filter-gird grid">
                            <?php if(isset($service) and $service): foreach($service as $booking): ?>
                                <div class="product-layout col-md-3 col-sm-6 col-xs-12">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img">
                                                <a href="<?php echo base_url('ar/service-detail/'.$booking['service_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['category_name_ar'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['sub_category_name_ar'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['name_ar']))); ?>" title="<?=$booking['name'];?>">
                                                    <img src="<?=$booking['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                    <img src="<?=$booking['image'];?>" class="img-2 img-responsive" alt="320 X 320">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="<?php echo base_url('ar/service-detail/'.$booking['service_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['category_name_ar'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['sub_category_name_ar'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['name_ar']))); ?>" title="<?=$booking['name'];?>"><?=$booking['name'];?></a></h4>
                                                <div class="price"> <span class="price-new"><?=$booking['discount_price'];?> LYD</span>
                                                    <?php if($booking['discount']>0): ?>
                                                        <span class="price-old"><?=$booking['price'];?> LYD</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <div class="main-container container">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 messege-nodata">
                                            <i class="fa fa-shopping-bag"></i>
                                            <h2 class="about-title">No Service Available</h2>
                                            <p> <a href="<?=base_url('');?>">Go To Home</a> </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
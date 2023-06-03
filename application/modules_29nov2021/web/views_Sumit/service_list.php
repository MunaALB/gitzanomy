<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                 <li><a href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
                <?php $uriName1=$this->uri->segment('4'); if(isset($uriName1) and ($uriName1)): ?>
                    <li><a href="#"><?=$uriName1;?></a></li>
                <?php else: ?>
                    <li><a href="#">Service Category</a></li>
                <?php endif; ?>
                <?php $uriName2=$this->uri->segment('5'); if(isset($uriName2) and ($uriName2)): ?>
                    <li><a href="#"><?=$uriName2;?></a></li>
                <?php else: ?>
                    <li><a href="#">Service Sub-Category</a></li>
                <?php endif; ?>
                <?php $uriName3=$this->uri->segment('6'); if(isset($uriName3) and ($uriName3)): ?>
                    <li><a href="#"><?=$uriName3;?></a></li>
                <?php else: ?>
                    <li><a href="#">Service Provider</a></li>
                <?php endif; ?>
                <li><a href="#">Service List</a></li>
            </ul>
            <div class="row">
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="products-category">
                        <h3 class="title-category ">Salon Service</h3>
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
                                                <a href="<?php echo base_url('service-detail/'.$booking['service_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['sub_category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['name']))); ?>" title="Deep Cleansing Facial">
                                                    <img src="<?=$booking['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                    <img src="<?=$booking['image'];?>" class="img-2 img-responsive" alt="320 X 320">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="<?php echo base_url('service-detail/'.$booking['service_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['sub_category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['name']))); ?>" title="Deep Cleansing Facial"><?=$booking['name'];?></a></h4>
                                                <div class="price"> <span class="price-new"><?=$booking['discount_price'];?> LYD</span>
                                                    <?php if($booking['discount']>0): ?>
                                                        <span class="price-old"><?=$booking['price'];?> LYD</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
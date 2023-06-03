<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
                <?php $uriName1=$this->uri->segment('3'); if(isset($uriName1) and ($uriName1)): ?>
                    <!-- <li><a href="#"><?=$uriName1;?></a></li> -->
                    <li><a href="#">فئات الخدمات</a></li>
                <?php else: ?>
                    <li><a href="#">فئات الخدمات</a></li>
                <?php endif; ?>
                <?php $uriName2=$this->uri->segment('4'); if(isset($uriName2) and ($uriName2)): ?>
                    <!-- <li><a href="#"><?=$uriName2;?></a></li> -->
                    <li><a href="#">الفئات الفرعية للخدمات</a></li>
                <?php else: ?>
                    <li><a href="#">فئات الخدمات</a></li>
                <?php endif; ?>
                <li><a href="#">فئات الخدمات</a></li>
            </ul>
        </div>
        <div class="main-container">
            <div id="content">
                <div class="container">
                    <div class="so-categories module custom-slidercates service-subcategory">
                        <h3 class="modtitle"><span>فئات الخدمات</span></h3>
                        <div class="modcontent">
                            <div class="cat-wrap theme3 font-title">
                               <div class="row">
                                    <?php if(isset($vendor) and $vendor): foreach($vendor as $vendorRow): ?>
                                        <div class="col-md-2 col-xs-6">
                                            <div class="content-box">
                                                <div class="image-cat">
                                                    <a href="<?php echo base_url('service-list/'.$vendorRow['sub_category_id']).'/'.$vendorRow['vendor_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['category_name_ar'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['sub_category_name_ar'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['name'])); ?>" title="<?=$vendorRow['name'];?>">
                                                        <img src="<?=$vendorRow['image'];?>" title="<?=$vendorRow['name'];?>" alt="210 X 210" />
                                                    </a>
                                                </div>
                                                <div class="cat-title">
                                                    <div class="rating">    
                                                        <?php for($i=1;$i<=5;$i++){ ?>
                                                            <span class="fa fa-stack"><i class="fa <?php if($vendorRow['service_rating']>=$i){ echo "fa-star"; }else{ echo "fa-star-o"; }?> fa-stack-1x"></i></span>
                                                        <?php } ?>
                                                    </div>
                                                    <a href="<?php echo base_url('service-list/'.$vendorRow['sub_category_id']).'/'.$vendorRow['vendor_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['category_name_ar'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['sub_category_name_ar'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['name'])); ?>" title="<?=$vendorRow['name'];?>"><?=$vendorRow['name'];?></a>
                                                    <span><?=$vendorRow['service_count'];?> الخدمات</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                    <?php else: ?>
                                        <div class="main-container container">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 messege-nodata">
                                                    <i class="fa fa-shopping-bag"></i>
                                                    <h2 class="about-title">No Providers Available</h2>
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
    </div>
</div>
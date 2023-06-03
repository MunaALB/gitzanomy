<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
                <?php $uriName1=$this->uri->segment('3'); if(isset($uriName1) and ($uriName1)): ?>
                    <li><a href="#"><?=$uriName1;?></a></li>
                <?php else: ?>
                    <li><a href="#">Service Category</a></li>
                <?php endif; ?>
                <?php $uriName2=$this->uri->segment('4'); if(isset($uriName2) and ($uriName2)): ?>
                    <li><a href="#"><?=$uriName2;?></a></li>
                <?php else: ?>
                    <li><a href="#">Service Sub-Category</a></li>
                <?php endif; ?>
                <li><a href="#">Service Provider</a></li>
            </ul>
        </div>
        <div class="main-container">
            <div id="content">
                <div class="container">
                    <div class="so-categories module custom-slidercates service-subcategory">
                        <h3 class="modtitle"><span>Service Provider</span></h3>
                        <div class="modcontent">
                            <div class="cat-wrap theme3 font-title">
                               <div class="row">
                                    <?php if(isset($vendor) and $vendor): foreach($vendor as $vendorRow): ?>
                                        <div class="col-md-2">
                                            <div class="content-box">
                                                <div class="image-cat">
                                                    <a href="<?php echo base_url('service-list/'.$vendorRow['sub_category_id']).'/'.$vendorRow['vendor_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['sub_category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['name'])); ?>" title="Vendor Name">
                                                        <img src="<?=$vendorRow['image'];?>" title="<?=$vendorRow['name'];?>" alt="210 X 210" />
                                                    </a>
                                                </div>
                                                <div class="cat-title">
                                                    <div class="rating">    
                                                        <?php for($i=1;$i<=5;$i++){ ?>
                                                            <span class="fa fa-stack"><i class="fa <?php if($vendorRow['service_rating']>=$i){ echo "fa-star"; }else{ echo "fa-star-o"; }?> fa-stack-1x"></i></span>
                                                        <?php } ?>
                                                    </div>
                                                    <a href="<?php echo base_url('service-list/'.$vendorRow['sub_category_id']).'/'.$vendorRow['vendor_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['sub_category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $vendorRow['name'])); ?>" title="<?=$vendorRow['name'];?>"><?=$vendorRow['name'];?></a>
                                                    <span><?=$vendorRow['service_count'];?> Service</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
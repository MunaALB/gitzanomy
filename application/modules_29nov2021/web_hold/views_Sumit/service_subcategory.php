<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
                <?php $uriName=$this->uri->segment('3'); if(isset($uriName) and ($uriName)): ?>
                    <li><a href="#"><?=$uriName;?></a></li>
                <?php else: ?>
                    <li><a href="#">Service Category</a></li>
                <?php endif; ?>
                <li><a href="#">Service Sub-Category</a></li>
            </ul>
        </div>
        <div class="main-container">
            <div id="content">
                <div class="container">
                    <div class="so-categories module custom-slidercates service-subcategory">
                        <h3 class="modtitle"><span>Service Subcategories</span></h3>
                        <div class="modcontent">
                            <div class="cat-wrap theme3 font-title">
                               <div class="row">
                                    <?php if(isset($subCategory) and $subCategory): foreach($subCategory as $subCat): ?>
                                        <div class="col-md-2">
                                            <div class="content-box">
                                                <div class="image-cat">
                                                    <a href="<?php echo base_url('service-provider/'.$subCat['sub_category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['name']))); ?>" title="<?=$subCat['name'];?>">
                                                        <img src="<?=$subCat['image'];?>" title="210 X 210" alt="210 X 210" />
                                                    </a>
                                                </div>
                                                <div class="cat-title"> 
                                                <a href="<?php echo base_url('service-provider/'.$subCat['sub_category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['name']))); ?>" title="<?=$subCat['name'];?>"><?=$subCat['name'];?></a>
                                                <span><?=$subCat['vendor_count'];?> Vendors</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; else: echo "No data found.."; endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
                <li><a href="#">فئات الخدمات</a></li>
                <li><a href="#">الفئات الفرعية للخدمات</a></li>
            </ul>
        </div>
        <div class="main-container">
            <div id="content">
                <div class="container">
                    <div class="so-categories module custom-slidercates service-subcategory">
                        <h3 class="modtitle"><span>الفئات الفرعية للخدمات</span></h3>
                        <div class="modcontent">
                            <div class="cat-wrap theme3 font-title">
                               <div class="row">
                                    <?php if(isset($subCategory) and $subCategory): foreach($subCategory as $subCat): ?>
                                        <div class="col-md-2 col-xs-6">
                                            <div class="content-box">
                                                <div class="image-cat">
                                                    <a href="<?php echo base_url('service-provider/'.$subCat['sub_category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['name_ar']))); ?>" title="<?=$subCat['name'];?>">
                                                        <img src="<?=$subCat['image'];?>" title="<?=$subCat['name'];?>" alt="<?=$subCat['name'];?>" />
                                                    </a>
                                                </div>
                                                <div class="cat-title"> 
                                                <a href="<?php echo base_url('service-provider/'.$subCat['sub_category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['name_ar']))); ?>" title="<?=$subCat['name'];?>"><?=$subCat['name'];?></a>
                                                <span><?=$subCat['vendor_count'];?> البياع</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="main-container container">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 messege-nodata">
                                                    <i class="fa fa-shopping-bag"></i>
                                                    <h2 class="about-title">لا توجد فئة فرعية متاحة</h2>
                                                    <p> <a href="<?=base_url('');?>">العودة إلى الصفحة الرئيسية</a> </p>
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
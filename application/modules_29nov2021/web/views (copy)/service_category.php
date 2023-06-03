<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
                <li>Service Category</li>
            </ul>
        </div>
        <div class="main-container">
            <div id="content">
                <div class="container">
                    <div class="so-categories module custom-slidercates">
                        <h3 class="modtitle"><span>Service Categories</span></h3>
                        <div class="modcontent">
                            <div class="cat-wrap theme3 font-title">
                               <div class="row">
                                    <?php if(isset($category) and $category): foreach($category as $cat): ?>
                                        <div class="col-md-2 col-xs-6">
                                            <div class="content-box">
                                                <div class="image-cat">
                                                    <a href="<?php echo base_url('service-subcategory/'.$cat['category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cat['name']))); ?>" title="<?=$cat['name'];?>">
                                                        <img src="<?=$cat['image'];?>" title="<?=$cat['name'];?>" alt="210 X 210" />
                                                    </a>
                                                </div>
                                                <div class="cat-title"> 
                                                <a href="<?php echo base_url('service-subcategory/'.$cat['category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cat['name']))); ?>" title="Salon"><?=$cat['name'];?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="main-container container">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 messege-nodata">
                                                    <i class="fa fa-shopping-bag"></i>
                                                    <h2 class="about-title">No Category Available</h2>
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
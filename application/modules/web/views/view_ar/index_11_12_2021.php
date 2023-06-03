
<div class="main-container">
    <div id="content">
        <div class="module sohomepage-slider ">
            <div class="yt-content-slider"  data-ltr="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
            <?php if($homepage['webslider']): foreach($homepage['webslider'] as $slider): ?>
                <div class="yt-content-slide">
                    <?php if($slider['offer_type']==1):?>
                        <?php if($slider['product_id']):?>
                            <a href="<?=base_url();?>product-detail/offer-product/<?=$slider['product_id'];?>"><img src="<?=$slider['image'];?>" alt="1920 X 620" class="img-responsive"></a>
                        <?php else: ?>
                            <?php if($slider['offer']):?>
                                <a href="<?=base_url();?>product-list/<?=$slider['category_id'];?>/<?=$slider['sub_category_id'];?>/<?=$slider['offer'];?>"><img src="<?=$slider['image'];?>" alt="1920 X 620" class="img-responsive"></a>
                            <?php else: ?>
                                <a href="<?=base_url();?>product-list/<?=$slider['category_id'];?>/<?=$slider['sub_category_id'];?>/product-list"><img src="<?=$slider['image'];?>" alt="1920 X 620" class="img-responsive"></a>
                            <?php endif; ?>
                        <?php endif; ?>

                        
                    <?php else: ?>
                        <img src="<?=$slider['image'];?>" alt="1920 X 620" class="img-responsive">
                    <?php endif; ?>
                </div>
                <?php endforeach; else: ?>
                    <div class="yt-content-slide">
                        <img src="<?php echo base_url(); ?>assets/web/images/slider/slider1.png" alt="1920 X 620" class="img-responsive">
                    </div>
                <?php endif; ?>
            </div>
            <div class="loadeding"></div>
        </div>
        
        <!---<div class="main-container">
    <div id="content">
        <div class="module sohomepage-slider ">
            <div class="yt-content-slider"  data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="1" data-items_column1="1" data-items_column2="1"  data-items_column3="1" data-items_column4="1" data-arrows="no" data-pagination="yes" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
            <?php if($homepage['slider']): foreach($homepage['slider'] as $slider): ?>
                <div class="yt-content-slide">
                    <a ><img src="<?=$slider['image'];?>" alt="1920 X 620" class="img-responsive"></a>
                </div>
                <?php endforeach; else: ?>
                    <div class="yt-content-slide">
                        <a ><img src="<?php echo base_url(); ?>assets/web/images/slider/slider1.png" alt="1920 X 620" class="img-responsive"></a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="loadeding"></div>
        </div>---->
        
        
        
        
        <!-- <div class="container">
            <div class="block-policy2">
                <ul>
                    <li class="item-1">
                        <div class="item-inner">
                            <div class="icon icon1"></div>
                            <div class="content"> <a href="<?php echo base_url(''); ?>">توصيل مجاني</a>
                                <p>من 100.00 LYD</p>
                            </div>
                        </div>
                    </li>
                    <li class="item-2">
                        <div class="item-inner">
                            <div class="icon icon2"></div>
                            <div class="content"> <a href="<?php echo base_url(''); ?>">فريق الدعم</a>
                                <p>تواصل معنا</p>
                            </div>
                        </div>
                    </li>
                    <li class="item-3">
                        <div class="item-inner">
                            <div class="icon icon3"></div>
                            <div class="content"> <a href="<?php echo base_url(''); ?>">استرجاع مجاني</a>
                                <p>لمنتجات مختاره</p>
                            </div>
                        </div>
                    </li>
                    <li class="item-4">
                        <div class="item-inner">
                            <div class="icon icon4"></div>
                            <div class="content"> <a href="<?php echo base_url(''); ?>">طريقة الدفع او السداد</a>
                                <p>دفع امن</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div> -->
    </div>
</div>
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="so-categories module custom-slidercates">
                <h3 class="modtitle"><span>فئات المنتجات</span><span class="view-all-part"><a href="<?=base_url('ar/product-category');?>">عرض الجميع</a></span></h3>
                <div class="modcontent">
                    <div class="cat-wrap theme3 font-title">
                        <div class="yt-content-slider" data-rtl="yes" data-autoplay="yes" data-autoheight="no" data-delay="2" data-speed="0.6" data-margin="30" data-items_column0="6" data-items_column1="5" data-items_column2="4"  data-items_column3="2" data-items_column4="3" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
                            <?php if($homepage['productCategory']): foreach($homepage['productCategory'] as $cat): ?>
                            <div class="content-box">
                                <div class="image-cat">
                                    <a href="<?php echo base_url('ar/product-subcategory/'.$cat['category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cat['name_ar']))); ?>" title="<?=$cat['name'];?>">
                                        <img src="<?=$cat['image'];?>" title="210 X 210" alt="210 X 210" />
                                    </a>
                                </div>
                                <div class="cat-title"> 
                                  <a href="<?php echo base_url('ar/product-subcategory/'.$cat['category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cat['name_ar']))); ?>" title="Towels Cloud "><?=$cat['name'];?></a>
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
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="banners banners3">
                <div class="banner">
                    <a href="#">
                        <img src="<?php echo base_url(); ?>assets/web/images/banner/01.png" alt="image">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="module layout2-listingtab2">
                <div id="so_listing_tabs_1" class="so-listing-tabs first-load">
                    <div class="loadeding"></div>
                    <div class="ltabs-wrap">
                        <div class="ltabs-tabs-container" data-rtl="yes" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="5" data-md="4" data-sm="2" data-xs="2" data-margin="30">              
                            <div class="ltabs-tabs-wrap">   
                                <ul class="ltabs-tabs cf list-sub-cat font-title">                                  
                                    <li class="ltabs-tab tab-sel" data-category-id="61" data-active-content=".items-category-61"><span class="ltabs-tab-label">أكثر المنتجات مبيعا</span> </li>       
                                    <span class="view-all-part"><a href="<?=base_url('ar/top-selling-product');?>">عرض الجميع</a></span>
                                </ul>
                            </div>
                        </div>
                        <div class="wap-listing-tabs ltabs-items-container products-list grid">
                            <div class="ltabs-items ltabs-items-selected items-category-61" data-total="10">
                                <div class="ltabs-items-inner ltabs-slider">
                                    <?php if($homepage['topSellingProducts']): foreach($homepage['topSellingProducts'] as $fproduct): ?>
                                    <div class="ltabs-item">
                                        <div class="item-inner product-layout transition product-grid">
                                            <div class="product-item-container">
                                                <div class="left-block">
                                                    <div class="product-image-container <?php if(isset($fproduct['images'][1])): echo "second_img"; endif; ?>">
                                                        <a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Dell Laptop">
                                                            <?php if(isset($fproduct['images'][0])): ?>
                                                                <img src="<?=$fproduct['images'][0]['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                            <?php if(isset($fproduct['images'][1])): ?>
                                                                <img src="<?=$fproduct['images'][1]['image'];?>" class="img-2 img-responsive" alt="320 X 320">
                                                                <?php endif; ?>
                                                            <?php else: ?> 
                                                                <img src="<?php echo base_url(); ?>assets/web/images/product/320/2.2.jpg" class="img-1 img-responsive" alt="320 X 320">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                    <div class="button-group so-quickview cartinfo--left">




                                                    <?php if($user_id=="00"): ?>
                                                        <button type="button" onclick="loginRequired(this,1);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                            <span>Add to cart </span>   
                                                        </button>
                                                    <?php else: ?>
                                                        <?php if($fproduct['quantity']==0): ?>
                                                            <button type="button" onclick="loginRequired(this,2);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                <span>Add to cart </span>   
                                                            </button>
                                                        <?php else: ?>
                                                            <button type="button" onclick="addToCart(this,'<?=$fproduct['product_id'];?>','<?=$fproduct['item_id'];?>','1');" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                <span>Add to cart </span>   
                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                    <?php if($login_type=="2"): ?>
                                                        <button type="button" onclick="loginRequired(this,'1');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> 
                                                        <!-- <a class="icon"  data-toggle="tooltip" title="Add To Wishlist" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></a> -->
                                                    <?php else: ?>
                                                        <?php if($fproduct['is_fav']==0): ?>
                                                            <button type="button" onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> 
                                                         <?php else: ?>
                                                            <button type="button" onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart" style="background:red;"></i><span>Remove from Wish List</span></button> 
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                                                                            
                                                        <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="<?php echo base_url('ar/quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id']); ?>" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                       
                                                    </div>
                                                </div>
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <h4><a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Pride Mobility Chair"><?=$fproduct['name'];?></a></h4>
                                                        <div class="price"> <span class="price-new"><?=$fproduct['discount_price'];?> LYD</span>
                                                        <?php if($fproduct['discount']>0): ?>
                                                            <span class="price-old"><?=$fproduct['price'];?> LYD</span>
                                                        <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; else: ?>
                                        <div class="main-container container">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 messege-nodata">
                                                    <i class="fa fa-shopping-bag"></i>
                                                    <h2 class="about-title">No Data Found</h2>
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
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-left sidebar-offcanvas">
                    <div class="module layout2-listingtab2">
                        <div id="so_listing_tabs_2" class="so-listing-tabs first-load">
                            <div class="loadeding"></div>
                            <div class="ltabs-wrap">
                                <div class="ltabs-tabs-container" data-rtl="yes" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="5" data-md="4" data-sm="2" data-xs="2" data-margin="30">              
                                    <div class="ltabs-tabs-wrap">   
                                        <ul class="ltabs-tabs cf list-sub-cat font-title">                                  
                                            <li class="ltabs-tab tab-sel" data-category-id="61" data-active-content=".items-category-61"><span class="ltabs-tab-label">أكثر المنتجات مشاهدة</span> </li>   
                                            <span class="view-all-part"><a href="<?=base_url('ar/most-viewed-product');?>">عرض الجميع</a></span>
                                        </ul>
                                    </div>
                                </div>
                                <div class="wap-listing-tabs ltabs-items-container products-list grid">
                                    <div class="ltabs-items ltabs-items-selected items-category-61" data-total="10">
                                        <div class="ltabs-items-inner ltabs-slider">
                                            <?php if($homepage['mostViewsProducts']): foreach($homepage['mostViewsProducts'] as $fproduct): ?>
                                            <div class="ltabs-item">
                                                <div class="item-inner product-layout transition product-grid">
                                                    <div class="product-item-container">
                                                        <div class="left-block">
                                                            <div class="product-image-container <?php if(isset($fproduct['images'][1])): echo "second_img"; endif; ?>">
                                                            <a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Dell Laptop">
                                                                <?php if(isset($fproduct['images'][0])): ?>
                                                                    <img src="<?=$fproduct['images'][0]['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                                <?php if(isset($fproduct['images'][1])): ?>
                                                                    <img src="<?=$fproduct['images'][1]['image'];?>" class="img-2 img-responsive" alt="320 X 320">
                                                                    <?php endif; ?>
                                                                <?php else: ?> 
                                                                    <img src="<?php echo base_url(); ?>assets/web/images/product/320/2.2.jpg" class="img-1 img-responsive" alt="320 X 320">
                                                                <?php endif; ?>
                                                            </a>
                                                            </div>
                                                            <div class="button-group so-quickview cartinfo--left">
                                                                
                                                                <?php if($user_id=="00"): ?>
                                                                    <button type="button" onclick="loginRequired(this,1);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                        <span>Add to cart </span>   
                                                                    </button>
                                                                <?php else: ?>
                                                                    <?php if($fproduct['quantity']==0): ?>
                                                                        <button type="button" onclick="loginRequired(this,2);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                            <span>Add to cart </span>   
                                                                        </button>
                                                                    <?php else: ?>
                                                                        <button type="button" onclick="addToCart(this,'<?=$fproduct['product_id'];?>','<?=$fproduct['item_id'];?>','1');" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                            <span>Add to cart </span>   
                                                                        </button>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <?php if($login_type=="2"): ?>
                                                                    <button type="button" onclick="loginRequired(this,'1');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> 
                                                                    <!-- <a class="icon"  data-toggle="tooltip" title="Add To Wishlist" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></a> -->
                                                                <?php else: ?>
                                                                    <?php if($fproduct['is_fav']==0): ?>
                                                                        <button type="button" onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> 
                                                                    <?php else: ?>
                                                                        <button type="button" onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart" style="background:red;"></i><span>Remove from Wish List</span></button> 
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="<?php echo base_url('ar/quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id']); ?>" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                       
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <h4><a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Redmi Mobile"><?=$fproduct['name'];?></a></h4>
                                                                <div class="price"> <span class="price-new"><?=$fproduct['discount_price'];?> LYD</span>
                                                                    <?php if($fproduct['discount']>0): ?>
                                                                        <span class="price-old"><?=$fproduct['price'];?> LYD</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; else: ?>
                                                <div class="main-container container">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 messege-nodata">
                                                            <i class="fa fa-shopping-bag"></i>
                                                            <h2 class="about-title">No Data Found</h2>
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
    </div>
</div>
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="banners banners3">
                <div class="banner">
                    <a href="#">
                        <img src="<?php echo base_url(); ?>assets/web/images/banner/02.png" alt="image">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="so-categories module custom-slidercates">
                <h3 class="modtitle"><span>فئات الخدمات</span> <span class="view-all-part"><a href="<?=base_url('ar/service-category');?>">عرض الجميع</a></span></h3>
                <div class="modcontent">
                    <div class="cat-wrap theme3 font-title">
                        <div class="yt-content-slider" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="30" data-items_column0="7" data-items_column1="4" data-items_column2="4"  data-items_column3="2" data-items_column4="3" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                            <?php if($homepage['serviceCategory']): foreach($homepage['serviceCategory'] as $cat): ?>
                            <div class="content-box">
                                <div class="image-cat">
                                    <a href="<?php echo base_url('ar/service-subcategory/'.$cat['category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cat['name_ar']))); ?>" title="Watches">
                                        <img src="<?=$cat['image'];?>" title="210 X 210" alt="210 X 210" />
                                    </a>
                                </div>
                                <div class="cat-title"> 
                                  <a href="<?php echo base_url('ar/service-subcategory'); ?>" title="Salon"><?=$cat['name'];?></a>
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
<!-- <div class="main-container">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-left sidebar-offcanvas">
                    <div class="module layout2-listingtab2">
                        <div id="so_listing_tabs_0" class="so-listing-tabs first-load">
                            <div class="loadeding"></div>
                            <div class="ltabs-wrap">
                                <div class="ltabs-tabs-container" data-rtl="yes" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="5" data-md="4" data-sm="2" data-xs="2" data-margin="30">              <div class="ltabs-tabs-wrap">   
                                        <ul class="ltabs-tabs cf list-sub-cat font-title">                                  
                                            <li class="ltabs-tab tab-sel" data-category-id="61" data-active-content=".items-category-61"><span class="ltabs-tab-label">أكثر الخدمات المحجوزة</span> </li>   
                                            <span class="view-all-part"><a href="<?=base_url('ar/most-booking-service');?>">عرض الجميع</a></span>                                           
                                        </ul>
                                    </div>
                                </div>
                                <div class="wap-listing-tabs ltabs-items-container products-list grid">
                                    <div class="ltabs-items ltabs-items-selected items-category-61" data-total="10">
                                        <div class="ltabs-items-inner ltabs-slider">
                                            <?php if($homepage['mostBooking']): foreach($homepage['mostBooking'] as $booking): ?>
                                                <div class="ltabs-item">
                                                    <div class="item-inner product-layout transition product-grid">
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
                                                </div>
                                            <?php endforeach; endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->



<!-------Sub Category Products------->
<?php $keys=3; if(isset($homepage['subCategoryProductArr']) and $homepage['subCategoryProductArr']):

    foreach($homepage['subCategoryProductArr'] as $layout):
     ?>
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-left sidebar-offcanvas">
                    <div class="module layout2-listingtab2">
                        <div id="so_listing_tabs_<?=$keys;?>" class="so-listing-tabs first-load">
                            <div class="loadeding"></div>
                            <div class="ltabs-wrap">
                                <div class="ltabs-tabs-container" data-rtl="yes" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="5" data-md="4" data-sm="2" data-xs="2" data-margin="30">              
                                    <div class="ltabs-tabs-wrap">   
                                        <ul class="ltabs-tabs cf list-sub-cat font-title">                                  
                                            <li class="ltabs-tab tab-sel" data-category-id="61" data-active-content=".items-category-61"><span class="ltabs-tab-label"><?=$layout['name'];?></span> </li>   
                                            <!-- <span class="view-all-part"><a href="<?=base_url('ar/most-viewed-product');?>">عرض الجميع</a></span> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="wap-listing-tabs ltabs-items-container products-list grid">
                                    <div class="ltabs-items ltabs-items-selected items-category-61" data-total="10">
                                        <div class="ltabs-items-inner ltabs-slider">
                                        <?php if($layout['product_list']): foreach($layout['product_list'] as $fproduct): ?>
                                            <div class="ltabs-item">
                                                <div class="item-inner product-layout transition product-grid">
                                                    <div class="product-item-container">
                                                        <div class="left-block">
                                                            <div class="product-image-container <?php if(isset($fproduct['images'][1])): echo "second_img"; endif; ?>">
                                                            <a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Dell Laptop">
                                                                <?php if(isset($fproduct['images'][0])): ?>
                                                                    <img src="<?=$fproduct['images'][0]['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                                <?php if(isset($fproduct['images'][1])): ?>
                                                                    <img src="<?=$fproduct['images'][1]['image'];?>" class="img-2 img-responsive" alt="320 X 320">
                                                                    <?php endif; ?>
                                                                <?php else: ?> 
                                                                    <img src="<?php echo base_url(); ?>assets/web/images/product/320/2.2.jpg" class="img-1 img-responsive" alt="320 X 320">
                                                                <?php endif; ?>
                                                            </a>
                                                            </div>
                                                            <div class="button-group so-quickview cartinfo--left">
                                                                
                                                                <?php if($user_id=="00"): ?>
                                                                    <button type="button" onclick="loginRequired(this,1);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                        <span>Add to cart </span>   
                                                                    </button>
                                                                <?php else: ?>
                                                                    <?php if($fproduct['quantity']==0): ?>
                                                                        <button type="button" onclick="loginRequired(this,2);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                            <span>Add to cart </span>   
                                                                        </button>
                                                                    <?php else: ?>
                                                                        <button type="button" onclick="addToCart(this,'<?=$fproduct['product_id'];?>','<?=$fproduct['item_id'];?>','1');" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                            <span>Add to cart </span>   
                                                                        </button>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <?php if($login_type=="2"): ?>
                                                                    <button type="button" onclick="loginRequired(this,'1');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> 
                                                                    <!-- <a class="icon"  data-toggle="tooltip" title="Add To Wishlist" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></a> -->
                                                                <?php else: ?>
                                                                    <?php if($fproduct['is_fav']==0): ?>
                                                                        <button type="button" onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> 
                                                                    <?php else: ?>
                                                                        <button type="button" onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart" style="background:red;"></i><span>Remove from Wish List</span></button> 
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="<?php echo base_url('ar/quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id']); ?>" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                       
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <h4><a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Redmi Mobile"><?=$fproduct['name'];?></a></h4>
                                                                <div class="price"> <span class="price-new"><?=$fproduct['discount_price'];?> LYD</span>
                                                                    <?php if($fproduct['discount']>0): ?>
                                                                        <span class="price-old"><?=$fproduct['price'];?> LYD</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; else: ?>
                                                <div class="main-container container">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 messege-nodata">
                                                            <i class="fa fa-shopping-bag"></i>
                                                            <h2 class="about-title">No Data Found</h2>
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
    </div>
</div>
<?php $keys++; endforeach; endif; ?>
<!-------Sub Category Products------->

<!-------Home Layout------->
<?php if(isset($homepage['home_layoutArr']) and $homepage['home_layoutArr']):
    foreach($homepage['home_layoutArr'] as $layout):
    if(isset($layout['image']) and $layout['image']): ?>
    <div class="main-container">
            <div id="content">
                <div class="container">
                    <div class="banners banners3">
                        <div class="banner">
                            <a href="#">
                                <img style="height: 250px;width: 1200px;" src="<?=$layout['image'];?>" alt="Offer Banner" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 main-left sidebar-offcanvas">
                    <div class="module layout2-listingtab2">
                        <div id="so_listing_tabs_<?=$keys;?>" class="so-listing-tabs first-load">
                            <div class="loadeding"></div>
                            <div class="ltabs-wrap">
                                <div class="ltabs-tabs-container" data-rtl="yes" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="5" data-md="4" data-sm="2" data-xs="2" data-margin="30">              
                                    <div class="ltabs-tabs-wrap">   
                                        <ul class="ltabs-tabs cf list-sub-cat font-title">                                  
                                            <li class="ltabs-tab tab-sel" data-category-id="61" data-active-content=".items-category-61"><span class="ltabs-tab-label"><?=$layout['name'];?></span> </li>   
                                            <!-- <span class="view-all-part"><a href="<?=base_url('ar/most-viewed-product');?>">عرض الجميع</a></span> -->
                                        </ul>
                                    </div>
                                </div>
                                <div class="wap-listing-tabs ltabs-items-container products-list grid">
                                    <div class="ltabs-items ltabs-items-selected items-category-61" data-total="10">
                                        <div class="ltabs-items-inner ltabs-slider">
                                        <?php if($layout['product_list']): foreach($layout['product_list'] as $fproduct): ?>
                                            <div class="ltabs-item">
                                                <div class="item-inner product-layout transition product-grid">
                                                    <div class="product-item-container">
                                                        <div class="left-block">
                                                            <div class="product-image-container <?php if(isset($fproduct['images'][1])): echo "second_img"; endif; ?>">
                                                            <a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Dell Laptop">
                                                                <?php if(isset($fproduct['images'][0])): ?>
                                                                    <img src="<?=$fproduct['images'][0]['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                                <?php if(isset($fproduct['images'][1])): ?>
                                                                    <img src="<?=$fproduct['images'][1]['image'];?>" class="img-2 img-responsive" alt="320 X 320">
                                                                    <?php endif; ?>
                                                                <?php else: ?> 
                                                                    <img src="<?php echo base_url(); ?>assets/web/images/product/320/2.2.jpg" class="img-1 img-responsive" alt="320 X 320">
                                                                <?php endif; ?>
                                                            </a>
                                                            </div>
                                                            <div class="button-group so-quickview cartinfo--left">
                                                                
                                                                <?php if($user_id=="00"): ?>
                                                                    <button type="button" onclick="loginRequired(this,1);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                        <span>Add to cart </span>   
                                                                    </button>
                                                                <?php else: ?>
                                                                    <?php if($fproduct['quantity']==0): ?>
                                                                        <button type="button" onclick="loginRequired(this,2);" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                            <span>Add to cart </span>   
                                                                        </button>
                                                                    <?php else: ?>
                                                                        <button type="button" onclick="addToCart(this,'<?=$fproduct['product_id'];?>','<?=$fproduct['item_id'];?>','1');" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                                            <span>Add to cart </span>   
                                                                        </button>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <?php if($login_type=="2"): ?>
                                                                    <button type="button" onclick="loginRequired(this,'1');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> 
                                                                    <!-- <a class="icon"  data-toggle="tooltip" title="Add To Wishlist" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></a> -->
                                                                <?php else: ?>
                                                                    <?php if($fproduct['is_fav']==0): ?>
                                                                        <button type="button" onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span></button> 
                                                                    <?php else: ?>
                                                                        <button type="button" onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart" style="background:red;"></i><span>Remove from Wish List</span></button> 
                                                                    <?php endif; ?>
                                                                <?php endif; ?>

                                                                <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="<?php echo base_url('ar/quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id']); ?>" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>                                                       
                                                            </div>
                                                        </div>
                                                        <div class="right-block">
                                                            <div class="caption">
                                                                <h4><a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Redmi Mobile"><?=$fproduct['name'];?></a></h4>
                                                                <div class="price"> <span class="price-new"><?=$fproduct['discount_price'];?> LYD</span>
                                                                    <?php if($fproduct['discount']>0): ?>
                                                                        <span class="price-old"><?=$fproduct['price'];?> LYD</span>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; else: ?>
                                                <div class="main-container container">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 messege-nodata">
                                                            <i class="fa fa-shopping-bag"></i>
                                                            <h2 class="about-title">No Data Found</h2>
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
    </div>
</div>
<?php $keys++; endforeach; endif; ?>
<!-------Home Layout------->

<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="banners banners3 downloadpart">
                <div class="banner">
                    <a>
                        <img src="<?php echo base_url(); ?>assets/web/images/banner/downloadapp.png" alt="تحميل التطبيق ">
                    </a>
                </div>
                <div class="contentpart">
                    <h2>تحميل التطبيق </h2>
                    <p>التسوق أسهل من تطبيقنا</p>
                    <div class="appdownload">
                        <ul>
                            <li><a href="https://play.google.com/store/apps/details?id=com.techgropse.zanomy" target="_blank"><img src="<?php echo base_url(); ?>assets/web/images/icons/play.png" alt="Play Store"></a></li>
                            <li><a href="https://apps.apple.com/us/app/id1529864842" target="_blank"><img src="<?php echo base_url(); ?>assets/web/images/icons/app.png" alt="App Store"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="main-container">
    <div id="content">
        <div class="container">
            <div class="slider-brands clearfix">
                <div class="yt-content-slider contentslider" data-rtl="no" data-loop="yes" data-autoplay="no" data-autoheight="no" data-autowidth="no" data-delay="4" data-speed="0.6" data-margin="0" data-items_column0="6" data-items_column1="6" data-items_column2="3" data-items_column3="2" data-items_column4="2" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-hoverpause="yes">
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b1.png" alt="brand">
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b2.png" alt="brand">
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b3.png" alt="brand">
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b4.png" alt="brand">
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b5.png" alt="brand">
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b6.png" alt="brand">
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b4.png" alt="brand">
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b5.png" alt="brand">
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url(''); ?>">
                            <img src="<?php echo base_url(); ?>assets/web/images/brands/b6.png" alt="brand">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

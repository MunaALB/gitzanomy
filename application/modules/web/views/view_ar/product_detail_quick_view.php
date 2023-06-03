<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/web/images/logo/favicon.png">
    <title>Zanomy : Libya's Online Shopping Site for Women &amp; Men - Latest Online Shopping Trends</title>
    <meta name="description" content="Online Fashion Shopping Store For Women at Best Price in Libya. Buy Women Clothing, Shoes, Handbags, Jewellery, Sunglasses, Accessories at Zanomy." />
    <meta name="keywords" content="Zanomy, Online Shopping, Online Shopping  in Libya, Online Shopping Site for Women &amp; Men, Latest Online Shopping Trends" />
    <meta name="author" content="Zanomy" />
    <link href="https://www.zanomy.com/" rel="canonical" />
    <meta name="Classification" content="Zanomy" />
    <meta name="abstract" content="https://www.zanomy.com/" />
    <meta name="audience" content="All" />
    <meta name="robots" content="index,follow" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="Zanomy : Libya's  Online Shopping Site for Women &amp; Men - Latest Online Shopping Trends" />
    <meta property="og:description" content="Online Fashion Shopping Store For Women at Best Price in Libya. Buy Women Clothing, Shoes, Handbags, Jewellery, Sunglasses, Accessories at Zanomy." />
    <meta property="og:url" content="https://www.zanomy.com/" />
    <meta property="og:image" content="<?php echo base_url(); ?>assets/web/images/logo/og.png" />
    <meta property="og:site_name" content="Zanomy" />
    <meta name="googlebot" content="index,follow" />
    <meta name="distribution" content="Global" />
    <meta name="Language" content="en-us" />
    <meta name="doc-type" content="Public" />
    <meta name="site_name" content="Zanomy" />
    <meta name="url" content="https://www.zanomy.com/" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/js/datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/js/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/lib.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/js/minicolors/miniColors.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so_searchpro.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so_megamenu.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so-categories.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so-listing-tabs.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so-newletter-popup.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/header/header3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/footer/footer3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/home3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/fonts/stylesheet.css">

    <script src="<?=base_url()?>assets/web/js/jquery-2.2.4.min.js"></script>
    <style>
    .ajax-loader {
        width: 100%;
        height: 100%;
        position: absolute;
        position: fixed;
        display: block;
        opacity: 1;
        background-color: #fff;
        z-index: 9999;
        text-align: center;

        visibility: hidden;
        background: rgba(0,0,0,0.5);

    }

    .ajax-loader img {
        position: relative;
        top: 35%;
        left: 7%;
        width: 122px; 
    }
 </style>
</head>

<body class="common-home res layout-3">
    <div id="page_loader" class="mypageloader">
    <div class="pageloader">
       <img src="<?php echo base_url(); ?>assets/web/images/logo/loader.gif" title="Zanomy loader" alt="Zanomy loader" />
    </div>
</div>
    <div class="ajax-loader">
        <img src="<?php echo base_url('assets');?>/ajax-loader.gif" class="img-responsive" />
    </div>
    <div id="wrapper" class="wrapper-fluid banners-effect-10">
        <script>
            function searchProductData(o){
                var valueData=$.trim($("#search_product_text").val());
                if(valueData){
                    window.location.href="<?=base_url('ar/search-product/');?>"+valueData;
                }
            }
            
            function submissionSearchForm(o){
                if (event.keyCode === 13) {
                        event.preventDefault();
                        $("#searchProductButton").click();
                    }
            }
        </script>
<style>
.attr_span_selected{
    border: 1px solid #ef4d32;background: #ef4d32;color: #fff;
}
.attr_span{
    border: 1px solid;
}
.errorPrint{
    font-size: 12px;
    color: #af2000 !important;
    padding: 5px 5px;
    display: none;
}
</style>
<div class="main-container">
    <div id="content">
        <div class="">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#"><?=$product['category_name'];?></a></li>
                <li><a href="#"><?=$product['name'];?></a></li>
            </ul>
            <div class="row">
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="product-view row">
                        <div class="left-content-product">
                            <div id="" class="content-product-left  class-honizol col-md-5 col-sm-5 col-xs-5">
                                <div id="">
                                    <div class="large-image  ">
                                        <img itemprop="image" class="product-image-zoom" src="<?=$product['images'][0]['image'];?>" data-zoom-image="<?=$product['images'][0]['image'];?>" title="<?=$product['name'];?>" alt="600 X 600">
                                    </div>
                                    <div id="thumb-slider" class="yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="4" data-items_column1="3" data-items_column2="4"  data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                        <?php if($product['images']): foreach($product['images'] as $key=>$img): ?>
                                        <a data-index="<?=$key;?>" class="img thumbnail " data-image="<?=$img['image'];?>" title="<?=$product['name'];?>">
                                            <img src="<?=$img['image'];?>" title="<?=$product['name'];?>" alt="<?=$product['name'];?>">
                                        </a>
                                        <?php endforeach; endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="content-product-right col-md-7 col-sm-7 col-xs-7">
                                <div class="title-product">
                                    <h1><?=$product['name'];?>
                                        <?php if(isset($product['product_attributes']) and $product['product_attributes']):
                                            $viewData="(";
                                            foreach($product['product_attributes'] as $selectedAttr):
                                                $viewData.=$selectedAttr['attribute_value'].', ';
                                            endforeach; $viewData=trim($viewData,', '); $viewData.=")"; echo $viewData; endif; ?>
                                    </h1>
                                </div>
                                <div class="box-review form-group">
                                    <div class="ratings">
                                        <div class="rating-box">
                                            <?php for($i=1;$i<=5;$i++){ ?>
                                                <span class="fa fa-stack"><i class="fa <?php if($product['rating']>=$i){ echo "fa-star"; }else{ echo "fa-star-o"; }?> fa-stack-1x"></i></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <a class="reviews_button" href="#">
                                        <?php $showReview=0; if(isset($product['reviews']) and $product['reviews']){
                                            $review=$product['reviews'];
                                                if(isset($review['reviews'][0]) and $review['reviews'][0]){
                                                    $showReview=count($review['reviews']);
                                                }
                                            } echo $showReview; ?> reviews</a> | 
                                    <a class="write_review_button" href="#">Write a review</a>
                                </div>
                                <div class="product-label form-group">
                                    <div class="product_page_price price">
                                        <span class="price-new" itemprop="price"><?=$product['discount_price'];?> LYD</span>
                                        <?php if($product['discount']>0){ ?>
                                            <span class="price-old"><?=($product['price']);?> LYD</span>
                                        <?php } ?>
                                    </div>
                                    <div class="stock"><span>Availability:</span> <span class="status-stock"><?php if($product['quantity']>0){ echo "In Stock"; }else{ echo "Out Of Stock"; }?></span></div>
                                </div>
                                <div class="product-box-desc product-brandss">
                                    <div class="inner-box-desc">
                                        <div class="price-tax"><span>Category:</span> <?=$product['category_name'];?></div>
                                        <div class="reward"><span>Sub Category:</span> <?=$product['subcategory_name'];?></div>
                                        <div class="brand"><span>Brand:</span><?=($product['brand_name']) ? $product['brand_name']:"N/A";?></div>
                                    </div>
                                </div>
                                <div class="short_description form-group">
                                    <div class="title-about-us">
                                        <h2>Product Short Description</h2>
                                    </div>
                                    <p><?=$product['description'];?> </p>
                                </div>
                                <div id="product">
                                    <h4>Available Options</h4>
                                    <div class="form-group box-info-product">
                                        <p class="errorPrint" id="genericError"></p>
                                        <?php if($product['cart_quentity']>0): ?>
                                            <div class="option quantity">
                                                <div class="input-group quantity-control" unselectable="on">
                                                    <label>Qty</label>
                                                    <input class="form-control" readonly type="text" name="quantity"
                                                    value="<?=$product['cart_quentity'];?>" style="width:55px;">
                                                    <span onclick="addToCart(this,'<?=$product['product_id'];?>','<?=$product['item_id'];?>','2');" class="input-group-addon product_quantity_down">−</span>
                                                    <?php if($product['quantity']==0): ?>
                                                        <span onclick="loginRequired(this,2);" class="product_quantity_up">+</span>
                                                    <?php else: ?>
                                                        <span onclick="addToCart(this,'<?=$product['product_id'];?>','<?=$product['item_id'];?>','1');" class="input-group-addon product_quantity_up">+</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class="cart">
                                                <?php if($user_id=="00"): ?>
                                                    <input type="button" onclick="loginRequired(this,1);" data-toggle="tooltip" title="" value="Add to Cart" id="button-cart" class="btn btn-mega btn-lg" data-original-title="Add to Cart">
                                                <?php else: ?>
                                                    <?php if($product['quantity']==0): ?>
                                                        <input type="button" data-toggle="tooltip" title="" value="Add to Cart" id="button-cart" class="btn btn-mega btn-lg" data-original-title="Out Of Stock">
                                                    <?php else: ?>
                                                        <input type="button" onclick="addToCart(this,'<?=$product['product_id'];?>','<?=$product['item_id'];?>','1');" data-toggle="tooltip" title="" value="Add to Cart" id="button-cart" class="btn btn-mega btn-lg" data-original-title="Add to Cart">
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="add-to-links wish_comp">
                                            <ul class="blank list-inline">
                                                <li class="wishlist">
                                                    <?php if($login_type=="2"): ?>
                                                        <a class="icon" onclick="loginRequired(this,'1');" data-toggle="tooltip" title="Add To Wishlist" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></a>
                                                    <?php else: ?>
                                                        <?php if($product['is_fav']==0): ?>
                                                            <a class="icon" onclick="addToWishlist(this,'<?=$product['product_id'];?>');" data-toggle="tooltip" title="Add To Wishlist" data-original-title="Add to Wish List"><i class="fa fa-heart"></i></a>
                                                        <?php else: ?>
                                                            <a class="icon" onclick="addToWishlist(this,'<?=$product['product_id'];?>');" data-toggle="tooltip" title="Remove From Wishlist" data-original-title="Add to Wish List" style="border: 1px solid #ef4d32;color: #ef4d32;"><i class="fa fa-heart"></i></a>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div id="attribureManagement">
                                    <?php if(isset($product['attributes']) and $product['attributes']):
                                        $firstAttributes=$product['attributes'];
                                        $firstAttrIndex=0; ?>
                                    <div id="product">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Select <?=$firstAttributes['name']; ?></h4>
                                                <div class="form-group box-info-product specification-detail">
                                                    <?php if(isset($firstAttributes['attribute_value']) and $firstAttributes['attribute_value']):
                                                    foreach($firstAttributes['attribute_value'] as $key=>$val): ?>
                                                    <div class="cart">
                                                        <?php if(isset($product['product_attributes']) and $product['product_attributes']): 
                                                        $selectedStyle='data-check=0';  $selectedClass='attr_span';
                                                        foreach($product['product_attributes'] as $selectedKey=>$selectedVal):
                                                            if($selectedVal['attribute_value_id']==$val['attribute_value_id']):
                                                                $firstAttrIndex=$key; $selectedStyle='data-check=1';  $selectedClass='attr_span_selected'; break;
                                                            endif;
                                                            endforeach; endif;
                                                            ?>
                                                            <a href="<?php echo base_url('ar/quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])).'/'.$product['product_id'].'/'.$val['item_id']); ?>" id="val_<?=$val['attribute_value_id'];?>" class="btn btn-mega btn-lg <?=$selectedClass;?> " <?=$selectedStyle;?> ><?=$val['value'];?></a>
                                                    </div>
                                                    <?php endforeach; endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if(isset($product['attributes']) and $product['attributes']):
                                    $firstAttributes=$product['attributes']; 
                                    if(isset($firstAttributes['attribute_value']) and $firstAttributes['attribute_value']):
                                        if(isset($firstAttributes['attribute_value'][$firstAttrIndex]['attributes']) and $firstAttributes['attribute_value'][$firstAttrIndex]['attributes']):
                                        $secondAttributes=$firstAttributes['attribute_value'][$firstAttrIndex]['attributes']; 
                                        //echo '<pre/>';print_r($secondAttributes['attribute_value']);
                                        $secondAttrIndex=0;
                                        ?>
                                    <div id="product">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Select <?=$secondAttributes['name']; ?></h4>
                                                <div class="form-group box-info-product specification-detail">
                                                    <?php if(isset($secondAttributes['attribute_value']) and $secondAttributes['attribute_value']):
                                                        foreach($secondAttributes['attribute_value'] as $key=>$val): ?>
                                                    <div class="cart">
                                                        <?php if(isset($product['product_attributes']) and $product['product_attributes']): 
                                                        $selectedStyle='data-check=0';  $selectedClass='attr_span';
                                                        foreach($product['product_attributes'] as $selectedKey=>$selectedVal):
                                                            if($selectedVal['attribute_value_id']==$val['attribute_value_id']):
                                                                $secondAttrIndex=$key; $selectedStyle='data-check=1';  $selectedClass='attr_span_selected'; break;
                                                            endif;
                                                            endforeach; endif;
                                                            ?>
                                                        <a href="<?php echo base_url('ar/quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])).'/'.$product['product_id'].'/'.$val['item_id']); ?>" id="val_<?=$val['attribute_value_id'];?>" class="btn btn-mega btn-lg <?=$selectedClass;?> " <?=$selectedStyle;?> ><?=$val['value'];?></a>
                                                    </div>
                                                    <?php endforeach; endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; endif; endif; ?>


                                    <?php if(isset($product['attributes']) and $product['attributes']):
                                            $firstAttributes=$product['attributes']; 
                                            if(isset($firstAttributes['attribute_value']) and $firstAttributes['attribute_value']):
                                                if(isset($firstAttributes['attribute_value'][$firstAttrIndex]['attributes']) and $firstAttributes['attribute_value'][$firstAttrIndex]['attributes']):
                                                $secondAttributes=$firstAttributes['attribute_value'][$firstAttrIndex]['attributes']; 
                                                if(isset($secondAttributes['attribute_value'][$secondAttrIndex]['attributes']) and $secondAttributes['attribute_value'][$secondAttrIndex]['attributes']):
                                                    if(isset($secondAttributes['attribute_value'][$secondAttrIndex]['attributes']['attribute_value']) and $secondAttributes['attribute_value'][$secondAttrIndex]['attributes']['attribute_value']):
                                                        //$secondAttributesValue=$secondAttributes['attribute_value']; 
                                                        $thirdAttributes=$secondAttributes['attribute_value'][$secondAttrIndex]['attributes']; 
                                                        // echo '<pre/>';print_r($thirdAttributes);
                                                        // echo '<pre/>';print_r($secondAttributes['attribute_value']);
                                                ?>
                                    <div id="product">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4>Select <?=$thirdAttributes['name']; ?></h4>
                                                <div class="form-group box-info-product specification-detail">
                                                    <?php if(isset($thirdAttributes['attribute_value']) and $thirdAttributes['attribute_value']):
                                                    foreach($thirdAttributes['attribute_value'] as $key=>$val): ?>
                                                    <div class="cart">
                                                        <?php if(isset($product['product_attributes']) and $product['product_attributes']): 
                                                        $selectedStyle='data-check=0';  $selectedClass='attr_span';
                                                        foreach($product['product_attributes'] as $selectedKey=>$selectedVal):
                                                            if($selectedVal['attribute_value_id']==$val['attribute_value_id']):
                                                                $selectedStyle='data-check=1';  $selectedClass='attr_span_selected'; break;
                                                            endif;
                                                            endforeach; endif;
                                                            ?>
                                                        <a href="<?php echo base_url('ar/quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])).'/'.$product['product_id'].'/'.$val['item_id']); ?>" id="val_<?=$val['attribute_value_id'];?>" class="btn btn-mega btn-lg <?=$selectedClass;?> " <?=$selectedStyle;?> ><?=$val['value'];?></a>
                                                    </div>
                                                    <?php endforeach; endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; endif; endif; endif; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
var baseUrl="<?=$base_url;?>";
function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }

function submitReview(o,i,c){
    var reviewText=$("#reviewText").val();
    var rate=$('input[name="rate"]:checked').val();
    if(c==1){
        showErrorMessage('genericReviewError','Already added review.');
    }else{
        if(reviewText && i){
            $.ajax({
                url: "<?php echo base_url("/web/Web/ajax") ?>",
                type: "POST",
                data: "method=addReview&review="+reviewText+'&rating='+rate+'&product_id='+i,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 200) {
                        alert(jsonData['message']);
                        location.reload()
                    } else {
                        showErrorMessage('genericReviewError',jsonData['message']);
                    }
                },
                error: function (error) {
                    alert("error");
                }
            });
        }else{
            showErrorMessage('reviewTextError','*Required Field');
        }
    }
}
function loginRequired(o,t){
    if(t==1){
        showErrorMessage('genericError','*Need to login first.');
    }else if(t==2){
        showErrorMessage('genericError','Out Of Stock');
    }else if(t==3){
        showErrorMessage('genericReviewError','*Need to login first.');
    }
}
function addToCart(o,p,i,t){
    if(p && i && t){
        $.ajax({
                url: "<?php echo base_url("/web/Web/ajax") ?>",
                type: "POST",
                data: "method=addToCart&product_id="+p+'&item_id='+i+'&type='+t,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 200) {
                        alert(jsonData['message']);
                        location.reload();
                    } else {
                        showErrorMessage('genericError',jsonData['message']);
                        location.reload();
                    }
                },
                error: function (error) {
                    alert("error");
                }
            });
    }else{
        alert("Some error found.");
    }
}
function addToWishlist(o,p){
    if(p){
        $.ajax({
            url: "<?php echo base_url("/web/Web/ajax") ?>",
            type: "POST",
            data: "method=addToWishlist&product_id="+p,
            success: function (data) {
                var dta = $.trim(data);
                var jsonData = $.parseJSON(dta);
                if (jsonData['error_code'] == 200) {
                    alert(jsonData['message']);
                    location.reload();
                } else {
                    showErrorMessage('genericError',jsonData['message']);
                    location.reload();
                }
            },
            error: function (error) {
                alert("error");
            }
        });
    }else{
        alert("Some error found.");
    }
}
</script>





</div>

<script src="<?=base_url()?>assets/web/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/web/js/owl-carousel/owl.carousel.js"></script>
<script src="<?=base_url()?>assets/web/js/themejs/libs.js"></script>
<script src="<?=base_url()?>assets/web/js/unveil/jquery.unveil.js"></script>
<script src="<?=base_url()?>assets/web/js/countdown/jquery.countdown.min.js"></script>
<script src="<?=base_url()?>assets/web/js/dcjqaccordion/jquery.dcjqaccordion.2.8.min.js"></script>
<script src="<?=base_url()?>assets/web/js/datetimepicker/moment.js"></script>
<script src="<?=base_url()?>assets/web/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="<?=base_url()?>assets/web/js/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/web/js/modernizr/modernizr-2.6.2.min.js"></script>
<script src="<?=base_url()?>assets/web/js/minicolors/jquery.miniColors.min.js"></script>
<script src="<?=base_url()?>assets/web/js/themejs/application.js"></script>
<script src="<?=base_url()?>assets/web/js/themejs/homepage.js"></script>
<script src="<?=base_url()?>assets/web/js/themejs/toppanel.js"></script>
<script src="<?=base_url()?>assets/web/js/themejs/so_megamenu.js"></script>
<script src="<?=base_url()?>assets/web/js/themejs/addtocart.js"></script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script>
    function userLogout(){
        if(confirm("Are you sure want to logout!")){
            window.location.href="<?=base_url('ar/logout');?>";
        }
    }
</script>
<script>
    $(document).ready(function () {
        $(document)
        .ajaxStart(function () {
            $('.ajax-loader').css("visibility", "visible");
        })
        .ajaxStop(function () {
            $('.ajax-loader').css("visibility", "hidden");
        });
    });
    
    ///////////////////////////LOADER//////////////
    window.addEventListener( 'load', function () {

        var shwload = document.getElementById( "page_loader" );

        shwload.style.display = "none";

    } )
    ///////////////////////////LOADER//////////////
</script>
</body>

</html>
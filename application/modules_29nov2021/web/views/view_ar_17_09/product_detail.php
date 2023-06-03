
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

#termsproduct .modal-header{
    background: #FF5722;
}
#termsproduct .modal-header{
    background: #FF5722;
}
#termsproduct .modal-header h5{
    font-size: 20px;
    color: #ffffff;
    letter-spacing: 1px;
}
#termsproduct .modal-header .close {
    margin-top: -30px;
    color: #ffffff;
    opacity: 1;
    font-size: 30px;
}
</style>
<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#"><?=$product['category_name'];?></a></li>
                <li><a href="#"><?=$product['name'];?></a></li>
            </ul>
            <div class="row">
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="product-view row">
                        <div class="left-content-product">
                            <div id="image-part-fixed" class="content-product-left  class-honizol col-md-5 col-sm-12 col-xs-12">
                                <div id="fixed-image">
                                    <div class="large-image  ">
                                        <img itemprop="image" class="product-image-zoom" src="<?=$product['images'][0]['image'];?>" data-zoom-image="<?=$product['images'][0]['image'];?>" title="<?=$product['name'];?>" alt="600 X 600">
                                    </div>
                                    <div id="thumb-slider" class="yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="4" data-items_column1="3" data-items_column2="4"  data-items_column3="4" data-items_column4="4" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
                                        <?php if($product['images']): foreach($product['images'] as $key=>$img): ?>
                                        <a data-index="<?=$key;?>" class="img thumbnail " data-image="<?=$img['image'];?>" title="<?=$product['name'];?>">
                                            <img src="<?=$img['image'];?>" title="<?=$product['name'];?>" alt="<?=$product['name'];?>">
                                        </a>
                                        <?php endforeach; endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="content-product-right col-md-7 col-sm-12 col-xs-12">
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
                                            } echo $showReview; ?> آراء العملاء</a> | 

                                            <?php if($product['terms']): ?>
                                                <a class="" href="#termsproduct" data-toggle="modal">الشروط والأحكام | </a>
                                            <?php endif; ?>
                                            <a class="write_review_button" href="#">أكتب رأيك</a>
                                </div>
                                <div class="product-label form-group">
                                    <div class="product_page_price price">
                                        <span class="price-new" itemprop="price"><?=$product['discount_price'];?> LYD</span>
                                        <?php if($product['discount']>0){ ?>
                                            <span class="price-old"><?=($product['price']);?> LYD</span>
                                        <?php } ?>
                                    </div>
                                    <div class="stock"><span>توفر:</span> <span class="status-stock"><?php if($product['quantity']>0){ echo "In Stock"; }else{ echo "Out Of Stock"; }?></span></div>
                                </div>
                                <div class="product-box-desc product-brandss">
                                    <div class="inner-box-desc">
                                        <div class="price-tax"><span>المنتجات:</span> <?=$product['category_name'];?></div>
                                        <div class="reward"><span>تصنيف فرعي:</span> <?=$product['subcategory_name'];?></div>
                                        <div class="brand"><span>العلامات التجارية:</span><?=($product['brand_name']) ? $product['brand_name']:"N/A";?></div>
                                    </div>
                                </div>
                                <div class="short_description form-group">
                                    <div class="title-about-us">
                                        <h2>وصف المنتج </h2>
                                    </div>
                                    <p><?=$product['description'];?> </p>
                                </div>
                                <div id="product">
                                    <h4>الخيارات المتاحة</h4>
                                    <div class="form-group box-info-product">
                                        <p class="errorPrint" id="genericError"></p>
                                        <div id="cartDataQuantity">
                                            <?php if($product['cart_quentity']>0): ?>
                                                <!-- <div class="option quantity">
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
                                                </div> -->


                                                <div class="option quantity-parts">
                                                    <div class="qtySelector text-center">
                                                        <i onclick="addToCart(this,'<?=$product['product_id'];?>','<?=$product['item_id'];?>','2');" class="fa fa-minus decreaseQty"></i>
                                                        <input type="text" name="quantity" readonly value="<?=$product['cart_quentity'];?>" class="qtyValue" value="1">
                                                        <?php if($product['quantity']==0): ?>
                                                            <i onclick="loginRequired(this,2);" class="fa fa-plus increaseQty"></i>
                                                        <?php else: ?>
                                                            <i onclick="addToCart(this,'<?=$product['product_id'];?>','<?=$product['item_id'];?>','1');" class="fa fa-plus increaseQty"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>


                                            <?php else: ?>
                                                <div class="cart">
                                                    <?php if($user_id=="00"): ?>
                                                        <input type="button" onclick="loginRequired(this,1);" data-toggle="tooltip" title="" value="أضف إلى السلة" id="button-cart" class="btn btn-mega btn-lg" data-original-title="أضف إلى السلة">
                                                    <?php else: ?>
                                                        <?php if($product['quantity']==0): ?>
                                                            <input type="button" data-toggle="tooltip" title="" value="أضف إلى السلة" id="button-cart" class="btn btn-mega btn-lg" data-original-title="Out Of Stock">
                                                        <?php else: ?>
                                                            <input type="button" onclick="addToCart(this,'<?=$product['product_id'];?>','<?=$product['item_id'];?>','1');" data-toggle="tooltip" title="" value="أضف إلى السلة" id="button-cart" class="btn btn-mega btn-lg" data-original-title="أضف إلى السلة">
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

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
                                                <h4>تحديد <?=$firstAttributes['name']; ?></h4>
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
                                                            <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])).'/'.$product['product_id'].'/'.$val['item_id']); ?>" id="val_<?=$val['attribute_value_id'];?>" class="btn btn-mega btn-lg <?=$selectedClass;?> " <?=$selectedStyle;?> ><?=$val['value'];?></a>
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
                                                <h4>تحديد <?=$secondAttributes['name']; ?></h4>
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
                                                        <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])).'/'.$product['product_id'].'/'.$val['item_id']); ?>" id="val_<?=$val['attribute_value_id'];?>" class="btn btn-mega btn-lg <?=$selectedClass;?> " <?=$selectedStyle;?> ><?=$val['value'];?></a>
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
                                                <h4>تحديد <?=$thirdAttributes['name']; ?></h4>
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
                                                        <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])).'/'.$product['product_id'].'/'.$val['item_id']); ?>" id="val_<?=$val['attribute_value_id'];?>" class="btn btn-mega btn-lg <?=$selectedClass;?> " <?=$selectedStyle;?> ><?=$val['value'];?></a>
                                                    </div>
                                                    <?php endforeach; endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; endif; endif; endif; endif; ?>
                                </div>

                                <?php if(isset($product['moreVendor']) and $product['moreVendor']): ?>
                                <div class="sold-by">
                                    <h4>Sold By</h4>
                                    <div class="sold-by-vendor">
                                        <div class="vendor-list-part">
                                            <?php if(isset($product['moreVendor'][0]) and $product['moreVendor'][0]):
                                            $firstVendor=$product['moreVendor'][0]; ?>
                                            <?php if(isset($product['moreVendor'][1]) and $product['moreVendor'][1]): ?>
                                                <a data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample" class="change-vendor">Change Vendor</a>
                                            <?php endif; ?>
                                            <div class="list-part">
                                                <label>
                                                    <input type="radio" name="product" class="card-input-element" checked />
                                                    <div class="card-input">
                                                        <div class="user-image">
                                                            <?php if($firstVendor['image']): ?>
                                                                <img src="<?=$firstVendor['image'];?>" title="Vendor image" alt="Vendor image">
                                                            <?php else: ?>
                                                                <img src="<?=$firstVendor['image'];?>" title="Vendor image" alt="Vendor image">
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="vendor-detail">
                                                            <h4><?=$firstVendor['vendor_name'];?></h4>
                                                            <div class="">    
                                                                <a href="<?=base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])).'/'.$firstVendor['product_id']);?>"><?=$firstVendor['price'];?> LYD</a>
                                                            </div>
                                                            <div class="rating">
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                            <?php endif; ?>

                                            <div class="other-vendor collapse" id="collapseExample">
                                                <?php if(isset($product['moreVendor'][1]) and $product['moreVendor'][1]):
                                                $vendorArrs=$product['moreVendor']; 
                                                foreach($vendorArrs as $key=>$vendor):
                                                if($key>0): ?>
                                                <div class="list-part">
                                                    <label>
                                                        <input type="radio" name="product" class="card-input-element" />
                                                        <div class="card-input">
                                                            <div class="user-image">
                                                                <?php if($vendor['image']): ?>
                                                                    <img src="<?=$vendor['image'];?>" title="Vendor image" alt="Vendor image">
                                                                <?php else: ?>
                                                                    <img src="<?=$vendor['image'];?>" title="Vendor image" alt="Vendor image">
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="vendor-detail">
                                                                <h4><?=$vendor['vendor_name'];?></h4>
                                                                <div class="">    
                                                                    <a href="<?=base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $product['name'])).'/'.$firstVendor['product_id']);?>"><?=$firstVendor['price'];?> LYD</a>
                                                                </div>
                                                                <div class="rating">
                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i></span>
                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                    <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                                <?php endif; endforeach; endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>

                                <div class="producttab service-review">
                                    <div class="tabsslider  vertical-tabs col-xs-12">
                                        <?php if(isset($product['specification']) and $product['specification']): ?>
                                        <div class="tab-content col-lg-12 col-sm-12 col-xs-12">
                                            <div class="title-product">
                                                <h1>مواصفات المنتج</h1>
                                            </div>
                                            <div class="why-choose-us">
                                                <div class="content-why">
                                                    <ul class="why-list">
                                                        <?php foreach($product['specification'] as $specify): ?>
                                                            <li><a><?=$specify['name'];?> : <?=$specify['attribute_value']['value'];?></a></li>
                                                        <?php endforeach;?>

                                                        <?php foreach($product['featuers'] as $featuers): ?>
                                                            <li><a><?=$featuers['name'];?></a></li>
                                                        <?php endforeach;?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="tab-content col-lg-12 col-sm-12 col-xs-12">
                                            <div class="title-product">
                                                <h1>آراء العملاء</h1>
                                            </div>
                                            <form>
                                                <div>
                                                    <table class="table table-striped table-bordered">
                                                        <tbody>
                                                            <?php if(isset($product['reviews']) and $product['reviews']):
                                                                $reviewArr=$product['reviews']; ?>
                                                                <?php if(isset($reviewArr['reviews']) and $reviewArr['reviews']):
                                                                foreach($reviewArr['reviews'] as $reviews): ?>
                                                            <tr>
                                                                <td><strong><?=$reviews['user_name'];?></strong></td>
                                                                <td class="text-right"><?=date('d/m/Y',strtotime($reviews['created_at']))?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <p><?=$reviews['review'];?></p>
                                                                    <div class="ratings">
                                                                        <div class="rating-box">
                                                                            <?php for($i=1;$i<=5;$i++){ ?>
                                                                            <span class="fa fa-stack"><i class="fa <?php if($reviews['rating']>=$i){ echo "fa-star"; }else{ echo "fa-star-o"; }?> fa-stack-1x"></i></span>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php endforeach; endif; endif; ?>
                                                        </tbody>
                                                    </table>
                                                    <div class="text-right"></div>
                                                </div>
                                                <h2 id="review-title">أكتب رأيك</h2>
                                                <div class="contacts-form">
                                                    <div class="form-group"> <span class="icon icon-bubbles-2"></span>
                                                        <textarea class="form-control" id="reviewText" name="text" placeholder="مراجعتك"></textarea>
                                                        <p class="errorPrint" id="reviewTextError"></p>
                                                    </div>
                                                    <div class="rate">
                                                        <input type="radio" id="star5" name="rate" value="5" />
                                                        <label for="star5" title="text">5 stars</label>
                                                        <input type="radio" id="star4" name="rate" value="4" />
                                                        <label for="star4" title="text">4 stars</label>
                                                        <input type="radio" id="star3" name="rate" value="3" />
                                                        <label for="star3" title="text">3 stars</label>
                                                        <input type="radio" id="star2" name="rate" value="2" />
                                                        <label for="star2" title="text">2 stars</label>
                                                        <input type="radio" checked id="star1" name="rate" value="1" />
                                                        <label for="star1" title="text">1 star</label>
                                                    </div>
                                                    <div class="buttons clearfix">
                                                        <p class="errorPrint" id="genericReviewError"></p>
                                                        <?php if($user_id=="00"): ?>
                                                            <a id="button-review" onclick="loginRequired(this,3);" class="btn buttonGray">إرسال</a>
                                                        <?php else:
                                                            //echo $product['reviews']['isReview'];
                                                            if(isset($product['reviews']['isReview']) and $product['reviews']['isReview']){
                                                                $isReview=$product['reviews']['isReview'];
                                                            }else{
                                                                $isReview=0;
                                                            }
                                                        ?>
                                                        <a id="button-review" onclick="submitReview(this,'<?=$product['product_id'];?>','<?=$isReview;?>');" class="btn buttonGray">إرسال</a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </form>
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
<?php if(isset($product['silimar_product']) and $product['silimar_product']): ?>
<div class="main-container" id="relatedproduct">
    <div id="content">
        <div class="container">
            <div class="module layout2-listingtab2">
                <div id="so_listing_tabs_2" class="so-listing-tabs first-load">
                    <div class="loadeding"></div>
                    <div class="ltabs-wrap">
                        <div class="ltabs-tabs-container" data-rtl="yes" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="5" data-md="4" data-sm="2" data-xs="1" data-margin="30">
                            <div class="ltabs-tabs-wrap">
                                <ul class="ltabs-tabs cf list-sub-cat font-title">
                                    <li class="ltabs-tab tab-sel" data-category-id="61" data-active-content=".items-category-61"><span class="ltabs-tab-label">منتجات ذات صله</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="wap-listing-tabs ltabs-items-container products-list grid">
                            <div class="ltabs-items ltabs-items-selected items-category-61" data-total="10">
                                <div class="ltabs-items-inner ltabs-slider">
                                    <?php foreach($product['silimar_product'] as $fproduct): ?>
                                    <div class="ltabs-item">
                                        <div class="item-inner product-layout transition product-grid">
                                            <div class="product-item-container">
                                                <div class="left-block">
                                                    <div class="product-image-container <?php if(isset($fproduct['images'][1])): echo "second_img"; endif; ?>">
                                                    <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Dell Laptop">
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
                                                <button type="button" onclick="loginRequired(this,1);" class="addToCart btn-button" title="أضف إلى السلة">  <i class="fa fa-shopping-basket"></i>
                                                    <span>أضف إلى السلة </span>   
                                                </button>
                                            <?php else: ?>
                                                <?php if($fproduct['quantity']==0): ?>
                                                    <button type="button" onclick="loginRequired(this,2);" class="addToCart btn-button" title="أضف إلى السلة">  <i class="fa fa-shopping-basket"></i>
                                                        <span>أضف إلى السلة </span>   
                                                    </button>
                                                <?php else: ?>
                                                    <button type="button" onclick="addToCart(this,'<?=$fproduct['product_id'];?>','<?=$fproduct['item_id'];?>','1');" class="addToCart btn-button" title="Add to cart">  <i class="fa fa-shopping-basket"></i>
                                                        <span>أضف إلى السلة</span>   
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
                                            <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="<?php echo base_url('quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id']); ?>" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>
                                        </div>
                                                </div>
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <h4><a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id']); ?>" title="Redmi Mobile"><?=$fproduct['name'];?></a></h4>
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
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="termsproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Terms & Condition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="short_description form-group">
                    <p><?=$product['terms']?></p>
                </div>
                <!-- <div class="why-choose-us">
                    <div class="content-why">
                        <ul class="why-list">
                            <li><a>At home service</a></li>
                            <li><a>Typesetting industry. Lorem Ipsum has been </a></li>
                            <li><a>Lorem Ipsum has been the industry's</a></li>
                            <li><a>But also the leap into electronic typesetting</a></li>
                            <li><a>Galley of type and scrambled</a></li>
                            <li><a>At home service</a></li>
                            <li><a>Typesetting industry. Lorem Ipsum has been </a></li>
                            <li><a>Lorem Ipsum has been the industry's</a></li>
                            <li><a>But also the leap into electronic typesetting</a></li>
                            <li><a>Galley of type and scrambled</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div> 

<?php endif; ?>

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
            showErrorMessage('reviewTextError','*عليك املاء هذا الفراغ');
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

</script>
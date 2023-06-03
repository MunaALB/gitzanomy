
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

#button-disabled {
    margin-top: 12px;
    padding: 10px 30px;
    margin-right: 10px;
    background: #abacad;
    color: #fff;
    text-transform: capitalize;
    border-radius: 5px;
    border-color: #abacad;
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
                     <div  class="content-product-left  class-honizol col-md-5 col-sm-12 col-xs-12">
                           <div>
                                 <div class="zoomiamge-part">
                                    <img itemprop="image" class="product-image-zoom" src="<?=$product['images'][0]['image'];?>" data-zoom-image="<?=$product['images'][0]['image'];?>" title="<?=$product['name'];?>" title="Men Tshirt" alt="600 X 600">
                                 </div>

                                 <div id="thumb-slider" class="yt-content-slider full_slider owl-drag" data-rtl="yes" data-autoplay="no" data-autoheight="no" data-delay="4" data-speed="0.6" data-margin="10" data-items_column0="4" data-items_column1="3" data-items_column2="4" data-items_column3="1" data-items_column4="1" data-arrows="yes" data-pagination="no" data-lazyload="yes" data-loop="no" data-hoverpause="yes">
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
                           <h1><?=$product['name'];?></h1>
                        </div>
                        <div class="box-review form-group">
                              <div class="ratings">
                                    <div class="rating-box">
                                       <?php for($i=1;$i<=5;$i++){ ?>
                                          <span class="fa fa-stack"><i class="fa <?php if($product['rating']>=$i){ echo "fa-star"; }else{ echo "fa-star-o"; }?> fa-stack-1x"></i></span>
                                       <?php } ?>
                                    </div>
                              </div>
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
                                 <div class="price-tax"><span>Category &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span> <?=$product['category_name'];?></div>
                                 <div class="reward"><span>Sub Category &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </span> <?=$product['subcategory_name'];?></div>
                                 <div class="brand"><span>Brand &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                 : </span><?=($product['brand_name']) ? $product['brand_name']:"N/A";?></div>
                                 <div class="brand"><span>Expected Delivery : </span><?=($product['expected_delivery']) ? date('Y-m-d', strtotime('+'.$product['expected_delivery'].' days')):"N/A";?></div>
                           </div>
                        </div>


                        <div class="producttab service-review">
                           <div class="tabsslider  vertical-tabs col-xs-12">
                              <div class="tab-content col-lg-12 col-sm-12 col-xs-12">
                              <?php if($given_user): ?>
                                 <form>
                                                <div>
                                                    <table class="table table-striped table-bordered">
                                                        <tbody>
                                                                                                                                                                                        <tr>
                                                                <td><strong><?=$combine_error['name']?></strong></td>
                                                                <td class="text-right"><?=date('d/m/Y',strtotime($given_user['created_at']));?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <p><?=$given_user['review'];?></p>
                                                                    <div class="ratings">
                                                                    <?php for($i=1;$i<=5;$i++){ ?>
                                                                            <span class="fa fa-stack"><i class="fa <?php if($given_user['rating']>=$i){ echo "fa-star"; }else{ echo "fa-star-o"; }?> fa-stack-1x"></i></span>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                                                                                    </tbody>
                                                    </table>
                                                    <div class="text-right"></div>
                                                </div>
                                                
                                            </form>
                              <?php else: ?>
                                 <form>
                                    <h2 id="review-title">Write a review</h2>
                                    <div class="contacts-form">
                                             <div class="form-group"> <span class="icon icon-bubbles-2"></span>
                                                <textarea class="form-control" id="reviewText" name="text" placeholder="Your Review"></textarea>
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
                                                <?php if($combine_error){
                                                   //error?>
                                                      <a id="button-review" onclick="submitReview(this);" class="btn buttonGray">Submit</a>
                                                      <?php
                                                }else{ ?>
                                                      <a id="button-disabled"  class="btn buttonGray">Submit</a>
                                                  <?php 
                                                } ?>
                                             </div>
                                       </div>
                                 </form>
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
<script>
var baseUrl="<?=$base_url;?>";
function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }

function submitReview(o){
    var reviewText=$("#reviewText").val();
    var rate=$('input[name="rate"]:checked').val();
    var product_id='<?=$product_id;?>';
    var order_id='<?=$order_id;?>';
    
        if(reviewText){
            $.ajax({
                url: "<?php echo base_url("/web/Web/ajax") ?>",
                type: "POST",
                data: "method=addReview&review="+reviewText+'&rating='+rate+'&product_id='+product_id+'&order_id='+order_id,
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
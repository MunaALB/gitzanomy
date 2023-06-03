<style>
.errorPrint{
    font-size: 12px;
    color: #af2000 !important;
    padding: 5px 5px;
    display: none;
}
</style>
<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
                <li><a href="<?=base_url('service-sub-category');?>"><?=$service['category_name'];?></a></li>
                <li><a href="<?=base_url('service-sub-category');?>"><?=$service['subcategory_name'];?></a></li>
                <li><?=$service['name'];?></li>
            </ul>
            <div class="row">
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="product-view row">
                        <div class="left-content-product">
                            <div class="content-product-left class-honizol col-md-5 col-sm-12 col-xs-12">
                                <!--<div class="large-image  ">-->
                                <div class=" ">
                                    <img itemprop="image" class="product-image-zoom" src="<?=$service['image'];?>" data-zoom-image="<?=$service['image'];?>" title="<?=$service['name'];?>" alt="600 X 600">
                                </div>
                            </div>
                            <div class="content-product-right col-md-7 col-sm-12 col-xs-12">
                                <div class="title-product">
                                    <h1><?=$service['name'];?></h1>
                                </div>
                                <div class="box-review form-group">
                                    <div class="ratings">
                                        <div class="rating-box">
                                            <?php for($i=1;$i<=5;$i++){ ?>
                                                <span class="fa fa-stack"><i class="fa <?php if($service['rating']>=$i){ echo "fa-star"; }else{ echo "fa-star-o"; }?> fa-stack-1x"></i></span>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <a class="reviews_button" href="#">
                                        <?php $showReview=0; if(isset($service['reviews']) and $service['reviews']){
                                        $review=$service['reviews'];
                                            if(isset($review['reviews'][0]) and $review['reviews'][0]){
                                                $showReview=count($review['reviews']);
                                            }
                                        } echo $showReview; ?> reviews</a> | 
                                    <a class="write_review_button" href="#">Write a review</a>
                                </div>
                                <div class="product-label form-group service-pricecart">
                                    <div class="product_page_price price">
                                        <span class="price-new" itemprop="price"><?=$service['discount_price'];?> LYD</span>
                                        <?php if($service['discount']>0){ ?>
                                            <span class="price-old"><?=($service['price']);?> LYD</span>
                                        <?php } ?>
                                    </div>
                                    <div id="product">
                                        <div class="form-group box-info-product">
                                            <div class="cart adto-cart">
                                                <a   role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Book Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="collapse" id="collapseExample">
                                        <div class="bookform">
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group date" id='datetimepicker1'>
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Select Date & Time</label>
                                                    <input type="text" class="form-control" id="date_time" placeholder="Email">
                                                     <span class="input-group-addon"> <span class="glyphicon glyphicon-calendar"></span>
                                                  </div>
                                                </div>
                                                <p class="errorPrint" id="date_timeError"></p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Add a note (optional)</label>
                                                    <textarea class="form-control" id="note" rows="3"></textarea>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <button type="button" onclick="bookService(this);" class="btn btn-default">Book Service</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="short_description form-group">
                                    <div class="title-about-us">
                                        <h2>Service Description</h2>
                                    </div>
                                    <p><?=$service['description'];?></p>
                                </div>
                                <?php if(isset($service['featuers']) and $service['featuers']): ?>
                                <div class="why-choose-us">
                                    <div class="title-about-us">
                                        <h2>Features & Details</h2>
                                    </div>
                                    <div class="content-why">
                                        <ul class="why-list">
                                            <?php foreach($service['featuers'] as $featuers): ?>
                                                <li><a><?=$featuers['featues'];?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="producttab service-review">
                        <div class="tabsslider  vertical-tabs col-xs-12">
                            <div class="tab-content col-lg-12 col-sm-12 col-xs-12">
                                    <div class="title-product">
                                        <h1>Rating & Review</h1>
                                    </div>
                                    <form>
                                        <div >
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <?php if(isset($service['reviews']) and $service['reviews']):
                                                        $reviewArr=$service['reviews']; ?>
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
                                                <?php if($user_id=="00"): ?>
                                                    <a id="button-review" onclick="loginRequired(this,3);" class="btn buttonGray">Submit</a>
                                                <?php else:
                                                    //echo $product['reviews']['isReview'];
                                                    if(isset($service['reviews']['isReview']) and $service['reviews']['isReview']){
                                                        $isReview=$service['reviews']['isReview'];
                                                    }else{
                                                        $isReview=0;
                                                    }
                                                ?>
                                                <a id="button-review" onclick="submitReview(this,'<?=$service['service_id'];?>','<?=$isReview;?>');" class="btn buttonGray">Submit</a>
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
<div class="main-container">
    <div id="content">
        <div class="container">
            <div class="module layout2-listingtab2">
                <div id="so_listing_tabs_2" class="so-listing-tabs first-load">
                    <div class="loadeding"></div>
                    <div class="ltabs-wrap">
                        <div class="ltabs-tabs-container" data-rtl="yes" data-delay="300" data-duration="600" data-effect="starwars" data-ajaxurl="" data-type_source="0" data-lg="5" data-md="4" data-sm="2" data-xs="1" data-margin="30">              <div class="ltabs-tabs-wrap">   
                                <ul class="ltabs-tabs cf list-sub-cat font-title">                                  
                                    <li class="ltabs-tab tab-sel" data-category-id="61" data-active-content=".items-category-61"><span class="ltabs-tab-label">Related Services</span></li>                                              
                                </ul>
                            </div>
                        </div>
                        <div class="wap-listing-tabs ltabs-items-container products-list grid">
                            <div class="ltabs-items ltabs-items-selected items-category-61" data-total="10">
                                <div class="ltabs-items-inner ltabs-slider">
                                    <?php if($service['silimar_service']): foreach($service['silimar_service'] as $booking): ?>
                                        <div class="ltabs-item">
                                            <div class="item-inner product-layout transition product-grid">
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
                data: "method=addServiceReview&review="+reviewText+'&rating='+rate+'&service_id='+i,
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


function bookService(o,i,c){
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

//today = mm + '/' + dd + '/' + yyyy;
today = yyyy + '-' + mm + '-' + dd;
//document.write(today);
console.log(today);
    var user_id='<?=$user_id?>';
    var service_id='<?=$service['service_id']?>';
    var date_time=$("#date_time").val();
    var latitude="28.124578";
    var longitude="78.124578";
    var address="Mandhana Kanpur";
    var res = date_time.split(" ");
    if(res[0]){
        var firstIndex=res[0].split("/");
        var getDate=firstIndex[2]+'-'+firstIndex[1]+'-'+firstIndex[0];
    }
    
    var getTime=res[1];
    var note=$("#note").val();
    //var getTime='';
    if(getDate>today){
        if(getTime){
            var reg_form_data = new FormData();
            reg_form_data.append("user_id",user_id);
            reg_form_data.append("service_id",service_id);
            reg_form_data.append("start_date",getDate);
            reg_form_data.append("start_time",getTime);
            reg_form_data.append("latitude",latitude);
            reg_form_data.append("longitude",longitude);
            reg_form_data.append("address",address);
            reg_form_data.append("note",note);
            reg_form_data.append("is_web","1");
            $.ajax({
                url: baseUrl+'serviceBooking',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    if (returnObject.error_code == 200) {
                        alert(returnObject['message']);
                        //location.reload();
                        window.location.href="<?=base_url('booking-success');?>";
                    }else{
                        alert(returnObject['message']);
                        window.location.href="<?=base_url('booking-failure');?>";
                    }
                    //location.reload();
                },
                error: function (error) {
                        alert("error");
                }
            });
        }else{
            showErrorMessage('date_timeError','*Required field');
        }
    }else{
        showErrorMessage('date_timeError','*Please select future date to book this service.');
    }
}

</script>
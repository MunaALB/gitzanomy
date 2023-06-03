<style>
.errorPrint{
    font-size: 12px;
    color: #af2000 !important;
    padding: 5px 5px;
    display: none;
}
.picker-switch{
    display:none !important;
}
.datepicker{
    /*display:none !important;*/
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
                                        } echo $showReview; ?> reviews</a> 
                                        <!-- |  <a class="write_review_button" href="#">Write a review</a> -->
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
                                            <?php if($login_type=="2"): ?>
                                                <!-- <a  onclick="loginRequired(this,'1');" style="cursor:pointer;">
                                                    <div class="cart adto-cart">
                                                        Book Now
                                                    </div>
                                                </a> -->
                                                <a  role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    <div class="cart adto-cart">
                                                        Book Now
                                                    </div>
                                                </a>
                                            <?php else: ?>
                                                <a  role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    <div class="cart adto-cart">
                                                        Book Now
                                                    </div>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if($login_type=="1"): ?>
                                    <div class="collapse" id="collapseExample">
                                        <div class="bookform">
                                            <div class="row">
                                                <div class="col-md-6">
                                                  <div class="form-group date">
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Select Date</label>
                                                    <input   id="dates" class="form-control">
                                                    <p class="errorPrint" id="datesError"></p>
                                                  </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Select Time</label>
                                                    <input type="time" id="times" class="form-control">
                                                    <p class="errorPrint" id="timesError"></p>
                                                  </div>
                                                </div>
                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Add a note (optional)</label>
                                                    <textarea class="form-control" id="note" rows="3"></textarea>
                                                  </div>
                                                </div>
                                                <div class="col-md-12">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Geo Address</label>
                                                                <input type="text" class="form-control regInputs" onclick="openLocationPicker(this,'1');" value="<?=$address;?>" id="geo_address" name="geo_address" data-title="Geo Address" placeholder="Geo Address">
                                                                <input type="hidden" class="form-control"  id="geo_lat" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="<?=$latitude;?>">
                                                                <input type="hidden" class="form-control"  id="geo_lng" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="<?=$longitude;?>">
                                                                <p class="errorPrint" id="geo_addressError"></p>
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
                                    <?php else: ?>
                                    <div class="collapse" id="collapseExample">
                                        <div class="bookform" id="guestMobileDiv">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label" style="font-size: 15px;">Mobile No</label>
                                                        <div class="mobileno-group">
                                                        <!-- <select id="country_code" class="form-control regInputs">
                                                            <option value="218">+218</option>
                                                        </select> -->
                                                        <input type="text" id="country_code" class="form-control regInputs" value="+218" style="width:15%;float: left;cursor:no-drop;" readonly/>
                                                        <input type="text" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " id="mobile" class="form-control regInputs" data-title="Mobile" />
                                                        <p class="errorPrint" id="mobileError"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="form-group date">
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Select Date</label>
                                                    <input   id="dates" class="form-control">
                                                    <p class="errorPrint" id="datesError"></p>
                                                  </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Select Time</label>
                                                    <input type="time" id="times" class="form-control">
                                                    <p class="errorPrint" id="timesError"></p>
                                                  </div>
                                                </div>

                                                
                                               
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Add a note (optional)</label>
                                                    <textarea class="form-control" id="note" rows="3"></textarea>
                                                  </div>
                                                </div>
                                                <div class="col-md-12">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Geo Address</label>
                                                                <input type="text" class="form-control regInputs" onclick="openLocationPicker(this,'1');" value="<?=$address;?>" id="geo_address" name="geo_address" data-title="Geo Address" placeholder="Geo Address">
                                                                <input type="hidden" class="form-control"  id="geo_lat" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="<?=$latitude;?>">
                                                                <input type="hidden" class="form-control"  id="geo_lng" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="<?=$longitude;?>">
                                                                <p class="errorPrint" id="geo_addressError"></p>
                                                            </div>
                                                        </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <button type="button" onclick="guestLogin(this);" class="btn btn-default">Book Service</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="bookform" id="guestMobileDivOtp" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-6">
                                                  <div class="form-group">
                                                  <p class="errorPrint" id="verificationGenericError"></p>
                                                    <label for="exampleInputEmail1" style="font-size: 15px;">Enter Otp</label>
                                                    <input type="text" id="mobile_otp" class="form-control">
                                                    <p class="errorPrint" id="mobile_otpError"></p>
                                                  </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <div class="form-group">
                                                    <button type="button" onclick="verifyOtp(this);" class="btn btn-default">Verify Otp</button>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php endif; ?>
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
                                                        <?php endforeach; else: echo "<i class='fa fa-sticky-note-o'></i> There is no reviews availble."; endif;
                                                        else:
                                                            echo "<i class='fa fa-sticky-note-o'></i> There is no reviews availble.";
                                                    endif; ?>
                                                </tbody>
                                            </table>
                                            <div class="text-right"></div>
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
    $(".errorPrint").css('display', 'none');
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
    var date=$("#dates").val();
    // alert(date)
    var getTime=$("#times").val();
    var latitude=$("#geo_lat").val();
    var longitude=$("#geo_lng").val();
    var address=$("#geo_address").val();
    var getDate="";
    if(date){
        var firstIndex=date.split("/");
        var getDate=firstIndex[2]+'-'+firstIndex[0]+'-'+firstIndex[1];
    }
    var note=$("#note").val();
    //var getTime='';
    if(getDate){
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
                showErrorMessage('timesError','*Required field');
            }
        }else{
            showErrorMessage('datesError','*Please select future date to book this service.');
        }
    }else{
        showErrorMessage('datesError','*Required field');
    }
}







    function guestLogin(o){

        $(".errorPrint").css('display', 'none');
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
        var mobile=$.trim($("#mobile").val());
        var date=$("#dates").val();
        var getTime=$("#times").val();
        var latitude=$("#geo_lat").val();
        var longitude=$("#geo_lng").val();
        var address=$("#geo_address").val();
        var getDate="";
        if(date){
            var firstIndex=date.split("/");
            var getDate=firstIndex[2]+'-'+firstIndex[0]+'-'+firstIndex[1];
        }
        //alert(getDate)
        var note=$("#note").val();
        //var getTime='';
        if(mobile){
            if(getDate){
                if(getDate>today){
                    if(getTime){
                        var reg_form_data = new FormData();
                        reg_form_data.append("mobile",$.trim($("#mobile").val()));
                        $.ajax({
                            url: baseUrl+'createOtpGuestMobile',
                            type: "POST",
                            data: reg_form_data,
                            enctype: 'multipart/form-data',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                returnObject = JSON.parse(data);
                                if (returnObject.error_code == 200) {
                                    $("#guestMobileDiv").slideUp('slow');
                                    $("#guestMobileDivOtp").slideDown('slow');
                                    showErrorMessage('verificationGenericError',returnObject.message);
                                }else{
                                    alert("Server coudn't send otp on mobile.");
                                }
                            },
                            error: function (error) {
                                alert("error");
                            }
                        });
                    }else{
                        showErrorMessage('timesError','*Required field');
                    }
                }else{
                    showErrorMessage('datesError','*Please select future date to book this service.');
                }
            }else{
                showErrorMessage('datesError','*Required field');
            }
        }else{
            showErrorMessage('mobileError','*Required field');
        }
    }

    function verifyOtp(obj){
        $(".errorPrint").css('display', 'none');
        var mobile=$("#mobile").val();
        var otp=$("#mobile_otp").val();
        var milliseconds = new Date().getTime();
        if (mobile && otp) {
            var reg_form_data = new FormData();
            reg_form_data.append("mobile",mobile);
            reg_form_data.append("country_code",'218');
            reg_form_data.append("otp",otp);
            reg_form_data.append("system_id",'<?=$user_id;?>');
            reg_form_data.append("device_type","3");
            reg_form_data.append("device_id",milliseconds);
            reg_form_data.append("device_token",milliseconds);
             $.ajax({
                url: baseUrl+'verifyOtpMobile',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    //console.log('asasasas' , returnObject);
                    if (returnObject.error_code == 200) {
                        $.ajax({
                                url: "<?php echo base_url("/web/Web/ajax") ?>",
                                type: "POST",
                                data: "method=login&user_id=" + returnObject.data.user_id+'&device_id='+returnObject.data.device_id+'&security_token='+returnObject.data.security_token,
                                success: function (data) {
                                    var dta = $.trim(data);
                                    var jsonData = $.parseJSON(dta);
                                    if (jsonData['error_code'] == 200) {
                                        bookServiceGuest(obj,returnObject.data.user_id)
                                    } else {
                                        alert("Some error found");
                                    }
                                }
                            })
                       //alert(returnObject.message);
                       //window.location.href="<?=base_url();?>";
                    }else{
                        swal({title:"Warning.",text: returnObject.message,type: "warning"})
                    }
                },
                error: function (error) {
                     alert("error");
                }
            });
        } else {
            if(mobile){
                swal({title:"Warning.",text: "*OTP is required field",type: "warning"})
            }else{
                swal({title:"Warning.",text: "*Mobile is required field",type: "warning"})
            }
        }
    }





function bookServiceGuest(o,i,c){
    $(".errorPrint").css('display', 'none');
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    //today = mm + '/' + dd + '/' + yyyy;
    today = yyyy + '-' + mm + '-' + dd;
    //document.write(today);
    console.log(today);
    
    var user_id=i;
    var service_id='<?=$service['service_id']?>';
    var date=$("#dates").val();
    var getTime=$("#times").val();
    var latitude=$("#geo_lat").val();
    var longitude=$("#geo_lng").val();
    var address=$("#geo_address").val();
    var getDate="";
    if(date){
        var firstIndex=date.split("/");
        var getDate=firstIndex[2]+'-'+firstIndex[0]+'-'+firstIndex[1];
    }
    //alert(getDate)
    var note=$("#note").val();
    //var getTime='';
    if(mobile){
        if(getDate){
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
                    showErrorMessage('timesError','*Required field');
                }
            }else{
                showErrorMessage('datesError','*Please select future date to book this service.');
            }
        }else{
            showErrorMessage('datesError','*Required field');
        }
    }else{
        showErrorMessage('mobileError','*Required field');
    }
}

function openLocationPicker(o,t){
    $("#location_btn").attr('data-check',t);
    $("#editaddress").modal('show');
}
</script>
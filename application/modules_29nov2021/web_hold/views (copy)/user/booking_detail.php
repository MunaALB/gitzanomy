
    <style>
.errorPrint{
    font-size: 12px;
    color: #af2000 !important;
    padding: 5px 5px;
    display: none;
}
</style>
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#">User Dashboard</a></li>
        <li><a href="#">Booking Detail</a></li>
    </ul>
    <div class="mycart-part">
        <div class="row">
            <div  id="content" class="col-sm-7">
                <div class="user-rightpart">
                   <h2 class="title">Service Detail</h2>
                    <div class="user-gridpoints">
                        <div class="products-list row nopadding-xs so-filter-gird list">
                            <div class="product-layout col-md-12 col-sm-12 col-xs-12">
                                <div class="product-item-container">
                                    <div class="left-block">
                                        <div class="product-image-container">
                                            <a href="<?php echo base_url('service-detail/'.$requestDetail['service_id']); ?>" target="_self" title="Chicken swinesha">
                                                <img src="<?=$requestDetail['service_image']?>" class="img-1 img-responsive" alt="320 X 320">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4><a href="<?php echo base_url('service-detail/'.$requestDetail['service_id']); ?>" title="Chicken swinesha" target="_self"><?=$requestDetail['service_name']?></a></h4>
                                            <div class="price"> <span class="price-new"><?=$requestDetail['amount'];?> LYD</span>
                                                <?php if($requestDetail['discount']>0): ?>
                                                    <span class="price-old"><?=$requestDetail['price'];?> LYD</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="other-valeu">
                                                <p><span>Date & Time:</span> <?=date('d-m-Y',strtotime($requestDetail['start_date']));?> | <?=date('h:i A',strtotime($requestDetail['start_time']));?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-status">
                                        <h3>Booking Status</h3>
                                        <div class="status-part">
                                            <ul>
                                                <li class="completed" style="width: 19.33% !important;">Pending</li>
                                                <?php $completedClass="";$activeClass=""; for($i=1;$i<=4;$i++): 
                                                        if($i==1){
                                                            $titleItem="Accept";
                                                        }elseif($i==2){
                                                            $titleItem="On The Way";
                                                        }elseif($i==3){
                                                            $titleItem="In Process";
                                                        }else{
                                                            $titleItem="Completed";
                                                        }
                                                        //////////////////////////////
                                                        if($i==$requestDetail['status']):
                                                            $activeClass="active";
                                                            $completedClass="";
                                                        elseif($i<$requestDetail['status']):
                                                            $completedClass="completed";
                                                            $activeClass="";
                                                        else:
                                                            $completedClass="";
                                                            $activeClass="";
                                                        endif; ?>
                                                        <li class="<?=$completedClass?> <?=$activeClass?>" style="width: 19.33% !important;"><?=$titleItem;?></li>
                                                <?php endfor; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="col-sm-5">
                <div class="user-rightpart mb-5">
                      <h2 class="title">Booking Detail</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <strong>Booking Id:</strong>
                                    </td>
                                    <td class="text-right">#<?=$requestDetail['booking_id'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Booking Date:</strong>
                                    </td>
                                    <td class="text-right"><?=date('d-m-Y',strtotime($requestDetail['created_at']));?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Mobile No:</strong>
                                    </td>
                                    <td class="text-right">+<?=$requestDetail['user_country_code'];?> <?=$requestDetail['user_mobile'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Adddress:</strong>
                                    </td>
                                    <td class="text-right"><?=$requestDetail['address'];?></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-left">
                                        <strong>City:</strong>
                                    </td>
                                    <td class="text-right"><?=$requestDetail['address'];?></td>
                                </tr> -->
                                <!-- <tr>
                                    <td class="text-left">
                                        <strong>Country:</strong>
                                    </td>
                                    <td class="text-right">Jordan</td>
                                </tr> -->
                            </tbody>
                        </table>
                </div>
                <div class="user-rightpart mb-5">
                      <h2 class="title">Payment Summary </h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <strong>Payment Method:</strong>
                                    </td>
                                    <td class="text-right">
                                    <?php if($requestDetail['payment_type']==1){ echo "Cash on Delivery"; }else{ echo "Online"; } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Total Service:</strong>
                                    </td>
                                    <td class="text-right">1 Service</td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Sub Total:</strong>
                                    </td>
                                    <td class="text-right"><?=$requestDetail['amount'];?> LYD</td>
                                </tr>
                            </tbody>
                        </table>
                          <!-- <div class="buttons">
                            <div class="checkout-btn"><a href="#>" class="btn btn-primary">Cancel Booking</a></div>
                          </div> -->
                </div>
                <?php if($requestDetail['status']==4): ?>
                    <div class="user-rightpart mb-5">
                	    <h2 class="title">Rating & Review</h2>
                        <div class="producttab service-review">
                            <div class="tabsslider  vertical-tabs col-xs-12">
                                <div class="tab-content col-lg-12 col-sm-12 col-xs-12">
                                    <?php if($requestDetail['isReview']==0): 
                                         $isReview=$requestDetail['isReview'];
                                         ?>
                                        <form>
                                            <div class="contacts-form">
                                                <div class="form-group"> <span class="icon icon-bubbles-2"></span>
                                                    <textarea class="form-control" id="reviewText" name="text" placeholder="Your Review" rows="5"></textarea>
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
                                                    <a id="button-review" onclick="submitReview(this,'<?=$requestDetail['service_id'];?>','<?=$requestDetail['booking_id'];?>');" class="btn buttonGray">Submit</a>
                                                </div>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <form>
                                                <div>
                                                    <table class="table table-striped table-bordered">
                                                        <tbody>
                                                                                                                                                                                        <tr>
                                                                <td><strong><?=$requestDetail['user_name'];?></strong></td>
                                                                <td class="text-right"><?=date('d/m/Y',strtotime($requestDetail['review_created_at']))?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <p><?=$requestDetail['review'];?></p>
                                                                    <div class="ratings">
                                                                        <div class="rating-box">
                                                                        <?php for($i=1;$i<=5;$i++){ ?>
                                                                            <span class="fa fa-stack"><i class="fa <?php if($requestDetail['rating']>=$i){ echo "fa-star"; }else{ echo "fa-star-o"; }?> fa-stack-1x"></i></span>
                                                                        <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                                                                                    </tbody>
                                                    </table>
                                                    <div class="text-right"></div>
                                                </div>
                                                
                                            </form>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
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

function submitReview(o,i,b){
    var reviewText=$("#reviewText").val();
    var rate=$('input[name="rate"]:checked').val();
    
        if(reviewText && i && b){
            $.ajax({
                url: "<?php echo base_url("/web/Web/ajax") ?>",
                type: "POST",
                data: "method=addServiceReview&review="+reviewText+'&rating='+rate+'&service_id='+i+'&booking_id='+b,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 200) {
                        swal({title:"Success.",text: jsonData['message'],type: "success"},function(){ 
                        location.reload();
                    })
                    } else {
                        swal({title:"Warning.",text: jsonData['message'],type: "warning"})
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
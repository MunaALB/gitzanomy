
    <div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#">User Dashboard</a></li>
        <li><a href="#">Request Detail</a></li>
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
                                        <h3>Request Status</h3>
                                        <div class="status-part">
                                            <ul>
                                                <li class="active" style="width: 19.33% !important;">Pending</li>
                                                <li class="" style="width: 19.33% !important;">Accept</li>
                                                <li class="" style="width: 19.33% !important;">On The Way</li>
                                                <li class="" style="width: 19.33% !important;">In Process</li>
                                                <li style="width: 19.33% !important;">Completed</li>
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
                      <h2 class="title">Request Detail</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <strong>Request Id:</strong>
                                    </td>
                                    <td class="text-right">#<?=$requestDetail['booking_id'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Request Date:</strong>
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
                            <div class="checkout-btn"><a href="#>" class="btn btn-primary">Cancel Request</a></div>
                          </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
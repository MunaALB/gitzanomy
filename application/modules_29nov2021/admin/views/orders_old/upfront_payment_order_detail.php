<style>
    /*    .order-status .status-part ul li {
            width: 25%;
        }*/
    .order-details-page .view-detail button {
        background: #f74f00;
        padding: 7px 20px;
        color: #ffffff;
        font-size: 14px;
        border-radius: 5px;
    }
    .img-cirdel{
        display: block;
        max-width: 100%;
        width: 70px;
        height: 70px;
        background: red;
        border-radius: 56px;
    }
    .verifyButton{
        position: absolute;
        margin: 38px -175px;
        background: red;
        color: #fff !important;
        padding: 3px;
        border-radius: 6px;
        cursor:pointer;
    }
    .verifyLabel{
        background: green;
        color: #fff !important;
        position: absolute;
        margin: 39px -139px;
        border-radius: 5px;
        padding: 3px;
    }
    .sold-out-overlay-canceled {
        background: red;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 21px;
        position: absolute;
        right: 169px;
        width: 108px;
        top: 3px;
        -webkit-transform: rotate(-40deg);
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Order Detail</h1>
    </div>
    <?php if($order): ?>
        <div class="content order-details-page">
            <div class="row">
                <div class="col-lg-12">
                    <div class="order-status card">
                        <div class="status-part">
                            <?php $width=30; if(isset($order['order_status_count']) and $order['order_status_count']):
                                $width=(100/$order['order_status_count']); endif;?>
                            <ul>
                            <?php $isJobDoneDriver=true; if(isset($order['order_status']) and $order['order_status']): 
                                foreach($order['order_status'] as $status): ?>
                                    <?php if($status['is_checked']==1):?>
                                        <li class="completed" title="<?=$status['tracker_date']?>" style="width:<?=$width;?>%"><?=$status['order_status'];?></li>
                                    <?php else: $isJobDoneDriver=false; ?>
                                        <li class="" title="Not Update" style="width:<?=$width;?>%"><?=$status['order_status'];?></li>
                                    <?php endif; ?>
                                <?php endforeach; endif; ?>
                                <!-- <li class="completed" style="width:<?=$width;?>%">Dispatched</li>
                                <li class="active" style="width:<?=$width;?>%">Shipped</li>
                                <li style="width:<?=$width;?>%">Delivered</li> -->
                            </ul>
                        </div>
                        <?php if($isJobDoneDriver):
                            if($order['is_upfront_paid']==0): ?>
                                <a class="verifyButton" onclick="verifyUpfrontAmount(this,'<?=$order['order_id'];?>');">Verify Upfront Amount</a>
                            <?php else: ?>
                                <a class="verifyLabel">Verified By Admin</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if ($order['order_items']): foreach ($order['order_items'] as $key => $items): ?>
                        <!-- <div class="card m-b-3">
                            <div class="card-body">
                                <div class="row">
                                <?php if($order['upfront_amount']>0): ?>
                                    <div class="col-lg-6">
                                        <a href="#assigndriver" data-toggle="modal" class="composemail assign-driver pull-right"> Assign For Upfront</a>
                                    </div>
                                <?php endif; ?>
                                    <div class="col-lg-6">
                                        <a href="#" class="composemail assign-driver pull-left">Assign Driver</a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                            <div class="card m-b-3">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- <div class="col-lg-5">
                                            <div class="user-img pull-left"> <img src="<?= $items['image'] ? $items['image'] : base_url() . 'assets/vendor/images/dummy.jpg' ?>" class="img-responsive" alt="User Image"> </div>
                                        </div> -->
                                        <div class="col-lg-5">
                                            <div class="user-img pull-left">
                                            <?php if($items['user_status']==5): ?>
                                                <span class="sold-out-overlay-canceled">Canceled</span>
                                            <?php endif; ?>
                                            <img src="<?= $items['image'] ? $items['image'] : base_url() . 'assets/vendor/images/dummy.jpg' ?>" class="img-responsive" alt="User Image"> </div>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="mail-contnet">
                                                <h4 class="text-black m-b-0"><?= $items['product_name'] ?></h4>
                                                <small><?= $items['category_name'] ?></small>
                                                <div class="product-price"> 
                                                    <span class="price-new"><?= number_format($items['amount'], 2) ?> LYD</span>
                                                    <?php if($items['discount']>0): ?>
                                                        <span class="price-old"><?= number_format($items['price'], 2) ?> LYD</span>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if ($items['vendor_detail']): $vendor = $items['vendor_detail']; ?>
                                                    <a title="view vendor detail" href="<?php echo base_url('admin/vendor-detail/' . $items['vendor_id']); ?>"><small><?= $vendor['name'] ?></small></a>
                                                <?php endif; ?>
                                                <p title="Phone">Quantity:<span> <?= $items['quantity'] ?></span></p>
                                                <div class="view-detail">
                                                    <a href="<?php echo base_url('admin/product-detail/' . $items['product_id']); ?>">View Product</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($items['item_action'] > 0): ?>
                                    <div class="order-status">
                                        <div class="row">
                                            <div class=" offset-2 col-md-10">
                                                <label><?= $items['driver_id'] ? 'Assigned' : 'Assign' ?> Driver :</label>
                                            </div>
                                            <div class="offset-2 col-md-6">
                                                <select class="form-control" name="driver_id" id="driver_id<?= $key ? $key : '' ?>">
                                                    <?php foreach ($driver_list as $driver): ?>
                                                        <option value="<?= $driver['driver_id'] ?>" <?= $driver['driver_id'] == $items['driver_id'] ? 'selected' : '' ?>><?= $driver['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4 view-detail">
                                                <button class="btn btn-sm btn-primary" onclick="assignDriver(this,<?= $items['order_item_id'] ?>,<?= $key ?>)"><?= $items['driver_id'] ? 'Change' : 'Assign' ?></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="order-status">
                                    <div class="status-part">
                                        <ul>
                                        <?php if($items['user_status']==5){
                                            ?>
                                                <li class="active" style="font-size: 13px;width: 40%;">Awating-Confirmation</li>
                                                <li class="active" style="font-size: 13px;width: 40%;">Canceled<a style="cursor:pointer;color: red;" onclick="viewReason(this,'<?=$items['order_item_id'];?>')">(View Reason)</a></li>
                                            <?php
                                        }else{
                                             $completedClass="";$activeClass=""; for($i=1;$i<=4;$i++): 
                                                if($i==1){
                                                    $titleItem="Awating-Confirmation";
                                                }elseif($i==2){
                                                    $titleItem="In-Process";
                                                }elseif($i==3){
                                                    $titleItem="Dispatch";
                                                }else{
                                                    $titleItem="Delivered";
                                                }
                                                //////////////////////////////
                                                if($i==$items['user_status']):
                                                    // $activeClass="active";
                                                    $activeClass="completed";
                                                    $completedClass="";
                                                elseif($i<$items['user_status']):
                                                    $completedClass="completed";
                                                    $activeClass="";
                                                else:
                                                    $completedClass="";
                                                    $activeClass="";
                                                endif; ?>
                                                <li class="<?=$completedClass?> <?=$activeClass?>" style="font-size: 13px;width: 24%;"><?=$titleItem;?></li>
                                        <?php endfor; } ?>
                                    </ul>
                                    </div>
                                </div>
                                <div class="order-status" style="display:none;" id="reason_<?=$items['order_item_id'];?>">
                                    <h3>Cancel Reason</h3>
                                    <div class="status-part">
                                        <p><?=$items['cancel_reason'];?></p>            
                                    </div>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </div>
                <div class="col-lg-4">
                    
                    <div class="box box-primary m-b-3">
                        <div class="box-profile">
                            <h3 class="profile-username">Order Detail</h3>
                            <ul class="nav nav-stacked sty1">
                            <li><strong>Order Date:</strong> <span class="pull-right"><?= date('d-m-Y', strtotime($order['created_at'])) ?></span></li>
                                <li><strong>Payment Mode:</strong> <span class="pull-right"><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></span></li>         
                                <li><strong>Total Products:</strong> <span class="pull-right"><?= $order['items_count'] ?> Item</span></li>
                                <li><strong>Item Amount:</strong> <span class="pull-right"><?= number_format($order['item_amount'],2) ?> LYD</span></li>
                                <li><strong>Delivery Charges:</strong> <span class="pull-right"><?= number_format($order['delivery_charges'],2) ?> LYD</span></li>
                                <li><strong>Order Amount:</strong> <span class="pull-right"><?= number_format($order['total'],2) ?> LYD</span></li>
                                <?php if($order['upfront_amount']>0): ?>
                                    <li><strong>Upfront Amount:</strong> <span class="pull-right"><?= number_format($order['upfront_amount'],2) ?> LYD</span></li>
                                    <li><strong>Rest Amount:</strong> <span class="pull-right"><?= number_format($order['remain_amount'],2) ?> LYD</span></li>
                                <?php endif; ?>
                                <!--<li><strong>Sub Total:</strong> <span class="pull-right"><?= $order['items_total'] ?> LYD</span></li>-->
                            </ul>
                        </div>
                    </div>
                    <div class="box box-primary m-b-3">
                        <div class="box-profile">
                            <h3 class="profile-username">Driver Detail</h3>
                            <?php if ($order['driver_detail']): $driver_detail = $order['driver_detail']; ?>
                                <ul class="nav nav-stacked sty1">
                                    <li><strong>User Name:</strong> <span class="pull-right"><?= $driver_detail['name'] ?></span></li>
                                    <li><strong>Mobile No:</strong> <span class="pull-right"><?= $driver_detail['mobile'] ? '+' . $driver_detail['country_code'] . ' ' . $driver_detail['mobile'] : '' ?></span></li>
                                    <li><strong>Email Id:</strong> <span class="pull-right"><?= $driver_detail['email'] ?></span></li>
                                    <li><strong><br/><a href="<?=base_url('admin/driver-detail/'.$driver_detail['driver_id']);?>">Full Detail</a></strong></li>
                                </ul>
                                <?php
                            else: echo 'N/A';
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="box box-primary m-b-3">
                        <div class="box-profile">
                            <h3 class="profile-username">User Detail</h3>
                            <?php if ($order['user_detail']): $user = $order['user_detail']; ?>
                                <ul class="nav nav-stacked sty1">
                                    <li><strong>User Name:</strong> <span class="pull-right"><?= $user['name'] ?></span></li>
                                    <li><strong>Mobile No:</strong> <span class="pull-right"><?= $user['mobile'] ? '+' . $user['country_code'] . ' ' . $user['mobile'] : '' ?></span></li>
                                    <li><strong>Email Id:</strong> <span class="pull-right"><?= $user['email'] ?></span></li>
                                </ul>
                                <?php
                            else: echo 'N/A';
                            endif;
                            ?>
                        </div>
                    </div>
                    <div class="box box-primary m-b-3">
                        <div class="box-profile">
                            <h3 class="profile-username">Shipping Detail</h3>
                            <?php if ($order['shipping_detail']): $shipping = $order['shipping_detail']; ?>
                                <ul class="nav nav-stacked sty1">
                                    <li><strong>User Name:</strong> <span class="pull-right"><?= $shipping['name'] ?></span></li>
                                    <li><strong>Mobile No:</strong> <span class="pull-right"><?= $shipping['mobile'] ? '+' . $shipping['country_code'] . ' ' . $shipping['mobile'] : '' ?></span></li>
                                    <li><strong>House No:</strong> <span class="pull-right"><?= $shipping['house_no'] ?></span></li>
                                    <li><strong>Street:</strong> <span class="pull-right"><?= $shipping['street_address'] ?></span></li>
                                    <li><strong>Location:</strong> <span class="pull-right"><?= $shipping['geo_address'] ?></span></li>
                                    <li><strong>City:</strong> <span class="pull-right"><?= $shipping['city_name'] ?></span></li>
                                    <li><strong>Country:</strong> <span class="pull-right"><?= $shipping['country_name'] ?></span></li>
                                </ul>
                                <?php
                            else: echo 'N/A';
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="col-lg-12 col-md-12 messege-nodata">
            <i class="fa fa-shopping-bag"></i>
            <h2 class="about-title" style="font-size: 12px;">No Data Found</h2>
        </div>
    <?php endif; ?>
    <script>
        function verifyUpfrontAmount(obj,orderId) {
            if (orderId) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Order/ajax_method",
                    type: 'post',
                    data: 'method=verifyUpfrontAmount&orderId=' + orderId,
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            alert(jsonData['message']);
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            }else{
                aletr("Order not get.");
            }
        }

        function viewReason(o,i){
            $("#reason_"+i).toggle();
        }
    </script>
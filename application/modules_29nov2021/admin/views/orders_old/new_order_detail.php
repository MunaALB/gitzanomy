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
    .sold-out-overlay-delivery{
        background: #097509;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 11px;
        position: absolute;
        right: 129px;
        width: 154px;
        top: 15px;
        -webkit-transform: rotate(-40deg);
    }
    .sold-out-overlay-hub{
        background: red;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        padding: 8px 11px;
        position: absolute;
        right: 159px;
        width: 119px;
        top: 4px;
        -webkit-transform: rotate(-40deg);
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
        <h1>New Order Detail</h1>
    </div>
    <?php if($order): ?>
    <div class="content order-details-page">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($order['order_items']): ?>
                    <!-- <div class="card m-b-3">
                        <div class="card-body">
                            <div class="row">
                            <?php if($order['upfront_amount']>0): ?>
                                <div class="col-lg-4">
                                    <a href="#assigndriver" data-toggle="modal" class="composemail assign-driver pull-right"> Assign For Upfront</a>
                                </div>
                            <?php endif; ?>
                            <?php if($order['isAnyVendorProduct']>0): ?>
                                <div class="col-lg-4">
                                    <?php if($order['is_upfront_paid']==0): ?>
                                        <a style="background:gray;cursor:no-drop;" title="Upfron Order" class="composemail assign-driver pull-left">Get from vendor</a>
                                    <?php else: ?>
                                        <a href="<?=base_url('admin/assigned-driver-for-vendor-product/'.$order['order_id']);?>" class="composemail assign-driver pull-left">Get from vendor</a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                                <div class="col-lg-4">
                                    <?php if($order['is_upfront_paid']==0): ?>
                                        <a style="background:gray;cursor:no-drop;" title="Upfron Order" class="composemail assign-driver pull-left">Ready for delivery</a>
                                    <?php else: ?>
                                        <a href="#" class="composemail assign-driver pull-left">Ready for delivery</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div> -->



                    <?php   if($order['upfront_amount']>0): 
                                $upfrontAncr='<a href="#assigndriver" data-toggle="modal" class="composemail assign-driver pull-right"> Assign For Upfront</a>';
                                $getFromVendor='<a style="background:gray;cursor:no-drop;" title="Upfron Order" class="composemail assign-driver pull-left">Get from vendor</a>';
                                $readyForDelivery='<a style="background:gray;cursor:no-drop;" title="Upfron Order" class="composemail assign-driver pull-left">Ready for delivery</a>';
                            else:
                                if($order['isAnyVendorProduct']>0):
                                    $upfrontAncr='<a style="background:gray;cursor:no-drop;" class="composemail assign-driver pull-right"> Assign For Upfront</a>';
                                    $getFromVendor='<a href="'.base_url('admin/assigned-driver-for-vendor-product/'.$order['order_id']).'" class="composemail assign-driver pull-left">Get from vendor</a>';
                                    $readyForDelivery='<a style="background:gray;cursor:no-drop;" title="Upfron Order" class="composemail assign-driver pull-left">Ready for delivery</a>';
                                else:
                                    $upfrontAncr='<a style="background:gray;cursor:no-drop;" class="composemail assign-driver pull-right"> Assign For Upfront</a>';
                                    $getFromVendor='<a style="background:gray;cursor:no-drop;" class="composemail assign-driver pull-left">Get from vendor</a>';
                                    $readyForDelivery='<a href="'.base_url('admin/assigned-driver-for-user-product/'.$order['order_id']).'" title="Upfron Order" class="composemail assign-driver pull-left">Ready for delivery</a>';
                                endif; 
                            endif;
                    ?>
                    <div class="card m-b-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <?=$upfrontAncr;?>
                                </div>
                                <div class="col-lg-4">
                                <?=$getFromVendor;?>
                                </div>
                               <div class="col-lg-4">
                               <?=$readyForDelivery;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php foreach ($order['order_items'] as $key => $items): ?>
                        <div class="card m-b-3">
                            <div class="card-body">
                                <div class="row">
                                    <!-- <div class="col-lg-5">
                                        <div class="user-img pull-left">
                                        <?php if($items['is_in_hub']==1): ?>
                                            <span class="sold-out-overlay-delivery">Ready for delivery</span>
                                        <?php else: ?> 
                                            <span class="sold-out-overlay-hub">Not received</span>
                                        <?php endif; ?>
                                        <img src="<?= $items['image'] ? $items['image'] : base_url() . 'assets/vendor/images/dummy.jpg' ?>" class="img-responsive" alt="User Image"> </div>
                                    </div> -->
                                    <div class="col-lg-5">
                                        <div class="user-img pull-left">
                                        <?php if($items['user_status']==5): ?>
                                            <span class="sold-out-overlay-canceled">Canceled</span>
                                        <?php else: ?> 
                                            <?php if($items['is_in_hub']==1): ?>
                                                <span class="sold-out-overlay-delivery">Ready for delivery</span>
                                            <?php else: ?> 
                                                <?php if($items['driver_id']==0): ?> 
                                                    <span class="sold-out-overlay-hub">Not Assigned</span>
                                                <?php else: ?>
                                                    <span class="sold-out-overlay-assigned">Assigned Driver</span>
                                                <?php endif; ?>
                                            <?php endif; ?>
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
                                                <?php if($items['user_status']==5): ?>
                                                    <select class="form-control" style="margin-top:10px;width: 220px;">
                                                        <option>Canceled</option>
                                                    </select>
                                                <?php else: ?>
                                                    <select class="form-control" onchange="changeOrderItemUserStatus(this,'<?=$items['order_item_id'];?>');" style="margin-top:10px;width: 220px;">
                                                        <option disabled value="">--Change Status--</option>
                                                        <option value="1" <?php if($items['user_status']==1){ echo 'selected'; }?>>Awating-Confirmation</option>
                                                        <option value="2" <?php if($items['user_status']==2){ echo 'selected'; }?>>In-Process</option>
                                                        <option value="3" <?php if($items['user_status']==3){ echo 'selected'; }?>>Dispatch</option>
                                                        <option value="4" <?php if($items['user_status']==4){ echo 'selected'; }?>>Delivered</option>
                                                    </select>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($items['item_action'] > 0): ?>
                                <!-- <div class="order-status">
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
                                </div> -->
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
                            <li><strong style="color: white;background: red;padding: 3px;">Order Status For User:</strong> 
                                <select class="form-control" onchange="changeOrderUserStatus(this,'<?=$order['order_id'];?>');" style="margin-top: 4px;">
                                    <option disabled value="">--Change Status--</option>
                                    <option value="1" <?php if($order['user_status']==1){ echo 'selected'; }?>>New</option>
                                    <option value="2" <?php if($order['user_status']==2){ echo 'selected'; }?>>In-Process</option>
                                    <option value="3" <?php if($order['user_status']==3){ echo 'selected'; }?>>Delivered</option>
                                </select>
                            </li>
                            <!--<li><strong>Sub Total:</strong> <span class="pull-right"><?= $order['items_total'] ?> LYD</span></li>-->
                        </ul>
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


    <div class="modal fade assign-driverss" data-backdrop="static" id="assigndriver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="; padding-right: 15px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Drivers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if($driver_list): ?>
                    <div class="content">
                        <div class="driver-lists">
                            <div class="row">
                                <?php foreach($driver_list as $list): ?>
                                    <div class="col-lg-12 m-b-3">
                                        <label>
                                            <input type="radio" name="driver_list" value="<?=$list['driver_id'];?>" class="card-input-element">
                                            <div class="card card-input">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-3">
                                                            <div class="user-img pull-left">
                                                            <?php if($list['image']): ?>
                                                                <img src="<?=$list['image'];?>" class="img-circle img-responsive" alt="User Image">
                                                            <?php else: ?>
                                                                <img src="<?=base_url();?>assets/admin/images/logo_zanomy_white.png" style="background:red;" class="img-circle img-responsive" alt="User Image">
                                                            <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-9">
                                                            <div class="mail-contnet">
                                                                <h4 class="text-black m-b-0"><?=$list['name'];?></h4>
                                                                <small>+<?=$list['country_code'];?> <?=$list['mobile'];?></small><br/>
                                                                <small><?=$list['email'];?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <a class="composemail pull-right" onclick="assignForUpfrontAmount(this,'<?=$order['order_id'];?>');" style="cursor:pointer;">Assign</a>
                <?php else:?>
                    <div class="content">
                        <div class="driver-lists">
                            <div class="row">
                                <h5 style="margin-left: 96px;"> No drivers avaliable...</h5>
                            </div>
                        </div>
                    </div>
                    <a href="<?=base_url('admin/add-driver');?>" class="composemail pull-right">Add Driver</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

    <script>
        function assignForUpfrontAmount(obj,orderId) {
            var driver_id=$('input[name="driver_list"]:checked').val();
            if(driver_id==undefined || driver_id=='undefined'){
                alert("Please select a driver.");
            }else{
                if (orderId) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Order/ajax_method",
                        type: 'post',
                        data: 'method=assignForUpfrontAmount&driverId=' + driver_id + '&orderId=' + orderId,
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "100") {
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
        }
        function changeOrderItemUserStatus(o,i){
            var status=$(o).val();
            if(i && status){
                var r = confirm("Are you sure to change status?");
                if (r == true) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Order/ajax_method",
                        type: 'post',
                        data: 'method=changeOrderItemUserStatus&orderItemId=' + i+'&status='+status,
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "100") {
                                location.reload();
                            } else {
                                alert(jsonData['message']);
                            }
                        }
                    });
                }
            }else{
                alert("Some Error Found.")
            }
        }

        function changeOrderUserStatus(o,i){
            var status=$(o).val();
            if(i && status){
                var r = confirm("Are you sure to change status?");
                if (r == true) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Order/ajax_method",
                        type: 'post',
                        data: 'method=changeOrderUserStatus&orderId=' + i+'&status='+status,
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "100") {
                                location.reload();
                            } else {
                                alert(jsonData['message']);
                            }
                        }
                    });
                }
            }else{
                alert("Some Error Found.")
            }
        }

        function viewReason(o,i){
            $("#reason_"+i).toggle();
        }
    </script>
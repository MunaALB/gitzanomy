<style>
.img-circle{
    width: 45px !important;
    height: 45px !important;
}
.btn-new{
    background-color: #d6d6d6 !important;
    border-color: #d6d6d6 !important;
    padding: 2px 12px !important;
    color: black !important;
    cursor: not-allowed !important;
    margin-left: 56px;
}

.btn-new-active{
    background-color: #f74f00 !important;
    border-color: #f74f00 !important;
    padding: 2px 12px !important;
    margin-left: 56px;
}
.set-active-driver{
    border: 1px solid red;
    border-radius: 11px;
}

.activeButton{
    background: #ef4e32 !important;
    border: #ef4e32 !important;
    color: #fff !important;
}
.item_class_css{
    position: absolute;margin-left: -12px;margin-top: -26px;float: right !important;
}

.assignDriverSaved{
    position: absolute;
    margin-left: 110px;
    margin-top: -22px;
}
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Upfront Order Detail</h1>
    </div>
    <div class="content eventdeatil">
        <div class="card">
            <div class="">
                <div id="demo">
                    <div class="step-app order-tabs">
                        <ul class="step-steps">
                            <li class="active"><a href="#step1">Item Detail</a></li>
                            <li class=""><a href="#step2">Order Detail</a></li>
                            <li class=""><a href="#step3">User & Shipping Detail</a></li>
                        </ul>
                        <div class="step-content for-border-remove">












                        
                            <div class="step-tab-panel active" id="step1">
                                <?php  
                                    $upfrontButton= $getFromVendor=$readyForDelivery='';
                                    $assignedUpfrontDriverList=0;
                                    $assignedUpfrontDrivertracker=0;
                                    $assignedUpfrontIsPaid=0;
                                    
                                    ///Upfront Order
                                    if($order['upfront_tracking_id']>0){
                                        //Assigned Driver For Upfront Amount
                                        if($order['is_upfront_paid']==1){
                                            //Paid Upfront Order Amount
                                            $assignedUpfrontDrivertracker=1;
                                            $upfrontButton='<button type="button" class="btn btn-secondary active">Assign of Upfront</button>';
                                            $getFromVendor='<button type="button" class="btn btn-secondary">Get an item</button>';
                                            $readyForDelivery='<button type="button" class="btn btn-secondary">Ready for Delivery</button>';
                                        }else{
                                            //UnPaid Upfront Order Amount
                                            $assignedUpfrontDrivertracker=1;
                                            $upfrontButton='<button type="button" class="btn btn-secondary active">Assign of Upfront</button>';
                                            $getFromVendor='<button type="button" class="btn btn-secondary">Get an item</button>';
                                            $readyForDelivery='<button type="button" class="btn btn-secondary">Ready for Delivery</button>';
                                        }
                                    }else{
                                        ///Not Assigned Driver For Upfront Amount
                                        $assignedUpfrontDriverList=1;
                                        $upfrontButton='<button type="button" class="btn btn-secondary active">Assign of Upfront</button>';
                                        $getFromVendor='<button type="button" class="btn btn-secondary">Get an item</button>';
                                        $readyForDelivery='<button type="button" class="btn btn-secondary">Ready for Delivery</button>';
                                        
                                    }
                                ?>

                                <div class="card-body">
                                    <div class="eventrow">
                                        <div class="item-detail-buttons">
                                            <?php 
                                            echo $upfrontButton; 
                                            echo $getFromVendor;
                                            echo $readyForDelivery;
                                            ?>
                                        </div>
                                    </div>
                                    <?php if($assignedUpfrontDriverList==1){ ?>
                                        <div class="eventrow">
                                            <div class="assign-driver-buttons">
                                                <a href="javascript:void(0)" onclick="driverListShow(this,'1','<?=$order['order_id'];?>');" class="btn btn-secondary activeButton">Assign a Driver</a>
                                            </div>
                                        </div>
                                    <?php }elseif($assignedUpfrontDriverList==2){ ?>
                                        <div class="eventrow">
                                            <div class="assign-driver-buttons" id="assignedByDriverDiv">
                                                <a href="javascript:void(0)" style="cursor: not-allowed;" class="btn btn-secondary">Assign a Driver</a>
                                            </div>
                                        </div>
                                    <?php } ?>


                                    <?php if($assignedUpfrontDrivertracker>0){ ?>
                                        <div class="driver-asssign-status">
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
                                            </ul>
                                            </div>
                                        </div>
                                        <?php if(isset($order['driver_order']) and $order['driver_order']):
                                                    if($order['driver_order']['driver_order_status']==3):
                                                        $assignedUpfrontIsPaid=1;
                                                    endif;
                                                endif;
                                        ?>

                                        <?php if($order['status']==2){ if($assignedUpfrontIsPaid>0){ ?>
                                            <div class="verify-admin">
                                                <a onclick="verifyUpfrontAmount(this,'<?=$order['order_id'];?>');" style="background: #ef4e32;cursor:pointer;color:#fff;">Verified by Admin</a>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="verify-admin">
                                                <a  style="cursor:not-allowed">Verified by Admin</a>
                                            </div>
                                        <?php } } ?>
                                    <?php } ?>
                                </div>
                                <div class="order-products-list">
                                    <div class="card-body">
                                        <?php if(isset($order['order_items']) and $order['order_items']): foreach ($order['order_items'] as $key => $items): ?>
                                        <div class="card m-b-3 order-productss">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="user-img pull-left">
                                                            <img src="<?= $items['image'] ? $items['image'] : base_url() . 'assets/vendor/images/dummy.jpg' ?>" class="img-responsive" alt="User Image" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mail-contnet">
                                                            <h4 class="text-black m-b-0"><?= $items['product_name'] ?></h4>
                                                            <small><?= $items['category_name'] ?></small>
                                                            <div class="product-price">
                                                                <span class="price-new"><?= number_format($items['amount'], 2) ?> LYD</span>
                                                                <?php if($items['discount']>0): ?>
                                                                    <span class="price-old"><?= number_format($items['price'], 2) ?> LYD</span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <p title="Phone">Quantity:<span> <?= $items['quantity'] ?> </span></p>
                                                            <?php if ($items['vendor_detail']): $vendor = $items['vendor_detail']; ?>
                                                                <p><a title="view vendor detail" href="<?php echo base_url('admin/vendor-detail/' . $items['vendor_id']); ?>"><small><?= $vendor['name'] ?></small></a></p>
                                                            <?php endif; ?>
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
                                                    <option value="5" <?php if($items['user_status']==5){ echo 'selected'; }?>>Canceled</option>
                                                </select>
                                            <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mail-contnet">
                                                        <?php if($items['product_from']==1){ ?>
                                                            <h4 class="text-black m-b-0 pull-right">Inventory Item</h4>
                                                        <?php }elseif($items['product_from']==2){ ?>
                                                            <h4 class="text-black m-b-0 pull-right">International Item</h4>
                                                        <?php }else{ ?>
                                                            <h4 class="text-black m-b-0 pull-right">Vendor Item</h4>
                                                        <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-order-status">
                                                <div class="status-part">
                                                    <!-- <ul>
                                                        <li>Awaiting Confirmation</li>
                                                        <li>In Process</li>
                                                        <li>Dispatch</li>
                                                        <li>Delivered</li>
                                                    </ul> -->

                                                    <ul>
                                                        <?php if($items['user_status']==5){
                                                            ?>
                                                                <li class="active" style="font-size: 13px;width: 40%;">Awating-Confirmation</li>
                                                                <li class="active" style="font-size: 13px;width: 40%;">Canceled <?php if($items['cancel_reason']): ?><a style="cursor:pointer;color: red;" onclick="viewReason(this,'<?=$items['order_item_id'];?>')">(View Reason)</a><?php endif; ?></li>
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
                                            <!-- <div class="oredr-lable"><p>Not Assigned</p></div> -->
                                        </div>
                                        <?php endforeach; endif; ?>
                                    </div>
                                </div>
                            </div>



















                            <div class="step-tab-panel for-border-remove" id="step2">
                                <div class=" eventdeatil">
                                    <div class="card-body">
                                        <div class="eventrow">
                                            <div class="row mt-3">
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                <label>Order Items</label>
                                                <br>
                                                <p class="text-muted"><?= $order['items_count'] ?></p>
                                                </div>
                                                
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                <label>Payment method</label>
                                                <br>
                                                <p class="text-muted"><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                <label>Payment Status</label>
                                                <br>
                                                <p class="text-muted"><?= $order['is_upfront_paid'] == 1 ? 'Upfront amount paid' : 'Upfront amount Unpaid' ?> </p>
                                                </div> 
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                <label>Item Amount</label>
                                                <br>
                                                <p class="text-muted"><?= number_format($order['item_amount'],2) ?> LYD</p>
                                                </div>  
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                <label>Delivery Charges</label>
                                                <br>
                                                <p class="text-muted"><?= number_format($order['delivery_charges'],2) ?> LYD</p>
                                                </div>  
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                <label>Order Amount</label>
                                                <br>
                                                <p class="text-muted"><?= number_format($order['total'],2) ?> LYD</p>
                                                </div> 
                                                <?php if($order['upfront_amount']>0): ?>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Upfront Amount</label>
                                                    <br>
                                                    <p class="text-muted"><?= number_format($order['upfront_amount'],2) ?> LYD</p>
                                                </div> 
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Pending Amount</label>
                                                    <br>
                                                    <p class="text-muted"><?= number_format($order['remain_amount'],2) ?> LYD</p>
                                                </div> 
                                            <?php endif; ?>
                                            
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                <label>Ordered on & at</label>
                                                <br>
                                                <p class="text-muted"><?= date('d-m-Y', strtotime($order['created_at'])) ?></p>
                                                </div>  
                                                

                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>User Status</label>
                                                    <br>
                                                    <select class="form-control" onchange="changeOrderUserStatus(this,'<?=$order['order_id'];?>');" style="margin-top: 4px;">
                                                        <option disabled value="">--Change Status--</option>
                                                        <option value="1" <?php if($order['user_status']==1){ echo 'selected'; }?>>New</option>
                                                        <option value="2" <?php if($order['user_status']==2){ echo 'selected'; }?>>In-Process</option>
                                                        <option value="3" <?php if($order['user_status']==3){ echo 'selected'; }?>>Delivered</option>
                                                    </select>
                                                </div> 
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-tab-panel for-border-remove" id="step3">
                                <?php if ($order['shipping_detail']): $shipping = $order['shipping_detail']; ?>
                                    <div class=" eventdeatil">
                                        <div class="card-body">
                                           <div class="eventrow">
                                              <div class="row mt-3">
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>User Name</label>
                                                    <br>
                                                    <p class="text-muted"><?= $order['user_detail']['name'] ?></p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Conatct Number</label>
                                                    <br>
                                                    <p class="text-muted"><?= $order['user_detail']['mobile'] ? '+' . $order['user_detail']['country_code'] . ' ' . $order['user_detail']['mobile'] : '' ?></p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Email Address</label>
                                                    <br>
                                                    <p class="text-muted"><?= $order['user_detail']['email'] ?></p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>House Number</label>
                                                    <br>
                                                    <p class="text-muted"><?= $shipping['house_no'] ?> </p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Street</label>
                                                    <br>
                                                    <p class="text-muted"><?= $shipping['street_address'] ?></p>
                                                 </div>  
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Location</label>
                                                    <br>
                                                    <p class="text-muted"><?= $shipping['geo_address'] ?></p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>City</label>
                                                    <br>
                                                    <p class="text-muted"><?= $shipping['city_name'] ?></p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Country</label>
                                                    <br>
                                                    <p class="text-muted"><?= $shipping['country_name'] ?></p>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                <?php else: echo 'N/A'; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="asiign-driver-list" id="listdriver" style='display:block'>
        <div class="row">
            <div class="col-lg-12 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Assign Driver
                            <div class="assignDriverSaved">
                            <button type="button" id="assignForUpfrontAmount" onclick="assignForUpfrontAmount(this,'<?=$order['order_id'];?>');" class="btn btn-secondary active btn-new">Save</button>
                            </div>
                            <span class="pull-right f-13">
                                <a href="javascript:void(0)" id="remove-driverlist"><i class="fa fa-times"></i></a>
                            </span>
                        </h5>
                        <div class="search-bar">
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Driver..." />
                            </div>
                        </div>
                        <?php if($driver_list): ?>
                            <div class="driverilist-side">
                                <?php foreach($driver_list as $list): ?>
                                    <div class="message-widget" onclick="selectDriver(this,'<?=$order['order_id'];?>','<?=$list['driver_id'];?>')">
                                        <a href="#">
                                            <div class="user-img pull-left">
                                                <?php if($list['image']): ?>
                                                    <img src="<?=$list['image'];?>" class="img-circle img-responsive" alt="User Image" />
                                                <?php else: ?>
                                                    <img src="<?=base_url();?>assets/admin/images/logo_zanomy_white.png" style="background:red;" class="img-circle img-responsive" alt="User Image">
                                                <?php endif; ?>
                                            </div>
                                            <div class="mail-contnet">
                                                <h5><?=$list['name'];?></h5>
                                                <span class="mail-desc"><i class="fa fa-phone"></i> +<?=$list['country_code'];?> <?=$list['mobile'];?> | <i class="fa fa-envelope"></i> <?=$list['email'];?></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
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
    </div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $("#remove-driverlist").click(function () {
            $("#listdriver").removeClass("active");
        });

        function driverListShow(o,t,oid){
            $("#listdriver").addClass("active");
        }
    </script>

    <script>
        function selectDriver(o,i,d){
            $(".message-widget").removeClass('set-active-driver');
            $(o).addClass('set-active-driver');
            $("#assignForUpfrontAmount").removeClass('btn-new');
            $("#assignForUpfrontAmount").addClass('btn-new-active');
            $("#assignForUpfrontAmount").attr('data-driver',d);
        }
        
        function assignForUpfrontAmount(obj,orderId) {
            var driver_id=$('#assignForUpfrontAmount').attr('data-driver');
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
        
        function verifyUpfrontAmount(obj,orderId) {
            var r = confirm("Are you sure?");
            if (r == true) {
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
</div>

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
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Order Detail</h1>
    </div>
    <div class="content order-details-page">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($order['order_items']): foreach ($order['order_items'] as $key => $items): ?>
                        <div class="card m-b-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="user-img pull-left"> <img src="<?= $items['image'] ? $items['image'] : base_url() . 'assets/vendor/images/dummy.jpg' ?>" class="img-responsive" alt="User Image"> </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="mail-contnet">
                                            <h4 class="text-black m-b-0"><?= $items['product_name'] ?></h4>
                                            <small><?= $items['category_name'] ?></small>
                                            <div class="product-price"> 
                                                <span class="price-new"><?= number_format($items['amount'], 2) ?> LYD</span>
                                                <span class="price-old"><?= number_format($items['price'], 2) ?> LYD</span>
                                            </div>
                                            
                                            <p title="Phone">Quantity:<span> <?= $items['quantity'] ?></span></p>
                                            <div class="view-detail"><a href="<?php echo base_url('admin/product-detail/' . $items['product_id']); ?>">View Product</a></div>
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
                                            <?php $completedClass="";$activeClass=""; for($i=1;$i<=4;$i++): 
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
                                            <?php endfor; ?>
                                        </ul>
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
                            <li><strong>Total Products:</strong> <span class="pull-right"><?= $order['items_count'] ?> Item</span></li>
                            <li><strong>Order Date:</strong> <span class="pull-right"><?= date('d-m-Y', strtotime($order['created_at'])) ?></span></li>
                            <li><strong>Payment Mode:</strong> <span class="pull-right"><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></span></li>         
                            <li><strong>Discount:</strong> <span class="pull-right"><?= number_format($order['discount'],2) ?> LYD</span></li>
                            <li><strong>Total Price:</strong> <span class="pull-right"><?= number_format($order['items_total'],2) ?> LYD</span></li>
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
    <script>
        function assignDriver(obj, item_id, count) {
            var driver = $('#driver_id' + (count ? count : '')).val();
            if (driver) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax_method",
                    type: 'post',
                    data: 'method=assignDriver&id=' + item_id + '&driver=' + driver,
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
        }
    </script>
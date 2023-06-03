<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Order Detail</h1>
    </div>
    <div class="content order-details-page">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($order['order_items']): foreach ($order['order_items'] as $items): ?>
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
                                            <p title="Phone">Quantity:<span> <?= $items['quantity'] ?> </span></p>
                                            <div class="view-detail"><a href="<?php echo base_url('vendor/product-detail/' . $items['product_id']); ?>">View Product</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                    $activeClass="active";
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
                            <li><strong>Total Products:</strong> <span><?= $order['items_count'] ?> Item</span></li>
                            <li><strong>Order Date:</strong> <span><?= date('d-m-Y', strtotime($order['created_at'])) ?></span></li>
                            <li><strong>Payment Mode:</strong> <span><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></span></li>         
                            <li><strong>Total Discount:</strong> <span><?= number_format($order['discount'], 2) ?> LYD</span></li>
                            <li><strong>Total Price:</strong> <span><?= number_format($order['items_total'], 2) ?>  LYD</span></li>
                            <!--<li><strong>Sub Total:</strong> <span><?= $order['items_total'] ?> LYD</span></li>-->
                        </ul>
                    </div>
                </div>
                <!--                <div class="box box-primary m-b-3">
                                    <div class="box-profile">
                                        <h3 class="profile-username">User Detail</h3>
                <?php //if ($order['user_detail']): $user = $order['user_detail']; ?>
                                                <ul class="nav nav-stacked sty1">
                                                    <li><strong>User Name:</strong> <span><?= $user['name'] ?></span></li>
                                                    <li><strong>Mobile No:</strong> <span><?= $user['mobile'] ? '+' . $user['country_code'] . ' ' . $user['mobile'] : '' ?></span></li>
                                                    <li><strong>Email Id:</strong> <span><?= $user['email'] ?></span></li>
                                                </ul>
                    <?php
//                else: echo 'N/A';
//                endif;
                ?>
                                    </div>
                                </div>
                                <div class="box box-primary m-b-3">
                                    <div class="box-profile">
                                        <h3 class="profile-username">Shipping Detail</h3>
                <?php //if ($order['shipping_detail']): $shipping = $order['shipping_detail']; ?>
                                                <ul class="nav nav-stacked sty1">
                                                    <li><strong>User Name:</strong> <span><?= $shipping['name'] ?></span></li>
                                                    <li><strong>Mobile No:</strong> <span><?= $shipping['mobile'] ? '+' . $shipping['country_code'] . ' ' . $shipping['mobile'] : '' ?></span></li>
                                                    <li><strong>House No:</strong> <span><?= $shipping['house_no'] ?></span></li>
                                                    <li><strong>Street:</strong> <span><?= $shipping['street_address'] ?></span></li>
                                                    <li><strong>Location:</strong> <span><?= $shipping['geo_address'] ?></span></li>
                                                    <li><strong>City:</strong> <span><?= $shipping['city_name'] ?></span></li>
                                                    <li><strong>Country:</strong> <span><?= $shipping['country_name'] ?></span></li>
                                                </ul>
                    <?php
//                else: echo 'N/A';
//                endif;
                ?>
                                    </div>
                                </div>-->
            </div>
        </div>
    </div>
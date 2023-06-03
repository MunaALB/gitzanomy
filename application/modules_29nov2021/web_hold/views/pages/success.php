<div class="main-container container">
    <div class="mycart-part">

        <div class="row">

            <div id="content" class="col-sm-12">

                <div class="about-us">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 ">
                              <div class="messege-success ordersuccess">
                                <i class="fa fa-check-circle"></i>
                                <h2 class="about-title">Success</h2>
                                <div class="payment-detailss">
                                    <?php if(isset($orderDetail) and $orderDetail): ?>
                                        <p>Order-Id : <span> <?=$orderDetail['order_id'];?></span></p>
                                        <p>Order Date : <span><?=date('d-m-Y',strtotime($orderDetail['created_at']));?></span></p>
                                        <p>Payment Method : <span><?php if($orderDetail['payment_type']==''){ echo "Cash on Delivery"; }else{ echo "Online"; } ?></span></p>
                                        <p>Item Amount : <span><?=$orderDetail['item_amount'];?> LYD</span></p>
                                        <p>Delivery Charges : <span><?=$orderDetail['delivery_charges'];?> LYD </span></p>
                                        <p>Total Amount : <span><?=$orderDetail['total'];?> LYD</span></p>
                                        <p>Upfront Amount : <span><?=$orderDetail['upfront_amount'];?> LYD</span></p>
                                        <p>Sub Total : <span><?=$orderDetail['remain_amount'];?> LYD</span></p>
                                        <p class="sccessmessegee">Order Place successfully. </a></p>
                                        <p> <a href="<?=base_url('order-detail/'.$orderDetail['order_id']);?>" class="vieworderss">View Orders</a> 
                                            <!-- <a href="<?=base_url('user-bill');?>" class="vieworderss">View Bills</a> -->
                                        </p>
                                    <?php else: ?>
                                        <p class="sccessmessegee">Order Place successfully. </p>
                                        <p>
                                        <a href="<?=base_url('order-history');?>" class="vieworderss">View Orders</a> 
                                        <!-- <a href="<?=base_url('user-bill');?>" class="vieworderss">View Bill</a> -->
                                        </p>
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

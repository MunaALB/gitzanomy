<div class="main-container container">
    <div class="mycart-part">

        <div class="row">

            <div id="content" class="col-sm-12">

                <div class="about-us">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 messege-success">
                            <i class="fa fa-check-circle"></i>

                            <h2 class="about-title">Success</h2>
                            <?php if(isset($orderDetail) and $orderDetail): ?>
                                <p>Order-Id : <?=$orderDetail['order_id'];?></p>
                                <p>Order Date : <?=date('d-m-Y',strtotime($orderDetail['created_at']));?></p>
                                <p>Payment Method : <?php if($orderDetail['payment_type']==''){ echo "Cash on Delivery"; }else{ echo "Online"; } ?></p>
                                <p>Item Amount : <?=$orderDetail['item_amount'];?> LYD</p>
                                <p>Delivery Charges : <?=$orderDetail['delivery_charges'];?> LYD</p>
                                <p>Total Amount : <?=$orderDetail['total'];?> LYD</p>
                                <p>Upfront Amount : <?=$orderDetail['upfront_amount'];?> LYD</p>
                                <p>Sub Total : <?=$orderDetail['remain_amount'];?> LYD</p>
                                <p>Order Place successfully. <a href="<?=base_url('order-detail/'.$orderDetail['order_id']);?>">View Orders</a></p>
                            <?php else: ?>
                                <p>Order Place successfully. <a href="<?=base_url('order-history');?>">View Orders</a></p>
                            <?php endif; ?>
                            
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="main-container container">
    <div class="mycart-part">

        <div class="row">

            <div id="content" class="col-sm-12">

                <div class="about-us">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 ">
                              <div class="messege-success ordersuccess">
                                <i class="fa fa-check-circle"></i>
                                <h2 class="about-title">نجاح</h2>
                                <div class="payment-detailss">
                                    <?php if(isset($orderDetail) and $orderDetail): ?>
                                        <p>رقم الطلب : <span> <?=$orderDetail['order_id'];?></span></p>
                                        <p>تاريخ الطلب : <span><?=date('d-m-Y',strtotime($orderDetail['created_at']));?></span></p>
                                        <p>طريقة الدفع او السداد : <span><?php if($orderDetail['payment_type']==''){ echo "الدفع عند الاستلام"; }else{ echo "عبر الانترنت"; } ?></span></p>
                                        <p>كمية المنتجات : <span><?=$orderDetail['item_amount'];?> LYD</span></p>
                                        <p>رسوم التوصيل : <span><?=$orderDetail['delivery_charges'];?> LYD </span></p>
                                        <p>المبلغ الإجمالي : <span><?=$orderDetail['total'];?> LYD</span></p>
                                        <p>إجمالي الدفع المسبق : <span><?=$orderDetail['upfront_amount'];?> LYD</span></p>
                                        <p>المجموع الفرعي : <span><?=$orderDetail['remain_amount'];?> LYD</span></p>
                                        <p class="sccessmessegee">قم بتقديم الطلب بنجاح </a></p>
                                        <p> <a href="<?=base_url('ar/order-detail/'.$orderDetail['order_id']);?>" class="vieworderss">عرض الطلبات</a> 
                                            <!-- <a href="<?=base_url('user-bill');?>" class="vieworderss">View Bills</a> -->
                                        </p>
                                    <?php else: ?>
                                        <p class="sccessmessegee">قم بتقديم الطلب بنجاح </p>
                                        <p>
                                        <a href="<?=base_url('ar/order-history');?>" class="vieworderss">عرض الطلبات</a> 
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

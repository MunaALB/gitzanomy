<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>لائحة الطلبات</h1> 
    </div>
    <div class="content"> 
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card "> 
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr.No.</th>
                                            <th>رقم الأمر</th>
                                            <th>رقم المنتج</th>
                                            <th>السعر الكلي</th>
                                            <th>تاريخ ووقت الطلب</th>
                                            <!--<th>Upfront Amount</th>-->
                                            <th>طريقة الدفع</th>   
                                            <th>الحالة</th>  
                                            <th>عمل</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1;
                                        foreach ($order_list as $order): ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= $order['items_count'] ?> بيع المنتج</td>
                                                <td><?= number_format($order['amount'], 2) ?> LYD</td>
                                                <td><?= $order['created_at'] ?></td> 
                                                <!--<td><?= $order['upfront_amount'] ?> LYD</td>-->
                                                <td><?= $order['payment_type'] == 1 ? 'الدفع عند الاستلام' : 'عبر الانترنت' ?></td> 
                                                <td><span class="text-info">
                                                    <?php if($order['user_status'] == 1): 
                                                                echo "جديد";
                                                        elseif($order['user_status'] == 2): 
                                                            echo "تحت المعالجة";
                                                        else:
                                                            echo "تم التوصيل";
                                                        endif;
                                                    ?>
                                                </span></td>
                                                <td><a href="<?php echo base_url('vendor/order-detail/' . $order['order_id']); ?>" class="composemail">فتح</a></td> 
                                            </tr>
    <?php $count++;
endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
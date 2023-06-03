<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Order List</h1> 
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
                                            <th>Order Id</th>
                                            <th>No of Product</th>
                                            <th>Price</th>
                                            <th>Order Date & Time</th>
                                            <!--<th>Upfront Amount</th>-->
                                            <th>Payment Mode</th>   
                                            <th>Status</th>  
                                            <th>Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1;
                                        foreach ($order_list as $order): ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= $order['items_count'] ?> Product</td>
                                                <td><?= number_format($order['amount'], 2) ?> LYD</td>
                                                <td><?= $order['created_at'] ?></td> 
                                                <!--<td><?= $order['upfront_amount'] ?> LYD</td>-->
                                                <td><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></td> 
                                                <td><span class="text-info">
                                                    <?php if($order['user_status'] == 1): 
                                                                echo "New";
                                                        elseif($order['user_status'] == 2): 
                                                            echo "In-Process";
                                                        else:
                                                            echo "Delivered";
                                                        endif;
                                                    ?>
                                                </span></td>
                                                <td><a href="<?php echo base_url('vendor/order-detail/' . $order['order_id']); ?>" class="composemail">View</a></td> 
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
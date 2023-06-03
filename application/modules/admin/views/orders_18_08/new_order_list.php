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
                                        <th>Order Id</th>
                                        <th>User</th>
                                        <th>Upfront Amount</th>
                                        <th>Amount</th>
                                        <th>Order Date</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>  
                                        <th>Action</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($order_list): foreach ($order_list as $order): ?>
                                            <tr>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><a href="<?php echo base_url('admin/user-detail/' . $order['user_id']); ?>">#<?= $order['user_name'] ?></a></td>
                                                <td><?= number_format($order['upfront_amount'], 2) ?> LYD</td>
                                                <td><?= number_format($order['total'], 2) ?> LYD</td>
                                                <td><?= date('d/m/Y h:i A', strtotime($order['created_at'])) ?></td>
                                                <td><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></td>
                                                <td>
                                                    <?php   if($order['status']==1){ echo '<span class="text-info">New</span>'; } 
                                                        elseif($order['status']==2){ echo '<span class="text-warning">Out For Collecting</span>'; }
                                                        elseif($order['status']==3){ echo '<span class="text-success">Verified Upfront Payment</span>'; }
                                                        elseif($order['status']==4){ echo '<span class="text-info">In-process</span>'; }
                                                        elseif($order['status']==5){ echo '<span class="text-success">Completed</span>'; }
                                                        elseif($order['status']==6){ echo '<span class="text-danger">Cancelled</span>'; }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if ($order['is_seen'] == 0): ?>
                                                        <a title="Unseen"><i class="fa fa-dot-circle-o" aria-hidden="true" style="color: red;position: absolute;margin: -25px 83px;"></i></a>
                                                    <?php endif; ?>
                                                    <a href="<?php echo base_url('admin/new-order-detail/' . $order['order_id']); ?>" class="composemail">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
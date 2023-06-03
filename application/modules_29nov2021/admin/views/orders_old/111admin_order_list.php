<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Admin Order List</h1>
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
                                            <th>User Id</th>
                                            <th>Price</th>
                                            <th>Order Date & Time</th>
                                            <th>Upfront Amount</th>
                                            <th>Payment Mode</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($order_list as $order): ?>
                                        <tr>
                                            <td>#<?=$order['order_id']?></td>
                                            <td><a href="<?php echo base_url('admin/user-detail/'.$order['user_id']); ?>">#<?=$order['user_id']?></a></td>
                                            <td><?=number_format($order['items_total'],2)?> LYD</td>
                                            <td><?= date('d/m/Y h:i A', strtotime($order['created_at'])) ?></td>
                                            <td><?= number_format($order['upfront_amount'],2) ?> LYD</td>
                                            <td><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></td>
                                            <td><span class="text-info"><?= $order['status'] == 1 ? 'New' : 'In-process' ?></span></td>
                                            <td><a href="<?php echo base_url('admin/admin-order-detail/'.$order['order_id']); ?>" class="composemail">View</a></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
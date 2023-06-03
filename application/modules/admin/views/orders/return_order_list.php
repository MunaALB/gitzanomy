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
                            <form method="post" >
                                <div class="eventrow">
                                    <div class="row m-t-2">
                                        <div class="col-md-6">
                                            <label>Product From</label>
                                            <select class="form-control chosen regInputs" data-title="Product From" id="from" name="from">
                                                <option value="">--SELECT Product From--</option>
                                                <option value="1" <?php if(isset($from) and $from==1){ echo 'selected'; }?>>Inventory</option>
                                                <option value="2" <?php if(isset($from) and $from==2){ echo 'selected'; }?>>International</option>
                                                <option value="3" <?php if(isset($from) and $from==3){ echo 'selected'; }?>>Vendor</option>
                                            </select>
                                            <p class="errorPrint" id="fromError"></p>
                                        </div>


                                        <!-- <div class="col-md-6">
                                            <label>Order Status</label>
                                            <select class="form-control chosen regInputs" data-title="Order Status" id="order_status" name="order_status">
                                                <option value="">--SELECT Order Status--</option>
                                                <option value="1" <?php if(isset($order_status) and $order_status==1){ echo 'selected'; }?>>Place Order</option>
                                                <option value="2" <?php if(isset($order_status) and $order_status==2){ echo 'selected'; }?>>Out For Collecting Cash</option>
                                                <option value="3" <?php if(isset($order_status) and $order_status==3){ echo 'selected'; }?>>Collecting cash verify by admin</option>
                                                <option value="4" <?php if(isset($order_status) and $order_status==4){ echo 'selected'; }?>>Inprocess(Pickup Order From Vendor Location/Drop Order To User Location)</option>
                                                <option value="5" <?php if(isset($order_status) and $order_status==5){ echo 'selected'; }?>>Completed</option>
                                                <option value="6" <?php if(isset($order_status) and $order_status==6){ echo 'selected'; }?>>Cancel</option>
                                            </select>
                                            <p class="errorPrint" id="order_statusError"></p>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- <div class="eventrow">
                                    <div class="row m-t-2">
                                        <div class="col-md-6">
                                            <label>Item Status</label>
                                            <select class="form-control chosen regInputs" data-title="Item Status" id="item_status" name="item_status">
                                                <option value="">--SELECT Item Status--</option>
                                                <option value="5" <?php if(isset($item_status) and $item_status==5){ echo 'selected'; }?>>No Any Action</option>
                                                <option value="1" <?php if(isset($item_status) and $item_status==1){ echo 'selected'; }?>>Pickup Order From Vendor Location</option>
                                                <option value="2" <?php if(isset($item_status) and $item_status==2){ echo 'selected'; }?>>Drop Order To User Location</option>
                                                <option value="3" <?php if(isset($item_status) and $item_status==3){ echo 'selected'; }?>>pick up from international product(airport)</option>
                                                <option value="4" <?php if(isset($item_status) and $item_status==4){ echo 'selected'; }?>>Cancel</option>
                                            </select>
                                            <p class="errorPrint" id="brandError"></p>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="eventrow">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <button type="submit" name="filterBtn" class="composemail pull-right">Filter Order</button>
                                            <button type="reset" name="resetBtn" onclick="clearForm(this);" class="composemail  pull-right  m-r-2">Clear All</button> 
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

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
                                                    <a href="<?php echo base_url('admin/return-order-detail/' . $order['order_id']); ?>" class="composemail">View</a>
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
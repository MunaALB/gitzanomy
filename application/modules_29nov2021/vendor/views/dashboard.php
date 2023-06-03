<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Dashboard</h1> 
    </div>

    <div class="content"> 
        <div class="row">
            <div class="col-lg-3 col-xs-6 m-b-3">
                <div class="card">
                    <div class="card-body"><span class="info-box-icon bg-green"><i class="fa fa-bar-chart"></i></span>
                        <div class="info-box-content"> <span class="info-box-number"><?= $this->vendor_data['business_type'] == 1 ? (count($product_list) ? count($product_list) : 0 ) : (count($service_list) ? count($service_list) : 0 ) ?></span> <span class="info-box-text">Total <?= $this->vendor_data['business_type'] == 1 ? 'Products' : 'Services' ?></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6 m-b-3">
                <div class="card">
                    <div class="card-body"><span class="info-box-icon bg-aqua"><i class="fa fa-shopping-cart"></i></span>
                        <div class="info-box-content"> <span class="info-box-number"><?= $orders ?></span> <span class="info-box-text">
                                Total <?= $this->vendor_data['business_type'] == 1 ? 'Orders' : 'Bookings' ?> </span> </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6 m-b-3">
                <div class="card">
                    <div class="card-body"><span class="info-box-icon bg-yellow"><i class="fa fa-server"></i></span>
                        <div class="info-box-content"> <span class="info-box-number">0</span> <span class="info-box-text"><?= $this->vendor_data['business_type'] == 1 ? 'Return Products' : 'Cancelled Services' ?></span></div>
                    </div>
                </div>
            </div> 
            <div class="col-lg-3 col-xs-6 m-b-3">
                <div class="card">
                    <div class="card-body"><span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
                        <div class="info-box-content"> <span class="info-box-number">0 LYD</span> <span class="info-box-text">Total Revenue</span></div>
                    </div>
                </div>
            </div> 
        </div> 
        <?php if ($this->vendor_data['business_type'] == 1): ?>
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Recent Product Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr.No.</th>
                                        <th>Order Id</th>
                                        <th>No of Product</th>
                                        <th>Price</th>
                                        <th>Order Date & Time</th>
                                        <th>Payment Mode</th>   
                                        <th>Status</th>  
                                        <th>Action</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($order_list as $key => $order): if ($key < 5):
                                            ?>
                                            <tr>
                                                <td><?= $count ?></td>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><?= $order['items_count'] ?> Product</td>
                                                <td><?= number_format($order['amount'], 2) ?> LYD</td>
                                                <td><?= $order['created_at'] ?></td>
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
                                            <?php
                                            $count++;
                                        endif;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        <?php else: ?>
            <div class="mt-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Recent Service Bookings</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Booking Id</th>
                                        <th>Service Name</th>
                                        <th>User Name</th>
                                        <th>Price</th>
                                        <th>Booking date & time</th>   
                                        <th>Status</th>  
                                        <th>Action</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1;
                                    foreach ($booking_list as $k => $booking): if ($k < 5):
                                            ?>
                                            <tr>
                                                <td><?= $count; ?></td>
                                                <td><?= $booking['booking_id'] ?></td>
                                                <td><?= $booking['service_name'] ?></td>
                                                <!--<td><?= $booking['service_name'] ?></td>-->
                                                <td><?= $booking['user_name'] ?></td>
                                                <td><?= number_format($booking['amount'], 2) ?> LYD</td>
                                                <td><?= date('d-m-Y', strtotime($booking['start_date'])) . ' ' . date('h:i A', strtotime($booking['start_time'])) ?></td>  
                                                <td>
                                                    <?php if ($booking['status'] == 1) { ?>
                                                        <span class="text-warning">New</span>
                                                    <?php } else if ($booking['status'] == 2) { ?>
                                                        <span class="text-info">On The Way</span>
                                                    <?php } else if ($booking['status'] == 3) { ?>
                                                        <span class="text-info">In Process</span>
                                                    <?php } else if ($booking['status'] == 4) { ?>
                                                        <span class="text-success">Completed</span>
                                                    <?php } else if ($booking['status'] == 5) { ?>
                                                        <span class="text-danger">Cancelled</span>
                                                    <?php } else { ?>
                                                        <span class="text-warning">Pending Request</span>
            <?php } ?>
                                                </td>
                                                <td><a href="<?php echo base_url('vendor/booking-detail/' . $booking['booking_id']); ?>" class="composemail">View</a></td> 
                                            </tr> 
                                            <?php $count++;
                                        endif;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
<?php endif; ?>
    </div>
    <script>
        function checkStatus(obj, id, type) {
            var checked = $(obj).is(':checked');
            if (checked == true) {
                var status = 1;
            } else {
                var status = 2;
            }
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>vendor/Home/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=' + type,
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "200") {
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
            }
        }
        function deleteProduct(obj, id, type) {
            var r = confirm("Are you sure to delete?");
            if (r == true) {
                var status = '99';
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>vendor/Home/ajax",
                        type: 'post',
                        data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=' + type,
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
                                location.reload();
                            } else {
                                alert(jsonData['message']);
                            }
                        }
                    });
                } else {
                    alert("Something Wrong");
                }
            }
        }
    </script>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Vendor Request List</h1>
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
                                            <th>Request Id</th>
                                            <th>Vendor Id</th>
                                            <th>Service Name</th>
                                            <th>Price</th>
                                            <th>Request Date & Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1;
                                        foreach ($booking_list as $booking): ?>
                                            <tr>
                                                <td><?= $count; ?></td>
                                                <td><?= $booking['booking_id'] ?></td>
                                                <td><a href="<?php echo base_url('admin/vendor-detail/' . $booking['vendor_id']); ?>">#<?= $booking['vendor_id'] ?></td>
                                                <!--<td><a href="<?php // echo base_url('admin/user-detail/' . $booking['user_id']); ?>">#<?= $booking['user_id'] ?></td>-->
                                                <td><a href="<?php echo base_url('admin/vendor-service-detail/' . $booking['service_id']); ?>"><?= $booking['service_name'] ?></td>
                                               
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
                                                        <span class="text-danger">Rejected</span>
                                                    <?php } else { ?>
                                                        <span class="text-warning">Pending Request</span>
    <?php } ?>
                                                </td>
                                                <td><a href="<?php echo base_url('admin/vendor-request-detail/' . $booking['booking_id']); ?>" class="composemail">View</a></td> 
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
<style>
    .widget-user .widget-user-image>img {
        width: 90px;
        height: 90px;
        border: 3px solid #fff;
    }
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .user-note-list{
        text-align: justify;
        background: #fff;
        padding: 9px;
    }
    .eyepassword .fa-eye-slash {
        position: absolute;
        bottom: 13px;
        right: 8px;
        font-size: 15px;
        color: gray;
        cursor:pointer;
    }
    .eyepassword .fa-eye {
        position: absolute;
        bottom: 13px;
        right: 8px;
        font-size: 15px;
        color: gray;
        cursor:pointer;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1><?= ($vendor_detail['business_type'] == 1) ? 'Product' : 'Service' ?>  Vendor Detail</h1>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <!-- Widget: user widget style 1 -->
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-gray">
                    </div>
                    <div class="widget-user-image">
                        <?php if ($vendor_detail['image']): ?>
                            <img class="img-circle" src="<?= $vendor_detail['image']; ?>" alt="User Avatar">
                        <?php else: ?>
                            <img class="img-circle" src="<?= base_url() ?>/assets/admin/images/userdummy.png" alt="User Avatar">
                        <?php endif; ?>
                    </div>
                    <div class="box-footer">
                        <div class="text-center mb-4">
                            <?php if ($vendor_detail['status'] == 1): ?>
                                <a href="#exampleModal" data-direction="finish" data-toggle="modal" class="composemail">Click To Block</a> 
                            <?php elseif ($vendor_detail['status'] == 3): ?>
                                <a style="cursor:pointer;" onclick="checkStatus_user(this, '<?= $vendor_detail['vendor_id']; ?>', '1');" class="composemail">Click To Approve</a> 
                            <?php else: ?>
                                <a style="cursor:pointer;" onclick="checkStatus_user(this, '<?= $vendor_detail['vendor_id']; ?>', '1');" class="composemail">Click To Verify</a> 
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Vendor Full Name</h5>
                                    <span><?= $vendor_detail['name']; ?></span> </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Email Address</h5>
                                    <span><?= $vendor_detail['email']; ?></span> 
                                </div>

                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Mobile Number</h5>
                                    <span>+<?= $vendor_detail['country_code']; ?> <?= $vendor_detail['mobile']; ?></span> </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3">

                                <div class="description-block">
                                    <h5 class="description-header">Business Type</h5>
                                    <span><?php
                                        if ($vendor_detail['business_type'] == 1) {
                                            echo "Product";
                                        } else {
                                            echo "Service";
                                        }
                                        ?></span> </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Vendor Commission <a href="#" data-toggle="modal" data-target="#commissionModal"><i class="fa fa-pencil"></i></a></h5>
                                    <span><?= $vendor_detail['commission'] ?>%</span> </div>
                            </div>
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Total Commission </h5>
                                    <span><?= $vendor_detail['total_commission'] ?> LYD</span> </div>
                            </div>
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Paid Commission <?= $vendor_detail['total_commission'] ? '<a href="#" data-toggle="modal" data-target="#updateCommissionModal"><i class="fa fa-pencil"></i></a>' : '' ?></h5>
                                    <span><?= $vendor_detail['paid_commission'] ?> LYD</span> </div>
                            </div>
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Balance Commission </h5>
                                    <span><?= $vendor_detail['total_commission'] - $vendor_detail['paid_commission'] ?> LYD</span> </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <!-- /.description-block -->
                            <?php if ($vendor_detail['business_type'] == 2) { ?>

                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">ID Proof</h5>
                                        <?php if ($vendor_detail['id_proof']) { ?>
                                            <a href="<?= $vendor_detail['id_proof'] ?>" title="view image" target="_blank"><img alt="id proof image" src="<?= $vendor_detail['id_proof'] ?>" style="width:50px;height:50px;"></a>
                                            <?php
                                        } else {
                                            echo "N/A";
                                        }
                                        ?>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">City</h5>
                                        <span><?= $vendor_detail['city_name'] ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">Address</h5>
                                        <span><?= $vendor_detail['address'] ?></span> </div>
                                    <!-- /.description-block -->
                                </div>
                                <div class="col-sm-3">
                                    <div class="description-block">
                                        <h5 class="description-header">Open Time</h5>
                                        <span><?= $vendor_detail['start_time']; ?></span> 
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="description-block">
                                        <h5 class="description-header">Close Time</h5>
                                        <span><?= $vendor_detail['end_time']; ?></span> 
                                    </div>
                                </div>
                                <div class="col-sm-3 border-right">
                                    <div class="description-block" style="    margin-top: 28px;">
                                        <a href="#examplePasswordModal" data-direction="finish" data-toggle="modal" class="composemail">Change Password</a> 
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        <?php } else { ?>
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Selected Hub</h5>
                                    <span class=""><?= $vendor_detail['hub_name'] ?></span> 
                                </div>
                            </div>
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Trusted</h5>
                                    <span class=""><?= $vendor_detail['is_trusted'] ? 'Marked Trusted' : 'Not trusted' ?></span> 

                                    <div class="mytoggle" style="margin-left:40%;">
                                        <label class="switch">
                                            <input type="checkbox" <?= $vendor_detail['is_trusted'] == 1 ? 'checked' : '' ?> onchange="markAsTrusted(this, <?= $vendor_detail['vendor_id'] ?>);">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 border-right">
                                <div class="description-block" style="    margin-top: 28px;">
                                    <a href="#examplePasswordModal" data-direction="finish" data-toggle="modal" class="composemail">Change Password</a> 
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
    </div>

    <div class="card">

        <div class="">

            <div id="demo">

                <div class="step-app">

                    <ul class="step-steps">

                            <!-- <li ><a href="#step1"><span class="number">1</span>Company Detail</a></li> -->
                        <li class="active"><a href="#step2"><span class="number">1</span><?= $vendor_detail['business_type'] == 1 ? 'Product' : 'Service' ?> List</a></li>
                        <li><a href="#step3"><span class="number">2</span><?= $vendor_detail['business_type'] == 1 ? 'Order' : 'Booking' ?> List</a></li>
                        <li><a href="#step4"><span class="number">3</span>Transaction List</a></li>
                        <li class=""><a href="#step5"><span class="number">3</span>NoteBook</a></li> 
                    </ul>

                    <div class="step-content for-border-remove">

                        <!-- <div class="step-tab-panel active" id="step1">

                            <div class="card-body">

                                <div class=" row">
                                    <div class="col-lg-6 col-xs-6 b-r">
                                        <label>Company Name</label>
                                        <p class="text-muted">Beauty Salon</p>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 b-r">
                                        <label>Company Mobile Number </label>
                                        <p class="text-muted">9825645451</p>
                                    </div>
                                </div>
                                <div class=" row mt-3">
                                    <div class="col-lg-6 col-xs-6 b-r">
                                        <label>Company Address</label>
                                        <p class="text-muted">H/123, Beauty Salon, UK.</p>
                                    </div>
                                </div>
                            </div>

                        </div> -->

                        <div class="step-tab-panel active" id="step2">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if ($vendor_detail['business_type'] == 1): ?>
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Product ID</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Added on & at</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($vendor_product): foreach ($vendor_product as $list): ?>
                                                        <tr>
                                                            <td><a href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>">#<?= $list['product_id']; ?></a></td>
                                                            <td><?= $list['name']; ?></td>
                                                            <td><?= $list['quantity']; ?></td>
                                                            <td><?= $list['price']; ?> LYD</td>
                                                            <td><?= date('d/m/Y H:i A', strtotime($list['created_at'])); ?></td>
                                                            <td>
                                                                <!-- <div class="mytoggle">
                                                                    <label class="switch">
                                                                    <input type="checkbox" <?php
                                                                if ($list['status'] == '1'): echo "checked";
                                                                endif;
                                                                ?> onchange="checkStatus_user(this,'<?= $list['product_id']; ?>');">
                                                                    <span class="slider round"></span>
                                                                    </label>
                                                                </div> -->
                                                                <div class="mytoggle">
                                                                    <label class="switch">
                                                                        <input type="checkbox" <?= $list['status'] == 1 ? 'checked' : '' ?> onchange="checkStatus(this, <?= $list['product_id'] ?>);">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            </td> 
                                                            <td>
                                                                <a href="<?= base_url('admin/edit-product-detail/' . $list['product_id']); ?>" class="composemail"><i class="fa fa-edit"></i></a>
                                                                <a href="#" onclick="deleteProduct(this, <?= $list['product_id'] ?>);" class="composemail"><i class="fa fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Service ID</th>
                                                    <th>Service Name</th>
                                                    <th>Service Category</th>
                                                    <th>Price</th>
                                                    <th>Added on & at</th>  
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead> 
                                            <tbody>
                                                <?php if ($service_list): foreach ($service_list as $service): ?>
                                                        <tr>
                                                            <td>#<?= $service['service_id'] ?></a></td>
                                                            <td><?= $service['name'] ?></td>
                                                            <td><?= $service['category_name'] ?></td>
                                                            <td><?= $service['price'] ?> LYD</td>
                                                            <td><?= $service['created_at'] ?></td>  
                                                            <td>
                                                                <div class="mytoggle">
                                                                    <label class="switch">
                                                                        <input type="checkbox" <?= $service['status'] == 1 ? 'checked' : '' ?> onchange="checkStatusService(this,<?= $service['service_id'] ?>);">
                                                                        <span class="slider round"></span>
                                                                    </label>
                                                                </div>
                                                            <td><a href="<?= base_url() ?>admin/vendor-service-detail/<?= $service['service_id'] ?>" class="composemail">View</a></td> 
                                                        </tr> 
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                </div>

                            </div>

                        </div>

                        <div class="step-tab-panel for-border-remove booking-detail" id="step3">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <?php if ($vendor_detail['business_type'] == 1): ?>
                                        <table id="example2" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>User Id</th>
                                                    <th>Price</th>
                                                    <th>Order Date & Time</th>
                                                    <th>Payment Status</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody><?php foreach ($order_list as $order): ?>
                                                    <tr>
                                                        <td>#<?= $order['order_id'] ?></td>
                                                        <td><a href="<?php echo base_url('admin/user-detail/' . $order['user_id']); ?>">#<?= $order['user_id'] ?></a></td>
                                                        <td><?= number_format($order['amount'], 2) ?> LYD</td>
                                                        <td><?= date('d/m/Y h:i A', strtotime($order['created_at'])) ?></td>
                                                        <td><?= $order['is_paid'] == 1 ? 'PAID' : 'UNPAID' ?></td>
                                                        <td><span class="text-info"><?= $order['status'] == 1 ? 'New' : 'In-process' ?></span></td>
                                                        <td><a href="<?php echo base_url('admin/vendor-order-detail/' . $order['order_id'] . '/' . $vendor_detail['vendor_id']); ?>" class="composemail">View</a><br>
                                                            <br>
                                                            <?php if ($order['is_paid'] == 0):
                                                                ?><a style="cursor:pointer;" onclick="payCommission(this,<?= $vendor_detail['vendor_id']; ?>,<?= $order['amount'] ?>,<?= $order['order_id'] ?>,<?= $order['admin_commission'] ?>);" class="composemail">Pay</a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else: ?>
                                        <table id="example2" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sr.no</th>
                                                    <th>Booking Id</th>
                                                    <th>Service Name</th>
                                                    <!--<th>SubCategory</th>-->
                                                    <th>User Name</th>
                                                    <th>Price</th>
                                                    <th>Booking date & time</th>   
                                                    <th>Status</th>  
                                                    <th>Action</th>  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 1;
                                                foreach ($booking_list as $booking):
                                                    ?>
                                                    <tr>
                                                        <td><?= $count; ?></td>
                                                        <td><?= $booking['booking_id'] ?></td>
                                                        <td><?= $booking['service_name'] ?></td>
                                                        <!--<td><?= $booking['service_name'] ?></td>-->
                                                        <td><a href="<?php echo base_url('admin/user-detail/' . $booking['user_id']); ?>">#<?= $booking['user_id'] ?></a></td>
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
                                                        <td>
                                                            <?php if ($booking['status'] == 0 or $booking['status'] == 5): ?>
                                                                <a href="<?php echo base_url('admin/vendor-request-detail/' . $booking['booking_id']); ?>" class="composemail">View</a>
                                                            <?php else: ?>
                                                                <a href="<?php echo base_url('admin/vendor-booking-detail/' . $booking['booking_id']); ?>" class="composemail">View</a>
                                                            <?php endif; ?>
                                                        </td> 
                                                    </tr> 
                                                    <?php
                                                    $count++;
                                                endforeach;
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                        <div class="step-tab-panel for-border-remove booking-detail" id="step4">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered">
                                        <thead>
                                            <tr>

                                                <th>Sr.no.</th>
                                                <th>Order Id</th>
                                                <th>Trans Id</th>
                                                <th>Amount</th>
                                                <th>Trans Date & Time</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($vendor_transaction):$count = 1;
                                                foreach ($vendor_transaction as $transaction):
                                                    ?>
                                                    <tr>
                                                        <td><?= $count ?></td>
                                                        <td>#<?= $transaction['order_id'] ?></td>
                                                        <td>#<?= $transaction['vendor_commission_id'] ?></td>
                                                        <td><?= $transaction['amount'] ?> LYD</td>
                                                        <td><?= date('d-m-Y h:i A', strtotime($transaction['created_at'])) ?></td>
                                                    </tr>
                                                    <?php
                                                    $count++;
                                                endforeach;
                                            endif;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <div class="step-tab-panel for-border-remove booking-detail" id="step5">
                                <div class="card-body">
                                    <form method="POST" id="regForm" enctype="multipart/form-data">
                                        <div class="card-body"> 
                                            <div class="row">
                                                
                                                <div class="col-md-12">
                                                    <label for="validationCustom01">Add Note</label>
                                                    <textarea name="note" id="note" rows="6" class="form-control"></textarea>
                                                    <p class="errorPrint" id="noteError"></p>
                                                    <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="addNote(this)">Submit</button>  
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php if(isset($user_note) and $user_note): ?>
                                        <div class="col-md-12" style="background: #ebf5f2;padding: 21px;">
                                            <?php foreach($user_note as $note): ?>
                                            <p class="user-note-list">
                                                <?=$note['note'];?>  <br><br>By <?=$note['admin'];?>   |   <?=date('d/m/Y H:i:s',strtotime($note['created_at']));?>
                                            </p>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div> 
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
<div class="modal fade modal-design" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Block ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group mb-4"> 
                        <textarea id="reason" class="form-control"  data-title="Reason" placeholder="Please Enter Your Reason to Block"></textarea>
                        <p class="errorPrint" id="reasonError"></p>
                    </div>
                    <a style="cursor:pointer;" onclick="checkStatus_user(this, '<?= $vendor_detail['vendor_id']; ?>', '2');" class="composemail  pull-right">Submit</a>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div id="commissionModal" class="modal fade" role="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!--            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="text-align-last: center">Register</h4>
                        </div>-->
            <div class="modal-body">
                <form method="POST" id="regForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Vendor Commission</label>
                            <input type="text"  onchange="checkNumbersOnly(this);"  value="<?= $vendor_detail['commission'] ?>" min="0" max="100" class="form-control mb-4" data-title="Commission" id="commission" name="commission" placeholder="Commission (%)">
                            <p class="text-danger" id="percentageError"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="updateCommission(this, <?= $vendor_detail['vendor_id'] ?>);" id="add_product_set" class="composemail pull-right" style="padding:10px 15px !important;">Update</button>
            </div>
        </div>
    </div>
</div>

<div id="updateCommissionModal" class="modal fade" role="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <!--            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="text-align-last: center">Register</h4>
                        </div>-->
            <div class="modal-body">
                <form method="POST" id="regForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Update Paid Amount</label>
                            <input type="hidden" name="vendor_id" id="vendor_id">
                            <input type="text" onchange="checkValidNumbersOnly(this);" class="form-control mb-4" data-title="Paid Amount" id="paid" name="paid" placeholder="Paid Amount">
                            <p class="text-danger" id="paidError"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="updatePaidCommission(this,<?= $vendor_detail['vendor_id'] ?>);" id="add_product_set" class="composemail pull-right" style="padding:10px 15px !important;">Update</button>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade modal-design" id="examplePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examplePasswordModalLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group mb-4 eyepassword"> 
                            <input class="form-control regInputs" data-title="Password" id="password" name="password" type="Password" placeholder="">
                            <i class="fa fa-eye showhide" data-count="1" onclick="showHide(this);"></i>
                        </div>
                        <p class="errorPrint" style="margin-top: -23px;" id="passwordError"></p>
                        <a style="cursor:pointer;" onclick="changePassword(this, '<?= $vendor_detail['vendor_id']; ?>', '1');" class="composemail  pull-right">Submit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    function showErrorMessage(id, msg) {
        $("#" + id).empty();
        $("#" + id).append(msg);
        $("#" + id).css('display', 'block');
    }
    function checkStatus_user(obj, id, status) {
        var reason = '';
        var idValidate = false;
        if (status == 2) {
            reason = $('#reason').val();
            if (reason) {

            } else {
                idValidate = true;
            }
        }
        if (idValidate) {
            showErrorMessage('reasonError', '*Required Field');
            return false;
        } else {
            if (confirm("Are You sure want to change the status!")) {
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=ChangeStatusSetting&id=' + id + '&action=' + status + '&type=2' + '&reason=' + reason,
                        success: function (data) {
                            var dt = $.trim(data);
                            //alert(dt);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "100") {
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
    }
</script>


<script>
    function checkStatus(obj, id) {
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 2;
        }
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Home/ajax",
                type: 'post',
                data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
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
    function deleteProduct(obj, id) {
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            var status = '99';
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/home/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
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

    function checkStatusService(obj, id) {
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 2;
        }
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax_method",
                type: 'post',
                data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=6',
                success: function (data) {
                    var dt = $.trim(data);
                    var jsonData = $.parseJSON(dt);
                    if (jsonData['error_code'] == "100") {
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
    function deleteService(obj, id) {
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            var status = '99';
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax_method",
                    type: 'post',
                    data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=6',
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
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


    function updateCommission(obj, id) {
        var commission = $('#commission').val();
        if (commission != "") {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=updateCommissionVendor&vendor_id=' + id + '&commission=' + commission,
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
            $('#percentageError').html('* Commission is required field');
        }
    }

</script>
<script>
    function payCommission(obj, id, amount, order_id, admin_commission) {
        var check = confirm('Are you sure to proceed?');
        var paid_amount = amount;
        if (check) {
            if (id) {
                if (paid_amount != "" && paid_amount != 0) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=updatePaidCommissionVendor&vendor_id=' + id + '&paid_amount=' + paid_amount + '&order_id=' + order_id + '&admin=' + admin_commission,
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
                    $('#paidError').html('* Paid Amount is required field');
                }
            } else {
                alert('Some error occured');
            }
        }
    }

    function checkValidNumbersOnly(obj) {
        var regex2 = new RegExp(/^[0-9]+([.])+[0-9]+$/);
        var regex = new RegExp(/^[0-9]+$/);
        var flag = 0;
        var number = 0;
        var discount = $(obj).val();
        if (regex2.test(discount)) {
            flag = 1;
        } else {
            if (regex.test(discount)) {
                flag = 1;
            } else {
                flag = 0;
            }
        }
        if (flag) {
            $('#paidError').html('');
            $('#add_product_set').attr('disabled', false);
        } else {
            $('#paidError').html('* not a valid number. amount should be between 0 - 100 number only');
            $('#add_product_set').attr('disabled', true);
            return false;
        }
    }
</script>
<script>
    function markAsTrusted(obj, id) {
        var checked = $(obj).is(':checked');
        var permission = false;
        if (checked == true) {
            var status = 1;
            permission = confirm('Are you sure to mark this vendor as trusted?');
        } else {
            var status = 0;
            permission = confirm('Are you sure to remove this vendor from trusted?');
        }
        if (permission) {
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Settings/ajax",
                    type: 'post',
                    data: 'method=markAsTrusted&vendor_id=' + id + '&action=' + status,
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
                alert('Some error occured');
            }
        }
    }

    function addNote(o,status){
        var createValue="<?=$user_id?>";
        if(createValue){
            var note=$.trim($("#note").val());
            if (note) {
                $.ajax({
                    url: "<?php echo base_url("/admin/Home/ajax") ?>",
                    type: 'post',
                    data: 'method=sendNote&id=' + createValue+'&note='+note+'&type=2',
                    success: function (data) {
                        var dt = $.trim(data);
                        //alert(dt);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            alert(jsonData['message']);
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            }else{
                $("#noteError").empty();
                $("#noteError").append('*Note is required field.');
                $("#noteError").css('display','block');
            }
        }else{
            alert("Please select User.");
        }
    }

    function showHide(obj) {
        var check = $(obj).attr('data-count');
        if (check == 1) {
            $("#password").attr('type', 'text');
            $(obj).attr('data-count', '0');
            $(obj).removeClass('fa-eye');
            $(obj).addClass('fa-eye-slash');
        } else {
            $("#password").attr('type', 'password');
            $(obj).attr('data-count', '1');
            $(obj).removeClass('fa-eye-slash');
            $(obj).addClass('fa-eye');
        }
    }
    function changePassword(o,i,t){
        var password = $.trim($("#password").val());
        var driver_id = i;
        if(password && driver_id){
            if ((password.length) < 8) {
                showErrorMessage('passwordError', 'Password should be greater than 7 digits.');
            } else {
                var reg_form_data = new FormData();
                reg_form_data.append("password", password);
                reg_form_data.append("driver_id", driver_id);
                reg_form_data.append("type", t);
                reg_form_data.append("method", 'changePassword');
                $.ajax({
                    url: "<?php echo base_url("/admin/Home/ajax") ?>",
                    type: "POST",
                    data: reg_form_data,
                    enctype: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        returnObject = JSON.parse(data);
                        //console.log('asasasas' , returnObject);
                        if (returnObject['error_code'] == 100) {
                            alert(returnObject['message']);
                            location.reload();
                        } else {
                            alert(returnObject['message']);
                        }
                    },
                    error: function (error) {
                        alert("error");
                    }
                });
            }
        }else{
            showErrorMessage('passwordError', '*Password is required field.');
        }
    }

</script>

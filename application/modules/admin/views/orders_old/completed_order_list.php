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
                            <form method="post" >
                                <div class="eventrow">
                                    <div class="row m-t-2">
<!--                                        <div class="col-md-4">
                                            <label>Select Vendor</label>
                                             <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> 
                                            <select class="form-control chosen regInputs" id="vendor" data-title="Vendor" name="vendor_id">
                                                <option value="">--SELECT VENDOR--</option>
                                                <?php if ($vendor_list): foreach ($vendor_list as $list): ?>
                                                        <option value="<?= $list['vendor_id']; ?>" <?= set_value('vendor_id') ? ( $list['vendor_id'] == set_value('vendor_id') ? 'selected' : '') : '' ?>><?= $list['name']; ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <p class="errorPrint" id="vendorError"></p>
                                        </div>-->
                                        <div class="col-md-6">
                                            <label>Select User</label>
                                            <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                            <select class="form-control chosen regInputs" id="user" data-title="User" name="user_id">
                                                <option value="">--SELECT USER--</option>
                                                <?php if ($vendor_list): foreach ($user_list as $lists): ?>
                                                        <option value="<?= $lists['user_id']; ?>" <?= set_value('user_id') ? ( $lists['user_id'] == set_value('user_id') ? 'selected' : '') : '' ?>><?= $lists['name']; ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <p class="errorPrint" id="vendorError"></p>
                                        </div>
                                        <div class="col-md-5 m-t-3">
                                            <!--<div class="form-group">-->

                                            <button type="submit" name="filterBtn"  class="composemail pull-right">Filter Product</button>&nbsp;
                                            <button type="reset" name="resetBtn" onclick="clearForm(this);" class="composemail  pull-right  m-r-2">Clear All</button> 
                                            <!--</div>-->
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
                                            <th>Order Date & Time</th>
                                            <th>Payment Mode</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order_list as $order): ?>
                                            <tr>
                                                <td><?= $order['order_id'] ?></td>
                                                <td><a href="<?php echo base_url('admin/user-detail/' . $order['user_id']); ?>">#<?= $order['user_name'] ?></a></td>
                                                <td><?= number_format($order['upfront_amount'], 2) ?> LYD</td>
                                                <td><?= number_format($order['total'], 2) ?> LYD</td>
                                                <td><?= date('d/m/Y h:i A', strtotime($order['created_at'])) ?></td>
                                                <td><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></td>
                                                <td><span class="text-info">Complete</span></td>
                                                <td>
                                                    <?php if ($order['is_seen'] == 0): ?>
                                                        <a title="Unseen"><i class="fa fa-dot-circle-o" aria-hidden="true" style="color: red;position: absolute;margin: -25px 83px;"></i></a>
                                                    <?php endif; ?>
                                                    <a href="<?php echo base_url('admin/completed-order-detail/' . $order['order_id']); ?>" class="composemail">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function clearForm(obj) {
            $('.chosen').trigger('chosen:updated');
            $('select').val('');
            $('form').submit();
        }
    </script>
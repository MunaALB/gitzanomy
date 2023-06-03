<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Dashboard</h1>
    </div>

    <div class="content">
        <div class="row">
            <div class="col-lg-4 col-xs-6 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <span class="info-box-icon">
                            <img src="<?php echo site_url(); ?>assets/admin/images/users.png"  alt="Total Users">
                        </span>
                        <div class="info-box-content"> 
                            <span class="info-box-number"><?= $users_count; ?></span> <span class="info-box-text">Total Users </span> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <span class="info-box-icon">
                            <img src="<?php echo site_url(); ?>assets/admin/images/vendors.png"  alt="Total Users">
                        </span>
                        <div class="info-box-content"> 
                            <span class="info-box-number"><?= $vendor_count; ?></span> <span class="info-box-text">Total Vendors </span> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xs-6 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <span class="info-box-icon">
                            <img src="<?php echo site_url(); ?>assets/admin/images/drivers.png"  alt="Total Users">
                        </span>
                        <div class="info-box-content"> 
                            <span class="info-box-number"><?= $driver_count; ?></span> <span class="info-box-text">Total Drivers </span> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($is_product_privilege) { ?>
            <div class="mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Recent Added Products</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive edit-icon">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($product_list): foreach ($product_list as $list): ?>
                                            <tr>
                                                <td><a title="view detail" href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>">#<?= $list['product_id']; ?></a></td>
                                                <td><?= $list['category_name']; ?> >> <?= $list['sub_category_name']; ?></td>
                                                <td><?= $list['name']; ?></td>
                                                <!-- <td><?= $list['price']; ?> LYD</td> -->
                                                <td><?= number_format(($list['price'] - (($list['price'] * $list['discount']) / 100)), 2); ?> LYD
                                                    <?php if ($list['discount'] > 0): ?>
                                                        <p class="text-muted" style="text-decoration: line-through;"><?= number_format($list['price'], 2); ?> LYD</p>                                    
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $list['quantity']; ?></td>
                                                <td>
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
                        </div>
                    </div>
                </div>
            </div>
        <?php } if ($is_service_privilege) { ?>
            <div class="mt-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Recent Added Services</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive edit-icon">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Service ID</th>
                                        <th>Service Name</th>
                                        <th>Category Name</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($services as $service): ?>
                                        <tr>
                                            <td><a title="view detail" href="<?php echo site_url('admin/vendor-service-detail/' . $service['service_id']); ?>">#<?= $service['service_id'] ?></a></td>
                                            <td><?= $service['name'] ?></td>
                                            <td><?= $service['category_name'] ?></td>
                                            <td><?= $service['price'] ?> LYD</td>
                                            <td><span class="text-info"><?= $service['discount'] ? $service['discount'] . '%' : '0' ?></span></td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?= $service['status'] == 1 ? 'checked' : '' ?>  onchange="checkStatusService(this,<?= $service['service_id'] ?>);">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <!-- <a href="#" class="composemail"><i class="fa fa-edit"></i></a> -->
                                                <a href="#" onclick="deleteService(this, <?= $service['service_id'] ?>);" class="composemail"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>

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
    </script>
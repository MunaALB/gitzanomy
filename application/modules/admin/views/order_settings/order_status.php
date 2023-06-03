<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .fa_btn {
        background: #f74f00;
        color: #ffffff !important;
        padding: 4px 6px !important;
        margin-top: 0px;
        border-radius: 30px;
        margin-left: 0px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1><?php if (isset($edit)) { echo 'Edit ';} ?>Order Status Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Order Status Management</li>
        </ol>
    </div>

    <div class="content">
        <?= $this->session->flashdata('response'); ?>
        <div class="row">
            <?php if (!isset($edit)) { ?>
                <div class="col-md-5">
                    <div class="card">
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label>Select Type</label>
                                        <select class="form-control chosen regInputs" data-title="Type" id="type" name="type">
                                            <option value="1">Admin</option>
                                            <option value="2">Vendor</option>
                                            <option value="3">Driver</option>
                                        </select>
                                        <p class="errorPrint" id="typeError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Order Status(In English)</label>
                                        <input type="text" id="order_status" class="form-control mb-4 regInputs" name="order_status" placeholder="Order Status" data-title="Order Status (En)">
                                        <p class="errorPrint" id="order_statusError"></p>
                                        <?= form_error('order_status') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Order Status(In Arabic)</label>
                                        <input type="text" id="order_status_ar" class="form-control mb-4 regInputs" name="order_status_ar" placeholder="Order Status"  data-title="Order Status (Ar)">
                                        <p class="errorPrint" id="order_status_arError"></p>
                                        <?= form_error('order_status_ar') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-5">
                    <div class="card">
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label>Select Type</label>
                                        <select class="form-control chosen regInputs" data-title="Type" id="type" name="type">
                                            <option value="1" <?= $edit['type'] == 1 ? 'Selected' : 'Disabled' ?>>Admin</option>
                                            <option value="2" <?= $edit['type'] == 2 ? 'Selected' : 'Disabled' ?>>Vendor</option>
                                            <option value="3" <?= $edit['type'] == 3 ? 'Selected' : 'Disabled' ?>>Driver</option>
                                        </select>
                                        <p class="errorPrint" id="typeError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Order Status(In English)</label>
                                        <input type="text" id="order_status" class="form-control mb-4 regInputs" name="order_status" value="<?= $edit['order_status'] ?>" placeholder="Order Status" data-title="Order Status (En)">
                                        <p class="errorPrint" id="order_statusError"></p>
                                        <?= form_error('order_status') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Order Status(In Arabic)</label>
                                        <input type="text" id="order_status_ar" class="form-control mb-4 regInputs" name="order_status_ar" value="<?= $edit['order_status_ar'] ?>"  placeholder="Order Status"  data-title="Order Status (Ar)">
                                        <p class="errorPrint" id="order_status_arError"></p>
                                        <?= form_error('order_status_ar') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" data-count="1" onclick="saveData(this, 1)">Update</button>  
                                        <a href="<?= base_url('admin/delivery-charge'); ?>" class="composemail mt-4 pull-right" style="margin-right: 3px;">Cancel</a>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-7">
                <div class="card"> 
                    <div class="card-body">
                        <form method="post" id="submitFormCategory">
                            <div class="row mb-4">
                                <div class="col-md-12 mb-2">
                                    <label>Select Type</label>
                                    <select class="form-control chosen" name="type" onchange="filter();">
                                        <!--<option selected disabled>Select Hub</option>-->
                                        <option value="1" <?php echo set_select('type', '1', False); ?>>Admin</option>
                                        <option value="2" <?php echo set_select('type', '2', False); ?>>Vendor</option>
                                        <option value="3" <?php echo set_select('type', '3', False); ?>>Driver</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Order Status</th>
                                        <th>Order Status (Ar)</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($status_list as $listing) { ?>
                                        <tr>
                                            <td><?= $listing['type'] == 1 ? 'Admin' : ($listing['type'] == 2 ? 'Vendor' : 'Driver') ?></td>
                                            <td><?= $listing['order_status'] ?></td>
                                            <td><?= $listing['order_status_ar'] ?></td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?php
                                                        if ($listing['status'] == '1'): echo "checked";
                                                        endif;
                                                        ?> onchange="checkStatus(this, '<?= $listing['status_id']; ?>');">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td> 
                                            <td>
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/order-status-management/' . $listing['status_id']); ?>"><i class="fa fa-edit"></i></a>
                                                <a class="composemail fa_btn" onclick="deleleData(this, '<?= $listing['status_id']; ?>');"><i class="fa fa-trash-o"></i></a>
                                            </td> 
                                        </tr> 
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

        function checkStatus(obj, id) {
            var txt;
            var checked = $(obj).is(':checked');
            if (checked == true) {
                var status = 1;
            } else {
                var status = 0;
            }

            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax_method",
                    type: 'post',
                    data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=4',
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
                location.reload();
            }
        }

        function deleleData(obj, id) {
            var r = confirm("Are you sure to delete!");
            if (r == true) {
                if (id) {
                    status = '99';
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax_method",
                        type: 'post',
                        data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=4',
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
                    location.reload();
                }
            }
        }
    </script>
    <script type="text/javascript">
        function saveData(o) {
            $(".errorPrint").css('display', 'none');
            var idValidate = false;
            $(".regInputs").each(function (index, value) {
                // console.log('div' + index + ':' + $(this).attr('id'));
                if ($(this).val()) {
                    $("#" + $(this).attr('id') + 'Error').css('display', 'none');
                } else {
                    idValidate = true;
                    $("#" + $(this).attr('id') + 'Error').empty();
                    $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('data-title') + ' is required field');
                    $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                    //$("html, body").animate({ scrollTop: 0 }, "slow");
                }
            });
            if (idValidate) {
                return false;
            } else {
                $("#regForm").submit();
            }
        }

        function filter() {
            $("#submitFormCategory").submit();
        }
    </script>  
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
        <h1><?php if (isset($edit)) {
    echo 'Edit ';
} ?>Delivery Charges Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i><?php if (isset($edit)) {
    echo 'Edit ';
} ?>Delivery Charges Management</li>
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
                                        <label>Select Hub</label>
                                        <select class="form-control chosen regInputs" data-title="Hub" id="hub_id" name="hub_id">
                                            <option value="">Select Hub</option>
    <?php foreach ($hub_list as $rows) { ?>
                                                <option value="<?= $rows['id'] ?>"><?= $rows['name']; ?></option>
    <?php } ?>
                                        </select>
                                        <p class="errorPrint" id="hub_idError"></p>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label>Select City</label>
                                        <select class="form-control chosen regInputs" data-title="City" id="city_id" name="city_id">
                                            <option value="">Select City</option>
    <?php foreach ($city_list as $row) { ?>
                                                <option value="<?= $row['city_id'] ?>"><?= $row['name']; ?></option>
    <?php } ?>
                                        </select>
                                        <p class="errorPrint" id="city_idError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Charges</label>
                                        <input type="number" id="charge" class="form-control mb-4 regInputs" name="charge" placeholder="Charge"  data-title="Charge">
                                        <p class="errorPrint" id="chargeError"></p>
    <?= form_error('charge') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Expected Delivery</label>
                                        <input type="number" id="expected_delivery" class="form-control mb-4 regInputs" name="expected_delivery" placeholder="Expected Delivery (in days)"  data-title="Expected Delivery">
                                        <p class="errorPrint" id="expected_deliveryError"></p>
    <?= form_error('expected_delivery') ?>
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
                                        <label>Select Hub</label>
                                        <select class="form-control chosen regInputs" data-title="Hub" id="hub_id" name="hub_id">
                                            <option value="">Select Hub</option>
    <?php foreach ($hub_list as $rows) { ?>
                                                <option value="<?= $rows['id'] ?>" <?= $edit['hub_id'] == $rows['id'] ? 'selected' : '' ?>><?= $rows['name']; ?></option>
    <?php } ?>
                                        </select>
                                        <p class="errorPrint" id="hub_idError"></p>
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label>Select City</label>
                                        <select class="form-control chosen regInputs" data-title="City" id="city_id" name="city_id">
                                            <option value="">Select City</option>
    <?php foreach ($city_list as $row) { ?>
                                                <option value="<?= $row['city_id'] ?>" <?= $edit['city_id'] == $row['city_id'] ? 'selected' : '' ?>><?= $row['name']; ?></option>
    <?php } ?>
                                        </select>
                                        <p class="errorPrint" id="city_idError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Charges</label>
                                        <input type="number" id="charge" class="form-control mb-4 regInputs" name="charge" placeholder="Charge" value="<?= $edit['delivery_charge'] ?>" data-title="Charge">
                                        <p class="errorPrint" id="chargeError"></p>
    <?= form_error('charge') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Expected Delivery</label>
                                        <input type="number" id="expected_delivery" class="form-control mb-4 regInputs" name="expected_delivery" value="<?= $edit['expected_delivery'] ?>" placeholder="Expected Delivery (in days)"  data-title="Expected Delivery">
                                        <p class="errorPrint" id="expected_deliveryError"></p>
    <?= form_error('expected_delivery') ?>
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
                                    <label>Select Hub</label>
                                    <select class="form-control chosen" name="hub" onchange="filter();">
                                        <!--<option selected disabled>Select Hub</option>-->
<?php foreach ($hub_list as $row) { ?>
                                            <option value="<?= $row['id'] ?>" <?php echo set_select('hub', $row['id'], False); ?>><?php echo $row['name']; ?></option>
<?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Hub</th>
                                        <th>City</th>
                                        <th>Charges</th>
                                        <th>Expected Delivery</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
<?php foreach ($charges_list as $listing) { ?>
                                        <tr>
                                            <td><?= $listing['hub_name'] ?></td>
                                            <td><?= $listing['city_name'] ?></td>
                                            <td><?= $listing['delivery_charge'] ?></td>
                                            <td><?= $listing['expected_delivery']?$listing['expected_delivery'].' days':'' ?></td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?php
    if ($listing['status'] == '1'): echo "checked";
    endif;
    ?> onchange="checkStatus(this, '<?= $listing['id']; ?>');">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td> 
                                            <td>
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/delivery-charge/' . $listing['id']); ?>"><i class="fa fa-edit"></i></a>
                                                <a class="composemail fa_btn" onclick="deleleData(this, '<?= $listing['id']; ?>');"><i class="fa fa-trash-o"></i></a>
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
                    data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=3',
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
                        data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=3',
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

        $('.numberOnly').keypress(function (e) {
            var regex = new RegExp(/^[0-9]+$/);
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            } else {
                e.preventDefault();
                return false;
            }
        });
    </script>  
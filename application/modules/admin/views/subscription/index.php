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
        <h1>Subscription Plan Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Subscription Plan Management</li>
        </ol>
    </div>

    <div class="content">
        <?= $this->session->flashdata('response'); ?>
        <div class="row">
            <?php if (!isset($edit)) { ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"> 
                            <h5>Add Plan</h5>
                        </div>
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label>Select Category</label>
                                        <select class="form-control chosen regInputs" data-title="Service Category" id="service_category_id" name="service_category_id">
                                            <option value="">Select Category</option>
                                            <?php foreach ($category_list as $rows) { ?>
                                                <option value="<?= $rows['category_id'] ?>"><?= $rows['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <p class="errorPrint" id="service_category_idError"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Plan Name(In English)</label>
                                        <input type="text" class="form-control mb-4 regInputs" id="name_en" name="name" placeholder="Plan Name" data-title="Plan Name">
                                        <?= form_error('name') ?>
                                        <p class="errorPrint" id="name_enError"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Plan Name(In Arabic)</label>
                                        <input type="text" class="form-control mb-4 regInputs" id="name_ar" name="name_ar" placeholder="Plan Name (Ar)" data-title="Plan Name (Ar)">
                                        <?= form_error('name_ar') ?>
                                        <p class="errorPrint" id="name_arError"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Price</label>
                                        <input type="text" id="price" class="form-control mb-4" name="price" placeholder="Price" data-title="Price">
                                        <p class="errorPrint" id="priceError"></p>
                                        <?= form_error('price') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Discount (%)</label>
                                        <input type="text" id="discount" class="form-control mb-4" name="discount" placeholder="Discount" data-title="Discount">
                                        <p class="errorPrint" id="discountError"></p>
                                        <?= form_error('discount') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Description (In English)</label>
                                        <textarea id="description" class="form-control mb-4 regInputs" name="description" placeholder="Description" data-title="Description"></textarea>
                                        <p class="errorPrint" id="descriptionError"></p>
                                        <?= form_error('description') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Description (In Arabic)</label>
                                        <textarea id="description_ar" class="form-control mb-4 regInputs" name="description_ar" placeholder="Description" data-title="Description"></textarea>
                                        <p class="errorPrint" id="description_arError"></p>
                                        <?= form_error('description_ar') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Days</label>
                                        <input type="text" id="duration" class="form-control mb-4 regInputs" name="duration" placeholder="Days" data-title="Days">
                                        <p class="errorPrint" id="durationError"></p>
                                        <?= form_error('duration') ?>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"> 
                            <h5>Edit Plan</h5>
                        </div>
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label>Select Service Category</label>
                                        <select class="form-control chosen regInputs" data-title="Category" id="service_category_id" name="service_category_id">
                                            <option value="">Select Category</option>
                                            <?php foreach ($category_list as $rows) { ?>
                                                <option value="<?= $rows['category_id'] ?>" <?= $edit['service_category_id'] == $rows['category_id'] ? 'selected' : 'disabled' ?>><?= $rows['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <p class="errorPrint" id="service_category_idError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Plan Name(In English)</label>
                                        <input type="text" class="form-control mb-4 regInputs" id="name_en" name="name" value="<?= $edit['name'] ?>" placeholder="Plan Name" data-warning="errorWarning1">
                                        <?= form_error('name') ?>
                                        <p class="errorPrint" id="name_enError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Plan Name(In Arabic)</label>
                                        <input type="text" class="form-control mb-4 regInputs" id="name_ar" name="name_ar" value="<?= $edit['name_ar'] ?>" placeholder="Plan Name (Ar)" data-warning="errorWarning2">
                                        <?= form_error('name_ar') ?>
                                        <p class="errorPrint" id="name_arError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Price</label>
                                        <input type="text" id="price" class="form-control mb-4" name="price" placeholder="Price" value="<?= $edit['price'] ?>" data-title="Price">
                                        <p class="errorPrint" id="priceError"></p>
                                        <?= form_error('price') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Discount (%)</label>
                                        <input type="text" id="discount" class="form-control mb-4" name="discount" placeholder="Discount" value="<?= $edit['discount'] ?>" data-title="Discount">
                                        <p class="errorPrint" id="discountError"></p>
                                        <?= form_error('discount') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Description (In English)</label>
                                        <textarea id="description" class="form-control mb-4 regInputs" name="description" placeholder="Description" data-title="Description"><?=$edit['description']?></textarea>
                                        <p class="errorPrint" id="descriptionError"></p>
                                        <?= form_error('description') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Description (In Arabic)</label>
                                        <textarea id="description_ar" class="form-control mb-4 regInputs" name="description_ar" placeholder="Description" data-title="Description"><?=$edit['description_ar']?></textarea>
                                        <p class="errorPrint" id="description_arError"></p>
                                        <?= form_error('description_ar') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Day</label>
                                        <input type="text" id="duration" class="form-control mb-4 regInputs" value="<?=$edit['duration']?>" name="duration" placeholder="Days" data-title="Days">
                                        <p class="errorPrint" id="durationError"></p>
                                        <?= form_error('duration') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" data-count="1" onclick="saveData(this, 1)">Update</button>  
                                        <a href="<?= base_url('admin/subscription-plan-list'); ?>" class="composemail mt-4 pull-right" style="margin-right: 3px;">Cancel</a>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="content">
    <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"> 
                            <h5>Subscription Plan List</h5>
                        </div>
                    <div class="card-body">
                        <form method="post" id="submitFormCategory">
                            <div class="row mb-4">
                                <div class="col-md-12 mb-2">
                                    <label>Select Service Category</label>
                                    <select class="form-control chosen" name="service_category" onchange="filter();">
                                        <option selected disabled>Select Category</option>
                                        <?php foreach ($category_list as $row) { ?>
                                            <option value="<?= $row['category_id'] ?>" <?=set_value('service_category') == $row['category_id']?'selected':''?>><?php echo $row['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Plan</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Days</th>
                                        <th>Description</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($plan_list as $listing) { ?>
                                        <tr>
                                            <td><?= $listing['category_name'] ?></td>
                                            <td><?= $listing['name'] ?></td>
                                            <td><?= $listing['price'] ?></td>
                                            <td><?= $listing['discount']?$listing['discount'].'%':'' ?></td>
                                            <td><?= $listing['duration'] ?></td>
                                            <td><?= $listing['description'] ?></td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?php
                                                        if ($listing['status'] == '1'): echo "checked";
                                                        endif;
                                                        ?> onchange="checkStatus(this, '<?= $listing['plan_id']; ?>');">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td> 
                                            <td>
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/subscription-plan-list/' . $listing['plan_id']); ?>"><i class="fa fa-edit"></i></a>
                                                <a class="composemail fa_btn" onclick="deleleData(this, '<?= $listing['plan_id']; ?>');"><i class="fa fa-trash-o"></i></a>
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
                    data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=5',
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
                        data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=5',
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
//                 console.log('div' + index + ':' + $(this).attr('id'));
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
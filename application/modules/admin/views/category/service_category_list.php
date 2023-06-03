<style>
    .errorPrint {
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

    .margin-20 {
        margin-top: 20px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Service Category Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Service Category Management</li>
        </ol>
    </div>
    <?= $this->session->flashdata('response'); ?>
    <div class="content">
        <div class="row">
            <?php if (!isset($edit)) { ?>
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Category Name(In English)</label>
                                        <input type="text" id="english" class="form-control mb-4 regInputs" name="english" placeholder="Category Name" data-title="Category Name(En)">
                                        <p class="errorPrint" id="englishError"></p>
                                        <?= form_error('english') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Category Name(In Arabic)</label>
                                        <input type="text" id="arabic" class="form-control mb-4 regInputs" name="arabic" placeholder="Category Name" data-title="Category Name(Ar)">
                                        <p class="errorPrint" id="arabicError"></p>
                                        <?= form_error('arabic') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="validationCustom01">Category Image</label>
                                        <input type="file" onchange="validImage(this,'input-file-now-custom-1');" id="input-file-now-custom-1" name="image" class="dropify regInputs" data-title="Image" accept="image/*" />
                                        <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                        <?= form_error('image') ?>
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Category Name(In English)</label>
                                        <input type="text" class="form-control mb-4 regInputs" id="english" name="english" value="<?= $edit['name'] ?>" placeholder="Category Name" data-warning="errorWarning1">
                                        <?= form_error('english') ?>
                                        <p class="errorPrint" id="englishError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Category Name(In Arabic)</label>
                                        <input type="text" class="form-control mb-4 regInputs" id="arabic" name="arabic" value="<?= $edit['name_ar'] ?>" placeholder="Category Name" data-warning="errorWarning2">
                                        <?= form_error('arabic') ?>
                                        <p class="errorPrint" id="arabicError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="validationCustom01">Category Image</label>
                                        <input type="file" onchange="validImage(this,'input-file-now-custom-1');" id="input-file-now-custom-1" data-title="Image" value="<?php echo $edit['image']; ?>" name="image_update" data-default-file="<?php echo $edit['image']; ?>" class="dropify" accept="image/*" />
                                        <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" data-count="1" onclick="saveData(this, 1)">Update</button>
                                        <a href="<?= base_url('admin/service-category-list'); ?>" class="composemail mt-4 pull-right" style="margin-right: 3px;">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>
            <div class="col-md-6">
                <div class="card">
                    <form method="post" action="<?= base_url('admin/bulk-service-category-list'); ?>" enctype="multipart/form-data">
                        <div class="form-group col-md-12">
                            <label class="control-label">Select Excel File</label>
                            <input type="file" name="products" accept=".xls, .xlsx" required class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="text-sm-left" style="margin-top: -26px;">
                                    <button class="composemail mt-4 pull-right" style="margin-right: 106px;margin-bottom: 15px;cursor:pointer;" type="submit" name="bulk_upload">Upload</button>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-left">
                                    <a href="<?= base_url('assets/bulk/category.xls'); ?>" download style="color: red;margin-left: 83px;">Download Format</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-12 margin-20">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Category Name(In English)</th>
                                        <th>Category Name(In Arabic)</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($category_list as $listing) { ?>
                                        <tr>
                                            <td><img src="<?= $listing['image']; ?>"></td>
                                            <td><?= $listing['name'] ?></td>
                                            <td><?= $listing['name_ar'] ?></td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?php
                                                                                if ($listing['status'] == '1') : echo "checked";
                                                                                endif; ?> onchange="checkStatus_user(this,'<?= $listing['category_id']; ?>');">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/service-category-list/' . $listing['category_id']); ?>"><i class="fa fa-edit"></i></a>
                                                <a class="composemail fa_btn" onclick="deleleCategory(this,'<?= $listing['category_id']; ?>');"><i class="fa fa-trash-o"></i></a>
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

        function checkStatus_user(obj, id) {
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
                    data: 'method=checkStatus&id=' + id + '&action=' + status,
                    success: function(data) {
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

        function deleleCategory(obj, id) {
            var r = confirm("Are you sure to delete!");
            if (r == true) {
                if (id) {
                    status = '99';
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax_method",
                        type: 'post',
                        data: 'method=checkStatus&id=' + id + '&action=' + status,
                        success: function(data) {
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
            $(".regInputs").each(function(index, value) {
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

        function validImage(obj, i) {
            var _URL = window.URL || window.webkitURL;
            var file = $(':input[type="file"]').prop('files')[0];
            var img = new Image();
            var imgSize = file.size;
            var imgsizeKb = imgSize / 1024;
            if (imgsizeKb <= 300) {
                img.onload = function() {
                    var wid = this.width;
                    var ht = this.height;
                    //alert(wid+'&'+ht);
                    //if ((wid < 450 || wid > 500) || ht !== 500) {
                    if ((wid !== 250) || ht !== 250) {
                        $(".errorPrint").css('display', 'none');
                        $('#add_product_set').attr('disabled', true);
                        showErrorMessage(i + 'Error', 'Preferred Image Dimension 250X250 pixels');
                    } else {
                        $('#add_product_set').attr('disabled', false);
                        $('#' + i + 'Error').html('');
                    }
                };
            } else {
                $(".errorPrint").css('display', 'none');
                $('#add_product_set').attr('disabled', true);
                showErrorMessage(i + 'Error', 'Max Image size should be 300 kb');
            }

            img.src = _URL.createObjectURL(file);
        }
    </script>
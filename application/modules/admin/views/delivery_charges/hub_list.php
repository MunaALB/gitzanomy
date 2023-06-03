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
        <h1><?php if (isset($edit)) { echo 'Edit ';} ?>Hub Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i><?php if (isset($edit)) { echo 'Edit ';} ?> Hub Management</li>
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
                                    <div class="col-md-12">
                                        <label>Hub Name(In English)</label>
                                        <input type="text" id="english" class="form-control mb-4 regInputs" name="english" placeholder="Hub Name" data-title="Hub Name(En)">
                                        <p class="errorPrint" id="englishError"></p>
                                        <?= form_error('english') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Hub Name(In Arabic)</label>
                                        <input type="text" id="arabic" class="form-control mb-4 regInputs" name="arabic" placeholder="Hub Name"  data-title="Hub Name(Ar)">
                                        <p class="errorPrint" id="arabicError"></p>
                                        <?= form_error('arabic') ?>
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
                                    <div class="col-md-12">
                                        <label>Hub Name(In English)</label>
                                        <input type="text" class="form-control mb-4 regInputs" id="english" name="english" value="<?= $edit['name'] ?>" data-title="Hub Name(En)" placeholder="Hub Name" data-warning="errorWarning1">
                                        <?= form_error('english') ?>
                                        <p class="errorPrint" id="englishError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Hub Name(In Arabic)</label>
                                        <input type="text" class="form-control mb-4 regInputs" id="arabic" name="arabic" value="<?= $edit['name_ar'] ?>" data-title="Hub Name(Ar)" placeholder="Hub Name" data-warning="errorWarning2">
                                        <?= form_error('arabic') ?>
                                        <p class="errorPrint" id="arabicError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" data-count="1" onclick="saveData(this, 1)">Update</button>  
                                        <a href="<?= base_url('admin/hub-list'); ?>" class="composemail mt-4 pull-right" style="margin-right: 3px;">Cancel</a>  
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
                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Hub Name(In English)</th>
                                        <th>Hub Name(In Arabic)</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($hub_list as $listing) { ?>
                                        <tr>
                                            <td><?= $listing['name'] ?></td>
                                            <td><?= $listing['name_ar'] ?></td>
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
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/hub-list/' . $listing['id']); ?>"><i class="fa fa-edit"></i></a>
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
                    data: 'method=updateStatus&id=' + id + '&action=' + status +'&type=1',
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
                        data: 'method=updateStatus&id=' + id + '&action=' + status+'&type=1',
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


    </script>  
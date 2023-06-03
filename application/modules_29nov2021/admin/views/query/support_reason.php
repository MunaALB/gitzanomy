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
    echo 'Edit Support Reason';
} else {
    echo 'Support Reason Management';
} ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Support Reason Management</li>
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
                                            <option value="1">User</option>
                                            <option value="2">Vendor</option>
                                            <option value="3">Driver</option>
                                        </select>
                                        <p class="errorPrint" id="typeError"></p>
                                    </div>
                                     <div class="col-md-12">
                                        <label>Title</label>
                                        <input type="text" id="title" class="form-control mb-4 regInputs" name="title" placeholder="Title" data-title="Title">
                                        <p class="errorPrint" id="titleError"></p>
    <?= form_error('title') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Title (Ar)</label>
                                        <input type="text" id="title_ar" class="form-control mb-4 regInputs" name="title_ar" placeholder="Title (Ar)"  data-title="Title (Ar)">
                                        <p class="errorPrint" id="title_arError"></p>
    <?= form_error('title_ar') ?>
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
                                            <option value="1" <?=$edit['type']==1?'selected':''?>>User</option>
                                            <option value="2" <?=$edit['type']==2?'selected':''?>>Vendor</option>
                                            <option value="3" <?=$edit['type']==3?'selected':''?>>Driver</option>
                                        </select>
                                        <p class="errorPrint" id="typeError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Title</label>
                                        <input type="text" id="title" class="form-control mb-4 regInputs" value="<?= $edit['title'] ?>" name="title" placeholder="Title" data-title="Title">
                                        <p class="errorPrint" id="titleError"></p>
    <?= form_error('title') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Title (Ar)</label>
                                        <input type="text" id="title_ar" class="form-control mb-4 regInputs" value="<?= $edit['title_ar'] ?>" name="title_ar" placeholder="Title (Ar)"  data-title="Title (Ar)">
                                        <p class="errorPrint" id="title_arusernameError"></p>
    <?= form_error('title_ar') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button>  
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
                                        <th>Sr.no</th>
                                        <th>Type </th>
                                        <th>Title </th>
                                        <th>Title (Ar) </th>
                                        <th>Status</th> 
                                        <th>Action </th> 
                                    </tr>
                                </thead>
                                <tbody>
<?php $count = 1;
foreach ($reason_list as $listing) { ?>
                                        <tr>
                                            <td><?= $count ?></td>
                                             <td><?= $listing['type']==1?'User':($listing['type']==2?'Vendor':'Driver') ?></td>
                                            <td><?= $listing['title'] ?></td>
                                            <td><?= $listing['title_ar'] ?></td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?php
                                                    if ($listing['status'] == '1'): echo "checked";
                                                    endif;
                                                    ?> onchange="checkStatus(this, '<?= $listing['reason_id']; ?>');">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td> 
                                            <td>
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/support-reason-list/' . $listing['reason_id']); ?>"><i class="fa fa-edit"></i></a>
                                                <!--<a class="composemail fa_btn" onclick="deleleData(this, '<?= $listing['status_id']; ?>');"><i class="fa fa-trash-o"></i></a>-->
                                            </td> 
                                        </tr> 
    <?php $count++;
} ?>
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
                    data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=8',
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
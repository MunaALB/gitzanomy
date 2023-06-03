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
        <h1><?php
            if (isset($edit)) {
                echo 'Edit Sub Admin';
            } else {
                echo 'Sub Admin Management';
            }
            ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Sub Admin Management</li>
        </ol>
    </div>

    <div class="content">
        <?= $this->session->flashdata('response'); ?>
        <form method="POST" id="regForm" enctype="multipart/form-data">
            <div class="row" id="formFirstDiv">
                <!--<input type="hidden" name="selectedCheckbox[]">-->
                <?php if (!isset($edit)) { ?>
                    <div class="col-md-5">
                        <div class="card">

                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <input type="email" id="email" class="form-control mb-4 regInputs" name="email"  value="<?= set_value('email') ?>"  placeholder="Email" data-title="Email">
                                        <p class="errorPrint" id="emailError"></p>
                                        <?= form_error('email') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Full name</label>
                                        <input type="text" id="username" class="form-control mb-4 regInputs" name="username"  value="<?= set_value('username') ?>"  placeholder="Username"  data-title="Username">
                                        <p class="errorPrint" id="usernameError"></p>
                                        <?= form_error('username') ?>
                                    </div>
                                    <!--                                    <div class="col-md-12">
                                                                            <label>Mobile</label>
                                                                            <input type="number" id="mobile" class="form-control mb-4" value="<?= set_value('mobile') ?>" name="mobile" placeholder="Mobile"  data-title="Mobile" >
                                                                            <p class="errorPrint" id="mobileError"></p>
                                    <?= form_error('mobile') ?>
                                                                        </div>-->
                                    <div class="col-md-12">
                                        <label>Password</label>
                                        <input type="password" id="password" onkeyup="checkPassword(this, 1);" class="form-control mb-4 regInputs" value="<?= set_value('password') ?>" name="password" placeholder="Password"  data-title="Password" >
                                        <p class="errorPrint" id="passwordError"></p>
                                        <?= form_error('password') ?>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="errorPrint" id="privilegeError"></p>
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button>  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body"> 
                                <!--<h3>Select Privilege</h3>-->
                                <div class="table-responsive table-image">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Select Privilege</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($privilege_list):foreach ($privilege_list as $list): ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="privileges[]" onclick="setCheckboxValues(this);" class="privilege" value="<?= $list['type'] ?>"></td>
                                                        <td><label> <?= ucwords($list['title']) ?></label></td>
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
                <?php } else { ?>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <input type="email" id="email" class="form-control mb-4 regInputs" value="<?= $edit['email'] ?>" name="email" placeholder="Email" data-title="Email">
                                        <p class="errorPrint" id="emailError"></p>
                                        <?= form_error('email') ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Full Name</label>
                                        <input type="text" id="username" class="form-control mb-4 regInputs" value="<?= $edit['username'] ?>" name="username" placeholder="Username"  data-title="Username">
                                        <p class="errorPrint" id="usernameError"></p>
                                        <?= form_error('username') ?>
                                    </div>
                                    <!--                                    <div class="col-md-12">
                                                                            <label>Mobile</label>
                                                                            <input type="number" id="mobile" class="form-control mb-4" value="<?= $edit['mobile'] ?>" name="mobile" placeholder="Mobile"  data-title="Mobile" >
                                                                            <p class="errorPrint" id="mobileError"></p>
                                    <?= form_error('mobile') ?>
                                                                        </div>-->
                                    <!--                                    <div class="col-md-12">
                                                                            <label>Password</label>
                                                                            <input type="password" onkeyup="checkPassword(this, 2);" id="password" class="form-control mb-4" value="" placeholder="Password" onchange="setName(this);" data-title="Password" >
                                                                            <p class="errorPrint" id="passwordError"></p>
                                    <?= form_error('password') ?>
                                                                        </div>-->

                                    <div class="col-md-12">
                                        <p class="errorPrint" id="privilegeError"></p>
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button>  
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body"> 
                                <!--<h3>Select Privilege</h3>-->
                                <div class="table-responsive table-image">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Select Privilege</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($edit['privilege']) {
                                                $privilege = explode(',', trim($edit['privilege'], ','));
                                            } else {
                                                $privilege = [];
                                            };
                                            if ($privilege_list):foreach ($privilege_list as $list):
                                                    ?>
                                                    <tr>
                                                        <td><input type="checkbox" name="privileges[]" onclick="setCheckboxValues(this);" class="privilege" value="<?= $list['type'] ?>" <?= in_array($list['type'], $privilege) ? 'checked' : ''; ?>></td>
                                                        <td><label> <?= ucwords($list['title']) ?></label></td>
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
                <?php } ?>

            </div>
        </form>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card"> 
                    <div class="card-body">

                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Full name </th>
                                        <th>Email </th>
                                        <th>Mobile </th>
                                        <th>Password </th>
                                        <th>Selected Privilege</th>
                                        <th>Status</th> 
                                        <th>Action </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($admin_list as $listing) {
                                        ?>
                                        <tr>
                                            <td><?= $count ?></td>
                                            <td><?= $listing['username'] ?></td>
                                            <td><?= $listing['email'] ?></td>
                                            <td><?= $listing['mobile'] ?></td>
                                            <td><?= $listing['password'] ?> <a href="#" data-toggle="modal" data-target="#commissionModal" style="padding:5px 5px !important;cursor:pointer;" onclick="setValues(this,<?= $listing['id']; ?>);" class="composemail"><i class="fa fa-edit"></i></a></td>
                                            <td><?php if ($listing['privilege_list']) { ?>
                                                    <ol>
                                                        <?php foreach ($listing['privilege_list'] as $row) { ?>
                                                            <li><a href="#"><?= ucwords($row['title']) ?></a></li>
                                                        <?php } ?>
                                                    </ol>
                                                <?php } ?></td>
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
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/sub-admin-list/' . $listing['id']); ?>"><i class="fa fa-edit"></i></a>
                                            </td> 
                                        </tr> 
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
                                <label>Change Password</label>
                                <input type="hidden" name="id" id="id">
                                <input type="password" class="form-control mb-4" data-title="Password" id="password1" name="password" placeholder="Enter New Password">
                                <p class="text-danger" id="passwordError1"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="changePassword(this);" id="add_product_set" class="composemail pull-right" style="padding:10px 15px !important;">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var getCheckedBoxes = <?= isset($edit) ? ($edit && $edit['privilege'] ? json_encode(explode(',', $edit['privilege'])) : 0) : 0 ?>;
        var allCheckedBoxes = [];
        if (getCheckedBoxes) {
            allCheckedBoxes = getCheckedBoxes;
        }
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
                    data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=7',
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
            var countChkBox = $(".privilege:checkbox").filter(":checked");
            if (countChkBox.length == 0) {
                idValidate = true;
                $('#privilegeError').empty();
                $('#privilegeError').append('* Privilege is required field');
                $('#privilegeError').css('display', 'block');
            }
            if (idValidate) {
                return false;
            } else {
                $("#regForm").submit();
            }
        }


        function setName(obj) {
            $(obj).attr('name', 'password');
        }

        function  checkPassword(obj, type) {
            var password = $(obj).val();
            if (password) {
                if (password.length < 8) {
                    $('#add_product_set').attr('disabled', true);
                    $('#passwordError').html('Password must be atleast 8 character');
                    $('#passwordError').css('display', 'block');
                } else {
                    $('#add_product_set').attr('disabled', false);
                    $('#passwordError').html('');
                }
            } else {
                if (type == 2) {
                    $('#add_product_set').attr('disabled', false);
                    $('#passwordError').html('');
                } else {

                    return false;
                }
            }

        }
        function setValues(obj, id) {
            $('#id').val(id);
        }
        function changePassword(obj) {

            var password = $('#password1').val();
            var id = $('#id').val();
            if (id) {
                if (password != "" && password != 0) {
                    if (password.length >= 8) {
                        $.ajax({
                            url: "<?= base_url(); ?>admin/Admin/ajax",
                            type: 'post',
                            data: 'method=changeAdminPassword&id=' + id + '&pass=' + password,
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
                        $('#passwordError1').html('* invalid password minimum length 8');
                    }
                } else {
                    $('#passwordError1').html('* Password is required field');
                }
            } else {
                alert('Some error occured');
            }
        }

        function setCheckboxValues(obj) {
            var check = $(obj).is(':checked');
            var type = $(obj).val();
            if (check) {
                allCheckedBoxes.push(type);

            } else {
                const index = allCheckedBoxes.indexOf(type);
                if (index > -1) {
                    allCheckedBoxes.splice(index, 1);
                }
            }
            $('.selected').remove();
            $.each(allCheckedBoxes, function (i, v) {
                $('#formFirstDiv').append("<input type='hidden' name='privilege[]' class='selected' value='" + v + "' id='p_" + v + "'>");
            });
        }


    </script>  
<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
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

    .widget-user-image>img {
        width: 100px;
        height: auto;
        border: 3px solid #fff;
    }
</style>

<style>

.btn-new{
    background-color: #d6d6d6 !important;
    border-color: #d6d6d6 !important;
    padding: 2px 12px !important;
    color: black !important;
    cursor: not-allowed !important;
    margin-left: 56px;
}

.btn-new-active{
    background-color: #f74f00 !important;
    border-color: #f74f00 !important;
    padding: 2px 12px !important;
    margin-left: 56px;
}
.set-active-driver{
    border: 1px solid red;
    border-radius: 11px;
}

.activeButton{
    background: #ef4e32 !important;
    border: #ef4e32 !important;
    color: #fff !important;
}
.item_class_css{
    position: absolute;margin-left: -12px;margin-top: -26px;float: right !important;
}

.assignDriverSaved{
    position: absolute;
    margin-left: 110px;
    margin-top: -22px;
}

.vendor-admin-buttons .items-tabs {
    width: 32% !important;
}
.img-circle {
    width: 60px !important;
    height: 60px !important;
}
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Driver Detail</h1>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12"> 
                <!--<div class="card m-b-3 card-bg-color">-->
                <!--    <div class="card-body">  -->
                <!--        <img class="profile-user-img img-responsive img-circle" src="<?= $driver_detail['image']; ?>" alt="User Avatar">  -->
                <!--    </div>-->
                <!--</div>-->
                <div class="card m-b-3">
                    <div class="card-body">

                        <div class="box-body"> 
                            <div class="row mb-4">
                                <div class="col-md-12 text-center">
                                    <div class="widget-user-image"> 
                                        <?php if ($driver_detail['image']): ?>
                                            <img class="img-circle" src="<?= $driver_detail['image']; ?>" alt="Driver Image">
                                        <?php else: ?>
                                            <img class="img-circle" src="<?= base_url() ?>/assets/admin/images/userdummy.png" alt="Driver Image">
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <strong><i class="fa fa-user margin-r-5"></i> Driver Full Name</strong>

                            <p class="text-muted"><?= $driver_detail['name']; ?></p>
                            <hr>
                            <!-- <strong><i class="fa fa-car margin-r-5"></i> Bussines Type</strong>
                            <p class="text-muted">Driving</p>
                            <hr> -->
                            <strong><i class="fa fa-envelope margin-r-5"></i> Email address </strong>
                            <p class="text-muted"><?= $driver_detail['email']; ?></p>
                            <hr>
                            <strong><i class="fa fa-mobile margin-r-5"></i> Mobile Number</strong>
                            <p>+<?= $driver_detail['country_code']; ?> <?= $driver_detail['mobile']; ?></p>
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
                            <p><?= $driver_detail['address']; ?></p>
                            <div class="text-right">
                                <a href="<?php echo site_url('admin/edit-driver-detail/'.$driver_detail['driver_id']);?>" class="composemail" style="padding:5px 35px !important;">Edit</a>
                                <?php if ($driver_detail['status'] == 1): ?>
                                    <a href="#exampleModal" data-direction="finish" data-toggle="modal" class="composemail">Click To Block</a> 
                                <?php else: ?>
                                    <a style="cursor:pointer;" onclick="checkStatus_user(this, '<?= $driver_detail['driver_id']; ?>', '1');" class="composemail">Click To Verify</a> 
                                <?php endif; ?>
                                <a href="#examplePasswordModal" data-direction="finish" data-toggle="modal" class="composemail">Change Password</a> 
                            </div>
                            
                        </div>
                        <!-- /.box-body --> 
                    </div>
                </div>
            </div> 

            <div class="col-md-12">
                <div class="card">

                    <div class="">

                        <div id="demo">

                            <div class="step-app">

                                <ul class="step-steps">

                                    <li class="active"><a href="#step1"><span class="number">1</span>Active Order</a></li>
                                    <li><a href="#step2"><span class="number">2</span>Past Order</a></li>
                                </ul>

                                <div class="step-content for-border-remove"> 

                                    <div class="step-tab-panel active" id="step1">

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example1" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Type</th>
                                                            <th>Amount</th>
                                                            <th>Destination</th>
                                                            <th>Change Driver</th>
                                                        </tr>
                                                    </thead>   
                                                    <tbody>
                                                        <?php 
                                                            if(isset($active_order) and $active_order):
                                                                foreach($active_order as $list):
                                                        ?>
                                                            <tr>
                                                                <td><a href="<?=base_url('admin/new-order-detail/'.$list['order_id']);?>"><?=$list['order_id'];?></a></td>
                                                                <td><?php 
                                                                    if($list['driver_order_type']==1){ echo "Out for collecting cash."; }
                                                                    elseif($list['driver_order_type']==2){ echo "Pickup from vendor location."; }
                                                                    elseif($list['driver_order_type']==3){ echo "Drop order to user location."; }
                                                                    elseif($list['driver_order_type']==4){ echo "Pickup order for international items."; }
                                                                    else{ echo "N/A"; }
                                                                ?></td>
                                                                <td><?php if(isset($list['amount']) and $list['amount']){ echo $list['amount'].'LYD'; }else{ echo "N/A"; } ?></td>
                                                                <td><?php if(isset($list['user_address']['address']) and $list['user_address']['address']){ echo $list['user_address']['address']; }else{ echo "N/A"; } ?></td>
                                                                <td>
                                                                    <?php if($list['driver_order_status']==1): ?>
                                                                        <a  onclick="driverListShow(this,'<?=$list['order_id'];?>','<?=$list['driver_tracking_id'];?>');" class="composemail" style="cursor:pointer;padding:5px 12px !important;">Assigned</a>
                                                                    <?php else: ?>
                                                                        <a  class="composemail" style="cursor:no-drop;padding:5px 12px !important;background: #8f8f90;">Assigned</a>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div> 
                                    <div class="step-tab-panel for-border-remove booking-detail" id="step2">

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example2" class="table table-bordered">
                                                <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Type</th>
                                                            <th>Amount</th>
                                                            <th>Destination</th>
                                                        </tr>
                                                    </thead>   
                                                    <tbody>
                                                        <?php 
                                                            if(isset($past_order) and $past_order):
                                                                foreach($past_order as $list):
                                                        ?>
                                                            <tr>
                                                                <td><a href="<?=base_url('admin/new-order-detail/'.$list['order_id']);?>"><?=$list['order_id'];?></a></td>
                                                                <td><?php 
                                                                    if($list['driver_order_type']==1){ echo "Out for collecting cash."; }
                                                                    elseif($list['driver_order_type']==2){ echo "Pickup from vendor location."; }
                                                                    elseif($list['driver_order_type']==3){ echo "Drop order to user location."; }
                                                                    elseif($list['driver_order_type']==4){ echo "Pickup order for international items."; }
                                                                    else{ echo "N/A"; }
                                                                ?></td>
                                                                <td><?php if(isset($list['amount']) and $list['amount']){ echo $list['amount'].'LYD'; }else{ echo "N/A"; } ?></td>
                                                                <td><?php if(isset($list['user_address']['address']) and $list['user_address']['address']){ echo $list['user_address']['address']; }else{ echo "N/A"; } ?></td>
                                                                
                                                            </tr>
                                                        <?php endforeach; endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                    

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
                        <a style="cursor:pointer;" onclick="checkStatus_user(this, '<?= $driver_detail['driver_id']; ?>', '2');" class="composemail  pull-right">Submit</a>
                    </form>
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
                        <a style="cursor:pointer;" onclick="changePassword(this, '<?= $driver_detail['driver_id']; ?>', '2');" class="composemail  pull-right">Submit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="asiign-driver-list" id="listdriver" style='display:block'>
        <div class="row">
            <div class="col-lg-12 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Assign Driver
                            <div class="assignDriverSaved">
                            <button type="button" id="assignForUpfrontAmount" onclick="assignForVendorPorduct(this,'1');" class="btn btn-secondary active btn-new">Save</button>
                            </div>
                            <span class="pull-right f-13">
                                <a href="javascript:void(0)" onclick="closePops(this)" id="remove-driverlist"><i class="fa fa-times"></i></a>
                            </span>
                        </h5>
                        <div class="search-bar">
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Driver..." />
                            </div>
                        </div>
                        <?php if($driver_list): ?>
                            <div class="driverilist-side">
                                <?php foreach($driver_list as $list): ?>
                                    <div class="message-widget" onclick="selectDriver(this,'1','<?=$list['driver_id'];?>')">
                                        <a href="#">
                                            <div class="user-img pull-left">
                                                <?php if($list['image']): ?>
                                                    <img src="<?=$list['image'];?>" class="img-circle img-responsive" alt="User Image" />
                                                <?php else: ?>
                                                    <img src="<?=base_url();?>assets/admin/images/logo_zanomy_white.png" style="background:red;" class="img-circle img-responsive" alt="User Image">
                                                <?php endif; ?>
                                            </div>
                                            <div class="mail-contnet">
                                                <h5><?=$list['name'];?></h5>
                                                <span class="mail-desc"><i class="fa fa-phone"></i> +<?=$list['country_code'];?> <?=$list['mobile'];?> | <i class="fa fa-envelope"></i> <?=$list['email'];?></span>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else:?>
                            <div class="content">
                                <div class="driver-lists">
                                    <div class="row">
                                        <h5 style="margin-left: 96px;"> No drivers avaliable...</h5>
                                    </div>
                                </div>
                            </div>
                            <a href="<?=base_url('admin/add-driver');?>" class="composemail pull-right">Add Driver</a>
                        <?php endif; ?>
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
                            data: 'method=ChangeStatusSetting&id=' + id + '&action=' + status + '&type=3' + '&reason=' + reason,
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
        // $("#remove-driverlist").click(function () {
        //     $("#listdriver").removeClass("active");
        // });

        function closePops(o){
            $("#listdriver").removeClass("active");
        }
        function driverListShow(o,orderId,trackingId){
            var attrData=$(o).attr('data-type');
            $("#listdriver").addClass("active");
            $("#assignForUpfrontAmount").attr('data-type',attrData);

            $("#assignForUpfrontAmount").attr('data-orderId',orderId);
            $("#assignForUpfrontAmount").attr('data-trackingId',trackingId);
        }
        function selectDriver(o,i,d){
            $(".message-widget").removeClass('set-active-driver');
            $(o).addClass('set-active-driver');
            $("#assignForUpfrontAmount").removeClass('btn-new');
            $("#assignForUpfrontAmount").addClass('btn-new-active');
            $("#assignForUpfrontAmount").attr('data-driver',d);
        }
        function assignForVendorPorduct(obj,orderId) {
            var newData='';
            var oldDriverId="<?=$driver_id;?>"
            var driver_id=$('#assignForUpfrontAmount').attr('data-driver');
            var orderId=$('#assignForUpfrontAmount').attr('data-orderId');
            var trackingId=$('#assignForUpfrontAmount').attr('data-trackingId');
            if(driver_id==undefined || driver_id=='undefined'){
                alert("Please select a driver.");
            }else{
                if (orderId && trackingId) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Order/ajax_method",
                        type: 'post',
                        data: 'method=changeDriver&driverId=' + driver_id + '&orderId=' + orderId+ '&trackingId=' + trackingId+'&oldDriverId='+oldDriverId,
                        success: function (data) {
                            var dt = $.trim(data);
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
                    aletr("Order not get.");
                }
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
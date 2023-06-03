<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .user-note-list{
        text-align: justify;
        background: #fff;
        padding: 9px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>User Detail</h1>
    </div>
    <div class="content">
        <div class="row">
            <div class="col-lg-12">  
                <div class="box box-widget widget-user">   
                    <div class="widget-user-header bg-gray"> </div>
                    <div class="widget-user-image"> 
                        <?php if($user_detail['image']): ?>
                            <img class="img-circle" src="<?=$user_detail['image'];?>" alt="User Avatar">
                        <?php else: ?>
                        <img class="img-circle" src="<?=base_url()?>/assets/admin/images/userdummy.png" alt="User Avatar">
                        <?php endif; ?>
                    </div>
                    <div class="box-footer"> 
                        <div class="text-center mb-4">
                            <h3 class="widget-user-username"><?=$user_detail['name'];?></h3>
                            <h5 class="widget-user-desc "><?=$user_detail['email'];?></h5>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class=" row description-block">
                                    <div class="col-lg-12 col-xs-12 b-r"> <label>User Id </label> 
                                        <p class="text-muted">#<?=$user_detail['user_id'];?></p>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 b-r mt-4"> <label>Mobile Number </label> 
                                        <p class="text-muted">+<?=$user_detail['country_code'];?>-<?=$user_detail['mobile'];?></p>
                                    </div> 
                                </div>
                            </div>
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <?php if($user_detail['status']==1): ?>
                                        <a href="#exampleModal" data-direction="finish" data-toggle="modal" class="composemail">Click To Block</a> 
                                    <?php else: ?>
                                        <a style="cursor:pointer;" onclick="checkStatus_user(this,'<?= $user_detail['user_id']; ?>','1');" class="composemail">Click To Verify</a> 
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="row description-block"> 
                                    <div class="col-lg-12 col-xs-12 b-r mt-4"> 
                                        <label>Registration Date &amp; Time</label> 
                                        <p class="text-muted"><?=date('d/m/Y h:i A',($user_detail['created_at']));?></p>
                                    </div>
                                    <div class="col-lg-12 col-xs-12 b-r mt-4"> 
                                        <label>Status</label> 
                                        <?php if($user_detail['status']==1){ echo '<p class="btn btn-success" style="padding: 2px 11px;margin: 2px 4px;cursor: text;">Verify</p>'; }elseif($user_detail['status']==2){ 
                                            echo '<p class="btn btn-danger" style="padding: 2px 11px;margin: 2px 4px;cursor: text;">Block</p>'; }else{ 
                                                echo '<p class="btn btn-warning" style="padding: 2px 11px;margin: 2px 4px;cursor: text;">Un-Verify</p>';
                                             } ?>
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div> 
        <div class="card">
            <div class="">
                <div id="demo">
                    <div class="step-app">
                        <ul class="step-steps">
                            <li class="active"><a href="#step1"><span class="number">1</span>Order List</a></li>
                            <li class=""><a href="#step2"><span class="number">2</span>Transaction List</a></li> 
                            <li class=""><a href="#step3"><span class="number">3</span>NoteBook</a></li> 
                        </ul>
                        <div class="step-content for-border-remove">
                            <div class="step-tab-panel active" id="step1">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>  
                                                    <th>Upfront Amount</th>
                                                    <th>Amount</th>
                                                    <th>Date & Time</th>
                                                    <th>Payment Mode</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($user_order): foreach($user_order as $order): ?>
                                                    <tr>
                                                        <td><?=$order['order_id']?></td>
                                                        <td><?= number_format($order['upfront_amount'],2) ?> LYD</td>
                                                        <td><?=number_format($order['total'],2)?> LYD</td>
                                                        <td><?= date('d/m/Y h:i A', strtotime($order['created_at'])) ?></td>
                                                        <td><?= $order['payment_type'] == 1 ? 'COD' : 'Online' ?></td>
                                                        <td><span class="text-info"><?php if($order['user_status']==1){ echo "New"; }
                                                        elseif($order['user_status']==2){ echo "In-Process"; }
                                                        else{ echo "Delivered"; }
                                                        ?></span></td>
                                                        <td>
                                                            <a href="<?php echo base_url('admin/new-order-detail/'.$order['order_id']); ?>" class="composemail">View</a>
                                                            <!-- <?php if($order['status']==1){ ?>
                                                                <a href="<?php echo base_url('admin/new-order-detail/'.$order['order_id']); ?>" class="composemail">View</a>
                                                            <?php }elseif($order['status']==2){ ?>    
                                                                <a href="<?php echo base_url('admin/upfront-payment-order-detail/'.$order['order_id']); ?>" class="composemail">View</a>
                                                            <?php }elseif($order['status']==3){ ?>    
                                                                <a href="<?php echo base_url('admin/verified-upfront-payment-order-detail/'.$order['order_id']); ?>" class="composemail">View</a>
                                                            <?php }elseif($order['status']==4){ ?>    
                                                                <a href="<?php echo base_url('admin/in-process-order-detail/'.$order['order_id']); ?>" class="composemail">View</a>
                                                            <?php }elseif($order['status']==5){ ?>    
                                                                <a href="<?php echo base_url('admin/completed-order-detail/'.$order['order_id']); ?>" class="composemail">View</a>
                                                            <?php }else{ ?>    
                                                                <a href="#" class="composemail">View</a>
                                                            <?php } ?>     -->
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
                                                    <th>Order Id</th>
                                                    <th>Trans Id</th> 
                                                    <th>Amount</th>
                                                    <th>Trans Date & Time</th> 
                                                    <th>Payment Mode</th>
                                                    <th>Type</th>
                                                    <th>Status</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if($user_transaction): foreach($user_transaction as $order): ?>
                                                    <tr>
                                                        <td><?=$order['order_id'];?></td>
                                                        <td><?=$order['user_transaction_id']?></td>
                                                        <td><?= number_format($order['amount'],2) ?> LYD</td>
                                                        <td><?= date('d/m/Y h:i A', strtotime($order['created_at'])) ?></td>
                                                        <td><?= $order['payment_type'] == 1 ? 'Online' : 'COD' ?></td>
                                                        <td><?= $order['type'] == 1 ? 'upfront' : 'Order' ?></td>
                                                        
                                                        <td>
                                                            <a href="<?php echo base_url('admin/new-order-detail/'.$order['order_id']); ?>" class="composemail">View</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> 

                            <div class="step-tab-panel for-border-remove booking-detail" id="step3">
                                <div class="card-body">
                                    <form method="POST" id="regForm" enctype="multipart/form-data">
                                        <div class="card-body"> 
                                            <div class="row">
                                                
                                                <div class="col-md-12">
                                                    <label for="validationCustom01">Add Note</label>
                                                    <textarea name="note" id="note" rows="6" class="form-control"></textarea>
                                                    <p class="errorPrint" id="noteError"></p>
                                                    <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="addNote(this)">Submit</button>  
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <?php if(isset($user_note) and $user_note): ?>
                                        <div class="col-md-12" style="background: #ebf5f2;padding: 21px;">
                                            <?php foreach($user_note as $note): ?>
                                            <p class="user-note-list">
                                                <?=$note['note'];?>  <br><br>By <?=$note['admin'];?>   |   <?=date('d/m/Y H:i:s',strtotime($note['created_at']));?>
                                            </p>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
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
                        <a style="cursor:pointer;" onclick="checkStatus_user(this,'<?= $user_detail['user_id']; ?>','2');" class="composemail  pull-right">Submit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }
    function checkStatus_user(obj, id,status) {
        var reason='';
        var idValidate = false;
        if(status==2){
            reason=$('#reason').val();
            if(reason){

            }else{
                idValidate = true;
            }
        }
        if (idValidate) {
            showErrorMessage('reasonError','*Required Field');
            return false;
        } else {
            if(confirm("Are You sure want to change the status!")){
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=ChangeStatusSetting&id=' + id + '&action=' + status+'&type=1'+'&reason='+reason,
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

    function addNote(o,status){
        var createValue="<?=$user_id?>";
        if(createValue){
            var note=$.trim($("#note").val());
            if (note) {
                $.ajax({
                    url: "<?php echo base_url("/admin/Home/ajax") ?>",
                    type: 'post',
                    data: 'method=sendNote&id=' + createValue+'&note='+note+'&type=1',
                    success: function (data) {
                        var dt = $.trim(data);
                        //alert(dt);
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
                $("#noteError").empty();
                $("#noteError").append('*Note is required field.');
                $("#noteError").css('display','block');
            }
        }else{
            alert("Please select User.");
        }
    }
</script>
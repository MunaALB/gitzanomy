<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
        margin-top: 25px;
    }
    .fa_btn {
        background: #f74f00;
        color: #ffffff !important;
        padding: 4px 6px !important;
        margin-top: 0px;
        border-radius: 30px;
        margin-left: 0px;
    }
    .margin-20{
        margin-top: 20px;
    }
    .borderDiv{
        border-top: 1px solid #cac3c3;
        /* border-bottom: 1px solid #cac3c3; */
        padding: 12px;
        margin: -3px 1px 16px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Coupon List</h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url('admin');?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Coupon List</li>
        </ol>
    </div>
    <?=$this->session->flashdata('response');?>
    <div class="content">
        <div class="row">
            
            <div class="col-md-12 margin-20">
                <div class="card"> 
                    <div class="card-body">
                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Discount</th>
                                        <th>Limit</th>
                                        <th>Single User</th>
                                        <th>Start From</th>
                                        <th>Last Date</th> 
                                        <th>Privacy</th> 
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($coupon_list): foreach($coupon_list as $listing) { ?>
                                    <tr>
                                        <td><?= $listing['coupon_code'];?></td>
                                        <td>
                                            <?php   if($listing['coupon_type']==1):
                                                        echo $listing['coupon_discount'].'%';
                                                elseif($listing['coupon_type']==2):
                                                        echo $listing['coupon_discount'].'LYD';
                                                else:
                                                    echo 'Free Shipping';
                                                endif;
                                                ?>
                                        </td>
                                        <td><?= $listing['total_user']?></td>
                                        <td><?= $listing['single_user']?></td>
                                        <td><?= $listing['start_date'];?></td>
                                        <td><?= $listing['end_date'];?></td>
                                        <td><?= $listing['coupon_privacy']==1 ? "Public" : "Private" ;?></td>
                                        <td>
                                        <div class="mytoggle">
                                            <label class="switch">
                                              <input type="checkbox" <?php
                                                if ($listing['status'] == '1'): echo "checked";
                                                 endif;?> onchange="checkStatus_user(this,'<?= $listing['coupon_id']; ?>');">
                                              <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td> 
                                    <td>
                                        <!-- <a class="composemail fa_btn" href="<?php echo site_url('admin/category-list/'.$listing['coupon_id']);?>"><i class="fa fa-edit"></i></a> -->
                                        <a class="composemail fa_btn" onclick="deleleCategory(this,'<?= $listing['coupon_id']; ?>');"><i class="fa fa-trash-o"></i></a>
                                    </td> 
                                    </tr> 
                                    <?php  } endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    
    function checkStatus_user(obj, id) {
        var txt ;
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 0;
        }

        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=ChangeAttributeStatus&id=' + id + '&action=' + status+'&type=5',
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

    function deleleCategory(obj, id) {
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            if (id) {
                status='99';
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=ChangeAttributeStatus&id=' + id + '&action=' + status+'&type=5',
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



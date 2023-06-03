<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>User List</h1>
    </div>
    <div class="content">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User Id</th>
                                            <th>User Name</th>
                                            <th>Mobile No</th>
                                            <th>Email Id</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($user_list): foreach($user_list as $list): ?>
                                        <tr>
                                            <td><?=$list['user_id'];?></td>
                                            <td><?=$list['name'];?></td>
                                            <td>+<?=$list['country_code'].' '.$list['mobile'];?></td>
                                            <td><?=$list['email'];?></td>
                                            <td>
                                                <!-- <div class="mytoggle">
                                                    <label class="switch">
                                                    <input type="checkbox" <?php
                                                        if ($list['status'] == '1'): echo "checked";
                                                        endif;?> onchange="checkStatus_user(this,'<?= $list['user_id']; ?>');">
                                                    <span class="slider round"></span>
                                                    </label>
                                                </div> -->
                                                <?php if($list['status']==1){ echo '<p class="btn btn-success" style="padding: 2px 11px;margin: 2px 4px;cursor:text;">Verify</p>'; }elseif($list['status']==2){ 
                                            echo '<p class="btn btn-danger" style="padding: 2px 11px;margin: 2px 4px;cursor:text;">Block</p>'; }else{ 
                                                echo '<p class="btn btn-warning" style="padding: 2px 11px;margin: 2px 4px;cursor:text;">Un-Verify</p>';
                                             } ?>
                                            </td> 
                                            <td><a href="<?php echo site_url('admin/user-detail/'.$list['user_id']);?>" class="composemail">View</a></td>
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
<script type="text/javascript">
function checkStatus_user(obj, id) {
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
            data: 'method=ChangeStatusSetting&id=' + id + '&action=' + status+'&type=1',
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
</script>
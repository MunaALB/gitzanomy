<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Service vendor List</h1>
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
                                            <th>Vendor Id</th>
                                            <th>Vendor Name</th>
                                            <th>Mobile</th>
                                            <th>No of Service</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($vendor_list): foreach($vendor_list as $list): ?>
                                        <tr>
                                            <td>#<?=$list['vendor_id'];?></td>
                                            <td><?=$list['name'];?></td>
                                            <td>+<?=$list['country_code'].' '.$list['mobile'];?></td>
                                            <td><?=$list['service_count'];?></td>
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
                                            <td><a href="<?php echo site_url('admin/vendor-detail/'.$list['vendor_id']);?>" class="composemail">View</a></td>
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
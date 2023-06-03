<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Driver List</h1>
    </div>
    <div class="content">
           <div class="row mb-3">
                <div class="col-md-12">  
                     <a href="<?php echo base_url('admin/add-driver');?>" class="composemail pull-right"><i class="fa fa-plus"></i> Add  Driver</a>   
                </div>
            </div>
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Driver Id</th>
                                            <th>Driver Name</th>
                                            <th>Mobile No</th>
                                            <th>Email Id</th>
                                            <th>Registered Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($driver_list): foreach($driver_list as $list): ?>
                                        <tr>
                                            <td>#<?=$list['driver_id'];?></td>
                                            <td><?=$list['name'];?></td>
                                            <td>+<?=$list['country_code'].' '.$list['mobile'];?></td>
                                            <td><?=$list['email'];?></td>
                                            <td><?=date('d/m/Y',$list['created_at']);?></td>
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
                                            <td><a href="<?php echo site_url('admin/driver-detail/'.$list['driver_id']);?>" class="composemail">View</a></td>
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
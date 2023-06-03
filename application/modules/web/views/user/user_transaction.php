<div class="main-container container">
    <ul class="breadcrumb">
        <li><a style="color:red;" href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
        <li><a style="color:red;" href="<?=base_url('en/my-account');?>">User Dashboard</a></li>
        <li>User Transaction</li>
    </ul>
    <div class="row">
        <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
            <?php include 'usersidebar.php';?>
        </aside>
        <div id="content" class="col-sm-9 user-rightpart">
            <h2 class="title">User Transaction</h2>
            <div class="user-gridpoints">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-center">Txn-Id</td>
                                <td class="text-center">Ref-Id</td>
                                <td class="text-center">Order-Id</td>
                                <td class="text-center">amount</td>
                                <td class="text-center">Type</td>
                                <td class="text-center">Status</td>
                                <td class="text-center">Created At</td>
                                <td class="text-center">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($list) and $list): foreach($list as $fproduct): ?>
                                <tr>
                                    <td class="text-center"><?=$fproduct['txn_id'];?></td>
                                    <td class="text-center"><?=$fproduct['reference_id'];?></td>
                                    <td class="text-center"><?=$fproduct['order_id'];?></td>
                                    <td class="text-center"><?=$fproduct['amount'];?></td>
                                    <td class="text-center">
                                    <?php if($fproduct['type']==1){ echo "Order"; }else{ echo "Booking"; } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if($fproduct['payment_status']==0){ echo "Pending"; }elseif($fproduct['payment_status']==1){ echo "Success"; }else{ echo "Failed"; } ?>
                                    </td>
                                    <td class="text-center"><?=$fproduct['created_at'];?></td>
                                    <td class="text-center"><a href="<?=base_url('en/order-detail/'.$fproduct['order_id']);?>"><i class="fa fa-eye"></i></a></td>
                                    
                                </tr>
                            <?php endforeach; else: echo "No data found"; endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.errorPrint{
    font-size: 12px;
    color: #af2000 !important;
    padding: 5px 5px;
    display: none;
}
.order-tabs  {
    margin-top: 20px;
}
.order-tabs .nav-tabs>li {
    float: left;
    margin-bottom: 0px;
    width: 50%;
    background: #fbfbfb;
}
.order-tabs .nav-tabs>li.active>a {
    color: #fff;
    cursor: default;
    background-color: #fd5000;
    border: 1px solid #fd5000;
    border-bottom-color: transparent;
}
</style>
    <div class="main-container container">
        <ul class="breadcrumb">
        <li><a style="color:red;" href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
        <li><a style="color:red;" href="<?=base_url('ar/my-account');?>">لوحة تحكم المستخدم</a></li>
        <li>سجل طلبياتي</li>
        </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                    <?php include 'usersidebar.php';?>
                </aside>
                 <div id="content" class="col-sm-9 user-rightpart">
                    <h2 class="title">سجل طلبياتي</h2>

                    <div class="order-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#activeorder" aria-controls="activeorder" role="tab" data-toggle="tab">طلب نشط</a></li>
                    <li role="presentation" class=""><a href="#completeorder" aria-controls="completeorder" role="tab" data-toggle="tab">اكمل الطلب</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="activeorder">
                        <div class="user-gridpoints">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-center">رقم الطلب</td>

                                            <td class="text-center">تاريخ الطلب</td>

                                            <td class="text-center">كمية المنتجات</td>

                                            <td class="text-center">إجمالي الدفع المسبق</td>

                                            <td class="text-center">المبلغ الإجمالي</td>

                                            <td class="text-center">حالة الطلب</td>

                                            <td class="text-center">عمل</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php if($activerOrderList): foreach($activerOrderList as $list): ?>
                                        <tr>
                                            <td class="text-center">#<?=$list['order_id'];?></td>
                                            <td class="text-center"><?=date('d-m-Y',strtotime($list['created_at']));?></a></td>
                                            <td class="text-center"><?=$list['item_count'];?> المنتجات</td>
                                            <td class="text-center"><?=$list['upfront_amount'];?> LYD</td>
                                            <td class="text-center"><?=$list['total'];?> LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">
                                                <?php if($list['user_status']==1){ echo "جديد"; }elseif($list['user_status']==2){ echo "قيد الشحن"; }else{ echo "تم التوصيل"; } ?></span></div>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title=""  href="<?php echo base_url('ar/order-detail/'.$list['order_id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="completeorder">
                        <div class="user-gridpoints">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                            <td class="text-center">رقم الطلب</td>

                                            <td class="text-center">تاريخ الطلب</td>

                                            <td class="text-center">كمية المنتجات</td>

                                            <td class="text-center">إجمالي الدفع المسبق</td>

                                            <td class="text-center">المبلغ الإجمالي</td>

                                            <td class="text-center">حالة الطلب</td>

                                            <td class="text-center">عمل</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php if($completedOrdersList): foreach($completedOrdersList as $list): ?>
                                        <tr>
                                            <td class="text-center">#<?=$list['order_id'];?></td>
                                            <td class="text-center"><?=date('d-m-Y',strtotime($list['created_at']));?></a></td>
                                            <td class="text-center"><?=$list['item_count'];?> المنتجات</td>
                                            <td class="text-center"><?=$list['upfront_amount'];?> LYD</td>
                                            <td class="text-center"><?=$list['total'];?> LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">
                                                <?php if($list['user_status']==1){ echo "جديد"; }elseif($list['user_status']==2){ echo "قيد الشحن"; }else{ echo "تم التوصيل"; } ?></span></div>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title=""  href="<?php echo base_url('ar/order-detail/'.$list['order_id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                                            </td>
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
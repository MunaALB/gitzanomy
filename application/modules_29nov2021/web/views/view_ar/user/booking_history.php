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
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">حسابي</a></li>
            <li><a href="#">لوحة المستخدم</a></li>
            <li><a href="#">سجل الحجوزات </a></li>
        </ul>
        <div class="row">
            <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                <?php include 'usersidebar.php';?>
            </aside>
            <div id="content" class="col-sm-9 user-rightpart">
                <h2 class="title">سجل الحجوزات </h2>
                <div class="order-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#activeorder" aria-controls="activeorder" role="tab" data-toggle="tab">الحجوزات النشطة</a></li>
                        <li role="presentation" class=""><a href="#completeorder" aria-controls="completeorder" role="tab" data-toggle="tab">إتمام الحجز</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="activeorder">
                            <div class="user-gridpoints">
                                <div class="table-responsive">
                                    <?php if($active_booking): ?>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <td class="text-center">رقم الطلب</td>
                                                    <td class="text-center">تاريخ الطلب</td>
                                                    <td class="text-center">اسم الخدمة</td>
                                                    <td class="text-center">تكلفة خدمة</td>
                                                    <td class="text-center">حالة الطلب</td>
                                                    <td class="text-center">عمل</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($active_booking): foreach($active_booking as $list): ?>
                                                    <tr>
                                                        <td class="text-center">#<?=$list['booking_id'];?></td>
                                                        <td class="text-center"><?=date('d-m-Y',strtotime($list['created_at']));?></a></td>
                                                        <td class="text-center"><?=$list['service_name'];?></td>
                                                        <td class="text-center"><?=$list['amount'];?> LYD</td>
                                                        <td class="text-center">
                                                            <div class="price"> <span class="price-new">
                                                                <?php 
                                                                if($list['status']==1){ echo "قبلت"; } 
                                                                elseif($list['status']==2){ echo "في الطريق"; } 
                                                                else{ echo "تحت المعالجة"; } 
                                                                ?>
                                                            </span></div>
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-danger" title="" href="<?php echo base_url('booking-detail/'.$list['booking_id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
                                        <?php else: ?>
                                            <div class="col-lg-12 col-md-12 messege-nodata" style="margin-top: -96px;">
                                                <i class="fa fa-shopping-bag" style="font-size: 50px;"></i>
                                                <h2 class="about-title" style="font-size: 11px;">لا يوجد حجوزات مؤكدة متاحة</h2>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="completeorder">
                                <div class="user-gridpoints">
                                    <div class="table-responsive">
                                    <?php if($complete_booking): ?>
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <td class="text-center">رقم الطلب</td>
                                                    <td class="text-center">تاريخ الطلب</td>
                                                    <td class="text-center">اسم الخدمة</td>
                                                    <td class="text-center">تكلفة خدمة</td>
                                                    <td class="text-center">حالة الطلب</td>
                                                    <td class="text-center">عمل</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if($complete_booking): foreach($complete_booking as $list): ?>
                                                    <tr>
                                                        <td class="text-center">#<?=$list['booking_id'];?></td>
                                                        <td class="text-center"><?=date('d-m-Y',strtotime($list['created_at']));?></a></td>
                                                        <td class="text-center"><?=$list['service_name'];?></td>
                                                        <td class="text-center"><?=$list['amount'];?> LYD</td>
                                                        <td class="text-center">
                                                            <div class="price"> <span class="price-new">
                                                            انتهت الخدمة
                                                            </span></div>
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="btn btn-danger" title="" href="<?php echo base_url('booking-detail/'.$list['booking_id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; endif; ?>
                                            </tbody>
                                        </table>
                                        <?php else: ?>
                                            <div class="col-lg-12 col-md-12 messege-nodata" style="margin-top: -96px;">
                                                <i class="fa fa-shopping-bag" style="font-size: 50px;"></i>
                                                <h2 class="about-title" style="font-size: 11px;">لا توجد حجوزات نشطة متاحة</h2>
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
    </div>
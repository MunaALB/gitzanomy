    <div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">حسابي</a></li>
            <li><a href="#">لوحة المستخدم</a></li>
            <li><a href="#">الخدمات المطلوبة</a></li>
        </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                <?php include 'usersidebar.php';?>
                </aside>
                 <div id="content" class="col-sm-9 user-rightpart">
                    <h2 class="title">الخدمات المطلوبة</h2>
                    <div class="user-gridpoints">
                        <div class="table-responsive">
                            <?php if($request): ?>
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
                                        <?php if($request): foreach($request as $list): ?>
                                            <tr>
                                                <td class="text-center">#<?=$list['booking_id'];?></td>
                                                <td class="text-center"><?=date('d-m-Y',strtotime($list['created_at']));?></a></td>
                                                <td class="text-center"><?=$list['service_name'];?></td>
                                                <td class="text-center"><?=$list['amount'];?> LYD</td>
                                                <td class="text-center">
                                                    <div class="price"> <span class="price-new">
                                                    قيد الانتظار
                                                    </span></div>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger" title="" href="<?php echo base_url('request-detail/'.$list['booking_id']); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; else: ?>
                                            <div class="main-container container">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 messege-nodata">
                                                        <i class="fa fa-shopping-bag"></i>
                                                        <h2 class="about-title">No Data Found</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                                <?php else: ?>
                                    <div class="col-lg-12 col-md-12 messege-nodata" style="margin-top: -96px;">
                                        <i class="fa fa-shopping-bag" style="font-size: 50px;"></i>
                                        <h2 class="about-title" style="font-size: 11px;">No Any Request Available.</h2>
                                    </div>
                                <?php endif; ?>
                            </div>
                    </div>
                </div>
            </div>
    </div>
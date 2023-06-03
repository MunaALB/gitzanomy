
    <div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">حسابي</a></li>
        <li><a href="#">لوحة المستخدم</a></li>
        <li><a href="#">تفصيل الطلب</a></li>
    </ul>
    <div class="mycart-part">
        <div class="row">
            <div  id="content" class="col-sm-7">
                <div class="user-rightpart">
                   <h2 class="title">تفصيل الطلب</h2>
                    <div class="user-gridpoints">
                        <div class="products-list row nopadding-xs so-filter-gird list">
                            <div class="product-layout col-md-12 col-sm-12 col-xs-12">
                                <div class="product-item-container">
                                    <div class="left-block">
                                        <div class="product-image-container">
                                            <a href="<?php echo base_url('service-detail/'.$requestDetail['service_id']); ?>" target="_self" title="Chicken swinesha">
                                                <img src="<?=$requestDetail['service_image']?>" class="img-1 img-responsive" alt="320 X 320">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4><a href="<?php echo base_url('service-detail/'.$requestDetail['service_id']); ?>" title="Chicken swinesha" target="_self"><?=$requestDetail['service_name']?></a></h4>
                                            <div class="price"> <span class="price-new"><?=$requestDetail['amount'];?> LYD</span>
                                                <?php if($requestDetail['discount']>0): ?>
                                                    <span class="price-old"><?=$requestDetail['price'];?> LYD</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="other-valeu">
                                                <p><span>التاريخ والوقت:</span> <?=date('d-m-Y',strtotime($requestDetail['start_date']));?> | <?=date('h:i A',strtotime($requestDetail['start_time']));?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-status">
                                        <h3>حالة الطلب</h3>
                                        <div class="status-part">
                                            <ul>
                                                <li class="active" style="width: 19.33% !important;">قيد الانتظار</li>
                                                <li class="" style="width: 19.33% !important;">قبول</li>
                                                <li class="" style="width: 19.33% !important;">في الطريق</li>
                                                <li class="" style="width: 19.33% !important;">بدأت الخدمة</li>
                                                <li style="width: 19.33% !important;">انتهت الخدمة</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="col-sm-5">
                <div class="user-rightpart mb-5">
                      <h2 class="title">تفصيل الطلب</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <strong>رقم الطلب:</strong>
                                    </td>
                                    <td class="text-right">#<?=$requestDetail['booking_id'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>تاريخ الطلب:</strong>
                                    </td>
                                    <td class="text-right"><?=date('d-m-Y',strtotime($requestDetail['created_at']));?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>رقم الهاتف:</strong>
                                    </td>
                                    <td class="text-right">+<?=$requestDetail['user_country_code'];?> <?=$requestDetail['user_mobile'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>العنوان:</strong>
                                    </td>
                                    <td class="text-right"><?=$requestDetail['address'];?></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-left">
                                        <strong>City:</strong>
                                    </td>
                                    <td class="text-right"><?=$requestDetail['address'];?></td>
                                </tr> -->
                                <!-- <tr>
                                    <td class="text-left">
                                        <strong>Country:</strong>
                                    </td>
                                    <td class="text-right">Jordan</td>
                                </tr> -->
                            </tbody>
                        </table>
                </div>
                <div class="user-rightpart mb-5">
                      <h2 class="title">ملخص الدفع </h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <strong>طريقة الدفع او السداد:</strong>
                                    </td>
                                    <td class="text-right">
                                    <?php if($requestDetail['payment_type']==1){ echo "الدفع عند الاستلام"; }else{ echo "عبر الانترنت"; } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>خدمة كاملة:</strong>
                                    </td>
                                    <td class="text-right">1 الخدمات</td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>المجموع الفرعي:</strong>
                                    </td>
                                    <td class="text-right"><?=$requestDetail['amount'];?> LYD</td>
                                </tr>
                            </tbody>
                        </table>
                          <!-- <div class="buttons">
                            <div class="checkout-btn"><a href="#>" class="btn btn-primary">Cancel Request</a></div>
                          </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
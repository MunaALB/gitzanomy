<style>
    .order-status .status-part ul li {
        width: 25%;
    }
    .order-details-page .view-detail button {
        background: #f74f00;
        padding: 7px 20px;
        color: #ffffff;
        font-size: 14px;
        border-radius: 5px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>تفاصيل الطلب</h1>
    </div>
    <div class="content order-details-page">
        <div class="row">
            <div class="col-lg-8">
                <div class="card m-b-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="user-img pull-left"> <img src="<?= $booking['service_image'] ? $booking['service_image'] : base_url() . 'assets/vendor/images/dummy.jpg' ?>" class="img-responsive" alt="User Image"> </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="mail-contnet">
                                    <h4 class="text-black m-b-0"><?= ucwords($booking['service_name_ar']) ?></h4>
                                    <small><?= ucwords($booking['category_name_ar']) ?></small>
                                    <div class="product-price"> 
                                        <span class="price-new"><?= number_format($booking['amount'], 2) ?> LYD</span>
                                        <?php if ($booking['discount']) { ?>
                                            <span class="price-old"><?= number_format($booking['price'], 2) ?> LYD</span>
                                        <?php } ?>
                                    </div>
                                    <p title="Phone">التاريخ والوقت:<span> <?= date('d-m-Y', strtotime($booking['start_date'])) ?> | <?= date('h:i A', strtotime($booking['start_time'])) ?> </span></p>
                                    <div class="view-detail"><a href="<?php echo base_url('vendor/service-detail/' . $booking['service_id']); ?>">عرض الخدمة</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-status">
                        <?php if ($booking['status'] == 0) { ?>
                            <div class="box-profile">
                                <h3 class="profile-username text-center">طلبات الحجز الجديدة</h3>
                            </div>
                            <div class="view-detail row">
                                <div class="offset-4 col-md-8">
                                    <button class="btn btn-lg" onclick="checkStatus(this, <?= $booking['booking_id'] ?>, 1);">قبول</button>
                                    <button class="btn btn-lg" onclick="checkStatus(this, <?= $booking['booking_id'] ?>, 5);">رفض</button>
                                </div>
                            </div>
                        <?php } else if ($booking['status'] == 5) { ?>
                            <div class="box-profile">
                                <h3 class="profile-username text-center text-danger bg-light">طلب رفض</h3>
                            </div>
                        <?php } else { ?>
                            <div class="status-part">
                                <ul>
                                    <li class="<?= $booking['status'] < 1 ? '' : ($booking['status'] == 1 ? 'active' : 'completed') ?>" >قبول</li>
                                    <li class="<?= $booking['status'] < 2 ? '' : ($booking['status'] == 2 ? 'active' : 'completed') ?>" onclick="checkStatus(this, <?= $booking['booking_id'] ?>, 2);">علي الطريق</li>
                                    <li class="<?= $booking['status'] < 3 ? '' : ($booking['status'] == 3 ? 'active' : 'completed') ?>" onclick="checkStatus(this, <?= $booking['booking_id'] ?>, 3);">تحت المعالجة</li>
                                    <li class="<?= $booking['status'] < 4 ? '' : ($booking['status'] == 4 ? 'active' : 'completed') ?>" onclick="checkStatus(this, <?= $booking['booking_id'] ?>, 4);">تم إنجاز الخدمة</li>
                                </ul>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="box box-primary m-b-3">
                    <div class="box-profile">
                        <h3 class="profile-username">تفاصيل الطلب</h3>
                        <ul class="nav nav-stacked sty1">
                            <li><strong>تاريخ الطلب:</strong> <span><?= date('d-m-Y h:i A', strtotime($booking['created_at'])) ?></span></li>
                            <li><strong>طريقة الدفع:</strong> <span><?= $booking['payment_type'] == 1 ? 'COD' : ($booking['payment_type'] == 2 ? 'Online' : 'N/A') ?></span></li>
                            <li><strong>المبلغ الإجمالي:</strong> <span><?= number_format($booking['price'], 2) ?> LYD</span></li>
                            <li><strong>إجمالي الخصم:</strong> <span><?= number_format($booking['discount'], 2) ?> LYD</span></li>
                            <li><strong>المجموع الفرعي:</strong> <span><?= number_format($booking['amount'], 2) ?> LYD</span></li>
                        </ul>
                    </div>
                </div>
                <div class="box box-primary m-b-3">
                    <div class="box-profile">
                        <h3 class="profile-username">تفاصيل المستخدم</h3>
                        <ul class="nav nav-stacked sty1">
                            <li><strong>اسم المستخدم:</strong> <span><?= ucwords($booking['user_name']) ?></span></li>
                            <li><strong>رقم الهاتف المحمول:</strong> <span><?= $booking['mobile'] ? '+ ' . $booking['country_code'] . ' ' . $booking['mobile'] : 'N/A' ?></span></li>
                            <li><strong>البريد الإلكتروني:</strong> <span><?= $booking['email'] ?></span></li>
                            <li><strong>عنوان:</strong> <span><?= $booking['address'] ?></span></li>
<!--                            <li><strong>City:</strong> <span>Onidas</span></li>
                            <li><strong>Country:</strong> <span>Libya</span></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function checkStatus(obj, id, status) {
            var action = false;
            if (status == 5) {
                action = confirm('Continue to reject request?');
            } else {
                action = true;
            }
            if (action) {
                $.ajax({
                    url: "<?= base_url(); ?>vendor/Home/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=3',
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "200") {
//                            location.reload();
                            window.location.href = "<?= base_url() ?>vendor/booking-detail/" + id;
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
//                alert("Something Wrong");
                return false;
            }
        }
    </script>

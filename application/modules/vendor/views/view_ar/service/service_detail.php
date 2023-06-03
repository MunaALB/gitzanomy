<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>تفاصيل الخدمة </h1>
    </div>

    <div class="content eventdeatil">
        <?= $this->session->flashdata('response') ?>
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="<?php echo base_url('vendor/edit-service-detail/' . $service['service_id']); ?>" class="composemail pull-right"><i class="fa fa-edit"></i> تعديل الخدمة</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="text-white m-b-0">معلومات الخدمة</h5>
            </div>
            <div class="card-body">
                <div class="eventrow">
                    <div class="row mt-3">
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>فئة الخدمة</label>
                            <br>
                            <p class="text-muted"><?= $service['category_name_ar'] ?></p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>فئة الخدمة الفرعية</label>
                            <br>
                            <p class="text-muted"><?= $service['sub_category_name_ar'] ?></p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>اسم الخدمة (انجليزي)</label>
                            <br>
                            <p class="text-muted"><?= $service['name'] ?></p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>اسم الخدمة (بالعربية)</label>
                            <br>
                            <p class="text-muted"><?= $service['name_ar'] ?></p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>Service Price</label>
                            <br>
                            <p class="text-muted"><?= $service['price'] ?> LYD</p>
                        </div>
                        <div class="col-lg-12 col-xs-12 b-r">
                            <label>وصف الخدمة : </label>
                            <br>
                            <p class="text-muted"><?= $service['description'] ?></p>
                        </div>
                        <div class="col-lg-12 col-xs-12 b-r">
                            <label>وصف الخدمة (عربى): </label>
                            <br>
                            <p class="text-muted"><?= $service['description_ar'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($service_feature): ?>
        <div class="content eventdeatil">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-white m-b-0">مزايا الخدمة</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row mt-3">
                            <?php foreach ($service_feature as $feature): ?>
                                <div class="col-lg-12 col-xs-6 b-r">
                                    <p class="text-muted"><?= $feature['featues'] ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="content eventdeatil">
        <div class="card">
            <div class="card-header">
                <h5 class="text-white m-b-0">صورة لتوضيح الخدمة</h5>
            </div>
            <div class="card-body">
                <div class="eventrow">
                    <div class="row">
                        <div class="col-lg-3 col-xs-6 b-r">
                            <a href="#"><img src="<?= $service['image'] ? $service['image'] : base_url() . 'assets/web/images/dummy.jpg' ?>" alt="user" class="img-responsive "></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Service Detail </h1>
    </div>
    <?=$this->session->flashdata('response')?>
    <div class="content eventdeatil">
<!--        <div class="row mb-3">
            <div class="col-md-12">
                <a href="<?php echo base_url('vendor/edit-service-detail/' . $service['service_id']); ?>" class="composemail pull-right"><i class="fa fa-edit"></i> Edit a Service</a>
            </div>
        </div>-->
        <div class="card">
            <div class="card-header">
                <h5 class="text-white m-b-0">Service Information</h5>
            </div>
            <div class="card-body">
                <div class="eventrow">
                    <div class="row mt-3">
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>Service Category</label>
                            <br>
                            <p class="text-muted"><?= $service['category_name'] ?></p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>Service SubCategory</label>
                            <br>
                            <p class="text-muted"><?= $service['sub_category_name'] ?></p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>Service Name</label>
                            <br>
                            <p class="text-muted"><?= $service['name'] ?></p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>Service Name (Ar)</label>
                            <br>
                            <p class="text-muted"><?= $service['name_ar'] ?></p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>Service Price</label>
                            <br>
                            <!-- <p class="text-muted"><?= $service['price'] ?> LYD</p> -->
                            <p class="text-muted" ><?= number_format(($service['price'] - (($service['price'] * $service['discount']) / 100)), 2); ?> LYD</p>
                            <?php if ($service['discount'] > 0): ?>
                                <p class="text-muted" style="text-decoration: line-through;"><?= number_format($service['price'], 2); ?> LYD</p>                                    
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>Service Discount</label>
                            <br>
                            <p class="text-muted"><?= $service['discount'] ?> %</p>
                        </div>
                        <div class="col-lg-3 col-xs-6 b-r">
                            <label>Vendor Name</label>
                            <br>
                            <p class="text-muted"><a title="view vendor detail" href="<?php echo site_url('admin/vendor-detail/'.$service['vendor_id']); ?>"><?= $service['vendor_name'] ?></a></p>
                        </div>
                        <div class="col-lg-12 col-xs-12 b-r">
                            <label>Service Description : </label>
                            <br>
                            <p class="text-muted"><?= $service['description'] ?></p>
                        </div>
                        <div class="col-lg-12 col-xs-12 b-r">
                            <label>Service Description (Ar): </label>
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
                    <h5 class="text-white m-b-0">Service Features</h5>
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
                <h5 class="text-white m-b-0">Service Images</h5>
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
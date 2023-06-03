<style>
    .add-image-gallery button{
        color: black;
        font-size: 12px;
        background: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: 400;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>تفاصيل المنتج</h1>
    </div>
    <div class="content eventdeatil">
        <div class="card">
            <div class="">
                <div id="demo">
                    <div class="step-app">
                        <ul class="step-steps">
                            <li class="active"><a href="#step1"><span class="number">1</span>تفاصيل المنتج الأساسية</a></li>
                            <li class=""><a href="#step2"><span class="number">2</span>سمات المنتج</a></li>
                        </ul>
                        <div class="step-content for-border-remove">
                            <div class="step-tab-panel active" id="step1">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <a href="<?= base_url('vendor/edit-product-detail/' . $product_list['product_id']); ?>" class="composemail pull-right"><i class="fa fa-edit"></i> تعديل منتج</a>
                                    </div>
                                </div>
                                <div class=" eventdeatil">
                                    <div class="card-header">
                                        <h5 class="text-white m-b-0">معلومات المنتج/h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="eventrow">
                                            <div class="row mt-3">
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>فئة المنتج</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['category_name_ar']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>فئة المنتج الفرعية</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['sub_category_name_ar']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>العلامة التجارية للمنتج</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['brand_name_ar']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>موديل المنتج</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['model_name_ar']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" eventdeatil">
                                    <div class="card-header">
                                        <h5 class="text-white m-b-0">تفاصيل المنتج الأساسية</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="eventrow">
                                            <div class="row mt-3">
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>اسم المنتج (انجليزي)</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['name']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>اسم المنتج (عربي)</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['name_ar']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>خصم</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['discount'] ? $product_list['discount'] . '%' : 0; ?></p>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>وصف المنتج (انجليزي) : </label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['description']; ?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>وصف المنتج (عربي) : </label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['description_ar']; ?></p>
                                                </div>

                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>الأحكام والشروط : </label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['terms']; ?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>الشروط والأحكام عربي : </label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['terms_ar']; ?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>قابل للإرجاع</label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['is_returnable']==1){ echo "نعم"; }else{ echo "لا"; }?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>المدة الزمنية </label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['is_returnable']==1){ echo $product_list['duration']." أيام"; }else{ echo "N/A"; }?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>سياسة العائدات :/label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['is_returnable']==1){ echo $product_list['return_policy']; }else{ echo "N/A"; }?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>سياسة العائدات (عربى) : </label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['is_returnable']==1){ echo $product_list['return_policy_ar']; }else{ echo "N/A"; }?></p>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if ($product_list['product_specification']): ?>
                                    <div class="eventdeatil">
                                        <div class="card-header">
                                            <h5 class="text-white m-b-0">مواصفات المنتج</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="eventrow">
                                                <div class="row mt-3">
                                                    <?php foreach ($product_list['product_specification'] as $list): ?>
                                                        <div class="col-lg-3 col-xs-6 b-r">
                                                            <label><?= $list['attribute_name_ar']; ?></label>
                                                            <br>
                                                            <p class="text-muted"><?= $list['attribute_value_ar']; ?></p>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($product_list['product_featuers']): ?>
                                    <div class="eventdeatil">
                                        <div class="card-header">
                                            <h5 class="text-white m-b-0">مواصفات المنتج</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="eventrow">
                                                <div class="row mt-3">
                                                    <?php foreach ($product_list['product_featuers'] as $list): ?>
                                                        <div class="col-lg-3 col-xs-6 b-r">
                                                            <label><?= $list['name']; ?></label>
                                                            <br>
                                                            <p class="text-muted"><?= $list['value']; ?></p>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="step-tab-panel for-border-remove booking-detail" id="step2">
                                <?php if (isset($product_list['add_more_attribute']) and $product_list['add_more_attribute']): ?>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <a href="<?= base_url('vendor/add-more-attribute/' . $product_list['product_id']); ?>" class="composemail pull-right"><i class="fa fa-edit"></i>أضف سمات للمنتج</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if ($product_list['product_attribute_group']):
                                    foreach ($product_list['product_attribute_group'] as $key => $list):
                                        ?>
                                        <div class=" eventdeatil">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="text-white m-b-0">العنصر-<?= $key + 1; ?> <span class="add-image-gallery">
                                                            <!--<a href="<?= base_url() ?>vendor/edit-attribute/<?= $product_list['product_id']; ?>/<?= $list['item_id']; ?>">Edit Attributes</a>-->
                                                            <a style="cursor:pointer;color:black;" onclick="deleteItemData(this,'<?= $product_list['product_id']; ?>','<?= $list['item_id']; ?>');">Delete Attributes</a>
                                                        </span></h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="eventrow">
                                                        <div class="row mt-3">

                                                            <div class="col-lg-4 col-xs-6 b-r">
                                                                <label>رقم العنصر</label>
                                                                <br>
                                                                <p class="text-muted"><?= $list['item_no']; ?></p>
                                                            </div>
                                                            <div class="col-lg-4 col-xs-6 b-r">
                                                                <label>سعر المنتج</label>
                                                                <br>
                                                                <!-- <p class="text-muted"><?= $list['price']; ?> LYD</p> -->
                                                                <p class="text-muted" ><?= number_format(($list['price'] - (($list['price'] * $product_list['discount']) / 100)), 2); ?> LYD</p>
                                                                <?php if ($product_list['discount'] > 0): ?>
                                                                    <p class="text-muted" style="text-decoration: line-through;"><?= number_format($list['price'], 2); ?> LYD</p>                                    
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-lg-4 col-xs-6 b-r">
                                                                <label>كمية</label>
                                                                <br>
                                                                <p class="text-muted"><?= $list['quantity']; ?></p>
                                                            </div>
                                                            <?php if ($list['attribute_data']): foreach ($list['attribute_data'] as $attr): ?>
                                                                    <div class="col-lg-4 col-xs-6 b-r">
                                                                        <label><?= $attr['attribute_name_ar']; ?></label>
                                                                        <br>
                                                                        <p class="text-muted"><?= $attr['attribute_value_ar']; ?></p>
                                                                    </div>
                                                                    <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="eventrow">
                                                        <div class="row">
                                                            <?php if ($list['imagesArr']): foreach ($list['imagesArr'] as $imgArr): ?>
                                                                    <div class="col-lg-3 col-xs-6 b-r">
                                                                        <a href="#"><img src="<?= $imgArr['image']; ?>" alt="user" class="img-responsive "></a>
                                                                    </div>
                                                                    <?php
                                                                endforeach;
                                                            endif;
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function deleteItemData(o, p, i) {
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            if (p && i) {
                $.ajax({
                    url: "<?= base_url(); ?>vendor/home/ajax",
                    type: 'post',
                    data: 'method=deleteItemData&product_id=' + p + '&item_id=' + i,
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "200") {
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
            }
        }
    }
    
    
</script>

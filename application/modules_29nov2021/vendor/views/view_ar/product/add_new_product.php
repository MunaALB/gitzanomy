<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>أضف منتج جديد </h1>
    </div>
    <form method="POST" id="uploadProduct" enctype="multipart/form-data">
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">معلومات المنتج</h5>
                    <a href="<?=base_url('vendor/bulk-upload-product');?>" class="composemail pull-right" style="margin-top: -90px !important"> تحميل مركب</a>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <label>اختر الفئة</label>
                                <select class="form-control chosen regInputs chosen-rtl" data-title="اختر الفئة" id="category" name="category_id" onchange="getSubCategory(this);">
                                    <option value="">--اختر الفئة--</option>
                                    <?php if ($category_list): foreach ($category_list as $list): ?>
                                            <option value="<?= $list['category_id']; ?>"><?= $list['name_ar']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <p class="errorPrint" id="categoryError"></p>
                            </div>
                            <div class="col-md-6">
                                <label>حدد الفئة الفرعية</label>
                                <select class="form-control chosen regInputs chosen-rtl" data-title="حدد الفئة الفرعية" id="sub_category" name="sub_category_id" onchange="getMappedBrand(this);">
                                    <option value="">--حدد الفئة الفرعية--</option>
                                </select>
                                <p class="errorPrint" id="sub_categoryError"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">معلومات المنتج</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <label>حدد العلامة التجارية</label>
                                <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                <select class="form-control chosen regInputs chosen-rtl" id="brand" data-title="حدد العلامة التجارية" name="brand_id" onchange="getbrandModel(this);">
                                    <option value="">--حدد العلامة التجارية--</option>
                                </select>
                                <p class="errorPrint" id="brandError"></p>
                            </div>
                            <div class="col-md-6">
                                <label>اختر صنف</label>
                                <select id="model" class="form-control regInputs" name="model_id" onchange="setProductName(this);" data-title="اختر صنف">
                                    <option value="">--اختر صنف--</option>
                                </select>
                                <p class="errorPrint" id="modelError"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">معلومات اساسية</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">اسم المنتج (انجليزي)</label>
                                    <input class="form-control regInputs" data-title="اسم المنتج (انجليزي)" id="product_name" name="name" type="text" placeholder="">
                                    <p class="errorPrint" id="product_nameError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">اسم المنتج (انجليزي) (عربي)</label>
                                    <input class="form-control regInputs" data-title="اسم المنتج (انجليزي) (عربي)" id="product_name_ar" name="name_ar" type="text" placeholder="">
                                    <p class="errorPrint" id="product_name_arError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">سعر المنتج</label>
                                    <input class="form-control regInputs numberOnly" data-title="سعر المنتج" id="price" name="price" type="text" placeholder="">
                                    <p class="errorPrint" id="priceError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">اضافة خصم (٪)</label>
                                    <input class="form-control numberOnly discount" data-title="اضافة خصم (٪)" id="discount" name="discount" type="text" value="0" max="100" placeholder="">
                                    <p class="errorPrint" id="discountError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <label>Expected Delivery</label>
                                <input type="number" min="1" id="expected_delivery" class="form-control mb-4 regInputs" name="expected_delivery" placeholder="Expected Delivery (in days)"  data-title="Expected Delivery">
                                <p class="errorPrint" id="expected_deliveryError"></p>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">الكمية المتوفرة</label>
                                    <input class="form-control regInputs numberOnly" data-title="الكمية المتوفرة" id="stock" name="stock" type="text" placeholder="">
                                    <p class="errorPrint" id="stockError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">رمز التخزين التعريفي (SKU)</label>
                                    <input class="form-control" data-title="رمز التخزين التعريفي (SKU)" id="sku" name="sku" type="text" placeholder="">
                                    <p class="errorPrint" id="skuError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">وصف المنتج (انجليزي)</label>
                                    <textarea class="form-control regInputs" data-title="Description" id="description" name="description"  rows="5" placeholder="اكتب وصفًا للمنتج"></textarea>
                                    <p class="errorPrint" id="descriptionError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">وصف المنتج (عربي)</label>
                                    <textarea class="form-control regInputs" data-title="Description (Ar)" id="description_ar" name="description_ar"  rows="5" placeholder="اكتب وصفًا للمنتج"></textarea>
                                    <p class="errorPrint" id="description_arError"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">الشروط والاحكام</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">الشروط والاحكام</label>
                                    <textarea class="form-control " data-title="الشروط والاحكام" id="terms" name="terms"  rows="5" placeholder="الشروط والاحكام"></textarea>
                                    <p class="errorPrint" id="termsError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">الشروط والاحكام (عربى)</label>
                                    <textarea class="form-control " data-title="الشروط والاحكام (عربى)" id="terms_ar" name="terms_ar"  rows="5" placeholder="الشروط والاحكام (عربى)"></textarea>
                                    <p class="errorPrint" id="terms_arError"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">سياسة العائدات</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">قابل للإرجاع</label>
                                    <select id="is_returnable" onchange="isReturn(this);" class="form-control regInputs" name="is_returnable" data-title="قابل للإرجاع">
                                        <option value="">--اختر صنف--</option>
                                        <option value="1">نعم</option>
                                        <option value="2" selected>لا</option>
                                    </select>
                                    <p class="errorPrint" id="is_returnableError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">المدة الزمنية</label>
                                    <input class="form-control" readonly data-title="المدة الزمنية" id="duration" name="duration" type="text" placeholder="">
                                    <p class="errorPrint" id="durationError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">سياسة العائدات</label>
                                    <textarea class="form-control" readonly data-title="سياسة العائدات" id="return_policy" name="return_policy"  rows="5" placeholder="سياسة العائدات"></textarea>
                                    <p class="errorPrint" id="return_policyError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">سياسة العائدات (Ar)</label>
                                    <textarea class="form-control" readonly data-title="سياسة العائدات (عربى)" id="return_policy_ar" name="return_policy_ar"  rows="5" placeholder="سياسة العائدات(عربى)"></textarea>
                                    <p class="errorPrint" id="return_policy_arError"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="content eventdeatil" id="productAttribute" style="display:none;">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">سمات المنتج</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2" id="productAttributeData"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content eventdeatil" id="productSpecification" style="display:none;">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">مواصفات المنتج</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2" id="productSpecificationData"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content eventdeatil" id="productFeatuers" style="display:none;">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">مواصفات المنتج</h5>
                </div>
                <!-- <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2" id="productFeatuersData"></div>
                    </div>
                </div> -->
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2" id="productFeatuersData"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">صور المنتج</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <input onchange="validImage(this, 'image1');" type="file" accept="image/*" class="dropify regInputs" data-title="الصورة 1" id="image1" name="image[]" /> -->
                                    <input type="file" accept="image/*" class="dropify regInputs" data-title="الصورة 1" id="image1" name="image[]" />
                                    <p class="errorPrint" id="image1Error"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <input onchange="validImage(this, 'image2');" type="file" accept="image/*" class="dropify" data-title="الصورة 2" id="image2" name="image[]" /> -->
                                    <input type="file" accept="image/*" class="dropify" data-title="الصورة 2" id="image2" name="image[]" />
                                    <p class="errorPrint" id="image2Error"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <input onchange="validImage(this, 'image3');" type="file" accept="image/*" class="dropify" data-title="صورة 3" id="image3" name="image[]" /> -->
                                    <input type="file" accept="image/*" class="dropify" data-title="صورة 3" id="image3" name="image[]" />
                                    <p class="errorPrint" id="image3Error"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <input onchange="validImage(this, 'image4');" accept="image/*" type="file" class="dropify" data-title="صورة 4" id="image4" name="image[]"/> -->
                                    <input accept="image/*" type="file" class="dropify" data-title="صورة 4" id="image4" name="image[]"/>
                                    <p class="errorPrint" id="image4Error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xs-12">
                                <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right"> تحميل المنتج</button>
                                <button style="display:none;" id="add_product" type="submit" name="add_product"  class="composemail save-length pull-right"> تحميل المنتج</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if (($this->session->flashdata('response'))) {
        echo $this->session->flashdata('response');
        ?>

    <?php } ?>
</div>

<script>
    var formSubmitting = false;
    var setFormSubmitting = function () {
        formSubmitting = true;
    };

    function showErrorMessage(id, msg) {
        $("#" + id).empty();
        $("#" + id).append(msg);
        $("#" + id).css('display', 'block');
    }

    function getSubCategory(o) {
        var category = $(o).val();
        $("#brand").empty();
        $("#brand").append('<option value="">--حدد العلامة التجارية--</option>');
        $("#model").empty();
        $("#model").append('<option value="">--اختر صنف--</option>');
        $("#product_name").val('');
        $("#product_name").attr('readonly', false);
        if (category) {
            $.ajax({
                url: "<?php echo base_url("/vendor/Home/ajax") ?>",
                type: "POST",
                data: "method=getSubCategory&category_id=" + category,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);

                    $("#sub_category").empty();
                    var html = '<option value="">--حدد الفئة الفرعية--</option>';
                    if (jsonData['error_code'] == 100) {
                        var jsonData = jsonData['data'];
                        $(jsonData).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<option value="' + v['sub_category_id'] + '" data-id="' + v['category_id'] + '"  data-brand="' + v['is_brand'] + '"  data-model="' + v['is_model'] + '" >' + v['name_ar'] + '</option>';
                        });
                        $("#sub_category").append(html);
                        $('#sub_category').trigger('chosen:updated');
                    } else {
                        $("#sub_category").empty();
                        $("#sub_category").append('<option value="">--حدد الفئة الفرعية--</option>');
                        alert(jsonData['message']);
                    }

                }
            })
        } else {
            $("#sub_category").empty();
            $("#sub_category").append('<option value="">--حدد الفئة الفرعية--</option>');
        }

    }
    function getMappedBrand(o) {
        $(".errorPrint").css('display', 'none');
        $("#brand").empty();
        $("#brand").append('<option value="">--حدد العلامة التجارية--</option>');
        $("#model").empty();
        $("#model").append('<option value="">--اختر صنف--</option>');
        $("#product_name").val('');
        $("#product_name").attr('readonly', false);

        var getBrand = $(o).find(":selected").attr('data-brand');
        if (getBrand == 1) {
            $("#brand").attr('readonly', false);
            $("#brand").attr('disabled', false);
            $("#brand").addClass('regInputs');
        } else {
            $("#brand").attr('readonly', true);
            $("#brand").attr('disabled', true);
            $("#brand").removeClass('regInputs');
        }
        var getModel = $(o).find(":selected").attr('data-model');
        if (getModel == 1) {
            $("#model").attr('readonly', false);
            $("#model").attr('disabled', false);
            $("#model").addClass('regInputs');
        } else {
            $("#model").attr('readonly', true);
            $("#model").attr('disabled', true);
            $("#model").removeClass('regInputs');
        }
        var category = $("#category").val();
        var sub_category = $(o).val();
        if (category && sub_category) {
            var form_data = new FormData();
            form_data.append("category_id", category);
            form_data.append("sub_category_id", sub_category);
            form_data.append("method", "getMappedBrand");
            $.ajax({
                url: "<?php echo base_url("/vendor/Home/ajax") ?>",
                type: "POST",
                data: form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#productAttributeData").empty();
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    var jsonData = jsonData['data'];
                    //console.log('jsonDatajsonData',jsonData['mappedArr']);
                    var mappedArr = jsonData['mappedArr'];
                    var attribute_mapping = jsonData['attribute_mapping'];
                    var specification_mapping = jsonData['specification_mapping'];
                    var featuers_mapping = jsonData['featuers_mapping'];
                    $("#brand").empty();
                    var html = '<option value="">--حدد العلامة التجارية--</option>';
                    if (mappedArr[0]) {
                        $(mappedArr).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<option value="' + v['brand_mapping_id'] + '" data-id="' + v['brand_id'] + '">' + v['name_ar'] + '</option>';
                        });
                    } else {
                        $("#brand").attr('readonly', true);
                        $("#brand").attr('disabled', true);
                        $("#brand").removeClass('regInputs');
                    }
                    $("#brand").append(html);
                    $('#brand').trigger('chosen:updated');
                    if (attribute_mapping[0]) {
                        $("#productAttribute").css('display', 'block');
                        $("#productSpecificationData").css('display', 'block');
                        $("#productFeatuersData").css('display', 'block');
                        var html = '';
                        $(attribute_mapping).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<div class="col-md-6 m-b-3"><label>' + v['name_ar'] + '</label>';
                            html += '<input type=hidden value="' + v['attribute_id'] + '" name="attribute[]">';
                            html += '<select class="form-control p_attr chosen regInputs chosen-rtl" name="attribute_value[]" data-title="' + v['name_ar'] + '" id="' + v['attribute_mapping_id'] + '_' + i + '">';
                            html += '<option value="" selected disabled>تحديد ' + v['name_ar'] + '</option>';
                            var attrValues = v['attribute_value'];
                            if (attrValues) {
                                $(attrValues).each(function (i1, v1) {
                                    html += '<option value="' + v1['attribute_value_id'] + '">' + v1['value_ar'] + '</option>';
                                });
                            }
                            html += '</select>';
                            html += '<p class="errorPrint" id="' + v['attribute_mapping_id'] + '_' + i + 'Error"></p>';
                            html += '</div>';
                        });
                        $("#productAttributeData").append(html);
                        $('.p_attr').chosen();
                    }
                    if (specification_mapping[0]) {
                        $("#productSpecification").css('display', 'block');
                        var html = '';
                        $(specification_mapping).each(function (i, v) {
                            if (v['is_required'] == 1) {
                                var is_required = 'required';
                            } else {
                                var is_required = '';
                            }
                            //alert(v['sub_category_id'])
                            html += '<div class="col-md-6 m-b-3"><label>' + v['name_ar'] + '</label>';
                            html += '<input type=hidden value="' + v['attribute_id'] + '" name="specification[]">';
                            html += '<select class="form-control p_spec chosen regInputs chosen-rtl" name="specification_value[]" data-title="' + v['name_ar'] + '" id="' + v['attribute_mapping_id'] + '_' + i + '" ' + is_required + '>';
                            html += '<option value="" selected disabled>تحديد ' + v['name_ar'] + '</option>';
                            var attrValues = v['attribute_value'];
                            if (attrValues) {
                                $(attrValues).each(function (i1, v1) {
                                    html += '<option value="' + v1['attribute_value_id'] + '">' + v1['value_ar'] + '</option>';
                                });
                            }
                            html += '</select>';
                            html += '<p class="errorPrint" id="' + v['attribute_mapping_id'] + '_' + i + 'Error"></p>';
                            html += '</div>';
                        });
                        $("#productSpecificationData").append(html);
                        $('.p_spec').chosen();
                    }
                    if (featuers_mapping[0]) {
                        $("#productFeatuers").css('display', 'block');
                        var html = '';
                        $(featuers_mapping).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<div class="col-md-6"><div class="form-group">';
                            html += '<label for="">' + v['name'] + '</label>';
                            html += '<input type=hidden value="' + v['featuers_id'] + '" name="featuers[]">';
                            html += '<input class="form-control regInputs" name="featuers_value[]" data-title="' + v['name_ar'] + '" id="' + v['attribute_mapping_id'] + '_' + i + '" type="text" placeholder="">';
                            html += '<p class="errorPrint" id="' + v['attribute_mapping_id'] + '_' + i + 'Error"></p>';
                            html += '</div>';
                            html += ' </div>';
                        });
                        $("#productFeatuersData").append(html);

                    }
                }
            });
        } else {
            if (category) {
                showErrorMessage('filter_sub_categoryError', 'Required Field');
            } else {
                showErrorMessage('filter_categoryError', 'Required Field');
            }
        }
//        $('.p_attr').trigger('chosen:updated');
//        $('.p_spec').trigger('chosen:updated');

    }

    function getbrandModel(o) {
        var id = $(o).val();
        $("#model").empty();
        $("#model").append('<option value="">--اختر صنف--</option>');
        $("#product_name").val('');
        $("#product_name").attr('readonly', false);
        if (id) {
            $.ajax({
                url: "<?php echo base_url("/vendor/Home/ajax") ?>",
                type: "POST",
                data: "method=getMappedBrandModel&brand_mapping_id=" + id,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 100) {
                        $("#model").empty();
                        var jsonData = jsonData['data'];
                        var html = '<option value="">--اختر صنف--</option>';
                        $(jsonData).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<option value="' + v['model_id'] + '" data-id="' + v['brand_id'] + '" data-ar="' + v['name_ar'] + '">' + v['name'] + '</option>';
                        });
                        $("#model").append(html);
                        // $('#model').trigger('chosen:updated');

                        $("#model").attr('readonly', false);
                        $("#model").attr('disabled', false);
                        $("#model").addClass('regInputs');
                    } else {
                        //alert(jsonData['message']);
                        $("#model").attr('readonly', true);
                        $("#model").attr('disabled', true);
                        $("#model").removeClass('regInputs');
                    }
                }
            })
        } else {
            $("#model").empty();
            $("#model").append('<option value="">--اختر صنف--</option>');
        }
    }

    function addProduct(o) {
        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('data-title') + ' املأ هذا الفراغ');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
        if (idValidate) {
            return false;
        } else {
            setFormSubmitting();
            $("#add_product").click();
        }
    }
    function setProductName(o) {
        var productName = $(o).find(':selected').text();
        var productNameAr = $(o).find(':selected').attr('data-ar');
        //alert(productName);
        if (productName) {
            $("#product_name").val(productName);
            $("#product_name").attr('readonly', true);

        } else {
            $("#product_name").val();
            $("#product_name").attr('readonly', false);
        }
        if (productNameAr) {
            $("#product_name_ar").val(productNameAr);
            $("#product_name_ar").attr('readonly', true);
        } else {
            $("#product_name_ar").val();
            $("#product_name_ar").attr('readonly', false);

        }
    }

    function validImage(obj, i) {
        var _URL = window.URL || window.webkitURL;
        var file = $(':input[type="file"]').prop('files')[0];
        var img = new Image();
        img.onload = function () {
            var wid = this.width;
            var ht = this.height;
            //alert(wid+'&'+ht);
            if ((wid < 450 || wid > 500) || ht !== 500) {
                $('#add_product_set').attr('disabled', true);
                showErrorMessage(i + 'Error', 'أبعاد الصورة المفضلة 500 × 500 بكسل');
            } else {
                $('#add_product_set').attr('disabled', false);
                $('#' + i + 'Error').html('');
            }
        };
        img.src = _URL.createObjectURL(file);
    }

    window.onload = function () {
        window.addEventListener("beforeunload", function (e) {
            if (formSubmitting) {
                return undefined;
            }
            e = (e || window.event);
            var confirmationMessage = "Are you sure you want to leave, you haven't saved your progess!";
            e.returnValue = confirmationMessage; //Gecko + IE

            return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
        });
        window.onbeforeunload = null;
    };

    function isReturn(o){
        var value=$(o).val();
        if(value==1){
            $("#duration").addClass('regInputs');
            $("#duration").attr('readonly',false);
            $("#return_policy").addClass('regInputs');
            $("#return_policy").attr('readonly',false);
            $("#return_policy_ar").addClass('regInputs');
            $("#return_policy_ar").attr('readonly',false);
        }else{
            $("#duration").removeClass('regInputs');
            $("#duration").attr('readonly',true);
            $("#return_policy").removeClass('regInputs');
            $("#return_policy").attr('readonly',true);
            $("#return_policy_ar").removeClass('regInputs');
            $("#return_policy_ar").attr('readonly',true);
        }
    }
</script>

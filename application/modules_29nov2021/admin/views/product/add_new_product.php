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
        <h1>Add a Product </h1>
        <a href="<?= base_url('admin/bulk-upload-product'); ?>" class="composemail pull-right" style="margin-top: -30px;"> Upload Excel</a>
    </div>

    <form method="POST" id="uploadProduct" enctype="multipart/form-data">
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <label>Select Category</label>
                                <select class="form-control chosen regInputs" data-title="Category" id="category" name="category_id" onchange="getSubCategory(this);">
                                    <option value="">--SELECT CATEGORY--</option>
                                    <?php if ($category_list): foreach ($category_list as $list): ?>
                                            <option value="<?= $list['category_id']; ?>"><?= $list['name']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <p class="errorPrint" id="categoryError"></p>
                            </div>
                            <div class="col-md-6">
                                <label>Select SubCategory</label>
                                <select class="form-control regInputs" data-title="Sub-Category" id="sub_category" name="sub_category_id" onchange="getMappedBrand(this);">
                                    <option value="">--SELECT SUB-CATEGORY--</option>
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
                    <h5 class="card-title">Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-4">
                                <label>Select Brand</label>
                                <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                <select class="form-control regInputs" id="brand" data-title="Brand" name="brand_id" onchange="getbrandModel(this);">
                                    <option value="">--SELECT BRAND--</option>
                                </select>
                                <p class="errorPrint" id="brandError"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Select Modal</label>
                                <select id="model" class="form-control regInputs" name="model_id" onchange="setProductName(this);" data-title="Model">
                                    <option value="">--SELECT MODEL--</option>
                                </select>
                                <p class="errorPrint" id="modelError"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Product From</label>
                                <select id="product_from" class="form-control regInputs" name="product_from" data-title="Product From">
                                    <option value="">--SELECT TYPE--</option>
                                    <option value="1">Inventory</option>
                                    <option value="2">Dubai</option>
                                </select>
                                <p class="errorPrint" id="product_fromError"></p>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-4">
                                <label>Select Hub</label>
                                <select class="form-control chosen regInputs" data-title="Hub" id="hub_id" name="hub_id">
                                    <option value="">--SELECT HUB--</option>
                                    <?php if ($hub_list): foreach ($hub_list as $list): ?>
                                            <option value="<?= $list['id']; ?>"><?= $list['name']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <p class="errorPrint" id="hub_idError"></p>
                            </div>

                            <div class="col-md-4">
                                <label>Expected Delivery</label>
                                <input type="number" min="1" id="expected_delivery" class="form-control mb-4 regInputs" name="expected_delivery" placeholder="Expected Delivery (in days)"  data-title="Expected Delivery">
                                <p class="errorPrint" id="expected_deliveryError"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Product Weight</label>
                                <input type="text" id="product_weight" class="form-control mb-4 regInputs" name="weight" placeholder="Product Weight"  data-title="Product Weight">
                                <p class="errorPrint" id="product_weightError"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Product Height</label>
                                <input type="text" id="product_height" class="form-control mb-4 regInputs" name="height" placeholder="Product Height"  data-title="Product Height">
                                <p class="errorPrint" id="product_heightError"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Basic Information</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No of Stock</label>
                                    <input class="form-control regInputs" data-title="Stock" id="stock" name="stock" type="text" placeholder="">
                                    <p class="errorPrint" id="stockError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">SKU</label>
                                    <input class="form-control" data-title="Sku-Id" id="sku" name="sku" type="text" placeholder="">
                                    <p class="errorPrint" id="skuError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input class="form-control regInputs" data-title="Product Name" id="product_name" name="name" type="text" placeholder="">
                                    <p class="errorPrint" id="product_nameError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Name (Ar)</label>
                                    <input class="form-control regInputs" data-title="Product Name (Ar)" id="product_name_ar" name="name_ar" type="text" placeholder="">
                                    <p class="errorPrint" id="product_name_arError"></p>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Price</label>
                                    <input class="form-control regInputs" data-title="Price" id="price" name="price" type="text" placeholder="">
                                    <p class="errorPrint" id="priceError"></p>
                                </div>
                            </div> -->
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Price</label>
                                    <input class="form-control regInputs" data-title="Price" id="price" name="price" type="text" placeholder="">
                                    <p class="errorPrint" id="priceError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Discount (%)</label>
                                    <input class="form-control" data-title="Discount" id="discount" name="discount" type="text" min="0" max="100" placeholder="">
                                    <p class="errorPrint" id="discountError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product Description</label>
                                    <textarea class="form-control regInputs" data-title="Description" id="description" name="description"  rows="5" placeholder="Write a Product Description..."></textarea>
                                    <p class="errorPrint" id="descriptionError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product Description (Ar)</label>
                                    <textarea class="form-control regInputs" data-title="Description (Ar)" id="description_ar" name="description_ar"  rows="5" placeholder="Write a Product Description..."></textarea>
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
                    <h5 class="card-title">Terms & Condition</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Terms & Condition</label>
                                    <textarea class="form-control " data-title="Terms & Condition" id="terms" name="terms"  rows="5" placeholder="Write a Terms & Condition..."></textarea>
                                    <p class="errorPrint" id="termsError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Terms & Condition (Ar)</label>
                                    <textarea class="form-control " data-title="Terms & Condition (Ar)" id="terms_ar" name="terms_ar"  rows="5" placeholder="Write a Terms & Condition(Ar)..."></textarea>
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
                    <h5 class="card-title">Return Policy</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Is Returnable</label>
                                    <select id="is_returnable" onchange="isReturn(this);" class="form-control regInputs" name="is_returnable" data-title="Is Returnable">
                                        <option value="">--SELECT TYPE--</option>
                                        <option value="1">Yes</option>
                                        <option value="2" selected>No</option>
                                    </select>
                                    <p class="errorPrint" id="is_returnableError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Duration</label>
                                    <input class="form-control" readonly data-title="Duration" id="duration" name="duration" type="text" placeholder="">
                                    <p class="errorPrint" id="durationError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Return Policy</label>
                                    <textarea class="form-control" readonly data-title="Return Policy" id="return_policy" name="return_policy"  rows="5" placeholder="Return Policy..."></textarea>
                                    <p class="errorPrint" id="return_policyError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Return Policy (Ar)</label>
                                    <textarea class="form-control" readonly data-title="Return Policy (Ar)" id="return_policy_ar" name="return_policy_ar"  rows="5" placeholder="Return Policy(Ar)..."></textarea>
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
                    <h5 class="card-title">Product Attribute</h5>
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
                    <h5 class="card-title">Product Specification</h5>
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
                    <h5 class="card-title">Product Featuers</h5>
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
                    <h5 class="card-title">Product Images</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <input onchange="validImage(this,'image1');" type="file" class="dropify regInputs" data-title="Image-1" id="image1" name="image[]" /> -->
                                    <input type="file" class="dropify regInputs" data-title="Image-1" id="image1" name="image[]" />
                                    <p class="errorPrint" id="image1Error"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <input onchange="validImage(this,'image2');" type="file" class="dropify regInputs" data-title="Image-2" id="image2" name="image[]" /> -->
                                    <input type="file" class="dropify" data-title="Image-2" id="image2" name="image[]" />
                                    <p class="errorPrint" id="image2Error"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <input onchange="validImage(this,'image3');" type="file" class="dropify" data-title="Image-3" id="image3" name="image[]" /> -->
                                    <input type="file" class="dropify" data-title="Image-3" id="image3" name="image[]" />
                                    <p class="errorPrint" id="image3Error"></p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <!-- <input onchange="validImage(this,'image4');" type="file" class="dropify" data-title="Image-4" id="image4" name="image[]"/> -->
                                    <input type="file" class="dropify" data-title="Image-4" id="image4" name="image[]"/>
                                    <p class="errorPrint" id="image4Error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xs-12">
                                <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right"> Upload Product</button>
                                <button style="display:none;" id="add_product" type="submit" name="add_product"  class="composemail save-length pull-right"> Upload Product</button>
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


<script>
    function showErrorMessage(id, msg) {
        $("#" + id).empty();
        $("#" + id).append(msg);
        $("#" + id).css('display', 'block');
    }

    function manageDataContent(sc, b, m, a, sp) {
        if (b) {
            $("#brand").empty();
            $("#brand").append('<option value="">--SELECT BRAND--</option>');
        }
        if (m) {
            $("#model").empty();
            $("#model").append('<option value="">--SELECT MODEL--</option>');
            $("#product_name").val('');
            $("#product_name").attr('readonly', false);
        }
        if (sc) {
            $("#sub_category").empty();
            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
        }
        if (a) {
            $("#productAttributeData").empty();
            $("#productAttribute").css('display', 'none');
            // $("#productFeatuers").css('display','none');
            // $("#productFeatuersData").css('display','none');
        }
        if (sp) {
            $("#productSpecificationData").empty();
            $("#productSpecification").css('display', 'none');
        }
    }

    function getSubCategory(o) {
        var category = $(o).val();
        if (category) {
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: "method=getSubCategory&category_id=" + category,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);

                    $("#sub_category").empty();
                    var html = '<option value="">--SELECT SUB-CATEGORY--</option>';
                    if (jsonData['error_code'] == 100) {
                        var jsonData = jsonData['data'];
                        $(jsonData).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<option value="' + v['sub_category_id'] + '" data-id="' + v['category_id'] + '"  data-brand="' + v['is_brand'] + '"  data-model="' + v['is_model'] + '" >' + v['name'] + '</option>';
                        });
                        $("#sub_category").append(html);
                        manageDataContent(false, true, true, true, true);
                    } else {
                        manageDataContent(true, true, true, true, true);
                    }

                }
            })
        } else {
            manageDataContent(true, true, true, true, true);
        }
    }

    function getMappedBrand(o) {
        $(".errorPrint").css('display', 'none');
        manageDataContent(false, true, true, true, true);
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
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
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
                    var html = '<option value="">--SELECT BRAND--</option>';
                    if (mappedArr[0]) {
                        $(mappedArr).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<option value="' + v['brand_mapping_id'] + '" data-id="' + v['brand_id'] + '">' + v['name'] + '</option>';
                        });
                    } else {
                        $("#brand").attr('readonly', true);
                        $("#brand").attr('disabled', true);
                        $("#brand").removeClass('regInputs');
                    }
                    $("#brand").append(html);
                    if (attribute_mapping[0]) {
                        $("#productAttribute").css('display', 'block');
                        $("#productSpecificationData").css('display', 'block');
                        $("#productFeatuersData").css('display', 'block');
                        var html = '';
                        $(attribute_mapping).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<div class="col-md-6 m-b-3"><label>' + v['name'] + '</label>';
                            html += '<input type=hidden value="' + v['attribute_id'] + '" name="attribute[]">';
                            html += '<select class="form-control regInputs" name="attribute_value[]" data-title="' + v['name'] + '" id="' + v['attribute_mapping_id'] + '_' + i + '">';
                            html += '<option value="" selected disabled>Select ' + v['name'] + '</option>';
                            var attrValues = v['attribute_value'];
                            if (attrValues) {
                                $(attrValues).each(function (i1, v1) {
                                    html += '<option value="' + v1['attribute_value_id'] + '">' + v1['value'] + '</option>';
                                });
                            }
                            html += '</select>';
                            html += '<p class="errorPrint" id="' + v['attribute_mapping_id'] + '_' + i + 'Error"></p>';
                            html += '</div>';
                        });
                        $("#productAttributeData").append(html);
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
                            html += '<div class="col-md-6 m-b-3"><label>' + v['name'] + '</label>';
                            html += '<input type=hidden value="' + v['attribute_id'] + '" name="specification[]">';
                            html += '<select class="form-control regInputs" name="specification_value[]" data-title="' + v['name'] + '" id="' + v['attribute_mapping_id'] + '_' + i + '" ' + is_required + '>';
                            html += '<option value="" selected disabled>Select ' + v['name'] + '</option>';
                            var attrValues = v['attribute_value'];
                            if (attrValues) {
                                $(attrValues).each(function (i1, v1) {
                                    html += '<option value="' + v1['attribute_value_id'] + '">' + v1['value'] + '</option>';
                                });
                            }
                            html += '</select>';
                            html += '<p class="errorPrint" id="' + v['attribute_mapping_id'] + '_' + i + 'Error"></p>';
                            html += '</div>';
                        });
                        $("#productSpecificationData").append(html);
                    }
                    if (featuers_mapping[0]) {
                        $("#productFeatuers").css('display', 'block');
                        var html = '';
                        $(featuers_mapping).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<div class="col-md-6"><div class="form-group">';
                            html += '<label for="">' + v['name'] + '</label>';
                            html += '<input type=hidden value="' + v['featuers_id'] + '" name="featuers[]">';
                            html += '<input class="form-control regInputs" name="featuers_value[]" data-title="' + v['name'] + '" id="' + v['attribute_mapping_id'] + '_' + i + '" type="text" placeholder="">';
                            html += '<p class="errorPrint" id="' + v['attribute_mapping_id'] + '_' + i + 'Error"></p>';
                            html += '</div>';
                            html += ' </div>';
                        });
                        $("#productFeatuersData").append(html);
                    }
                }
            })
        } else {
            alert("Error");
        }
    }

    function getbrandModel(o) {
        var id = $(o).val();
        $("#model").empty();
        $("#model").append('<option value="">--SELECT MODEL--</option>');
        $("#product_name").val('');
        $("#product_name").attr('readonly', false);
        if (id) {
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: "method=getMappedBrandModel&brand_mapping_id=" + id,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 100) {
                        $("#model").empty();
                        var jsonData = jsonData['data'];
                        var html = '<option value="">--SELECT MODEL--</option>';
                        $(jsonData).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<option value="' + v['model_id'] + '" data-id="' + v['brand_id'] + '">' + v['name'] + '</option>';
                        });
                        $("#model").append(html);

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
            $("#model").append('<option value="">--SELECT MODEL--</option>');
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
                $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('data-title') + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
        if (idValidate) {
            return false;
        } else {
            $("#add_product").click();
        }
    }
    function setProductName(o) {
        var productName = $(o).find(':selected').text();
        //alert(productName);
        if (productName) {
            $("#product_name").val(productName);
            $("#product_name").attr('readonly', true);
        } else {
            $("#product_name").val();
            $("#product_name").attr('readonly', false);
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
                showErrorMessage(i + 'Error', 'Preferred Image Dimension 500X500 pixels');
            } else {
                $('#add_product_set').attr('disabled', false);
                $('#' + i + 'Error').html('');
            }
        };
        img.src = _URL.createObjectURL(file);
    }

    function isReturn(o) {
        var value = $(o).val();
        if (value == 1) {
            $("#duration").addClass('regInputs');
            $("#duration").attr('readonly', false);
            $("#return_policy").addClass('regInputs');
            $("#return_policy").attr('readonly', false);
            $("#return_policy_ar").addClass('regInputs');
            $("#return_policy_ar").attr('readonly', false);
        } else {
            $("#duration").removeClass('regInputs');
            $("#duration").attr('readonly', true);
            $("#return_policy").removeClass('regInputs');
            $("#return_policy").attr('readonly', true);
            $("#return_policy_ar").removeClass('regInputs');
            $("#return_policy_ar").attr('readonly', true);
        }
    }
</script>

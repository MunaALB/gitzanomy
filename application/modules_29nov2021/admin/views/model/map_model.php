<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .margin-20{
        margin-top: 20px;
    }

    .deletecategory  li{
        position:relative;
        margin-right: 15px;
        margin-bottom: 15px;
    }
    .deletecategory  li:after{
        position:absolute;
        content:'\f00d';
        font-family:FontAwesome;
        top: -7px;
        right: -7px;
        background: #F74F00;
        padding: 3px 7px;
        border-radius: 50%;
        font-size: 10px;
        cursor: pointer;
        z-index: 1;
    }

</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Model Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url(); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Model Management</li>
        </ol>
    </div>
    <div class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <label>Select Category</label>
                                <select class="form-control chosen regInputs" data-title="Category" id="category" onchange="getSubCategory(this, 1);">
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
                            <div class="col-md-12 mt-4">
                                <label>Select Sub-Category</label>
                                <!---<select class="form-control chosen" id="sub_category" >-->
                                <!-- <select class="form-control regInputs" data-title="Sub-Category" id="sub_category" onchange="checkIsModel(this);"> -->
                                <select class="form-control regInputs" data-title="Sub-Category" id="sub_category">
                                    <option value="">--SELECT SUB-CATEGORY--</option>
                                </select>
                                <p class="errorPrint" id="sub_categoryError"></p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="form-group">
                                    <label>Select Brand</label>
                                    <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);">
                                        <option value="">--SELECT Brand--</option>
                                        <?php if ($brand_list): foreach ($brand_list as $list): ?>
                                                <option value="<?= $list['brand_id']; ?>"><?= $list['name']; ?></option>
                                            <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                    <p class="errorPrint" id="brandError"></p>
                                </div>
                            </div>
                            <div class="col-md-12"  id="modelDiv">
                                <div class="form-group map-attribute-btn">
                                    <label>Select Model</label>
                                    <!-- <select name="depts" id="example-getting-started" multiple="multiple" class="form-control"> -->
                                    <select id="model" class="form-control regInputs" data-title="Model">
                                        <option value="">--SELECT MODEL--</option>
                                    </select>
                                    <p class="errorPrint" id="modelError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" onclick="addModel(this);" class="composemail mt-4 pull-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-12 margin-20">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4 mb-2">
                                <label>Category</label>
                                <select class="form-control chosen" id="filter_category" onchange="getSubCategory(this, 2);">
                                    <option value="">--SELECT CATEGORY--</option>
                                    <?php if ($category_list): foreach ($category_list as $list): ?>
                                            <option value="<?= $list['category_id']; ?>"><?= $list['name']; ?></option>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <p class="errorPrint" id="filter_categoryError"></p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label> Sub-Category</label>
                                <!-- <select class="form-control chosen"> -->
                                <select class="form-control" data-title="Sub-Category" id="filter_sub_category" onchange="getMappedBrand(this);">
                                    <option value="">--SELECT SUB-CATEGORY--</option>
                                </select>
                                <p class="errorPrint" id="filter_sub_categoryError"></p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Brand</label>
                                <!-- <select class="form-control chosen"> -->
                                <select class="form-control" id="filter_brand" onchange="getMappedModel(this);">
                                    <option value="">--SELECT BRAND--</option>
                                </select>
                                <p class="errorPrint" id="filter_brandError"></p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group deletecategory" id="mappedModels">
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <button type="submit" class="composemail  pull-right">Edit</button>
                            </div> -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    function showErrorMessage(id, msg) {
        $("#" + id).empty();
        $("#" + id).append(msg);
        $("#" + id).css('display', 'block');
    }

    function manageDataContent(sc, b, m, fsc, fb, fm) {
        if (b) {
            $("#brand").empty();
            $("#brand").append('<option value="">--SELECT BRAND--</option>');
        }
        if (m) {
            $("#model").empty();
            $("#model").append('<option value="">--SELECT MODEL--</option>');
        }
        if (sc) {
            $("#sub_category").empty();
            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
        }
        if (fm) {
            $("#mappedModels").empty();
        }
        if (fb) {
            $("#filter_sub_category").empty();
            $("#filter_sub_category").append('<option value="">--SELECT BRAND--</option>');
        }
        if (fsc) {
            $("#filter_brand").empty();
            $("#filter_brand").append('<option value="">--SELECT BRAND--</option>');
        }
    }

    function getSubCategory(o, t) {
        var category = $(o).val();
        if (category) {
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: "method=getSubCategory&category_id=" + category + '&mappedType=2',
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (t == 1) {
                        manageDataContent(true, false, true, false, false, false);
                        $("#sub_category").empty();
                        var html = '<option value="">--SELECT SUB-CATEGORY--</option>';
                        if (jsonData['error_code'] == 100) {
                            var jsonData = jsonData['data'];
                            $(jsonData).each(function (i, v) {
                                //alert(v['sub_category_id'])
                                html += '<option value="' + v['sub_category_id'] + '" data-id="' + v['category_id'] + '" data-brand="' + v['is_brand'] + '" data-model="' + v['is_model'] + '">' + v['name'] + '</option>';
                            });
                            $("#sub_category").append(html);
                        } else {
                            $("#sub_category").empty();
                            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
                            // alert(jsonData['message']);
                        }
                    } else {
                        manageDataContent(false, false, false, true, true, true);
                        $("#filter_sub_category").empty();
                        var html = '<option value="">--SELECT SUB-CATEGORY--</option>';
                        if (jsonData['error_code'] == 100) {
                            var jsonData = jsonData['data'];
                            $(jsonData).each(function (i, v) {
                                //alert(v['sub_category_id'])
                                html += '<option value="' + v['sub_category_id'] + '" data-id="' + v['category_id'] + '">' + v['name'] + '</option>';
                            });
                            $("#filter_sub_category").append(html);
                        } else {
                            $("#filter_brand").empty();
                            $("#filter_brand").append('<option value="">--SELECT BRAND--</option>');
                            $("#filter_sub_category").empty();
                            $("#filter_sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
                            alert(jsonData['message']);
                        }
                    }
                }
            })
        } else {
            if (t == 1) {
                manageDataContent(true, false, true, false, false, false);
            } else {
                manageDataContent(false, false, false, true, true, true);
            }
        }
    }
    function getbrandModel(o) {
        var id = $(o).val();
        if (id) {
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: "method=getBrandModel&brand_id=" + id,
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
                    } else {
                        alert(jsonData['message']);
                    }

                }
            })
        } else {
            $("#model").empty();
            $("#model").append('<option value="">--SELECT MODEL--</option>');
        }
    }

    function addModel(o) {
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
            var form_data = new FormData();
            form_data.append("category_id", ($("#category").val()).trim());
            form_data.append("sub_category_id", ($("#sub_category").val()).trim());
            form_data.append("brand_id", ($("#brand").val()).trim());
            form_data.append("model_id", ($("#model").val()).trim());
            form_data.append("method", "BrandModelMapping");
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 100) {
                        alert(jsonData['message']);
                        location.reload();
                    } else {
                        alert(jsonData['message']);
                    }

                }
            })
        }
    }
    function getMappedBrand(o) {
        $(".errorPrint").css('display', 'none');
        var category = $("#filter_category").val();
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
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 100) {
                        $("#filter_brand").empty();
                        var jsonData = jsonData['data']['mappedArr'];
                        var html = '<option value="">--SELECT BRAND--</option>';
                        $(jsonData).each(function (i, v) {
                            //alert(v['sub_category_id'])
                            html += '<option value="' + v['brand_id'] + '" data-id="' + v['brand_id'] + '">' + v['name'] + '</option>';
                        });
                        $("#filter_brand").append(html);
                    } else {
                        $("#mappedModels").empty();
                        $("#filter_brand").empty();
                        $("#filter_brand").append('<option value="">--SELECT BRAND--</option>');
                        alert(jsonData['message']);
                    }

                }
            })
        } else {
            if (category) {
                showErrorMessage('filter_sub_categoryError', 'Required Field');
            } else {
                showErrorMessage('filter_categoryError', 'Required Field');
            }
        }
    }

    function getMappedModel(o) {
        $(".errorPrint").css('display', 'none');
        var category = $("#filter_category").val();
        var sub_category = $("#filter_sub_category").val();
        var brand = $(o).val();
        if (category && sub_category && brand) {
            var form_data = new FormData();
            form_data.append("category_id", category);
            form_data.append("sub_category_id", sub_category);
            form_data.append("brand_id", brand);
            form_data.append("method", "getMappedModel");
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 100) {
                        $("#mappedModels").empty();
                        var jsonData = jsonData['data'];
                        var html = '<label class="d-block">Models</label>';
                        var isDataAvailable = false;
                        $(jsonData).each(function (i, v) {
                            isDataAvailable = true;
                            //alert(v['sub_category_id'])
                            html += '<li style="cursor:pointer;" onclick="deleteData(this,' + v['model_id'] + ');" class="btn btn-rounded btn-secondary">' + v['name'] + '</li>';
                        });
                        if (isDataAvailable) {
                            $("#mappedModels").append(html);
                        }
                    } else {
                        alert(jsonData['message']);
                    }

                }
            })
        } else {
            if (category) {
                showErrorMessage('filter_sub_categoryError', 'Required Field');
            } else {
                showErrorMessage('filter_categoryError', 'Required Field');
            }
        }
    }

    function checkIsModel(o) {
        var getModel = $(o).find(":selected").attr('data-model');
        if (getModel == 1) {
            $("#modelDiv").css('display', 'block');
            $("#model").addClass('regInputs');
        } else {
            $("#modelDiv").css('display', 'none');
            $("#model").removeClass('regInputs');
        }
    }
////  06-06-2020   ////
    function deleteData(obj, id) {
        var check = confirm('Are you sure to delete ?');
        if (check) {
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=ModelStatus&id=' + id + '&action=99',
                    success: function (data) {
                        var dt = $.trim(data);
                        //alert(dt);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
//                            location.reload();
                            $(obj).remove();
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
    ////  06-06-2020   ////
</script>

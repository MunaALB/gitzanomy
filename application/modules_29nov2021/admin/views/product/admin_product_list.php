<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .imgesClass{
        width: 150px;
        height: 150px;
        border-radius: 77px;
        border: 1px solid #ef4d32;
    }
    .imgesClassTable{
        width: 100px;
        height: 100px;
        border-radius: 77px;
        border: 1px solid #ef4d32;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Admin Product List</h1>
    </div>
    <div class="content">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <form method="post" >
                                <div class="eventrow">
                                    <div class="row m-t-2">
                                        <div class="col-md-6">
                                            <label>Select Category</label>
                                            <select class="form-control chosen regInputs" data-title="Category" id="category" name="category_id" onchange="getSubCategory(this);">
                                                <option value="">--SELECT CATEGORY--</option>
                                                <?php if ($category_list): foreach ($category_list as $list): ?>
                                                        <option value="<?= $list['category_id']; ?>" <?= set_value('category_id') ? ( $list['category_id'] == set_value('category_id') ? 'selected' : '') : '' ?>><?= $list['name']; ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <p class="errorPrint" id="categoryError"></p>
                                        </div>


                                        <div class="col-md-6">
                                            <label>Select SubCategory</label>
                                            <select class="form-control chosen regInputs" data-title="Sub-Category" id="sub_category" name="sub_category_id" onchange="getMappedBrand(this);">
                                                <?php if ($filter_attr && (isset($filter_attr['sub_category_list']) && $filter_attr['sub_category_list'])): ?>
                                                    <option value="">--SELECT SUB-CATEGORY--</option>
                                                    <?php foreach ($filter_attr['sub_category_list'] as $sub_category):
                                                        ?>
                                                        <option value="<?= $sub_category['sub_category_id'] ?>" data-id="<?= $sub_category['category_id'] ?>"  data-brand="<?= $sub_category['is_brand'] ?>"  data-model="<?= $sub_category['is_model'] ?>" <?= set_value('sub_category_id') ? ( $sub_category['sub_category_id'] == set_value('sub_category_id') ? 'selected' : '') : '' ?>><?= $sub_category['name'] ?></option>
                                                        <?php
                                                    endforeach;
                                                else:
                                                    ?>
                                                    <option value="">--SELECT SUB-CATEGORY--</option>
                                                <?php endif; ?>
                                            </select>
                                            <p class="errorPrint" id="sub_categoryError"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="eventrow">
                                    <div class="row m-t-2">
                                        <div class="col-md-6">
                                            <label>Select Brand</label>
                                            <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                            <select class="form-control chosen regInputs" id="brand" data-title="Brand" name="brand_id" onchange="getbrandModel(this);">
                                                <?php if ($filter_attr && (isset($filter_attr['brand_list']) && $filter_attr['brand_list'])): ?>
                                                    <option value="">--SELECT BRAND--</option>
                                                    <?php foreach ($filter_attr['brand_list'] as $brand):
                                                        ?>
                                                        <option  value="<?= $brand['brand_mapping_id'] ?>" data-id="<?= $brand['brand_id'] ?>" <?= set_value('brand_id') ? ( $brand['brand_mapping_id'] == set_value('brand_id') ? 'selected' : '') : '' ?>><?= $brand['name'] ?></option>
                                                        <?php
                                                    endforeach;
                                                else:
                                                    ?>
                                                    <option value="">--SELECT BRAND--</option>
                                                <?php endif; ?>
                                            </select>
                                            <p class="errorPrint" id="brandError"></p>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Select Model</label>
                                            <select id="model" class="form-control chosen regInputs" name="model_id" data-title="Model">
                                                <?php if ($filter_attr && (isset($filter_attr['model_list']) && $filter_attr['model_list'])): ?>
                                                    <option value="">--SELECT MODEL--</option>
                                                    <?php foreach ($filter_attr['model_list'] as $model):
                                                        ?>
                                                        <option value="<?= $model['model_id'] ?>" data-id="<?= $model['brand_id'] ?>" <?= set_value('model_id') ? ( $model['model_id'] == set_value('model_id') ? 'selected' : '') : '' ?>><?= $model['name'] ?></option>
                                                        <?php
                                                    endforeach;
                                                else:
                                                    ?>
                                                    <option value="">--SELECT MODEL--</option>
                                                <?php endif; ?>
                                            </select>
                                            <p class="errorPrint" id="modelError"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="eventrow">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <button type="submit" name="filterBtn" class="composemail pull-right">Filter Product</button>
                                            <button type="reset" name="resetBtn" onclick="clearForm(this);" class="composemail  pull-right  m-r-2">Clear All</button> 
                                            <button type="button" onclick="exportMultiple(this);" class="composemail pull-right m-r-2" style="">Export Product</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input onchange="selectData(this,'1')" type="checkbox"/></th>          
                                            <th>Image</th>
                                            <th>Type</th>
                                            <th>SKU-ID</th>
                                            <th style="width:120px;">Name</th>
                                            <th>Price (LYD)</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($product_list): foreach ($product_list as $list): ?>
                                                <tr>
                                                <td><input  onchange="selectData(this,'2')" value="<?=$list['product_id'];?>" name="cat_checker" type="checkbox"/></td>
                                                    <!-- <td><a href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>">#<?= $list['product_id']; ?></a></td> -->
                                                    <td><a href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>"><img src="<?= $list['image'] ?>" class="imgesClassTable"></a>
                                                    </td>
                                                    <td><span style="background: red;color: #fff;padding: 3px;border-radius: 6px;"><?php
                                                            if ($list['product_from'] == 2) {
                                                                echo "Dubai";
                                                            } else {
                                                                echo "Inventory";
                                                            }
                                                            ?></span></td>
                                                    <td><?= $list['item_no']; ?></td>
                                                    <td><a href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>" style="color: red;cursor: pointer;"><?= $list['name']; ?></a></td>
                                                    <td><?= number_format(($list['price'] - (($list['price'] * $list['discount']) / 100)), 2); ?>
                                                        <?php if ($list['discount'] > 0): ?>
                                                            <p class="text-muted" style="text-decoration: line-through;"><?= number_format($list['price'], 2); ?> </p>                                    
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $list['quantity']; ?></td>
                                                    <td>
                                                        <?php if ($list['status'] != 0): ?>
                                                            <div class="mytoggle">
                                                                <label class="switch">
                                                                    <input type="checkbox" <?= $list['status'] == 1 ? 'checked' : '' ?> onchange="checkStatus(this, <?= $list['product_id'] ?>);">
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        <?php endif ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('admin/edit-product-detail/' . $list['product_id']); ?>" class="composemail"><i class="fa fa-edit"></i></a>
                                                        <a href="#" onclick="deleteProduct(this, <?= $list['product_id'] ?>);" class="composemail"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card" style="border: 1px solid;"> 
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="card" >
                                        <div class="form-row">
                                            <div class="col-sm-3">
                                                <div class="text-sm-left" style="margin-top: -33px;">
                                                    <button type="button" onclick="deleteMultiple(this,'1');" class="composemail mt-4 pull-right" style="margin-right: 95px;margin-bottom: -10px;cursor:pointer;">Active</button>
                                                </div>
                                            </div> 
                                            <div class="col-sm-3" style="margin-left: -85px;">
                                                <div class="text-sm-left" style="margin-top: -33px;">
                                                    <button type="button" onclick="deleteMultiple(this,'2');" class="composemail mt-4 pull-right" style="margin-right: 77px;margin-bottom: -10px;cursor:pointer;">In-Active</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-3" style="margin-left: -85px;">
                                                <div class="text-sm-left" style="margin-top: -33px;">
                                                    <button type="button" onclick="deleteMultiple(this,'99');" class="composemail mt-4 pull-right" style="margin-right: 77px;margin-bottom: -10px;cursor:pointer;">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-right: 15px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"style="width: 500px;margin-top: 115px;margin-left: 204px;">
                <div class="modal-header" style="padding: 3px;background:#f0553a">
                    <h3 style="color: #fff;">ddfdgr</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="modalData">
                        <div class="col-md-6">
                            <img src="https://www.goinstablog.com/projects/zanomy/uploads/products/1589027528drg5ngddxdd55000d5ds.jpg" class="imgesClass">
                        </div>
                        <div class="col-md-6">
                            <span>VGvghhgvhg</span></br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkStatus(obj, id) {
            var checked = $(obj).is(':checked');
            if (checked == true) {
                var status = 1;
            } else {
                var status = 2;
            }
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Home/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
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
        function deleteProduct(obj, id) {
            var r = confirm("Are you sure to delete?");
            if (r == true) {
                var status = '99';
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/home/ajax",
                        type: 'post',
                        data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
                                // location.reload();
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

        function exportMultiple() {
            $(".errorPrint").css('display', 'none');
            var category = $("#category").val();
            var sub_category = $("#sub_category").val();
            if (category && sub_category) {
                $.ajax({
                    url: "<?= base_url(); ?>/admin/Bulk/export_multiple",
                    type: 'post',
                    data: 'method=exportMultiple&category=' + category + '&sub_category=' + sub_category,
                    success: function (data) {
                        var dt = $.trim(data);
                        //$("#download_ancr").click();
                        // alert(data)if(dt=='error'){
                        if (dt == 'error') {
                            alert("Product not found.")
                        } else {
                            // alert("ssssssssss")
                            window.location.href = '<?= base_url('assets/bulk/creater/update/'); ?>' + dt + '.xls';
                            // $.ajax({
                            //     url: "<?= base_url(); ?>/admin/Bulk/export_multiple",
                            //     type: 'post',
                            //     data: 'method=unlink&data=' + dt,
                            //     success: function (data) {

                            //     }
                            // });
                        }
                    }
                });
            } else {
                if (category) {
                    $("#sub_categoryError").empty();
                    $("#sub_categoryError").append('*Sub-Category is required field');
                    $("#sub_categoryError").css('display', 'block');
                } else {
                    $("#categoryError").empty();
                    $("#categoryError").append('*Category is required field');
                    $("#categoryError").css('display', 'block');
                }
            }
        }

    </script>

    <script>
        function getSubCategory(o) {
            var category = $(o).val();
            $("#brand").empty();
            $("#brand").append('<option value="">--SELECT BRAND--</option>');
            $("#model").empty();
            $("#model").append('<option value="">--SELECT MODEL--</option>');
            $("#product_name").val('');
            $("#product_name").attr('readonly', false);
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
                            $('#sub_category').trigger('chosen:updated');
                        } else {
                            $("#sub_category").empty();
                            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
                            alert(jsonData['message']);
                            $('.chosen').trigger('chosen:updated');
                        }
                    }
                })
            } else {
                $("#sub_category").empty();
                $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
                $('.chosen').trigger('chosen:updated');
            }
        }
        function getMappedBrand(o) {
            $(".errorPrint").css('display', 'none');
            $("#brand").empty();
            $("#brand").append('<option value="">--SELECT BRAND--</option>');
            $("#model").empty();
            $("#model").append('<option value="">--SELECT MODEL--</option>');
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
                                html += '<option value="' + v['brand_id'] + '" data-id="' + v['brand_id'] + '">' + v['name'] + '</option>';
                            });
                        } else {
                            $("#brand").attr('readonly', true);
                            $("#brand").attr('disabled', true);
                            $("#brand").removeClass('regInputs');
                        }
                        $("#brand").append(html);
                        $('#brand').trigger('chosen:updated');
                    }
                });
            } else {
                if (category) {
                    showErrorMessage('filter_sub_categoryError', 'Required Field');
                } else {
                    showErrorMessage('filter_categoryError', 'Required Field');
                }
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
                            $('#model').trigger('chosen:updated');
                        } else {
                            //alert(jsonData['message']);
                            $("#model").attr('readonly', true);
                            $("#model").attr('disabled', true);
                            $("#model").removeClass('regInputs');
                            $('.chosen').trigger('chosen:updated');
                        }
                    }
                })
            } else {
                $("#model").empty();
                $("#model").append('<option value="">--SELECT MODEL--</option>');
                $('.chosen').trigger('chosen:updated');
            }
        }

        function clearForm(obj) {
            $('.chosen').trigger('chosen:updated');
            $('select').val('');
//            $('form').submit();
            window.location.href = window.location.href;
        }
    </script>
    <script>
        function selectData(obj,t){
            var checked = $(obj).is(':checked');
            if(t==1){
                if (checked == true) {
                    $('input[name="cat_checker"]'). prop("checked", true);
                } else {
                    $('input[name="cat_checker"]'). prop("checked", false);
                }
            }
        }

    function deleteMultiple(o,status){
        var createValue="";
        $.each($("input[name='cat_checker']:checked"), function(i,v){
            var vals=$(v).val();
            if(i==0){
                createValue=v['value'];
            }else{
                createValue=createValue+'@'+v['value'];
            }
        });
        if(createValue){
            var r = confirm("Are you sure to delete!");
            if (r == true) {
                $.ajax({
                    url: "<?php echo base_url("/admin/Home/ajax") ?>",
                    type: 'post',
                    data: 'method=deleteMultiple&id=' + createValue + '&type=4&status='+status,
                    success: function (data) {
                        var dt = $.trim(data);
                        //alert(dt);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            }
        }else{
            alert("Please select any one Product.");
        }
    }
    </script>
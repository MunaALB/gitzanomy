<style>
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
    .label-danger{
        padding: 1px 6px 1px 8px;
        border-radius: 20px;
    }

    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Product List</h1>
    </div>
    <div class="content">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="<?= base_url(); ?>vendor/add-new-product" class="composemail pull-right"><i class="fa fa-plus"></i> Add a new product</a>
            </div>
        </div>
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
                            
                                <table id="example4" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>P ID</th>
                                            <th>Image</th>
                                            <th>Category >> Sub category</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <!--<th>Quantity</th>-->
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($product_list):$count = 1;
                                            foreach ($product_list as $list):
                                                ?>
                                                <tr>
                                                    <td><?= $count ?></td>
                                                    <td><a title="view detail" href="<?= base_url('vendor/product-detail/' . $list['product_id']); ?>">#<?= $list['product_id']; ?></a></td>
                                                    <td><img class="imgesClassTable" src="<?= $list['cover_image']; ?>" alt="product image"></td>
                                                    <td><?= $list['category_name']; ?> >> <?= $list['sub_category_name']; ?></td>
                                                    <td><?= $list['name']; ?></td>
                                                    <td><?= number_format(($list['price'] - (($list['price'] * $list['discount']) / 100)), 2); ?> LYD
                                                        <?php if ($list['discount'] > 0): ?>
                                                            <p class="text-muted" style="text-decoration: line-through;"><?= number_format($list['price'], 2); ?> LYD</p>                                    
                                                        <?php endif; ?>
                                                    </td>
                                                    <!--<td><?= $list['quantity']; ?></td>-->
                                                    <td>

                                                        <?php if ($list['status'] == 2): ?>
                                                            <label class="label label-danger">Pending</label>
                                                        <?php elseif ($list['status'] == 3): ?>
                                                            <label class="label label-danger">Rejected</label>
                                                        <?php else: ?>
                                                            <div class="mytoggle">
                                                                <label class="switch">
                                                                    <input type="checkbox" <?= $list['status'] == 1 ? 'checked' : '' ?> onchange="checkStatus(this, <?= $list['product_id'] ?>);">
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('vendor/edit-product-detail/' . $list['product_id']); ?>" class="composemail"><i class="fa fa-edit mb-3"></i></a>
                                                        <a href="#" onclick="deleteProduct(this, <?= $list['product_id'] ?>);" class="composemail"><i class="fa fa-trash mb-3"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $count++;
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
                var status = 0;
            }
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>vendor/Home/ajax",
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
                        url: "<?= base_url(); ?>vendor/home/ajax",
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
        }


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
                    url: "<?php echo base_url("/vendor/Home/ajax") ?>",
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
                    url: "<?php echo base_url("/vendor/Home/ajax") ?>",
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

        function exportMultiple(){
            $(".errorPrint").css('display', 'none');
            var category=$("#category").val();
            var sub_category=$("#sub_category").val();
            if(category && sub_category){
                $.ajax({
                    url: "<?= base_url(); ?>vendor/Bulk/export_multiple",
                    type: 'post',
                    data: 'method=exportMultiple&category='+category+'&sub_category='+sub_category,
                    success: function (data) {
                        var dt = $.trim(data);
                        //$("#download_ancr").click();
                        // alert(data)
                        if(dt=='error'){
                            alert("Product not found.")
                        }else{
                            window.location.href = '<?=base_url('assets/bulk/creater/update/vendor/');?>'+dt+'.xls';
                            $.ajax({
                                url: "<?= base_url(); ?>/vendor/Bulk/export_multiple",
                                type: 'post',
                                data: 'method=unlink&data='+dt,
                                success: function (data) {
                                    // alert(data)
                                }
                            });
                        }
                    }
                });
            }else{
                if(category){
                    $("#sub_categoryError").empty();
                    $("#sub_categoryError").append('*Sub-Category is required field');
                    $("#sub_categoryError").css('display', 'block');
                }else{
                    $("#categoryError").empty();
                    $("#categoryError").append('*Category is required field');
                    $("#categoryError").css('display', 'block');
                }
            }
        }

    </script>
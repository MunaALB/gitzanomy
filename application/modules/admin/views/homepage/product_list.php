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
    .fa_icon{
        background: red;
        color: #fff;
        padding: 1px -11px;
        padding: 5px 8px !important;
        cursor: pointer;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Product List</h1>
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
                                        <div class="col-md-4">
                                            <label>Select Vendor</label>
                                            <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                            <select class="form-control chosen regInputs" id="vendor" data-title="Vendor" name="vendor_id">
                                                <option value="">--SELECT VENDOR--</option>
                                                <option value="0" <?= (set_value('vendor_id') != "" && set_value('vendor_id') == 0) ? 'selected' : '' ?>>Admin only</option>
                                                <?php if ($vendor_list): foreach ($vendor_list as $list): ?>
                                                        <option value="<?= $list['vendor_id']; ?>" <?= set_value('vendor_id') ? ( $list['vendor_id'] == set_value('vendor_id') ? 'selected' : '') : '' ?>><?= $list['name']; ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                            <p class="errorPrint" id="vendorError"></p>
                                        </div>
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
                                            <label>Select SubCategory</label>
                                            <select class="form-control chosen regInputs" data-title="Sub-Category" id="sub_category" name="sub_category_id">
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
                                        <div class="col-md-12 m-t-3">
                                            <!--<div class="form-group">-->

                                            <button type="submit" name="filterBtn"  class="composemail pull-right">Filter Product</button>&nbsp;
                                            <button type="reset" name="resetBtn" onclick="clearForm(this);" class="composemail  pull-right  m-r-2">Clear All</button> 
                                            <!--</div>-->
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive edit-icon">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>SKU-ID</th>
                                            <th style="width:120px;">Name</th>
                                            <th style="width:120px;">Vendor Name</th>
                                            <th>Price (LYD)</th>
                                            <th>Quantity</th>
                                            <?php if ($type == 1): ?>
                                                <th>Set Most Viewed</th>
                                            <?php else: ?>
                                                <th>Set Most Selling</th>
                                            <?php endif; ?>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($product_list): foreach ($product_list as $list): ?>
                                                <tr>
                                                    <!-- <td><a href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>">#<?= $list['product_id']; ?></a></td> -->
                                                    <td><a href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>"><img src="<?= $list['image'] ?>" class="imgesClassTable"></a>
                                                    </td>
                                                    <td><?= $list['item_no']; ?></td>
                                                    <td><a href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>" style="color: red;cursor: pointer;"><?= $list['name']; ?></a></td>
                                                    <td><a href="<?= base_url('admin/vendor-detail/' . $list['vendor_id']); ?>" style="color: red;cursor: pointer;"><?= $list['vendor_name']; ?></a></td>
                                                    <td>
                                                        <?= number_format(($list['price'] - (($list['price'] * $list['discount']) / 100)), 2); ?> LYD
                                                        <?php if ($list['discount'] > 0): ?>
                                                            <p class="text-muted" style="text-decoration: line-through;"><?= number_format($list['price'], 2); ?> LYD</p>                                    
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $list['quantity']; ?></td>
                                                    <td><?php if ($type == 1): ?>
                                                            <!--                                                            <div class="mytoggle">
                                                                                                                            <label class="switch">
                                                                                                                                <input type="checkbox" <?= $list['total_views'] == 1 ? 'checked' : '' ?> onchange="setMostViewed(this, <?= $list['product_id'] ?>);">
                                                                                                                                <span class="slider round"></span>
                                                                                                                            </label>
                                                                                                                        </div>-->
                                                            <select class="form-control" name="total_views" onchange="setMostViewed(this, <?= $list['product_id'] ?>);">
                                                                <option value="0">Set priority</option>
                                                                <?php for ($i = 1, $j = 10; $i <= 10, $j > 0; $i++, $j--): ?>
                                                                    <option value="<?= $j ?>" <?= $list['total_views'] == $j ? 'selected' : '' ?>><?= $i ?></option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        <?php else: ?>
                                                            <!--                                                            <div class="mytoggle">
                                                                                                                            <label class="switch">
                                                                                                                                <input type="checkbox" <?= $list['top_selling'] == 1 ? 'checked' : '' ?> onchange="setMostSelling(this, <?= $list['product_id'] ?>);">
                                                                                                                                <span class="slider round"></span>
                                                                                                                            </label>
                                                                                                                        </div>-->
                                                            <select class="form-control" name="top_selling" onchange="setMostSelling(this, <?= $list['product_id'] ?>);">
                                                                <option value="0">Set priority</option>
                                                                <?php for ($i = 1, $j = 10; $i <= 10, $j > 0; $i++, $j--): ?>
                                                                    <option value="<?= $j ?>" <?= $list['top_selling'] == $j ? 'selected' : '' ?>><?= $i ?></option>
                                                                <?php endfor; ?>
                                                            </select>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url('admin/product-detail/' . $list['product_id']); ?>" class="composemail"><i class="fa fa-eye"></i></a>
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

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setMostViewed(obj, id) {
//            var checked = $(obj).is(':checked');
//            if (checked == true) {
//                var status = 1;
//            } else {
//                var status = 0;
//            }
            var status = $(obj).val();
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Settings/ajax",
                    type: 'post',
                    data: 'method=setMostViewed&id=' + id + '&action=' + status,
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            location.reload();
                        } else {
                            $(obj).val("0");
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
            }
        }
        function setMostSelling(obj, id) {
//            var checked = $(obj).is(':checked');
//            if (checked == true) {
//                var status = 1;
//            } else {
//                var status = 0;
//            }
            var status = $(obj).val();
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Settings/ajax",
                    type: 'post',
                    data: 'method=setMostSelling&id=' + id + '&action=' + status,
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            location.reload();
                        } else {
                            $(obj).val("0");
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
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


        function clearForm(obj) {
            $('.chosen').trigger('chosen:updated');
            $('select').val('');
//            $('form').submit();
            window.location.href = window.location.href;
        }
    </script>
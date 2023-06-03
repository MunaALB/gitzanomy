<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .fa_btn {
        background: #f74f00;
        color: #ffffff !important;
        padding: 4px 6px !important;
        margin-top: 0px;
        border-radius: 30px;
        margin-left: 0px;
    }
    .margin-20{
        margin-top: 20px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1><?php
            if (isset($edit)) {
                echo 'Edit Banner';
            } else {
                echo 'Banner Management';
            }
            ?></h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Banner Management</li>
        </ol>
    </div>

    <div class="content">
        <?= $this->session->flashdata('response'); ?>
        <div class="row">
            <?php if (!isset($edit)) { ?>
                <div class="col-md-12">
                    <div class="card">
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Select Type</label>
                                        <select class="form-control chosen regInputs" required data-title="Type" id="type" name="type" onchange="getType(this);">
                                            <option value="">--SELECT TYPE--</option>
                                            <option value="1">Redirection</option>
                                            <option value="0">Stay On Home</option>
                                        </select>
                                        <p class="errorPrint" id="typeError"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Banner Type</label>
                                        <select class="form-control chosen regInputs" required data-title="Banner Type" id="banner_type" name="banner_type" onchange="getBannerType(this);">
                                            <option value="">--SELECT TYPE--</option>
                                            <option value="1">Application</option>
                                            <option value="2">Website</option>
                                        </select>
                                        <p class="errorPrint" id="banner_typeError"></p>
                                    </div>
                                </div><br/>
                                <div id="bannerDiv">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Select Category</label>
                                            <select class="form-control chosen" data-title="Category" id="category" name="category_id" onchange="getSubCategory(this);">
                                                <option value="">--SELECT CATEGORY--</option>
                                                <?php if($category_list): foreach($category_list as $list): ?>
                                                <option value="<?=$list['category_id'];?>"><?=$list['name'];?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <p class="errorPrint" id="categoryError"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Select SubCategory</label>
                                            <select class="form-control" data-title="Sub-Category" id="sub_category" name="sub_category_id" onchange="getProductData(this);">
                                                <option value="">--SELECT SUB-CATEGORY--</option>
                                            </select>
                                            <p class="errorPrint" id="sub_categoryError"></p>
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Select Product</label>
                                            <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                            <select class="form-control" id="product" data-title="Brand" name="product_id" onchange="checkOffers(this);">
                                                <option value="">--SELECT Product--</option>
                                            </select>
                                            <p class="errorPrint" id="productError"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Offer (in%)</label>
                                            <input type="number" name="offer" id="offer" class="form-control" />
                                            <p class="errorPrint" id="offerError"></p>
                                        </div>
                                    </div><br/>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="banner_images">
                                        <label>Upload Banner Image</label>
                                        <input type="file" onchange="validImage(this, 'input-file-now-custom-1');" id="input-file-now-custom-1" name="image" class="dropify regInputs" data-title="Banner Image" accept="image/*"/> 
                                        <strong style="color: red;font-size: 11px;">*notes (width 1440px height 300px)</strong>
                                        <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button>  
                                        <button type="submit" style="display: none;" name="add_banner" id="submitBtn" class="composemail mt-4 pull-right">Submit</button>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } else { ?>
                <div class="col-md-12">
                    <div class="card">
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Select Type</label>
                                        <select class="form-control" readonly data-title="Type" id="type" name="type" onchange="getType(this);">
                                            <?php if($edit['offer_type']==1): ?>
                                                <option value="1">Redirection</option>
                                            <?php else: ?>
                                                <option value="0">Stay On Home</option>
                                            <?php endif; ?>
                                        </select>
                                        <p class="errorPrint" id="typeError"></p>
                                    </div>
                                </div><br/>
                                <?php if($edit['offer_type']==1): ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Select Category</label>
                                            <select class="form-control chosen regInputs" required data-title="Category" id="category" name="category_id" onchange="getSubCategory(this);">
                                                <option value="">--SELECT CATEGORY--</option>
                                                <?php if($category_list): foreach($category_list as $list): ?>
                                                <option value="<?=$list['category_id'];?>" <?php if($list['category_id']==$edit['category_id']){ echo "selected"; } ?>><?=$list['name'];?></option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                            <p class="errorPrint" id="categoryError"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Select SubCategory</label>
                                            <select class="form-control regInputs" required data-title="Sub-Category" id="sub_category" name="sub_category_id" onchange="getProductData(this);">
                                                <option value="">--SELECT SUB-CATEGORY--</option>
                                                <?php if(isset($edit['sub_category_id']) and $edit['sub_category_id']): ?>
                                                    <option value="<?=$edit['sub_category_id']?>" selected><?=$edit['sub_category_name']?></option>
                                                <?php endif; ?>
                                            </select>
                                            <p class="errorPrint" id="sub_categoryError"></p>
                                        </div>
                                    </div><br/>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Select Product</label>
                                            <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                            <select class="form-control" id="product" data-title="Brand" name="product_id">
                                                <option value="">--SELECT Product--</option>
                                                <?php if(isset($edit['product_id']) and $edit['product_id']): ?>
                                                    <option value="<?=$edit['product_id']?>" selected><?=$edit['product_name']?></option>
                                                <?php endif; ?>
                                            </select>
                                            <p class="errorPrint" id="productError"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Offer (in%)</label>
                                            <input type="number" value="<?=$edit['offer'];?>" name="offer" class="form-control" />
                                            <p class="errorPrint" id="sub_categoryError"></p>
                                        </div>
                                    </div><br/>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-12" id="banner_images">
                                        <?php if($edit['type']==1): ?>
                                            <label>Upload Banner Image</label>';
                                            <input type="file" onchange="validImageApp(this);" id="input-file-now-custom-2" name="image" class="dropify regInputs" data-default-file="<?php echo $edit['image']; ?>" data-title="Banner Image" accept="image/*"/>
                                            <strong style="color: red;font-size: 11px;">*notes (width 900px height 224px)</strong>
                                            <p class="errorPrint" id="input-file-now-custom-2Error"></p>
                                        <?php else: ?>
                                            <label>Upload Banner Image</label>
                                            <input type="file" onchange="validImage(this, 'input-file-now-custom-1');" id="input-file-now-custom-1" name="image" data-default-file="<?php echo $edit['image']; ?>" class="dropify" data-title="Banner Image" accept="image/*"/> 
                                            <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button> 
                                        <button type="submit" style="display: none;" name="update_banner" id="submitBtn" class="composemail mt-4 pull-right">Submit</button>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php } ?>

            <div class="col-md-12 margin-20">
                <div class="card"> 
                    <div class="card-body">

                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Banner Image </th>
                                        <th>Type </th>
                                        <th>Category </th>
                                        <th>Sub-Category </th>
                                        <th>Product </th>
                                        <th>Offer </th>
                                        <th>Status</th> 
                                        <th>Action </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($banner_list as $listing) {
                                        ?>
                                        <tr>
                                            <td><a href="<?= $listing['image'] ?>" title="open" target="_blank"><img class="img-fluid" style="width:120px;height:90px" src="<?= $listing['image'] ?>" alt="banner image"></a></td>
                                            <td><?php if($listing['type']==1){ echo "Application"; }else{ echo "Website"; } ?></td>
                                            <td><?= $listing['category_name'] ?></td>
                                            <td><?= $listing['sub_category_name'] ?></td>
                                            <td><?= $listing['product_name'] ?></td>
                                            <td><?= $listing['offer'] ?>%</td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?php
                                                        if ($listing['status'] == '1'): echo "checked";
                                                        endif;
                                                        ?> onchange="checkStatus(this, '<?= $listing['slider_id']; ?>');">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td> 
                                            <td>
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/banner-management/' . $listing['slider_id']); ?>"><i class="fa fa-edit"></i></a>
                                                <a class="composemail fa_btn" onclick="deleleData(this, '<?= $listing['slider_id']; ?>');"><i class="fa fa-trash-o"></i></a>
                                            </td> 
                                        </tr> 
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }

    function manageDataContent(sc,b,m,a,sp) {
        if(b){
            $("#brand").empty();
            $("#brand").append('<option value="">--SELECT BRAND--</option>');
        }if(m){
            
        }if(sc){
            $("#sub_category").empty();
            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
        }if(a){
           
        }if(sp){
            
        }
    }

    function getSubCategory(o){
        var category=$(o).val();
        if(category){
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: "method=getSubCategory&category_id=" + category,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    
                    $("#sub_category").empty();
                    var html='<option value="">--SELECT SUB-CATEGORY--</option>';
                    if (jsonData['error_code'] == 100) {
                    var jsonData=jsonData['data'];
                    $(jsonData).each(function (i, v) {
                        //alert(v['sub_category_id'])
                            html+='<option value="'+v['sub_category_id']+'" data-id="'+v['category_id']+'"  data-brand="'+v['is_brand']+'"  data-model="'+v['is_model']+'" >'+v['name']+'</option>'; 
                        });
                        $("#sub_category").append(html);
                        manageDataContent(false,true,true,true,true);
                    } else {
                        manageDataContent(true,true,true,true,true);
                    }
                    
                }
            })
        }else{
            manageDataContent(true,true,true,true,true);
        }
    }

    function getProductData(o){
        $(".errorPrint").css('display', 'none');
        manageDataContent(false,true,true,true,true);
        
        var category=$("#category").val();
        var sub_category=$(o).val();
        if(category && sub_category){
            var form_data = new FormData();
            form_data.append("category_id", category);
            form_data.append("sub_category_id", sub_category);
            form_data.append("method", "getMappedProduct");
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
                    $("#product").empty();
                    var html='<option value="">--SELECT PRODUCT--</option>';
                    if (jsonData[0]) {
                        $(jsonData).each(function (i, v) {
                           //alert(v['sub_category_id'])
                            html+='<option value="'+v['product_id']+'">'+v['name']+'</option>'; 
                        });
                        $("#product").attr('readonly',false);
                        $("#product").attr('disabled',false);
                    }else{
                        $("#product").attr('readonly',true);
                        $("#product").attr('disabled',true);
                        $("#product").removeClass('regInputs');
                    }
                    $("#product").append(html);
                }
            })
        }else{
            alert("Error");
        }
    }

    function getType(o){
        var value=$(o).val();
        if(value==1){
            $("#bannerDiv").css('display','block');
            $("#category").addClass('regInputs');
            $("#sub_category").addClass('regInputs');
        }else{
            $("#bannerDiv").css('display','none');
            $("#category").removeClass('regInputs');
            $("#sub_category").removeClass('regInputs');
        }
    }
    function getBannerType(o){
        var value=$(o).val();
        if(value==1){
            var html='<label>Upload Banner Image</label>';
            html+='<input type="file" onchange="validImageApp(this);" id="input-file-now-custom-2" name="image" class="dropify regInputs" data-title="Banner Image" accept="image/*"/>';
            html+='<strong style="color: red;font-size: 11px;">*notes (width 900px height 224px)</strong>';                        
            html+='<p class="errorPrint" id="input-file-now-custom-2Error"></p>';
        }else{
            var html='<label>Upload Banner Image</label>';
            html+='<input type="file" onchange="validImage(this);" id="input-file-now-custom-1" name="image" class="dropify regInputs" data-title="Banner Image" accept="image/*"/>';
            html+='<strong style="color: red;font-size: 11px;">*notes (width 1440px height 300px)</strong>';
            html+='<p class="errorPrint" id="input-file-now-custom-1Error"></p>';
        }
        $("#banner_images").empty();
        $("#banner_images").append(html);
        $('.dropify').dropify();
    }

    function checkOffers(o){
        var value=$(o).val();
        if(value){
            $("#offer").val('');
            $("#offer").attr('readonly',true);
        }else{
            $("#offer").val('');
            $("#offer").attr('readonly',false);
        }
    }
</script>






    <script type="text/javascript">
        function showErrorMessage(id, msg) {
            $("#" + id).empty();
            $("#" + id).append(msg);
            $("#" + id).css('display', 'block');
        }

        function checkStatus(obj, id) {
            var txt;
            var checked = $(obj).is(':checked');
            if (checked == true) {
                var status = 1;
            } else {
                var status = 0;
            }

            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax_method",
                    type: 'post',
                    data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=9',
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
            } else {
                alert("Something Wrong");
                location.reload();
            }
        }

        function deleleData(obj, id) {
            var status = 99;
            if (id) {
                if(confirm("Are You sure want to delete!")){
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=ChangeAttributeStatus&id=' + id + '&action=' + status + '&type=6',
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
            } else {
                alert("Something Wrong");
                location.reload();
            }
        }
    </script>
    <script type="text/javascript">
        function saveData(o) {
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
                $("#submitBtn").click();
            }
        }

        function validImage(obj, i) {
            var _URL = window.URL || window.webkitURL;
            var file = $(':input[type="file"]').prop('files')[0];
            var img = new Image();
            img.onload = function () {
                var wid = this.width;
                var ht = this.height;
                if ((1400 <= wid && wid <= 1500) && (280 <= ht && ht <= 320)) {
                    $(".errorPrint").css('display', 'none');
                    $('#add_product_set').attr('disabled', false);
                    $('#input-file-now-custom-1Error').html('');
                } else {
                    $(".errorPrint").css('display', 'block');
                    $('#add_product_set').attr('disabled', true);
                    showErrorMessage('input-file-now-custom-1Error', 'Preferred Image Dimension 1440X300 pixels');
                }
            };
            img.src = _URL.createObjectURL(file);
        }
        function validImageApp(obj, i) {
            var _URL = window.URL || window.webkitURL;
            var file = $(':input[type="file"]').prop('files')[0];
            var img = new Image();
            img.onload = function () {
                var wid = this.width;
                var ht = this.height;
                if ((800 <= wid && wid <= 1000) && (200 <= ht && ht <= 300)) {
                    $(".errorPrint").css('display', 'none');
                    $('#add_product_set').attr('disabled', false);
                    $('#input-file-now-custom-2Error').html('');
                } else {
                    $(".errorPrint").css('display', 'block');
                    $('#add_product_set').attr('disabled', true);
                    showErrorMessage('input-file-now-custom-2Error', 'Preferred Image Dimension 900X224 pixels');
                }
            };
            img.src = _URL.createObjectURL(file);
        }

    </script>  

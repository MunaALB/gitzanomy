 
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
        <h1>Product Sub-Category Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url('admin');?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Product Sub-Category Management</li>
        </ol>
    </div>
    <?=$this->session->flashdata('response');?>
    <div class="content">
        <div class="row">
            <?php if(!isset($edit)) { ?>
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label>Select Category</label>
                                        <select class="form-control chosen regInputs" data-title="Category" id="category" name="category">
                                            <option value="">Select Categories</option>
                                            <?php foreach ($category_list as $row) { ?>
                                            <option value="<?= $row['category_id'] ?>"><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <p class="errorPrint" id="categoryError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Sub-Category Name(In English)</label>
                                        <input type="text" class="form-control mb-4 regInputs" data-title="Sub-Category Name(Ar)" id="english" name="english" placeholder="Sub-Category Name">
                                        <p class="errorPrint" id="englishError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Sub-Category Name(In Arabic)</label>
                                        <input type="text" class="form-control mb-4 regInputs" data-title="Sub-Category Name(Ar)" id="arabic" name="arabic" placeholder="Sub-Category Name">
                                        <p class="errorPrint" id="arabicError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Commission (%)</label>
                                        <input type="text" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " min="0" max="100" class="form-control mb-4 regInputs" data-title="Commission" id="commission" name="commission" placeholder="Commission (%)">
                                        <p class="errorPrint" id="commissionError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="validationCustom01">Sub-Category Image</label>
                                        <input type="file" onchange="validImage(this,'input-file-now-custom-1','1');" id="input-file-now-custom-1" class="dropify regInputs" data-title="Sub-Category Image" name="image"  accept="image/*"/>  
                                        <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                    </div>
                                    <div class="col-md-12" style="margin-top: 31px;">
                                        <label for="validationCustom01">Sub-Category Banner</label>
                                        <input type="file" onchange="validImage(this,'input-file-now-custom-2','2');" id="input-file-now-custom-2" class="dropify regInputs" data-title="Banner Image" name="bannerImage"  accept="image/*" />
                                        <p class="errorPrint" id="input-file-now-custom-2Error"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01">Is Brand</label>
                                        <div class="mytoggle">
                                            <label class="switch">
                                                <input type="checkbox" value="1" checked name="is_brand">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="validationCustom01">Is Model</label>
                                        <div class="mytoggle">
                                            <label class="switch">
                                                <input type="checkbox" value="1" checked  name="is_model">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)">Submit</button>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } else { ?>
                <div class="col-md-6">
                    <div class="card">
                        <form method="POST" id="regForm" enctype="multipart/form-data">
                            <div class="card-body"> 
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label>Select Category</label>
                                        <select class="form-control regInputs" id="category" name="category" data-title="Category">
                                                <?php foreach ($category_list as $row) { 
                                                    if($row['category_id']==$edit['category_id']): ?>
                                                        <option value="<?= $row['category_id'] ?>" selected><?php echo $row['name']; ?></option>
                                                    <?php endif; } ?>
                                        </select>
                                        <p class="errorPrint" id="categoryError"></p>
                                    </div>
                                    <div class="col-md-12">
                                            <label>Sub-Category Name(In English)</label>
                                            <input type="text" class="form-control mb-4 regInputs" data-title="Sub-Category Name(En)" id="english" name="english" value="<?= $edit['name']?>" placeholder="Sub-Category Name">
                                            <p class="errorPrint" id="englishError"></p>
                                        </div>
                                    <div class="col-md-12">
                                        <label>Sub-Category Name(In Arabic)</label>
                                        <input type="text" class="form-control mb-4 regInputs" data-title="Sub-Category Name(Ar)" id="arabic" name="arabic" value="<?= $edit['name_ar']?>" placeholder="Sub-Category Name">
                                        <p class="errorPrint" id="arabicError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Commission (%)</label>
                                        <input type="text" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " value="<?= $edit['commission']?>" min="0" max="100" class="form-control mb-4 regInputs" data-title="Commission" id="commission" name="commission" placeholder="Commission (%)">
                                        <p class="errorPrint" id="commissionError"></p>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="validationCustom01">Sub-Category Image</label>
                                        <input type="file" onchange="validImage(this,'input-file-now-custom-1','1');" id="input-file-now-custom-1" class="dropify" data-title="Image" name="image_update" value="<?php echo $edit['image']; ?>" data-default-file="<?php echo $edit['image'];?>" accept="image/*"/>
                                        <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                    </div> 
                                    <div class="col-md-12">
                                        <label for="validationCustom01">Sub-Category Banner</label>
                                        <input type="file" onchange="validImage(this,'input-file-now-custom-2','2');" id="input-file-now-custom-2" value="<?php echo $edit['banner']; ?>" data-default-file="<?php echo $edit['banner'];?>" class="dropify" data-title="Banner Image" name="bannerImage"  accept="image/*" />
                                        <p class="errorPrint" id="input-file-now-custom-2Error"></p>
                                        <button type="button" onclick="saveData(this);" id="add_product_set" class="composemail mt-4 pull-right">Update</button>  
                                        <a href="<?=base_url('admin/subcategory-list');?>" class="composemail mt-4 pull-right" style="margin-right: 3px;">Cancel</a>  
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php } ?>

                <div class="col-md-6">
                    <div class="card">
                        <form method="post" action="<?=base_url('admin/bulk-subcategory-list');?>" enctype="multipart/form-data">
                            <div class="col-md-12 mb-4">
                                <label>Select Category</label>
                                <select class="form-control" required data-title="Category" id="category" name="bulk_category">
                                    <option value="">Select Categories</option>
                                    <?php foreach ($category_list as $row) { ?>
                                    <option value="<?= $row['category_id'] ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="control-label">Select Excel File</label>
                                <input type="file" name="products" accept=".xls, .xlsx" required class="form-control">
                            </div>
                            <div class="form-row">
                                <div class="col-sm-6">
                                    <div class="text-sm-left" style="margin-top: -26px;">
                                        <button class="composemail mt-4 pull-right" style="margin-right: 106px;margin-bottom: 15px;cursor:pointer;" type="submit" name="bulk_upload">Upload</button>
                                    </div>
                                </div> 
                                
                                <div class="col-sm-6">
                                    <div class="text-sm-left">
                                        <a href="<?=base_url('assets/bulk/sub_category.xls');?>" download style="color: red;margin-left: 83px;">Download Format</a>
                                    </div>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-12 margin-20">
                    <div class="card"> 
                        <div class="card-body">
                            <form method="post" id="submitFormCategory">
                                <div class="row mb-4">
                                    <div class="col-md-12 mb-2">
                                        <label>Select Category</label>
                                        <select class="form-control chosen" name="Category" onchange="filter();">
                                            <option selected disabled>Select Categories</option>
                                                <?php foreach ($category_list as $row) { ?>
                                                    <option value="<?= $row['category_id'] ?>" <?php echo set_select('Category', $row['category_id'], False); ?>><?php echo $row['name']; ?></option>
                                                <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive table-image">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Banner</th> 
                                            <th>Sub-Category Name(In English)</th>
                                            <th>Sub-Category Name(In Arabic)</th>
                                            <th>Commission</th>
                                            <th>Show On Home</th> 
                                            <th>Status</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($sub_category_list as $listing) { ?>
                                            <tr>
                                                <td><img src="<?php echo $listing['image'];?>"></td>
                                                <td><img src="<?php echo $listing['banner'];?>"></td>
                                                <td><?= $listing['name'];?></td>
                                                <td><?= $listing['name_ar'];?></td>
                                                <td><?= $listing['commission'];?></td>
                                                <td>
                                                <div class="mytoggle">
                                                <label class="switch">
                                                <input type="checkbox" <?php
                                                    if ($listing['home'] == '1'): echo "checked";
                                                    endif;?> onchange="showOnHome(this,'<?= $listing['sub_category_id']; ?>');">
                                                <span class="slider round"></span>
                                                </label>
                                            </div>
                                            </td> 
                                            <td>
                                            <div class="mytoggle">
                                                <label class="switch">
                                                <input type="checkbox" <?php
                                                    if ($listing['status'] == '1'): echo "checked";
                                                    endif;?> onchange="checkStatus_user(this,'<?= $listing['sub_category_id']; ?>');">
                                                <span class="slider round"></span>
                                                </label>
                                            </div>
                                            </td> 
                                            <td>
                                                <a class="composemail fa_btn" href="<?php echo site_url('admin/subcategory-list/'.$listing['sub_category_id']);?>"><i class="fa fa-edit"></i></a>
                                                <a class="composemail fa_btn" onclick="deleleSubCategory(this,'<?= $listing['sub_category_id']; ?>');"><i class="fa fa-trash-o"></i></a>
                                            </td> 
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }

</script>
<script type="text/javascript">
    function checkStatus_user(obj, id) {
        var txt ;
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 0;
        }
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=subCategoryStatus&id=' + id + '&action=' + status,
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
    function showOnHome(obj, id) {
        var txt ;
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 0;
        }
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=showOnHome&id=' + id + '&action=' + status,
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
    function deleleSubCategory(obj, id) {
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            if (id) {
                status='99';
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=subCategoryStatus&id=' + id + '&action=' + status,
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
    }
</script> 


<script type="text/javascript">
    function saveData(o){
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
            $("#regForm").submit();
        }
    }
    
    function validImage(obj,i,t) {
        var _URL = window.URL || window.webkitURL;
        // var file = $(':input[type="file"]').prop('files')[0];
        var file = $(obj).prop('files')[0];
        var img = new Image();
        img.onload = function () {
            var wid = this.width;
            var ht = this.height;
            //alert(wid+'&'+ht);
            //if ((wid < 450 || wid > 500) || ht !== 500) {
            if(t==1){
                if ((wid!==250) || ht !== 250) {
                    $(".errorPrint").css('display', 'none');
                    $('#add_product_set').attr('disabled',true);
                    showErrorMessage(i+'Error','Preferred Image Dimension 250X250 pixels');
                } else {
                    $('#add_product_set').attr('disabled',false);
                    $('#'+i+'Error').html('');
                }
            }else{
                if ((wid!==1350) || ht !== 300) {
                    $(".errorPrint").css('display', 'none');
                    $('#add_product_set').attr('disabled',true);
                    showErrorMessage(i+'Error','Preferred Image Dimension 1350X300 pixels');
                } else {
                    $('#add_product_set').attr('disabled',false);
                    $('#'+i+'Error').html('');
                }
            }
        };
        //console.log('img.src',_URL.createObjectURL(file));
        img.src = _URL.createObjectURL(file);
    }

    function filter(){
        $("#submitFormCategory").submit();
    }

</script>  
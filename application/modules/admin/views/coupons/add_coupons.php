<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
        margin-top: 25px;
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
    .borderDiv{
        border-top: 1px solid #cac3c3;
        /* border-bottom: 1px solid #cac3c3; */
        padding: 12px;
        margin: -3px 1px 16px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Coupon Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url('admin');?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Coupon Management</li>
        </ol>
    </div>
    <?=$this->session->flashdata('response');?>
    <div class="content">
        <div class="row">
            <?php if(!isset($edit)) { ?>
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" id="regForm" enctype="multipart/form-data">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Coupon Privacy</label>
                                    <select class="form-control regInputs" required data-title="Coupon Privacy" id="coupon_privacy" name="coupon_privacy">
                                        <option selected="" disabled value="">Coupon Privacy</option>
                                        <option value="1">Public</option>
                                        <option value="2">Private</option>
                                    </select>
                                    <p class="errorPrint" id="coupon_privacyError"></p>
                                </div>
                                
                                <div class="col-md-4">
                                    <label>Coupon Code</label>
                                    <input type="text" id="code" class="form-control mb-4 regInputs" name="code" placeholder="Coupon Code">
                                    <p class="errorPrint" id="codeError"></p>
                                </div>

                                <div class="col-md-4">
                                    <label>Coupon Type</label>
                                    <select class="form-control regInputs" onchange="couponType(this);" required data-title="Category" id="type" name="type">
                                        <option value="">Coupon Type</option>
                                        <option value="1">In %</option>
                                        <option value="2">In Currency</option>
                                        <option value="3">Free Devlivery Fee</option>
                                    </select>
                                    <p class="errorPrint" id="typeError"></p>
                                </div>

                                <div class="col-md-4">
                                    <label>Coupon Discount</label>
                                    <input type="text" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " id="discount" class="form-control mb-4 regInputs" name="discount" placeholder="Coupon Discount">
                                    <p class="errorPrint" id="discountError"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Minumum Purchase</label>
                                    <input type="text" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " id="min_purchase" class="form-control mb-4 regInputs" name="min_purchase" placeholder="Minumum Purchase">
                                    <p class="errorPrint" id="min_purchaseError"></p>
                                </div>

                                <div class="col-md-4">
                                    <label>Total Uses</label>
                                    <input type="text" id="total_uses" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " class="form-control mb-4 regInputs" name="total_uses" placeholder="Total Uses">
                                    <p class="errorPrint" id="total_usesError"></p>
                                </div>
                                
                                <div class="col-md-4">
                                    <label>Single Uses</label>
                                    <input type="text" id="single_uses" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " class="form-control mb-4 regInputs" name="single_uses" placeholder="Single Uses">
                                    <p class="errorPrint" id="single_usesError"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Start Date</label>
                                    <input type="date" id="start_date" class="form-control mb-4 regInputs" name="start_date" placeholder="Start Date">
                                    <p class="errorPrint" id="start_dateError"></p>
                                </div>
                                <div class="col-md-4">
                                    <label>End Date</label>
                                    <input type="date" id="end_date" class="form-control mb-4 regInputs" name="end_date" placeholder="End Date">
                                    <p class="errorPrint" id="end_dateError"></p>
                                </div>

                                <div class="col-md-4">
                                    <label>Applied On</label>
                                    <select class="form-control regInputs" onchange="appliedOn(this);" required data-title="Category" id="applied_on" name="type">
                                        <option value="">Applied On</option>
                                        <option value="1">Category</option>
                                        <option value="2">Sub-Category</option>
                                        <option value="3">Brand</option>
                                        <option value="4">Model</option>
                                    </select>
                                    <p class="errorPrint" id="applied_onError"></p>
                                </div>
                            </div>
                            <div class="borderDiv">
                                <div class="row" id="dynamicDiv" style="margin-bottom: 43px;" >
                                    <div class="col-md-6" id="categoryDiv" style="display:none;">
                                        <label>Select Category</label>
                                        <select class="form-control " data-title="Category" id="category" name="category_id" onchange="getSubCategory(this);">
                                            <option value="">--SELECT CATEGORY--</option>
                                            <?php if($category_list): foreach($category_list as $list): ?>
                                            <option value="<?=$list['category_id'];?>"><?=$list['name'];?></option>
                                            <?php endforeach; endif; ?>
                                        </select>
                                        <p class="errorPrint" id="categoryError"></p>
                                    </div>
                                    <div class="col-md-6" id="subCategoryDiv" style="display:none;">
                                        <label>Select SubCategory</label>
                                        <select class="form-control" data-title="Sub-Category" id="sub_category" name="sub_category_id" onchange="getMappedBrand(this);">
                                            <option value="">--SELECT SUB-CATEGORY--</option>
                                        </select>
                                        <p class="errorPrint" id="sub_categoryError"></p>
                                    </div>
                                    <div class="col-md-6" id="brandDiv" style="margin-top: 40px;display:none;">
                                        <label>Select Brand</label>
                                        <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                        <select class="form-control" id="brand" data-title="Brand" name="brand_id" onchange="getbrandModel(this);">
                                            <option value="">--SELECT BRAND--</option>
                                        </select>
                                        <p class="errorPrint" id="brandError"></p>
                                    </div>
                                    <div class="col-md-6" id="modelDiv" style="margin-top: 40px;display:none;">
                                        <label>Select Modal</label>
                                        <select id="model" class="form-control" name="model_id" onchange="setProductName(this);" data-title="Model">
                                            <option value="">--SELECT MODEL--</option>
                                        </select>
                                        <p class="errorPrint" id="modelError"></p>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Description</label>
                                    <textarea  id="description" style="height: 130px;" name="description" class="form-control regInputs" placeholder="Description"></textarea>
                                    <p class="errorPrint" id="descriptionError"></p>
                                </div>
                            </div></br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Description (Ar)</label>
                                    <textarea  id="description_ar" style="height: 130px;" name="description_ar" class="form-control regInputs" placeholder="Description (Ar)"></textarea>
                                    <p class="errorPrint" id="description_arError"></p>
                                   <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="saveData(this)" style="cursor:pointer;">Submit</button>  
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
                                <div class="col-md-12">
                                    <label>Category Name(In English)</label>
                                    <input type="text" class="form-control mb-4 regInputs" id="english" name="english" value="<?= $edit['name']?>" placeholder="Category Name" data-warning="errorWarning1">
                                    <?= form_error('english') ?>
                                    <p class="errorPrint" id="englishError"></p>
                                </div>
                                <div class="col-md-12">
                                    <label>Category Name(In Arabic)</label>
                                    <input type="text" class="form-control mb-4 regInputs" id="arabic" name="arabic" value="<?= $edit['name_ar']?>" placeholder="Category Name" data-warning="errorWarning2">
                                    <?= form_error('arabic') ?>
                                    <p class="errorPrint" id="arabicError"></p>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationCustom01">Category Image</label>
                                    <input type="file" onchange="validImage(this,'input-file-now-custom-1');" id="input-file-now-custom-1" data-title="Image" value="<?php echo $edit['image']; ?>" name="image_update" data-default-file="<?php echo $edit['image'];?>" class="dropify" accept="image/*"/> 
                                    <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                    <button type="button" id="add_product_set" class="composemail mt-4 pull-right" data-count="1" onclick="saveData(this, 1)">Update</button>  
                                    <a href="<?=base_url('admin/category-list');?>" class="composemail mt-4 pull-right" style="margin-right: 3px;">Cancel</a>  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php } ?>

            <!-- <div class="col-md-6">
                <div class="card">
                    <form method="post" action="<?=base_url('admin/bulk-category-list');?>" enctype="multipart/form-data">
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
                                    <a href="<?=base_url('assets/bulk/category.xls');?>" download style="color: red;margin-left: 83px;">Download Format</a>
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>
            </div> -->

            
        </div>
    </div>
<script type="text/javascript">
    function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }

    
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
                data: 'method=checkStatus&id=' + id + '&action=' + status,
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

    function deleleCategory(obj, id) {
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            if (id) {
                status='99';
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=checkStatus&id=' + id + '&action=' + status,
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

    function manageDataContent(sc,b,m,a,sp) {
        if(b){
            $("#brand").empty();
            $("#brand").append('<option value="">--SELECT BRAND--</option>');
        }if(m){
            $("#model").empty();
            $("#model").append('<option value="">--SELECT MODEL--</option>');
            $("#product_name").val('');
            $("#product_name").attr('readonly',false);
        }if(sc){
            $("#sub_category").empty();
            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
        }if(a){
            $("#productAttributeData").empty();
            $("#productAttribute").css('display','none');
            // $("#productFeatuers").css('display','none');
            // $("#productFeatuersData").css('display','none');
        }if(sp){
            $("#productSpecificationData").empty();
            $("#productSpecification").css('display','none');
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

    function getMappedBrand(o){
        $(".errorPrint").css('display', 'none');
        manageDataContent(false,true,true,true,true);
        
        var category=$("#category").val();
        var sub_category=$(o).val();
        if(category && sub_category){
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
                    var mappedArr=jsonData['mappedArr'];
                    
                    $("#brand").empty();
                    var html='<option value="">--SELECT BRAND--</option>';
                    if (mappedArr[0]) {
                        $(mappedArr).each(function (i, v) {
                           //alert(v['sub_category_id'])
                            html+='<option value="'+v['brand_mapping_id']+'" data-id="'+v['brand_id']+'">'+v['name']+'</option>'; 
                        });
                    }
                    $("#brand").append(html);
                }
            })
        }else{
            alert("Error");
        }
    }

    function getbrandModel(o){
        var id=$(o).val();
        $("#model").empty();
        $("#model").append('<option value="">--SELECT MODEL--</option>');
        $("#product_name").val('');
        $("#product_name").attr('readonly',false);
        if(id){
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: "method=getMappedBrandModel&brand_mapping_id=" + id,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 100) {
                       $("#model").empty();
                       var jsonData=jsonData['data'];
                       var html='<option value="">--SELECT MODEL--</option>';
                       $(jsonData).each(function (i, v) {
                           //alert(v['sub_category_id'])
                            html+='<option value="'+v['model_id']+'" data-id="'+v['brand_id']+'">'+v['name']+'</option>'; 
                        });
                        $("#model").append(html);
                    } else {
                        //alert(jsonData['message']);
                        $("#model").attr('readonly',true);
                        $("#model").attr('disabled',true);
                        $("#model").removeClass('regInputs');
                    }
                }
            })
        }else{
            $("#model").empty();
            $("#model").append('<option value="">--SELECT MODEL--</option>');
        }
    }

    function couponType(o){
        var value=$(o).val();
        if(value==1){
            $("#min_purchase").val('');
            $("#min_purchase").removeClass('regInputs');
            $("#min_purchase").attr('disabled',true);

            $("#discount").val('');
            $("#discount").addClass('regInputs');
            $("#discount").attr('disabled',false);

            $("#applied_on").val('');
            $("#applied_on").addClass('regInputs');
            $("#applied_on").attr('disabled',false);
        }
        if(value==2){
            $("#min_purchase").val('');
            $("#min_purchase").addClass('regInputs');
            $("#min_purchase").attr('disabled',false);

            $("#discount").val('');
            $("#discount").addClass('regInputs');
            $("#discount").attr('disabled',false);

            $("#applied_on").val('');
            $("#applied_on").removeClass('regInputs');
            $("#applied_on").attr('disabled',true);
            
            $("#categoryDiv").css('display','none');
            $("#category").removeClass('regInputs');
            $("#subCategoryDiv").css('display','none');
            $("#sub_category").removeClass('regInputs');
            $("#brandDiv").css('display','none');
            $("#brand").removeClass('regInputs');
            $("#modelDiv").css('display','none');
            $("#model").removeClass('regInputs');

        }
        if(value==3){
            $("#min_purchase").val('');
            $("#min_purchase").removeClass('regInputs');
            $("#min_purchase").attr('disabled',true);

            $("#discount").val('');
            $("#discount").removeClass('regInputs');
            $("#discount").attr('disabled',true);

            $("#applied_on").val('');
            $("#applied_on").removeClass('regInputs');
            $("#applied_on").attr('disabled',true);

            $("#categoryDiv").css('display','none');
            $("#category").removeClass('regInputs');
            $("#subCategoryDiv").css('display','none');
            $("#sub_category").removeClass('regInputs');
            $("#brandDiv").css('display','none');
            $("#brand").removeClass('regInputs');
            $("#modelDiv").css('display','none');
            $("#model").removeClass('regInputs');
        }
    }

    function appliedOn(o){
        var value=$(o).val();
        if(value==1){
            $("#categoryDiv").css('display','block');
            $("#category").removeClass('regInputs');
            $("#subCategoryDiv").css('display','none');
            $("#sub_category").removeClass('regInputs');
            $("#brandDiv").css('display','none');
            $("#brand").removeClass('regInputs');
            $("#modelDiv").css('display','none');
            $("#model").removeClass('regInputs');
        }
        if(value==2){
            $("#categoryDiv").css('display','block');
            $("#category").addClass('regInputs');
            $("#subCategoryDiv").css('display','block');
            $("#sub_category").removeClass('regInputs');
            $("#brandDiv").css('display','none');
            $("#brand").removeClass('regInputs');
            $("#modelDiv").css('display','none');
            $("#model").removeClass('regInputs');
        }if(value==3){
            $("#categoryDiv").css('display','block');
            $("#category").addClass('regInputs');
            $("#subCategoryDiv").css('display','block');
            $("#sub_category").addClass('regInputs');
            $("#brandDiv").css('display','block');
            $("#brand").removeClass('regInputs');
            $("#modelDiv").css('display','none');
            $("#model").removeClass('regInputs');
        }if(value==4){
            $("#categoryDiv").css('display','block');
            $("#category").addClass('regInputs');
            $("#subCategoryDiv").css('display','block');
            $("#sub_category").addClass('regInputs');
            $("#brandDiv").css('display','block');
            $("#brand").addClass('regInputs');
            $("#modelDiv").css('display','block');
            $("#model").removeClass('regInputs');
        }
        // $('#category').trigger('chosen:updated');
        // $('.chosen').trigger('chosen:updated');
    }

    function saveData(o){
        
        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($.trim($(this).val())) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                var textData=$(this).parent().find('label').text();
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + textData + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
        var type=$("#type").val();
        var discount=parseInt($("#discount").val());
        var min_purchase=parseInt($("#min_purchase").val());
        if(type==1){
            if(discount>=100){
                idValidate = true;
                showErrorMessage('discountError','Discount should be less than 100 %.');
            }
        }else if(type==2){
            if(min_purchase<=discount){
                //alert(min_purchase+'<='+discount)
                idValidate = true;
                showErrorMessage('min_purchaseError','Min Purchase should be greated than Discount.');
            }
        }else{

        }

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;

        var sdate=$("#start_date").val();
        var edate=$("#end_date").val();
        if(today>=sdate){
            idValidate = true;
            showErrorMessage('start_dateError','Start date should be greater than Present date.');
        }

        if(sdate>=edate){
            idValidate = true;
            showErrorMessage('end_dateError','End date should be greater than Start date.');
        }
        if (idValidate) {
            return false;
        } else {
            // $("#regForm").submit();
            if($("#category").val()=='' || $("#category").val()==undefined){
                var categoryId=0;
            }else{
                var categoryId=$("#category").val();
            }
            //alert($("#sub_category").val());
            if($("#sub_category").val()=='' || $("#sub_category").val()==undefined){
                var sub_category_id=0;
            }else{
                var sub_category_id=$("#sub_category").val();
            }
            //alert(sub_category_id)
            if($("#brand").val()=='' || $("#brand").val()==undefined){
                var brand_id=0;
            }else{
                var brand_id=$("#brand").val();
            }
            if($("#model").val()=='' || $("#model").val()==undefined){
                var model_id=0;
            }else{
                var model_id=$("#model").val();
            }
                
                var reg_form_data = new FormData();
                reg_form_data.append("coupon_privacy",$("#coupon_privacy").val());
                reg_form_data.append("code",$("#code").val());
                reg_form_data.append("type",$("#type").val());
                reg_form_data.append("discount",$("#discount").val());
                reg_form_data.append("min_purchase",$("#min_purchase").val());
                reg_form_data.append("total_uses",$("#total_uses").val());
                reg_form_data.append("single_uses",$("#single_uses").val());
                reg_form_data.append("start_date",$("#start_date").val());
                reg_form_data.append("end_date",$("#end_date").val());
                reg_form_data.append("applied_on",$("#applied_on").val());
                reg_form_data.append("category_id",categoryId);
                reg_form_data.append("sub_category_id",sub_category_id);
                reg_form_data.append("brand_id",brand_id);
                reg_form_data.append("model_id",model_id);
                reg_form_data.append("description",$("#description").val());
                reg_form_data.append("description_ar",$("#description_ar").val());
                reg_form_data.append("method","add_coupon");
                // alert("ssss")
                $.ajax({
                    url: "<?php echo base_url("/admin/Home/ajax") ?>",
                    type: "POST",
                    data: reg_form_data,
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
    
    function validImage(obj,i) {
        var _URL = window.URL || window.webkitURL;
        var file = $(':input[type="file"]').prop('files')[0];
        var img = new Image();
        img.onload = function () {
            var wid = this.width;
            var ht = this.height;
            //alert(wid+'&'+ht);
            //if ((wid < 450 || wid > 500) || ht !== 500) {
            if ((wid!==250) || ht !== 250) {
                $(".errorPrint").css('display', 'none');
                $('#add_product_set').attr('disabled',true);
                showErrorMessage(i+'Error','Preferred Image Dimension 250X250 pixels');
            } else {
                $('#add_product_set').attr('disabled',false);
                $('#'+i+'Error').html('');
            }
        };
        img.src = _URL.createObjectURL(file);
    }

</script>  
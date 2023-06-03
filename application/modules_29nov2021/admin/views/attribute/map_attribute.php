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
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Attribute Mapping</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Attribute Mapping</li>
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
                                <select class="form-control chosen regInputs" data-title="Category" id="category" onchange="getSubCategory(this,1);">
                                    <option value="">--SELECT CATEGORY--</option>
                                    <?php if($category_list): foreach($category_list as $list): ?>
                                    <option value="<?=$list['category_id'];?>"><?=$list['name'];?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <p class="errorPrint" id="categoryError"></p>
                            </div>
                            <div class="col-md-12 mt-4">
                                <label>Select Sub-Category</label>
                                <!---<select class="form-control chosen" id="sub_category" >-->
                                <select class="form-control regInputs" data-title="Sub-Category" id="sub_category">
                                    <option value="">--SELECT SUB-CATEGORY--</option>
                                </select>
                                <p class="errorPrint" id="sub_categoryError"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="form-group">
                                    <label>Select Attribute</label>
                                    <!-- <select class="form-control chosen regInputs" id="attribute" data-title="Attribute" onchange="getAttributeValue(this);"> -->
                                    <select class="form-control chosen regInputs" id="attribute" data-title="Attribute">
                                    <option value="">--SELECT ATTRIBUTES--</option>
                                    <?php if($attribute): foreach($attribute as $list): ?>
                                    <option value="<?=$list['attribute_id'];?>"><?=$list['name'];?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <p class="errorPrint" id="attributeError"></p>
                                </div>
                            </div>
                            <!-- <div class="col-md-12">
                                <div class="form-group map-attribute-btn">
                                    <label>Select Model</label>
                                    <select id="attrVal" class="form-control regInputs" data-title="Model">
                                        <option value="">--SELECT MODEL--</option>
                                    </select>
                                    <p class="errorPrint" id="attrValError"></p>
                                </div>
                            </div> -->
                            <div class="col-md-12">
                                <div class="form-group map-attribute-btn">
                                    <label>Select Type</label>
                                    <select id="type" class="form-control regInputs" onchange="getTypeData(this);" data-title="Type">
                                        <option value="" disabled selected>--SELECT TYPE--</option>
                                        <option value="1">Attribute</option>
                                        <option value="2">Specification</option>
                                    </select>
                                    <p class="errorPrint" id="typeError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="requiredData" style="display:none;">
                            <div class="col-md-6 mt-4">
                                <label>Is Filter</label>
                                <div class="mytoggle">
                                    <label class="switch">
                                        <input type="checkbox" id="is_filter" checked="">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-4">
                                <label>Is Required</label>
                               <div class="mytoggle">
                                    <label class="switch">
                                        <input type="checkbox" id="is_required" checked="">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" onclick="addAttrVal(this);" class="composemail mt-4 pull-right">Submit</button>
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
                                <select class="form-control chosen" id="filter_category" onchange="getSubCategory(this,2);">
                                    <option value="">--SELECT CATEGORY--</option>
                                    <?php if($category_list): foreach($category_list as $list): ?>
                                    <option value="<?=$list['category_id'];?>"><?=$list['name'];?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <p class="errorPrint" id="filter_categoryError"></p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label> Sub-Category</label>
                                <!-- <select class="form-control chosen"> -->
                                <select class="form-control" data-title="Sub-Category" id="filter_sub_category" onchange="getMappedAttributes(this);">
                                    <option value="">--SELECT SUB-CATEGORY--</option>
                                </select>
                                <p class="errorPrint" id="filter_sub_categoryError"></p>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label>Attribute</label>
                                <!-- <select class="form-control chosen"> -->
                                <select class="form-control" id="filter_brand" onchange="getMappedAttributeValue(this);">
                                <option value="">--SELECT Attribute--</option>
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
                                <div class="form-group" id="mappedModels">
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
function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }

    function manageDataContent(sc,sc2,a,av) {
        if(sc){
            $("#sub_category").empty();
            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
        }if(sc2){
            $("#filter_sub_category").empty();
            $("#filter_sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
        }if(a){
            $("#filter_brand").empty();
            $("#filter_brand").append('<option value="">--SELECT Attribute--</option>');
        }if(av){
            $("#mappedModels").empty();
        }
    }

    function getSubCategory(o,t){
        var category=$(o).val();
        if(category){
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: "method=getSubCategory&category_id=" + category,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if(t==1){
                        $("#sub_category").empty();
                        var html='<option value="">--SELECT SUB-CATEGORY--</option>';
                        if (jsonData['error_code'] == 100) {
                        var jsonData=jsonData['data'];
                        $(jsonData).each(function (i, v) {
                            //alert(v['sub_category_id'])
                                html+='<option value="'+v['sub_category_id']+'" data-id="'+v['category_id']+'">'+v['name']+'</option>'; 
                            });
                            $("#sub_category").append(html);
                        } else {
                            $("#sub_category").empty();
                            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
                            // alert(jsonData['message']);
                        }
                    }else{
                        $("#filter_sub_category").empty();
                        var html='<option value="">--SELECT SUB-CATEGORY--</option>';
                        if (jsonData['error_code'] == 100) {
                        var jsonData=jsonData['data'];
                        $(jsonData).each(function (i, v) {
                            //alert(v['sub_category_id'])
                                html+='<option value="'+v['sub_category_id']+'" data-id="'+v['category_id']+'">'+v['name']+'</option>'; 
                            });
                            $("#filter_sub_category").append(html);
                        } else {
                            manageDataContent(false,true,true,true);
                        }
                    }
                }
            })
        }else{
            if(t==1){
                $("#sub_category").empty();
                $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
            }else{
                manageDataContent(false,true,true,true);
            }
        }
    }
    function getAttributeValue(o){
        var id=$(o).val();
        if(id){
            $.ajax({
                url: "<?php echo base_url("/admin/Home/ajax") ?>",
                type: "POST",
                data: "method=getAttributeValue&attribute_id=" + id,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 100) {
                       $("#attrVal").empty();
                       var jsonData=jsonData['data'];
                       var html='<option value="">--SELECT VALUE--</option>';
                       $(jsonData).each(function (i, v) {
                           //alert(v['sub_category_id'])
                            html+='<option value="'+v['attribute+_value_id']+'" data-id="'+v['attribute_id']+'">'+v['value']+'</option>'; 
                        });
                        $("#attrVal").append(html);
                    } else {
                        alert(jsonData['message']);
                    }

                }
            })
        }else{
            $("#attrVal").empty();
            $("#attrVal").append('<option value="">--SELECT VALUE--</option>');
        }
    }

    function addAttrVal(o){
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
            var checked = $("#is_filter").is(':checked');
            if (checked == true) {
                var is_filter = 1;
            } else {
                var is_filter = 0;
            }
            var checked2 = $("#is_required").is(':checked');
            if (checked2 == true) {
                var is_required = 1;
            } else {
                var is_required = 0;
            }
            var form_data = new FormData();
            form_data.append("category_id", ($("#category").val()).trim());
            form_data.append("sub_category_id", ($("#sub_category").val()).trim());
            form_data.append("attribute_id", ($("#attribute").val()).trim());
            //form_data.append("attrVal", ($("#attrVal").val()).trim());
            form_data.append("is_required", is_required);
            form_data.append("is_filter", is_filter);
            form_data.append("type", ($("#type").val()).trim());
            form_data.append("method", "attributeValueMapping");
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
    function getMappedAttributes(o){
        $(".errorPrint").css('display', 'none');
        var category=$("#filter_category").val();
        var sub_category=$(o).val();
        if(category && sub_category){
            var form_data = new FormData();
            form_data.append("category_id", category);
            form_data.append("sub_category_id", sub_category);
            form_data.append("method", "getMappedAttributes");
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
                       var jsonData=jsonData['data'];
                       var html='<option value="">--SELECT Attribute--</option>';
                       $(jsonData).each(function (i, v) {
                           //alert(v['sub_category_id'])
                            html+='<option value="'+v['attribute_id']+'" data-id="'+v['attribute_id']+'">'+v['name']+'</option>'; 
                        });
                        $("#filter_brand").append(html);
                    } else {
                        manageDataContent(false,false,true,true);
                    }

                }
            })
        }else{
            manageDataContent(false,false,true,true);
        }
    }

    function getMappedAttributeValue(o){
        $(".errorPrint").css('display', 'none');
        var category=$("#filter_category").val();
        var sub_category=$("#filter_sub_category").val();
        var attributeId=$(o).val();
        if(category && sub_category && attributeId){
            var form_data = new FormData();
            form_data.append("category_id", category);
            form_data.append("sub_category_id", sub_category);
            form_data.append("attribute_id", attributeId);
            form_data.append("method", "getMappedAttributeValue");
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
                       var jsonData=jsonData['data'];
                       var html='<label class="d-block">Values</label>';
                        $(jsonData).each(function (i, v) {
                           //alert(v['sub_category_id'])
                            html+='<li class="btn btn-rounded btn-secondary" style="margin: 2px;">'+v['value']+'</li>'; 
                        });
                        $("#mappedModels").append(html);
                    } else {
                        alert(jsonData['message']);
                    }

                }
            })
        }else{
            manageDataContent(false,false,false,true);
        }
    }

    function getTypeData(o){
        if($(o).val()==1){
            $("#requiredData").css('display','none');
        }else{
            $("#requiredData").css('display','-webkit-box');
        }
    }
</script>

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
        <h1>Model Management</h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Model Management</li>
        </ol>
    </div>
    <div class="content">

        <div class="row">
            <div class="col-md-5">
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
                                    <label>Select Brand</label>
                                    <select class="form-control chosen regInputs" id="brand" data-title="Featuers" >
                                    <option value="">--SELECT FEATUERS--</option>
                                    <?php if($featuers): foreach($featuers as $list): ?>
                                    <option value="<?=$list['featuers_id'];?>"><?=$list['name'];?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <p class="errorPrint" id="brandError"></p>
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

            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6 mb-2">
                                <label>Category</label>
                                <select class="form-control chosen" id="filter_category" onchange="getSubCategory(this,2);">
                                    <option value="">--SELECT CATEGORY--</option>
                                    <?php if($category_list): foreach($category_list as $list): ?>
                                    <option value="<?=$list['category_id'];?>"><?=$list['name'];?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <p class="errorPrint" id="filter_categoryError"></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label> Sub-Category</label>
                                <!-- <select class="form-control chosen"> -->
                                <select class="form-control" data-title="Sub-Category" id="filter_sub_category" onchange="getMappedFeatuers(this);">
                                    <option value="">--SELECT SUB-CATEGORY--</option>
                                </select>
                                <p class="errorPrint" id="filter_sub_categoryError"></p>
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
                            alert(jsonData['message']);
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
                            $("#filter_brand").empty();
                            $("#filter_brand").append('<option value="">--SELECT BRAND--</option>');
                            $("#filter_sub_category").empty();
                            $("#filter_sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
                            alert(jsonData['message']);
                        }
                    }
                }
            })
        }else{
            if(t==1){
                $("#sub_category").empty();
                $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
            }else{
                $("#filter_brand").empty();
                $("#filter_brand").append('<option value="">--SELECT BRAND--</option>');
                $("#filter_sub_category").empty();
                $("#filter_sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
            }
        }
    }
    

    function addModel(o){
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
            form_data.append("featuers_id", ($("#brand").val()).trim());
            form_data.append("method", "featuersMapping");
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
                    } else {
                        alert(jsonData['message']);
                    }
                    location.reload();
                }
            })
        }
    }
    function getMappedFeatuers(o){
        $(".errorPrint").css('display', 'none');
        var category=$("#filter_category").val();
        var sub_category=$(o).val();
        if(category && sub_category){
            var form_data = new FormData();
            form_data.append("category_id", category);
            form_data.append("sub_category_id", sub_category);
            form_data.append("method", "getMappedFeatuers");
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
                    $("#mappedModels").empty();
                    if (jsonData['error_code'] == 100) {
                       var jsonData=jsonData['data'];
                       var html='<label class="d-block">Featuers</label>';
                        $(jsonData).each(function (i, v) {
                           //alert(v['sub_category_id'])
                            html+='<li class="btn btn-rounded btn-secondary">'+v['name']+'</li>'; 
                        });
                        $("#mappedModels").append(html);
                    } else {
                        alert(jsonData['message']);
                    }

                }
            })
        }else{
            if(category){
                showErrorMessage('filter_sub_categoryError','Required Field');
            }else{
                showErrorMessage('filter_categoryError','Required Field');
            }
        }
    }

    
</script>

 
    
<style>
    .margin-20{
        margin-top: 20px;
    }
</style>     <div class="content-wrapper">
            <div class="content-header sty-one">
                <?php if(!isset($edit)) { ?>
                    <h1>Add Model</h1>
                <?php } else{ ?>
                    <h1>Edit Model</h1>
                <?php } ?>
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><i class="fa fa-angle-right"></i> <?php if(!isset($edit)) { ?>
                        Add Model
                    <?php } else{ ?>
                        Edit Model
                    <?php } ?></li>
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
                        <div class="col-md-12 mb-4">
                    <label>Select Brand</label>
                   <select class="form-control stepError1" name="brand" data-warning="errorWarning1">
                       <option value="">Select Brand</option>
                        <?php foreach ($brand_list as $row) { ?>
                            <option value="<?= $row['brand_id'] ?>"><?php echo $row['name']; ?></option>
                        <?php } ?>
                   </select>
                   <?= form_error('brand') ?>
                    <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning1"><span id="errorMsg1"></span></div>
                </div>
                        <div class="col-md-12">
                    <label>Model Name(In English)</label>
                    <input type="text" class="form-control mb-4 stepError1" id="english" name="english" placeholder="Model Name(In English)" onkeyup="sub_category_avail(this)" data-warning="errorWarning2"><span id="result1"></span>
                    <?= form_error('english') ?>
                    <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning2"><span id="errorMsg2"></span></div>
                </div>
                        <div class="col-md-12">
                    <label>Model Name(In Arabic)</label>
                    <input type="text" class="form-control mb-4 stepError1" name="arabic" placeholder="Model Name(In Arabic)" data-warning="errorWarning3">
                    <?= form_error('arabic') ?>
                    <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning3"><span id="errorMsg3"></span></div>
                    <button type="button" id="disable" class="composemail mt-4 pull-right" data-count="1" onclick="nextPrev(this, 1)">Submit</button>
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
                        <div class="col-md-12 mb-4">
                    <label>Select Brand</label>
                   <select class="form-control stepError1" name="brand" data-warning="errorWarning1">
                       <?php foreach ($brand_list as $row) {
                            if($row['brand_id']==$edit['brand_id']): ?>
                            <option value="<?= $row['brand_id'] ?>" <?= set_value('brand_id') ? (set_value('brand_id') == $row['brand_id'] ? 'selected' : '') : ($edit['brand_id'] == $row['brand_id'] ? 'selected' : '') ?>><?php echo $row['name']; ?></option>
                            <?php endif; } ?>
                   </select>
                   <?= form_error('brand') ?>
                    <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning1"><span id="errorMsg1"></span></div>
                </div>
                        <div class="col-md-12">
                    <label>Model Name(In English)</label>
                    <input type="text" class="form-control mb-4 stepError1" name="english" value="<?= $edit['name']?>" placeholder="Sub-Category Name" data-warning="errorWarning2">
                    <?= form_error('english') ?>
                    <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning2"><span id="errorMsg2"></span></div>
                </div>
                        <div class="col-md-12">
                    <label>Model Name(In Arabic)</label>
                    <input type="text" class="form-control mb-4 stepError1" name="arabic" value="<?= $edit['name_ar']?>" placeholder="Sub-Category Name" data-warning="errorWarning3">
                    <?= form_error('arabic') ?>
                    <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning3"><span id="errorMsg3"></span></div>
                    <button type="submit" class="composemail mt-4 pull-right">Update</button>  
                </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>




 <div class="col-md-12 margin-20">

                <div class="card"> 
                <div class="card-body"><form method="post" id="submitFormCategory">
                <div class="row mb-4">
                    
                        <div class="col-md-12 mb-2">
                        <label>Select Brand</label>
                            <select class="form-control" name="Brand" onchange="filter();">
                                <option selected disabled>Select Brand</option>
                                    <?php foreach ($brand_list as $row) { ?>
                                        <option value="<?= $row['brand_id'] ?>" <?php echo set_select('Brand', $row['brand_id'], False); ?>><?php echo $row['name']; ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    
                </div></form>
                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name(En)</th>
                                        <th>Name(Ar)</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($model_list as $listing) { ?>
                                        <tr>
                                            <td><?= $listing['name'];?></td>
                                            <td><?= $listing['name_ar'];?></td>
                                            <td>
                                            <div class="mytoggle">
                                            <label class="switch">
                                              <input type="checkbox" <?php
                                                if ($listing['status'] == '1'): echo "checked";
                                                 endif;?> onchange="checkStatus_user(this,'<?= $listing['model_id']; ?>');">
                                              <span class="slider round"></span>
                                            </label>
                                        </div>
                                        </td> 
                                        <td><a class="composemail" href="<?php echo site_url('admin/model-list/'.$listing['model_id']);?>">Edit</a>
                                        <a class="composemail" style="cursor:pointer;" onclick="deleleModel(this,'<?= $listing['model_id']; ?>');" >Delete</a></td> 
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
       function nextPrev(obj, type) {
        var nullException = true;

            var dataCount = $(obj).attr('data-count');

            $(".stepError" + dataCount).each(function () {
                  
                if ($(this).val() == '' || $(this).val() == null || $(this).val() == 'null' || $(this).val() == 0) {
                    var warnMsg = $(this).attr('data-warning');
                    $("#" + warnMsg).empty();
                    $("#" + warnMsg).append('*required field');
                    $("#" + warnMsg).css('display', 'block');
                    nullException = false;
                } else {
                    var warnMsg = $(this).attr('data-warning');
                    $("#" + warnMsg).css('display', 'none');
                    //document.getElementById('Property').type = "submit";

                }
            });
            if (nullException == true) {
            sendForm();
        }
        //console.log(dataCount);
    }
    function nextt(obj, type)
    {
        var nullException = true;

            var dataCount = $(obj).attr('data-count');

            $(".stepError" + dataCount).each(function () {
                  
                if ($(this).val() == '' || $(this).val() == null || $(this).val() == 'null' || $(this).val() == 0) {
                    var warnMsg = $(this).attr('data-warning');
                    $("#" + warnMsg).empty();
                    $("#" + warnMsg).append('*required field');
                    $("#" + warnMsg).css('display', 'block');
                    nullException = false;
                } else {
                    var warnMsg = $(this).attr('data-warning');
                    $("#" + warnMsg).css('display', 'none');
                    //document.getElementById('Property').type = "submit";

                }
            });
            if (nullException == true) {
            sendForm();
        }
    }

    function sendForm() {
        $("#regForm").submit();
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
    if(confirm("Are You sure want to change the status!"))
    {
    if (id) {
        $.ajax({
            url: "<?= base_url(); ?>admin/Admin/ajax",
            type: 'post',
            data: 'method=ModelStatus&id=' + id + '&action=' + status,
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
    }
}
else
{
location.reload();
}
}

function sub_category_avail(){  
var english = $('#english').val();
var table = 'product_sub_category';
if(english != '')  
{ 
$.ajax({  
url:"<?php echo base_url('admin/Admin/check');?>",  
type:"POST" ,  
data:'english='+english+'&table='+table,  
success:function(data){  
$('#errorMsg1').html(data);
$("#errorWarning2").css('display', 'block');
//$('#english').css("border-color","#e22f2f")
}  
});  
}
}

function filter()
{
    $("#submitFormCategory").submit();
/*$.ajax({  
url:"<?php // echo base_url('admin/Admin/subcategory_list');?>",  
type:"POST" ,  
data:'category_id='+id,  
success:function(data){
}  
});  */
}



function deleleModel(obj, id) {
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            if (id) {
                status='99';
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=ChangeAttributeStatus&id=' + id + '&action=' + status+'&type=4',
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
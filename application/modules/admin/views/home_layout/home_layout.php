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

    .dropify-clear{
        display:none !important;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Home Layout Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url('admin');?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Home Layout Management</li>
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
                                <div class="col-md-12">
                                    <label>Layout Name</label>
                                    <input type="text" id="english" class="form-control mb-4 regInputs" name="english" placeholder="Layout Name" data-title="Layout Name">
                                    <p class="errorPrint" id="englishError"></p>
                                    <?= form_error('english') ?>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationCustom01">Layout Banner</label>
                                    <input type="file"  id="input-file-now-custom-1" name="image" class="dropify" data-title="Image" accept="image/*"/> 
                                    <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                    <?= form_error('image') ?>
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
                                <div class="col-md-12">
                                    <label>Layout Name</label>
                                    <input type="text" class="form-control mb-4 regInputs" id="english" name="english" value="<?= $edit['name']?>" placeholder="Layout Name" data-warning="errorWarning1">
                                    <?= form_error('english') ?>
                                    <p class="errorPrint" id="englishError"></p>
                                </div>
                                <div class="col-md-12">
                                    <label for="validationCustom01">Layout Banner</label>
                                    <input type="file" value="<?php echo $edit['image']; ?>"  data-default-file="<?php echo $edit['image'];?>" id="input-file-now-custom-1" name="image" class="dropify" data-title="Image" accept="image/*"/> 
                                    <p class="errorPrint" id="input-file-now-custom-1Error"></p>
                                    <?= form_error('image') ?>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" id="add_product_set" class="composemail mt-4 pull-right" data-count="1" onclick="saveData(this, 1)">Update</button>  
                                    <a href="<?=base_url('admin/create-layout');?>" class="composemail mt-4 pull-right" style="margin-right: 3px;">Cancel</a>  
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
                        <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Title</th>
                                        <th>Banner</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($category_list): foreach($category_list as $list): ?>
                                        <tr>
                                            <td><?=$list['name']; ?></td>
                                            <td><?php if(isset($list['image']) and $list['image']){ echo '<img src="'.$list['image'].'">'; }else{ echo "N/A"; } ?></td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" <?= $list['status'] == 1 ? 'checked' : '' ?> onchange="checkStatus(this, <?= $list['home_layout_id'] ?>);">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <!----<a class="composemail fa_btn" href="<?php echo site_url('admin/create-layout/'.$list['home_layout_id']);?>"><i class="fa fa-edit"></i></a>--->
                                                <a class="composemail fa_btn" onclick="deleleCategory(this,'<?= $list['home_layout_id']; ?>');"><i class="fa fa-trash-o"></i></a>
                                                <a class="composemail fa_btn" href="<?= base_url('admin/home-layout-product/' . $list['home_layout_id']); ?>" ><i class="fa fa-plus"></i></a> 
                                            </td>
                                        </tr>
                                        <?php endforeach; endif; ?>
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

    function checkStatus(obj, id) {
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
                data: 'method=changeStatus&id=' + id + '&action=' + status+'&type=3',
                success: function (data) {
                    var dt = $.trim(data);
                    //alert(dt);
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
                    data: 'method=changeStatus&id=' + id + '&action=' + status+'&type=3',
                    success: function (data) {
                        var dt = $.trim(data);
                        //alert(dt);
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
    
    

</script>  

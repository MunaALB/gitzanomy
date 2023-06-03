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
    <?php if(isset($single_attribute_value) and $single_attribute_value){
        $text="Edit Attribute Value";
        $buttonValue="Update";
        }else{
            $text="Add Attribute Value";
            $buttonValue="Submit";
        } ?>
        <h1><?=$text;?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i> <?=$text;?></li>
        </ol>
    </div>
    <?=$this->session->flashdata('response');?>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form method="POST">
                    <?php if(isset($single_attribute_value) and $single_attribute_value): ?>
                        <div class="card-body"> 
                            <div class="row"> 
                                <div class="col-md-12 mt-4">
                                <label>Select Label</label>
                                    <select required class="form-control" name="attribute">
                                        <?php if($attribute_list): foreach ($attribute_list as $row) {
                                            if($row['attribute_id']==$single_attribute_value['attribute_id']): ?>
                                            <option value="<?= $row['attribute_id'] ?>" <?php echo set_select('attribute', $row['attribute_id'], False); ?>><?php echo $row['name']; ?></option>
                                            <?php endif; } endif; ?>
                                    </select>
                                </div>
                                
                            </div> 
                            <div id="appendDiv">
                                <div class="row add" data-id="0">
                                    <div class="col-md-6 mt-4">
                                        <label>Value(En)</label>
                                        <input required  value="<?=$single_attribute_value['value'];?>" type="text" class="form-control mb-4" name="english" id="english0" placeholder="Attribute Value(En)">
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label>Value(Ar)</label>
                                        <input required value="<?=$single_attribute_value['value_ar'];?>" type="text" class="form-control mb-4" name="arabic" id="arabic0" placeholder="Attribute Value(Ar)">
                                    </div> 
                                </div> 
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12"> 
                                    <button type="submit" name="addValue" class="composemail mt-4 pull-right">Update</button>  
                                </div>
                            </div> 
                        </div>
                        <?php else:?>
                        <div class="card-body"> 
                            <div class="row"> 
                                <div class="col-md-12 mt-4">
                                <label>Select Label</label>
                                    <select required class="form-control" name="attribute">
                                        <option selected disabled value="">Select Attribute</option>
                                        <?php if($attribute_list): foreach ($attribute_list as $row) { ?>
                                            <option value="<?= $row['attribute_id'] ?>" <?php echo set_select('attribute', $row['attribute_id'], False); ?>><?php echo $row['name']; ?></option>
                                        <?php } endif; ?>
                                    </select>
                                </div>
                                
                            </div> 
                            <div id="appendDiv">
                                <div class="row add" data-id="0">
                                    <div class="col-md-6 mt-4">
                                        <label>Value(En)</label>
                                        <input required type="text" class="form-control mb-4" name="english[]" id="english0" placeholder="Attribute Value(En)">
                                    </div>
                                    <div class="col-md-6 mt-4">
                                        <label>Value(Ar)</label>
                                        <input required type="text" class="form-control mb-4" name="arabic[]" id="arabic0" placeholder="Attribute Value(Ar)">
                                    </div> 
                                </div> 
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12"> 
                                    <a class=" mt-2 pull-right" style="text-decoration: underline;" data-classname="lableDiv" data-id="0" onclick="addMore(this)">Add More</a>  
                                </div>
                                <div class="col-md-12"> 
                                    <button type="submit" name="addValue" class="composemail mt-4 pull-right">Submit</button>  
                                </div>
                            </div> 
                        </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div> 
            <div class="col-md-12 margin-20">
                <div class="card"> 
                    <div class="card-body">
                        <form method="post" id="filter">
                            <div class="row mb-4">
                                <div class="col-md-12 mb-2">
                                    <label>Select Label</label>
                                    <select class="form-control" name="attribute" onchange="filter();">
                                        <option selected disabled>Select Attribute</option>
                                        <?php if($attribute_list): foreach ($attribute_list as $row) { ?>
                                            <option value="<?= $row['attribute_id'] ?>" <?php echo set_select('attribute', $row['attribute_id'], False); ?>><?php echo $row['name']; ?></option>
                                        <?php } endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive table-image">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Value(En)</th>
                                            <th>Value(Ar)</th>
                                            <th>Status</th> 
                                            <th>Action</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($attribute_value_list as $listing){ ?>
                                        <tr> 
                                            <td><?= $listing['value'];?></td>
                                            <td><?= $listing['value_ar'];?></td>
                                            <td>
                                            <div class="mytoggle">
                                            <label class="switch">
                                                <input type="checkbox" <?php
                                                if ($listing['status'] == '1'): echo "checked";
                                                    endif;?> onchange="checkStatus_user(this,'<?= $listing['attribute_value_id']; ?>');">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                        </td> 
                                        <td>
                                            <a class="composemail" href="<?php echo site_url('admin/attribute-list/'.$listing['attribute_value_id']);?>"><i class="fa fa-edit"></i></a>
                                            <!-- <a class="composemail" onclick="deleteAttribute(this,'<?= $listing['attribute_value_id']; ?>');" style="cursor:pointer;"><i class="fa fa-trash-o"></i></a> -->
                                        </td> 
                                        </tr>
                                        <?php } ?>  
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
            data: 'method=ChangeAttributeStatus&id=' + id + '&action=' + status+'&type=2',
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


function deleteAttribute(obj, id) {
    var status = 99;
    if(confirm("Are You sure want to delete!")){
        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=ChangeAttributeStatus&id=' + id + '&action=' + status+'&type=2',
                success: function (data) {
                    var dt = $.trim(data);
                    //alert(dt);
                    var jsonData = $.parseJSON(dt);
                    if (jsonData['error_code'] == "100") {
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

function filter()
{
    $("#filter").submit();
}
</script>
<script type="text/javascript">
    function addMore(obj) { 
        var count=$(obj).attr('data-id');
        count++
        var html='<div class="row add" id="div'+count+'">';
                html+='<div class="col-md-6 mt-4">';
                    html+='<label>Value(En)</label>';
                        html+='<input required type="text" class="form-control mb-4" name="english[]" id="english0" placeholder="Attribute Value(En)">';
                    html+='</div>';
                    html+='<div class="col-md-6 mt-4">';
                        html+='<label>Value(Ar)</label>';
                            html+='<i onclick="deleteAttr(this,'+count+');" class="fa fa-trash-o" style="float: right;cursor: pointer;"></i>';
                            html+='<input required type="text" class="form-control mb-4" name="arabic[]" id="arabic0" placeholder="Attribute Value(Ar)">';
                        html+='</div>';
                    html+='</div>';
        $(obj).attr('data-id',(count));
        $("#appendDiv").append(html);
    }
    function deleteAttr(obj,i) { 
        $("#div"+i).remove();
    }

</script>
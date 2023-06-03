<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }

    #termsproduct .modal-header{
    background: #FF5722;
}
#termsproduct .modal-header{
    background: #FF5722;
}
#termsproduct .modal-header h5{
    font-size: 20px;
    color: #ffffff;
    letter-spacing: 1px;
}
#termsproduct .modal-header .close {
    margin-top: -30px;
    color: #ffffff;
    opacity: 1;
    font-size: 30px;
}
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Add a Product </h1>
    </div>

<form method="POST" id="uploadProduct" enctype="multipart/form-data">
    <?php if(!isset($product_list[0])):?>
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <a href="<?=base_url('vendor/edit-bulk-upload-product');?>" style="float: right;color: #fff;cursor: pointer;">Edit From Excel</a>
                    <h5 class="card-title">Product Information</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <label>Select Category</label>
                                <select class="form-control chosen regInputs" required data-title="Category" id="category" name="category_id" onchange="getSubCategory(this);">
                                    <option value="">--SELECT CATEGORY--</option>
                                    <?php if($category_list): foreach($category_list as $list): ?>
                                    <option value="<?=$list['category_id'];?>"><?=$list['name'];?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                                <p class="errorPrint" id="categoryError"></p>
                            </div>
                            <div class="col-md-6">
                                <label>Select SubCategory</label>
                                <select class="form-control regInputs" required data-title="Sub-Category" id="sub_category" name="sub_category_id" >
                                    <option value="">--SELECT SUB-CATEGORY--</option>
                                </select>
                                <p class="errorPrint" id="sub_categoryError"></p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xs-12">
                                <a href="<?=base_url('assets/bulk/creater/populate.xls');?>" style="display:none;" id="downloadData" download>Download format</a>
                                <button type="button" id="add_product_set" onclick="generateExcel(this);" class="composemail save-length pull-right"> Generate Excel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-body">
                    <div class="eventrow">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Select Excel File</label>
                                    <input type="file" name="products" accept=".xls, .xlsx" required="" class="form-control">
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-6">
                                        <div class="text-sm-left" style="margin-top: -26px;">
                                            <!-- <button class="composemail mt-4 pull-right" style="margin-right: 106px;margin-bottom: 15px;cursor:pointer;" type="submit" name="bulk_upload">Upload</button> -->
                                            <button class="composemail mt-4 pull-right" style="margin-right: 106px;margin-bottom: 15px;cursor:pointer;" type="submit" name="bulk_verify">Upload</button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="content eventdeatil">  
        <div class="card">
            <!-- <?php echo '<pre/>'; print_r($product_list);?> -->
            <?php if(isset($product_list[0])):?>
                <div class="card-body">
                    <strong style="color: red;">
                    <i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;margin: 2px -15px;"></i>
                    Total Errors : <?=$productError;?></strong>
                    <?php if($product_list): ?>
                        <?php if($productError):?>
                            <button class="composemail mt-4 pull-right" style="margin-right: 106px;margin-bottom: 15px;cursor:pointer;    background: #7b7b7b;cursor: not-allowed;" type="button" name="bulk_verify">Upload</button>
                        <?php else: ?>
                            <button class="composemail mt-4 pull-right" style="margin-right: 106px;margin-bottom: 15px;cursor:pointer;" type="button" onclick="uploadData(this);" name="bulk_verify">Upload</button>
                        <?php endif; ?>
                    <?php else: ?>
                        <button class="composemail mt-4 pull-right" style="margin-right: 106px;margin-bottom: 15px;cursor:pointer;" type="button"  name="bulk_verify">Upload</button>
                    <?php endif; ?>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Sub-Category</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <!-- <th>Product From</th> -->
                                    <th style="width:120px;">Name</th>
                                    <th style="width:120px;">Name(Ar)</th>
                                    <th>Price (LYD)</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <?php if(isset($product_list[0]['attributeListArr']) and $product_list[0]['attributeListArr']):
                                        foreach($product_list[0]['attributeListArr'] as $list) :?>
                                        <th><?=$list['attribute_name'];?></th>
                                    <?php endforeach; endif; ?>
                                    <?php if(isset($product_list[0]['specificationListArr']) and $product_list[0]['specificationListArr']):
                                        foreach($product_list[0]['specificationListArr'] as $list) :?>
                                        <th><?=$list['attribute_name'];?></th>
                                    <?php endforeach; endif; ?>
                                    <th>Images</th>
                                    <th>Description</th>
                                    <th>Description(Ar)</th>
                                    <th>Terms</th>
                                    <th>Terms(Ar)</th>
                                    <th>Returnable</th>
                                    <th>Duration</th>
                                    <th>Return Policy</th>
                                    <th>Return Policy(Ar)</th>
                                    <th>Expected Delivery</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $lastKeyOfRow=0; $lastKeyOfRowCount=1; $dataColor="#08a3a2"; if ($product_list): foreach ($product_list as $key=>$list): 
                                    $hex = '#';
                                    $startRowIndex=0;
                                    foreach(array('r', 'g', 'b') as $color){
                                        $val = mt_rand(0, 255);
                                        $dechex = dechex($val);
                                        if(strlen($dechex) < 2){
                                            $dechex = "0" . $dechex;
                                        }
                                        $hex .= $dechex;
                                    }

                                    if($list['filterTypeData']==0){
                                        $dataColor=$hex;
                                    }
                                    ?>

                                    <?php if($list['error']): 
                                        $classData="background: #f9d8d8;";
                                    else:
                                        $classData="";
                                    endif; ?>
                                
                                        <tr style="<?=$classData;?>">
                                        <?php if(isset($product_list[0]['attributeListArr']) and $product_list[0]['attributeListArr']){ 
                                                if($list['filterTypeData']==0){
                                                    $borderTop="border-top: 6px solid ".$dataColor;
                                                    $lastKeyOfRow=$list['setIndex']+1;
                                                }else{
                                                   $borderTop='';
                                                   //$lastKeyOfRow=$list['setIndex']+1;
                                                }
                                                if($lastKeyOfRowCount==$lastKeyOfRow){
                                                    $borderBottom="border-bottom: 6px solid ".$dataColor;
                                                    $lastKeyOfRowCount=1;
                                                }else{
                                                    $borderBottom="";
                                                    $lastKeyOfRowCount++;
                                                }
                                               

                                               $isAttr='style="border-left: 6px solid '.$dataColor.'; '.$borderTop.'; '.$borderBottom.'"' ;
                                             }else{ 
                                                $isAttr='';
                                             } ?>

                                            <td <?=$isAttr;?> data-filter="<?=$list['filterTypeData'];?>" data-incr="<?=$lastKeyOfRowCount;?>" data-base="<?=$lastKeyOfRow;?>">
                                            <?= $list['category_name'];?></td>
                                            <td><?= $list['sub_category_name'];?></td>
                                            <td><?= $list['brand_name'];?></td>
                                            <td><?= $list['model_name'];?></td>
                                            <!-- <td><?php if($list['product_from']==1){ echo 'Inventory'; }else{ echo 'Dubai'; }; ?></td> -->
                                            <td><?php if($list['name_error']){
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;margin: -11px 56px"></i>';
                                                    } ?>
                                                <?= $list['name'];?></td>
                                            <td><?php if($list['name_ar_error']){
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;margin: -11px 78px"></i>';
                                                    } ?>
                                                <?= $list['name_ar'];?></td>
                                            <td><?php if($list['price_error']){
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;margin: -11px 52px"></i>';
                                                    } ?>
                                                <?= $list['price'];?></td>
                                            <td><?php if($list['quantity_error']){
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;margin: -11px 73px"></i>';
                                                    } ?>
                                                <?= $list['quantity'];?></td>
                                            <td><?= $list['discount'];?></td>
                                            <?php if(isset($list['attributeListArr']) and $list['attributeListArr']):
                                                foreach($list['attributeListArr'] as $attr) :?>
                                                <td>
                                                    <?php if($attr['attribute_value']){
                                                        echo $attr['attribute_value'];
                                                    }else{
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;"></i>';
                                                    } ?>
                                                </td>
                                            <?php endforeach; endif; ?>
                                            <?php if(isset($list['specificationListArr']) and $list['specificationListArr']):
                                                foreach($list['specificationListArr'] as $attr) :?>
                                                <td>
                                                <?php if($attr['attribute_value']){
                                                        echo $attr['attribute_value'];
                                                    }else{
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;"></i>';
                                                    } ?>
                                                    </td>
                                            <?php endforeach; endif; ?>
                                            <td>
                                            <?php if($list['image1_error']){
                                                    echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;"></i>';
                                                }else{
                                                    if(isset($list['images']) and $list['images']){
                                                        foreach($list['images'] as $img){
                                                            echo '<a href="'.$img.'" target="_blank"><img src="'.$img.'" style="width:20px;height:20px;border: 1px solid red;margin: 2px;"/></a>';
                                                        }
                                                    } 
                                                }
                                            ?>
                                            </td>
                                            <td><?php if($list['desc_error']){
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;margin: -11px 73px"></i>';
                                                    } ?>
                                                <a href="#" onclick="showData(this,'<?=$key;?>','description');">View</a></td>
                                            <!-- <td><?= $list['description'];?></td> -->
                                            <td><?php if($list['desc_ar_error']){
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;margin: -11px 73px"></i>';
                                                    } ?>
                                                <a href="#" onclick="showData(this,'<?=$key;?>','description_ar');">View</a></td>
                                            <!-- <td><?= $list['description_ar'];?></td> -->
                                            <td><a href="#" onclick="showData(this,'<?=$key;?>','terms');">View</a></td>
                                            <!-- <td><?= $list['terms'];?></td> -->
                                            <td><a href="#" onclick="showData(this,'<?=$key;?>','terms_ar');">View</a></td>
                                            <!-- <td><?= $list['terms_ar'];?></td> -->
                                            <td><?php if($list['is_returnable']==1){ echo "Returnable"; }else{ echo "Not Returnable"; } ?></td>
                                            <td><?= $list['duration'];?> Days</td>
                                            <td><a href="#" onclick="showData(this,'<?=$key;?>','return_policy');">View</a></td>
                                            <!-- <td><?= $list['return_policy'];?></td> -->
                                            <td><a href="#" onclick="showData(this,'<?=$key;?>','return_policy_ar');">View</a></td>
                                            <!-- <td><?= $list['return_policy_ar'];?></td> -->
                                            <td><?php if($list['expected_delivery_error']){
                                                        echo '<i class="fa fa-dot-circle-o" title="Required Field" aria-hidden="true" style="color: red;position: absolute;margin: -19px 73px"></i>';
                                                    } ?>
                                                <?= $list['expected_delivery'];?> Days</td>
                                            <td>
                                                <a href="#" class="composemail"><i class="fa fa-eye"></i></a>
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
            <?php endif; ?>
        </div>
    </div>

</form>
    <?php if(($this->session->flashdata('response'))){ echo $this->session->flashdata('response'); ?>
    
    <?php } ?>
</div>

<div class="modal fade" id="termsproduct" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">View Content</h5>
                <button type="button" class="close" onclick="closePop();">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="short_description form-group">
                    <p id="paraData"></p>
                </div>
            </div>
        </div>
    </div>
</div> 
<script>
function closePop(){
    $("#termsproduct").removeClass('show');
    $("#termsproduct").css('display','none');
}
function showData(o,i,t){
    // $("#termsproduct").modal('show')
    var product_list='<?=json_encode($product_list);?>';
    var product_list=$.parseJSON(product_list);
    // console.log(product_list[i][t])
    $("#paraData").empty();
    $("#paraData").append(product_list[i][t]);
    $("#termsproduct").addClass('show');
    $("#termsproduct").css('display','block');
}
function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }

    function getSubCategory(o){
        var category=$(o).val();
        if(category){
            $.ajax({
                url: "<?php echo base_url("/vendor/Home/ajax") ?>",
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
                    } else {
                        $("#sub_category").empty();
                        $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
                        alert(jsonData['message']);
                    }
                    
                }
            })
        }else{
            $("#sub_category").empty();
            $("#sub_category").append('<option value="">--SELECT SUB-CATEGORY--</option>');
        }
    }


    function generateExcel(o){
        $(".errorPrint").css('display', 'none');
        
        var category=$("#category").val();
        var sub_category=$("#sub_category").val();
        if(category && sub_category){
            var form_data = new FormData();
            form_data.append("category_id", category);
            form_data.append("sub_category_id", sub_category);
            form_data.append("method", "generateExcel");
            $.ajax({
                url: "<?php echo base_url("/vendor/Bulk/generate_excel") ?>",
                type: "POST",
                data: form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#downloadData").css('display','block');
                    $("#downloadData").attr('href','<?=base_url('assets/bulk/creater/vendor/');?>'+data+'.xls');
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

    function uploadData(o){
        //console.log('<?=json_encode($product_list);?>')
        var form_data = new FormData();
        form_data.append("product_list", '<?=json_encode($product_list);?>');
        form_data.append("method", "uploading_data");
        $.ajax({
                url: "<?php echo base_url("/vendor/Bulk/uploading_data") ?>",
                type: "POST",
                data: form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //alert(data)
                    if(data=='success'){
                        window.location.href="<?=base_url('vendor/bulk-upload-product');?>";
                    }else{
                        alert("Some error found");
                    }
                    // $("#downloadData").css('display','block');
                    // $("#downloadData").attr('href','<?=base_url('assets/bulk/creater/');?>'+data+'.xls');
                }
            })
    }
   
</script>

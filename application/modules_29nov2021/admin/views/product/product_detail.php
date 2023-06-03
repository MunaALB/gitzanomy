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
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Product Detail </h1>
    </div>
    <div class="content eventdeatil">
        <div class="card">
            <div class="">
                <div id="demo">
                    <div class="step-app">
                        <ul class="step-steps">
                            <li class="active"><a href="#step1"><span class="number">1</span>Product Basic Detail</a></li>
                            <li class=""><a href="#step2"><span class="number">2</span>Product Attributes</a></li>
                        </ul>
                        <div class="step-content for-border-remove">
                            <div class="step-tab-panel active" id="step1">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <a href="<?= base_url('admin/edit-product-detail/' . $product_list['product_id']); ?>" class="composemail pull-right"><i class="fa fa-edit"></i> Edit a product</a>
                                    </div>
                                </div>
                                <div class=" eventdeatil">
                                    <div class="card-header">
                                        <h5 class="text-white m-b-0">Product Information</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="eventrow">
                                            <div class="row mt-3">
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>Product Category</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['category_name']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>Product SubCategory</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['sub_category_name']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>Product Brand</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['brand_name']; ?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>Product Model</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['model_name']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" eventdeatil">
                                    <div class="card-header">
                                        <h5 class="text-white m-b-0">Product Basic Detail</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="eventrow">
                                            <div class="row mt-3">
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Product Name</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['name']; ?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Product Name(Ar)</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['name_ar']; ?></p>
                                                </div>
                                                <!-- <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Product Discount</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['discount']; ?>%</p>
                                                </div> -->
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Product Commission  <a href="#" data-toggle="modal" data-target="#commissionModal"><i class="fa fa-pencil"></i></a></label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['commission']; ?>%</p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Expected Delivery</label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['expected_delivery']?$product_list['expected_delivery'].' days':''; ?> days</p>
                                                </div>
                                                <?php if ($product_list['vendor_id'] == 0): ?>
                                                    <div class="col-lg-4 col-xs-6 b-r">
                                                        <label>Product From</label>
                                                        <br>
                                                        <p class="text-muted"><span style="background: red;color: #fff;padding: 3px;border-radius: 6px;"><?php
                                                                if ($product_list['product_from'] == 2) {
                                                                    echo "Dubai";
                                                                } else {
                                                                    echo "Inventory";
                                                                }
                                                                ?></span></p>
                                                    </div>
<?php endif; ?>
                                                <div class="col-lg-4 col-xs-4 b-r">
                                                    <label>Product Weight : </label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['weight']){ echo $product_list['weight']; }else{ echo "N/A"; } ?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-4 b-r">
                                                    <label>Product Height : </label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['height']){ echo $product_list['height']; }else{ echo "N/A"; } ?></p>
                                                </div>

                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>Product Description : </label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['description']; ?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>Product Description(Ar) : </label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['description_ar']; ?></p>
                                                </div>

                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>Terms & Condition : </label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['terms']; ?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>Terms & Condition (Ar) : </label>
                                                    <br>
                                                    <p class="text-muted"><?= $product_list['terms_ar']; ?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Is Returnable</label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['is_returnable']==1){ echo "Yes"; }else{ echo "No"; }?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Duration </label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['is_returnable']==1){ echo $product_list['duration']." Days"; }else{ echo "N/A"; }?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>Return Policy : </label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['is_returnable']==1){ echo $product_list['return_policy']; }else{ echo "N/A"; }?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>Return Policy (Ar) : </label>
                                                    <br>
                                                    <p class="text-muted"><?php if($product_list['is_returnable']==1){ echo $product_list['return_policy_ar']; }else{ echo "N/A"; }?></p>
                                                </div>
                                            
                                            </div>
                                        </div>
                                    </div>
                                </div>

<?php if ($product_list['product_specification']): ?>
                                    <div class="eventdeatil">
                                        <div class="card-header">
                                            <h5 class="text-white m-b-0">Product Specification</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="eventrow">
                                                <div class="row mt-3">
    <?php foreach ($product_list['product_specification'] as $list): ?>
                                                        <div class="col-lg-3 col-xs-6 b-r">
                                                            <label><?= $list['attribute_name']; ?></label>
                                                            <br>
                                                            <p class="text-muted"><?= $list['attribute_value']; ?></p>
                                                        </div>
    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
<?php endif; ?>
<?php if ($product_list['product_featuers']): ?>
                                    <div class="eventdeatil">
                                        <div class="card-header">
                                            <h5 class="text-white m-b-0">Product Features</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="eventrow">
                                                <div class="row mt-3">
    <?php foreach ($product_list['product_featuers'] as $list): ?>
                                                        <div class="col-lg-3 col-xs-6 b-r">
                                                            <label><?= $list['name']; ?></label>
                                                            <br>
                                                            <p class="text-muted"><?= $list['value']; ?></p>
                                                        </div>
    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="step-tab-panel for-border-remove booking-detail" id="step2">
                                <?php if (isset($product_list['add_more_attribute']) and $product_list['add_more_attribute']): ?>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <a href="<?= base_url('admin/add-more-attribute/' . $product_list['product_id']); ?>" class="composemail pull-right"><i class="fa fa-edit"></i>Add Attributes</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php
                                if ($product_list['product_attribute_group']):
                                    foreach ($product_list['product_attribute_group'] as $key => $list):
                                        ?>
                                        <div class=" eventdeatil">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="text-white m-b-0"><?= $product_list['name']; ?> 
                                                    <?php $goIn=false; if(isset($list['attribute_data']) and $list['attribute_data']){
                                                        foreach($list['attribute_data'] as $keyIndex=>$dta){
                                                            if($keyIndex==0){
                                                                echo '('.$dta['attribute_value'];
                                                            }else{
                                                                echo ', '.$dta['attribute_value'];
                                                            }
                                                            $goIn=true;
                                                        }
                                                        if($goIn){
                                                            echo ")";
                                                        }
                                                    } ?>
                                                        <span class="add-image-gallery">
                                                            <!-- <a href="<?= base_url() ?>admin/edit-attribute/<?= $product_list['product_id']; ?>/<?= $list['item_id']; ?>">Edit Attributes</a> -->
                                                            <a style="cursor:pointer;color:black;" onclick="deleteItemData(this,'<?= $product_list['product_id']; ?>','<?= $list['item_id']; ?>');">Delete Attributes</a>
                                                        </span>
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="eventrow">
                                                        <div class="row mt-3">

                                                            <div class="col-lg-4 col-xs-6 b-r">
                                                                <label>SKU</label>
                                                                <br>
                                                                <p class="text-muted"><?= $list['item_no']; ?></p>
                                                            </div>
                                                            <div class="col-lg-4 col-xs-6 b-r">
                                                                <label>Price</label>
                                                                <br>
                                                                <p class="text-muted" ><?= number_format(($list['price'] - (($list['price'] * $list['discount']) / 100)), 2); ?> LYD</p>
                                                                <?php if ($list['discount'] > 0): ?>
                                                                    <p class="text-muted" style="text-decoration: line-through;"><?= number_format($list['price'], 2); ?> LYD</p>                                    
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="col-lg-4 col-xs-6 b-r">
                                                                <label>Product Discount</label>
                                                                <br>
                                                                <p class="text-muted"><?= $list['discount']; ?>%</p>
                                                            </div>
                                                            <div class="col-lg-4 col-xs-6 b-r">
                                                                <label>Quantity</label>
                                                                <br>
                                                                <p class="text-muted"><?= $list['quantity']; ?></p>
                                                            </div>
        <?php if ($list['attribute_data']): foreach ($list['attribute_data'] as $attr): ?>
                                                                    <div class="col-lg-4 col-xs-6 b-r">
                                                                        <label><?= $attr['attribute_name']; ?></label>
                                                                        <br>
                                                                        <p class="text-muted"><?= $attr['attribute_value']; ?></p>
                                                                    </div>
            <?php endforeach;
        endif;
        ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="eventrow">
                                                        <div class="row">
                                                            <?php if ($list['imagesArr']): foreach ($list['imagesArr'] as $imgArr): ?>
                                                                    <div class="col-lg-3 col-xs-6 b-r">
                                                                        <a href="#"><img src="<?= $imgArr['image']; ?>" alt="user" class="img-responsive"></a>
                                                                    </div>
            <?php endforeach;
        endif;
        ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    <?php endforeach;
endif;
?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="commissionModal" class="modal fade" role="dialog" data-backdrop="false">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
<!--            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="text-align-last: center">Register</h4>
            </div>-->
            <div class="modal-body">
                <form method="POST" id="regForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Product Commission</label>
                            <input type="number" value="<?= $product_list['commission'] ?>" min="0" max="100" class="form-control mb-4 regInputs" data-title="Commission" id="commission" name="commission" placeholder="Commission (%)">
                            <p class="errorPrint text-danger" id="commissionError"></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="updateCommission(this, <?= $product_list['product_id'] ?>);" id="add_product_set" class="composemail pull-right" style="padding:10px 15px !important;">Update</button>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteItemData(o, p, i) {
        var r = confirm("Are you sure to delete?");
        if (r == true) {
            if (p && i) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/home/ajax",
                    type: 'post',
                    data: 'method=deleteItemData&product_id=' + p + '&item_id=' + i,
                    success: function (data) {
                        var dt = $.trim(data);
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
            }
        }
    }
    
    function updateCommission(obj,id) {
        var commission = $('#commission').val();
        if (commission != "") {
                $.ajax({
                    url: "<?= base_url(); ?>admin/home/ajax",
                    type: 'post',
                    data: 'method=updateCommission&product_id=' + id + '&commission=' + commission,
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "200") {
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                $('#commissionError').css('display','block');
                $('#commissionError').html('* Commission is required field');
            }
    }
    
</script>
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
                                        <a href="<?=base_url('admin/edit-product-detail/'.$product_list['product_id']);?>" class="composemail pull-right"><i class="fa fa-edit"></i> Edit a product</a>
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
                                                    <p class="text-muted"><?=$product_list['category_name'];?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>Product SubCategory</label>
                                                    <br>
                                                    <p class="text-muted"><?=$product_list['sub_category_name'];?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>Product Brand</label>
                                                    <br>
                                                    <p class="text-muted"><?=$product_list['brand_name'];?></p>
                                                </div>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label>Product Model</label>
                                                    <br>
                                                    <p class="text-muted"><?=$product_list['model_name'];?></p>
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
                                                    <p class="text-muted"><?=$product_list['name'];?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Product Name(Ar)</label>
                                                    <br>
                                                    <p class="text-muted"><?=$product_list['name_ar'];?></p>
                                                </div>
                                                <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Product Discount</label>
                                                    <br>
                                                    <p class="text-muted"><?=$product_list['discount'];?>%</p>
                                                </div>
                                                <?php if($product_list['vendor_id']==0): ?>
                                                    <div class="col-lg-4 col-xs-6 b-r">
                                                        <label>Product From</label>
                                                        <br>
                                                        <p class="text-muted"><span style="background: red;color: #fff;padding: 3px;border-radius: 6px;"><?php if($product_list['product_from']==2){ echo "Dubai"; }else{ echo "Inventory"; } ?></span></p>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>Product Description : </label>
                                                    <br>
                                                    <p class="text-muted"><?=$product_list['description'];?></p>
                                                </div>
                                                <div class="col-lg-12 col-xs-12 b-r">
                                                    <label>Product Description(Ar) : </label>
                                                    <br>
                                                    <p class="text-muted"><?=$product_list['description_ar'];?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php if($product_list['product_specification']): ?>
                                <div class="eventdeatil">
                                    <div class="card-header">
                                        <h5 class="text-white m-b-0">Product Specification</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="eventrow">
                                            <div class="row mt-3">
                                                <?php foreach($product_list['product_specification'] as $list): ?>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label><?=$list['attribute_name'];?></label>
                                                    <br>
                                                    <p class="text-muted"><?=$list['attribute_value'];?></p>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($product_list['product_featuers']): ?>
                                <div class="eventdeatil">
                                    <div class="card-header">
                                        <h5 class="text-white m-b-0">Product Features</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="eventrow">
                                            <div class="row mt-3">
                                                <?php foreach($product_list['product_featuers'] as $list): ?>
                                                <div class="col-lg-3 col-xs-6 b-r">
                                                    <label><?=$list['name'];?></label>
                                                    <br>
                                                    <p class="text-muted"><?=$list['value'];?></p>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="step-tab-panel for-border-remove booking-detail" id="step2">
                                <?php if(isset($product_list['add_more_attribute']) and $product_list['add_more_attribute']): ?>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <a href="<?=base_url('admin/add-more-attribute/'.$product_list['product_id']);?>" class="composemail pull-right"><i class="fa fa-edit"></i>Add Attributes</a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($product_list['product_attribute_group']):
                                foreach($product_list['product_attribute_group'] as $key=>$list): ?>
                                <div class=" eventdeatil">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="text-white m-b-0">Item-<?=$key+1;?> 
                                                <span class="add-image-gallery">
                                                <a href="<?= base_url() ?>admin/edit-attribute/<?= $product_list['product_id']; ?>/<?= $list['item_id']; ?>">Edit Attributes</a>
                                                <!-- <a style="cursor:pointer;color:black;" onclick="deleteItemData(this,'<?= $product_list['product_id']; ?>','<?= $list['item_id']; ?>');">Delete Attributes</a> -->
                                                </span>
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="eventrow">
                                                <div class="row mt-3">

                                                    <div class="col-lg-4 col-xs-6 b-r">
                                                        <label>SKU</label>
                                                        <br>
                                                        <p class="text-muted"><?=$list['item_no'];?></p>
                                                    </div>
                                                    <div class="col-lg-4 col-xs-6 b-r">
                                                        <label>Price</label>
                                                        <br>
                                                        <p class="text-muted"><?=number_format($list['price'],2);?> LYD</p>
                                                        <?php if($product_list['discount']>0): ?>
                                                            <p class="text-muted" style="text-decoration: line-through;"><?=number_format(($list['price']-(($list['price']*$product_list['discount'])/100)),2);?> LYD</p>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="col-lg-4 col-xs-6 b-r">
                                                        <label>Quantity</label>
                                                        <br>
                                                        <p class="text-muted"><?=$list['quantity'];?></p>
                                                    </div>
                                                    <?php if($list['attribute_data']): foreach($list['attribute_data'] as $attr): ?>
                                                        <div class="col-lg-4 col-xs-6 b-r">
                                                            <label><?=$attr['attribute_name'];?></label>
                                                            <br>
                                                            <p class="text-muted"><?=$attr['attribute_value'];?></p>
                                                        </div>
                                                    <?php endforeach; endif;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="eventrow">
                                                <div class="row">
                                                    <?php if($list['imagesArr']): foreach($list['imagesArr'] as $imgArr): ?>
                                                        <div class="col-lg-3 col-xs-6 b-r">
                                                            <a href="#"><img src="<?=$imgArr['image'];?>" alt="user" class="img-responsive"></a>
                                                        </div>
                                                    <?php endforeach; endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function deleteItemData(o,p,i){
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
</script>
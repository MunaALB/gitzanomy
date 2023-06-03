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
        <h1>Edit Product Detail</h1>
    </div>
    <div class="content eventdeatil">  
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Product Information</h5>
                <a href="<?=base_url('vendor/add-new-product');?>" class="composemail pull-right" style="margin-top: -90px;">Add New Product</a>
            </div>
            <div class="card-body">
                <div class="eventrow">
                    <div class="row m-t-2">
                        <div class="col-md-6">
                            <label>Select Category</label>
                            <select class="chosen form-control">
                                <option value="<?= $product['category_id'] ?>"><?= $product['category_name'] ?></option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Select SubCategory</label>
                            <select class="chosen form-control">
                                <option value="<?= $product['sub_category_id'] ?>"><?= $product['sub_category_name'] ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content eventdeatil">  
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Product Information</h5>
            </div>
            <div class="card-body">
                <div class="eventrow">
                    <div class="row m-t-2">
                        <div class="col-md-6">
                            <label>Select Brand</label>
                            <select class="chosen form-control" <?= $product['brand_id'] ? '' : 'disabled' ?>>
                                <?php if ($product['brand_id']): ?>
                                    <option value="<?= $product['brand_id'] ?>"><?= $product['brand_name'] ?></option>
                                <?php else: ?>
                                    <option> Select Brand</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Select Model</label>
                            <select class="chosen form-control" <?= $product['model_id'] ? '' : 'disabled' ?>>
                                <?php if ($product['model_id']): ?>
                                    <option value="<?= $product['model_id'] ?>"><?= $product['model_name'] ?></option>
                                <?php else: ?>
                                    <option> Select Model</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post"  enctype="multipart/form-data">
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Basic Information</h5>
                </div>
                <div class="card-body">

                    <div class="eventrow"> 
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Name</label>
                                    <input class="form-control regInputs" data-title="Product Name" id="product_name" name="name" value="<?= $product['name'] ?>" type="text" placeholder="">
                                    <p class="errorPrint" id="product_nameError"></p>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Product Name (Ar)</label>
                                    <input class="form-control regInputs" data-title="Product Name (Ar)" id="product_name_ar" name="name_ar" value="<?= $product['name_ar'] ?>" type="text" placeholder="">
                                    <p class="errorPrint" id="product_name_arError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Discount (%)</label>
                                    <input class="form-control numberOnly discount" type="text" max="100" name="discount" placeholder="" value="<?= $product['discount'] ?>">
                                    <p class="errorPrint" id="discountError"></p>
                                </div>
                            </div>
                            <div class="col-md-6 mt-6">
                                <label>Expected Delivery</label>
                                <input type="number" min="1" id="expected_delivery" class="form-control mb-4 regInputs" value="<?= $product['expected_delivery'] ?>" name="expected_delivery" placeholder="Expected Delivery (in days)"  data-title="Expected Delivery">
                                <p class="errorPrint" id="expected_deliveryError"></p>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product Description</label>
                                    <textarea class="form-control regInputs" data-title="Description" id="description" name="description"  rows="5" placeholder="Write a Product Description..."><?= $product['description'] ?></textarea>
                                    <p class="errorPrint" id="descriptionError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Product Description (Ar)</label>
                                    <textarea class="form-control regInputs" data-title="Description (Ar)" id="description_ar" name="description_ar"  rows="5" placeholder="Write a Product Description..."><?= $product['description_ar'] ?></textarea>
                                    <p class="errorPrint" id="description_arError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Terms & Condition</label>
                                    <textarea class="form-control " data-title="Terms & Condition" id="terms" name="terms"  rows="5" placeholder="Write a Terms & Condition..."><?= $product['terms'] ?></textarea>
                                    <p class="errorPrint" id="termsError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Terms & Condition (Ar)</label>
                                    <textarea class="form-control " data-title="Terms & Condition (Ar)" id="terms_ar" name="terms_ar"  rows="5" placeholder="Write a Terms & Condition(Ar)..."><?= $product['terms_ar'] ?></textarea>
                                    <p class="errorPrint" id="terms_arError"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Is Returnable</label>
                                    <select id="is_returnable" onchange="isReturn(this);" class="form-control regInputs" name="is_returnable" data-title="Is Returnable">
                                        <option value="">--SELECT TYPE--</option>
                                        <option value="1" <?php if ($product['is_returnable'] == 1) {
                                    echo "selected";
                                } ?>>Yes</option>
                                        <option value="2" <?php if ($product['is_returnable'] == 2) {
                                    echo "selected";
                                } ?>>No</option>
                                    </select>
                                    <p class="errorPrint" id="is_returnableError"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Duration</label>
                                    <?php if ($product['is_returnable'] == 1): ?>
                                        <input class="form-control"  data-title="Duration" value="<?= $product['duration']; ?>" id="duration" name="duration" type="text" placeholder="">
<?php else: ?>
                                        <input class="form-control" readonly data-title="Duration" value="" id="duration" name="duration" type="text" placeholder="">
<?php endif; ?>
                                    <p class="errorPrint" id="durationError"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Return Policy</label>
                                    <?php if ($product['is_returnable'] == 1): ?>                                
                                        <textarea class="form-control"  data-title="Return Policy" id="return_policy" name="return_policy"  rows="5" placeholder="Return Policy..."><?= $product['return_policy']; ?></textarea>
<?php else: ?>
                                        <textarea class="form-control" readonly data-title="Return Policy" id="return_policy" name="return_policy"  rows="5" placeholder="Return Policy..."></textarea>
<?php endif; ?>
                                    <p class="errorPrint" id="return_policyError"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Return Policy (Ar)</label>
                                    <?php if ($product['is_returnable'] == 1): ?>                                
                                        <textarea class="form-control"  data-title="Return Policy (Ar)" id="return_policy_ar" name="return_policy_ar"  rows="5" placeholder="Return Policy(Ar)..."><?= $product['return_policy_ar']; ?></textarea>
<?php else: ?>
                                        <textarea class="form-control" readonly data-title="Return Policy (Ar)" id="return_policy_ar" name="return_policy_ar"  rows="5" placeholder="Return Policy(Ar)..."></textarea>
<?php endif; ?>
                                    <p class="errorPrint" id="return_policy_arError"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content eventdeatil">  
<?php
if (isset($product['attribute']) and $product['attribute']):
    foreach ($product['attribute'] as $key => $list):
        // echo '<pre/>';print_r($list);
        ?>
                        <input type="hidden" name="item_ids[]" value='<?= $list['item_id'] ?>'/>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Item-<?= $key + 1; ?></h5>
                            </div>
                            <div class="card-body">

                                <div class="card-body">
                                    <div class="eventrow"> 
                                        <div class="row m-t-2">
                                            <div class="col-lg-4 col-xs-6 b-r">
                                                <div class="form-group">
                                                    <label>Item-No</label>
                                                    <input class="form-control" name="item_id" value="<?= $list['item_id'] ?>" type="hidden">
                                                    <input class="form-control" readonly disabled data-title="Item Number" id="item_no<?= $list['item_id'] ?>" name="item_no[]" value="<?= $list['item_no'] ?>" type="text" placeholder="">
                                                    <p class="errorPrint" id="item_no<?= $list['item_id'] ?>Error"></p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-6 b-r">
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input class="form-control regInputs numberOnly" data-title="Price" id="price<?= $list['item_id'] ?>" name="price[]" value="<?= $list['price'] ?>" type="text" placeholder="">
                                                    <p class="errorPrint" id="price<?= $list['item_id'] ?>Error"></p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-6 b-r">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input class="form-control regInputs numberOnly" data-title="Quantity" id="quantity<?= $list['item_id'] ?>" name="quantity[]" value="<?= $list['quantity'] ?>" type="text" placeholder="">
                                                    <p class="errorPrint" id="quantity<?= $list['item_id'] ?>Error"></p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-xs-6 b-r">
                                                <div class="form-group">
                                                    <label for="">Discount (%)</label>
                                                    <input class="form-control" type="number" min="0" max="100" data-title="Discount" name="discount[]" id="discount<?= $list['item_id'] ?>" placeholder="" value="<?= $list['discount'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="eventrow">
                                            <div class="row m-t-2">
        <?php if ($list['imagesArr']): foreach ($list['imagesArr'] as $key => $imgArr): ?>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <!-- <input <?= $key == 0 ? "data-show-remove='false'" : "" ?> accept="image/*" onchange="validImage(this, 'image<?= $list['item_id'] ?><?= $key + 1 ?>');" type="file" class="dropify" data-title="Image-<?= $list['item_id'] ?><?= $key + 1 ?>" id="image<?= $list['item_id'] ?><?= $key + 1 ?>" name="image<?= $list['item_id'] ?>[]" data-default-file="<?= $imgArr['image'] ?>" /> -->
                                                                <input <?= $key == 0 ? "data-show-remove='false'" : "" ?> accept="image/*" type="file" class="dropify" data-title="Image-<?= $list['item_id'] ?><?= $key + 1 ?>" id="image<?= $list['item_id'] ?><?= $key + 1 ?>" name="image<?= $list['item_id'] ?>[]" data-default-file="<?= $imgArr['image'] ?>" />
                                                                <p class="errorPrint" id="image<?= $list['item_id'] ?><?= $key + 1 ?>Error"></p>
                                                            </div>
                                                        </div>
                <?php
            endforeach;
            if ($key < 3): for ($i = $key + 1; $i <= 3; $i++):
                    ?>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <!-- <input  <?= $i == 0 ? "data-show-remove='false'" : "" ?>  accept="image/*" onchange="validImage(this, 'image<?= $i + 1 ?>');" type="file" class="dropify" data-title="Image-<?= $i + 1 ?>" id="image<?= $list['item_id'] ?><?= $i + 1 ?>" name="image<?= $list['item_id'] ?>[]" /> -->
                                                                    <input  <?= $i == 0 ? "data-show-remove='false'" : "" ?>  accept="image/*" type="file" class="dropify" data-title="Image-<?= $i + 1 ?>" id="image<?= $list['item_id'] ?><?= $i + 1 ?>" name="image<?= $list['item_id'] ?>[]" />
                                                                    <p class="errorPrint" id="image<?= $list['item_id'] ?><?= $i + 1 ?>Error"></p>
                                                                </div>
                                                            </div>
                    <?php
                endfor;
            endif;
        endif;
        ?>
                                            </div>
                                            <!-- <div class="row mt-4">
                                                <div class="col-lg-12 col-xs-12">
                                                    <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right"> Update Attribute</button>
                                                    <button style="display:none;" id="add_product" type="submit" name="edit_product"  class="composemail save-length pull-right"> Update Attribute</button>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
    <?php endforeach;
endif; ?>
            </div>


            <div class="content eventdeatil" style="margin-top: -29px;">  
                <div class="card">
                    <div class="row mt-4">
                        <div class="col-lg-12 col-xs-12">
                            <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right" style="margin-bottom: 15px;margin-right: 11px;"> Update Product</button>
                            <button style="display:none;" id="add_product" type="submit" name="edit_product" class="composemail save-length pull-right"> Update Product</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--         
                    <div class="row mt-4">
                        <div class="col-lg-12 col-xs-12">
                            <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right"> Update Product</button>
                            <button style="display:none;" id="add_product" type="submit" name="edit_product"  class="composemail save-length pull-right"> Update Product</button>
                        </div>
                    </div> -->
    </form>
    <script>
        var formSubmitting = false;
        var setFormSubmitting = function () {
            formSubmitting = true;
        };

        function showErrorMessage(id, msg) {
            $("#" + id).empty();
            $("#" + id).append(msg);
            $("#" + id).css('display', 'block');
        }

        function addProduct(o) {
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
                setFormSubmitting();
                $("#add_product").click();
            }
        }
        function setProductName(o) {
            var productName = $(o).find(':selected').text();
            //alert(productName);
            if (productName) {
                $("#product_name").val(productName);
                $("#product_name").attr('readonly', true);
            } else {
                $("#product_name").val();
                $("#product_name").attr('readonly', false);
            }
        }




        window.onload = function () {
            window.addEventListener("beforeunload", function (e) {
                if (formSubmitting) {
                    return undefined;
                }
                e = (e || window.event);
                var confirmationMessage = "Are you sure you want to leave, you haven't saved your progess!";
                e.returnValue = confirmationMessage; //Gecko + IE

                return confirmationMessage; //Gecko + Webkit, Safari, Chrome etc.
            });
            window.onbeforeunload = null;
        };


        function validImage(obj, i) {
            var _URL = window.URL || window.webkitURL;
            var file = $(':input[type="file"]').prop('files')[0];
            var img = new Image();
            img.onload = function () {
                var wid = this.width;
                var ht = this.height;
                //alert(wid+'&'+ht);
                if ((wid < 450 || wid > 500) || ht !== 500) {
                    $('#add_product_set').attr('disabled', true);
                    showErrorMessage(i + 'Error', 'Preferred Image Dimension 500X500 pixels');
                } else {
                    $('#add_product_set').attr('disabled', false);
                    $('#' + i + 'Error').html('');
                }
            };
            img.src = _URL.createObjectURL(file);
        }

    </script>
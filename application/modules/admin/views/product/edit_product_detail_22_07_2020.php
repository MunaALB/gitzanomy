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
<form method="POST" id="uploadProduct" enctype="multipart/form-data">
    <div class="content eventdeatil">  
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Product Information</h5>
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
                        <?php if($product['vendor_id']==0){
                            $divCLass="col-md-4"; ?>
                             <div class="<?=$divCLass;?>">
                                <label>Product From</label>
                                <select id="product_from" class="form-control regInputs" name="product_from" data-title="Product From">
                                    <option value="">--SELECT TYPE--</option>
                                    <option value="1" <?php if($product['product_from']==1){ echo "selected"; } ?>>Inventory</option>
                                    <option value="2" <?php if($product['product_from']==2){ echo "selected"; } ?>>Dubai</option>
                                </select>
                                <p class="errorPrint" id="product_fromError"></p>
                            </div>
                        <?php }else{
                            $divCLass="col-md-6"; ?>
                            <input class="form-control" style="display:none;" name="product_from" value="0" type="text">
                        <?php } ?>
                       
                        <div class="<?=$divCLass;?>">
                            <label>Select Brand</label>
                            <select class="chosen form-control" <?= $product['brand_id'] ? '' : 'disabled' ?>>
                                <?php if ($product['brand_id']): ?>
                                    <option value="<?= $product['brand_id'] ?>"><?= $product['brand_name'] ?></option>
                                <?php else: ?>
                                    <option> Select Brand</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="<?=$divCLass;?>">
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
                                <input class="form-control" type="number" min="0" max="100" name="discount" placeholder="" value="<?= $product['discount'] ?>">
                            </div>
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
                                <textarea class="form-control regInputs" data-title="Terms & Condition" id="terms" name="terms"  rows="5" placeholder="Write a Terms & Condition..."><?= $product['terms'] ?></textarea>
                                <p class="errorPrint" id="termsError"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Terms & Condition (Ar)</label>
                                <textarea class="form-control regInputs" data-title="Terms & Condition (Ar)" id="terms_ar" name="terms_ar"  rows="5" placeholder="Write a Terms & Condition(Ar)..."><?= $product['terms_ar'] ?></textarea>
                                <p class="errorPrint" id="terms_arError"></p>
                            </div>
                        </div>
                    </div>
                
                    <div class="row mt-4">
                        <div class="col-lg-12 col-xs-12">
                            <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right"> Submit</button>
                            <button style="display:none;" id="add_product" type="submit" name="edit_product"  class="composemail save-length pull-right">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <script>
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
    </script>
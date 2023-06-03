<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="content-wrapper">
<form method="POST" id="uploadProduct" enctype="multipart/form-data">
            <div class="content-header sty-one">
                <h1>Add More Attributes </h1>
            </div>
            <div class="content eventdeatil">  
                <div class="card">
                    <div class="card-header">
                       <h5 class="card-title">Product Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="eventrow">
                            <div class="row mt-3">
                                <div class="col-lg-3 col-xs-6 b-r">
                                    <label>Product Category</label>
                                    <br>
                                    <p class="text-muted"><?=$products['category_name']?></p>
                                </div>
                                <div class="col-lg-3 col-xs-6 b-r">
                                    <label>Product SubCategory</label>
                                    <br>
                                    <p class="text-muted"><?=$products['sub_category_name']?></p>
                                </div>
                                <div class="col-lg-3 col-xs-6 b-r">
                                    <label>Product Brand</label>
                                    <br>
                                    <p class="text-muted"><?=$products['brand_name']?></p>
                                </div>
                                <div class="col-lg-3 col-xs-6 b-r">
                                    <label>Product Modal</label>
                                    <br>
                                    <p class="text-muted"><?=$products['model_name']?></p>
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
                            <div class="row mt-3">
                                <div class="col-lg-3 col-xs-6 b-r">
                                    <label>Product Name</label>
                                    <br>
                                    <p class="text-muted"><?=$products['name']?></p>
                                </div>
                            
                                <div class="col-lg-12 col-xs-12 b-r">
                                    <label>Product Description : </label>
                                    <br>
                                    <p class="text-muted"><?=$products['description']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content eventdeatil">  
                <div class="card">
                    <div class="card-header">
                       <h5 class="card-title">Product Attributes</h5>
                    </div>
                    <div class="card-body">
                        <div class="eventrow">
                            <div class="row m-t-2">
                            <?php if($attribute): $i=0; foreach($attribute as $attr): $i++; ?>
                                <div class="col-md-6 m-b-3">
                                <input type=hidden value="<?=$attr['attribute_id'];?>" name="attribute[]">
                                   <label><?=$attr['name'];?></label>
                                       <select class="chosen form-control regInputs" name="attribute_value[]" data-title="<?=$attr['name'];?>" id="<?=$attr['name'].'_'.$i;?>">
                                           <option value="">Select Value</option>
                                           <?php if($attr['attribute_value']): foreach($attr['attribute_value'] as $value): ?>
                                           <option value="<?=$value['attribute_value_id'];?>"><?=$value['value'];?></option>
                                           <?php endforeach; endif; ?>
                                       </select>
                                       <p class="errorPrint" id="<?=$attr['name'].'_'.$i;?>Error"></p>
                                </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content eventdeatil">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-white m-b-0">Product Detail</h5>
                    </div>
                    <div class="card-body">
                        <div class="eventrow">
                            <div class="row m-t-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No of Stock</label>
                                        <input class="form-control regInputs" data-title="Stock" id="stock" name="stock" type="text" placeholder="">
                                        <p class="errorPrint" id="stockError"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">SKU</label>
                                        <input class="form-control regInputs" data-title="Sku-Id" id="sku" name="sku" type="text" placeholder="">
                                        <p class="errorPrint" id="skuError"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Price</label>
                                        <input class="form-control regInputs" data-title="Price" id="price" name="price" type="text" placeholder="">
                                        <p class="errorPrint" id="priceError"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Product Discount</label>
                                        <input class="form-control" data-title="Discount" id="discount" name="discount" type="text" placeholder="">
                                        <p class="errorPrint" id="discountError"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content eventdeatil">  
                <div class="card">
                   <div class="card-header">
                       <h5 class="card-title">Product Images 
                            <!-- <span class="add-image-gallery"><a href="#galleryimageupload" data-toggle="modal" class="text white  mybtns">Add Image from Gallery</a></span> -->
                       </h5>
                    </div>
                    <div class="card-body">
                        <div class="eventrow">
                            <div class="row m-t-2">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <!-- <input onchange="validImage(this,'image1');" type="file" class="dropify regInputs" data-title="Image-1" id="image1" name="image[]" /> -->
                                        <input type="file" class="dropify regInputs" data-title="Image-1" id="image1" name="image[]" />
                                        <p class="errorPrint" id="image1Error"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <!-- <input onchange="validImage(this,'image2');" type="file" class="dropify regInputs" data-title="Image-2" id="image2" name="image[]" /> -->
                                        <input type="file" class="dropify" data-title="Image-2" id="image2" name="image[]" />
                                        <p class="errorPrint" id="image2Error"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <!-- <input onchange="validImage(this,'image3');" type="file" class="dropify" data-title="Image-3" id="image3" name="image[]" /> -->
                                        <input type="file" class="dropify" data-title="Image-3" id="image3" name="image[]" />
                                        <p class="errorPrint" id="image3Error"></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <!-- <input onchange="validImage(this,'image4');" type="file" class="dropify" data-title="Image-4" id="image4" name="image[]"/> -->
                                        <input type="file" class="dropify" data-title="Image-4" id="image4" name="image[]"/>
                                        <p class="errorPrint" id="image4Error"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12 col-xs-12">
                                    <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right"> Upload Product</button>
                                    <button style="display:none;" id="add_product" type="submit" name="add_product"  class="composemail save-length pull-right"> Upload Product</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade modal-design" id="productupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="messege-box">
                                    <img src="http://gropse.com/gropse.com/design/mydesign/zanomy.admin/assets/admin/images/uploadproduct.png" alt="success messege">
                                    <h3>Your Product has been uploaded Successfully</h3>
                                    <p>Do you want to upload more specification</p>
                             </div>
                             <div class="action-button">
                                    <a href="http://gropse.com/gropse.com/design/mydesign/zanomy.admin/admin/add-more-attributes" class="btn btn-primary mybtns">Yes</a>
                                    <button type="submit" class="btn btn-primary mybtns" data-dismiss="modal">Skip</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="modal fade modal-design" id="galleryimageupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="upload-images">
                                <div class="eventrow">
                                    <div class="row">
                                        <div class="col-lg-3 col-xs-6 b-r">
                                            <a href="#"><img src="http://gropse.com/gropse.com/design/mydesign/zanomy.admin/assets/admin/images/dummy.jpg" alt="user" class="img-responsive "></a>
                                        </div>
                                        <div class="col-lg-3 col-xs-6 b-r">
                                            <a href="#"><img src="http://gropse.com/gropse.com/design/mydesign/zanomy.admin/assets/admin/images/dummy.jpg" alt="user" class="img-responsive "></a>
                                        </div>
                                        <div class="col-lg-3 col-xs-6 b-r">
                                            <a href="#"><img src="http://gropse.com/gropse.com/design/mydesign/zanomy.admin/assets/admin/images/dummy.jpg" alt="user" class="img-responsive "></a>
                                        </div>
                                        <div class="col-lg-3 col-xs-6 b-r">
                                            <a href="#"><img src="http://gropse.com/gropse.com/design/mydesign/zanomy.admin/assets/admin/images/dummy.jpg" alt="user" class="img-responsive "></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="action-button mt-4">
                                    <button type="submit" class="btn btn-primary mybtns">Upload</button>
                                    <button type="submit" class="btn btn-primary mybtns" data-dismiss="modal">Skip</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            <form>
</div>
<script>
function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }
function addProduct(o){
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
    function validImage(obj,i) {
        var _URL = window.URL || window.webkitURL;
        var file = $(':input[type="file"]').prop('files')[0];
        var img = new Image();
        img.onload = function () {
            var wid = this.width;
            var ht = this.height;
            //alert(wid+'&'+ht);
            if ((wid < 450 || wid > 500) || ht !== 500) {
                $('#add_product_set').attr('disabled',true);
                showErrorMessage(i+'Error','Preferred Image Dimension 500X500 pixels');
            } else {
                $('#add_product_set').attr('disabled',false);
                $('#'+i+'Error').html('');
            }
        };
        img.src = _URL.createObjectURL(file);
    }
</script>
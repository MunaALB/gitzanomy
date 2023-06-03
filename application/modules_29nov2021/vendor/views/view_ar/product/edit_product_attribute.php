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
        <h1>Edit Product Attribute </h1>
    </div>
    <div class="content eventdeatil">
        <div class="card">
            <div class=" eventdeatil">
                <div class="card">
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="eventrow"> 
                                <div class="row m-t-2">
                                    <div class="col-lg-4 col-xs-6 b-r">
                                        <div class="form-group">
                                            <label>Item-No</label>
                                            <input class="form-control" name="item_id" value="<?= $list['item_id'] ?>" type="hidden">
                                            <input class="form-control regInputs" data-title="Item Number" id="item_no" name="item_no" value="<?= $list['item_no'] ?>" type="text" placeholder="">
                                            <p class="errorPrint" id="item_noError"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-6 b-r">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input class="form-control regInputs numberOnly" data-title="Price" id="price" name="price" value="<?= $list['price'] ?>" type="text" placeholder="">
                                            <p class="errorPrint" id="priceError"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-6 b-r">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input class="form-control regInputs numberOnly" data-title="Quantity" id="quantity" name="quantity" value="<?= $list['quantity'] ?>" type="text" placeholder="">
                                            <p class="errorPrint" id="quantityError"></p>
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
                                                        <input <?= $key == 0 ? "data-show-remove='false'" : "" ?> accept="image/*" onchange="validImage(this, 'image<?= $key + 1 ?>');" type="file" class="dropify" data-title="Image-<?= $key + 1 ?>" id="image<?= $key + 1 ?>" name="image[]" data-default-file="<?= $imgArr['image'] ?>" />
                                                        <p class="errorPrint" id="image<?= $key + 1 ?>Error"></p>
                                                    </div>
                                                </div>
                                                <?php
                                            endforeach;
                                            if ($key < 3): for ($i = $key + 1; $i <= 3; $i++):
                                                    ?>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <input  <?= $i == 0 ? "data-show-remove='false'" : "" ?>  accept="image/*" onchange="validImage(this, 'image<?= $i + 1 ?>');" type="file" class="dropify" data-title="Image-<?= $i + 1 ?>" id="image<?= $i + 1 ?>" name="image[]" />
                                                            <p class="errorPrint" id="image<?= $i + 1 ?>Error"></p>
                                                        </div>
                                                    </div>
                                                    <?php
                                                endfor;
                                            endif;
                                        endif;
                                        ?>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-lg-12 col-xs-12">
                                            <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right"> Update Attribute</button>
                                            <button style="display:none;" id="add_product" type="submit" name="edit_product"  class="composemail save-length pull-right"> Update Attribute</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

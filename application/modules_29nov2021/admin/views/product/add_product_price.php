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
        <h1>Add Product Price</h1>
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
                                <select class="form-control chosen regInputs" data-title="Category" id="category" name="category_id" >
                                    <option value="">--SELECT CATEGORY--</option>
                                    <?php if ($category_list): foreach ($category_list as $list): ?>
                                            <option value="<?= $list['category_id']; ?>"><?= $list['name']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <p class="errorPrint" id="categoryError"></p>
                            </div>
                            <div class="col-md-6">
                                <label>Select Product</label>
                                <select class="form-control chosen regInputs" data-title="Product" id="product" name="product" >
                                    <option value="">--SELECT PRODUCT--</option>
                                    <option value="1">Admin Product</option>
                                    <option value="2">All Product</option>
                                </select>
                                <p class="errorPrint" id="productError"></p>
                            </div>
                            
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <label>Select TYPE</label>
                                <select class="form-control chosen regInputs" data-title="Type" id="type" name="type" >
                                    <option value="">--SELECT TYPE--</option>
                                    <option value="1">Increase</option>
                                    <option value="2">Decrease</option>
                                </select>
                                <p class="errorPrint" id="typeError"></p>
                            </div>
                            <div class="col-md-6">
                                <label>Value(in %)</label>
                                <input type="number" id="value" class="form-control mb-4 regInputs" name="value" placeholder="Value"  data-title="Value">
                                <p class="errorPrint" id="valueError" style="    margin-top: -23px;"></p>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xs-12">
                                <button type="button" id="add_product_set" onclick="addProduct(this);" class="composemail save-length pull-right"> Update</button>
                                <button style="display:none;" id="add_product" type="submit" name="add_product"  class="composemail save-length pull-right"> Upload Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if (($this->session->flashdata('response'))) {
        echo $this->session->flashdata('response');
        ?>

    <?php } ?>


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
            var value=$.trim($("#value").val());
            if(value<100 && value>0){
                $("#add_product").click();
            }else{
                $("#valueError").empty();
                $("#valueError").append('*invalid value (should be 1-99)');
                $("#valueError").css('display', 'block');
            }
        }
    }
    
</script>

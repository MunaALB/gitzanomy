<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Edit  Service </h1>
    </div>
    <form method="post" enctype="multipart/form-data" id="addForm">
        <div class="content eventdeatil">  
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Service Information</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <label>Service Category</label>
                                <select class="chosen form-control validate" name="category_id">
                                    <option selected disabled>Select</option>
                                    <?php foreach ($category as $cat): if ($cat['category_id'] == $service['category_id']): ?>
                                            <option value="<?= $cat['category_id'] ?>" selected><?= $cat['name'] ?></option>
                                            <?php
                                        endif;
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Service SubCategory</label>
                                <select class="chosen form-control validate" name="sub_category_id">
                                    <option selected disabled>Select</option>
                                    <?php foreach ($category as $cat): if ($cat['category_id'] == $service['category_id']):foreach ($cat['sub_category'] as $s_cat):if ($s_cat['sub_category_id'] == $service['sub_category_id']): ?>
                                                    <option selected value="<?= $s_cat['sub_category_id'] ?>"><?= $s_cat['name'] ?></option>
                                                    <?php
                                                endif;
                                            endforeach;
                                        endif;
                                    endforeach;
                                    ?>
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
                                    <label for="">Service Name</label>
                                    <span class="text-danger" id="name"></span>
                                    <input class="form-control validate" type="text" placeholder="" name="name" value="<?= $service['name'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Service Name (Ar)</label>
                                    <span class="text-danger" id="name_ar"></span>
                                    <input class="form-control validate" type="text" placeholder="" name="name_ar" value="<?= $service['name_ar'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Service Price</label>
                                    <span class="text-danger" id="price"></span>
                                    <input class="form-control validate numberOnly" type="text" placeholder=""name="price" value="<?= $service['price'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Service Discount (%)</label>
                                    <span class="text-danger" id="discountError"></span>
                                    <input class="form-control numberOnly discount"  max="100" type="text" placeholder=""name="discount" value="<?= $service['discount'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Service Description</label>
                                    <span class="text-danger" id="description"></span>
                                    <textarea class="form-control validate" name="description" rows="5" placeholder="Write a Product Description..."><?= $service['description'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Service Description (Ar)</label>
                                    <span class="text-danger" id="description_ar"></span>
                                    <textarea class="form-control validate" name="description_ar" rows="5" placeholder="Write a Product Description..."><?= $service['description_ar'] ?></textarea>
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
                    <h5 class="card-title">Service Features</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2" id='featureDiv'>
                            <?php if ($service_feature):foreach ($service_feature as $feature): ?>
                                    <div class="col-md-12 m-b-3">
                                        <div class="form-group">
                                            <input class="form-control features" type="text" placeholder="" name='features[]' value='<?= $feature["featues"] ?>'>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12 m-b-3">
                                <div class="addmore-part">
                                    <a  style="cursor:pointer" onclick="addFeature(this);"  class="composemail save-length pull-right"> Add More Feature</a>
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
                    <h5 class="card-title">Service Image</h5>
                </div>
                <div class="card-body">
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="file" onchange="validImage(this, 'image1');" accept="image/*" id="input-file-now-custom-2" name='image' class="dropify" data-default-file="<?= $service['image'] ?>"/>
                                    <p class="errorPrint text-danger" id="image1Error"></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12 col-xs-12">
                                <button type="button" id="add_product_set" onclick="validate(this);" class="composemail save-length pull-right"> Update Service</button>
                                <!--<a style="cursor: pointer;" onclick="validate(this);" id="add_product_set" class="composemail save-length pull-right"> Update Service</a>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    function showErrorMessage(id, msg) {
        $("#" + id).empty();
        $("#" + id).append(msg);
        $("#" + id).css('display', 'block');
    }
    function validate(obj) {
        var flag = true;
        var formData = $("#addForm").find('.validate:input').not(':input[type=button]');
        var featureData = $("#addForm").find('.features:input');
        $(formData).each(function () {
            var element = $(this);
            var val = element.val();
            var name = element.attr('name');
            if (val == '' || val == '0' || val == null) {
                $('#' + name).html('* required field');
                flag = false;
            } else {
                $('#' + name).html('');
            }
        });

        if (featureData[0]['value'] == '') {
            $('#features').html('minimum one feature is required');
        } else {
            $('#features').html('');
        }
        if (flag) {
            $("#addForm").submit();
        } else {
            return false;
        }
    }

    function addFeature(obj) {
        var html = '<div class="col-md-12 m-b-3"><div class="form-group"><input class="form-control features" type="text" placeholder="" name="features[]"></div></div>';
        $('#featureDiv').append(html);
    }

    function validImage(obj, i) {
        var _URL = window.URL || window.webkitURL;
        var file = $(':input[type="file"]').prop('files')[0];
        var img = new Image();
        img.onload = function () {
            var wid = this.width;
            var ht = this.height;

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
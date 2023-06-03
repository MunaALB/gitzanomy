<style>
    .widget-user-image{
        height:100px;
        width:100px;
    }
    .widget-user-image img{
        width:100%;
        height:100%;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Edit My Profile</h1> 
    </div>
    <div class="content eventdeatil"> 
        <div class="card">
            <div class="card-body">

                <div class="eventrow">
                    <p id="error" class="text-danger"></p>
                    <form id="edit_profile" method="post" enctype="multipart/form-data">
                        <?= $this->session->flashdata('response'); ?>
                        <div class="row mb-5">
                            <div class="col-lg-6 col-xs-6 b-r offset-3 "> 
                                <label>Profile Image : </label>
                                <p id="image1" class="text-danger"></p>
                                <div class="widget-user-image"> 

                                    <img class="img-circle" id="image" src="<?= $vendor['image'] ? $vendor['image'] : base_url() . 'assets/vendor/images/user.png' ?>" alt="User Avatar"> 
                                    <input type="file" accept="image/*" onchange="validImage(this, 1);" class="form-control" hidden name="image" id="imageUpload">
                                    <label class="btn btn-default btn-sm  mt-2" for="imageUpload">Upload Image</label>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-6 b-r offset-3"> <label>Full Name : </label> 
                                <span id="name" class="text-danger"></span>
                                <input type="text" class="form-control" name="name" value="<?= $vendor['name'] ?>" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-xs-2 b-r offset-3"> <label>Country Code : </label>
                                <!--<select name="country_code" class="form-control" id="country_codess">-->
                                <!--    <option value="218">+218</option>-->
                                <!--</select>-->
                                <input type="text" class="form-control" readonly="" value="+218" style="cursor:no-drop">
                            </div> 
                            <div class="col-lg-4 col-xs-4 b-r"> <label>Mobile Number : </label>
                                <span id="mobile" class="text-danger"></span>
                                <input type="text" class="form-control" name="mobile" value="<?= $vendor['mobile'] ?>" placeholder="Mobile Number">  
                            </div> 
                        </div> 
                        <?php if ($vendor['business_type'] == 2) : ?>
                            <div class="row">
                                <div class="col-lg-6 col-xs-6 offset-3">
                                <label>Availability </label>
                                </div>
                                <div class="col-lg-3 col-xs-3 b-r offset-3">
                                    <label>Open time : </label>
                                    <span id="start_time" class="text-danger"></span>
                                    <div class="form-group">
                                        <input type="time" name="start_time" value="<?= $vendor['start_time'] ?>" class="form-control" placeholder="Start time" />                                                
                                    </div>
                                </div>
                                <div class="col-lg-3 col-xs-3 b-r">
                                    <label>Close time : </label>
                                    <span id="end_time" class="text-danger"></span>
                                    <div class="form-group">
                                        <input type="time" name="end_time" value="<?= $vendor['end_time'] ?>" class="form-control" placeholder="End time" />
                                    </div>
                                    <span id="end_timeError" class="text-danger"></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-lg-6 col-xs-6 b-r offset-3"> 
                                <div class="mt-3 mb-4 pull-right">
                                    <button style="cursor:pointer;" type="button" onclick="validate();" id="submitBtn" class="composemail ">Submit</button>
                                </div>
                            </div>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo site_url('assets/vendor/js/jquery.min.js'); ?>"></script>
<script>
                                        $(document).ready(function () {
                                            var c_code = "<?= $vendor['country_code'] ?>";
                                            $.ajax({
                                                url: 'https://restcountries.eu/rest/v2/all',
                                                success: function (data) {
                                                    var dt = $.trim(data);
                                                    var jsonData = data;
                                                    $(jsonData).each(function () {
                                                        var country = this;
                                                        $(country['callingCodes']).each(function () {
                                                            var code = this;
                                                            if (code != "") {
                                                                var option = '<option ' + (c_code == code ? 'selected' : '') + ' value="' + code + '">+' + code + '</option>';
                                                                $("#country_codes").append(option);
                                                            }
                                                        });

                                                    });
                                                }
                                            });
                                        });
                                        $("#imageUpload").change(function () {
                                            var input = this;
                                            if (input.files && input.files[0]) {
                                                var reader = new FileReader();
                                                reader.onload = function (e) {
                                                    $('#image').attr('src', e.target.result);
                                                };

                                                reader.readAsDataURL(input.files[0]);
                                            }
                                        });

                                        function validate(obj) {
                                            var flag = true;
                                            var formData = $("#edit_profile").find(':input').not(':input[type=button],input[type=file]');
                                            $(formData).each(function () {
                                                var element = $(this);
                                                var val = element.val();
                                                var name = element.attr('name');
                                                if (val == '' || val == '0' || val == null) {
                                                    $('#' + name).html('* required field');
                                                    flag = false;
                                                } else {
                                                    if (name == 'mobile') {
                                                        if (val.length < '8' || val.length > '15') {
                                                            flag = false;
                                                            $('#' + name).html('mobile is invalid.');
                                                        } else {
                                                            $('#' + name).html('');
                                                        }
                                                    } else {
                                                        $('#' + name).html('');
                                                    }

                                                }
                                            });
                                            if (($(":input[name='start_time']").val() && $(":input[name='end_time']").val()) && ($(":input[name='start_time']").val() == $(":input[name='end_time']").val())) {
                                                $('#end_timeError').html('End time cannot be same as start time');
                                                flag = false;
                                            }
                                            if (flag) {
                                                $('#edit_profile').submit();
                                            } else {
                                                return false;
                                            }
                                        }

                                        function validImage(obj, i) {
                                            var _URL = window.URL || window.webkitURL;
                                            var file = $(':input[type="file"]').prop('files')[0];
                                            var img = new Image();
                                            img.onload = function () {
                                                var wid = this.width;
                                                var ht = this.height;
                                                if ((200 <= wid && wid <= 250) && (200 <= ht && ht <= 250)) {
                                                    $('#submitBtn').attr('disabled', false);
                                                    $('#image1').html('');
                                                } else {
                                                    $('#submitBtn').attr('disabled', true);
                                                    $('#image1').html('Preferred Image Dimension 200X200 pixels');
//                                                    showErrorMessage('input-file-now-custom-1Error', 'Preferred Image Dimension 1920X620 pixels');
                                                }
                                            };
                                            img.src = _URL.createObjectURL(file);
                                        }
</script>
<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="main-container container" id="registrationForm">
    <ul class="breadcrumb">
        <li><a href="<?=base_url();?>"><i class="fa fa-home"></i></a></li>
        <li><a href="<?=base_url('ar/user-login');?>">حسابي</a></li>
        <li><a href="#">كلمة سر المنسية</a></li>
    </ul>
    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="page-login forgotpassword">
                <div class="account-border">
                    <div class="row">
                        <form action="<?php echo base_url('ar/verify-otp'); ?>" >
                            <div class="col-sm-6 customer-login col-sm-offset-3">
                                <div class="well">
                                    <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> نسيت كلمة السر</h2>
                                    <p><strong>استعادة كلمة السر الخاصة بك عن طريق تأكيد هاتفك</strong></p>
                                    <div class="form-group forninlines">
                                        <label class="control-label ">رقم الهاتف</label>
                                        <div class="mobileno-group">
                                        <input type="text" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " id="mobile" class="form-control regInputs" data-title="رقم الهاتف" />
                                        <input type="text" id="country_code" class="form-control regInputs" value="+218" style="width:15%;float: right;cursor:no-drop;" readonly/>
                                        <p class="errorPrint" id="mobileError"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom-form">
                                    <a href="<?php echo base_url('ar/user-login'); ?>" class="forgot">العودة لتسجيل الدخول</a>
                                    <input type="button" onclick="ForgotPassword(this);" value="إرسال" class="btn btn-default pull-left" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-container container" id="verificationForm" style="display:none;">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">حسابي</a></li>
        <li><a href="#">تأكيد الرمز المرسل الى الهاتف</a></li>
    </ul>
    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="page-login forgotpassword">
                <div class="account-border">
                    <div class="row">
                        <form action="">
                            <div class="col-sm-6 customer-login col-sm-offset-3">
                                <div class="well">
                                    <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> تحقق من  الرمز المرسل الى الهاتف وإعادة تعيين كلمة المرور</h2>
                                    <p><strong>استعادة كلمة السر الخاصة بك عن طريق تأكيد الرمز المرسل الى الهاتف</strong></p>
                                    <div class="form-group">
                                        <p class="errorPrint" id="verificationGenericError"></p>
                                        <label class="control-label">أدخل الرمز المرسل الى الهاتف هنا</label>
                                        <input type="text" id="otp" class="form-control">
                                        <p class="errorPrint" id="otpError"></p>
                                    </div>
                                </div>
                                <div class="bottom-form">
                                    <a onclick="resendOtp(this);" style="cursor:pointer;" class="forgot">إعادة إرسال الرمز الى الهاتف</a>
                                    <input type="button" onclick="verifyOtp(this);" value="تأكيد الرمز المرسل الى الهاتف" class="btn btn-default pull-right">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var baseUrl="<?=$base_url;?>";
    function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }
    function ForgotPassword(obj){
        $(".errorPrint").css('display', 'none');
        var mobile=$("#mobile").val();
        var country_code='218';
        if (mobile && country_code) {
            var reg_form_data = new FormData();
            reg_form_data.append("mobile",mobile);
            reg_form_data.append("country_code",country_code);
            reg_form_data.append("is_web",'2');
            $.ajax({
                url: baseUrl+'createOtpMobile',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    //console.log('asasasas' , returnObject);
                    if (returnObject.error_code == 200) {
                        showErrorMessage('verificationGenericError',returnObject.message);
                        $("#registrationForm").slideUp('slow');
                        $("#verificationForm").slideDown('slow');
                        $("#otp").val('');
                        $("#otp").val(returnObject['data']['otp']);
                    }else if(returnObject.error_code == 201){
                        showErrorMessage('mobileError',returnObject.message);
                    }else{
                        showErrorMessage('mobileError',returnObject.message);
                    }
                },
                error: function (error) {
                     alert("error");
                }
            });
        } else {
            showErrorMessage('mobileError',"*رقم الجوال مطلوب.");
        }
    }
    function resendOtp(obj){
        $(".errorPrint").css('display', 'none');
        if ($("#mobile").val()) {
            $("#verificationGenericError").css('display', 'none');
            var reg_form_data = new FormData();
            reg_form_data.append("country_code",'218');
            reg_form_data.append("mobile",$("#mobile").val());
            reg_form_data.append("is_web",'2');
             $.ajax({
                url: baseUrl+'createOtpMobile',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse(data);
                    //console.log('asasasas' , returnObject);
                    if (returnObject.error_code == 200) {
                       showErrorMessage('verificationGenericError',returnObject.message);
                       $("#otp").val('');
                        $("#otp").val(returnObject['data']['otp']);
                    }else if(returnObject.error_code == 201){
                        showErrorMessage('verificationGenericError',returnObject.message);
                    }else{
                        showErrorMessage('verificationGenericError',returnObject.message);
                    }
                },
                error: function (error) {
                     alert("error");
                }
            });
        } else {
            showErrorMessage('verificationGenericError',returnObject.message);
        }
    }
    function verifyOtp(obj){
        $(".errorPrint").css('display', 'none');
        var country_code='218';
        var mobile=$("#mobile").val();
        var otp=$("#otp").val();
        var milliseconds = new Date().getTime();
        if (country_code && mobile && otp) {
            var reg_form_data = new FormData();
            reg_form_data.append("mobile",mobile);
            reg_form_data.append("country_code",country_code);
            reg_form_data.append("otp",otp);
            reg_form_data.append("device_type","3");
            reg_form_data.append("device_id",milliseconds);
            reg_form_data.append("device_token",milliseconds);
            reg_form_data.append("is_web",'2');
             $.ajax({
                url: baseUrl+'verifyOtpMobile',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    //console.log('asasasas' , returnObject);
                    if (returnObject.error_code == 200) {
                        $.ajax({
                                url: "<?php echo base_url("/web/Web/ajax") ?>",
                                type: "POST",
                                data: "method=login&user_id=" + returnObject.data.user_id+'&device_id='+returnObject.data.device_id+'&security_token='+returnObject.data.security_token,
                                success: function (data) {
                                    var dta = $.trim(data);
                                    var jsonData = $.parseJSON(dta);
                                    if (jsonData['error_code'] == 200) {
                                       alert(returnObject.message);
                                        window.location.href="<?=base_url('ar/reset-password');?>";
                                    } else {
                                        alert("Some error found");
                                    }
                                }
                            })
                       //alert(returnObject.message);
                       //window.location.href="<?=base_url();?>";
                    }else{
                        showErrorMessage('otpError',returnObject.message);
                    }
                },
                error: function (error) {
                     alert("error");
                }
            });
        } else {
            if(email){
                showErrorMessage('otpError',"*يجب تأكيد الرمز المرسل لهاتفك");
            }else{
                showErrorMessage('otpError',"*رقم الجوال مطلوب.");
            }
        }
    }
    
    function showHide(obj,i){
        var check=$(obj).attr('data-count');
        if(check==1){
            $("#"+i).attr('type','text');
            $(obj).attr('data-count','0');
            $(obj).removeClass('fa-eye');
            $(obj).addClass('fa-eye-slash');
        }else{
            $("#"+i).attr('type','password');
            $(obj).attr('data-count','1');
            $(obj).removeClass('fa-eye-slash');
            $(obj).addClass('fa-eye');
        }
    }
</script>
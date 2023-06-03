<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: block;
    }
</style>  


<div class="main-container container" id="registrationForm">
    <ul class="breadcrumb">
        <li><a href="<?=base_url();?>"><i class="fa fa-home"></i></a></li>
        <li><a href="#">حسابي</a></li>
        <li><a href="#">التسجيل</a></li>
    </ul>
    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="page-login">
                <div class="account-border">
                    <div class="row">
                        <div class="col-sm-6 new-customer">
                            <div class="well">
                                <h2><i class="fa fa-file-o" aria-hidden="true"></i> هل لديك حساب </h2>
                                <p><strong>تسجيل الدخول إلى حسابك وبدء التسوق الآن<strong></p>
                                <p>لماذا زانومي؟</p>
                                <div class="content-why">
                                    <ul class="why-list">
                                        <li><a title="Shipping &amp; Returns">الشحن والاسترجاع</a>
                                        </li>
                                        <li><a title="Secure Shopping">التسوق الآمن</a>
                                        </li>
                                        <li><a title="Affiliates">المسوق بالعمولة</a>
                                        </li>
                                        <li><a title="Group Sales">مبيعات جماعية</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="bottom-form">
                                <a href="<?php echo base_url('user-login'); ?>" class="btn btn-default pull-left"> تسجيل الدخول</a>
                            </div>
                        </div>
                        <form action="<?php echo base_url(''); ?>" >
                            <div class="col-sm-6 customer-login">
                                <div class="well">
                                    <h2><i class="fa fa-file-text-o" aria-hidden="true"></i>  عميل جديد</h2>
                                    <p><strong>إنشاء حسابك وتسوق</strong></p>
                                    <div class="form-group">
                                        <label class="control-label">الاسم الكامل</label>
                                        <input type="text" id="name" class="form-control regInputs" data-title="الاسم الكامل" />
                                        <p class="errorPrint" id="nameError"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">البريد الإلكتروني</label>
                                        <input type="text" id="email" class="form-control regInputs" data-title="البريد الإلكتروني" />
                                        <p class="errorPrint" id="emailError"></p>
                                    </div>
                                    <div class="form-group forninlines">
                                        <label class="control-label ">رقم الهاتف</label>
                                        <div class="mobileno-group">
                                            <!-- <select id="country_code" class="form-control regInputs">
                                                <option value="218">+218</option>
                                            </select> -->
                                            
                                            <input type="text" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " id="mobile" class="form-control regInputs" data-title="رقم الهاتف" />
                                            <input type="text" id="country_code" class="form-control regInputs" value="+218" style="width:15%;float: right;cursor:no-drop;" readonly/>
                                            <p class="errorPrint" id="mobileError"></p>
                                        </div>
                                    </div>
                                    <div class="form-group passwordread">
                                        <label class="control-label " for="input-password">كلمه السر</label>
                                        <input type="password" name="password" id="password" class="form-control regInputs" data-title="كلمه السر" />
                                        <i class="fa fa-eye " onclick="showHideEye(this)"></i>
                                    </div>
                                    <div class="form-group">
                                        <p class="errorPrint" id="passwordError"></p>
                                        <p class="errorPrint" id="genericError"></p>
                                    </div>
                                </div>
                                <div class="bottom-form">
                                    <div class="check-icon">
                                        <input id="t_n_c" class="box-checkbox pull-right" type="checkbox" name="agree" value="1"> &nbsp;
                                       <p> أوافق على <a href="#" class="agree"><b>الأحكام والشروط</b></a></p>
                                        <input type="button" onclick="register(this);" value="سجل" class="btn btn-primary pull-left">
                                    </div>
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
            <li><a href="<?=base_url();?>"><i class="fa fa-home"></i></a></li>
            <li><a href="<?=base_url('user-registration');?>">حسابي</a></li>
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
                                        <input type="button" onclick="verifyOtp(this);" value="تأكيد الرمز المرسل الى الهاتف" class="btn btn-default pull-left">
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

    function register(obj){
        $("#one").slideUp('slow');
        $("#two").slideDown('slow');

        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('data-title') + ' خانات إلْزاميّة');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
        if (idValidate) {
            return false;
        } else {
            var email=$("#email").val();
            var password=$("#password").val();
            var mobile=$("#mobile").val();
            var emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
            if(!emailPattern.test(email)){
                showErrorMessage('emailError','* البريد الإلكتروني غير صالح');
            }else{
                if(password.length>7){
                    if(mobile.length>6 && mobile.length<15){
                        var checked = $("#t_n_c").is(':checked');
                        if (checked == true) {
                            //$("#registerForm").submit();
                            var reg_form_data = new FormData();
                            reg_form_data.append("name",$("#name").val());
                            reg_form_data.append("email",$("#email").val());
                            reg_form_data.append("mobile",$("#mobile").val());
                            reg_form_data.append("password",$("#password").val());
                            reg_form_data.append("country_code",'218');
                            reg_form_data.append("is_web",'2');
                            $.ajax({
                                url: baseUrl+'mobileRegister',
                                type: "POST",
                                data: reg_form_data,
                                enctype: 'multipart/form-data',
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: function (data) {
                                    //returnObject = JSON.parse(JSON.stringify(data));
                                    returnObject = JSON.parse(data);
                                    if (returnObject.error_code == 200) {
                                    showErrorMessage('verificationGenericError',returnObject.message);
                                    $("#registrationForm").slideUp('slow');
                                    $("#verificationForm").slideDown('slow');
                                    $("#otp").val('');
                                    $("#otp").val(returnObject['data']['otp']);
                                    }else if(returnObject.error_code == 201){
                                        showErrorMessage('mobileError',returnObject.message);
                                    }else if(returnObject.error_code == 202){
                                        showErrorMessage('emailError',returnObject.message);
                                    }else{
                                        showErrorMessage('genericError',returnObject.message);
                                    }
                                },
                                error: function (error) {
                                    alert("error");
                                }
                            });
                        }else{
                            showErrorMessage('genericError',"موافقة على الشروط والأحكام."); 
                        }
                    }else{
                        showErrorMessage('mobileError',"رقم الجوال غير صالح."); 
                    }
                }else{
                    showErrorMessage('passwordError',"يجب أن تكون كلمة المرور أكثر من 8 أرقام");
                }
            }
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
                                        swal({title:"ناجح",text: returnObject.message,type: "success"},function(){ 
                                            window.location.href="<?=base_url();?>";
                                        })
                                    } else {
                                        alert("Some error found");
                                    }
                                }
                            })
                    //    alert(returnObject.message);
                    //    window.location.href="<?=base_url();?>";
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
                showErrorMessage('otpError',"* يجب تأكيد الرمز المرسل لهاتفك");
            }else{
                showErrorMessage('otpError',"* رقم الجوال مطلوب.");
            }
        }
    }
    
   
    function showHide(obj){
        var check=$(obj).attr('data-count');
        if(check==1){
            $("#password").attr('type','text');
            $(obj).attr('data-count','0');
            $(obj).removeClass('fa-eye');
            $(obj).addClass('fa-eye-slash');
        }else{
            $("#password").attr('type','password');
            $(obj).attr('data-count','1');
            $(obj).removeClass('fa-eye-slash');
            $(obj).addClass('fa-eye');
        }
    }
</script>
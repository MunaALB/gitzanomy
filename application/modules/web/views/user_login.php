<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="main-container container"  id="registrationForm">
        <ul class="breadcrumb">
            <li><a href="<?=base_url();?>"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">Login</a></li>
        </ul>
        
        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="page-login">
                
                    <div class="account-border">
                        <div class="row">
                            <div class="col-sm-6 new-customer">
                                <div class="well">
                                    <h2><i class="fa fa-file-o" aria-hidden="true"></i> New Customer</h2>
                                    <p><strong>Create your account & shop from the widest rage of categories in the few clicks<strong></p>
                                    <p>Why Zanomy</p>
                                   <div class="content-why">
                                        <ul class="why-list">
                                            <li><a title="Shipping &amp; Returns">Shipping &amp; Returns</a>
                                            </li>
                                            <li><a title="Secure Shopping">Secure Shopping</a>
                                            </li>
                                            <li><a title="Affiliates">Affiliates</a>
                                            </li>
                                            <li><a title="Group Sales">Group Sales</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="bottom-form">
                                    <a href="<?php echo base_url('en/user-registration'); ?>" class="btn btn-default pull-right">Continue With Registration</a>
                                </div>
                            </div>
                            
                            <form action="<?php echo base_url(''); ?>" >
                                <div class="col-sm-6 customer-login">
                                    <div class="well">
                                        <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Welcome User,</h2>
                                        <p><strong>Login to your account & start shopping now</strong></p>
                                        <div class="form-group">
                                            <label class="control-label ">Mobile No</label>
                                            <div class="mobileno-group">
                                            <!-- <select id="country_code" class="form-control regInputs">
                                                <option value="218">+218</option>
                                            </select> -->
                                            <input type="text" id="country_code" class="form-control regInputs" value="+218" style="width:15%;float: left;cursor:no-drop;" readonly/>
                                            <input type="text" onkeypress="return (event.charCode > 47 &&   event.charCode < 58) " id="mobile" class="form-control regInputs" data-title="Mobile" />
                                            <p class="errorPrint" id="mobileError"></p>
                                            </div>
                                        </div>
                                        <div class="form-group passwordread">
                                            <label class="control-label ">Password</label>
                                            <input type="password" name="password" id="password" class="form-control regInputs" data-title="Password" />
                                            <i class="fa fa-eye " onclick="showHideEye(this)"></i>
                                        </div>
                                        <div class="form-group">
                                            <p class="errorPrint" id="passwordError"></p>
                                            <p class="errorPrint" id="genericError"></p>
                                        </div>
                                    </div>
                                    <div class="bottom-form">
                                        <a href="<?php echo base_url('en/forgot-password'); ?>" class="forgot">Forgotten Password</a>
                                        <input type="button" onclick="login(this);" value="Login" class="btn btn-default pull-right" />
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
            <li><a href="<?=base_url('en/user-login');?>">Account</a></li>
            <li><a href="#">Verify OTP</a></li>
        </ul>
        
        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="page-login forgotpassword">
                
                    <div class="account-border">
                        <div class="row">
                            
                            <form action="">
                                <div class="col-sm-6 customer-login col-sm-offset-3">
                                    <div class="well">
                                        <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Verify the OTP &amp; reset your password</h2>
                                        <p><strong>Recover your password by verifying your registered mobile no</strong></p>
                                        <div class="form-group">
                                            <p class="errorPrint" id="verificationGenericError"></p>
                                            <label class="control-label">Enter the OTP here</label>
                                            <input type="text" id="otp" class="form-control">
                                            <p class="errorPrint" id="otpError"></p>
                                        </div>
                                    </div>
                                    <div class="bottom-form">
                                        <a onclick="resendOtp(this);" style="cursor:pointer;" class="forgot">Resend OTP</a>
                                        <input type="button" onclick="verifyOtp(this);" value="Verify OTP" class="btn btn-default pull-right">
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
    function login(obj){
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
           
                var milliseconds = new Date().getTime();
                //$("#registerForm").submit();
                var reg_form_data = new FormData();
                reg_form_data.append("mobile",$("#mobile").val());
                reg_form_data.append("country_code",'218');
                reg_form_data.append("password",$("#password").val());
                reg_form_data.append("system_id",'<?=$user_id;?>');
                reg_form_data.append("device_type","3");
                reg_form_data.append("device_id",milliseconds);
                reg_form_data.append("device_token",milliseconds);
                $.ajax({
                    url: baseUrl+'userLoginMobile',
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
                                        //window.location.href="agent/dashboard";
                                        window.location.href="<?=base_url();?>";
                                        // if(document.referrer==""){
                                        //     window.location.href="<?=base_url();?>";
                                        // }else{
                                        //     window.location.href=document.referrer;
                                        // }
                                        
                                    } else {
                                        alert("Some error found");
                                    }
                                }
                            })
                        }else if(returnObject.error_code == 203){
                            showErrorMessage('verificationGenericError',returnObject.message);
                            $("#registrationForm").slideUp('slow');
                            $("#verificationForm").slideDown('slow');
                            $("#otp").val('');
                            // $("#otp").val(returnObject['data']['otp']);
                        }else if(returnObject.error_code == 205){
                            showErrorMessage('mobileError',returnObject.message);
                        }else{
                            showErrorMessage('genericError',returnObject.message);
                        }
                    },
                    error: function (error) {
                         alert("error");
                    }
                });
            
        }
    }
    function resendOtp(obj){
        $(".errorPrint").css('display', 'none');
        if ($("#mobile").val()) {
            $("#verificationGenericError").css('display', 'none');
            var reg_form_data = new FormData();
            reg_form_data.append("country_code",'218');
            reg_form_data.append("mobile",$("#mobile").val());
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
                        // $("#otp").val(returnObject['data']['otp']);
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
            reg_form_data.append("system_id",'<?=$user_id;?>');
            reg_form_data.append("device_type","3");
            reg_form_data.append("device_id",milliseconds);
            reg_form_data.append("device_token",milliseconds);
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
                                        window.location.href="<?=base_url();?>";
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
                showErrorMessage('otpError',"*OTP is required field");
            }else{
                showErrorMessage('otpError',"*Mobile is required field");
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
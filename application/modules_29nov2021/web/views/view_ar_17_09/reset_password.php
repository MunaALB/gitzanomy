<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
</style>
<div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">حسابي</a></li>
            <li><a href="#"> إعادة تعيين كلمة المرور</a></li>
        </ul>
        
        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="page-login forgotpassword">
                
                    <div class="account-border">
                        <div class="row">
                            
                            <form action="<?php echo base_url(''); ?>" >
                                <div class="col-sm-6 customer-login col-sm-offset-3">
                                    <div class="well">
                                        <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> اعد ضبط كلمه السر</h2>
                                        <div class="form-group">
                                            <label class="control-label">أدخل كلمة المرور الجديدة</label>
                                            <input type="password" id="password" class="form-control regInputs" data-title="كلمه السر" />
                                            <p class="errorPrint" id="passwordError"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">تأكيد كلمة المرور</label>
                                            <input type="password" id="confirmPassword" class="form-control regInputs" data-title="تأكيد كلمة المرور" />
                                            <p class="errorPrint" id="confirmPasswordError"></p>
                                            <p class="errorPrint" id="userIdError"></p>
                                        </div>
                                    </div>
                                    <div class="bottom-form">
                                        <input type="button" onclick="resetPassword(this);" value="إرسال" class="btn btn-default pull-right" />
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
    function resetPassword(obj){
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
            var password=$("#password").val();
            var confirmPassword=$("#confirmPassword").val();
            var user_id="<?=$user_id;?>";
            if(password.length>7){
                if(password==confirmPassword){
                    var reg_form_data = new FormData();
                    reg_form_data.append("user_id",user_id);
                    reg_form_data.append("password",password);
                    reg_form_data.append("is_web",'2');
                    $.ajax({
                        url: baseUrl+'resetPassword',
                        type: "POST",
                        data: reg_form_data,
                        enctype: 'multipart/form-data',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            // returnObject = JSON.parse(JSON.stringify(data));
                            returnObject = JSON.parse((data));
                            //console.log('asasasas' , returnObject);
                            if (returnObject.error_code == 200) {
                                alert("Password Change Successfully.");
                                window.location.href="<?=base_url();?>";
                            }else{
                                showErrorMessage('userIdError',returnObject.message);
                            }
                        },
                        error: function (error) {
                            alert("error");
                        }
                    });
                }else{
                    showErrorMessage('confirmPasswordError',"تأكيد كلمة المرور غير متطابقة.");
                }
            }else{
                showErrorMessage('passwordError',"يجب أن تكون كلمة المرور أكثر من 8 أرقام");
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
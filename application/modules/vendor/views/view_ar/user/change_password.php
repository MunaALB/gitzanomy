<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>غير كلمة السر</h1> 
    </div>
    <div class="content"> 
        <div class="card">
            <div class="card-body">
                <div class="eventrow">
                    <form id="password_form" method="post">
                        <?=$this->session->flashdata('response')?>
                        <p class="text-danger text-center" id="error"></p>
                        <div class="row mt-4">
                            <div class="col-lg-6 col-xs-6 b-r offset-3"> <label>كلمة السر القديمة : </label>
                                <span class="text-danger" id="old_password"></span>
                                <?= form_error('old_password') ?>
                                <input type="password" class="form-control" name="old_password" placeholder="كلمة السر القديمة"> 
                            </div> 
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-6 col-xs-6 b-r offset-3"> <label>كلمة سر جديدة : </label>
                                <span class="text-danger" id="password"></span>
                                <input type="password" class="form-control" name="password" placeholder="كلمة سر جديدة">  
                            </div>   
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6 col-xs-6 b-r offset-3"> <label>تأكيد كلمة السر : </label>
                                <span class="text-danger" id="c_password"></span>
                                <input type="password" class="form-control" name="c_password" placeholder="تأكيد كلمة السر">  
                            </div>   
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-6 col-xs-6 b-r offset-3">
                                <div class="mt-4 mb-4 pull-right">
                                    <a onclick="changePassword();" style="cursor: pointer;" class="composemail ">تغيير</a>
                                </div>
                            </div>   
                        </div>
                    </form>
                </div> 
            </div>
        </div> 
    </div>
    <script>
        function changePassword() {
            var flag = true;
            var password = '';
            var c_password = '';
            var formData = $("#password_form").find(':input').not(':input[type=button]');
            $(formData).each(function () {
                var element = $(this);
                var val = element.val();
                var name = element.attr('name');
                if (val == '' || val == '0') {
                    $('#' + name).html('* املأ هذا الفراغ');
                    flag = false;
                } else {
                    if (name == 'password') {
                        if (val.length < 8) {
                            flag = false;
                            $('#' + name).html('الحد الأدنى 8 لكلمة مرور');
                        } else {
                            password = val;
                            $('#' + name).html('');
                        }
                    } else if (name == 'c_password') {
                        c_password = val;
                        $('#' + name).html('');
                    } else {
                        $('#' + name).html('');
                    }
                }
            });

            if (flag) {
                if (((c_password.length > 0) && (password.length > 0))) {
                    if (c_password != password) {
                        flag = false;
                        $('#c_password').html('كلمة السر غير مطابقة');
                        return false;
                    } else {
                        $('#error').html('');
                        $("#password_form").submit();
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    </script>
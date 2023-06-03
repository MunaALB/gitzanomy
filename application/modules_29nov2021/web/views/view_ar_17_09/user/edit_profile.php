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
            <li><a href="#">لوحة المستخدم</a></li>
            <li><a href="#">تعديل الملف الشخصي</a></li>
        </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                    <?php include 'usersidebar.php';?>
                </aside>
                 <div id="content" class="col-sm-9 user-rightpart">
                    <h2 class="title">تعديل الملف الشخصي</h2>
                    <div class="user-gridpoints">
                      <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input-firstname" class="control-label">اسمك</label>
                                        <input type="text" class="form-control regInputs" data-title="اسمك" id="name" value="<?=$user_data['name'];?>" placeholder="اسمك" value="" name="firstname">
                                        <p class="errorPrint" id="nameError"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="input-lastname" class="control-label">البريد الإلكتروني</label>
                                        <input type="text" id="email" class="form-control regInputs" data-title="البريد الإلكتروني" value="<?=$user_data['email'];?>" placeholder="البريد الإلكتروني" value="" name="lastname">
                                        <p class="errorPrint" id="emailError"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label ">رقم الهاتف</label>
                                            <div class="mobileno-group">
                                                <select class="form-control" readonly style="cursor:pointer;">
                                                  <option>+218</option>
                                                </select>
                                                <input type="text" readonly value="<?=$user_data['mobile'];?>" name="email" value=""  placeholder="رقم الهاتف" class="form-control" />
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="buttons clearfix editbtns">
                                        <div class="pull-right">
                                            <button type="button" onclick="editProfile(this);" class="btn btn-md btn-primary">حفظ التغييرات</button>
                                            <p class="errorPrint" id="genericError"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </fieldset>
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
    function editProfile(obj){
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
            var name=$("#name").val();
            var email=$("#email").val();
            var emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
            if(!emailPattern.test(email)){
                showErrorMessage('emailError','*البريد الإلكتروني غير صالح');
            }else{
                $.ajax({
                    url: "<?php echo base_url("/web/Web/ajax") ?>",
                    type: "POST",
                    data: "method=editProfile&name="+name+'&email='+email,
                    success: function (data) {
                        var dta = $.trim(data);
                        var jsonData = $.parseJSON(dta);
                        if (jsonData['error_code'] == 200) {
                            alert(jsonData['message']);
                            location.reload();
                        } else {
                            showErrorMessage('genericError',jsonData['message']);
                            //location.reload();
                        }
                    },
                    error: function (error) {
                        alert("error");
                    }
                }); 
            }
        }
    }
    
</script>
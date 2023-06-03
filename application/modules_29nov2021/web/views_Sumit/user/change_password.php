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
        <li><a href="#">Account</a></li>
        <li><a href="#">User Dashboard</a></li>
        <li><a href="#">Edit Password</a></li>
    </ul>
    <div class="row">
        <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
            <?php include 'usersidebar.php';?>
        </aside>
        <div id="content" class="col-sm-9 user-rightpart">
            <h2 class="title">Edit Password</h2>
            <div class="user-gridpoints">
                <fieldset>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="input-firstname" class="control-label">Old Password</label>
                                <input type="password" class="form-control regInputs" id="old_password" data-title="Old Password" value="" name="firstname">
                                <p class="errorPrint" id="old_passwordError"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="input-lastname" class="control-label">New Password</label>
                                <input type="password" class="form-control regInputs" id="password" data-title="New Password<"  value="" name="lastname">
                                <p class="errorPrint" id="passwordError"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="input-fax" class="control-label">Confirm Password</label>
                                <input type="password" class="form-control regInputs" id="confirm_password" data-title="Confirm Password"  value="" name="fax">
                                <p class="errorPrint" id="confirm_passwordError"></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="buttons clearfix editbtns">
                                <div class="pull-right">
                                    <p class="errorPrint" id="genericError"></p>
                                    <button type="button" onclick="changePassword(this);" class="btn btn-md btn-primary">Save Changes</button>
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
    function changePassword(obj){
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
            var old_password=$("#old_password").val();
            var password=$("#password").val();
            var confirm_password=$("#confirm_password").val();
            if(password.length>7){
                if(password==confirm_password){
                    $.ajax({
                        url: "<?php echo base_url("/web/Web/ajax") ?>",
                        type: "POST",
                        data: "method=changeProfile&old_password="+old_password+'&password='+password+'&confirm_password='+confirm_password,
                        success: function (data) {
                            var dta = $.trim(data);
                            var jsonData = $.parseJSON(dta);
                            if (jsonData['error_code'] == 200) {
                                alert(jsonData['message']);
                                location.reload();
                            } else {
                                showErrorMessage('confirm_passwordError',jsonData['message']);
                                //location.reload();
                            }
                        },
                        error: function (error) {
                            alert("error");
                        }
                    }); 
                }else{
                    showErrorMessage('confirm_passwordError',"Password and Confirm Password not matched.");
                }
            }else{
                showErrorMessage('passwordError',"Password should be greater than 8 digits..");
            }
        }
    }
    
    
</script>
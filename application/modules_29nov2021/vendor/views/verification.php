
<!-- this is other -->
 <!DOCTYPE html>

<html lang="en">

  <head>

<meta charset="utf-8">

      <meta http-equiv="X-UA-Compatible" content="IE=edge">

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url();?>assets/admin/common/images/logo/favicon.png">

      <title>Africans Supermarket : Verification</title>

      <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/common/css/bootstrap.min.css">

      <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/common/css/ionicons.css">

      <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/common/css/font-awesome.min.css">

      <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/common/css/simple-line-icons.css">

      <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/common/css/jquery.mCustomScrollbar.css">

      <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/common/css/dataTables.bootstrap4.min.css">

      <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/common/css/style.css">

      <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/common/fonts/responsive.css">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

  </head>

<body>
<?php if(isset($this->session->userdata['response'])){?> 
      <div class="alert alert-danger"><?php echo $this->session->userdata['response'];?></div>
  <?php  }   ?>
  <div class="sufee-login d-flex align-content-center flex-wrap beaytulogin beaytusignup" style="height:657px">

        <div class="container" id="otpBox">

            <div class="login-content">

                <div class="logo">

                        <span class="logo-default">

                            <img alt="" src="<?php echo site_url();?>assets/admin/common/images/logo/logo_white.png" alt="Logo">

                        </span>

                </div>

                <div class="login-form">
                    <div class="careerfy-page-title">
                            <h1 id="heading" style="color: white;">Verify your email by the OTP received on your registered email</h1> 
                    </div>

                    <form class="verifyForm" method="post" style="margin-top: 50px;">
                       
                                <label>Enter the OTP received</label>
                                <input type="text" class="form-control" name="otp"> 
                                <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning1"><span id="errorMsg1"></span></div>
                            
                            <div class="reset-button">
                                <a style="display: inline-block;padding: 12px 22px;color: #ffffff;font-weight: 600;text-transform: uppercase;border-radius: 2px;background-color: #7d0e25;margin-top: 31px;border-radius: 5px;cursor:pointer;" class="careerfy-classic-btn careerfy-bgcolor" onclick="resendotp();">Re-Send OTP</a>
                                <a style="display: inline-block;padding: 12px 22px;color: #ffffff;font-weight: 600;text-transform: uppercase;border-radius: 2px;background-color: #7d0e25;margin-top: 31px;margin-left: 237px;border-radius: 5px;cursor:pointer;" class="careerfy-classic-btn careerfy-bgcolor" onclick="verifyUser()">Submit</a>
                            </div> 
                        
                    </form>

                </div>

            </div>

        </div>

    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function verifyUser() {
        var inputElements = $('.verifyForm').find(':input');  
        //alert(inputElements); 
        var isValid = true;
        var msg = '*All Fields Are Required';
        $(inputElements).each(function () {
            var element = $(this);
            if (element.attr('name') == 'otp') {
                
                if (element.val() == "" || element.val() == 0) {

                    isValid = false;
                    msg = 'OTP field is required';

                    $("#errorWarning1").css('display', 'block');
                    $("#errorMsg1").html(msg);
                } else {
                    $("#errorMsg1").html('');
                    $(element).css('border', '1px solid #A6A9AE');
                }
            }
        });


        if (isValid) {

            $.ajax({
                url: "<?= base_url(); ?>vendor/Ajax/verify_otp",
                type: 'POST',
                data: $('.verifyForm').serialize(),
                success: function (data) {
                    console.log(data);
                    var dt = $.trim(data);

                    var jsonData = JSON.parse(dt);
                    if (jsonData.error_code == "100") {
                        var type =<?= $this->session->flashdata('response') ? 1 : 0 ?>;
                        if (type) {
                            // $('#setPassword').css('display', 'block');
                            $('#otpBox').hide();
                           // $('#heading').html('Reset Password');
                        } else {
                            window.location.href = "<?= base_url() ?>vendor/dashboard";
                        }

                    } else {
                        msg = jsonData.message;

                        $("#errorWarning1").css('display', 'block');
                        $("#errorMsg1").html(msg);
                    }
                }
            });
        } else {
            return false;
        }
    }
</script>

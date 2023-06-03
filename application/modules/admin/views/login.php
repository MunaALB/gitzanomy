<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="http://gropse.com/gropse.com/design/zanomy.com/assets/web/images/logo/favicon.png">
    <title>Zanomy Vendor Panel : Libya's Online Shopping Site for Women &amp; Men - Latest Online Shopping Trends</title>
    <!-- meta name="description" content="Online Fashion Shopping Store For Women at Best Price in Libya. Buy Women Clothing, Shoes, Handbags, Jewellery, Sunglasses, Accessories at Zanomy." />
    <meta name="keywords" content="Zanomy, Online Shopping, Online Shopping  in Libya, Online Shopping Site for Women &amp; Men, Latest Online Shopping Trends" />
    <meta name="author" content="Zanomy" />
    <link href="https://www.zanomy.com/" rel="canonical" />
    <meta name="Classification" content="Zanomy" />
    <meta name="abstract" content="https://www.zanomy.com/" />
    <meta name="audience" content="All" />
    <meta name="robots" content="index,follow" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:title" content="Zanomy : Libya's  Online Shopping Site for Women &amp; Men - Latest Online Shopping Trends" />
    <meta property="og:description" content="Online Fashion Shopping Store For Women at Best Price in Libya. Buy Women Clothing, Shoes, Handbags, Jewellery, Sunglasses, Accessories at Zanomy." />
    <meta property="og:url" content="https://www.zanomy.com/" />
    <meta property="og:image" content="<?php echo base_url()?>assets/web/images/logo/og.png" />
    <meta property="og:site_name" content="Zanomy" />
    <meta name="googlebot" content="index,follow" />
    <meta name="distribution" content="Global" />
    <meta name="Language" content="en-us" />
    <meta name="doc-type" content="Public" />
    <meta name="site_name" content="Zanomy" />
    <meta name="url" content="https://www.zanomy.com/" /> -->
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/et-line-font/et-line-font.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/simple-lineicon/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/datatables/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/formwizard/jquery-steps.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/dropify/dropify.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/chartist-js/chartist.min.css">
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/plugins/chartist-js/chartist-plugin-tooltip.css"> 
    <link rel="stylesheet" href="<?php echo site_url();?>assets/admin/css/font/stylesheet.css"> 
    <style type="text/css">
        .eyepassword .fa-eye-slash{
            position: absolute;
            top: 11px;
            right: 15px;
            font-size: 17px;
            color: gray;
        }
        .eyepassword .fa-eye {
            position: absolute;
            top: 11px;
            bottom: 40px;
            right: 15px;
            font-size: 17px;
            color: gray;
        }
        
        .errorPrint{
            font-size: 12px;
            color: #af2000 !important;
            padding: 5px 5px;
        }
        .wl-login .form-section {
    padding: 20px 40px 20px 40px;
    width: 100%;
    position: relative;
    background: #ffffff !important;
    border-radius: 10px;
}
.login-page.sty1, .register-page.sty1 {
    background: #f75d16;
    background-size: cover;
    width: 100%;
    background-attachment: fixed;
}
.wl-login .registr-box {
    width: 100% !important;
}
.wl-login .form-section h3 {
    font-size: 24px;
    color: black;
    text-align: center;
    font-weight: 600;
}
.wl-login .login-box .login-logo {
    background: #f75d16;
    padding: 27px 15px 10px 15px;
    border-radius: 100%;
    width: 110px;
    height: 110px;
    margin: 0 auto;
    margin-bottom: 30px;
}
.wl-login .login-box .login-logo {
    position: initial;
    top: 0;
    left: 0;
    }
    </style>
</head>

<body class="login-page sty1">

<div class="container-fluid  wl-login">
    <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3">
                        <div class="login-box registr-box">
                            <div class="form-section">
                                <div class="login-logo">
                                <img src="<?php echo base_url()?>assets/admin/images/logo_zanomy_white.png">
                                </div>
                                <h3>Hi, Welcome Back</h3>
                                <p>Login to Zanomy</p>
                                <p id="error" class="text-danger mb-0"></p>
                                <p id="success" class="text-success mb-0"></p>
                                <form method="post" id="regForm">
                                  <div class="form-group">  
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" data-warning="errorWarning1" placeholder="username" onkeypress="submissionAction(this,'button');">
                                                    <div class="text-danger" style="display:none;cursor: pointer;text-align: left;" id="errorWarning1"><span id="errorMsg1"></span></div>
                                  </div>
                                  <div class="form-group eyepassword"> 
                                    <input type="password" id="password1" class="form-control" id="exampleInputPassword1" name="password1" data-warning="errorWarning2" placeholder="Password" onkeypress="submissionAction(this,'button');">
                                    <a href="#"><i class="eyepassword fa fa-eye-slash" onclick="showPassword(this)"></i></a>
                                                                    <div class="text-danger" style="display:none;cursor: pointer;text-align: left;" id="errorWarning2"><span id="errorMsg2"></span></div>
                                  </div>
                                  <!---<div class="mb-4"> 
                                    <label><a href="#">Forgot Password ?</a></label>
                                  </div>-->
                                  <button type="button" id="button" class="btn btn-primary mybtns-send " data-count="1" onclick="login(this, 1)">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


 </div> 
 </div> 
    <script src="<?php echo site_url('assets/admin/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/js/bizadmin.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/jquery-sparklines/jquery.sparkline.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/jquery-sparklines/sparkline-int.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/raphael/raphael-min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/morris/morris.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/functions/dashboard1.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/js/demo.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/formwizard/jquery-steps.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/dropify/dropify.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/chartjs/chart.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/admin/plugins/chartjs/chart-int.js'); ?>"></script> 
</body>

</html>
<script type="text/javascript">
function submissionAction(o,f){
    if (event.keyCode === 13) {
        event.preventDefault();
        $("#"+f).click();
    }
}
       function login(obj, type) {
        var nullException = true;

            var dataCount = $(obj).attr('data-count');

            $(".stepError" + dataCount).each(function () {
                  
                if ($(this).val() == '' || $(this).val() == null || $(this).val() == 'null' || $(this).val() == 0) {
                    var warnMsg = $(this).attr('data-warning');
                    $("#" + warnMsg).empty();
                    $("#" + warnMsg).append('*required field');
                    $("#" + warnMsg).css('display', 'block');
                    nullException = false;
                } else {
                    var warnMsg = $(this).attr('data-warning');
                    $("#" + warnMsg).css('display', 'none');
                    //document.getElementById('button').type = "submit";

                }
            });
            if (nullException == true) {
            sendForm();
        }
        //console.log(dataCount);
    }

    function sendForm() {
        $("#regForm").submit();
    }

    function showPassword(obj) {
        var type = $("#password1").attr('type');
        if (type == 'text') {
            $("#password1").attr('type', 'password');
            $(obj).removeClass('fa-eye');
            $(obj).addClass('fa-eye-slash');
        } else {
            $("#password1").attr('type', 'text');
            $(obj).removeClass('fa-eye-slash');
            $(obj).addClass('fa-eye');
        }
    }
      
</script>  
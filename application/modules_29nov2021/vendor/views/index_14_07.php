<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zanomy Vendor Panel : Libya's Online Shopping Site for Women &amp; Men - Latest Online Shopping Trends</title>
        <meta name="description" content="Online Fashion Shopping Store For Women at Best Price in Libya. Buy Women Clothing, Shoes, Handbags, Jewellery, Sunglasses, Accessories at Zanomy." />
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
        <meta property="og:site_name" content="Zanomy" />
        <meta name="googlebot" content="index,follow" />
        <meta name="distribution" content="Global" />
        <meta name="Language" content="en-us" />
        <meta name="doc-type" content="Public" />
        <meta name="site_name" content="Zanomy" />
        <meta name="url" content="https://www.zanomy.com/" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/css/et-line-font/et-line-font.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/css/themify-icons/themify-icons.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/css/simple-lineicon/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/plugins/datatables/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/plugins/formwizard/jquery-steps.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/plugins/dropify/dropify.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/vendor/css/font/stylesheet.css">
        <style>
            .eyepassword .fa-eye-slash {
                position: absolute;
                bottom: 13px;
                right: 8px;
                font-size: 15px;
                color: gray;
            }
        </style>
        <style>

            .lds-ellipsis {
                display: inline-block;
                position: relative;
                width: 100%;
                height: 100%;
                position: absolute;
                position: fixed;
                display: block;
                opacity: 1;
                z-index: 9999;
                text-align: center;
                background: rgba(25, 24, 24, 0.84);

            }
            .lds-ellipsis div {
                position: absolute;
                top:50%;

                width: 11px;
                height: 11px;
                border-radius: 50%;
                background: #ae9703;
                animation-timing-function: cubic-bezier(0, 1, 1, 0);
                text-align: center;
            }
            .lds-ellipsis div:nth-child(1) {
                left: 47%;
                animation: lds-ellipsis1 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(2) {
                left: 48%;
                animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(3) {
                left: 50%;
                animation: lds-ellipsis2 0.6s infinite;
            }
            .lds-ellipsis div:nth-child(4) {
                left: 51%;
                animation: lds-ellipsis3 0.6s infinite;
            }
            @keyframes lds-ellipsis1 {
                0% {
                    transform: scale(0);
                }
                100% {
                    transform: scale(1);
                }
            }
            @keyframes lds-ellipsis3 {
                0% {
                    transform: scale(1);
                }
                100% {
                    transform: scale(0);
                }
            }
            @keyframes lds-ellipsis2 {
                0% {
                    transform: translate(0, 0);
                }
                100% {
                    transform: translate(19px, 0);
                }
            }

.wl-login .form-section {
    padding: 60px 40px 60px 40px;
    width: 100%;
    position: relative;
    background: #ffffff3d;
    border-radius: 10px;
}
        </style>
    </head>
    <body class="login-page sty1">
        <div id="loading" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        <div class="container-fluid  wl-login">
            <div class="container">
                <div class="login-box">
                    <div class="form-section">
                        <div class="login-logo">
                            <img src="<?php echo site_url(); ?>assets/vendor/images/logo_zanomy_white.png">
                        </div>
                        <h3>Hi, Welcome Back..!!</h3>
                        <p>Login to Zanomy</p>
                        <p id="error" class="text-danger mb-0"></p>
                        <p id="success" class="text-success mb-0"></p>
                        <form method="post" id="login_form">
                            <div class="form-group">
                                <span id="email" class="text-danger"></span>
                                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address">
                            </div>
                            <div class="form-group eyepassword">
                                <span id="password" class="text-danger"></span>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                                <i id="eyeIcon" onclick="showHide(this)" class="fa fa-eye-slash" style="cursor:pointer;"></i>
                            </div>
                            <div class="mb-4">
                                <label><a href="<?php echo site_url('vendor/forgot-password'); ?>">Forgot Password ?</a></label>
                            </div>
                            <button type="button" onclick="validate(this);" class="btn btn-primary mybtns-send ">Sign In</button>
                            <div class="mt-4 text-center">
                                <label>Don't have an account ? <a href="<?php echo site_url('vendor/registration'); ?>"> Signup</a></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-design" id="exampleModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verify Your Email Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="otp_form" method="post">
                            <div class="form-group">
                                <label>Enter a verification code sent on email address</label>
                                <span class="text-danger" id="errorOtp"></span>
                                <span class="text-succes" id="successOtp"></span>
                                <span id="otp" class="text-danger"></span>
                                <input type="text" id="set_otp" name="otp" class="form-control">
                                <div class="text-center">
                                    <label id="some_div">00:30</label> 
                                </div>
                            </div>
                            <label>Didn't receive the verification code ? <a style="cursor:pointer;" onclick="resend();" id="resendBtn"> Resend the Code</a> </label>
                            <a style="cursor:pointer;" onclick="verifyOtp(this);" class="composemail  pull-right mt-4 mb-4">Submit</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo site_url('assets/vendor/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/jquery-sparklines/jquery.sparkline.min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/jquery-sparklines/sparkline-int.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/raphael/raphael-min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/morris/morris.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/functions/dashboard1.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/js/demo.js'); ?>"></script>
        <script>
                                var $loading = $('#loading').hide();
                                //Attach the event handler to any element
                                $(document)
                                        .ajaxStart(function () {
                                            //ajax request went so show the loading image
                                            $loading.show();
                                        })
                                        .ajaxStop(function () {
                                            //got response so hide the loading image
                                            $loading.hide();

                                        });
                                function validate(obj) {

                                    var flag = true;
                                    var formData = $("#login_form").find(':input').not(':input[type=button]');
                                    $(formData).each(function () {
                                        var element = $(this);
                                        var val = element.val();
                                        var name = element.attr('name');
                                        if (val == '' || val == '0') {
                                            $('#' + name).html('* required field');
                                            flag = false;
                                        } else {
                                            $('#' + name).html('');
                                        }
                                    });

                                    if (flag) {

                                        $.ajax({
                                            url: '<?= base_url() ?>vendor/Ajax/login',
                                            type: 'POST',
                                            data: $("#login_form").serialize(),
                                            success: function (data) {
                                                var dt = $.trim(data);
                                                var jsonData = $.parseJSON(dt);
                                                console.log(jsonData);
                                                if (jsonData['error_code'] == 100) {
                                                    window.location.href = "<?= base_url() ?>vendor/dashboard";
                                                } else if (jsonData.error_code == 103) {
                                                    $('#exampleModal').modal();
                                                    $('#set_otp').val(jsonData['data']['otp']);
                                                    $('#success').html(jsonData['message']);
                                                    $('#error').html('');
                                                    startTime();
                                                } else {
                                                    $('#error').html(jsonData['message']);
                                                    $('#success').html('');
                                                }
                                            }
                                        });
                                    } else {
                                        return false;
                                    }
                                }

                                function verifyOtp(obj) {
                                    var flag = true;
                                    var formData = $("#otp_form").find(':input').not(':input[type=button]');
                                    $(formData).each(function () {
                                        var element = $(this);
                                        var val = element.val();
                                        var name = element.attr('name');
                                        if (val == '' || val == '0') {
                                            $('#' + name).html('* required field');
                                            flag = false;
                                        } else {
                                            $('#' + name).html('');
                                        }
                                    });
                                    if (flag) {
                                        $.ajax({
                                            url: '<?= base_url() ?>vendor/Ajax/verify_otp',
                                            type: 'POST',
                                            data: $("#otp_form").serialize() + '&email=' + ($('input[name=email]').val()) + '&type=1',
                                            success: function (data) {
                                                var dt = $.trim(data);
                                                var jsonData = $.parseJSON(dt);
//                                                console.log(jsonData);
                                                if (jsonData['error_code'] == 100) {
                                                    $('#errorOtp').html('');
                                                    $('#successOtp').html(jsonData['message']);
                                                    window.location.href = "<?= base_url() ?>vendor/admin-verification";
                                                } else {
                                                    $('#errorOtp').html(jsonData['message']);
                                                    $('#successOtp').html('');
                                                }
                                            }
                                        });
                                    } else {
                                        return false;
                                    }
                                }

                                function resend() {
                                    var msg = '';
                                    var user = $('input[name=email]').val();
                                    if (user) {
                                        $.ajax({
                                            url: "<?= base_url(); ?>vendor/Ajax/resendOtp",
                                            type: 'post',
                                            data: 'email=' + user + '&type=1',
                                            success: function (data) {
                                                var dt = $.trim(data);
                                                var jsonData = $.parseJSON(dt);
                                                msg = jsonData['message'];
                                                if (jsonData['error_code'] == 100) {
                                                    $('#successOtp').html(msg);
                                                    $('#set_otp').val(jsonData['data']['otp']);
                                                    $('#errorOtp').html('');
                                                    startTime();
                                                } else {
                                                    $('#errorOtp').html(msg);
                                                    $('#set_otp').val('');
                                                    $('#successOtp').html('');
                                                }
                                            }
                                        });
                                    } else {
//                                        alert('Session Expired. Try logging in.');
                                        return false;
                                    }
                                }


                                function showHide(obj) {
                                    var input = $('input[name=password]');
//                                   console.log(input);
                                    var type = $(input).attr('type');
                                    if (type == 'password') {
                                        $(input).attr('type', 'text');
                                        $("#eyeIcon").removeClass('fa-eye-slash');
                                        $("#eyeIcon").addClass('fa-eye');
                                    } else {
                                        $(input).attr('type', 'password');
                                        $("#eyeIcon").removeClass('fa-eye');
                                        $("#eyeIcon").addClass('fa-eye-slash');
                                    }
                                }
                                var timeLeft;
                                var timerId;
                                var elem = document.getElementById('some_div');

                                function startTime() {
                                    timeLeft = 30;
                                    $('#resendBtn').removeAttr('onclick');
                                    $('#resendBtn').css('cursor', 'not-allowed');
                                    timerId = setInterval(countdown, 1000);
                                }

                                function countdown() {
                                    if (timeLeft == 0) {
                                        elem.innerHTML = "";
                                        window.clearInterval(timerId);
                                        $('#resendBtn').css('cursor', 'pointer');
                                        $('#resendBtn').attr('onclick', 'resend();');
//                                        break;
                                    } else {
                                        elem.innerHTML = '00:' + timeLeft;
                                        timeLeft--;
                                    }
                                }
        </script>
    </body>

</html>
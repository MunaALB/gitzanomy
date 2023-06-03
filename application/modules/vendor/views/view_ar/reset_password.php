
<!DOCTYPE html>
<html lang="eng" dir="rtl">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="http://gropse.com/gropse.com/design/zanomy.com/assets/web/images/logo/favicon.png">
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
        <meta property="og:image" content="http://gropse.com/gropse.com/design/zanomy.com/assets/web/images/logo/og.png" />
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
    </head>

    <body class="login-page sty1">

        <div class="container-fluid  wl-login">
            <div class="container">
                <div class="login-box"> 
                    <div class="form-section">
                        <h3>Reset Password</h3>
                        <p><span>Please set your new password..!!</span></p>
                        <p id="error" class="text-danger mb-0"></p>
                        <p id="success" class="text-success mb-0"></p>
                        <?= $this->session->flashdata('response'); ?>
                        <div class="login-logo">
                            <img src="<?php echo site_url(); ?>assets/vendor/images/logo_zanomy_white.png">
                        </div>
                        <form id="reset_password_form" method="post">
                            <div class="form-group">  
                                <span id="password" class="text-danger"></span>
                                <input type="password" name="password" class="form-control"  placeholder="Enter a new password"> 
                            </div>
                            <div class="form-group eyepassword"> 
                                <span id="c_password" class="text-danger"></span>
                                <input type="password" name="c_password" class="form-control" placeholder="Confirm a password">
                                <!--<i onclick="showHide(this)" class="fa fa-eye-slash"></i>-->
                            </div> 
                            <a style="cursor: pointer;" onclick="validate();" class="btn btn-primary mybtns-send ">Submit</a> 
                        </form>
                    </div>
                </div>
            </div> 
        </div> 

        <?php
    if (($this->session->flashdata('response'))) {
        echo $this->session->flashdata('response');
        ?>

    <?php } ?>
        <script src="<?php echo site_url('assets/vendor/js/jquery.min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/jquery-sparklines/jquery.sparkline.min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/jquery-sparklines/sparkline-int.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/raphael/raphael-min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/morris/morris.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/plugins/functions/dashboard1.js'); ?>"></script>
        <script src="<?php echo site_url('assets/vendor/js/demo.js'); ?>"></script>
        <script>
                                function validate() {
                                    var flag = true;
                                    var c_password = '';
                                    var password = '';
                                    var formData = $("#reset_password_form").find(':input').not(':input[type=button]');
                                    $(formData).each(function () {
                                        var element = $(this);
                                        var val = element.val();
                                        var name = element.attr('name');
                                        if (val == '' || val == '0') {
                                            $('#' + name).html('* required field');
                                            flag = false;
                                        } else {
                                            if (name == 'password') {
                                                if (val.length < 8) {
                                                    flag = false;
                                                    $('#' + name).html('minimum length 8');
                                                } else {
                                                    password = val;
                                                }
                                            } else if (name == 'c_password') {
                                                c_password = val;
                                            } else {
                                                $('#' + name).html('');
                                            }
                                        }
                                    });

                                    if (flag) {
                                        if (((c_password.length > 0) && (password.length > 0))) {
                                            if (c_password != password) {
                                                flag = false;
                                                $('#password').html('Password do not match');
                                                return false;
                                            } else {
                                                $('#reset_password_form').submit();
                                            }
                                        } else {
                                            return false;
                                        }
                                    } else {
                                        return false;
                                    }
                                }

                                function showHide(obj) {
                                    var input = $('input[name=c_password]');
//                                   console.log(input);
                                    var type = $(input).attr('type');
                                    if (type == 'password') {
                                        $(input).attr('type', 'text');
                                    } else {
                                        $(input).attr('type', 'password');
                                    }
                                }
        </script>
    </body>

</html>
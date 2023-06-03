
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url(); ?>assets/admin/images/favicon.png">
        <title>Zanomy Admin Panel : Libya's Online Shopping Site for Women &amp; Men - Latest Online Shopping Trends</title>
        <meta name="description" content="Online Fashion Shopping Store For Women at Best Price in Libya. Buy Women Clothing, Shoes, Handbags, Jewellery, Sunglasses, Accessories at Zanomy." />
        <meta name="keywords" content="Zanomy, Online Shopping, Online Shopping  in Libya, Online Shopping Site for Women &amp; Men, Latest Online Shopping Trends" />
        <meta name="author" content="Zanomy" />
        <link href="https://www.zanomy.com/" rel="canonical" />
        <meta name="Classification" content="Zanomy" />
        <meta name="abstract" content="https://www.zanomy.com/" />
        <meta name="audience" content="All" />
        <meta name="robots" content="index,follow" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:title" content="Zanomy Admin Panel : Libya's  Online Shopping Site for Women &amp; Men - Latest Online Shopping Trends" />
        <meta property="og:description" content="Online Fashion Shopping Store For Women at Best Price in Libya. Buy Women Clothing, Shoes, Handbags, Jewellery, Sunglasses, Accessories at Zanomy." />
        <meta property="og:url" content="https://www.zanomy.com/" />
        <meta property="og:image" content="<?php echo site_url(); ?>assets/admin/images/logo/og.png" />
        <meta property="og:site_name" content="Zanomy" />
        <meta name="googlebot" content="index,follow" />
        <meta name="distribution" content="Global" />
        <meta name="Language" content="en-us" />
        <meta name="doc-type" content="Public" />
        <meta name="site_name" content="Zanomy" />
        <meta name="url" content="https://www.zanomy.com/" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/bootstrap.min.css">

        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/chosen.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/et-line-font/et-line-font.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/themify-icons/themify-icons.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/simple-lineicon/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/plugins/datatables/css/dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/skins/_all-skins.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/plugins/formwizard/jquery-steps.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/plugins/dropify/dropify.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/plugins/chartist-js/chartist.min.css">
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/plugins/chartist-js/chartist-plugin-tooltip.css"> 
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/admin/css/font/stylesheet.css"> 
        <style>
.ajax-loader {
        width: 100%;
        height: 100%;
        position: absolute;
        position: fixed;
        display: block;
        opacity: 1;
        background-color: #fff;
        z-index: 9999;
        text-align: center;

        visibility: hidden;
        background: rgba(0,0,0,0.5);

    }

    .ajax-loader img {
        position: relative;
        top: 32%;
        left: 52%;
        width: 108px;
        height: 108px;
    }

    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
        </style>
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="ajax-loader">
            <img src="<?php echo base_url('assets');?>/ajax-loader.gif" class="img-responsive" />
        </div>
        <div class="wrapper boxed-wrapper">
            <header class="main-header">  
                <nav class="navbar blue-bg navbar-static-top"> 
                    <ul class="nav navbar-nav pull-left">
                        <li><a class="sidebar-toggle" data-toggle="push-menu" href=""></a> </li>
                    </ul>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php
                                    $admin_login = $this->session->userdata('admin_logged_in');
                                    if ($admin_login['type']) {
                                        ?>
                                        <span class="hidden-xs"><?= $admin_login['username'] ?></span>
                                    <?php } else { ?>
                                        <span class="hidden-xs">Admin</span>
                                    <?php } ?>
                                    <img src="<?php echo site_url(); ?>assets/admin/images/user.png" class="user-image" alt="User Image"></a>
                                <ul class="dropdown-menu">
                                 <!-- <li><a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-home"></i> Dashboard</a></li>  -->
                                    <li><a href="<?php echo site_url('admin/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/web/images/logo/favicon.png">
    <title>Zanomy : Libya's Online Shopping Site for Women &amp; Men - Latest Online Shopping Trends</title>
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
    <meta property="og:image" content="<?php echo base_url(); ?>assets/web/images/logo/og.png" />
    <meta property="og:site_name" content="Zanomy" />
    <meta name="googlebot" content="index,follow" />
    <meta name="distribution" content="Global" />
    <meta name="Language" content="en-us" />
    <meta name="doc-type" content="Public" />
    <meta name="site_name" content="Zanomy" />
    <meta name="url" content="https://www.zanomy.com/" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/js/datetimepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/js/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/lib.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/js/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/js/minicolors/miniColors.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so_searchpro.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so_megamenu.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so-categories.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so-listing-tabs.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/themecss/so-newletter-popup.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/header/header3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/footer/footer3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/home3.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/theme.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/css/responsive.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/web/fonts/stylesheet.css">

    <script src="<?=base_url()?>assets/web/js/jquery-2.2.4.min.js"></script>
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
        top: 35%;
        left: 7%;
        width: 122px; 
    }
 </style>
</head>

<body class="common-home res layout-3">
    <div id="page_loader" class="mypageloader">
    <div class="pageloader">
       <img src="<?php echo base_url(); ?>assets/web/images/logo/loader.gif" title="Zanomy loader" alt="Zanomy loader" />
    </div>
</div>
    <div class="ajax-loader">
        <img src="<?php echo base_url('assets');?>/ajax-loader.gif" class="img-responsive" />
    </div>
    <div id="wrapper" class="wrapper-fluid banners-effect-10">
        <header id="header" class=" typeheader-3">
            <div class="header-top hidden-compact">
                <div class="container">
                    <div class="row">
                        <div class="header-top-left  col-lg-6 col-md-5 col-sm-6 col-xs-5">
                            <div class="hidden-sm hidden-xs welcome-msg"><span>Location for Service : </span> <b><i class="fa fa-map-marker"></i></b> H-5454 New Road Libya <span class="editaddress"><a href="#"><i class="fa fa-edit"></i></a></span></div>
                        </div>
                        <div class="header-top-right collapsed-block col-lg-6 col-md-7 col-sm-6 col-xs-7">
                            <div class="telephone hidden-xs hidden-sm hidden-md">
                                <ul class="socials">
                                    <li class="facebook"><a class="_blank" href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li class="twitter"><a class="_blank" href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li class="google_plus"><a class="_blank" href="#" target="_blank"><i class="fa fa-google-plus"></i></a>
                                    </li>
                                    <li class="pinterest"><a class="_blank" href="#" target="_blank"><i class="fa fa-pinterest"></i></a>
                                    </li>
                                    <li class="youtube"><a class="_blank" href="#" target="_blank"><i class="fa fa-youtube-play"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <ul class="top-link list-inline lang-curr">
                                <li class="currency">
                                <?php if (!$this->session->userdata('zanomy_user_logged_in')): ?>
                                    <div class="btn-group currencies-block">
                                        <a href="#" title="My Account " class="btn-xs dropdown-toggle" data-toggle="dropdown"> <span>Join Now </span> <span class="fa fa-caret-down"></span></a>
                                        <ul class="dropdown-menu btn-xs">
                                            <li> <a href="<?php echo base_url('user-registration'); ?>"><i class="fa fa-user"></i> Register</a></li>
                                            <li> <a href="<?php echo base_url('user-login'); ?>"><i class="fa fa-sign-in"></i> Login</a></li>
                                        </ul>
                                    </div>
                                <?php else:?>
                                    <div class="btn-group currencies-block">
                                        <a href="#" title="My Account " class="btn-xs dropdown-toggle" data-toggle="dropdown"> <span>My Account </span> <span class="fa fa-caret-down"></span></a>
                                        <ul class="dropdown-menu btn-xs">
                                            <li> <a href="<?php echo base_url('my-account'); ?>"><i class="fa fa-user"></i> My Profile</a></li>
                                            <li> <a style="cursor:pointer;" onclick="userLogout();"><i class="fa fa-sign-in">&nbsp; </i>Logout</a></li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="navbar-logo col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <div class="logo"><a href="<?php echo base_url(''); ?>"><img src="<?php echo base_url(); ?>assets/web/images/logo/logo.png" title="Zanomy Logo" alt="Zanomy Logo" /></a></div>
                        </div>
                        <div class="middle2 col-lg-6 col-md-6">
                            <div class="search-header-w">
                                <div class="icon-search hidden-lg hidden-md hidden-sm"><i class="fa fa-search"></i></div>
                                <div id="sosearchpro" class="sosearchpro-wrapper so-search ">
                                    <form>
                                        <div id="search0" class="search input-group form-group">
                                            <?php $search=$this->uri->segment('1'); if(isset($search) and $search=='search-product'):
                                                $searchData=str_replace('%20',' ',$this->uri->segment(2));
                                             if(isset($searchData) and $searchData): $getValue=$searchData; else: $getValue=""; endif; ?>
                                                <input class="autosearch-input form-control" id="search_product_text" onkeypress="submissionSearchForm(this);" value="<?=$getValue;?>" type="text" placeholder="Search  For  Product" name="search">
                                            <?php else: ?>
                                                <input class="autosearch-input form-control" id="search_product_text" onkeypress="submissionSearchForm(this);" type="text" placeholder="Search  For  Product" name="search">
                                            <?php endif; ?>
                                            <span class="input-group-btn">
                                                <button type="button" onclick="searchProductData(this);" id="searchProductButton" class="button-search btn btn-primary" name="submit_search"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                        <input type="hidden" name="route" value="product/search" />
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="middle3 col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="shopping_cart">
                                <div id="cart" class="btn-shopping-cart">
                                <?php if(isset($user_cart['cart'][0]) and $user_cart['cart'][0]): ?>
                                    <a class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <div class="shopcart">
                                            <span class="icon-c">
                                                    <i class="fa fa-shopping-bag"></i>
                                                </span>
                                            <div class="shopcart-inner">
                                                <p class="text-shopping-cart">
                                                    My cart
                                                </p>
                                                <span class="total-shopping-cart cart-total-full">
                                                        <span class="items_cart"><?=count($user_cart['cart']);?></span><span class="items_cart2"> item(s)</span><span class="items_carts"> - <?=$user_cart['total_amount'];?> LYD</span>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu pull-right shoppingcart-box" role="menu">
                                        <li>
                                            <table class="table table-striped">
                                                <tbody>
                                                    <?php if(isset($user_cart['cart']) and $user_cart['cart']): 
                                                        foreach($user_cart['cart'] as $cart): ?>
                                                    <tr>
                                                        <td class="text-center" style="width:70px">
                                                            <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cart['name'])).'/'.$cart['product_id'].'/'.$cart['item_id']); ?>">
                                                                <img src="<?=$cart['images'][0]['image'];?>" style="width:70px" alt="<?=$cart['name'];?>" title="<?=$cart['name'];?>" class="preview">
                                                            </a>
                                                        </td>
                                                        <td class="text-left"> <a class="cart_product_name" href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $cart['name'])).'/'.$cart['product_id'].'/'.$cart['item_id']); ?>"><?=$cart['name'];?></a>
                                                        </td>
                                                        <td class="text-center">x<?=$cart['cart_quentity'];?></td>
                                                        <td class="text-center"><?=$cart['amount'];?> LYD</td>
                                                        <td class="text-right">
                                                            <a href="<?php echo base_url(''); ?>" class="fa fa-edit"></a>
                                                        </td>
                                                        <td class="text-right">
                                                            <a class="fa fa-times fa-delete" onclick="addToCart(this,'<?=$cart['product_id'];?>','<?=$cart['item_id'];?>','3');"></a>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; endif; ?>
                                                </tbody>
                                            </table>
                                        </li>
                                        <li>
                                            <div>
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-left"><strong>No of Item</strong>
                                                            </td>
                                                            <td class="text-right"><?=count($user_cart['cart']);?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-left"><strong>Total</strong>
                                                            </td>
                                                            <td class="text-right"><?=($user_cart['total_amount']);?> LYD</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p class="text-right"> <a class="btn view-cart" href="<?php echo base_url('my-cart'); ?>"><i class="fa fa-shopping-cart"></i>View Cart</a>&nbsp;&nbsp;&nbsp; <a class="btn btn-mega checkout-cart" href="<?php echo base_url('checkout'); ?>"><i class="fa fa-share"></i>Checkout</a>
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                <?php else: ?>
                                    <a class="btn-group top_cart dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        <div class="shopcart">
                                            <span class="icon-c">
                                                    <i class="fa fa-shopping-bag"></i>
                                                </span>
                                            <div class="shopcart-inner">
                                                <p class="text-shopping-cart">
                                                    My cart
                                                </p>
                                                <span class="total-shopping-cart cart-total-full">
                                                        <span class="items_cart">0</span><span class="items_cart2"> item(s)</span><span class="items_carts"> - 0 LYD</span>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                                </div>
                            </div>
                                <li class="language">
                                    <div class="btn-group languages-block ">
                                        <a class="btn-link dropdown-toggle" data-toggle="dropdown">
                                                    <img src="<?php echo base_url(); ?>assets/web/images/flags/gb.png" class="image_flag" alt="English" title="English">
                                                    <span class="sm">English</span>
                                                    <span class="fa fa-caret-down"></span>
                                                </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url(''); ?>"><img class="image_flag" src="<?php echo base_url(); ?>assets/web/images/flags/gb.png" alt="English" title="English" /> English </a></li>
                                            <li> <a href="<?php echo base_url(''); ?>"> <img class="image_flag" src="<?php echo base_url(); ?>assets/web/images/flags/ar.png" alt="Arabic" title="Arabic" /> Arabic </a> </li>
                                        </ul>
                                    </div>
                                </li>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom hidden-compact">
                <div class="container">
                    <div class="row">
                        <div class="main-menu col-lg-9 col-md-8 col-sm-6 col-xs-5">
                            <div class="responsive so-megamenu megamenu-style-dev">
                                <nav class="navbar-default">
                                    <div class=" container-megamenu  horizontal open ">
                                        <div class="navbar-header">
                                            <button type="button" id="show-megamenu" data-toggle="collapse" class="navbar-toggle">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                        </div>
                                        <div class="megamenu-wrapper">
                                            <span id="remove-megamenu" class="fa fa-times"></span>
                                            <div class="megamenu-pattern">
                                                <div class="container-mega">
                                                    <ul class="megamenu" data-transition="slide" data-animationtime="250">
                                                        <li class="">
                                                            <p class="close-menu"></p><a href="<?php echo base_url(''); ?>" class="clearfix"><strong>Home</strong><span class="label"></span></a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p><a href="<?php echo base_url('about-us'); ?>" class="clearfix"><strong>About Us</strong><span class="label"></span></a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p><a href="<?php echo base_url('product-category'); ?>" class="clearfix"><strong>Categories</strong><span class="label"></span></a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p><a href="<?php echo base_url('service-category'); ?>" class="clearfix"><strong>Services</strong><span class="label"></span></a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="<?php echo base_url('terms-and-condition'); ?>" class="clearfix">
                                                                <strong>Terms</strong>

                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="<?php echo base_url(''); ?>" class="clearfix">
                                                                <strong>Vendors</strong>
                                                                <span class="label"></span>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="<?php echo base_url('how-it-work'); ?>" class="clearfix">
                                                                <strong>How it Work</strong>
                                                                <span class="label"></span>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <p class="close-menu"></p>
                                                            <a href="<?php echo base_url('contact-us'); ?>" class="clearfix">
                                                                <strong>Contact Us</strong>
                                                                <span class="label"></span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <script>
            function searchProductData(o){
                var valueData=$.trim($("#search_product_text").val());
                if(valueData){
                    window.location.href="<?=base_url('search-product/');?>"+valueData;
                }
            }
            
            function submissionSearchForm(o){
                if (event.keyCode === 13) {
                        event.preventDefault();
                        $("#searchProductButton").click();
                    }
            }
        </script>
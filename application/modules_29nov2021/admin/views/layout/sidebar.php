<?php
$urlSegment = $this->uri->segment(2);
$admin_login = $this->session->userdata('admin_logged_in');
if ($admin_login['type']) {
    ?>
    <style>
        #sidebarUl li{
            display: none;
        }
    </style>
<?php } ?>
<aside class="main-sidebar"> 
    <div class="sidebar"> 
        <div class="user-panel">
            <div class="image text-center">
                <img src="<?php echo site_url(); ?>assets/admin/images/logo_zanomy_white.png"  alt="logo"> 
            </div> 
        </div>
        <ul class="sidebar-menu" id="sidebarUl" data-widget="tree">
            <li class="<?php
            if ($urlSegment == "dashboard") {
                echo "active";
            }
            ?> dashboard"> <a href="<?php echo site_url('admin/dashboard'); ?>">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/dashboard.png"  alt="dashboard"> <span>Dashboard</span></a>
            </li>
            <li class="<?php
            if ($urlSegment == "user-list" or $urlSegment == "user-detail") {
                echo "active";
            }
            ?>"> <a href="<?php echo site_url('admin/user-list'); ?>">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/users.png"  alt="User Management"> <span>User Management</span></a></li> 
            <li class="treeview <?php
            if ($urlSegment == "product-vendor-list" or $urlSegment == "vendor-detail" or $urlSegment == "vendor-commission" or $urlSegment == "service-vendor-list") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/vendor.png"  alt="Vendor Management"><span>Vendor Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/product-vendor-list'); ?>"> Products Vendor</a></li>
                    <li><a href="<?php echo site_url('admin/service-vendor-list'); ?>"> Services Vendor</a></li> 
                    <li><a href="<?php echo site_url('admin/vendor-commission'); ?>"> Vendor Commission</a></li> 
                </ul>
            </li>
            <li class="<?php
            if ($urlSegment == "driver-list" or $urlSegment == "driver-detail") {
                echo "active";
            }
            ?>"> <a href="<?php echo site_url('admin/driver-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/driver.png"  alt="Driver Management"><span>Driver Management</span> </a>  </li>

            <li class="treeview <?php
            if ($urlSegment == "admin-product-list" or $urlSegment == "add-new-product" or $urlSegment == 'vendor-product-list' or $urlSegment == "add-more-attribute" or $urlSegment == "product-detail" or $urlSegment == "edit-product-detail" or $urlSegment == "edit-attribute" or $urlSegment == "vendor-unverified-product-list" or $urlSegment == "vendor-rejected-product-list") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/product.png"  alt="Category Management"><span>Product Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/vendor-product-list'); ?>"> Vendor Verified Product </a></li> 
                    <li><a href="<?php echo site_url('admin/vendor-unverified-product-list'); ?>"> Vendor Unverified Product </a></li>
                    <li><a href="<?php echo site_url('admin/vendor-rejected-product-list'); ?>"> Vendor Rejected Product </a></li>
                    <li><a href="<?php echo site_url('admin/admin-product-list'); ?>"> Admin Product List</a></li>
                    <li><a href="<?php echo site_url('admin/add-new-product'); ?>"> Add New Product</a></li>
                    <li><a href="<?php echo site_url('admin/add-product-price'); ?>"> Add Product Price</a></li>
                </ul>
            </li>

            <li class="treeview <?php
            if ($urlSegment == "subcategory-list" or $urlSegment == "category-list" or $urlSegment == "service-category-list" or $urlSegment == "service-subcategory-list") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/subcategory.png"  alt="Product Management"><span>Category Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li> <a href="<?php echo site_url('admin/category-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/category.png"  alt="Product Category"> <span>Product Category</span> </a>  </li>  
                    <li> <a href="<?php echo site_url('admin/subcategory-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/subcategory.png"  alt="Product Sub Category"> <span>Product Sub Category</span> </a>  </li>  
                    <li> <a href="<?php echo site_url('admin/service-category-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/category.png"  alt="Service Category"> <span>Service Category</span> </a>  </li>  
                    <li> <a href="<?php echo site_url('admin/service-subcategory-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/subcategory.png"  alt="Service Sub Category"> <span>Service Sub Category</span> </a>  </li>  
                </ul>
            </li>

            <li  class="treeview <?php
            if ($urlSegment == "brand-list" or $urlSegment == "brand-mapping") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/category.png"  alt="Brand Management"><span>Brand Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li> <a href="<?php echo site_url('admin/brand-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/product.png" alt="Add Brand"> <span>Add Brand</span> </a>  </li>
                    <li> <a href="<?php echo site_url('admin/brand-mapping'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/product.png" alt="Add Brand"> <span>Map Brand</span> </a>  </li>
                </ul>
            </li>

            <li class="treeview <?php
            if ($urlSegment == "model-list" or $urlSegment == "map-model") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/return.png"  alt="Brand Management"><span>Model Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li> <a href="<?php echo site_url('admin/model-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/product.png" alt="Model Management"> <span>Add Model</span> </a>  </li> 
                    <li> <a href="<?php echo site_url('admin/map-model'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/product.png" alt="Model Management"> <span>Map Model</span> </a>  </li> 
                </ul>
            </li>


            <li class="treeview <?php
            if ($urlSegment == "add-attribute" or $urlSegment == "attribute-list" or $urlSegment == "map-attribute") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/attributes.png"  alt="Brand Management"><span>Attribute Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li> <a href="<?php echo site_url('admin/add-attribute'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/attributes.png"  alt="Attribute Management"> <span>Add Attribute</span> </a>  </li>  
                    <li> <a href="<?php echo site_url('admin/attribute-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/attributes.png"  alt="Attribute Management"> <span>Attribute List</span> </a>  </li>  
                    <li> <a href="<?php echo site_url('admin/map-attribute'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/attributes.png"  alt="Attribute Management"> <span>Map Attribute</span> </a>  </li>  
                </ul>
            </li>
            <li class="treeview <?php
            if ($urlSegment == "hub-list" or $urlSegment == "city-list" or $urlSegment == "delivery-charge") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/delivery.png"  alt="Product Management"><span>Delivery  Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li> <a href="<?php echo site_url('admin/hub-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/category.png"  alt="Hubs Management"> <span>Add Hubs</span> </a>  </li>  
                    <li> <a href="<?php echo site_url('admin/city-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/subcategory.png"  alt="City Management"> <span>Add City </span> </a>  </li>  
                    <li> <a href="<?php echo site_url('admin/delivery-charge'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/category.png"  alt="Delivery Charge Management<"> <span>Add Delivery Charge</span> </a>  </li>  
                </ul>
            </li>
            <li class="<?php
            if ($urlSegment == "order-status-management") {
                echo "active";
            }
            ?>"> <a href="<?php echo site_url('admin/order-status-management'); ?>">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/order.png"  alt="dashboard"> <span>Order Status Management</span></a>
            </li>

        <!-- <li class="treeview"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/product.png"  alt="Brand Management"><span>Featuers Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
          <ul class="treeview-menu">
          <li> <a href="<?php echo site_url('admin/add-featuers'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/attributes.png"  alt="Attribute Management"> <span>Add Featuers</span> </a>  </li>  
          <li> <a href="<?php echo site_url('admin/map-featuers'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/attributes.png"  alt="Attribute Management"> <span>Map Featuers</span> </a>  </li>  
          </ul>
        </li> -->

            <li class="treeview <?php
            if ($urlSegment == "vendor-service-list") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/service.png"  alt="Servive Management"><span>Service Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/vendor-service-list'); ?>"> Vendor Service List</a></li>
                    <!--<li><a href="<?php echo site_url('admin/admin-service-list'); ?>"> Admin Service List</a></li>-->
                    <!--<li><a href="<?php echo site_url('admin/add-new-service'); ?>"> Add New Service</a></li>-->
                </ul>
            </li>

            <li class="treeview <?php
            if ($urlSegment == "vendor-order-list" or $urlSegment == "admin-order-list") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/order.png"  alt="Order Management"><span>Order Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <!-- <li><a href="<?php echo site_url('admin/vendor-order-list'); ?>"> Vendor Order List</a></li>
                    <li><a href="<?php echo site_url('admin/admin-order-list'); ?>"> Admin Order List</a></li> -->
                    <li><a href="<?php echo site_url('admin/new-order-list'); ?>"> New Order List</a></li>
                    <li><a href="<?php echo site_url('admin/return-order-list'); ?>">Return Order List</a></li>                    
                    <!-- <li><a href="<?php echo site_url('admin/upfront-payment-order-list'); ?>"> Upfront Payment Order List</a></li>
                    <li><a href="<?php echo site_url('admin/verified-upfront-payment-order-list'); ?>"> Verified Upfront Order List</a></li>
                    <li><a href="<?php echo site_url('admin/inprocess-order-list'); ?>"> In-Process Order List</a></li>
                    <li><a href="<?php echo site_url('admin/completed-order-list'); ?>"> Completed Order List</a></li> -->
                </ul>
            </li>
            <li class="<?php
            if ($urlSegment == "subscription-plan-list") {
                echo "active";
            }
            ?>"> <a href="<?php echo site_url('admin/subscription-plan-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/subscription.png"  alt="Subscription plan Management"> <span>Subscription Management</span> </a>  </li>  
            <li class="treeview <?php
            if ($urlSegment == "about-us" || $urlSegment == "edit-about-us" || $urlSegment == "term-conditions" || $urlSegment == "edit-term-conditions" || $urlSegment == "privacy-policy" || $urlSegment == "edit-privacy-policy" || $urlSegment == "banner-management" || $urlSegment == "upfront-management" || $urlSegment == "set-popular-service" || $urlSegment == "set-most-selling-products" || $urlSegment == "set-most-viewed-products") {
                echo "active";
            }
            ?>"> <a href="#"><img src="<?php echo site_url(); ?>assets/admin/images/sideimg/return.png"  alt="Settings"><span>Settings</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/about-us'); ?>">About Us</a></li>
                    <li><a href="<?php echo site_url('admin/term-conditions'); ?>">Term & Conditions</a></li>
                    <li><a href="<?php echo site_url('admin/privacy-policy'); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo site_url('admin/banner-management'); ?>"> App Banner Management</a></li>
                    <li><a href="<?php echo site_url('admin/upfront-management'); ?>"> Upfront Management</a></li>
                    <li><a href="<?php echo site_url('admin/set-most-viewed-products'); ?>"> Set Most Viewed Products</a></li>
                    <li><a href="<?php echo site_url('admin/set-most-selling-products'); ?>"> Set Most Selling Products</a></li>
                    <li><a href="<?php echo site_url('admin/set-popular-service'); ?>"> Set Popular Services </a></li>
                </ul>
            </li>
            <li class="treeview"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/booking.png"  alt="Booking Management"><span>Request Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/vendor-request-list'); ?>"> Request List</a></li>
                </ul>
            </li>
            <li class="treeview"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/booking.png"  alt="Booking Management"><span>Booking Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/vendor-booking-list'); ?>"> Active Booking List</a></li>
                    <li><a href="<?php echo site_url('admin/vendor-complted-booking-list'); ?>"> Completed Booking List</a></li>
                    <!--<li><a href="<?php echo site_url('admin/admin-booking-list'); ?>"> Admin Booking List</a></li>-->
                </ul>
            </li>
            <!--
            
             <li class="treeview"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/return.png"  alt="Return Management"><span>Return Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('admin/vendor-return-list'); ?>"> Vendor Return List</a></li>
                <li><a href="<?php echo site_url('admin/admin-return-list'); ?>"> Admin Return List</a></li>
              </ul>
            </li>
             <li> <a href="<?php echo site_url('admin/delivery-charge-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/delivery.png"  alt="Delivery Charge Management"> <span>Delivery Charge Management</span> </a>  </li>  
             
             <li> <a href="<?php echo site_url('admin/sub-admin-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/subadmin.png"  alt="Sub admin Management"> <span>Sub admin Management</span> </a>  </li>  
            <li class="treeview"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/query.png"  alt="Query Management"><span>Query Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('admin/user-query-list'); ?>"> User Query List</a></li>
                <li><a href="<?php echo site_url('admin/vendor-query-list'); ?>"> Vendor Query List</a></li>
                <li><a href="<?php echo site_url('admin/contact-query-list'); ?>"> Contact Query List</a></li>
              </ul>
            </li>  
            <li class="treeview"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/setting.png"  alt="Admin Setting"><span>Admin Setting</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
              <ul class="treeview-menu">
                <li><a href="<?php echo site_url('admin/user-query-list'); ?>"> Page List</a></li>
              </ul>
            </li> ----->

            <li class="treeview <?php
            if ($urlSegment == "add-coupons" or $urlSegment == "coupons-list") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/service.png"  alt="Servive Management"><span>Coupon Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/add-coupons'); ?>"> Add Coupons</a></li>
                    <li><a href="<?php echo site_url('admin/coupons-list'); ?>">  Coupon List</a></li>
                </ul>
            </li>

            <?php
            if ($this->session->userdata('admin_logged_in')) {
                $adminData = $this->session->userdata('admin_logged_in');
                if ($adminData['type'] == 0) {
                    ?>
                    <li class="<?php
                    if ($urlSegment == "sub-admin-list") {
                        echo "active";
                    }
                    ?>"> <a href="<?php echo site_url('admin/sub-admin-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/subadmin.png"  alt="Sub admin Management"> <span>Sub admin Management</span> </a>  </li>  
                        <?php
                    }
                }
                ?>
            <li class="treeview <?php
            if ($urlSegment == "support-reason-list" or $urlSegment == "user-query-list" or $urlSegment == "vendor-query-list" or $urlSegment == "driver-query-list") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/query.png"  alt="Query Management"><span>Query Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/support-reason-list'); ?>"> Reason Management</a></li>
                    <li><a href="<?php echo site_url('admin/user-query-list'); ?>"> User Query List</a></li>
                    <li><a href="<?php echo site_url('admin/vendor-query-list'); ?>"> Vendor Query List</a></li>
                    <li><a href="<?php echo site_url('admin/driver-query-list'); ?>"> Driver Query List</a></li>
                </ul>
            </li>

            <li class="treeview <?php
            if ($urlSegment == "user-note" or $urlSegment == "user-note-list" or $urlSegment == "vendor-note" or $urlSegment == "vendor-note-list" or $urlSegment == "send-user-notification" or $urlSegment == "send-notification") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/query.png"  alt="Query Management"><span>Notes Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <!-- <li><a href="<?php echo site_url('admin/user-note'); ?>"> Add User Note</a></li>
                    <li><a href="<?php echo site_url('admin/user-note-list'); ?>"> User Note List</a></li>
                    <li><a href="<?php echo site_url('admin/vendor-note'); ?>"> Add Vendor Note</a></li>
                    <li><a href="<?php echo site_url('admin/vendor-note-list'); ?>"> Vendor Note List</a></li> -->
                    <li><a href="<?php echo site_url('admin/send-user-notification'); ?>"> Send User Notification</a></li>
                    <li><a href="<?php echo site_url('admin/send-notification'); ?>"> Send Notification To All</a></li>
                </ul>
            </li>

        </ul>
    </div>
</aside>
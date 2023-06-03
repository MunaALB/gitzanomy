<?php $urlSegment = $this->uri->segment(2); ?>
<aside class="main-sidebar"> 
    <div class="sidebar"> 
        <div class="user-panel">
            <div class="image text-center">
                <img src="<?php echo site_url(); ?>assets/admin/images/logo_zanomy_white.png"  alt="logo"> 
            </div> 
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="<?php
            if ($urlSegment == "dashboard") {
                echo "active";
            }
            ?>"> <a href="<?php echo site_url('admin/dashboard'); ?>">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/dashboard.png"  alt="dashboard"> <span>Dashboard</span></a>
            </li>
            <li class="<?php
            if ($urlSegment == "user-list" or $urlSegment == "user-detail") {
                echo "active";
            }
            ?>"> <a href="<?php echo site_url('admin/user-list'); ?>">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/users.png"  alt="User Management"> <span>User Management</span></a></li> 
            <li class="treeview <?php
            if ($urlSegment == "product-vendor-list" or $urlSegment == "vendor-detail") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/vendor.png"  alt="Vendor Management"><span>Vendor Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/product-vendor-list'); ?>"> Products Vendor</a></li>
                    <li><a href="<?php echo site_url('admin/service-vendor-list'); ?>"> Services Vendor</a></li> 
                </ul>
            </li>
            <li class="<?php
            if ($urlSegment == "driver-list" or $urlSegment == "driver-detail") {
                echo "active";
            }
            ?>"> <a href="<?php echo site_url('admin/driver-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/driver.png"  alt="Driver Management"><span>Driver Management</span> </a>  </li>

            <li class="treeview <?php
            if ($urlSegment == "admin-product-list" or $urlSegment == "add-new-product" or $urlSegment == "add-more-attribute" or $urlSegment == "product-detail" or $urlSegment == "edit-product-detail" or $urlSegment == "edit-attribute") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/product.png"  alt="Category Management"><span>Product Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                  <!-- <li><a href="<?php echo site_url('admin/vendor-product-list'); ?>"> Vendor Product List</a></li> -->
                    <li><a href="<?php echo site_url('admin/admin-product-list'); ?>"> Admin Product List</a></li>
                    <li><a href="<?php echo site_url('admin/add-new-product'); ?>"> Add New Product</a></li>
                </ul>
            </li>

            <li class="treeview <?php
            if ($urlSegment == "subcategory-list" or $urlSegment == "category-list") {
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
            if ($urlSegment == "brand-list") {
                echo "active";
            }
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/category.png"  alt="Brand Management"><span>Brand Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li> <a href="<?php echo site_url('admin/brand-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/product.png" alt="Add Brand"> <span>Add Brand</span> </a>  </li>
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
            ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/delivery.png"  alt="Product Management"><span>Delivery Charge Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
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

            <li class="treeview"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/service.png"  alt="Servive Management"><span>Servive Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
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
                    <li><a href="<?php echo site_url('admin/vendor-order-list'); ?>"> Vendor Order List</a></li>
                    <li><a href="<?php echo site_url('admin/admin-order-list'); ?>"> Admin Order List</a></li>
                </ul>
            </li>
            <li> <a href="<?php echo site_url('admin/subscription-plan-list'); ?>"> <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/subscription.png"  alt="Subscription plan Management"> <span>Subscription Management</span> </a>  </li>  
<li class="treeview <?php
            if ($urlSegment == "upfront-management") {
                echo "active";
            }
            ?>"> <a href="#"><span>Settings</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo site_url('admin/upfront-management'); ?>"> Upfront Management</a></li>
                </ul>
            </li>
            <!--
<li class="treeview"> <a href="#">  <img src="<?php echo site_url(); ?>assets/admin/images/sideimg/booking.png"  alt="Booking Management"><span>Booking Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
  <ul class="treeview-menu">
    <li><a href="<?php echo site_url('admin/vendor-booking-list'); ?>"> Vendor Booking List</a></li>
    <li><a href="<?php echo site_url('admin/admin-booking-list'); ?>"> Admin Booking List</a></li>
  </ul>
</li>

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
        </ul>
    </div>
</aside>
<?php $urlSegment = $this->uri->segment(2); ?>
<aside class="main-sidebar"> 
    <div class="sidebar"> 
        <div class="user-panel">
            <div class="image text-center"><img src="<?php echo site_url(); ?>assets/vendor/images/logo_zanomy_white.png"  alt="logo"> </div> 
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="<?= ($urlSegment == "dashboard") ? "active" : ''; ?>"> 
                <a href="<?php echo site_url('vendor/dashboard'); ?>">  <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/dashboard.png"  alt="dashboard"> <span>لوحة الرئيسية</span>
                </a>
            </li>
            <?php if ($this->vendor_data['business_type'] == 1): ?>


                <!-- <li class="treeview <?= ($urlSegment == "product-list" || $urlSegment == "product-detail" || $urlSegment=="edit-product-detail") ? "active" : ''; ?>"> <a href="#">  <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/quantity.png" alt="Category Management"><span>Product Management</span><span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span></a>
                    <ul class="treeview-menu" style="border-radius: 0px 0px 0px 0px;">
                        <li><a href="<?php echo site_url('vendor/product-list'); ?>">Verified Product </a></li> 
                        <li><a href="<?php echo site_url('vendor/unverified-product-list'); ?>">Un-Verified Product </a></li> 
                        <li><a href="<?php echo site_url('vendor/pending-product-list'); ?>">Pending Product </a></li> 
                        <li><a href="<?php echo site_url('vendor/rejected-product-list'); ?>">Rejected Product </a></li> 
                        
                    </ul>
                </li> -->



                <li class="<?= ($urlSegment == "product-list" || $urlSegment == "product-detail") ? "active" : ''; ?>"> <a href="<?php echo site_url('vendor/product-list'); ?>">  <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/quantity.png"  alt="product list"> <span>ادارة المنتجات</span></a></li> 
                <li class="<?= ($urlSegment == "order-list" || $urlSegment == "order-detail") ? "active" : ''; ?>"> <a href="<?php echo site_url('vendor/order-list'); ?>"> <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/order.png"  alt="Order Management"> <span>إدارة الطلبات</span> </a>  </li>
            <?php else: ?>
                <li class="<?= ($urlSegment == "service-list" || $urlSegment == "service-detail") ? "active" : ''; ?>"> <a href="<?php echo site_url('vendor/service-list'); ?>"> <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/service.png"  alt="Service Management"> <span>إدارة الخدمات</span> </a>  </li>
                <li class="<?= ($urlSegment == "request-list" || $urlSegment == "request-detail") ? "active" : ''; ?>"> <a href="<?php echo site_url('vendor/request-list'); ?>"> <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/booking.png"  alt="Request Management"> <span>إدارة الطلب</span> </a>  </li> 
                <li class="<?= ($urlSegment == "booking-list" || $urlSegment == "booking-detail") ? "active" : ''; ?>"> <a href="<?php echo site_url('vendor/booking-list'); ?>"> <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/booking.png"  alt="Booking Management"> <span>إدارة الحجز</span> </a>  </li> 
                <li class="<?= ($urlSegment == "subscription") ? "active" : ''; ?>"> <a href="<?php echo site_url('vendor/subscription'); ?>"> <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/transaction.png"  alt="Subscription Management"> <span>إدارة الاشتراك</span> </a>  </li>  
            <?php endif; ?>
            <!-- <li class="<?= ($urlSegment == "transaction-list") ? "active" : ''; ?>"> <a href="#"> <img src="<?php echo site_url(); ?>assets/vendor/images/sideimg/transaction.png"  alt="Transaction Management"> <span>ادارة عمليات التجارية</span> </a>  </li>   -->

        </ul>
    </div>
</aside>
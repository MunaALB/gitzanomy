<?php include 'include/header.php';?>
<?php include 'include/sidebar.php';?>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Verify Vendor  Item</h1>
    </div>
    <div class="content eventdeatil">
        <div class="card">
            <div class="">
                <div id="demo">
                    <div class="step-app order-tabs">
                        <ul class="step-steps">
                            <li class="active"><a href="#step1">Item Detail</a></li>
                            <li class=""><a href="#step2">Order Detail</a></li>
                            <li class=""><a href="#step3">User & Shipping Detail</a></li>
                        </ul>
                        <div class="step-content for-border-remove">
                            <div class="step-tab-panel active" id="step1">
                                <div class="card-body">
                                    <div class="eventrow">
                                        <div class="item-detail-buttons">
                                            <button type="button" class="btn btn-secondary">Assign of Upfront</button>
                                            <button type="button" class="btn btn-secondary active">Get an item</button>
                                            <button type="button" class="btn btn-secondary">Ready for Delivery</button>
                                        </div>
                                    </div>
                                    <div class="eventrow">
                                        <div class="vendor-admin-buttons">
                                            <button type="button" class="btn btn-secondary active">Vendor Item</button>
                                            <button type="button" class="btn btn-secondary">Admin Item</button>
                                        </div>
                                    </div>
                                    <div class="eventrow">
                                        <div class="submits-buttons">
                                            <button type="button" class="btn btn-secondary active">Assigned a Drive</button>
                                        </div>
                                    </div>
                                    <div class="driver-asssign-status">
                                        <div class="status-part">
                                            <ul>
                                                <li class="completed">Start Job</li>
                                                <li class="completed">On the way</li>
                                                <li class="completed">Reached at location</li>
                                                <li class="completed">Collect amount</li>
                                                <li class="completed">Reached at hub</li>
                                                <li class="completed">Deposit amount</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="verify-admin">
                                        <a href="#" class="active">Verified by Admin</a>
                                    </div>
                                </div>
                                <div class="order-products-list">
                                    <div class="card-body">
                                        <div class="card m-b-3 order-productss">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/dummy.jpg" class="img-responsive" alt="User Image" /></div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mail-contnet">
                                                            <h4 class="text-black m-b-0">Men Fashion T-Shirt</h4>
                                                            <small>Men Fashion</small>
                                                            <div class="product-price">
                                                                <span class="price-new">320.00 LYD</span>
                                                                <span class="price-old">350.00 LYD</span>
                                                            </div>
                                                            <p title="Phone">Quantity:<span> 1 </span></p>
                                                            <div class="view-detail"><a href="<?php echo site_url('product-detail');?>">View Product</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mail-contnet">
                                                            <h4 class="text-black m-b-0 pull-right">International Item</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-order-status">
                                                <div class="status-part">
                                                    <ul>
                                                        <li>Awaiting Confirmation</li>
                                                        <li>In Process</li>
                                                        <li>Dispatch</li>
                                                        <li>Delivered</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="oredr-lable"><p>Not Assigned</p></div>
                                            <div class="assign-driver-link"><a href="javascript:void(0)" id="adddriverlist">Assign a Driver</a></div>
                                        </div>
                                        <div class="card m-b-3 order-productss">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/dummy.jpg" class="img-responsive" alt="User Image" /></div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mail-contnet">
                                                            <h4 class="text-black m-b-0">Men Fashion T-Shirt</h4>
                                                            <small>Men Fashion</small>
                                                            <div class="product-price">
                                                                <span class="price-new">320.00 LYD</span>
                                                                <span class="price-old">350.00 LYD</span>
                                                            </div>
                                                            <p title="Phone">Quantity:<span> 1 </span></p>
                                                            <div class="view-detail"><a href="<?php echo site_url('product-detail');?>">View Product</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mail-contnet">
                                                            <h4 class="text-black m-b-0 pull-right">International Item</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-order-status">
                                                <div class="status-part">
                                                    <ul>
                                                        <li>Awaiting Confirmation</li>
                                                        <li>In Process</li>
                                                        <li>Dispatch</li>
                                                        <li>Delivered</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="oredr-lable"><p>Not Assigned</p></div>
                                            <div class="assign-driver-link"><a href="javascript:void(0)" id="adddriverlist">Assign a Driver</a></div>
                                        </div>
                                        <div class="card m-b-3 order-productss">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/dummy.jpg" class="img-responsive" alt="User Image" /></div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mail-contnet">
                                                            <h4 class="text-black m-b-0">Men Fashion T-Shirt</h4>
                                                            <small>Men Fashion</small>
                                                            <div class="product-price">
                                                                <span class="price-new">320.00 LYD</span>
                                                                <span class="price-old">350.00 LYD</span>
                                                            </div>
                                                            <p title="Phone">Quantity:<span> 1 </span></p>
                                                            <div class="view-detail"><a href="<?php echo site_url('product-detail');?>">View Product</a></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="mail-contnet">
                                                            <h4 class="text-black m-b-0 pull-right">International Item</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-order-status">
                                                <div class="status-part">
                                                    <ul>
                                                        <li>Awaiting Confirmation</li>
                                                        <li>In Process</li>
                                                        <li>Dispatch</li>
                                                        <li>Delivered</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="oredr-lable"><p>Not Assigned</p></div>
                                            <div class="assign-driver-link"><a href="javascript:void(0)" id="adddriverlist">Assign a Driver</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step-tab-panel for-border-remove" id="step2">
                                     <div class=" eventdeatil">
                                        <div class="card-body">
                                           <div class="eventrow">
                                              <div class="row mt-3">
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Order Items</label>
                                                    <br>
                                                    <p class="text-muted">3</p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Order Amount</label>
                                                    <br>
                                                    <p class="text-muted">200 LYD</p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Payment method</label>
                                                    <br>
                                                    <p class="text-muted">Cash on Delivery</p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Payment Status</label>
                                                    <br>
                                                    <p class="text-muted">Upfront amount paid</p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Delivery Charges</label>
                                                    <br>
                                                    <p class="text-muted">20 LYD</p>
                                                 </div>  
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Upfront Amount</label>
                                                    <br>
                                                    <p class="text-muted">50 LYD</p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Pending Amount</label>
                                                    <br>
                                                    <p class="text-muted">150 LYD</p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Ordered on & at</label>
                                                    <br>
                                                    <p class="text-muted">Feb 10, 2020   12:00 PM</p>
                                                 </div>  
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Status</label>
                                                    <br>
                                                    <p class="text-muted">In Process</p>
                                                 </div> 
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                            </div>
                            <div class="step-tab-panel for-border-remove" id="step3">
                                     <div class=" eventdeatil">
                                        <div class="card-body">
                                           <div class="eventrow">
                                              <div class="row mt-3">
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>User Name</label>
                                                    <br>
                                                    <p class="text-muted">Komal Garg</p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Conatct Number</label>
                                                    <br>
                                                    <p class="text-muted">+91 979787 567567</p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Email Address</label>
                                                    <br>
                                                    <p class="text-muted">Komal@gmail.com</p>
                                                 </div>
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>House Number</label>
                                                    <br>
                                                    <p class="text-muted">12 A </p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Streer</label>
                                                    <br>
                                                    <p class="text-muted">Tripoli</p>
                                                 </div>  
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Location</label>
                                                    <br>
                                                    <p class="text-muted">Mall Road</p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>City</label>
                                                    <br>
                                                    <p class="text-muted">Beheram</p>
                                                 </div> 
                                                 <div class="col-lg-4 col-xs-6 b-r">
                                                    <label>Country</label>
                                                    <br>
                                                    <p class="text-muted">Libya</p>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="asiign-driver-list" id="listdriver">
        <div class="row">
            <div class="col-lg-12 m-b-3">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Assign Driver
                            <span class="pull-right f-13">
                                <a href="javascript:void(0)" id="remove-driverlist"><i class="fa fa-times"></i></a>
                            </span>
                        </h5>
                        <div class="search-bar">
                            <div class="form-group">
                                <input class="form-control" placeholder="Search Driver..." />
                            </div>
                        </div>
                        <div class="driverilist-side">
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img1.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Mo Danish</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img2.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Akmal Khan</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img3.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Mo Imran</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img4.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Amit Kumar</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img5.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Sahid Khan</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img6.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Mo Igbal</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img7.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Dilip Kumar</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img8.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Gaurav Gupta</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img1.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Mo Danish</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                            <div class="message-widget">
                                <a href="#">
                                    <div class="user-img pull-left"><img src="<?php echo site_url();?>common/images/driver/img1.jpg" class="img-circle img-responsive" alt="User Image" /></div>
                                    <div class="mail-contnet">
                                        <h5>Mo Danish</h5>
                                        <span class="mail-desc"><i class="fa fa-phone"></i> +218 12341234 | <i class="fa fa-envelope"></i> driver@gmail.com</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'include/footer.php';?>
    <script type="text/javascript">
        $("#adddriverlist").click(function () {
            $("#listdriver").addClass("active");
        });
        $("#remove-driverlist").click(function () {
            $("#listdriver").removeClass("active");
        });
    </script>
</div>

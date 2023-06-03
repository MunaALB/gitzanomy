    <div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">User Dashboard</a></li>
            <li><a href="#">Favourite Services</a></li>
        </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                    <?php include 'layout/usersidebar.php';?>
                </aside>
                 <div id="content" class="col-sm-9 user-rightpart">
                    <h2 class="title">Favourite Services</h2>
                    <div class="user-gridpoints">
                        <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-center">Image</td>
                                            <td class="text-left">Service Name</td>
                                            <td class="text-left">Category</td>
                                            <td class="text-right">Vendor Name</td>
                                            <td class="text-right">Service Price</td>
                                            <td class="text-right">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?php echo base_url(''); ?>"><img width="70px" src="<?php echo base_url(); ?>assets/web/images/service/subcategory/01.jpg" alt="210 X210">
                                                </a>
                                            </td>
                                            <td class="text-left">Hair Cutting</td>
                                            <td class="text-left">Salon</td>
                                            <td class="text-right">Mo Rashid</td>
                                            <td class="text-right">
                                                <div class="price"> <span class="price-new">320.00 LYD</span> <span class="price-old">350.00 LYD</span></div>
                                            
                                            </td>
                                            <td class="text-right">
                                                <button class="btn btn-primary" title="" data-toggle="tooltip" onclick="cart.add('48');" type="button" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <a class="btn btn-danger" title="" data-toggle="tooltip" href="#" data-original-title="Remove"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?php echo base_url(''); ?>"><img width="70px" src="<?php echo base_url(); ?>assets/web/images/service/subcategory/02.jpg" alt="210 X210">
                                                </a>
                                            </td>
                                            <td class="text-left">Facial</td>
                                            <td class="text-left">Salon</td>
                                            <td class="text-right">Danish Khan</td>
                                            <td class="text-right">
                                                <div class="price"> <span class="price-new">500.00 LYD</span> <span class="price-old">550.00 LYD</span></div>
                                            </td>
                                            <td class="text-right">
                                                <button class="btn btn-primary" title="" data-toggle="tooltip" onclick="" type="button" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <a class="btn btn-danger" title="" data-toggle="tooltip" href="#" data-original-title="Remove"><i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?php echo base_url(''); ?>"><img width="70px" src="<?php echo base_url(); ?>assets/web/images/service/subcategory/03.jpg" alt="210 X210">
                                                </a>
                                            </td>
                                            <td class="text-left">Massage</td>
                                            <td class="text-left">Salon</td>
                                            <td class="text-right">Tahir Ansari</td>
                                            <td class="text-right">
                                                <div class="price"> <span class="price-new">200.00 LYD</span> <span class="price-old">220.00 LYD</span></div>
                                            </td>
                                            <td class="text-right">
                                                <button class="btn btn-primary" title="" data-toggle="tooltip" onclick="" type="button" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <a class="btn btn-danger" title="" data-toggle="tooltip" href="#" data-original-title="Remove"><i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?php echo base_url(''); ?>"><img width="70px" src="<?php echo base_url(); ?>assets/web/images/service/subcategory/04.jpg" alt="210 X210">
                                                </a>
                                            </td>
                                            <td class="text-left">Beard Styles</td>
                                            <td class="text-left">Salon</td>
                                            <td class="text-right">Yunus Khan</td>
                                            <td class="text-right">
                                                <div class="price"> <span class="price-new">180.00 LYD</span> <span class="price-old">200.00 LYD</span></div>
                                            </td>
                                            <td class="text-right">
                                                <button class="btn btn-primary" title="" data-toggle="tooltip" onclick="" type="button" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <a class="btn btn-danger" title="" data-toggle="tooltip" href="#" data-original-title="Remove"><i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
    </div>
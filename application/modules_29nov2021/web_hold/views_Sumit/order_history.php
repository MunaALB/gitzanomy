    <div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">User Dashboard</a></li>
            <li><a href="#">Order History</a></li>
        </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                    <?php include 'layout/usersidebar.php';?>
                </aside>
                 <div id="content" class="col-sm-9 user-rightpart">
                    <h2 class="title">Order History</h2>
                    <div class="user-gridpoints">
                        <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-center">Order Id</td>
                                            <td class="text-center">Order Date</td>
                                            <td class="text-center">Total Item</td>
                                            <td class="text-center">Upfront Amount</td>
                                            <td class="text-center">Total Amount</td>
                                            <td class="text-center">Order Status</td>
                                            <td class="text-center">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">#1001</td>
                                            <td class="text-center">20-02-2020</a></td>
                                            <td class="text-center">2 Product</td>
                                            <td class="text-center">120.00 LYD</td>
                                            <td class="text-center">320.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Delivered</span></div>
                                            
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title=""  href="<?php echo base_url('order-detail'); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1002</td>
                                            <td class="text-center">19-02-2020</a></td>
                                            <td class="text-center">3 Product</td>
                                            <td class="text-center">200.00 LYD</td>
                                            <td class="text-center">500.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Delivered</span></div>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title=""  href="<?php echo base_url('order-detail'); ?>" data-original-title="View"><i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1003</td>
                                            <td class="text-center">18-02-2020</a></td>
                                            <td class="text-center">2 Product</td>
                                            <td class="text-center">50.00 LYD</td>
                                            <td class="text-center">200.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Cancel</span></div>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title=""  href="<?php echo base_url('order-detail'); ?>" data-original-title="View"><i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1004</td>
                                            <td class="text-center">17-02-2020</a></td>
                                            <td class="text-center">4 Product</td>
                                            <td class="text-center">80.00 LYD</td>
                                            <td class="text-center">180.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">In Process</span></div>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title=""  href="<?php echo base_url('order-detail'); ?>" data-original-title="View"><i class="fa fa-eye"></i>
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
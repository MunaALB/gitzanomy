    <div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">User Dashboard</a></li>
            <li><a href="#">Booking History</a></li>
        </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                    <?php include 'layout/usersidebar.php';?>
                </aside>
                 <div id="content" class="col-sm-9 user-rightpart">
                    <h2 class="title">Booking History</h2>
                    <div class="user-gridpoints">
                        <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-center">Booking Id</td>
                                            <td class="text-center">Booking Date</td>
                                            <td class="text-center">Vendor Name</td>
                                            <td class="text-center">Booking Price</td>
                                            <td class="text-center">Booking Status</td>
                                            <td class="text-center">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">#1001</td>
                                            <td class="text-center">20-02-2020</a></td>
                                            <td class="text-center">Mo Danish</td>
                                            <td class="text-center">320.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Completed</span></div>
                                            
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title="" href="<?php echo base_url('booking-detail'); ?>" data-original-title="View"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1002</td>
                                            <td class="text-center">19-02-2020</a></td>
                                            <td class="text-center">Jakir Khan</td>
                                            <td class="text-center">500.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Completed</span></div>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title="" href="<?php echo base_url('booking-detail'); ?>" data-original-title="View"><i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1003</td>
                                            <td class="text-center">18-02-2020</a></td>
                                            <td class="text-center">Aman Kumar</td>
                                            <td class="text-center">200.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Cancel</span></div>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title="" href="<?php echo base_url('booking-detail'); ?>" data-original-title="View"><i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1004</td>
                                            <td class="text-center">17-02-2020</a></td>
                                            <td class="text-center">John Smith</td>
                                            <td class="text-center">180.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Pending</span></div>
                                            </td>
                                            <td class="text-center">
                                                <a class="btn btn-danger" title="" href="<?php echo base_url('booking-detail'); ?>" data-original-title="View"><i class="fa fa-eye"></i>
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
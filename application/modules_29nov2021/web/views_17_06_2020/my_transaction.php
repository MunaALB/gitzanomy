    <div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">User Dashboard</a></li>
            <li><a href="#">My Transaction</a></li>
        </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                    <?php include 'layout/usersidebar.php';?>
                </aside>
                 <div id="content" class="col-sm-9 user-rightpart">
                    <h2 class="title">My Transaction</h2>
                    <div class="user-gridpoints">
                        <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="text-center">Transaction Id</td>
                                            <td class="text-center">Transaction Date</td>
                                            <td class="text-center">Transaction Purpose</td>
                                            <td class="text-center">Transaction Price</td>
                                            <td class="text-center">Transaction Status</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">#1001</td>
                                            <td class="text-center">20-02-2020</a></td>
                                            <td class="text-center">Order Product</td>
                                            <td class="text-center">320.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Completed</span></div>
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1002</td>
                                            <td class="text-center">19-02-2020</a></td>
                                            <td class="text-center">Booking Service</td>
                                            <td class="text-center">500.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Completed</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1003</td>
                                            <td class="text-center">18-02-2020</a></td>
                                            <td class="text-center">Order Product</td>
                                            <td class="text-center">200.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Cancel</span></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">#1004</td>
                                            <td class="text-center">17-02-2020</a></td>
                                            <td class="text-center">Booking Service</td>
                                            <td class="text-center">180.00 LYD</td>
                                            <td class="text-center">
                                                <div class="price"> <span class="price-new">Pending</span></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
    </div>
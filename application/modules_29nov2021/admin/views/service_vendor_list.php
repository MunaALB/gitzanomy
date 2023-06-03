<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Service vendor List</h1>
    </div>
    <div class="content">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Vendor Id</th>
                                            <th>Vendor Name</th>
                                            <th>Business Name</th>
                                            <th>Business Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($service_list as $service):?>
                                        <tr>
                                            <td>#V1001</td>
                                            <td>Mo Danish</td>
                                            <td>Danish Pvt Ltd</td>
                                            <td>Salon</td>
                                            <td>
                                                <div class="mytoggle">
                                                    <label class="switch">
                                                        <input type="checkbox" checked="">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td><a href="<?php echo site_url('service-vendor-detail');?>" class="composemail">View</a></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
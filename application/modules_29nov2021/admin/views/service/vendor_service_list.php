<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Vendor Service List</h1>
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
                                            <th>Service ID</th>
                                            <th>Service Name</th>
                                            <th>Category Name</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($service_list as $service): ?>
                                    <tr>
                                        <td><a title="view detail" href="<?php echo site_url('admin/vendor-service-detail/' . $service['service_id']); ?>">#<?= $service['service_id'] ?></a></td>
                                        <td><?= $service['name'] ?></td>
                                        <td><?= $service['category_name'] ?></td>
                                        <td><?= $service['price'] ?> LYD</td>
                                        <td><span class="text-info"><?= $service['discount'] ? $service['discount'] . '%' : '0' ?></span></td>
                                        <td>
                                            <div class="mytoggle">
                                                <label class="switch">
                                                    <input type="checkbox" <?= $service['status'] == 1 ? 'checked' : '' ?>  onchange="checkStatusService(this,<?= $service['service_id'] ?>);">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- <a href="#" class="composemail"><i class="fa fa-edit"></i></a> -->
                                            <a href="#" onclick="deleteService(this, <?= $service['service_id'] ?>);" class="composemail"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
<?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
       
        
          
        function checkStatusService(obj, id) {
            var checked = $(obj).is(':checked');
            if (checked == true) {
                var status = 1;
            } else {
                var status = 2;
            }
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax_method",
                    type: 'post',
                    data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=6',
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
            }
        }
        function deleteService(obj, id) {
            var r = confirm("Are you sure to delete?");
            if (r == true) {
                var status = '99';
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax_method",
                        type: 'post',
                        data: 'method=updateStatus&id=' + id + '&action=' + status + '&type=6',
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "100") {
                                location.reload();
                            } else {
                                alert(jsonData['message']);
                            }
                        }
                    });
                } else {
                    alert("Something Wrong");
                }
            }
        }
    </script>
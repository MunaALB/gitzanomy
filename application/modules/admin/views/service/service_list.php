<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Service List</h1> 
    </div>
    <?= $this->session->flashdata('response') ?>
    <div class="content">
        <div class="row mb-3">
            <div class="col-md-12">  
                <a href="<?php echo site_url('vendor/add-new-service/'); ?>" class="composemail pull-right"><i class="fa fa-plus"></i> Add a new Service</a>   
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Service ID</th>
                                <th>Service Name</th>
                                <th>Service Category</th>
                                <th>Price</th>
                                <th>Added on & at</th>  
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php if ($service_list): foreach ($service_list as $service): ?>
                                    <tr>
                                        <td><a href="<?php echo site_url('admin/service-detail/' . $service['service_id']); ?>" title="view detail">#<?= $service['service_id'] ?></a></td>
                                        <td><?= $service['name'] ?></td>
                                        <td><?= $service['category_name'] ?></td>
                                        <td><?= $service['price'] ?> LYD</td>
                                        <td><?= $service['created_at'] ?></td>  
                                        <td>
                                            <div class="mytoggle">
                                                <label class="switch">
                                                    <input type="checkbox" <?=$service['status']==1?'checked':''?> onchange="checkStatus(this,<?=$service['service_id']?>);">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        <td>
                                            <a href="<?= base_url('admin/edit-service-detail/' . $service['service_id']); ?>" class="composemail"><i class="fa fa-edit"></i></a>
                                            <a style="cursor: pointer;" onclick="deleteProduct(this,<?=$service['service_id']?>);" class="composemail"><i class="fa fa-trash"></i></a>
                                        </td> 
                                    </tr> 
                                <?php endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
    <script>
        function checkStatus(obj, id) {
            var checked = $(obj).is(':checked');
            if (checked == true) {
                var status = 1;
            } else {
                var status = 2;
            }
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>vendor/Home/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=2',
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "200") {
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
        function deleteProduct(obj, id) {
            var r = confirm("Are you sure to delete?");
            if (r == true) {
                var status = '99';
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>vendor/Home/ajax",
                        type: 'post',
                        data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=2',
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
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
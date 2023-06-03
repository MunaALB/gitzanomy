<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Service List</h1> 
    </div>
    <?= $this->session->flashdata('response') ?>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <form method="post" >
                    <div class="eventrow">
                        <div class="row m-t-2">
                            <div class="col-md-4">
                                <label>Select Vendor</label>
                                <!-- <select class="form-control chosen regInputs" id="brand" data-title="Brand" onchange="getbrandModel(this);"> -->
                                <select class="form-control chosen regInputs" id="vendor" data-title="Vendor" name="vendor_id">
                                    <option value="">--SELECT VENDOR--</option>
                                    <?php if ($vendor_list): foreach ($vendor_list as $list): ?>
                                            <option value="<?= $list['vendor_id']; ?>" <?= set_value('vendor_id') ? ( $list['vendor_id'] == set_value('vendor_id') ? 'selected' : '') : '' ?>><?= $list['name']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <p class="errorPrint" id="vendorError"></p>
                            </div>
                            <div class="col-md-4">
                                <label>Select Category</label>
                                <select class="form-control chosen regInputs" data-title="Category" id="category" name="category_id" onchange="getSubCategory(this);">
                                    <option value="">--SELECT CATEGORY--</option>
                                    <?php if ($category_list): foreach ($category_list as $list): ?>
                                            <option value="<?= $list['category_id']; ?>" <?= set_value('category_id') ? ( $list['category_id'] == set_value('category_id') ? 'selected' : '') : '' ?>><?= $list['name']; ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <p class="errorPrint" id="categoryError"></p>
                            </div>

                            <div class="col-md-12 m-t-3 m-b-3">
                                <!--<div class="form-group">-->

                                <button type="submit" name="filterBtn"  class="composemail pull-right">Filter Service</button>&nbsp;
                                <button type="reset" name="resetBtn" onclick="clearForm(this);" class="composemail  pull-right  m-r-2">Clear All</button> 
                                <!--</div>-->
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Service ID</th>
                                <th>Service Name</th>
                                <th>Service Category</th>
                                <th>Vendor</th>
                                <th>Price</th>
                                <th>Added on & at</th>  
                                <th>Set Most Booked</th>
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php if ($service_list): foreach ($service_list as $service): ?>
                                    <tr>
                                        <td><a href="<?php echo site_url('admin/vendor-service-detail/' . $service['service_id']); ?>" title="view detail">#<?= $service['service_id'] ?></a></td>
                                        <td><?= $service['name'] ?></td>
                                        <td><?= $service['category_name'] ?></td>
                                        <td><?= $service['vendor_name'] ?></td>
                                        <td><?= $service['price'] ?> LYD</td>
                                        <td><?= $service['created_at'] ?></td>  
                                        <td>
                                            <!--                                            <div class="mytoggle">
                                                                                            <label class="switch">
                                                                                                <input type="checkbox" <?= $service['total_booking'] == 1 ? 'checked' : '' ?> onchange="setMostBooked(this,<?= $service['service_id'] ?>);">
                                                                                                <span class="slider round"></span>
                                                                                            </label>
                                                                                        </div>-->
                                            <select class="form-control" name="total_booking" onchange="setMostBooked(this, <?= $service['service_id'] ?>);">
                                                <option value="0">Set priority</option>
                                                <?php for ($i = 1, $j = 10; $i <= 10, $j > 0; $i++, $j--): ?>
                                                    <option value="<?= $j ?>" <?= $service['total_booking'] == $j ? 'selected' : '' ?>><?= $i ?></option>
                                                <?php endfor; ?>
                                            </select>
                                        <td>
                                            <a href="<?= base_url('admin/vendor-service-detail/' . $service['service_id']); ?>" class="composemail"><i class="fa fa-eye"></i></a>
                                        </td> 
                                    </tr> 
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
    </div>
    <script>
        function setMostBooked(obj, id) {
//            var checked = $(obj).is(':checked');
//            if (checked == true) {
//                var status = 1;
//            } else {
//                var status = 0;
//            }
            var status = $(obj).val();
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Settings/ajax",
                    type: 'post',
                    data: 'method=setMostBooked&id=' + id + '&action=' + status,
                    success: function (data) {
                        var dt = $.trim(data);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            location.reload();
                        } else {
                            $(obj).val("0");
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
            }
        }
        function clearForm(obj) {
            $('.chosen').trigger('chosen:updated');
            $('select').val('');
//            $('form').submit();
            window.location.href = window.location.href;
        }
    </script>
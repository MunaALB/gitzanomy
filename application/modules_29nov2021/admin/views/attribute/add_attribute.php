<div class="content-wrapper">
    <div class="content-header sty-one">
        <?php
        if (isset($single_attribute) and $single_attribute) {
            $text = "Edit Attribute";
            $buttonValue = "Update";
        } else {
            $text = "Add Attribute";
            $buttonValue = "Submit";
        }
        ?>

        <h1><?= $text; ?></h1>
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><i class="fa fa-angle-right"></i><?= $text; ?></li>
        </ol>
    </div>
    <?= $this->session->flashdata('response'); ?>
    <div class="content">

        <div class="row">

            <div class="col-md-5">
                <div class="card">
                    <form method="POST">
                        <div class="card-body"> 
                            <div class="row"> 
                                <div class="col-md-6 mt-4">
                                    <label>Name(EN)</label>
                                    <?php if (isset($single_attribute) and $single_attribute) { ?>
                                        <input type="text" value="<?= $single_attribute['name']; ?>" required class="form-control mb-4" name="name" placeholder="Label Name">
                                    <?php } else { ?>
                                        <input type="text" required class="form-control mb-4" name="name" placeholder="Label Name">
                                    <?php } ?>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label>Name(AR)</label>
                                    <?php if (isset($single_attribute) and $single_attribute) { ?>
                                        <input type="text" value="<?= $single_attribute['name_ar']; ?>" required class="form-control mb-4" name="name_ar" placeholder="Label Name">
                                    <?php } else { ?>
                                        <input type="text" required class="form-control mb-4" name="name_ar" placeholder="Label Name">
                                    <?php } ?>
                                </div> 
                            </div> 

                            <div class="row">
                                <div class="col-md-12"> 
                                    <button type="submit" name="addAttr" class="composemail mt-4 pull-right"><?= $buttonValue ?></button>  
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>
            </div> 





            <div class="col-md-7">
                <div class="card"> 
                    <div class="card-body">


                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name(En)</th>
                                        <th>Name(Ar)</th>
                                        <th>Status</th> 
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($attribute): foreach ($attribute as $listing) { ?>
                                            <tr> 
                                                <td><?= $listing['name']; ?></td>
                                                <td><?= $listing['name_ar']; ?></td>
                                                <td>
                                                    <div class="mytoggle">
                                                        <label class="switch">
                                                            <input type="checkbox" <?php
                                                            if ($listing['status'] == '1'): echo "checked";
                                                            endif;
                                                            ?> onchange="checkStatus_user(this, '<?= $listing['attribute_id']; ?>');">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </td> 
                                                <td>
                                                    <a class="composemail" href="<?php echo site_url('admin/add-attribute/' . $listing['attribute_id']); ?>">Edit</a><br><br>
                                                    <a class="composemail" style="cursor:pointer;" onclick="deleteData(this,<?= $listing['attribute_id'] ?>);">Delete</a>
                                                </td> 
                                            </tr>
                                        <?php } endif; ?>  
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function checkStatus_user(obj, id) {
            var checked = $(obj).is(':checked');
            if (checked == true) {
                var status = 1;
            } else {
                var status = 0;
            }
            if (id) {
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=ChangeAttributeStatus&id=' + id + '&action=' + status + '&type=1',
                    success: function (data) {
                        var dt = $.trim(data);
                        //alert(dt);
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
////  06-06-2020   ////
        function deleteData(obj, id) {
            var check = confirm('Are you sure to delete ?');
            if (check) {
                if (id) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=ChangeAttributeStatus&id=' + id + '&action=99&type=1',
                        success: function (data) {
                            var dt = $.trim(data);
                            //alert(dt);
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
        ////  06-06-2020   ////
    </script>
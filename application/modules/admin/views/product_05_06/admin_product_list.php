<style>
.imgesClass{
    width: 150px;
    height: 150px;
    border-radius: 77px;
    border: 1px solid #ef4d32;
}
.imgesClassTable{
    width: 100px;
    height: 100px;
    border-radius: 77px;
    border: 1px solid #ef4d32;
}
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Admin Product List</h1>
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
                                        <th>Image</th>
                                        <th>SKU-ID</th>
                                        <th style="width:120px;">Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($product_list): foreach($product_list as $list): ?>
                                        <tr>
                                            <!-- <td><a href="<?=base_url('admin/product-detail/'.$list['product_id']);?>">#<?=$list['product_id'];?></a></td> -->
                                            <td><a href="<?=base_url('admin/product-detail/'.$list['product_id']);?>"><img src="<?=$list['image']?>" class="imgesClassTable"></a>
                                            </td>
                                            <td><?=$list['item_no'];?></td>
                                            <td><a href="<?=base_url('admin/product-detail/'.$list['product_id']);?>" style="color: red;cursor: pointer;"><?=$list['name'];?></a></td>
                                            <td><?=$list['price'];?> LYD</td>
                                            <td><?=$list['quantity'];?></td>
                                            <td>
                                                <?php if ($list['status'] != 0): ?>
                                                    <div class="mytoggle">
                                                        <label class="switch">
                                                            <input type="checkbox" <?= $list['status'] == 1 ? 'checked' : '' ?> onchange="checkStatus(this, <?= $list['product_id'] ?>);">
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                <?php endif ?>
                                            </td>
                                            <td>
                                            <a href="<?= base_url('admin/edit-product-detail/' . $list['product_id']); ?>" class="composemail"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="deleteProduct(this, <?= $list['product_id'] ?>);" class="composemail"><i class="fa fa-trash"></i></a>
                                        </td>
                                        </tr>
                                        <?php endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-right: 15px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"style="width: 500px;margin-top: 115px;margin-left: 204px;">
                <div class="modal-header" style="padding: 3px;background:#f0553a">
                    <h3 style="color: #fff;">ddfdgr</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <div class="row" id="modalData">
                        <div class="col-md-6">
                            <img src="https://www.goinstablog.com/projects/zanomy/uploads/products/1589027528drg5ngddxdd55000d5ds.jpg" class="imgesClass">
                        </div>
                        <div class="col-md-6">
                            <span>VGvghhgvhg</span></br>
                        </div>
                    </div>
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
                    url: "<?= base_url(); ?>admin/Home/ajax",
                    type: 'post',
                    data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
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
                        url: "<?= base_url(); ?>admin/home/ajax",
                        type: 'post',
                        data: 'method=changeStatus&id=' + id + '&action=' + status + '&type=1',
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
                               // location.reload();
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
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Vendor Commission</h1>
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
                                            <th>Mobile</th>
                                            <th>Total Commission</th>
                                            <th>Paid</th>
                                            <th>Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($vendor_list): foreach ($vendor_list as $list): ?>
                                                <tr>
                                                    <td>#<?= $list['vendor_id']; ?></td>
                                                    <td><?= $list['name']; ?></td>
                                                    <td>+<?= $list['country_code'] . ' ' . $list['mobile']; ?></td>
                                                    <td><?= $list['total_commission']; ?></td>
                                                    <td><?= $list['paid_commission']; ?></td>
                                                    <td><?= ($list['total_commission'] - $list['paid_commission']); ?></td>

                                                    <td><a href="#" data-toggle="modal" data-target="#commissionModal" onclick="setValues(this,<?= $list['vendor_id']; ?>);" class="composemail">Update</a></td>
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
            </div>
        </div>
    </div>
    <div id="commissionModal" class="modal fade" role="dialog" data-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <!--            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align-last: center">Register</h4>
                            </div>-->
                <div class="modal-body">
                    <form method="POST" id="regForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Update Paid Amount</label>
                                <input type="hidden" name="vendor_id" id="vendor_id">
                                <input type="text" onchange="checkValidNumbersOnly(this);" class="form-control mb-4" data-title="Paid Amount" id="paid" name="paid" placeholder="Paid Amount">
                                <p class="text-danger" id="paidError"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" onclick="updateCommission(this);" id="add_product_set" class="composemail pull-right" style="padding:10px 15px !important;">Update</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function setValues(obj, id) {
            $('#vendor_id').val(id);
        }

        function updateCommission(obj) {
            var paid_amount = $('#paid').val();
            var id = $('#vendor_id').val();
            if (id) {
                if (paid_amount != "" && paid_amount != 0) {
                    $.ajax({
                        url: "<?= base_url(); ?>admin/Admin/ajax",
                        type: 'post',
                        data: 'method=updatePaidCommissionVendor&vendor_id=' + id + '&paid_amount=' + paid_amount,
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
                    $('#paidError').html('* Paid Amount is required field');
                }
            } else {
                alert('Some error occured');
            }
        }

        function checkValidNumbersOnly(obj) {
            var regex2 = new RegExp(/^[0-9]+([.])+[0-9]+$/);
            var regex = new RegExp(/^[0-9]+$/);
            var flag = 0;
            var number = 0;
            var discount = $(obj).val();
            if (regex2.test(discount)) {
                flag = 1;
            } else {
                if (regex.test(discount)) {
                    flag = 1;
                } else {
                    flag = 0;
                }
            }
            if (flag) {
                $('#paidError').html('');
                $('#add_product_set').attr('disabled', false);
            } else {
                $('#paidError').html('* not a valid number. amount should be between 0 - 100 number only');
                $('#add_product_set').attr('disabled', true);
                return false;
            }
        }
    </script>
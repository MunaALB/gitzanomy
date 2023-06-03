<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Vendor Note List</h1>
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
                                            <th>Sr.No.</th>
                                            <th>Note</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sr=1; if($user_list): foreach($user_list as $list): ?>
                                        <tr>
                                            <td><?=$sr;?></td>
                                            <td><?=$list['note'];?></td>
                                            
                                            <td><a style="cursor:pointer;" onclick="deleteData(this,'<?=$list['vendor_note_id'];?>');" class="composemail">Delete</a></td>
                                        </tr>
                                        <?php $sr++; endforeach; endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
function deleteData(obj, id) {
    if (id) {
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Home/ajax",
                type: 'post',
                data: 'method=deleteNote&id=' + id+'&type=2',
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
        }
    } else {
        alert("Something Wrong");
    }
}
</script>
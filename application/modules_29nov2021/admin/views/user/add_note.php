<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .fa_btn {
        background: #f74f00;
        color: #ffffff !important;
        padding: 4px 6px !important;
        margin-top: 0px;
        border-radius: 30px;
        margin-left: 0px;
    }
    .margin-20{
        margin-top: 20px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Add Note</h1>
    </div>
    <div class="content">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card">
                                    <form method="POST" id="regForm" enctype="multipart/form-data">
                                        <div class="card-body"> 
                                            <div class="row">
                                                
                                                <div class="col-md-12">
                                                    <label for="validationCustom01">Add Note</label>
                                                    <textarea name="note" id="note" rows="10" class="form-control"></textarea>
                                                    <p class="errorPrint" id="noteError"></p>
                                                    <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="addNote(this)">Submit</button>  
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 margin-20">
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th><input onchange="selectData(this,'1')" type="checkbox"/></th>          
                                            <th>User Id</th>
                                            <th>User Name</th>
                                            <th>Mobile No</th>
                                            <th>Email Id</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($user_list): foreach($user_list as $list): ?>
                                        <tr>
                                            <td><input  onchange="selectData(this,'2')" value="<?=$list['user_id'];?>" name="cat_checker" type="checkbox"/></td>
                                            <td><?=$list['user_id'];?></td>
                                            <td><?=$list['name'];?></td>
                                            <td>+<?=$list['country_code'].' '.$list['mobile'];?></td>
                                            <td><?=$list['email'];?></td>
                                            <td><a href="<?php echo site_url('admin/user-detail/'.$list['user_id']);?>" class="composemail">View</a></td>
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
    <script>
        function selectData(obj,t){
            var checked = $(obj).is(':checked');
            if(t==1){
                if (checked == true) {
                    $('input[name="cat_checker"]'). prop("checked", true);
                } else {
                    $('input[name="cat_checker"]'). prop("checked", false);
                }
            }
        }

        function addNote(o,status){
            var createValue="";
            $.each($("input[name='cat_checker']:checked"), function(i,v){
                var vals=$(v).val();
                if(i==0){
                    createValue=v['value'];
                }else{
                    createValue=createValue+','+v['value'];
                }
            });
            if(createValue){
                var note=$.trim($("#note").val());
                if (note) {
                    $.ajax({
                        url: "<?php echo base_url("/admin/Home/ajax") ?>",
                        type: 'post',
                        data: 'method=sendNote&id=' + createValue+'&note='+note+'&type=1',
                        success: function (data) {
                            var dt = $.trim(data);
                            //alert(dt);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "100") {
                                alert(jsonData['message']);
                                location.reload();
                            } else {
                                alert(jsonData['message']);
                            }
                        }
                    });
                }else{
                    $("#noteError").empty();
                    $("#noteError").append('*Note is required field.');
                    $("#noteError").css('display','block');
                }
            }else{
                alert("Please select User.");
            }
        }
    </script>
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
                <div class="card" style="border: 1px solid;"> 
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card" >
                                    <div class="form-row">
                                        <div class="col-sm-3">
                                            <div class="text-sm-left" style="margin-top: -33px;">
                                                <button type="button" onclick="addItems(this,'<?=$deal_id;?>');" class="composemail mt-4 pull-right" style="margin-right: 95px;margin-bottom: -10px;cursor:pointer;">Add</button>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <!-- <th><input onchange="selectData(this,'1')" type="checkbox"/></th>    -->
                                        <th></th>
                                        <th>Image</th>
                                        <th style="width:120px;">Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $selected=""; if($product_list): foreach($product_list as $list):
                                            if($list['is_exist']==1){
                                                if($selected==''){
                                                  $selected=$list['product_id'];
                                                }else{
                                                  $selected=$selected.'@'.$list['product_id'];
                                                }
                                                
                                            } 
                                             ?>
                                        <tr>
                                            <td><input <?php if($list['is_exist']==1){ echo "checked"; } ?> onchange="selectData(this,'2','<?=$list['product_id'];?>')" value="<?=$list['product_id'];?>" name="cat_checker" type="checkbox"/></td>
                                            <!-- <td><a href="<?=base_url('admin/product-detail/'.$list['product_id']);?>">#<?=$list['product_id'];?></a></td> -->
                                            <td><a href="<?=base_url('admin/product-detail/'.$list['product_id']);?>"><img src="<?=$list['image']?>" class="imgesClassTable"></a>
                                            </td>
                                            <td><a href="<?=base_url('admin/product-detail/'.$list['product_id']);?>" style="color: red;cursor: pointer;"><?=$list['name'];?></a></td>
                                            <td><?=$list['price'];?> Rwf</td>
                                            <td><?=$list['quantity'];?><?php 
                                            if($list['quantity']==0){
                                                echo "<span style='background: red;color: #fff;border-radius: 20px;padding: 3px 5px;margin-left: 10px;'>Out Of Stock</span>";
                                            }else if($list['quantity']<6){ echo "<span style='background: #e8e812; color: red;border-radius: 20px;padding: 3px 5px;margin-left: 10px;'>Low Quantity</span>"; }?></td>
                                           
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
        // function selectData(obj,t){
        //     var checked = $(obj).is(':checked');
        //     if(t==1){
        //         if (checked == true) {
        //             $('input[name="cat_checker"]'). prop("checked", true);
        //         } else {
        //             $('input[name="cat_checker"]'). prop("checked", false);
        //         }
        //     }
        // }


        var createValue="<?=$selected;?>";
        console.log('rrrrrrrrrrr',createValue);
        function selectData(obj,t,i){
            
            var checked = $(obj).is(':checked');
           
                if (checked == true) {
                    if(createValue==""){
                        createValue=i;
                    }else{
                        createValue=createValue+'@'+i;
                    }
                    // $('input[name="cat_checker"]'). prop("checked", true);
                } else {
                    var a=createValue.split('@');
                    var newCreateValue="";
                    $.each(a, function( ind, dta ) {
                        console.log(dta,'dddddd',i);
                        if(dta==i){

                        }else{
                            if(newCreateValue==""){
                                newCreateValue=dta;
                            }else{
                                newCreateValue=newCreateValue+'@'+dta;
                            }
                            // createValue='';
                        }
                        createValue=newCreateValue;
});
                }
            
            console.log(createValue)
        }


    function addItems(o,status){
        // var createValue="";
        // $.each($("input[name='cat_checker']:checked"), function(i,v){
        //     var vals=$(v).val();
        //     if(i==0){
        //         createValue=v['value'];
        //     }else{
        //         createValue=createValue+'@'+v['value'];
        //     }
        // });
        if(createValue){
            //console.log('createValue',createValue)
                $.ajax({
                    url: "<?php echo base_url("/admin/Home/ajax") ?>",
                    type: 'post',
                    data: 'method=addLayoutData&id=' + createValue + '&deal_id='+status,
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
            
        }else{
            alert("Please select any one Product.");
        }
    }
    </script>














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

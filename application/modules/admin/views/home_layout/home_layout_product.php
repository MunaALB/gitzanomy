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
                                <table id="productListTlb" class="table table-bordered">
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
                            <img src="" class="imgesClass">
                        </div>
                        <div class="col-md-6">
                            <span>VGvghhgvhg</span></br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <input type="hidden" id="selectedValueIds" value="<?=$selected;?>">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
    var createValue="<?=$selected;?>";
    $(function() {
		var userDataTable = $('#productListTlb').DataTable({
			"processing":true,
			"serverSide":true,  
			"order":[], 
			"ajax": {
				url : '<?php echo base_url("admin/Home/home_layout_product_ajax"); ?>',
				type: "GET"  ,
                'data': function(data){
                    data.uri = <?=$deal_id;?>;
                    data.selectedValue = $("#selectedValueIds").val();
                }
			},
			"columnDefs":[  
				{  
					"targets":[0 , 1 ],  
					"orderable":false,
				},  
			], 
		});

        $('#model').change(function(){
          userDataTable.draw();
       });

	});

    </script>


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
            
                $("#selectedValueIds").val(createValue);
            console.log('tt',createValue)
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



    <div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#">User Dashboard</a></li>
        <li><a href="#">Order Detail</a></li>
    </ul>
    <div class="mycart-part">
    <?php if($orderDetail): ?>
        <div class="row">
            <div  id="content" class="col-sm-7">
                <div class="user-rightpart">
                   <h2 class="title">Product Detail</h2>
                    <div class="user-gridpoints">
                        <div class="products-list row nopadding-xs so-filter-gird list">
                            <?php if(isset($orderDetail['order_item']) and $orderDetail['order_item']): 
                                foreach($orderDetail['order_item'] as $items): ?>
                                <div class="product-layout col-md-12 col-sm-12 col-xs-12">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container">
                                                <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $items['product_name'])).'/'.$items['product_id'].'/'.$items['item_id']); ?>" target="_self" title="Chicken swinesha">
                                                    <img src="<?=$items['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $items['product_name'])).'/'.$items['product_id'].'/'.$items['item_id']); ?>" title="Chicken swinesha" target="_self"><?=$items['product_name'];?></a></h4>
                                                <div class="price"> <span class="price-new"><?=$items['amount'];?> LYD</span>
                                                    <?php if($items['discount']>0): ?>
                                                        <span class="price-old"><?=$items['price'];?> LYD</span>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if(isset($items['product_attributes']) and $items['product_attributes']): ?>
                                                    <div class="other-valeu">
                                                        <?php foreach($items['product_attributes'] as $attr): ?>
                                                            <p><span><?=$attr['attribute_name'];?>:</span> <?=$attr['attribute_value'];?></p>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="order-status">
                                            <h3>Order Status</h3>
                                            <div class="status-part">
                                                <ul>
                                                    <?php
                                                        if($items['user_status']==5){
                                                            ?>
                                                                <li class="active" style="font-size: 13px;width: 40%;">Awating-Confirmation</li>
                                                                <li class="active" style="font-size: 13px;width: 40%;">Canceled<a style="cursor:pointer;color: red;" onclick="viewReason(this,'<?=$items['order_item_id'];?>')">(View Reason)</a></li>
                                                            <?php
                                                        }else{
                                                        $completedClass="";$activeClass=""; for($i=1;$i<=4;$i++): 
                                                            if($i==1){
                                                                $titleItem="Awating-Confirmation";
                                                            }elseif($i==2){
                                                                $titleItem="In-Process";
                                                            }elseif($i==3){
                                                                $titleItem="Dispatch";
                                                            }else{
                                                                $titleItem="Delivered";
                                                            }
                                                            //////////////////////////////
                                                            if($i==$items['user_status']):
                                                                $activeClass="active";
                                                                $completedClass="";
                                                            elseif($i<$items['user_status']):
                                                                $completedClass="completed";
                                                                $activeClass="";
                                                            else:
                                                                $completedClass="";
                                                                $activeClass="";
                                                            endif; ?>
                                                            <li class="<?=$completedClass?> <?=$activeClass?>" style="font-size: 13px;width: 24%;"><?=$titleItem;?></li>
                                                    <?php endfor; } ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="order-status" style="display:none;" id="reason_<?=$items['order_item_id'];?>">
                                            <h3>Cancel Reason</h3>
                                            <div class="status-part">
                                                <p><?=$items['cancel_reason'];?></p>            
                                            </div>
                                        </div>
                                        <div class="order-status" style="display:none;" id="add_reason_<?=$items['order_item_id'];?>">
                                            <h3>Add Cancel Reason</h3>
                                            <div class="status-part">
                                                <input type="text">           
                                            </div>
                                        </div>
                                        <?php if($items['is_cancel']): ?>
                                            <div class="writeareview">
                                                <a onclick="addReason(this,'<?=$items['order_item_id'];?>')">Cancel Product</a>
                                                <!-- <a onclick="cancelProduct(this,'<?=$items['order_item_id'];?>');">Cancel Product</a> -->
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div  class="col-sm-5">
                <div class="user-rightpart mb-5">
                      <h2 class="title">Order Detail</h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <strong>Order Id:</strong>
                                    </td>
                                    <td class="text-right">#<?=$orderDetail['order_id'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Order Status:</strong>
                                    </td>
                                    <td class="text-right"><?php if($orderDetail['user_status']==1){ echo "New"; }elseif($orderDetail['user_status']==2){ echo "Dispatch"; }else{ echo "Delivered"; } ?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Order Date:</strong>
                                    </td>
                                    <td class="text-right"><?=date('d-m-Y',strtotime($orderDetail['created_at']));?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Mobile No:</strong>
                                    </td>
                                    <td class="text-right">+<?=$orderDetail['user_detail']['country_code'];?> <?=$orderDetail['user_detail']['mobile'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Adddress:</strong>
                                    </td>
                                    <td class="text-right"><?=$orderDetail['user_detail']['geo_address'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Street Adddress:</strong>
                                    </td>
                                    <td class="text-right"><?=$orderDetail['user_detail']['street_address'];?></td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>House No:</strong>
                                    </td>
                                    <td class="text-right"><?=$orderDetail['user_detail']['house_no'];?></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-left">
                                        <strong>City:</strong>
                                    </td>
                                    <td class="text-right">Amman</td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Country:</strong>
                                    </td>
                                    <td class="text-right">Jordan</td>
                                </tr> -->
                            </tbody>
                        </table>
                </div>
                <div class="user-rightpart mb-5">
                      <h2 class="title">Payment Summary </h2>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <strong>Payment Method:</strong>
                                    </td>
                                    <td class="text-right">
                                    <?php if($orderDetail['payment_type']==''){ echo "Cash on Delivery"; }else{ echo "Online"; } ?></td>
                                </tr>
                                <!-- <tr>
                                    <td class="text-left">
                                        <strong>Total-Products:</strong>
                                    </td>
                                    <td class="text-right">2 Items</td>
                                </tr> -->
                                <tr>
                                    <td class="text-left">
                                        <strong>Item Amount:</strong>
                                    </td>
                                    <td class="text-right"><?=$orderDetail['item_amount'];?> LYD</td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Delivery Charges:</strong>
                                    </td>
                                    <td class="text-right"><?=$orderDetail['delivery_charges'];?> LYD</td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Total Amount:</strong>
                                    </td>
                                    <td class="text-right"><?=$orderDetail['total'];?> LYD</td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Coupon Discount:</strong>
                                    </td>
                                    <td class="text-right"><?=$orderDetail['coupon_amount'];?> LYD</td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <strong>Upfront Amount:</strong>
                                    </td>
                                    <td class="text-right"><?=$orderDetail['upfront_amount'];?> LYD</td>
                                </tr>
                                    <tr>
                                        <td class="text-left">
                                            <strong>Sub Total:</strong>
                                        </td>
                                        <td class="text-right"><?=$orderDetail['remain_amount'];?> LYD</td>
                                    </tr>
                                <!-- <tr>
                                    <td class="text-left">
                                        <strong>Sub Total:</strong>
                                    </td>
                                    <td class="text-right">320 LYD</td>
                                </tr> -->
                            </tbody>
                        </table>
                          <div class="buttons">
                            <!-- <div class="checkout-btn"><a href="#" class="btn btn-primary">Cancel order</a></div> -->
                            <?php if($orderDetail['user_status']==3){ ?>
                                <div class="checkout-btn"><a href="<?=base_url('user-bill/'.$orderDetail['order_id']);?>" class="btn btn-primary">My Bill</a></div>
                            <?php } ?>
                            </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    </div>
</div>

<script>
    function cancelProduct(o,i){
        var r = confirm("Are you sure to cancel!");
        if (r == true) {
            var reg_form_data = new FormData();
            reg_form_data.append("user_id",<?=$user_id;?>);
            reg_form_data.append("order_id",<?=$order_id;?>);
            reg_form_data.append("order_item_id",i);
            reg_form_data.append("is_web","1");
            $.ajax({
                url: baseUrl+'cancelOrderProduct',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    if (returnObject.error_code == 200) {
                        swal({title:"Success.",text: returnObject['message'],type: "success"},function(){ 
                            location.reload();
                        })
                     }else{
                        swal({title:"Warning.",text: returnObject['message'],type: "warning"},function(){ 
                            location.reload();
                        })
                    }
                    // location.reload();
                },
                error: function (error) {
                     alert("error");
                }
            });
        } 
    }

    function addReason(o,i){
        swal({
            title: "Cancel Product!",
            text: "Write Your Reason:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "Write something"
        },
        function(inputValue){
            if (inputValue === false) return false;
            
            if (inputValue === "") {
                swal.showInputError("You need to write something!");
                return false
            }

            var reg_form_data = new FormData();
            reg_form_data.append("user_id",<?=$user_id;?>);
            reg_form_data.append("order_id",<?=$order_id;?>);
            reg_form_data.append("order_item_id",i);
            reg_form_data.append("cancel_reason",inputValue);
            reg_form_data.append("is_web","1");
            $.ajax({
                url: baseUrl+'cancelOrderProduct',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    if (returnObject.error_code == 200) {
                        swal({title:"Success.",text: returnObject['message'],type: "success"},function(){ 
                            location.reload();
                        })
                     }else{
                        swal({title:"Warning.",text: returnObject['message'],type: "warning"},function(){ 
                            location.reload();
                        })
                    }
                    // location.reload();
                },
                error: function (error) {
                     alert("error");
                }
            });

            // swal("Nice!", "You wrote: " + inputValue, "success");
        });
    }
    
    function viewReason(o,i){
        $("#reason_"+i).toggle();
    }
</script>
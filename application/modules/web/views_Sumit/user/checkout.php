<style>
.errorPrint{
    font-size: 12px;
    color: #af2000 !important;
    padding: 5px 5px;
    display: none;
}
</style>
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#">User Dashboard</a></li>
        <li><a href="#">Checkout</a></li>
    </ul>
    <div class="mycart-part">
    <?php if(isset($user_cart) and $user_cart): ?>
        <div class="row">
            <div  id="content" class="col-sm-8">
                <div class="checkout-page">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-map-marker"></i> Select Address</h4>
                                </div>
                                <div class="checkout-shipping-methods select-addess">
                                    <div class="panel-body ">
                                        <p>Please select the preferred shipping address to use on this order.</p>
                                        <div class="row">
                                        <?php if($getAddress): foreach($getAddress as $key=>$address): ?>
                                            <div class="col-md-6 addressDiv" data-status="0" data-address="<?=$address['address_id'];?>" onclick="selectAddress(this)">
                                                <label>
                                                    <input type="radio" name="product" class="card-input-element" />
                                                    <div class="panel panel-default card-input">
                                                        <h3 id="name_<?=$key;?>" data-val="<?=$address['name'];?>"><?=$address['name'];?></h3>
                                                        <h4 id="mobile_<?=$key;?>" data-val="<?=$address['mobile'];?>">+<?=$address['country_code'];?> <?=$address['mobile'];?></h4>
                                                        <h5 id="geo_address_<?=$key;?>" data-val="<?=$address['geo_address'];?>"><?=$address['geo_address'];?></h5>
                                                        <h5 id="street_address_<?=$key;?>" data-val="<?=$address['street_address'];?>" data-house="<?=$address['house_no'];?>" data-country="<?=$address['country_id'];?>" data-city="<?=$address['city_id'];?>" data-postal="<?=$address['postal_code'];?>"><?=$address['street_address'];?>, <?=$address['house_no'];?>, <?=$address['city'];?>, <?=$address['country_name'];?>, <?=$address['postal_code'];?></h5>
                                                    </div>
                                                    <div class="absolutepart">
                                                        <a onclick="addressExplend(this,<?=$address['address_id'];?>,<?=$key?>);"><i class="fa fa-edit"></i></a>
                                                        <a style="cursor:pointer;" onclick="deleteAddress(this,'<?=$address['address_id'];?>');"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </label>
                                            </div>
                                            <?php endforeach; else: ?>
                                                <div class="col-md-6">
                                                    <p>Please Add Your Address...</p>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                        <div class="addnewaddress">
                                            <a onclick="addressExplend(this,'');">Add new address</a>
                                        </div>
                                        <div class="collapse" id="collapseExample">
                                            <div class="well">
                                                <div class="new-address">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Full Name</label>
                                                                <input type="text" class="form-control regInputs" id="name" name="name" placeholder="Full Name" data-title="Full Name" value="" >
                                                                <p class="errorPrint" id="nameError"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Mobile No</label>
                                                                <input type="text" id="country_code" class="form-control regInputs" value="+218" style="width:25%;float: left;cursor:no-drop;" readonly="">
                                                                <input type="text" onkeypress="return (event.charCode > 47 &amp;&amp;   event.charCode < 58) " id="mobile" name="mobile" class="form-control regInputs" placeholder="Mobile No."  data-title="Mobile No." style="width: 73%;">
                                                                <p class="errorPrint" id="mobileError"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Country</label>
                                                                <select  class="form-control regInputs" id="country" name="country" data-title="Country">
                                                                    <option value="">--Select Country--</option>
                                                                    <?php if($country_code): foreach($country_code as $country): ?>
                                                                        <option value="<?=$country['country_code_id'];?>"><?=$country['name'];?></option>
                                                                    <?php endforeach; endif; ?>
                                                                </select>
                                                                <p class="errorPrint" id="countryError"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">City</label>
                                                                <select  class="form-control regInputs" id="city" name="city" data-title="City">
                                                                    <option value="">--Select City--</option>
                                                                    <?php if($city): foreach($city as $cityList): ?>
                                                                        <option value="<?=$cityList['city_id'];?>"><?=$cityList['name'];?></option>
                                                                    <?php endforeach; endif; ?>
                                                                </select>
                                                                <p class="errorPrint" id="cityError"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Postal Code</label>
                                                                <input type="text" class="form-control regInputs" id="postal_code" name="postal_code" data-title="Postal Code" placeholder="Postal Code" value="">
                                                                <p class="errorPrint" id="postal_codeError"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Geo Address</label>
                                                                <input type="text" class="form-control regInputs" id="geo_address" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="">
                                                                <p class="errorPrint" id="geo_addressError"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Street Address</label>
                                                                <input type="text" class="form-control regInputs" id="street_address" name="street_address" data-title="Street Address" placeholder="Street Address" value="">
                                                                <p class="errorPrint" id="street_addressError"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">House No.</label>
                                                                <input type="text" class="form-control" id="house_no" name="house_no" data-title="House No." placeholder="House No." value="">
                                                                <p class="errorPrint" id="house_noError"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons">
                                                        <div class="saveaddress"><a onclick="addAddress(this);" class="btn btn-primary">Save & Use Address</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="collapse" id="collapseExample2">
                                            <div class="well">
                                                <div class="new-address">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Full Name</label>
                                                                <input type="text" class="form-control regInputs2" id="name2" name="name" placeholder="Full Name" data-title="Full Name" value="" >
                                                                <p class="errorPrint" id="name2Error"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Mobile No</label>
                                                                <input type="text" id="country_code2" class="form-control regInputs" value="+218" style="width:25%;float: left;cursor:no-drop;" readonly="">
                                                                <input type="text" onkeypress="return (event.charCode > 47 &amp;&amp;   event.charCode < 58) " id="mobile2" name="mobile2" class="form-control regInputs2" placeholder="Mobile No."  data-title="Mobile No." style="width: 73%;">
                                                                <p class="errorPrint" id="mobile2Error"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Country</label>
                                                                <select  class="form-control regInputs2" id="country2" name="country" data-title="Country">
                                                                    <option value="">--Select Country--</option>
                                                                    <?php if($country_code): foreach($country_code as $country): ?>
                                                                        <option value="<?=$country['country_code_id'];?>"><?=$country['name'];?></option>
                                                                    <?php endforeach; endif; ?>
                                                                </select>
                                                                <p class="errorPrint" id="country2Error"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">City</label>
                                                                <select  class="form-control regInputs2" id="city2" name="city" data-title="City">
                                                                    <option value="">--Select City--</option>
                                                                    <?php if($city): foreach($city as $cityList): ?>
                                                                        <option value="<?=$cityList['city_id'];?>"><?=$cityList['name'];?></option>
                                                                    <?php endforeach; endif; ?>
                                                                </select>
                                                                <p class="errorPrint" id="city2Error"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Postal Code</label>
                                                                <input type="text" class="form-control regInputs2" id="postal_code2" name="postal_code" data-title="Postal Code" placeholder="Postal Code" value="">
                                                                <p class="errorPrint" id="postal_code2Error"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Geo Address</label>
                                                                <input type="text" class="form-control regInputs2" id="geo_address2" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="">
                                                                <p class="errorPrint" id="geo_address2Error"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">Street Address</label>
                                                                <input type="text" class="form-control regInputs2" id="street_address2" name="street_address" data-title="Street Address" placeholder="Street Address" value="">
                                                                <p class="errorPrint" id="street_address2Error"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <input type="hidden" id="edit_address_id" class="form-control regInputs2">
                                                                <label for="input-payment-address-1" class="control-label">House No.</label>
                                                                <input type="text" class="form-control" id="house_no2" name="house_no" data-title="House No." placeholder="House No." value="">
                                                                <p class="errorPrint" id="house_no2Error"></p>
                                                                <p class="errorPrint" id="edit_address_idError"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons">
                                                        <div class="saveaddress"><a onclick="editAddress(this);" class="btn btn-primary">Save & Use Address</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method</h4>
                                </div>
                                <div class="checkout-shipping-methods">
                                    <div class="panel-body ">
                                        <p>Please select the preferred payment method to use on this order.</p>
                                        <div class="radio">
                                            <label><input type="radio" value="1" checked="checked" name="payment"> Cash On Delivery</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" value="2" name="payment">Paypal</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div  class="col-sm-4">
                <div class="user-rightpart">
                    <h2 class="title">Cart Totals</h2>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-left">
                                    <strong>Total-Products:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['cart']) and $user_cart['cart']){ echo count($user_cart['cart']); }else{ echo '0'; }?> Items</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>Total price:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['total_amount']) and $user_cart['total_amount']){ echo ($user_cart['total_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>Total Delivery Charges:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['delivery_amount']) and $user_cart['delivery_amount']){ echo ($user_cart['delivery_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>Total Payble Amount:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['payble_amount']) and $user_cart['payble_amount']){ echo ($user_cart['payble_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>Total Upfront Amount:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['upfront_amount']) and $user_cart['upfront_amount']){ echo ($user_cart['upfront_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <!-- <tr>
                                <td class="text-left">
                                    <strong>Remain Amount:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['remain_amount']) and $user_cart['remain_amount']){ echo ($user_cart['remain_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr> -->
                        </tbody>
                    </table>
                    <div class="buttons">
                        <p class="errorPrint" id="PaymentError"></p>
                        <?php if(isset($user_cart['payble_amount']) and $user_cart['payble_amount']): ?>
                            <div class="checkout-btn"><a onclick="placeOrder(this,1);" class="btn btn-primary">Checkout & Process</a></div>
                        <?php else: ?>
                            <div class="checkout-btn"><a onclick="placeOrder(this,0);" class="btn btn-primary">Checkout & Process</a></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
            Cart is empty...
        <?php endif; ?>
    </div>
</div>
<script>
    var baseUrl="<?=$base_url;?>";
    function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }
    function addAddress(obj){
        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('data-title') + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
        if (idValidate) {
            return false;
        } else {
            var name=$("#name").val();
            var country_code='218';
            var mobile=$("#mobile").val();
            var country=$("#country").val();
            var city=$("#city").val();
            var geo_address=$("#geo_address").val();
            var street_address=$("#street_address").val();
            var house_no=$("#house_no").val();
            var postal_code=$("#postal_code").val();
            $.ajax({
                url: "<?php echo base_url("/web/Web/ajax") ?>",
                type: "POST",
                data: "method=addAddress&name="+name+'&country_code='+country_code+'&mobile='+mobile+'&country='+country+'&city='+city+'&geo_address='+geo_address+'&street_address='+street_address+'&house_no='+house_no+'&postal_code='+postal_code,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 200) {
                        alert(jsonData['message']);
                        location.reload();
                    } else {
                        showErrorMessage('genericError',jsonData['message']);
                        //location.reload();
                    }
                },
                error: function (error) {
                    alert("error");
                }
            }); 
        }
    }

    function deleteAddress(obj,i){
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            var reg_form_data = new FormData();
            reg_form_data.append("user_id",<?=$user_data['user_id'];?>);
            reg_form_data.append("address_id",i);
            reg_form_data.append("status","99");
            reg_form_data.append("is_web","1");
            $.ajax({
                url: baseUrl+'editAddress',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    // if (returnObject.error_code == 200) { }else{
                    //     showErrorMessage('otpError',returnObject.message); }
                    location.reload();
                },
                error: function (error) {
                     alert("error");
                }
            });
        } 
    }
    function deleteAddress(obj,i){
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            var reg_form_data = new FormData();
            reg_form_data.append("user_id",<?=$user_data['user_id'];?>);
            reg_form_data.append("address_id",i);
            reg_form_data.append("status","99");
            reg_form_data.append("is_web","1");
            $.ajax({
                url: baseUrl+'editAddress',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    // if (returnObject.error_code == 200) { }else{
                    //     showErrorMessage('otpError',returnObject.message); }
                    location.reload();
                },
                error: function (error) {
                     alert("error");
                }
            });
        } 
    }
    function addressExplend(o,id,index){
        if(id){
            var name=$("#name_"+index).attr('data-val');
            var mobile=$("#mobile_"+index).attr('data-val');
            var geo_address=$("#geo_address_"+index).attr('data-val');
            var street_address=$("#street_address_"+index).attr('data-val');
            var house=$("#street_address_"+index).attr('data-house');
            var postal=$("#street_address_"+index).attr('data-postal');
            var city=$("#mobile_"+index).attr('data-city');
            var country=$("#mobile_"+index).attr('data-country');
            $("#name2").val(name);
            $("#mobile2").val(mobile);
            $("#geo_address2").val(geo_address);
            $("#street_address2").val(street_address);
            $("#house_no2").val(house);
            $("#postal_code2").val(postal);
            $("#edit_address_id").val(id);
            
            $("#collapseExample2").css('display','block');
            $("#collapseExample").css('display','none');
        }else{
            $("#collapseExample").css('display','block');
            $("#collapseExample2").css('display','none');
        }
    }
    function editAddress(obj){
        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs2").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('data-title') + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
        if (idValidate) {
            return false;
        } else {
            var reg_form_data = new FormData();
            reg_form_data.append("user_id",<?=$user_data['user_id'];?>);
            reg_form_data.append("address_id",$("#edit_address_id").val());
            reg_form_data.append("name",$("#name2").val());
            reg_form_data.append("mobile",$("#mobile2").val());
            reg_form_data.append("country_id",$("#country2").val());
            reg_form_data.append("city_id",$("#city2").val());
            reg_form_data.append("postal_code",$("#postal_code2").val());
            reg_form_data.append("geo_address",$("#geo_address2").val());
            reg_form_data.append("street_address",$("#street_address2").val());
            reg_form_data.append("house_no",$("#house_no2").val());
            reg_form_data.append("is_web","1");
            $.ajax({
                url: baseUrl+'editAddress',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    // if (returnObject.error_code == 200) { }else{
                    //     showErrorMessage('otpError',returnObject.message); }
                    location.reload();
                },
                error: function (error) {
                        alert("error");
                }
            });
        }
    }

    function placeOrder(){
        var payment_type=$("input[name='payment']:checked").val();
        var user_id=<?=$user_data['user_id'];?>;
        var address_id='';
        var addressData=$(".addressDiv").length;
        if(addressData){
            $(".addressDiv").each(function(i,v){
                if($(v).attr('data-status')==1){
                    address_id=$(v).attr('data-address')
                }
            });
        }else{
            alert("Please Add your address to place your order.")
        }
        if(user_id && address_id && payment_type ){
            var reg_form_data = new FormData();
            reg_form_data.append("user_id",user_id);
            reg_form_data.append("address_id",address_id);
            reg_form_data.append("payment_type",payment_type);
            reg_form_data.append("is_web","1");
            $.ajax({
                url: baseUrl+'placeOrder',
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
                        window.location.href="<?=base_url('success');?>";
                     }else{
                        window.location.href="<?=base_url('fail');?>";
                    }
                    //location.reload();
                },
                error: function (error) {
                        alert("error");
                }
            });
        }else{
            if(address_id==''){
                showErrorMessage('PaymentError',"*Please select address");
            }else if(payment_type==''){
                showErrorMessage('PaymentError',"*Please select Payment mode");
            }else{
                showErrorMessage('PaymentError',"*Some error found");
            }
        }
    }
    function selectAddress(o){
        $(".addressDiv").attr('data-status',0);
        $(o).attr('data-status',1);
    }
</script>
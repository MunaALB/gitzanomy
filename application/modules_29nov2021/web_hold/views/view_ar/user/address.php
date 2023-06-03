<style>
.errorPrint{
    font-size: 12px;
    color: #af2000 !important;
    padding: 5px 5px;
    display: none;
}
.selectedDiv{
    box-shadow: 0 0 1px 1px #fd5000;background: #ffd2bd;
}
.select-addess .card-input-element:checked + .card-input {
    box-shadow: 0 0 1px 1px #fef7f3;
    background: #fef7f3;
}
.button-disabled{
    width: 100%;
    background: #a09d9d;
    border-color: #312f2f!important;
    border-radius: 5px;
    padding: 10px 0px;
    cursor: no-drop;
    line-height: 1.42857143;
    border: 1px solid transparent;
}
</style>
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">حسابي</a></li>
        <li><a href="#">لوحة المستخدم</a></li>
        <li><a href="#">عنوان</a></li>
    </ul>
    <div class="mycart-part">
    <?php if(isset($user_cart) and $user_cart): ?>
        <div class="row">
            <div  id="content" class="col-sm-8">
                <div class="checkout-page">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php if($login_type==1):?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-map-marker"></i> حدد العنوان</h4>
                                    </div>
                                    <div class="checkout-shipping-methods select-addess">
                                        <div class="panel-body ">
                                            <p>يرجى اختيار عنوان الشحن المفضل لاستخدامها لهذه الطلبية.</p>
                                            <div class="row">
                                            <?php if($getAddress): foreach($getAddress as $key=>$address): ?>
                                                <div class="col-md-6 addressDiv" data-status="0" data-address="<?=$address['address_id'];?>">
                                                    <label>
                                                        <input type="radio" name="product" class="card-input-element" />
                                                        <div class="panel panel-default card-input">
                                                            <h3 id="name_<?=$key;?>" data-val="<?=$address['name'];?>"><?=$address['name'];?></h3>
                                                            <h4 id="mobile_<?=$key;?>" data-val="<?=$address['mobile'];?>">+<?=$address['country_code'];?> <?=$address['mobile'];?></h4>
                                                            <h5 id="geo_address_<?=$key;?>" data-val="<?=$address['geo_address'];?>"><?=$address['geo_address'];?></h5>
                                                            <h5 id="street_address_<?=$key;?>" data-val="<?=$address['street_address'];?>" data-house="<?=$address['house_no'];?>" data-country="<?=$address['country_id'];?>" data-city="<?=$address['city_id'];?>" data-postal="<?=$address['postal_code'];?>" data-lat="<?=$address['lat'];?>" data-lng="<?=$address['lng'];?>"><?=$address['street_address'];?>, <?=$address['house_no'];?>, <?=$address['city'];?>, <?=$address['country_name'];?></h5>
                                                        </div>
                                                        <div class="absolutepart">
                                                            <a onclick="addressExplend(this,<?=$address['address_id'];?>,<?=$key?>);"><i class="fa fa-edit"></i></a>
                                                            <a style="cursor:pointer;" onclick="deleteAddress(this,'<?=$address['address_id'];?>');"><i class="fa fa-trash"></i></a>
                                                        </div>
                                                    </label>
                                                </div>
                                                <?php endforeach; else: ?>
                                                    <div class="col-md-6">
                                                    <p>يرجى اضافة العنوان الخاص بك ..</p>
                                                    </div>
                                                <?php endif;?>
                                            </div>
                                            <div class="addnewaddress">
                                                <a onclick="addressExplend(this,'');">إضافة عنوان جديد</a>
                                            </div>
                                            <div class="collapse" id="collapseExample">
                                                <div class="well">
                                                    <div class="new-address">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">الاسم الكامل</label>
                                                                    <input type="text" class="form-control regInputs" id="name" name="name" placeholder="الاسم الكامل" data-title="الاسم الكامل" value="" >
                                                                    <p class="errorPrint" id="nameError"></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">رقم الهاتف</label>
                                                                    <input type="text" id="country_code" class="form-control regInputs" value="+218" style="width:25%;float: left;cursor:no-drop;" readonly="">
                                                                    <input type="text" onkeypress="return (event.charCode > 47 &amp;&amp;   event.charCode < 58) " id="mobile" name="mobile" class="form-control regInputs" placeholder="Mobile No."  data-title="Mobile No." style="width: 73%;">
                                                                    <p class="errorPrint" id="mobileError"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">بلد</label>
                                                                    <select  class="form-control regInputs" disabled readonly id="country" name="country" data-title="بلد">
                                                                        <!-- <option value="">--Select Country--</option>
                                                                        <?php if($country_code): foreach($country_code as $country): ?>
                                                                            <option value="<?=$country['country_code_id'];?>"><?=$country['name'];?></option>
                                                                        <?php endforeach; endif; ?> -->
                                                                        <option value="1">Libya</option>
                                                                    </select>
                                                                    <p class="errorPrint" id="countryError"></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">مدينة</label>
                                                                    <select  class="form-control regInputs" id="city" name="city" data-title="مدينة">
                                                                        <option value="">--اختر مدينة--</option>
                                                                        <?php if($city): foreach($city as $cityList): ?>
                                                                            <option value="<?=$cityList['city_id'];?>"><?=$cityList['name'];?></option>
                                                                        <?php endforeach; endif; ?>
                                                                    </select>
                                                                    <p class="errorPrint" id="cityError"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">Postal Code</label>
                                                                    <input type="text" class="form-control regInputs" id="postal_code" name="postal_code" data-title="Postal Code" placeholder="Postal Code" value="">
                                                                    <p class="errorPrint" id="postal_codeError"></p>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">عنوان جغرافي</label>
                                                                    <input type="text" class="form-control regInputs" onclick="openLocationPicker(this,'1');"  id="geo_address" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="">
                                                                    <input type="hidden" class="form-control"  id="geo_lat" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="">
                                                                    <input type="hidden" class="form-control"  id="geo_lng" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="">
                                                                    <p class="errorPrint" id="geo_addressError"></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">رقم المنزل.</label>
                                                                    <input type="text" class="form-control" id="house_no" name="house_no" data-title="House No." placeholder="House No." value="">
                                                                    <p class="errorPrint" id="house_noError"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">عنوان الشارع</label>
                                                                    <input type="text" class="form-control regInputs" id="street_address" name="street_address" data-title="Street Address" placeholder="Street Address" value="">
                                                                    <p class="errorPrint" id="street_addressError"></p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="buttons">
                                                            <div class="saveaddress"><a onclick="addAddress(this);" class="btn btn-primary">حفظ واستخدام العنوان</a></div>
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
                                                                    <label for="input-payment-address-1" class="control-label">الاسم الكامل</label>
                                                                    <input type="text" class="form-control regInputs2" id="name2" name="name" placeholder="الاسم الكامل" data-title="الاسم الكامل" value="" >
                                                                    <p class="errorPrint" id="name2Error"></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">رقم الهاتف</label>
                                                                    <input type="text" id="country_code2" class="form-control regInputs" value="+218" style="width:25%;float: left;cursor:no-drop;" readonly="">
                                                                    <input type="text" onkeypress="return (event.charCode > 47 &amp;&amp;   event.charCode < 58) " id="mobile2" name="mobile2" class="form-control regInputs2" placeholder="Mobile No."  data-title="Mobile No." style="width: 73%;">
                                                                    <p class="errorPrint" id="mobile2Error"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">بلد</label>
                                                                    <select  class="form-control regInputs2" id="country2" readonly disabled name="country" data-title="بلد">
                                                                        <!-- <option value="">--Select Country--</option>
                                                                        <?php if($country_code): foreach($country_code as $country): ?>
                                                                            <option value="<?=$country['country_code_id'];?>"><?=$country['name'];?></option>
                                                                        <?php endforeach; endif; ?> -->
                                                                        <option value="1">Libya</option>
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
                                                            <!-- <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">Postal Code</label>
                                                                    <input type="text" class="form-control regInputs2" id="postal_code2" name="postal_code" data-title="Postal Code" placeholder="Postal Code" value="">
                                                                    <p class="errorPrint" id="postal_code2Error"></p>
                                                                </div>
                                                            </div> -->
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">عنوان جغرافي</label>
                                                                    <input type="text" class="form-control regInputs2"  onclick="openLocationPicker(this,'2');"  id="geo_address2" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="">
                                                                    
                                                                    <input type="hidden" class="form-control regInputs2"  id="geo_lat2" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="">
                                                                    <input type="hidden" class="form-control regInputs2"  id="geo_lng2" name="geo_address" data-title="Geo Address" placeholder="Geo Address" value="">
                                                                    <p class="errorPrint" id="geo_address2Error"></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <input type="hidden" id="edit_address_id" class="form-control regInputs2">
                                                                    <label for="input-payment-address-1" class="control-label">رقم المنزل.</label>
                                                                    <input type="text" class="form-control" id="house_no2" name="house_no" data-title="House No." placeholder="House No." value="">
                                                                    <p class="errorPrint" id="house_no2Error"></p>
                                                                    <p class="errorPrint" id="edit_address_idError"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="row" id="guestMobileDiv">
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">Street Address</label>
                                                                    <input type="text" class="form-control regInputs2" id="street_address2" name="street_address" data-title="Street Address" placeholder="Street Address" value="">
                                                                    <p class="errorPrint" id="street_address2Error"></p>
                                                                </div>
                                                            </div>
                                                            <div class="buttons">
                                                                <div class="saveaddress"><a onclick="editAddress(this);" class="btn btn-primary">Save & Use Address</a></div>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="guestMobileOtpDiv" style="display:none;">
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">Street Address</label>
                                                                    <input type="text" class="form-control regInputs2" id="street_address2" name="street_address" data-title="Street Address" placeholder="Street Address" value="">
                                                                    <p class="errorPrint" id="street_address2Error"></p>
                                                                </div>
                                                            </div>
                                                            <div class="buttons">
                                                                <div class="saveaddress"><a onclick="editAddress(this);" class="btn btn-primary">Save & Use Address</a></div>
                                                            </div>
                                                        </div> -->


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group required">
                                                                    <label for="input-payment-address-1" class="control-label">عنوان الشارع</label>
                                                                    <input type="text" class="form-control regInputs2" id="street_address2" name="street_address" data-title="Street Address" placeholder="Street Address" value="">
                                                                    <p class="errorPrint" id="street_address2Error"></p>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="buttons">
                                                            <div class="saveaddress"><a onclick="editAddress(this);" class="btn btn-primary">حفظ واستخدام العنوان</a></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-map-marker"></i> حساب زائر</h4>
                                    </div>
                                    <div class="checkout-shipping-methods select-addess">
                                        <div class="panel-body " id="guestMobileDivConfirm">
                                            
                                            <div class="well">
                                                <div class="new-address" >
                                                    <div class="buttons" style="margin-right: 310px !important;">
                                                        <div class="saveaddress"><a onclick="guestLoginDiv(this);" class="btn btn-primary">تسجيل الدخول مع حساب الضيف.</a></div>
                                                    </div>

                                                    <div class="buttons" style="display: inline;position: absolute;margin-left: 172px;margin-top: -42px;">
                                                        <div class="saveaddress"><a href="<?=base_url('user-login');?>" class="btn btn-primary">تسجيل الدخول باستخدام هاتفك المحمول</a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="panel-body " style="display:none;" id="guestMobileDivConfirmTrue">
                                            <p>Login with guest account.</p>
                                            <div class="well">
                                                <div class="new-address" id="guestMobileDiv">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">رقم الهاتف</label>
                                                                <input type="text" id="guest_country_code" class="form-control" value="+218" style="width:25%;float: left;cursor:no-drop;" readonly="">
                                                                <input type="text" onkeypress="return (event.charCode > 47 &amp;&amp;   event.charCode < 58) " id="guest_mobile" name="guest_mobile" class="form-control" placeholder="Mobile No."  data-title="Mobile No." style="width: 73%;">
                                                                <p class="errorPrint" id="guest_mobileError"></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">عنوان البريد الالكترونى</label>
                                                                <input type="text" id="guest_email" class="form-control" >
                                                                <p class="errorPrint" id="guest_emailError"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <label for="input-payment-address-1" class="control-label">كلمة سر جديدة</label>
                                                                <input type="password" id="guest_password" class="form-control" >
                                                                <p class="errorPrint" id="guest_passwordError"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons">
                                                        <div class="saveaddress"><a onclick="guestLogin(this);" class="btn btn-primary">تسجيل الدخول مع حساب الضيف.</a></div>
                                                    </div>
                                                </div>

                                                <div class="new-address" id="guestMobileOtpDiv" style="display:none;">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group required">
                                                                <p class="errorPrint" id="verificationGenericError"></p>
                                                                <label for="input-payment-address-1" class="control-label">OTP</label>
                                                                <input type="text" onkeypress="return (event.charCode > 47 &amp;&amp;   event.charCode < 58) " id="guest_mobile_otp" name="guest_mobile" class="form-control" placeholder="Enter OTP"  data-title="Mobile No.">
                                                                <p class="errorPrint" id="otpError"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="buttons">
                                                        <div class="saveaddress"><a onclick="verifyOtp(this);" class="btn btn-primary">أكد الآن</a></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- <div class="col-sm-12">
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
                        </div> -->
                    </div>
                </div>
            </div>
            <div  class="col-sm-4">
                <div class="user-rightpart">
                    <h2 class="title">مجموع السلة</h2>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-left">
                                    <strong>إجمالي المنتجات:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['cart']) and $user_cart['cart']){ echo count($user_cart['cart']); }else{ echo '0'; }?> العناصر</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>السعر الكلي:</strong>
                                </td>
                                <td class="text-right" id="card_total"><?php if(isset($user_cart['total_amount']) and $user_cart['total_amount']){ echo ($user_cart['total_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>قيمة الكوبون:</strong>
                                </td>
                                <td class="text-right" id="card_coupon">0 LYD</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>مجموع رسوم التوصيل:</strong>
                                </td>
                                <td class="text-right" id="card_delivery"><?php if(isset($user_cart['delivery_amount']) and $user_cart['delivery_amount']){ echo ($user_cart['delivery_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>إجمالي المبلغ المستحق:</strong>
                                </td>
                                <td class="text-right" id="card_payble"><?php if(isset($user_cart['payble_amount']) and $user_cart['payble_amount']){ echo ($user_cart['payble_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>إجمالي الدفع المسبق:</strong>
                                </td>
                                <td class="text-right" id="card_upfront"><?php if(isset($user_cart['upfront_amount']) and $user_cart['upfront_amount']){ echo ($user_cart['upfront_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <!-- <tr>
                                <td class="text-left">
                                    <strong>Remain Amount:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['remain_amount']) and $user_cart['remain_amount']){ echo ($user_cart['remain_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- <?php if(isset($couponList) and $couponList): ?>
                    <div class="panel panel-default coupon-part">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-ticket"></i> Do you Have a Coupon or Voucher?</h4>
                        </div>
                        <div class="panel-body row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="Search" onkeyup="searchCoupon(this)"  placeholder="Enter your coupon here" value="" name="coupon">
                                </div>
                            </div>
                        </div>
                        
                        <div class="coupon-list">
                            <div class="coupon-design">
                                <div class="products-list row nopadding-xs so-filter-gird list">
                                    <?php if($couponList): foreach($couponList as $list): ?>
                                        <div class="product-layout col-lg-15 col-md-4 col-sm-6 col-xs-12 coupon_text_div">
                                            <div class="product-item-container">
                                                <div class="right-block">
                                                    <div class="caption">
                                                        <h4><a title="Chicken swinesha" class="coupon_text" target="_self"><?=$list['coupon_code'];?></a></h4>
                                                        <div class="price">
                                                            <?php if($list['coupon_type']==1):?>
                                                                <span class="price-new">Get <?=$list['coupon_discount'];?>  % OFF</span>
                                                            <?php elseif($list['coupon_type']==2):?>
                                                                <span class="price-new">Get <?=$list['coupon_discount'];?>  LYD OFF</span>
                                                            <?php else:?>
                                                                <span class="price-new">Free Shipping</span>
                                                            <?php endif;?>
                                                            
                                                            <span class="price-old">Valid till <?=date('F',strtotime($list['end_date']));?> <?=date('d',strtotime($list['end_date']));?></span>
                                                        </div>
                                                        <div class="description item-desc">
                                                            <div class="toggle-text">
                                                                <?=$list['description'];?>
                                                                </span><a href="javascript:;" class="toggle-text-link">Read more</a></span>
                                                            </div>
                                                        </div>
                                                        <div class="list-block">
                                                            <?php if($list['enable_type']==1): ?>
                                                                <button class="addToCart btn-button apply_coupon_btn" onclick="applyCoupon(this,'<?=$list['coupon_id'];?>');" type="button">Apply Coupon</button>
                                                            <?php else: ?>
                                                                <button class="addToCart btn-button" style="cursor:no-drop;background-color: #666;border-color: #666;" type="button">Apply Coupon</button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif ;?> -->
                <div class="user-rightpart checkout-side">
                    <div class="buttons">
                        <p class="errorPrint" id="PaymentError"></p>
                        <?php if(isset($user_cart['payble_amount']) and $user_cart['payble_amount']): ?>
                            <?php if($login_type==1):?>
                                <?php if($getAddress): ?>
                                    <div class="checkout-btn"><a href="<?=base_url('checkout');?>" id="placeOrderBtn" data-check="0" class="btn btn-primary">تأكيد عملية الشراء</a></div>
                                <?php else: ?>
                                    <div class="checkout-btn"><a onclick="placeOrder(this,1);" id="placeOrderBtn" data-check="0" class="btn btn-primary">تأكيد عملية الشراء</a></div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="checkout-btn">
                                <button onclick="placeOrder(this,2);" id="placeOrderBtn" data-check="0" class="button-disabled">تأكيد عملية الشراء</button></div>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="checkout-btn"><a onclick="placeOrder(this,0);" id="placeOrderBtn" data-check="0" class="btn btn-primary">تأكيد عملية الشراء</a></div>
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

    function guestLogin(){
        $(".errorPrint").css('display', 'none');
        var email=$("#guest_email").val();
        var password=$("#guest_password").val();
        var mobile=$("#guest_mobile").val();
        if(mobile){
            if(password){
                var emailPattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
                if(!emailPattern.test(email)){
                    showErrorMessage('guest_emailError','*not a valid e-mail address');
                }else{
                    if(password.length>7){
                        var reg_form_data = new FormData();
                        reg_form_data.append("mobile",$.trim($("#guest_mobile").val()));
                        reg_form_data.append("email",$.trim($("#guest_email").val()));
                        reg_form_data.append("password",$.trim($("#guest_password").val()));
                        $.ajax({
                            url: baseUrl+'createOtpGuestMobile',
                            type: "POST",
                            data: reg_form_data,
                            enctype: 'multipart/form-data',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (data) {
                                //returnObject = JSON.parse(JSON.stringify(data));
                                returnObject = JSON.parse(data);
                                // console.log('asasasas' , returnObject['error_code']);
                                if (returnObject.error_code == 200) {
                                    $("#guestMobileDiv").slideUp('slow');
                                    $("#guestMobileOtpDiv").slideDown('slow');
                                    showErrorMessage('verificationGenericError',returnObject.message);
                                }else{
                                    alert("Server coudn't send otp on mobile.");
                                }
                            },
                            error: function (error) {
                                alert("error");
                            }
                        });
                    }else{
                        showErrorMessage('guest_passwordError',"Password should be greater than 8 digits.");
                    }
                }
            }else{
                showErrorMessage('guest_passwordError',"*Password is required field.");
            }
        }else{
            showErrorMessage('guest_mobileError',"*mobile is required field.");
        }
    }

    function verifyOtp(obj){
        $(".errorPrint").css('display', 'none');
        var mobile=$("#guest_mobile").val();
        var otp=$("#guest_mobile_otp").val();
        var milliseconds = new Date().getTime();
        if (mobile) {
            var reg_form_data = new FormData();
            reg_form_data.append("mobile",mobile);
            reg_form_data.append("country_code",'218');
            reg_form_data.append("otp",otp);
            reg_form_data.append("system_id",'<?=$user_id;?>');
            reg_form_data.append("device_type","3");
            reg_form_data.append("device_id",milliseconds);
            reg_form_data.append("device_token",milliseconds);
             $.ajax({
                url: baseUrl+'verifyOtpMobile',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    returnObject = JSON.parse((data));
                    //console.log('asasasas' , returnObject);
                    if (returnObject.error_code == 200) {
                        $.ajax({
                                url: "<?php echo base_url("/web/Web/ajax") ?>",
                                type: "POST",
                                data: "method=login&user_id=" + returnObject.data.user_id+'&device_id='+returnObject.data.device_id+'&security_token='+returnObject.data.security_token,
                                success: function (data) {
                                    var dta = $.trim(data);
                                    var jsonData = $.parseJSON(dta);
                                    if (jsonData['error_code'] == 200) {
                                        swal({title:"Success",text: returnObject.message,type: "success"},function(){ 
                                            location.reload();
                                        })
                                    } else {
                                        alert("Some error found");
                                    }
                                }
                            })
                       //alert(returnObject.message);
                       //window.location.href="<?=base_url();?>";
                    }else{
                        showErrorMessage('otpError',returnObject.message);
                    }
                },
                error: function (error) {
                     alert("error");
                }
            });
        } else {
            if(mobile){
                swal({title:"Warning.",text: "*OTP is required field",type: "warning"})
            }else{
                swal({title:"Warning.",text: "*Email is required field",type: "warning"})
            }
        }
    }

    function addAddress(obj){
        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                //alert($(this).attr('data-title'))
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
            //alert("sss")
            var getLat=$("#geo_lat").val();
            var getLng=$("#geo_lng").val();
            if(getLat && getLng){
                var name=$("#name").val();
                var country_code='218';
                var mobile=$("#mobile").val();
                var country="1";
                var city=$("#city").val();
                var geo_address=$("#geo_address").val();
                var street_address=$("#street_address").val();
                var house_no=$("#house_no").val();
                var postal_code=$("#postal_code").val();
                $.ajax({
                    url: "<?php echo base_url("/web/Web/ajax") ?>",
                    type: "POST",
                    data: "method=addAddress&name="+name+'&country_code='+country_code+'&mobile='+mobile+'&country='+country+'&city='+city+'&geo_address='+geo_address+'&street_address='+street_address+'&house_no='+house_no+'&postal_code='+postal_code+'&lat='+getLat+'&lng='+getLng,
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
            }else{
                swal({title:"Warning.",text: "Cordinated not get.Please select geo address.",type: "warning"})
            }
        }
    }

    function deleteAddress(obj,i){
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            var reg_form_data = new FormData();
            reg_form_data.append("user_id",<?=$user_id;?>);
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
            var lat=$("#street_address_"+index).attr('data-lat');
            var lng=$("#street_address_"+index).attr('data-lng');
            var country="1";
            $("#name2").val(name);
            $("#mobile2").val(mobile);
            $("#geo_address2").val(geo_address);
            $("#street_address2").val(street_address);
            $("#house_no2").val(house);
            $("#postal_code2").val(postal);
            $("#edit_address_id").val(id);
            $("#geo_lat2").val(lat);
            $("#geo_lng2").val(lng);
            
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
            var getLat=$("#geo_lat2").val();
            var getLng=$("#geo_lng2").val();
            if(getLat && getLng){

                var reg_form_data = new FormData();
                reg_form_data.append("user_id",<?=$user_id;?>);
                reg_form_data.append("address_id",$("#edit_address_id").val());
                reg_form_data.append("name",$("#name2").val());
                reg_form_data.append("mobile",$("#mobile2").val());
                reg_form_data.append("country_id",$("#country2").val());
                reg_form_data.append("city_id",$("#city2").val());
                reg_form_data.append("postal_code",$("#postal_code2").val());
                reg_form_data.append("geo_address",$("#geo_address2").val());
                reg_form_data.append("street_address",$("#street_address2").val());
                reg_form_data.append("house_no",$("#house_no2").val());
                reg_form_data.append("lat",getLat);
                reg_form_data.append("lng",getLng);
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
            }else{
                swal({title:"Warning.",text: "Cordinated not get.Please select geo address.",type: "warning"})
            }
        }
    }

    function placeOrder(o,t){
        if(t==1){
            showErrorMessage('PaymentError',"*Please Add Your address");
        }else if(t==2){
            showErrorMessage('PaymentError',"*Please Login First");
        }else{
            showErrorMessage('PaymentError',"*Some error found");
        }
    }

    // function selectAddress(o,ai){
    //     $(".addressDiv").attr('data-status',0);
    //     $(o).attr('data-status',1);
    //     $('.card-input').removeClass('selectedDiv');
    //     $(0).children().addClass('selectedDiv');

    //     var user_id=<?=$user_id;?>;
    //     var reg_form_data = new FormData();
    //     reg_form_data.append("user_id",user_id);
    //     reg_form_data.append("address_id",ai);
    //     reg_form_data.append("is_web","1");
    //     $.ajax({
    //         url: baseUrl+'getMyCart',
    //         type: "POST",
    //         data: reg_form_data,
    //         enctype: 'multipart/form-data',
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         success: function (data) {
    //             //returnObject = JSON.parse(JSON.stringify(data));
                
    //             returnObject = JSON.parse((data));
    //             console.log(returnObject['data'])
    //             if (returnObject.error_code == 200) {
    //                 var dta=returnObject['data'];
    //                 $("#card_delivery").empty();
    //                 $("#card_delivery").append(dta['delivery_amount']+' LYD');
    //             }else{
    //                 showPopsHeaderFunc('2',returnObject['message']);
    //             }
    //             //location.reload();
    //         },
    //         error: function (error) {
    //                 alert("error");
    //         }
    //     });
        
    // }

    function openLocationPicker(o,t){
        $("#location_btn").attr('data-check',t);
        $("#editaddress").modal('show');
    }

    function guestLoginDiv(o){
        $("#guestMobileDivConfirm").css('display','none');
        $("#guestMobileDivConfirmTrue").css('display','block');
    }



    // function searchCoupon(o) {
    //     input = $.trim($(o).val());
    //     filter = input.toUpperCase();
    //     //alert(filter)
    //     if(filter){
    //         var coupon_text=$(".coupon_text");
    //         if(coupon_text){
    //             $(coupon_text).each(function( index,val ) {
    //                 // console.log(($(val).html()).toUpperCase())
    //                 var divText=($(val).html()).toUpperCase();
    //                 //console.log(divText.indexOf(filter))
    //                 console.log($(val).closest('.coupon_text_div').attr('class'))
    //                 if(divText.indexOf(filter)>-1){
    //                     $(val).closest('.coupon_text_div').css('display','block');
    //                 }else{
    //                     $(val).closest('.coupon_text_div').css('display','none');
    //                 }
    //             })
    //         }
    //     }else{
    //         $('.coupon_text_div').css('display','block');
    //     }
    // }

    // function applyCoupon(o,c) {
    //     setNormalPosition(o,false);
    //     if(c){
    //         var user_id=<?=$user_id;?>;
    //         var reg_form_data = new FormData();
    //         reg_form_data.append("user_id",user_id);
    //         reg_form_data.append("coupon_id",c);
    //         reg_form_data.append("is_web","1");
    //         $.ajax({
    //             url: baseUrl+'applyCoupon',
    //             type: "POST",
    //             data: reg_form_data,
    //             enctype: 'multipart/form-data',
    //             cache: false,
    //             contentType: false,
    //             processData: false,
    //             success: function (data) {
    //                 //returnObject = JSON.parse(JSON.stringify(data));
                    
    //                 returnObject = JSON.parse((data));
    //                 //console.log(returnObject['data']['coupon_type'])
    //                 if (returnObject.error_code == 200) {
    //                     var dta=returnObject['data'];
    //                     if(dta['coupon_type']==3){
    //                         $("#card_delivery").empty();
    //                         $("#card_delivery").append(dta['delivery_amount']+' LYD');
    //                     }
    //                     $("#card_payble").empty();
    //                     $("#card_payble").append(dta['payble_amount']+' LYD');

    //                     $("#card_upfront").empty();
    //                     $("#card_upfront").append(dta['upfront_amount']+' LYD');

    //                     $("#card_coupon").empty();
    //                     $("#card_coupon").append(dta['coupon_amount']+' LYD <a onclick="removeCoupon(this);" style="cursor:pointer;color: red;"><i class="fa fa-times-circle"></i></a>');
    //                     $("#placeOrderBtn").attr('data-check',c);
    //                     $(".apply_coupon_btn").attr('disabled',true);
    //                     showPopsHeaderFunc('1',returnObject['message']);
    //                  }else{
    //                     showPopsHeaderFunc('2',returnObject['message']);
    //                 }
    //                 //location.reload();
    //             },
    //             error: function (error) {
    //                     alert("error");
    //             }
    //         });
    //     }
    //     setNormalPositionEnd(o,'1');
    // }

    // function removeCoupon(){
    //     swal({
    //         title: "Are you sure?",
    //         text: "You want to remove coupon?",
    //         type: "warning",
    //         showCancelButton: true,
    //         confirmButtonClass: "btn-danger",
    //         confirmButtonText: "Yes, Remove!",
    //         closeOnConfirm: false
    //         },
    //         function(){
    //             location.reload();
    //         });
    // }
</script>
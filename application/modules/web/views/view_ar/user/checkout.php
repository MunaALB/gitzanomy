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
</style>
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a style="color:red;" href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
        <li><a style="color:red;" href="<?=base_url('ar/my-cart');?>">عربة التسوق الخاصة بي</a></li>
        <li><a style="color:red;" href="<?=base_url('ar/address');?>">عنوان</a></li>
        <li>الدفع</li>
        
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
                                        <p>يرجى اختيار عنوان الشحن المفضل لاستخدامها لهذه الطلبية.</p>
                                        <div class="row">
                                            <?php if($getAddress): foreach($getAddress as $key=>$address): ?>
                                                    <?php if($key==0){ ?>
                                                        <div class="col-md-6 addressDiv" data-status="1" data-address="<?=$address['address_id'];?>" onclick="selectAddress(this,'<?=$address['address_id'];?>')">
                                                            <label>
                                                                <input type="radio" name="product" checked class="card-input-element" />
                                                                <div class="panel panel-default card-input selectedDiv" >
                                                    <?php }else{ ?>
                                                        <div class="col-md-6 addressDiv" data-status="0" data-address="<?=$address['address_id'];?>" onclick="selectAddress(this,'<?=$address['address_id'];?>')">
                                                            <label>
                                                                <input type="radio" name="product" class="card-input-element" />
                                                                <div class="panel panel-default card-input">
                                                    <?php } ?>
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
                                            <a href="<?=base_url('ar/address');?>">إضافة عنوان جديد</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-credit-card"></i> طريقة الدفع او السداد</h4>
                                </div>
                                <div class="checkout-shipping-methods">
                                    <div class="panel-body ">
                                        <p>يرجى اختيار طريقة الدفع المفضلة لاستخدامها في هذه الطلبية</p>
                                        <div class="radio">
                                            <label><input type="radio" value="1" checked="checked" name="payment"> الدفع عند الاستلام</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" value="2" name="payment">دفع إلكتروني</label>
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
                    <h2 class="title">مجموع السلة</h2>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="text-left">
                                    <strong>توصيلة متوقعة:</strong>
                                </td>
                                <td class="text-right" id="exp_total"><?php if(isset($user_cart['expected_delivery']) and $user_cart['expected_delivery']){ echo ($user_cart['expected_delivery']); }else{ echo 'N/A'; }?> Days</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>إجمالي المنتجات:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['cart']) and $user_cart['cart']){ echo count($user_cart['cart']); }else{ echo '0'; }?> Items</td>
                            </tr>
                            <tr>
                                <td class="text-left">
                                    <strong>السعر الكلي:</strong>
                                </td>
                                <td class="text-right" id="card_total"><?php if(isset($user_cart['payble_amount']) and $user_cart['payble_amount']){ echo ($user_cart['payble_amount']); }else{ echo '0'; }?> LYD</td>
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
                                <td class="text-right" id="card_payble"><?php if(isset($user_cart['total_amount']) and $user_cart['total_amount']){ echo ($user_cart['total_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr>
                            <!-- <tr>
                                <td class="text-left">
                                    <strong>إجمالي الدفع المسبق:</strong>
                                </td>
                                <td class="text-right" id="card_upfront"><?php if(isset($user_cart['upfront_amount']) and $user_cart['upfront_amount']){ echo ($user_cart['upfront_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr> -->
                            <!-- <tr>
                                <td class="text-left">
                                    <strong>Remain Amount:</strong>
                                </td>
                                <td class="text-right"><?php if(isset($user_cart['remain_amount']) and $user_cart['remain_amount']){ echo ($user_cart['remain_amount']); }else{ echo '0'; }?> LYD</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
                <?php if(isset($couponList) and $couponList): ?>
                    <div class="panel panel-default coupon-part">
                        <div class="panel-heading">
                            <h4 class="panel-title"><i class="fa fa-ticket"></i> هل لديك قسيمة او كوبون؟</h4>
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
                                                                <span class="price-new">الشحن مجانا</span>
                                                            <?php endif;?>
                                                            
                                                            <span class="price-old">صالح حتى <?=date('F',strtotime($list['end_date']));?> <?=date('d',strtotime($list['end_date']));?></span>
                                                        </div>
                                                        <div class="description item-desc">
                                                            <div class="toggle-text">
                                                                <?=$list['description'];?>
                                                                </span><a href="javascript:;" class="toggle-text-link">قراءة المزيد</a></span>
                                                            </div>
                                                        </div>
                                                        <div class="list-block">
                                                            <?php if($list['enable_type']==1): ?>
                                                                <button class="addToCart btn-button apply_coupon_btn" onclick="applyCoupon(this,'<?=$list['coupon_id'];?>');" type="button">تطبيق القسيمة</button>
                                                            <?php else: ?>
                                                                <button class="addToCart btn-button" style="cursor:no-drop;background-color: #666;border-color: #666;" type="button">تطبيق القسيمة</button>
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
                <?php endif ;?>
                <div class="user-rightpart checkout-side">
                    <div class="buttons">
                        <p class="errorPrint" id="PaymentError"></p>
                        <?php if(isset($user_cart['payble_amount']) and $user_cart['payble_amount']): ?>
                            <div class="checkout-btn"><a onclick="placeOrder(this,1);" id="placeOrderBtn" data-check="0" class="btn btn-primary">عملية الخروج</a></div>
                        <?php else: ?>
                            <div class="checkout-btn"><a onclick="placeOrder(this,0);" id="placeOrderBtn" data-check="0" class="btn btn-primary">عملية الخروج</a></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
            السلة خاليه
        <?php endif; ?>
    </div>
</div>
<script src="https://tnpg.moamalat.net:6006/js/lightbox.js?v=1.1"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js" integrity="sha512-nOQuvD9nKirvxDdvQ9OMqe2dgapbPB7vYAMrzJihw5m+aNcf0dX53m6YxM4LgA9u8e9eg9QX+/+mPu8kCNpV2A==" crossorigin="anonymous"></script>
<script>
    var baseUrl="<?=$base_url;?>";
    var totalAmount="<?=$user_cart['total_amount']?>";
    function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }
    
    function placeOrder(o,t){
        if(t){
            var payment_type=$("input[name='payment']:checked").val();
            var user_id='<?=$user_id;?>';
            var address_id='';
            var addressData=$(".addressDiv").length;
            if(addressData){
                $(".addressDiv").each(function(i,v){
                    if($(v).attr('data-status')==1){
                        address_id=$(v).attr('data-address')
                    }
                });
            }else{
                // alert("Please Add your address to place your order.")
                swal({
                    title: "المعذره",
                    text: "يرجى تحديد العنوان",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "إضافة عنوان جديد",
                    closeOnConfirm: false
                },function(){
                    window.location.href='<?=base_url('ar/address');?>';
                });
            }
            if(user_id && address_id && payment_type ){
                $(o).attr('disabled','disabled')
                var coupon_id=$(o).attr('data-check');
                var reg_form_data = new FormData();
                reg_form_data.append("user_id",user_id);
                reg_form_data.append("address_id",address_id);
                reg_form_data.append("payment_type",payment_type);
                reg_form_data.append("coupon_id",coupon_id);
                reg_form_data.append("is_web","2");
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
                            if(payment_type=='2'){
                                var paymentCallBack=callLightbox(returnObject['data'],totalAmount);
                                console.log('paymentCallBack',paymentCallBack)
                            }else{
                                window.location.href="<?=base_url('ar/success/');?>"+returnObject['data']['order_id'];
                            }
                        }else{
                            window.location.href="<?=base_url('ar/failure');?>";
                        }
                    },
                    error: function (error) {
                            alert("error");
                    }
                });
            }else{
                if(address_id==''){
                    showErrorMessage('PaymentError',"*يرجى تحديد العنوان");
                }else if(payment_type==''){
                    showErrorMessage('PaymentError',"*يرجى تحديد طريقة الدفع");
                }else{
                    showErrorMessage('PaymentError',"*تم العثور على بعض الأخطاء");
                }
            }
        }
    }
    function selectAddress(o,ai){
        $(".addressDiv").attr('data-status',0);
        $(o).attr('data-status',1);
        $('.card-input').removeClass('selectedDiv');
        $(0).children().addClass('selectedDiv');

        var user_id=<?=$user_id;?>;
        var reg_form_data = new FormData();
        reg_form_data.append("user_id",user_id);
        reg_form_data.append("address_id",ai);
        reg_form_data.append("is_web","2");
        $.ajax({
            url: baseUrl+'getMyCart',
            type: "POST",
            data: reg_form_data,
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //returnObject = JSON.parse(JSON.stringify(data));
                
                returnObject = JSON.parse((data));
                console.log(returnObject['data'])
                if (returnObject.error_code == 200) {
                    var dta=returnObject['data'];
                    $("#exp_total").empty();
                    $("#exp_total").append(dta['expected_delivery']+' Days');

                    $("#card_delivery").empty();
                    $("#card_delivery").append(dta['delivery_amount']+' LYD');

                    $("#card_payble").empty();
                    $("#card_payble").append(dta['total_amount']+' LYD');
                }else{
                    showPopsHeaderFunc('2',returnObject['message']);
                }
                //location.reload();
            },
            error: function (error) {
                    alert("error");
            }
        });
        
    }

    function searchCoupon(o) {
        input = $.trim($(o).val());
        filter = input.toUpperCase();
        //alert(filter)
        if(filter){
            var coupon_text=$(".coupon_text");
            if(coupon_text){
                $(coupon_text).each(function( index,val ) {
                    // console.log(($(val).html()).toUpperCase())
                    var divText=($(val).html()).toUpperCase();
                    //console.log(divText.indexOf(filter))
                    console.log($(val).closest('.coupon_text_div').attr('class'))
                    if(divText.indexOf(filter)>-1){
                        $(val).closest('.coupon_text_div').css('display','block');
                    }else{
                        $(val).closest('.coupon_text_div').css('display','none');
                    }
                })
            }
        }else{
            $('.coupon_text_div').css('display','block');
        }
    }

    function applyCoupon(o,c) {
        setNormalPosition(o,false);
        if(c){
            var user_id=<?=$user_id;?>;
            var reg_form_data = new FormData();
            reg_form_data.append("user_id",user_id);
            reg_form_data.append("coupon_id",c);
            reg_form_data.append("is_web","2");
            $.ajax({
                url: baseUrl+'applyCoupon',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    //returnObject = JSON.parse(JSON.stringify(data));
                    
                    returnObject = JSON.parse((data));
                    //console.log(returnObject['data']['coupon_type'])
                    if (returnObject.error_code == 200) {
                        var dta=returnObject['data'];
                        if(dta['coupon_type']==3){
                            $("#card_delivery").empty();
                            $("#card_delivery").append(dta['delivery_amount']+' LYD');
                        }
                        $("#card_payble").empty();
                        $("#card_payble").append(dta['payble_amount']+' LYD');

                        $("#card_upfront").empty();
                        $("#card_upfront").append(dta['upfront_amount']+' LYD');

                        $("#card_coupon").empty();
                        $("#card_coupon").append(dta['coupon_amount']+' LYD <a onclick="removeCoupon(this);" style="cursor:pointer;color: red;"><i class="fa fa-times-circle"></i></a>');
                        $("#placeOrderBtn").attr('data-check',c);
                        $(".apply_coupon_btn").attr('disabled',true);
                        showPopsHeaderFunc('1',returnObject['message']);
                     }else{
                        showPopsHeaderFunc('2',returnObject['message']);
                    }
                    //location.reload();
                },
                error: function (error) {
                        alert("error");
                }
            });
        }
        setNormalPositionEnd(o,'1');
    }

    function removeCoupon(){
        swal({
            title: "هل أنت متأكد",
            text: "تريد إزالة القسيمة؟",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "نعم ، قم بإزالتها!",
            closeOnConfirm: false
        },
        function(){
            location.reload();
        });
    }
</script>


<script>

        Lightbox.Checkout.configure = {
            MID: "10068058671",
            TID: "5540295",
            MerchantReference:"Txn-1234",
            AmountTrxn: 100, SecureHash:
                "122a226dd14cc6d3f38750e9b2e51ddba7f6b3825ec5a102a1beb4e5bdd2781e", completeCallback: function (data) {
                    console.log(data)
                },
            errorCallback: function (error) {
                //your code here
                console.log(error)
            },
            cancelCallback: function (error) {
                //your code here
                console.log(error)
            }
        }

        function payNow(){
            Lightbox.Checkout.showLightbox();
        }



    </script>

<script type="text/javascript">

    function callLightbox(a,b) {


    var amount = b;
    var merchRef = a['order_id'];

	var merchantKey = "38386534613937312D373733642D343131332D393434392D323662363434393135653437";
      var mID = 10068058671;
      var tID = 5540295;
      if (mID === '' || tID === '') {
        //document.getElementById("Error").style.display = "block";
        return;
      }
	  //debugger;
	  var dt = new Date().toGMTString();
	  var hmacSHA256 = '';
	  
	  if(merchantKey)
	  {
		   merchantKey = hex_to_ascii(merchantKey);
		  var strHashData = 'Amount='+amount+'000&DateTimeLocalTrxn='+dt+'&MerchantId='+mID+'&MerchantReference='+merchRef+'&TerminalId='+tID;
		  console.log(strHashData);
		  hmacSHA256 = CryptoJS.HmacSHA256(strHashData,merchantKey).toString().toUpperCase();
		   
		  console.log('ssss',hmacSHA256);
	 }

      //document.getElementById("Error").style.display = "none";
	  
      Lightbox.Checkout.configure = {
        MID: mID,
        TID: tID,
        AmountTrxn: amount+'000',
        MerchantReference: merchRef,
		TrxDateTime: dt,
		SecureHash:  hmacSHA256 ,
        completeCallback: function (data) {
          console.log('completed');
		  console.log(data);
          var reg_form_data = new FormData();
                reg_form_data.append("user_id",a['user_id']);
                reg_form_data.append("order_id",a['order_id']);
                reg_form_data.append("total_amount",a['total']);
                reg_form_data.append("payment_status",1);
                reg_form_data.append("txn_id",a['order_id']);
                reg_form_data.append("reference_id",a['order_id']);
                reg_form_data.append("type",1);
                reg_form_data.append("is_web","1");
                $.ajax({
                    url: baseUrl+'orderPayment',
                    type: "POST",
                    data: reg_form_data,
                    enctype: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        //returnObject = JSON.parse(JSON.stringify(data));
                        returnObject = JSON.parse((data));
                        console.log(returnObject)
                        if (returnObject.error_code == 200) {
                            window.location.href="<?=base_url('ar/success/');?>"+a['order_id'];
                        }else{
                            window.location.href="<?=base_url('ar/failure');?>";
                        }
                        //location.reload();
                    },
                    error: function (error) {
                            alert("error");
                    }
                });

        },
        errorCallback: function (data) {
          console.log('error');
		  console.log(data);
          
        //   window.location.href="<?=base_url('ar/failure');?>";
        },
        cancelCallback:function () {
          console.log('cancel');
        //   window.location.href="<?=base_url('ar/failure');?>";
        }
      };

      Lightbox.Checkout.showLightbox();
    }
	
	function hex_to_ascii(str1)
	 {
		var hex  = str1.toString();
		var str = '';
		for (var n = 0; n < hex.length; n += 2) {
			str += String.fromCharCode(parseInt(hex.substr(n, 2), 16));
		}
		return str;
	 }
  </script>

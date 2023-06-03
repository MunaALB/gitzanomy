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
        <li><a style="color:red;" href="<?=base_url('');?>"><i class="fa fa-home"></i></a></li>
        <li>سلتي</li>
    </ul>
    <div class="mycart-part">
        <?php if(isset($user_cart['cart'][0]) and $user_cart['cart'][0]): ?>
            <div class="row">
                <div  id="content" class="col-sm-7">
                    <div class="user-rightpart">
                    <h2 class="title">سلتي</h2>
                        <div class="user-gridpoints">
                            <div id="caption-cart-data" class="products-list row nopadding-xs so-filter-gird list">
                                <?php if(isset($user_cart['cart']) and $user_cart['cart']): foreach($user_cart['cart'] as $fproduct): ?>
                                <div class="product-layout col-md-12 col-sm-12 col-xs-12">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img">
                                                <a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id'].'/'.$fproduct['item_id']); ?>" target="_self" title="<?=$fproduct['name'];?>">
                                                    <?php if(isset($fproduct['images'][0])): ?>
                                                        <img src="<?=$fproduct['images'][0]['image'];?>" class="img-1 img-responsive" alt="<?=$fproduct['name'];?>">
                                                    <?php if(isset($fproduct['images'][1])): ?>
                                                        <img src="<?=$fproduct['images'][1]['image'];?>" class="img-2 img-responsive" alt="<?=$fproduct['name'];?>">
                                                        <?php endif; ?>
                                                    <?php else: ?> 
                                                        <img src="<?php echo base_url(); ?>assets/web/images/product/320/2.2.jpg" class="img-1 img-responsive" alt="<?=$fproduct['name'];?>">
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="<?php echo base_url('ar/product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id'].'/'.$fproduct['item_id']); ?>" title="<?=$fproduct['name'];?>" target="_self"><?=$fproduct['name'];?>
                                                <?php if(isset($fproduct['product_attributes']) and $fproduct['product_attributes']):
                                                $viewData="(";
                                                foreach($fproduct['product_attributes'] as $selectedAttr):
                                                    $viewData.=$selectedAttr['attribute_value'].', ';
                                                endforeach; $viewData=trim($viewData,', '); $viewData.=")"; echo $viewData; endif; ?>
                                                </a></h4>
                                                <div class="price"> <span class="price-new"><?=$fproduct['total'];?> LYD</span>
                                                    <!--<span class="price-old"><?=$fproduct['price'];?> LYD</span>-->
                                                </div>
                                                <div class="cart-quantity">
                                                <p class="errorPrint" id="genericError<?=$fproduct['item_id'];?>"></p>
                                                    <div class="option quantity">
                                                        <div class="input-group quantity-control" unselectable="on">
                                                            <label>Qty</label>
                                                            <input class="form-control" readonly type="text" name="quantity"
                                                            value="<?=$fproduct['cart_quentity'];?>" style="width:55px;">
                                                            <span onclick="addToCart(this,'<?=$fproduct['product_id'];?>','<?=$fproduct['item_id'];?>','2');" class="input-group-addon product_quantity_down">−</span>
                                                            <?php if($fproduct['quantity']==0): ?>
                                                                <span onclick="loginRequired(this,2,<?=$fproduct['item_id'];?>);" class="product_quantity_up">+</span>
                                                            <?php else: ?>
                                                                <span onclick="addToCart(this,'<?=$fproduct['product_id'];?>','<?=$fproduct['item_id'];?>','1');" class="input-group-addon product_quantity_up">+</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-block">
                                                    <button class="compare btn-button" onclick="addToCart(this,'<?=$fproduct['product_id'];?>','<?=$fproduct['item_id'];?>','3');" type="button" title="إزالة العنصر">إزالة العنصر
                                                    </button>
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
                <div  class="col-sm-5">
                    <div class="user-rightpart" id="my-cart-cart-total">
                        <h2 class="title">مجموع السلة</h2>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="text-left">
                                            <strong>إجمالي المنتجات:</strong>
                                        </td>
                                        <td class="text-right"><?=count($user_cart['cart']);?> العناصر</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <strong>السعر الكلي:</strong>
                                        </td>
                                        <td class="text-right"><?=($user_cart['total_amount']);?> LYD</td>
                                    </tr>
                                    <!-- <tr>
                                        <td class="text-left">
                                            <strong>Total Discount:</strong>
                                        </td>
                                        <td class="text-right">200 LYD</td>
                                    </tr> -->
                                    <!-- <tr>
                                        <td class="text-left">
                                            <strong>VAT (20%):</strong>
                                        </td>
                                        <td class="text-right">100 LYD</td>
                                    </tr> -->
                                    <tr>
                                        <td class="text-left">
                                            <strong>المجموع الفرعي:</strong>
                                        </td>
                                        <td class="text-right"><?=($user_cart['total_amount']);?> LYD</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="buttons">
                                <div class="checkout-btn"><a href="<?php echo base_url('ar/address'); ?>" class="btn btn-primary">الدفع</a></div>
                                <!-- <div class="checkout-btn"><a href="<?php echo base_url('ar/checkout'); ?>" class="btn btn-primary">Checkout</a></div> -->
                            </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <td class="text-right">Cart Is Empty</td>
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
function loginRequired(o,t,i){
    if(t==1){
        showErrorMessage('genericError'+i,'*انت تحتاج لتسجيل الدخول اولا.');
    }else if(t==2){
        showErrorMessage('genericError'+i,'غير متوفر');
    }
}
function addToCart(o,p,i,t){
    if(p && i && t){
        $.ajax({
                url: "<?php echo base_url("/web/Web/ajax") ?>",
                type: "POST",
                data: "method=addToCart&product_id="+p+'&item_id='+i+'&type='+t,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 200) {
                        alert(jsonData['message']);
                        location.reload();
                    } else {
                        showErrorMessage('genericError'+i,jsonData['message']);
                        location.reload();
                    }
                },
                error: function (error) {
                    alert("error");
                }
            });
    }else{
        alert("Some error found.");
    }
}

</script>
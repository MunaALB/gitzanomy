<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">حسابي</a></li>
        <li><a href="#">لوحة المستخدم</a></li>
        <li><a href="#">منتجاتي المفضلة</a></li>
    </ul>
    <div class="row">
        <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
            <?php include 'usersidebar.php';?>
        </aside>
        <div id="content" class="col-sm-9 user-rightpart">
            <h2 class="title">منتجاتي المفضلة</h2>
            <div class="user-gridpoints">
                <?php if(isset($wishlist) and $wishlist): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-center">صورة</td>
                                <td class="text-center">اسم المنتج</td>
                                <td class="text-center">المنتجات</td>
                                <td class="text-center">تصنيف فرعي</td>
                                <td class="text-center">سعر الوحدة</td>
                                <td class="text-center">عمل</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($wishlist) and $wishlist): foreach($wishlist as $fproduct): ?>
                                <tr>
                                    <td class="text-center">
                                        <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id'].'/'.$fproduct['item_id']); ?>" target="_self" title="Chicken swinesha">
                                            <?php if(isset($fproduct['images'][0])): ?>
                                                <img src="<?=$fproduct['images'][0]['image'];?>" width="70px"  alt="320 X 320">
                                            <?php else: ?> 
                                                <img src="<?php echo base_url(); ?>assets/web/images/product/320/2.2.jpg" width="70px"  alt="320 X 320">
                                            <?php endif; ?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?=$fproduct['name'];?></td>
                                    <td class="text-center"><?=$fproduct['category_name'];?></td>
                                    <td class="text-center"><?=$fproduct['subcategory_name'];?></td>
                                    <td class="text-center">
                                        <div class="price"> <span class="price-new"><?=$fproduct['discount_price'];?> LYD</span>
                                            <?php if($fproduct['discount']>0): ?><span class="price-old"><?=$fproduct['price'];?> LYD</span><?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name_ar'])).'/'.$fproduct['product_id'].'/'.$fproduct['item_id']); ?>" class="btn btn-primary" title=""><i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <a onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; else: echo "لاتوجد بيانات"; endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                    <div class="">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 messege-nodata">
                                <i class="fa fa-shopping-bag"></i>
                                <h2 class="about-title">لاتوجد بيانات</h2>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    var baseUrl="<?=$base_url;?>";
    function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }
    function addToWishlist(o,p){
        if(p){
            $.ajax({
                url: "<?php echo base_url("/web/Web/ajax") ?>",
                type: "POST",
                data: "method=addToWishlist&product_id="+p,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 200) {
                        alert(jsonData['message']);
                        location.reload();
                    } else {
                        showErrorMessage('genericError',jsonData['message']);
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
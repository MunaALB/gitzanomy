<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#">User Dashboard</a></li>
        <li><a href="#">Favourite Products</a></li>
    </ul>
    <div class="row">
        <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
            <?php include 'usersidebar.php';?>
        </aside>
        <div id="content" class="col-sm-9 user-rightpart">
            <h2 class="title">Favourite Products</h2>
            <div class="user-gridpoints">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-center">Image</td>
                                <td class="text-center">Product Name</td>
                                <td class="text-center">Category</td>
                                <td class="text-center">Sub-Category</td>
                                <td class="text-center">Unit Price</td>
                                <td class="text-center">Action</td>
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
                                        <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id'].'/'.$fproduct['item_id']); ?>" class="btn btn-primary" title=""><i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <a onclick="addToWishlist(this,'<?=$fproduct['product_id'];?>');" class="btn btn-danger" title="" data-toggle="tooltip" data-original-title="Remove"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; else: echo "No data found"; endif; ?>
                        </tbody>
                    </table>
                </div>
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
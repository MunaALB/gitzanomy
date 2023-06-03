<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Top Selling Products</a></li>
            </ul>
            <div class="row">
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="products-category">
                        
                        <div class="products-list row nopadding-xs so-filter-gird grid">
                            <?php if($product): foreach($product as $fproduct): ?>
                            <div class="product-layout col-md-3 col-sm-6 col-xs-12">
                                <div class="product-item-container">
                                    <div class="left-block">
                                        <div class="product-image-container <?php if(isset($fproduct['images'][1])): echo "second_img"; endif; ?>">
                                            <a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id']); ?>" title="<?=$fproduct['name'];?>">
                                                <?php if(isset($fproduct['images'][0])): ?>
                                                    <img src="<?=$fproduct['images'][0]['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                <?php if(isset($fproduct['images'][1])): ?>
                                                    <img src="<?=$fproduct['images'][1]['image'];?>" class="img-2 img-responsive" alt="320 X 320">
                                                    <?php endif; ?>
                                                <?php else: ?> 
                                                    <img src="<?php echo base_url(); ?>assets/web/images/product/320/2.2.jpg" class="img-1 img-responsive" alt="320 X 320">
                                                <?php endif; ?>
                                            </a>
                                        </div>

                                        <div class="button-group so-quickview cartinfo--left">
                                            <button type="button" class="addToCart btn-button" title="Add to cart"> <i class="fa fa-shopping-basket"></i>
                                                <span>Add to cart </span>
                                            </button>
                                            <button type="button" class="wishlist btn-button" title="Add to Wish List"><i class="fa fa-heart"></i><span>Add to Wish List</span>
                                            </button>
                                            <a class="iframe-link btn-button quickview quickview_handler visible-lg" href="<?php echo base_url('quick-view-product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id']); ?>" title="Quick view" data-fancybox-type="iframe"><i class="fa fa-eye"></i><span>Quick view</span></a>
                                        </div>
                                    </div>
                                    <div class="right-block">
                                        <div class="caption">
                                            <h4><a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $fproduct['name'])).'/'.$fproduct['product_id']); ?>" title="Pride Mobility Chair"><?=$fproduct['name'];?></a></h4>
                                            <div class="price"> <span class="price-new"><?=$fproduct['discount_price'];?> LYD</span>
                                            <?php if($fproduct['discount']>0): ?>
                                                <span class="price-old"><?=$fproduct['price'];?> LYD</span>
                                            <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; else: ?>
                                <div class="col-lg-12 col-md-12 messege-nodata">
                                    <i class="fa fa-shopping-bag"></i>
                                    <h2 class="about-title" style="font-size: 12px;">No Data Found</h2>
                                    <p> <a href="<?=base_url('');?>">Go To Home</a> </p>
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- <div class="product-filter product-filter-top filters-panel hidden-sm hidden-xs">
                            <div class="row">
                                <div class="col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 view-mode">
                                    <div class="list-view ">
                                        <button type="button" id="list-view" class="btn btn-view list "><i class="fa fa-angle-double-left"></i>
                                        </button>
                                        <button type="button" id="grid-view" class="btn btn-view hidden-sm hidden-xs">1</button>
                                        <button type="button" id="grid-view-2" class="btn btn-view ">2</button>
                                        <button type="button" id="grid-view-3" class="btn btn-view hidden-sm hidden-xs ">3</button>
                                        <button type="button" id="grid-view-4" class="btn btn-view hidden-sm hidden-xs">4</button>
                                        <button type="button" id="list-view" class="btn btn-view list "><i class="fa fa-angle-double-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function filterProduct(o){
        var value1='';var value2='';var value3='';
        var url='';
        $.each($("input[name='value_1']:checked"), function(i,v){
            var vals=$(v).attr('data-value');
            if(i==0){ value1=vals+'@'+v['value'];
            }else{ value1=value1+'-'+vals+'@'+v['value']; }
        });
        $.each($("input[name='value_2']:checked"), function(i,v){
            var vals=$(v).attr('data-value');
            if(i==0){ value2=vals+'@'+v['value'];
            }else{ value2=value2+'-'+vals+'@'+v['value']; }
        });
        $.each($("input[name='value_3']:checked"), function(i,v){
            var vals=$(v).attr('data-value');
            if(i==0){ value3=vals+'@'+v['value'];
            }else{ value3=value3+'-'+vals+'@'+v['value']; }
        });
        
        if(value1){ url='pid='+value1; }
        if(value2){ if(url){ url=url+'&qid='+value2;
            }else{ url='qid='+value2; }
        }
        if(value3){ if(url){ url=url+'&lid='+value3;
            }else{  url='lid='+value3; }
        }

        var specificationValue='';
        $.each($(".specification_pointer"), function(i1,v1){
            var keyVals=$(v1).attr('data-title');
            var dataKey=$(v1).attr('data-key');
            //alert(dataKey);
            var createKey="";
            var createValue="";
            $.each($("input[name='"+keyVals+"']:checked"), function(i,v){
                var vals=$(v).attr('data-value');
                if(i==0){
                    createValue=v['value'];
                }else{
                    createValue=createValue+'@'+v['value'];
                }
            });
            //alert(createValue)
            if(createValue){
                createKey=dataKey+'_'+createValue;
            }
            if(createKey){
                // if(value3){
                //     specificationValue=specificationValue+'-'+createKey;
                // }else{
                //     specificationValue=createKey;
                // }
                specificationValue=specificationValue+'-'+createKey;
            }
        });
        
        //alert(specificationValue);
        if(specificationValue){
            if(url){ url=url+'&sid='+specificationValue;
            }else{  url='sid='+specificationValue; }
        }
        //alert(url)
        if(url){
            //window.location.href="<?=base_url('product-list/'.$uri1.'/'.$uri2.'/'.$uri3.'?');?>"+url
        }
    
}

function filterProduct2(o,t,n){
    var specificationValue='';
    $.each($(".specification_pointer"), function(i1,v1){
        var keyVals=$(v1).attr('data-title');
        var dataKey=$(v1).attr('data-key');
        //alert(dataKey);
        var createKey="";
        var createValue="";
        $.each($("input[name='"+keyVals+"']:checked"), function(i,v){
            var vals=$(v).attr('data-value');
            if(i==0){
                createValue=v['value'];
            }else{
                createValue=createValue+'@'+v['value'];
            }
        });
        if(createValue){
            createKey=dataKey+'_'+createValue;
        }
        if(createKey){
            if(value3){
                specificationValue=specificationValue+'&'+createKey;
            }else{
                specificationValue=createKey;
            }
        }
    });
    alert(value3)
    //console.log(createKey);
}
</script>
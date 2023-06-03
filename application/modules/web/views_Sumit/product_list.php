<?php $uri1=$this->uri->segment(2); $uri2=$this->uri->segment(3); $uri3=$this->uri->segment(4);?>
<?php
$value1Arr=array(); 
for($i=1;$i<=3;$i++){
    if($i==1){
        $getValue1=$this->input->get('pid', TRUE);
    }elseif($i==2){
        $getValue1=$this->input->get('qid', TRUE);
    }else{
        $getValue1=$this->input->get('lid', TRUE);
    }
    if($getValue1){
        $getValue1=explode('-',$getValue1);
        if($getValue1){
            foreach($getValue1 as $val){
                if($val){
                    $val=explode('@',$val);
                    if($val[1]){
                        array_push($value1Arr,$val[1]);
                    }
                }
            }
        }
    }
}

$specifyArr=array();
$getValue2=$this->input->get('sid', TRUE);
if($getValue2){
    $getValue2=explode('-',$getValue2);
    //print_r($getValue2);
    if($getValue2){
        foreach($getValue2 as $val){
            if($val){
                $val=explode('_',$val);
                //print_r($val);
                if($val[1]){
                    $valSelected=$val[1];
                    if($valSelected){
                        $valSelected=explode('@',$valSelected);
                        //print_r($valSelected);
                        if($valSelected){
                            foreach($valSelected as $val2){
                                if($val2){
                                    array_push($specifyArr,$val2);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
//print_r($specifyArr);
?>
<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Product Category</a></li>
                <li><a href="#">Product Sub-Category</a></li>
                <li><a href="#">Product List</a></li>
            </ul>
            <div class="row">
                <aside class="col-sm-3 col-md-3 content-aside" id="column-left">
                    <?php if(isset($filterData['categoryList']) and $filterData['categoryList']):?>
                        <div class="module category-style">
                            <h3 class="modtitle">Categories</h3>
                            <div class="modcontent">
                                <div class="box-category">
                                    <ul id="cat_accordion" class="list-group">
                                        <?php if(isset($filterData['categoryList']) and $filterData['categoryList']): foreach($filterData['categoryList'] as $catFilter): ?>
                                            <li class="hadchild"><a href="#" class="cutom-parent"><?=$catFilter['name'];?></a> <span class="button-view  fa fa-plus-square-o"></span>
                                                <ul style="display: block;">
                                                    <?php if(isset($catFilter['sub_category']) and $catFilter['sub_category']): foreach($catFilter['sub_category'] as $subCat): ?>
                                                        <li><a <?php if($subCat['sub_category_id']==$uri2){ echo 'style="color: #ef5039;"'; }?> href="<?php echo base_url('product-list/'.$subCat['category_id'].'/'.$subCat['sub_category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['name']))); ?>"><?=$subCat['name'];?></a></li>
                                                    <?php endforeach; endif; ?>
                                                </ul>
                                            </li>
                                        <?php endforeach; endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($filterData['attribute']) and $filterData['attribute']):
                        foreach($filterData['attribute'] as $key=>$attribute): ?>
                        <div class="module category-style">
                            <h3 class="modtitle"><?=$attribute['name'];?></h3>
                            <div class="modcontent">
                                <div class="table_layout filter-shopby">
                                    <div class="table_row">
                                        <ul class="checkboxes_list">
                                            <?php if(isset($attribute['attribute_value']) and $attribute['attribute_value']):
                                                foreach($attribute['attribute_value'] as $key_val=>$attribute_value):
                                                    $checker='';
                                                    if($value1Arr){
                                                        foreach($value1Arr as $ar){
                                                            if($ar==$attribute_value['attribute_value_id']){
                                                                $checker="checked"; break;
                                                            }
                                                        }
                                                    }
                                                 ?>
                                                <li>
                                                    <input type="checkbox" <?=$checker;?> class="attribute" onchange="filterProduct(this,'1');" data-value="<?=$attribute_value['value'];?>" name="<?=$attribute['created_value'];?>" value="<?=$attribute_value['attribute_value_id'];?>" id="attribute_<?=$attribute['attribute_id'];?>_<?=$attribute_value['value'];?>">
                                                    <label for="attribute_<?=$attribute['attribute_id'];?>_<?=$attribute_value['value'];?>"><?=$attribute_value['value'];?></label>
                                                </li>
                                            <?php endforeach; endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>

                    <?php if(isset($filterData['specification']) and $filterData['specification']):
                        foreach($filterData['specification'] as $key=>$attribute): ?>
                        <div class="module category-style">
                            <h3 class="modtitle specification_pointer" data-title="attribute_<?=$attribute['attribute_id'];?>" data-key="<?=$attribute['attribute_id'];?>"><?=$attribute['name'];?></h3>
                            <div class="modcontent">
                                <div class="table_layout filter-shopby">
                                    <div class="table_row">
                                        <ul class="checkboxes_list">
                                            <?php if(isset($attribute['attribute_value']) and $attribute['attribute_value']):
                                                foreach($attribute['attribute_value'] as $key_val=>$attribute_value): 
                                                    $checker='';
                                                    if($specifyArr){
                                                        foreach($specifyArr as $ar){
                                                            if($ar==$attribute_value['attribute_value_id']){
                                                                $checker="checked"; break;
                                                            }
                                                        }
                                                    }
                                                ?>
                                                <li>
                                                    <!-- <input type="checkbox" class="attribute" onchange="filterProduct(this,'2','attribute_<?=$attribute['attribute_id'];?>','<?=$attribute_value['attribute_value_id'];?>');" data-value="<?=$attribute_value['value'];?>" name="attribute_<?=$attribute['attribute_id'];?>"  value="<?=$attribute_value['attribute_value_id'];?>" id="attribute_<?=$attribute['attribute_id'];?>_<?=$attribute_value['value'];?>"> -->
                                                    <input type="checkbox" class="attribute" <?=$checker;?> onchange="filterProduct(this);" data-value="<?=$attribute_value['value'];?>" name="attribute_<?=$attribute['attribute_id'];?>"  value="<?=$attribute_value['attribute_value_id'];?>" id="attribute_<?=$attribute['attribute_id'];?>_<?=$attribute_value['value'];?>">
                                                    <label for="attribute_<?=$attribute['attribute_id'];?>_<?=$attribute_value['value'];?>"><?=$attribute_value['value'];?></label>
                                                </li>
                                            <?php endforeach; endif; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; endif; ?>

                    <?php if(isset($filterData['brand']) and $filterData['brand']):?>
                        <div class="module category-style">
                            <h3 class="modtitle">Brand</h3>
                            <div class="modcontent">
                                <div class="table_layout filter-shopby">
                                    <div class="table_row">
                                        <ul class="checkboxes_list">
                                            <?php foreach($filterData['brand'] as $brand): ?>
                                                <li>
                                                    <input type="checkbox" checked="" name="category" id="category_1">
                                                    <label for="category_1"><?=$brand['name'];?></label>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!--<div class="module category-style">-->
                    <!--    <h3 class="modtitle">Price</h3>-->
                    <!--    <div class="modcontent">-->
                    <!--        <div class="table_layout filter-shopby">-->
                    <!--            <div class="table_row">-->
                    <!--                <div class="table_cell">-->
                    <!--                    <fieldset>-->
                    <!--                        <div class="range">-->
                    <!--                            Range :-->
                    <!--                            <span class="min_val">10.00 LYD</span> --->
                    <!--                            <span class="max_val">1000.00 LYD</span>-->
                    <!--                            <input type="hidden" name="" class="min_value" value="10.00">-->
                    <!--                            <input type="hidden" name="" class="max_value" value="1000.00">-->
                    <!--                        </div>-->
                    <!--                        <div id="slider" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">-->
                    <!--                            <div class="ui-slider-range ui-widget-header ui-corner-all"></div>-->
                    <!--                            <span class="ui-slider-handle ui-state-default ui-corner-all"></span>-->
                    <!--                            <span class="ui-slider-handle ui-state-default ui-corner-all"></span>-->
                    <!--                        </div>-->
                    <!--                    </fieldset>-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    
                    
                    <div class="module category-style">
                        <div class="modcontent">
                            <footer class="bottom_box">
                                        <div class="buttons_row">
                                            <button type="button" onclick="filterProduct(this);" class="button_grey button_submit">Search</button>
                                            <button type="reset" onclick="resetFilter(this);" class="button_grey filter_reset">Reset</button>
                                        </div>
                                    <div class="back-to-top"><i class="fa fa-angle-up"></i></div>
                                </footer>
                        </div>
                    </div>
                </aside>
                <div id="content" class="col-md-9 col-sm-9">
                    <div class="products-category">
                        <h3 class="title-category "><?=str_replace('-',' ',$this->uri->segment(4));?></h3>
                        <?php if(isset($product_sub_category) and $product_sub_category): ?>
                        <div class="category-derc">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="banners">
                                        <div>
                                            <a href="#"><img src="<?=$product_sub_category?>" alt="1370 x 300"><br></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="products-list row nopadding-xs so-filter-gird grid">
                            <?php if($product): foreach($product as $fproduct): ?>
                            <div class="product-layout col-md-4 col-sm-6 col-xs-12">
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
            window.location.href="<?=base_url('product-list/'.$uri1.'/'.$uri2.'/'.$uri3.'?');?>"+url
        }else{
            window.location.href="<?=base_url('product-list/'.$uri1.'/'.$uri2.'/'.$uri3);?>"
        }
    
}

function resetFilter(o){
    window.location.href="<?=base_url('product-list/'.$uri1.'/'.$uri2.'/'.$uri3);?>"
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
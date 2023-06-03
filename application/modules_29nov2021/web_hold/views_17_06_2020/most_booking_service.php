<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Most Booking Service</a></li>
            </ul>
            <div class="row">
                <div id="content" class="col-md-12 col-sm-12">
                    <div class="products-category">
                        
                        <div class="products-list row nopadding-xs so-filter-gird grid">
                            <?php if(isset($service) and $service): foreach($service as $booking): ?>
                                <div class="product-layout col-md-3 col-sm-6 col-xs-12">
                                    <div class="product-item-container">
                                        <div class="left-block">
                                            <div class="product-image-container second_img">
                                                <a href="<?php echo base_url('service-detail/'.$booking['service_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['sub_category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['name']))); ?>" title="Deep Cleansing Facial">
                                                    <img src="<?=$booking['image'];?>" class="img-1 img-responsive" alt="320 X 320">
                                                    <img src="<?=$booking['image'];?>" class="img-2 img-responsive" alt="320 X 320">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <div class="caption">
                                                <h4><a href="<?php echo base_url('service-detail/'.$booking['service_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['sub_category_name'])).'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $booking['name']))); ?>" title="Deep Cleansing Facial"><?=$booking['name'];?></a></h4>
                                                <div class="price"> <span class="price-new"><?=$booking['discount_price'];?> LYD</span>
                                                    <?php if($booking['discount']>0): ?>
                                                        <span class="price-old"><?=$booking['price'];?> LYD</span>
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
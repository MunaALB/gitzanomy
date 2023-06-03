<!-- <?php echo '<pre/>'; print_r($subcategory); ?> -->
<div class="main-container">
    <div id="content">
        <div class="container">
            <ul class="breadcrumb">
                <li><a style="color:red;" href="<?=base_url();?>"><i class="fa fa-home"></i></a></li>
                <li><a style="color:red;" href="<?=base_url('en/product-category');?>">Product Category</a></li>
                <?php
                $query_id=$this->uri->segment(3);
                $getViewQuery=$this->db->query("select * from zy_product_category where category_id='".$query_id."'")->row_array();
                //print_r($getViewQuery);
                ?>
                <li>
                    <?php if(isset($getViewQuery['name']) and $getViewQuery['name']){ echo $getViewQuery['name']; }else{ echo "Product Category"; } ?></li>
                <!-- <li><a href="#"><?=str_replace('-',' ',$this->uri->segment(3));?></a></li> -->
            </ul>
        </div>
        <div class="main-container">
            <div id="content">
                <div class="container">
                    <div class="so-categories module custom-slidercates service-subcategory">
                        <h3 class="modtitle"><span>Product Subcategory</span></h3>
                        <div class="modcontent">
                            <div class="cat-wrap theme3 font-title">
                               <div class="row">
                                <?php if($subcategory): foreach($subcategory as $subCat): ?>
                                <div class="col-md-2 col-xs-6">
                                    <div class="content-box">
                                        <div class="image-cat">
                                            <a href="<?php echo base_url('en/product-list/'.$subCat['category_id'].'/'.$subCat['sub_category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['name']))); ?>" title=" <?=$subCat['name'];?>">
                                                <img src="<?=$subCat['image'];?>" title="210 X 210" alt="210 X 210" />
                                            </a>
                                        </div>
                                        <div class="cat-title"> 
                                          <a href="<?php echo base_url('en/product-list/'.$subCat['category_id'].'/'.$subCat['sub_category_id'].'/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $subCat['name']))); ?>" title=" <?=$subCat['name'];?>"> <?=$subCat['name'];?></a>
                                          <!-- <span><?=$subCat['product_count'];?> Products</span> -->

                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                 <div class="main-container container">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 messege-nodata">
                                                <i class="fa fa-shopping-bag"></i>
                                                <h2 class="about-title">No Data Found</h2>
                                                <p> <a href="<?=base_url('');?>">Go To Home</a> </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
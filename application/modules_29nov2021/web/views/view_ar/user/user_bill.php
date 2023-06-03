<div class="main-container container">
    <ul class="breadcrumb">
        <li>
            <a href="#"><i class="fa fa-home"></i></a>
        </li>
        <li><a href="#">Your Order Bill</a></li>
    </ul>

    <div class="row">
        <div id="content" class="col-sm-12">
            <h2 class="title">Your Order Bill</h2>

            <table class="table table-bordered table-hover orders-bills">
                <thead>
                    <tr>
                        <td colspan="2" class="text-left">Order Details</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 50%;" class="text-left">
                            <b>Order ID:</b> #<?=$orderDetail['order_id'];?>
                            <br />
                            <b>Date Added:</b> <?=date('d/m/Y',strtotime($orderDetail['created_at']));?>
                        </td>
                        <td style="width: 50%;" class="text-left">
                            <b>Payment Method:</b> <?php if($orderDetail['payment_type']==2){ echo "Online"; }else{ echo "Cash On Delivery"; }?>
                            <br />
                            <!-- <b>Shipping Method:</b> Flat Shipping Rate -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td style="width: 50%; vertical-align: top;" class="text-left">Payment Address</td>
                        <td style="width: 50%; vertical-align: top;" class="text-left">Shipping Address</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">
                            <?=$orderDetail['user_detail']['geo_address'];?> <br />
                            <?=$orderDetail['user_detail']['street_address'];?> <br />
                            <?=$orderDetail['user_detail']['house_no'];?> <br />
                            Libya <br />
                        </td>
                        <td class="text-left">
                            <?=$orderDetail['user_detail']['geo_address'];?> <br />
                            <?=$orderDetail['user_detail']['street_address'];?> <br />
                            <?=$orderDetail['user_detail']['house_no'];?> <br />
                            Libya <br />
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-left">Product Name</td>
                            <!-- <td class="text-left">Model</td> -->
                            <td class="text-right">Quantity</td>
                            <td class="text-right">Discount</td>
                            <td class="text-right">Price</td>
                            <td class="text-right">Total</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($orderDetail['order_item']) and $orderDetail['order_item']): 
                                foreach($orderDetail['order_item'] as $items): ?>
                            <tr>
                                <td class="text-left"><a href="<?php echo base_url('product-detail/'.(preg_replace('/[^a-zA-Z0-9_.]/', '-', $items['product_name'])).'/'.$items['product_id'].'/'.$items['item_id']); ?>" title="Chicken swinesha" target="_self"><?=$items['product_name'];?></a></td>
                                <!-- <td class="text-left">product 11</td> -->
                                <td class="text-right"><?=$items['quantity'];?></td>
                                <td class="text-right"><?=$items['discount'];?></td>
                                <td class="text-right"><?=$items['price'];?> LYD</td>
                                <td class="text-right"><?=$items['total'];?> LYD</td>
                            </tr>
                        <?php endforeach; endif; ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Sub-Total</b></td>
                            <td class="text-right"><?=$orderDetail['item_amount'];?> LYD</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Flat Shipping Rate</b></td>
                            <td class="text-right"><?=$orderDetail['delivery_charges'];?> LYD</td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Eco Tax (-2.00)</b></td>
                            <td class="text-right">6.00 LYD</td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>VAT (20%)</b></td>
                            <td class="text-right">21.20 LYD</td>
                        </tr> -->
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-right"><b>Total</b></td>
                            <td class="text-right"><?=$orderDetail['total'];?> LYD</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- <div class="buttons clearfix">
                <div class="pull-right"><a class="btn btn-primary dpwnloadbills" href="#">Download Bill</a></div>
            </div> -->
        </div>
    </div>
</div>

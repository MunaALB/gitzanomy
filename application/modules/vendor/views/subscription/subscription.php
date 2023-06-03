
<style>
    .btn-primary {
        background-color: #F74F00;
        border-color: transparent;
    }

    .selected, .selectedFree, .disabledplan {
        background-color: #F74F00 !important;
    }

    
    .subscription-plas .plan-designs .card-body h4 {
        font-size: 14px;
    }

    .subscription-plas .plan-designs .card-body h5 {
        font-size: 12px;
        font-weight: 600;
    }

    .subscription-plas .plan-designs .card-body h5 del{
        color: #B9B9B9;
        font-size: 12px;
    }

    .subscription-plas .plan-designs .card-body a {
        padding: 2px 10px;
        border-radius: 4px;
        font-size: 12px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Subscription Plan</h1>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">No of selected Plans <span id="count">0</span> <span class="paynow-part"><a style="cursor:pointer;" class="text-primary" onclick="payNow(this);">Pay Now</a></span></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php
                    $count = 1;
                    foreach ($category_list as $category): if ($category['plan_list']):
                            ?>
                            <div class="col-lg-6">
                                <div class="subscription-plas">
                                    <div class="headingparts">
                                        <h2><?= $category['name'] ?> </h2>
                                        <div class="mytoggle">
                                            <?php
                                            if ($category['selected'] == 1):
                                                $from = date_create(date('Y-m-d'));
                                                $to = date_create($category['expire_date']);
                                                $diff = date_diff($to, $from);
                                                $time_left = $diff->format('%a days')
                                                ?>
                                                <p class="text-danger"><?= $time_left > 0 ? $time_left . ' left' : 'Expired!' ?></p>
                                            <?php else: if ($category['selected'] == 2): ?>
                                                    <p class="text-danger">Expired!</p>
                                                <?php else: ?>
                                                    <!--                                                    <label class="switch">
                                                                                                            <input type="checkbox" <?= $category['selected'] ? 'checked' : '' ?>>
                                                                                                            <span class="slider round"></span>
                                                                                                        </label>-->
                                                <?php
                                                endif;
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                    <div class="planparts" id="planDiv<?= $count ?>">
                                        <div class="row">
                                            <?php
                                            foreach ($category['plan_list'] as $plan): $plan['original_price'] = $plan['price'];
                                                if ($plan['price'] && $plan['discount']) :$plan['price'] = $plan['price'] - ($plan['price'] / $plan['discount']);
                                                endif;
                                                ?>
                                                <div class="col-lg-4">
                                                    <div class="card text-center plan-designs">
                                                        <div class="card-body">
                                                            <h4 class="card-title"><?= $plan['name'] ?></h4>
                                                            <h5><?= $plan['price'] ? $plan['price'] . ' LYD' : 'FREE' ?></h5>
                                                            <h5 style="height:13px;"><del><?= $plan['discount'] ? $plan['original_price'] . ' LYD' : '' ?></del></h5>
                                                            <p class="card-text"><?= $plan['duration'] ?> Days</p>
                                                            <?php
                                                            if ($plan['price']) {
                                                                if ($category['selected'] == 1) {
                                                                    if ($plan['selected']) {
                                                                        ?>
                                                                        <a style="cursor:not-allowed" title="Already Subscribed" class="btn btn-primary text-white disabledplan">Subscribed</a> 
                                                                    <?php } else { ?>
                                                                        <a style="cursor:not-allowed" class="btn btn-primary text-white disabledplan">Not Available</a> 
                                                                        <?php
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <a style="cursor:pointer" onclick="selectPlan(this,<?= $count ?>);" class="btn btn-primary text-white" data-type="1" data-plan-id="<?= $plan['plan_id'] ?>" data-category-id="<?= $plan['service_category_id'] ?>">Select Plan</a> 
                                                                    <?php
                                                                }
                                                            } else {
                                                                if (($category['selected'] == 1) && $plan['selected'] == 1) {
                                                                    ?> 
                                                                    <a style="cursor:not-allowed" title="Already Subscribed" class="btn btn-primary text-white disabledplan">Subscribed</a> 
                                                                <?php } else if ($plan['selected'] == 2) { ?>   
                                                                    <a style="cursor:not-allowed" class="btn btn-primary text-white selectedFree">Not Applicable</a> 
                <?php } else if ($category['selected'] == 1) { ?>
                                                                    <a style="cursor:not-allowed" class="btn btn-primary text-white disabledplan">Not Available</a> 

                                                                <?php } else { ?>
                                                                    <a style="cursor:pointer" onclick="selectPlan(this,<?= $count ?>);" class="btn btn-primary text-white" data-type="1" data-plan-id="<?= $plan['plan_id'] ?>" data-category-id="<?= $plan['service_category_id'] ?>">Select Plan</a> 
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
        <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $count++;
                        endif;
                    endforeach;
                    ?>
                </div>
            </div>
        </div> 
    <div class="modal fade modal-design" id="purchaseplan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="messege-box">
                        <img src="<?php echo site_url(); ?>assets/vendor/images/uploadproduct.png" alt="success messege">
                        <h3>Are you sure you to continue ?</h3>
                    </div>
                    <div class="action-button">
                        <button type="submit" class="btn btn-primary mybtns">Yes</button>
                        <button type="submit" class="btn btn-primary mybtns" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function selectPlan(obj, count) {
        var type = $(obj).attr('data-type');
        if (type == 1) {
            $('#planDiv' + count + ' .selected').css('background-color', '#f74f00');
            $('#planDiv' + count + ' .selected').html('Select Plan');
            $('#planDiv' + count + ' .selected').attr('data-type', 1);
            $('#planDiv' + count + ' .selected').removeClass('selected');
            $(obj).addClass('selected');
//            $(obj).css('background-color', '#ca0c0c');
            $(obj).html('selected');
            $(obj).attr('data-type', 2);
        } else {
            $(obj).removeClass('selected');
//            $(obj).css('background-color', '#f74f00');
            $(obj).html('Select Plan');
            $(obj).attr('data-type', 1);
        }
        var count = $(".card-body").find(".selected").length;
        $("#count").html(count);
    }

    function payNow(obj) {
        var count = $(".card-body").find(".selected").length;
        if (count) {
            var cnfm = confirm('Are you sure to proceed with the payment?');

//        $('#purchaseplan').modal();
            if (cnfm) {
                var element = $(".card-body").find(".selected");
                var planlist = [];
                $.each(element, function () {
                    var em = this;
                    var plan = {plan_id: $(em).attr('data-plan-id'), category_id: $(em).attr('data-category-id')};
                    planlist.push(plan);
                });
//        console.log(planlist);
                if (planlist) {
                    $.ajax({
                        url: "<?= base_url(); ?>vendor/Ajax/purchasePlan",
                        type: 'post',
                        data: {plan_list: planlist},
                        success: function (data) {
                            var dt = $.trim(data);
                            var jsonData = $.parseJSON(dt);
                            if (jsonData['error_code'] == "200") {
                                location.reload();
                            } else {
                                alert(jsonData['message']);
                            }
                        }
                    });
                }
            }
        }
    }
</script>

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
        <li><a href="#"><i class="fa fa-home"></i></a></li>
        <li><a href="#">Account</a></li>
        <li><a href="#">User Dashboard</a></li>
        <li><a href="#">My Notebook</a></li>
    </ul>
    <div class="mycart-part">
        <div id="notebook-paper">
          <header>
            <h1>My Notebook </h1>
          </header>
          <div id="content">
            <div class="hipsum notebooktable">
                  <table class="table">
                    <tbody>
                        <?php if(isset($list) and $list): foreach($list as $note): ?>
                            <tr>
                                <td><i class="fa fa-calendar"></i> <?=date('d-m-Y',strtotime($note['created_at']));?></td>
                                <td><?=$note['note'];?></td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td>-- -- ----</td>
                                <td>No notes available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                  </table>
            </div>
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

function submitReview(o,i,b){
    var reviewText=$("#reviewText").val();
    var rate=$('input[name="rate"]:checked').val();
    
        if(reviewText && i && b){
            $.ajax({
                url: "<?php echo base_url("/web/Web/ajax") ?>",
                type: "POST",
                data: "method=addServiceReview&review="+reviewText+'&rating='+rate+'&service_id='+i+'&booking_id='+b,
                success: function (data) {
                    var dta = $.trim(data);
                    var jsonData = $.parseJSON(dta);
                    if (jsonData['error_code'] == 200) {
                        swal({title:"Success.",text: jsonData['message'],type: "success"},function(){ 
                        location.reload();
                    })
                    } else {
                        swal({title:"Warning.",text: jsonData['message'],type: "warning"})
                    }
                },
                error: function (error) {
                    alert("error");
                }
            });
        }else{
            showErrorMessage('reviewTextError','*Required Field');
        }
    
}
function loginRequired(o,t){
    if(t==1){
        showErrorMessage('genericError','*Need to login first.');
    }else if(t==2){
        showErrorMessage('genericError','Out Of Stock');
    }else if(t==3){
        showErrorMessage('genericReviewError','*Need to login first.');
    }
}

function clickToPay(o,i,b){

    $.ajax({
        url: "<?php echo base_url("/web/Web/ajaxserver") ?>",
        type: "POST",
        data: "method=payTabsBoking&service_id="+i+'&booking_id='+b,
        success: function (data) {
            var dta = $.trim(data);
            var jsonData = $.parseJSON(dta);
            //console.log(jsonData);
            //console.log(jsonData['data']['payment_url']);
            if (jsonData['error_code'] == 100) {
                //alert("sssss")
                window.location.href=jsonData['data']['payment_url'];
            } else {
                //alert("ffff")
                window.location.href="<?=base_url()?>order-fail";
            }
        }
    })
}


</script>
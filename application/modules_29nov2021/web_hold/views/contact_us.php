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
        <li><a href="#">Pages</a></li>
        <li><a href="#">Contact Us</a></li>
    </ul>
    <div class="mycart-part">
        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="about-us about-demo-3">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 info-contact">
                            <h2 class="about-title">Contact Us</h2>
                            <address>
                                <div class="address clearfix form-group">
                                    <div class="icon">
                                        <i class="fa fa-home"></i>
                                    </div>
                                    <div class="text">Zanomy Store: مكتب زانومي
مقابل جزيرة ابوهريدة (جامع القدس)
طرابلس، ليبيا</div>
                                </div>
                                <div class="phone form-group">
                                    <div class="icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="text">Phone : 0917004499</div>
                                </div>
                                <div class="phone form-group">
                                    <div class="icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="text">Email : support@zanomy.com</div>
                                </div>
                            </address>
                            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7325327.3039080715!2d12.83738325995865!3d26.29993554271821!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13a892d98ece010d%3A0xfa076041c7f9c22a!2sLibya!5e0!3m2!1sen!2sin!4v1582543855647!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen=""></iframe> -->
                                <iframe width="100%" height="450" zoom="3" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=26.7739442,15.3893327&zoom=5&amp;key=AIzaSyCzPCjYZGjfQyRKanR7NMOyxmRAJIS0A-Y"></iframe>
                                    <!-- <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?ll=24.9550678,2.2112319&saddr=24.9550678,2.2112319&daddr=24.9550678,2.2112319+to:24.9550678,2.2112319+to:@&z=13&output=embed"></iframe> -->
                         </div>
                        <div class="col-lg-6 col-md-6 info-contact">
                            <h2 class="about-title">Contact Form</h2>
                            <form action="" method="post">

<fieldset>


    <div class="form-group required">

        <label class="control-label">E-Mail Address</label>

        <input type="text" name="email" value="" id="email" class="form-control regInputs">
        <p class="errorPrint" id="emailError"></p>
    </div>

    <div class="form-group required">

        <label for="input-payment-address-1" class="control-label">Subject</label>

        <select class="form-control regInputs" id="subject">

            <option value="">Select Option</option>
            <?php if($subject): foreach($subject as $list): ?>
                <option value="<?=$list['reason_id']?>"><?=$list['title'];?></option>
            <?php endforeach; endif; ?>
        </select>
        <p class="errorPrint" id="subjectError"></p>
    </div>
    <div class="form-group required">

        <label class="control-label">Description</label>

        <textarea name="enquiry" rows="10" id="enquiry" class="form-control regInputs"></textarea>
        <p class="errorPrint" id="enquiryError"></p>
    </div>

</fieldset>

<div class="buttons">

    <div class="pull-right">

        <button class="btn btn-default buttonGray" type="button" onclick="support(this);">

            <span>Submit</span>

        </button>

    </div>

</div>

</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

function support(obj){
    $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                var textData=$(this).parent().find('label').text();
                //alert($(this).attr('data-title'))
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + textData + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
        if (idValidate) {
            return false;
        } else {
            var reg_form_data = new FormData();
            reg_form_data.append("email",$.trim($("#email").val()));
            reg_form_data.append("subject_id",$.trim($("#subject").val()));
            reg_form_data.append("message",$.trim($("#enquiry").val()));
            reg_form_data.append("is_web","1");
            $.ajax({
                url: baseUrl+'help_n_support',
                type: "POST",
                data: reg_form_data,
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    returnObject = JSON.parse((data));
                    if (returnObject.error_code == 200) {
                        swal({title:"Success.",text: returnObject['message'],type: "success"},function(){ 
                            location.reload();
                        })
                     }else{
                        swal({title:"Warning.",text: returnObject['message'],type: "warning"},function(){ 
                            location.reload();
                        })
                    }
                },
                error: function (error) {
                     alert("error");
                }
            });

        }
        
    }
</script>

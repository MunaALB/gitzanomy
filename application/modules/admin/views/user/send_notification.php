<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
    .fa_btn {
        background: #f74f00;
        color: #ffffff !important;
        padding: 4px 6px !important;
        margin-top: 0px;
        border-radius: 30px;
        margin-left: 0px;
    }
    .margin-20{
        margin-top: 20px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Send Notification</h1>
    </div>
    <div class="content">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="card">
                                    <form method="POST" id="regForm" enctype="multipart/form-data">
                                        <div class="card-body"> 
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <label for="validationCustom01">Title</label>
                                                    <input type="text" name="title" id="title"  class="form-control">
                                                    <p class="errorPrint" id="titleError"></p> <br/><br/>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="validationCustom01">Message</label>
                                                    <textarea name="note" id="note" rows="10" class="form-control"></textarea>
                                                    <p class="errorPrint" id="noteError"></p>
                                                    <button type="button" id="add_product_set" class="composemail mt-4 pull-right" onclick="addNote(this)">Submit</button>  
                                                </div>
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
    </div>
    <script>
        function addNote(o, status) {
            $(".errorPrint").css('display', 'none');

            var note = $.trim($("#note").val());
            var title = $.trim($("#title").val());
            if (note && title) {
                $.ajax({
                    url: "<?php echo base_url("/admin/Order/ajax_method") ?>",
                    type: 'post',
                    data: 'method=sendNotificationToAll&note=' + note + '&title=' + title + '&type=1',
                    success: function (data) {
                        var dt = $.trim(data);
                        //alert(dt);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            alert(jsonData['message']);
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                // console.log('sssss')
                if (title) {

                } else {
                    $("#titleError").empty();
                    $("#titleError").append('*Title is required field.');
                    $("#titleError").css('display', 'block');
                }
                if (note) {

                } else {
                    $("#noteError").empty();
                    $("#noteError").append('*Note is required field.');
                    $("#noteError").css('display', 'block');
                }

            }
        }
    </script>
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
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Product Category Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url('admin');?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i>Product Category Management</li>
        </ol>
    </div>
    <?=$this->session->flashdata('response');?>
    <div class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                <form method="post" enctype="multipart/form-data">
                                    
                                    <div class="form-group col-md-12">
                                        <label class="control-label">Select Excel File</label>
                                        <input type="file" name="products" accept=".xls, .xlsx" required class="form-control">
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-12">
                                            <div class="text-sm-left">
                                                <button class="btn btn-primary" type="submit" name="bulk_upload">Upload</button>
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                </div>
            </div>
            

            
        </div>
    </div>
<script type="text/javascript">
    function showErrorMessage(id,msg){
        $("#"+id).empty();
        $("#"+id).append(msg);
        $("#"+id).css('display','block');
    }

    function checkStatus_user(obj, id) {
        var txt ;
        var checked = $(obj).is(':checked');
        if (checked == true) {
            var status = 1;
        } else {
            var status = 0;
        }

        if (id) {
            $.ajax({
                url: "<?= base_url(); ?>admin/Admin/ajax",
                type: 'post',
                data: 'method=checkStatus&id=' + id + '&action=' + status,
                success: function (data) {
                    var dt = $.trim(data);
                    //alert(dt);
                    var jsonData = $.parseJSON(dt);
                    if (jsonData['error_code'] == "100") {
                        location.reload();
                    } else {
                        alert(jsonData['message']);
                    }
                }
            });
        } else {
            alert("Something Wrong");
            location.reload();
        }
    }

    function deleleCategory(obj, id) {
        var r = confirm("Are you sure to delete!");
        if (r == true) {
            if (id) {
                status='99';
                $.ajax({
                    url: "<?= base_url(); ?>admin/Admin/ajax",
                    type: 'post',
                    data: 'method=checkStatus&id=' + id + '&action=' + status,
                    success: function (data) {
                        var dt = $.trim(data);
                        //alert(dt);
                        var jsonData = $.parseJSON(dt);
                        if (jsonData['error_code'] == "100") {
                            location.reload();
                        } else {
                            alert(jsonData['message']);
                        }
                    }
                });
            } else {
                alert("Something Wrong");
                location.reload();
            }
        }
    }
</script>
<script type="text/javascript">
    function saveData(o){
        $(".errorPrint").css('display', 'none');
        var idValidate = false;
        $(".regInputs").each(function (index, value) {
            // console.log('div' + index + ':' + $(this).attr('id'));
            if ($(this).val()) {
                $("#" + $(this).attr('id') + 'Error').css('display', 'none');
            } else {
                idValidate = true;
                $("#" + $(this).attr('id') + 'Error').empty();
                $("#" + $(this).attr('id') + 'Error').append('*' + $(this).attr('data-title') + ' is required field');
                $("#" + $(this).attr('id') + 'Error').css('display', 'block');
                //$("html, body").animate({ scrollTop: 0 }, "slow");
            }
        });
        if (idValidate) {
            return false;
        } else {
            $("#regForm").submit();
        }
    }
    
    function validImage(obj,i) {
        var _URL = window.URL || window.webkitURL;
        var file = $(':input[type="file"]').prop('files')[0];
        var img = new Image();
        img.onload = function () {
            var wid = this.width;
            var ht = this.height;
            //alert(wid+'&'+ht);
            //if ((wid < 450 || wid > 500) || ht !== 500) {
            if ((wid!==250) || ht !== 250) {
                $(".errorPrint").css('display', 'none');
                $('#add_product_set').attr('disabled',true);
                showErrorMessage(i+'Error','Preferred Image Dimension 250X250 pixels');
            } else {
                $('#add_product_set').attr('disabled',false);
                $('#'+i+'Error').html('');
            }
        };
        img.src = _URL.createObjectURL(file);
    }

</script>  
<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
        display: none;
    }
</style>
<style>
    .card-body img,video{
        width:100%;
    }

    .note-editable{
        height:auto !important;
    }
</style>
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Edit <?= $page_name ?></h1>
    </div>
    <div class="content eventdeatil">
        <form id="editForm" method="post">
            <div class="card">

                <div class="card-header">
                    <h5 class="text-white m-b-0">English</h5>
                </div>
                <div class="card-body">    
                    <div class="row">
                        <div class="col-md-12">
                            <textarea rows="10" id="text" data-title="<?= $page_name ?> (En)" class="regInputs form-control" name="text"><?= $content['text'] ?></textarea>
                            <p class="errorPrint" id="textError"></p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <h5 class="text-white m-b-0">Arabic</h5>
                </div>
                <div class="card-body">    
                    <div class="row">
                        <div class="col-md-12">
                            <textarea rows="10" id="text_ar" data-title="<?= $page_name ?> (Ar)" class="regInputs form-control" name="text_ar"><?= $content['text_ar'] ?></textarea>
                            <p class="errorPrint" id="text_arError"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="composemail save-length pull-right" onclick="updateContent(this);" name="update" type="button">Update</button>
                    <button class="composemail save-length pull-right" id="add_product" style="display:none;" name="submit" type="submit">Update</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        function updateContent(o) {
//            alert('hi');
            $(".errorPrint").css('display', 'none');
            var idValidate = false;
            $(".regInputs").each(function (index, value) {
//                 console.log('div' + index + ':' + $(this).attr('id'));
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
                $("#add_product").click();
            }
        }
    </script>
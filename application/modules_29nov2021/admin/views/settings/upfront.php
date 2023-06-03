<style>
    .errorPrint{
        font-size: 12px;
        color: #af2000 !important;
        padding: 5px 5px;
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
        <h1>Upfront Management</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Upfront Management</li>
        </ol>
    </div>

    <div class="content">
        <?= $this->session->flashdata('response'); ?>
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <form method="POST" id="regForm" enctype="multipart/form-data">
                        <div class="card-body"> 
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Upfront Amount (%)</label>
                                    <input type="text" id="upfront" value="<?= $setting['upfront'] ?>" onchange="checkNumbersOnly(this);" class="form-control mb-4 " name="upfront" placeholder="Upfront Amount" data-title="Upfront Amount">
                                    <p class="errorPrint" id="percentageError"></p>
                                    <?= form_error('upfront') ?>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" name="submit" id="add_product_set" class="composemail mt-4 pull-right">Submit</button>  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

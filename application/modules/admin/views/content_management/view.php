
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1><?= $page_name ?></h1>
        <div class="row">
            <div class="col-md-8">
                <p style="line-height: 4;">Last updated on: <?= date('d M Y h:i A', $content['updated_at']) ?></p>
            </div>
            <div class="col-md-4">
                <a class="composemail save-length pull-right" 
                <?php
                if ($content['id'] == 1) {
                    echo ' href="' . base_url() . 'admin/edit-about-us"';
                } else if ($content['id'] == 2) {
                    echo ' href="' . base_url() . 'admin/edit-term-conditions"';
                } else {
                    echo ' href="' . base_url() . 'admin/edit-privacy-policy"';
                }
                ?>
                   >
                    <i class="fa fa-edit"></i>Edit</a>
            </div>
        </div>

    </div>
    <div class="content eventdeatil">
        <div class="card">
            <?= $this->session->flashdata('response'); ?>
            <div class="card-header">
                <h5 class="text-white m-b-0">English</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <?= $content['text'] ?>
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
                        <?= $content['text_ar'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--</div>-->

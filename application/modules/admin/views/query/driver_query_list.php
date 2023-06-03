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
        <h1> Driver Query List</h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('admin'); ?>">Home</a></li>
            <li><i class="fa fa-angle-right"></i> Driver Query List</li>
        </ol>
    </div>

    <div class="content">
        <?= $this->session->flashdata('response'); ?>
        <div class="row">
                 <div class="col-md-12">
                <div class="card"> 
                    <div class="card-body">
                        <div class="table-responsive table-image">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr.no</th>
                                        <th>Email </th>
                                        <th>Subject</th> 
                                        <th>Message </th> 
                                        <th>Date </th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ($query_list as $listing) {
                                        ?>
                                        <tr>
                                            <td><?= $count ?></td>
                                            <td><?=$listing['email']?></td>
                                            <td><?=$listing['subject']?></td>
                                            <td><?=$listing['message']?></td>
                                            <td><?=date('d-m-Y H:i:s',$listing['created_at'])?></td>
                                        </tr> 
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
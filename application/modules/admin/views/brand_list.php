 <div class="content-wrapper">
     <div class="content-header sty-one">
         <?php if (!isset($edit)) { ?>
             <h1>Add Brand</h1>
         <?php } else { ?>
             <h1>Edit Brand</h1>
         <?php } ?>
         <ol class="breadcrumb">
             <li><a href="<?= base_url('admin'); ?>">Home</a></li>
             <li><i class="fa fa-angle-right"></i><?php if (!isset($edit)) { ?>
                     Add Brand
                 <?php } else { ?>
                     Edit Brand
                 <?php } ?>
             </li>
         </ol>
     </div>
     <?= $this->session->flashdata('response'); ?>
     <div class="content">

         <div class="row">
             <?php if (!isset($edit)) { ?>
                 <div class="col-md-5">
                     <div class="card">
                         <form method="POST" id="regForm" enctype="multipart/form-data">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <label>Brand Name(In English)</label>
                                         <input type="text" class="form-control mb-4 stepError1" id="english" name="english" placeholder="Brand Name" onkeyup="brand_avail()" data-warning="errorWarning1" autocomplete="off">
                                         <?= form_error('english') ?>
                                         <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning1"><span id="errorMsg1"></span></div>
                                     </div>
                                     <div class="col-md-12">
                                         <label>Brand Name(In Arabic)</label>
                                         <input type="text" class="form-control mb-4 stepError1" name="arabic" placeholder="Brand Name" data-warning="errorWarning2">
                                         <?= form_error('arabic') ?>
                                         <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning2"><span id="errorMsg2"></span></div>
                                     </div>
                                     <div class="col-md-12">
                                         <label for="validationCustom01">Brand Image</label>
                                         <input type="file" id="input-file-now-custom-1" onchange="validImage(this,'input-file-now-custom-1' , 'disable');" name="image" class="dropify stepError1" data-warning="errorWarning3" accept="image/*" />
                                         <?= form_error('image') ?>
                                         <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning3"><span id="errorMsg3"></span></div>
                                         <button type="button" id="disable" class="composemail mt-4 pull-right" data-count="1" onclick="nextPrev(this, 1)">Submit</button>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             <?php } else { ?>
                 <div class="col-md-5">
                     <div class="card">
                         <form method="POST" id="regForm" enctype="multipart/form-data">
                             <div class="card-body">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <label>Brand Name(In English)</label>
                                         <input type="text" class="form-control mb-4 stepError1" name="english" value="<?= $edit['name'] ?>" placeholder="Brand Name" data-warning="errorWarning1">
                                         <?= form_error('english') ?>
                                         <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning1"><span id="errorMsg1"></span></div>
                                     </div>
                                     <div class="col-md-12">
                                         <label>Brand Name(In Arabic)</label>
                                         <input type="text" class="form-control mb-4 stepError1" name="arabic" value="<?= $edit['name_ar'] ?>" placeholder="Brand Name" data-warning="errorWarning2">
                                         <?= form_error('arabic') ?>
                                         <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning2"><span id="errorMsg2"></span></div>
                                     </div>
                                     <div class="col-md-12">
                                         <label for="validationCustom01">Brand Image</label>
                                         <input type="file" id="input-file-now-custom-1" onchange="validImage(this,'input-file-now-custom-1' , 'updateBtn');" value="<?php echo $edit['image']; ?>" name="image_update" data-default-file="<?php echo $edit['image']; ?>" class="dropify" accept="image/*" />
                                         <div class="text-danger" style="display:none;cursor: pointer;text-align: right;" id="errorWarning3"><span id="errorMsg3"></span></div>
                                         <button type="button" class="composemail mt-4 pull-right" data-count="1" id="updateBtn" onclick="nextt(this, 1)">Update</button>
                                     </div>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
             <?php } ?>


             <div class="col-md-7">
                 <div class="card">
                     <div class="card-body">
                         <div class="table-responsive table-image">
                             <table id="example1" class="table table-bordered table-striped">
                                 <thead>
                                     <tr>
                                         <th>Image</th>
                                         <th>Brand Name(In English)</th>
                                         <th>Brand Name(In Arabic)</th>
                                         <th>Status</th>
                                         <th>Action</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php foreach ($brand_list as $listing) { ?>
                                         <tr>
                                             <td><img src="<?= $listing['image']; ?>"></td>
                                             <td><?= $listing['name'] ?></td>
                                             <td><?= $listing['name_ar'] ?></td>
                                             <td>
                                                 <div class="mytoggle">
                                                     <label class="switch">
                                                         <input type="checkbox" <?php
                                                                                if ($listing['status'] == '1') : echo "checked";
                                                                                endif; ?> onchange="checkStatus_user(this,'<?= $listing['brand_id']; ?>');">
                                                         <span class="slider round"></span>
                                                     </label>
                                                 </div>
                                             </td>
                                             <td><a class="composemail" href="<?php echo site_url('admin/brand-list/' . $listing['brand_id']); ?>">Edit</a></td>
                                         </tr>
                                     <?php } ?>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <script type="text/javascript">
         errorMsg

         function brand_avail() {
             var english = $('#english').val();
             var table = 'brand';
             if (english != '') {
                 $.ajax({
                     url: "<?php echo base_url('admin/Admin/check'); ?>",
                     type: "POST",
                     data: 'english=' + english + '&table=' + table,
                     success: function(data) {
                         if (data) {
                             $('#errorMsg1').html(data);
                             $("#errorWarning1").css('display', 'block');
                         } else {
                             $("#errorWarning1").css('display', 'none');
                         }
                     }
                 });
             }
         }

         function checkStatus_user(obj, id) {
             var txt;
             var checked = $(obj).is(':checked');
             if (checked == true) {
                 var status = 1;
             } else {
                 var status = 0;
             }
             if (confirm("Are You sure want to change the status!")) {
                 if (id) {
                     $.ajax({
                         url: "<?= base_url(); ?>admin/Admin/ajax",
                         type: 'post',
                         data: 'method=ChangeBrandStatus&id=' + id + '&action=' + status,
                         success: function(data) {
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
                 }
             } else {
                 location.reload();
             }
         }
     </script>
     <script type="text/javascript">
         function nextPrev(obj, type) {
             var nullException = true;

             var dataCount = $(obj).attr('data-count');

             $(".stepError" + dataCount).each(function() {

                 if ($(this).val() == '' || $(this).val() == null || $(this).val() == 'null' || $(this).val() == 0) {
                     var warnMsg = $(this).attr('data-warning');
                     $("#" + warnMsg).empty();
                     $("#" + warnMsg).append('*required field');
                     $("#" + warnMsg).css('display', 'block');
                     nullException = false;
                 } else {
                     var warnMsg = $(this).attr('data-warning');
                     $("#" + warnMsg).css('display', 'none');
                     //document.getElementById('Property').type = "submit";

                 }
             });

             if (dataCount == 1) {
                 var user_image = "";
                 //console.log('ssss',user_image)
                 if (document.getElementById("input-file-now-custom-1").files.length == 0) {
                     if (user_image == '') {
                         nullException = false;
                         $("#errorWarning2").empty();
                         $("#errorWarning2").append('*required field');
                         $("#errorWarning2").css('display', 'block');
                     } else {
                         //console.log('successsssssssss')
                         $("#errorWarning2").empty();
                     }
                 } else {
                     //console.log('successs')
                     $("#errorWarning2").empty();
                 }
             }
             if (nullException == true) {
                 sendForm();
             }
             //console.log(dataCount);
         }

         function nextt(obj, type) {
             var nullException = true;

             var dataCount = $(obj).attr('data-count');

             $(".stepError" + dataCount).each(function() {

                 if ($(this).val() == '' || $(this).val() == null || $(this).val() == 'null' || $(this).val() == 0) {
                     var warnMsg = $(this).attr('data-warning');
                     $("#" + warnMsg).empty();
                     $("#" + warnMsg).append('*required field');
                     $("#" + warnMsg).css('display', 'block');
                     nullException = false;
                 } else {
                     var warnMsg = $(this).attr('data-warning');
                     $("#" + warnMsg).css('display', 'none');
                     //document.getElementById('Property').type = "submit";

                 }
             });
             if (nullException == true) {
                 sendForm();
             }
         }


         function validImage(obj, i , btnName) {
             var _URL = window.URL || window.webkitURL;
             var file = $(':input[type="file"]').prop('files')[0];
             var img = new Image();


             var imgSize = file.size;
             var imgsizeKb = imgSize / 1024;
             if (imgsizeKb <= 300) {
                 img.onload = function() {
                    
                    $("#errorWarning3").css('display', 'none');
                    $('#'+btnName).attr('disabled', false);
                    $('#errorMsg3').html('');
                 };
             } else {
                 $("#errorWarning3").css('display', 'block');
                 $('#'+btnName).attr('disabled', true);
                 showErrorMessage("errorMsg3", 'Max Image size should be 300 kb');
             }


             img.src = _URL.createObjectURL(file);
         }



         function sendForm() {
             $("#regForm").submit();
         }


         function showErrorMessage(id, msg) {
             $("#" + id).empty();
             $("#" + id).append(msg);
             $("#" + id).css('display', 'block');
         }
     </script>
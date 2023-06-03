<div class="module category-style userside-menu">
    <div class="user-profileimage">
        <div class="avatar-upload">
            <div class="avatar-edit">
            
                <form class="avata_form" action="upload-image" method="post" enctype="multipart/form-data">
                    <input type='file' name="image" onchange="uploadImage(event, 'forimage');" id="imageUpload" accept=".png, .jpg, .jpeg" />
                    <label for="imageUpload"></label>
                    <input type="hidden" name="url" value="<?=$this->uri->segment(2);?>" />
                    <button type="submit" id="imgBtn" hidden name="imgBtn">حفظ التغييرات</button>
                </form> 
            </div>
            <div class="avatar-preview">
                <?php if($user_data['image']): ?>
                    <div id="imagePreview" style="background-image: url('<?=$user_data['image']; ?>');"></div>
                <?php else: ?>
                    <div id="imagePreview" style="background-image: url('<?php echo base_url(); ?>assets/web/images/user/userdummy.png');"></div>
                <?php endif; ?>
            </div>
        </div>
        <h3><?=$user_data['name'];?></h3>
    </div>
    <div class="modcontent">
        <div class="box-category">
            <ul id="cat_accordion" class="list-group">
            <?php $uriSegment=$this->uri->segment(2);?>
                <li class="<?php if($uriSegment=='my-account'){ echo "active"; }?>"><a href="<?php echo base_url('ar/my-account'); ?>" class="cutom-parent">لوحة المستخدم</a> </li>
                <li class="<?php if($uriSegment=='edit-profile'){ echo "active"; }?>"><a href="<?php echo base_url('ar/edit-profile'); ?>" class="cutom-parent">تعديل الملف الشخصي</a> </li>
                <li class="<?php if($uriSegment=='my-favourite-product'){ echo "active"; }?>"><a href="<?php echo base_url('ar/my-favourite-product'); ?>" class="cutom-parent">منتجاتي المفضلة</a> </li>
                <li class="<?php if($uriSegment=='order-history'){ echo "active"; }?>"><a href="<?php echo base_url('ar/order-history'); ?>" class="cutom-parent">سجل طلبياتي</a> </li>
                <li class="<?php if($uriSegment=='my-request'){ echo "active"; }?>"><a href="<?php echo base_url('ar/my-request'); ?>" class="cutom-parent">الخدمات المطلوبة</a> </li>
                <li class="<?php if($uriSegment=='booking-history'){ echo "active"; }?>"><a href="<?php echo base_url('ar/booking-history'); ?>" class="cutom-parent">سجل الحجوزات </a> </li>
                <li class="<?php if($uriSegment=='change-password'){ echo "active"; }?>"><a href="<?php echo base_url('ar/change-password'); ?>" class="cutom-parent">تغيير كلمة المرور</a> </li>
                <li class=""><a onclick="userLogout();" style="cursor:pointer;" class="cutom-parent">تسجيل خروج</a> </li>
            </ul>
        </div>
    </div>
</div>
<script>
function uploadImage(event,id){
    $("#imgBtn").click();
}
</script>
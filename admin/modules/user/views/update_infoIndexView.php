<?php get_header(); ?>
<div id="main-content-wp" class="info-account-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Thông tin tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST"  enctype = "multipart/form-data">
                        <input id="upload-action" type="hidden" value="<?php echo base_url(); ?>admin/?mod=media&controller=index&action=add" >
                        <input type="hidden" id="type" value="1">
                        <label for="fullname">Tên hiển thị</label>
                        <input type="text" name="fullname" value="<?php echo set_value('fullname'); ?>" id="fullname">
                            <p><?php echo get_error('fullname'); ?></p>
                        <label for="email">Email</label>
                        <div class="wp-input">
                            <input type="email" class="readonly" name="email" placeholder="<?php echo set_value('email') ;  ?>" id="email" readonly="redonly">
                            <a href=""><i class="fa fa-cog" aria-hidden="true"></i></a>
                        </div>
                        <label for="level">Cấp độ truy cập </label>
                        <?php $level = convert_level(set_value('level')) ; ?>
                            <input type="text" name="level" class="readonly" placeholder="<?php echo $level ; ?>" id="level" readonly="redonly">
                        <div class="wp-input">
                            <label for="facebook">Link Facebook :</label>
                            <input type="text" name="facebook" value="<?php echo set_value('facebook');?>" id="facebook">
                            <a href="<?php echo set_value('facebook') ; ?>"><i class="fa fa-share" aria-hidden="true"></i></a>
                        </div>
                            <p><?php echo get_error('facebook'); ?></p>
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" value="<?php echo set_value('tel') ; ?>" id="tel">
                       <p><?php echo get_error('tel'); ?></p>
                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo set_value('address'); ?></textarea>
                        <label>Hình ảnh</label>
                        <div class="js main-up-file">
                            <div class="up-file upload-file">
                                <div class="input-file-container">
                                    <input class="input-file" name="img" id="my-file" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger">Chọn file tải lên</label>
                                    <input type="hidden" name="img_id" class="id" value="">
                                    <button class="add-file" name=""><i class="fa fa-upload" aria-hidden="true"></i></button>
                                </div>
                                <p class="file-return"></p>
                            </div>
                            <img src="<?php echo set_value('avatar') ; ?>">
                        </div>

                        <button type="submit" name="update_info" id="btn-submit">Cập nhật</button>
                        <p><?php echo get_notifice('update_info'); ?></p>
                    </form>

                    <p> Cập nhập lần cuối : <?php echo format_date($info_user['modify_at']) ; ?> </p>
                    <p> Tạo lúc : <?php echo format_date($info_user['create_at']) ; ?> </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer() ; ?>
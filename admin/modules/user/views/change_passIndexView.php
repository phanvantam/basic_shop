<?php get_header() ; ?>
<div id="main-content-wp" class="change-pass-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=user&controller=index&action=add_user" title="" id="add-new" class="fl-left">Thêm User</a>
            <h3 id="index" class="fl-left">Cập nhật tài khoản</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <label for="old-pass">Mật khẩu cũ</label>
                        <input type="password" name="pass_old" value="<?php echo set_value('pass_old') ; ?>" id="pass-old">
                        <p class="message"><?php echo get_error('pass_old') ; ?></p>
                        <label for="new-pass">Mật khẩu mới</label>
                        <input type="password" name="pass_new" value="<?php echo set_value('pass_new') ; ?>" id="pass-new">
                        <p class="message"><?php echo get_error('pass_new') ; ?></p>
                        <label for="confirm-pass">Xác nhận mật khẩu</label>
                        <input type="password" name="confirm_pass" value="<?php echo set_value('confirm_pass') ; ?>" id="confirm-pass">
                        <p class="message"><?php echo get_error('confirm_pass') ; ?></p>
                        <button type="submit" name="update_pass" id="btn-submit">Cập nhật</button>
                        <p class="message"><?php echo get_notifice('update_pass') ; ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    get_footer() ;
?>
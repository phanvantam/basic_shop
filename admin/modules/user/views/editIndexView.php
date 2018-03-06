<?php get_header() ; ?>
    <div id="main-content-wp" class="change-pass-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=user&controller=index&action=add_user" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Thay đổi thông tin thành viên</h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar(); ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST">
                            <label for="fullname"> Tên người dùng : </label>
                            <input type="text" name="fullname" value="<?php echo set_value('fullname') ; ?>" id="fullname">
                            <p><?php echo get_error('fullname') ; ?></p>
                            <label for="email">Tài khoản email : </label>
                            <input type="text" name="email" value="<?php echo set_value('email',false) ; ?>" id="email">
                            <p><?php echo get_error('email') ; ?></p>
                            <label for="pass">Mật khẩu :</label>
                            <input type="password" name="pass" value="<?php echo set_value('pass') ; ?>" id="pass">
                            <p><?php echo get_error('pass') ; ?></p>
                            <label for="confirm_pass">Nhập lại mật khẩu :</label>
                            <input type="password" name="confirm_pass" value="<?php echo set_value('confirm_pass') ; ?>" id="confirm_pass">
                            <p><?php echo get_error('confirm_pass') ; ?></p>
                            <label>Chọn cấp độ truy cập :</label>
                            <?php echo show_select(array(3=>'Nhân viên',2 => 'Quản lý'), $active,array('name'=>'level','id'=>'level')) ; ?>
                            <p><?php echo get_error('level') ; ?></p>
                            <button type="submit" name="edit_user" id="btn-submit">Lưu thay đổi</button>
                            <p><?php echo get_notifice('edit_user') ; ?></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer() ;
?>
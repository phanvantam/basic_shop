<?php get_header() ; ?>
    <div id="main-content-wp" class="change-pass-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=user&controller=index&action=index" title="" id="add-new" class="fl-left">Danh sách thành viên</a>
                <h3 id="index" class="fl-left">Thêm tài khoản thành viên</h3>
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
                            <p class="message"><?php echo get_error('fullname') ; ?></p>
                            <label for="email">Tài khoản email : </label>
                            <input type="text" name="email" value="<?php echo set_value('email',false) ; ?>" id="email">
                            <p class="message"><?php echo get_error('email') ; ?></p>
                            <label for="pass">Mật khẩu :</label>
                            <input type="password" name="pass" value="<?php echo set_value('pass') ; ?>" id="pass">
                            <p class="message"><?php echo get_error('pass') ; ?></p>
                            <label for="confirm-pass">Xác nhận mật khẩu :</label>
                            <input type="password" name="confirm_pass" value="<?php echo set_value('confirm_pass') ; ?>" id="confirm-pass">
                            <p class="message"><?php echo get_error('confirm_pass') ; ?></p>
                            <label>Chọn cấp độ truy cập :</label>
                            <select name="level" id="level">
                                <option value="3">Nhân viên </option>
                                <option value="2">Quản lý </option>
                            </select>
                            <p class="message"><?php echo get_error('level') ; ?></p>
                            <button type="submit" name="add_user" id="btn-submit">Thêm thành viên</button>
                            <p class="message"><?php echo get_notifice('add_user') ; ?></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
get_footer() ;
?>
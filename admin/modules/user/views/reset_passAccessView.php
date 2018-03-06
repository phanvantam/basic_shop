<?php get_header('access') ; get_notifice_session() ;?>
<div id="wp-form" >
    <div id="wp"></div>
    <div class="widget-content">
    <?php if (empty($_GET['code'])){ ?>
        <p class="widget-title">Lấy lại mật khẩu </p>
        <form method="post">
            <div class="form-group">
                <input type="text" name="email" value="<?php echo set_value('email') ;?>" placeholder="Nhập email">
                <p class="message"><?php echo get_error('email') ;?></p>
            </div>
            
            <input type="submit" name="set_code" value="Xác nhận">
        </form>
     <?php }else{ ?>
        <p class="widget-title">Đặt mật khẩu mới</p>
        <form method="post">
            <div class="form-group">
                <input type="password" name='pass_new' value="<?php echo set_value('pass_new') ;?>" placeholder="Nhập mật khẩu mới">
                <p class="message"><?php echo get_error('pass_new') ;?></p>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_pass" placeholder="Xác nhận mật khẩu" value="<?php echo set_value('confirm_pass') ;?>"  >
                <p class="message"><?php echo get_error('confirm_pass') ;?></p>
            </div>
            <input type="submit" name="reset" value="Thay đổi">
        </form>
        <?php } ?>
    </div>
</div>
</body>
</html
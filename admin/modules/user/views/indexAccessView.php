<?php get_header('access') ;
get_notifice_session() ;?>
<div id="wp-form" >
            <div class="widget-content">
                <p class="widget-title">Đăng nhập hệ thống </p>
                <form method="post" id="login">
                    <p class="message"><?php echo get_error('login') ;?></p>
                    <div class="form-group">
                        <input type="text" name="email" value="<?php echo set_value('email') ;?>" placeholder="Nhập email">
                        <p class="message"><?php echo get_error('email') ;?></p>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Mật khẩu" value="<?php echo set_value('password') ;?>">
                        <p class="message"><?php echo get_error('password') ;?></p>
                    </div>    
    <!-- .slideThree -->  
    <div class="form-group">
        <label>Lưu thông tin đăng nhập</label>
                    <div class="slideThree">  
                      <input type="checkbox" value="true" id="slideThree" name="remember" checked />
                      <label for="slideThree"></label>
                    </div>
    </div>
    <!-- end .slideThree -->
 <input type="submit" name="login" value="" >
                 
                </form>
                <a id="reset-pass" href="?mod=user&controller=access&action=reset_pass">Quên mật khẩu ?</a>
            </div>
        </div>
</body>
</html>
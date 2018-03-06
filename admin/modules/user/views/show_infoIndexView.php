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
                        <form method="POST">
                            <label for="fullname">Tên hiển thị</label>
                            <input type="text" name="fullname" value="<?php echo $info_user['fullname'] ; ?>" id="fullname" readonly="readonly">
                            <label for="email">Email</label>
                            <div class="wp-input">
                                <input type="email" class="readonly" name="email" placeholder="<?php echo $info_user['email'] ;  ?>" id="email" readonly="redonly">
                            </div>
                            <label>Avatar</label>
                            <div class="uploadFile">
                                <img src="<?php echo $info_user['avatar'] ; ?>">
                            </div>
                            <label for="level">Cấp độ truy cập </label>
                            <?php $level = convert_level($info_user['level']) ; ?>
                            <input type="text" name="level" class="readonly" placeholder="<?php echo $level ; ?>" id="level" readonly="redonly">
                            <label for="level">Trạng thái  </label>
                            <?php $active = convert_active_user($info_user['active']) ; ?>
                            <input type="text" name="level" class="readonly" placeholder="<?php echo $active ; ?>" id="level" readonly="redonly">
                            <div class="wp-input">
                                <label for="facebook">Link Facebook :</label>
                                <input type="text" readonly name="facebook" placeholder="<?php echo $info_user['facebook'] ;?>"  id="facebook">
                                <a href="<?php echo $info_user['facebook'] ; ?>"><i class="fa fa-share" aria-hidden="true"></i></a>
                            </div>
                            <label for="tel">Số điện thoại</label>
                            <input type="tel" name="tel" readonly placeholder="<?php echo $info_user['tel'] ; ?>" id="tel">
                            <label for="address">Địa chỉ</label>
                            <textarea name="address" readonly id="address"><?php echo $info_user['address'] ; ?></textarea>

                        </form>

                        <p> Cập nhập lần cuối : <?php echo format_date($info_user['modify_at']) ; ?> </p>
                        <p> Tạo lúc : <?php echo format_date($info_user['create_at']) ; ?> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer() ; ?>
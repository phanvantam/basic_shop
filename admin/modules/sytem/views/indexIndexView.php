<?php get_header() ; ?>
    <div id="main-content-wp" class="add-cat-page menu-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="#" title="" id="add-new" class="fl-left">Trang chủ</a>
                <h3 id="index" class="fl-left">Thông tin Website </h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar() ; ?>
            <div id="content" class="fl-right">
                <div class="section-detail clearfix">
                    <div id="list-menu" class="fl-left">
                        <form method="post">
                            <div class="form-group">
                                <label for="title"> Tên website :</label>
                                <input type="text" maxlength="100" name="title" value="<?php echo set_value('title'); ?>" id="title" placeholder="">
                                <p class="message"><?php echo get_error('title') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="address"> Địa chỉ cửa hàng :</label>
                                <input type="text" maxlength="200" name="address" value="<?php echo set_value('address'); ?>" id="address" placeholder="">
                                <p class="message"><?php echo get_error('title') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="email"> Email liên hệ :</label>
                                <input type="email" maxlength="100" name="email" value="<?php echo set_value('email'); ?>" id="title" placeholder="">
                                <p class="message"><?php echo get_error('title') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="describe"> Mô tả website :</label>
                                <textarea name="describe" id="describe" maxlength="500"><?php echo set_value('describe'); ?></textarea>
                                <p class="message"><?php echo get_error('describe') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="tel"> Số điện thoại hỗ trợ :</label>
                                <input type="text" maxlength="12" name="tel" value="<?php echo set_value('tel'); ?>" id="tel">
                                <p class="message"><?php echo get_error('tel') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="per_page"> Số bài viết và sản phẩm trên một trang :</label>
                                <input type="number" max="10" min="3" name="per_page" value="<?php echo set_value('per_page'); ?>" id="per_page">
                                <p class="message"><?php echo get_error('per_page') ; ?></p>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="edit_sytem" id="btn-save-list">Lưu lại thay đổi </button>
                                <p class="message"><?php echo get_notifice('edit') ; ?></p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php get_footer() ; ?>
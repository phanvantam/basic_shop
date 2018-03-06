<?php get_header() ; ?>
    <div id="main-content-wp" class="add-cat-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Thêm trang</h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar(); ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST">
                            <div class="form-group">
                                <label for="title">Tiêu đề</label>
                            <input type="text" maxlength="100" name="title" id="title" value="<?php echo set_value('title') ;?>">
                            <p class="message"><?php echo get_error('title'); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug ( Friendly_url )</label>
                                <input type="text" maxlength="100" name="slug" placeholder="Mạc định sẽ dùng tiêu đề " id="slug" value="<?php echo set_value('slug') ;?>">
                                <p class="message"><?php echo get_error('slug') ;?></p>
                            </div>
                            <div class="form-group">
                                <label for="desc">Nội dung</label>
                                <textarea name="content" class="ckeditor" id="desc"><?php echo set_value('content') ; ?></textarea>
                                <p class="message"><?php echo get_error('content'); ?></p>
                            </div>
                            <div class="form-group">
                                <button type="submit" name=edit_page" id="btn-submit">Lưu thay đổi</button>
                            </div>
                        </form>
                        <p>Sửa lần cuối lúc: <?php echo format_date($info_page['modify_at']) ;?></p>
                        <p>Người sửa: <?php echo get_info_user_by_id($info_page['modify_by'],'fullname') ;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ; ?>
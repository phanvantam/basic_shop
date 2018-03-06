<?php get_header(); ?>
    <div id="main-content-wp" class="info-account-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
                <h3 id="index" class="fl-left">Thêm mới slider </h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar(); ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST"  enctype = "multipart/form-data">
                            <input id="upload-action" type="hidden" value="<?php echo base_url(); ?>admin/?mod=media&controller=index&action=add" >
                            <input type="hidden" id="type" value="3">
                            <div class="form-group">
                                <label for="title">Tiêu đề ảnh :</label>
                                <input type="text" name="title" maxlength="200" value="<?php echo set_value('title') ; ?>" id="title">
                                <p class="message"><?php echo get_error('title') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="caption">Chú thích ảnh :</label>
                                <textarea name="caption" maxlength="300" id="caption"><?php echo set_value('caption') ; ?></textarea>
                                <p class="message"><?php echo get_error('caption') ; ?></p>
                            </div>
                            
                            <label>Hình ảnh</label>
                            <div class="js main-up-file">
                                <div class="up-file upload-file">
                                    <div class="input-file-container">
                                        <input class="input-file" name="img" id="my-file" type="file">
                                        <label tabindex="0" for="my-file" class="input-file-trigger">Chọn file tải lên</label>
                                        <input type="hidden" name="img_id" class="id" value="<?php echo set_value('img_id') ; ?>">
                                        <button class="add-file" name=""><i class="fa fa-upload" aria-hidden="true"></i></button>
                                    </div>
                                    <p class="file-return"><?php echo get_error('img_id') ; ?></p>
                                </div>
                                <img src="<?php echo set_value('url_img') ; ?>">
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" name="edit_slider" id="btn-submit">Xác nhận thay đổi</button>
                            </div>

                        </form>
                        <p>Sửa lần cuối lúc: <?php echo format_date($info_slider['modify_at']) ;?></p>
                        <p>Người sửa: <?php echo get_info_user_by_id($info_slider['modify_by'],'fullname') ;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer() ; ?>
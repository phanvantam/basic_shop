<?php get_header() ; ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=post&controller=index&action=add" title="" id="add-new" class="fl-left">Thêm mới </a>
            <h3 id="index" class="fl-left">Chỉnh sửa bài viết</h3>
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
                            <input type="text" maxlength="100" name="title" value="<?php echo set_value('title') ; ?>" id="title">
                            <p class="message"><?php echo get_error('title') ; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug ( Friendly_url )</label>
                            <input type="text" maxlength="100" value="<?php echo set_value('slug') ; ?>" placeholder="Mặc định sẽ sử dụng tiêu đề " name="slug" id="slug">
                            <p class="message"><?php echo get_error('slug') ; ?></p>
                        </div>
                        <div class="form-group">
                           <label>Mô tả</label>
                           <textarea name="excerpt" maxlength="300"><?php echo set_value('excerpt'); ?></textarea>
                            <p class="message"><?php echo get_error('excerpt') ; ?></p> 
                        </div>
                        <div class="form-group">
                            <label>Nội dung bài viết </label>
                            <textarea name="content" class="ckeditor"><?php echo set_value('content') ; ?></textarea>
                            <p class="message"><?php echo get_error('content') ; ?></p>
                        </div>
                        
                        <label>Hình ảnh</label>
                        <input id="upload-action" type="hidden" value="<?php echo base_url(); ?>admin/?mod=media&controller=index&action=add" >
                        <input type="hidden" id="type" value="2">
                        <div class="js main-up-file">
                            <div class="up-file upload-file">
                                <div class="input-file-container">
                                    <input class="input-file" name="img" id="my-file" type="file">
                                    <label tabindex="0" for="my-file" class="input-file-trigger">Chọn file tải lên</label>
                                    <input type="hidden" name="img_id" class="id" value="<?php echo set_value('img_id'); ?>">
                                    <button class="add-file" name=""><i class="fa fa-upload" aria-hidden="true"></i></button>
                                </div>
                                <p class="file-return"><?php echo get_error('img') ; ?></p>
                            </div>
                            <img src="<?php echo $url_img ; ?>">
                        </div>
                        
                        <div class="form-group">
                            <label>Danh mục </label>
                            <?php
                            if(!empty($list_cat)){
                                $result = convert_show_select(convert_level_to_str($list_cat,'--','title'),array('k'=>'cat_id','v'=>'title')) ;
                            }
                            $result[0] = 'Chọn danh mục' ;
                            echo show_select($result,$active,array('name'=>'cat_id'));
                            ?>
                            <p class="message"><?php echo get_error('cat_id') ; ?></p>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="edit_post" id="btn-submit">Cập nhập bài viết </button>
                        </div>
                    </form>
                    <p>Sửa lần cuối lúc: <?php echo format_date($info_post['modify_at']) ;?></p>
                    <p>Người sửa: <?php echo get_info_user_by_id($info_post['modify_by'],'fullname') ;?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ; ?>
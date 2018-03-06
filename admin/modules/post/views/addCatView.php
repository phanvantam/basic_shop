<?php get_header() ; ?>
    <div id="main-content-wp" class="add-cat-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=post&controller=cat&action=index" title="" id="add-new" class="fl-left">Danh sách</a>
                <h3 id="index" class="fl-left">Thêm mới danh mục</h3>
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
                                <input type="text" maxlength="100" value="<?php echo set_value('title') ; ?>" name="title" id="title">
                                <p class="message"><?php echo get_error('title') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="slug">Slug ( Friendly_url )</label>
                                <input type="text" maxlength="100" placeholder="Mặc định sẽ sử dụng title" name="slug" value="<?php echo set_value('slug') ; ?>" id="slug">
                                <p class="message"><?php echo get_error('slug') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label>Danh mục cha</label>
                                 <?php
                                    if(!empty($list_cat)){
                                        $result = convert_show_select(convert_level_to_str($list_cat,'--','title'),array('k'=>'cat_id','v'=>'title')) ;
                                    }
                                    $result[0] = 'Chọn danh mục' ;
                                    echo show_select($result, set_value('parent_cat'),array('name'=>'parent_cat'));
                                ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="add" id="btn-submit">Thêm danh mục</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ; ?>
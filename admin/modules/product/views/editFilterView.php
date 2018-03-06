<?php get_header() ; ?>
    <div id="main-content-wp" class="change-pass-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=product&controller=filter&action=add" title="" id="add-new" class="fl-left">Thêm bộ lọc</a>
                <h3 id="index" class="fl-left">Chỉnh sửa bộ lọc </h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar() ; ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <form method="POST">
                            <div class="form-group">
                                <label for="title">Tên bộ lọc </label>
                                <input type="text" maxlength="100" name="title" value="<?php echo set_value('title') ; ?>" id="title">
                                <p class="message"><?php echo get_error('title') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label>Lọc theo giá :</label>
                                <input type="radio" value="1" name="type_filter" class="switch" <?php echo compare(set_value('type'),1,'checked') ;?>>
                                <div class="content-hidden">
                                    <label for="min-price">Gía bắt đầu (đ)</label>
                                    <input type="text" name="min_price" value="<?php echo set_value('min_price') ; ?>" id="min-price">
                                    <p class="message"><?php echo get_error('min_price') ; ?></p>
                                    <label for="max-price">Gía kết thúc (đ)</label>
                                    <input type="text" name="max_price" value="<?php echo set_value('max_price') ; ?>" id="max-price">
                                    <p class="message"><?php echo get_error('max_price') ; ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lọc theo danh mục :</label>
                                <input type="radio" value="2" name="type_filter" class="switch" <?php  echo compare(set_value('type'),2,'checked') ;?>>
                                <div class="content-hidden">
                                    <?php
                                    if(!empty($list_cat)){
                                        $result = convert_show_select(convert_level_to_str($list_cat,'--','title'),array('k'=>'cat_id','v'=>'title')) ;
                                    }
                                    $result[0] = 'Chọn danh mục' ;
                                    echo show_select($result, set_value('cat_id'),array('name'=>'cat_id'));
                                    ?>
                                    <p class="message"><?php echo get_error('cat_id') ; ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="edit_filter" id="btn-submit">Thêm bộ lọc</button> 
                            </div>
                        </form>
                        <div class="form-group">
                             <p>Sửa lần cuối lúc: <?php echo format_date($info_filter['modify_at']) ;?></p>
                            <p>Người sửa: <?php echo get_info_user_by_id($info_filter['modify_by'],'fullname') ;?></p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer() ; ?>
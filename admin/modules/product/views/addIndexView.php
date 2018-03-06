<?php get_header() ; ?>
<div id="main-content-wp" class="add-cat-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=product&controller=index&action=index" title="" id="add-new" class="fl-left">Danh sách</a>
            <h3 id="index" class="fl-left">Thêm mới sản phẩm</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <div class="form-group">
                            <label for="title">Tên sản phẩm </label>
                            <input type="text" maxlength="100" name="title" value="<?php echo set_value('title') ; ?>" id="title">
                            <p class="message"><?php echo get_error('title') ; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug ( Friendly_url )</label>
                            <input type="text" maxlength="100" value="<?php echo set_value('slug') ; ?>" placeholder="Mặc định sẽ sử dụng tiêu đề " name="slug" id="slug">
                            <p class="message"><?php echo get_error('slug') ; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Gía sản phẩm (đ)</label>
                            <input type="text" value="<?php echo set_value('price'); ?>" name="price" >
                            <p class="message"><?php echo get_error('price') ; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Giảm giá : </label>
                            <input type="checkbox" <?php if(isset($_POST['show-discount'])){echo 'checked';} ?> name="show-discount">
                            <div id="wp-discount">
                                <div class="form-group">
                                    <label>Khuyến mãi (%)</label>
                                    <input type="number" name="percen"  value="<?php echo set_value('percen'); ?>">
                                    <p class="message"><?php echo get_error('percen') ; ?></p>
                                </div>
                                <div class="form-group">
                                    <label>Gía khuyến mại (đ)</label>
                                    <input type="text" name="discount" value="<?php echo set_value('discount'); ?>">
                                    <p class="message"><?php echo get_error('discount') ; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tổng số sản phẩm </label>
                            <input type="number" value="<?php echo set_value('total_product'); ?>" name="total_product" >
                            <p class="message"><?php echo get_error('total_product') ; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Thông tin sản phẩm </label>
                            <textarea name="info" rows="10" cols="80"><?php echo set_value('info'); ?></textarea>
                            <p class="message"><?php echo get_error('info') ; ?></p>
                        </div>
                        <div class="form-group">
                            <label>Mô tả sản phẩm  </label>
                            <textarea name="depict" class="ckeditor" rows="10" cols="80"><?php echo set_value('depict') ; ?></textarea>
                            <p class="message"><?php echo get_error('depict') ; ?></p>
                        </div>
                        
                        <label>Ảnh sản phẩm</label>
                        <input id="upload-action" type="hidden" value="<?php echo base_url(); ?>admin/?mod=media&controller=index&action=add" >
                        <input type="hidden" id="type" value="3">
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
                            <img src="<?php echo set_value('url_img') ; ?>">
                        </div>
                        <div id="add-img-involve">Thêm hình ảnh  <i class="fa fa-plus" aria-hidden="true"></i></div>

                        <ul id="list-option-img" class="js clearfix">
                            <?php
                            if(!empty($list_involve)){
                                foreach ($list_involve as $item ){
                                    ?>
                             <li class="db-up">
                                <div class="main-up-file"> 
                                    <div class="up-file upload-file"> 
                                        <div class="input-file-container"> 
                                            <i class="fa fa-times-circle-o drop" aria-hidden="true"></i> 
                                            <input class="input-file" name="img" id="my-file" type="file">         
                                            <label tabindex="0" for="my-file" class="input-file-trigger">Chọn file tải lên</label> 
                                            <input type="hidden" name="img_involve[]" class="id" value="<?php echo $item['media_id'] ; ?>">
                                            <button class="add-file" name=""><i class="fa fa-upload" aria-hidden="true"></i></button> 
                                        </div> 
                                        <p class="file-return"></p>
                                    </div>
                                        <img src="<?php echo $item['url'] ; ?>">
                                    </div>
                             </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                        <div class='form-group'>
                            <label>Danh mục cha</label>
                            <?php
                                if(!empty($list_cat)){
                                    $result = convert_show_select(convert_level_to_str($list_cat,'--','title'),array('k'=>'cat_id','v'=>'title')) ;
                                }
                                $result[0] = 'Chọn danh mục' ;
                                echo show_select($result, set_value('cat_id'),array('name'=>'cat_id'));
                            ?>
                            <p class="message"><?php echo get_error('cat_id') ; ?></p>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="add_product" id="btn-submit">Thêm sản phẩm </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ; ?>
<?php get_header(); ?>
    <div id="main-content-wp" class="info-account-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=sytem&controller=support&action=add" title="" id="add-new" class="fl-left">Thêm hỗ trợ</a>
                <h3 id="index" class="fl-left">Chỉnh sửa hỗ trợ </h3>
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
                                <label for="title">Tên hỗ trợ :</label>
                                <input type="text" name="title" maxlength="100" value="<?php echo set_value('title') ; ?>" id="title">
                                <p><?php echo get_error('title') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="describe">Mô tả ngắn :</label>
                                <input type="text" name="depict" maxlength="100" id="describe" value="<?php echo set_value('depict') ; ?>" >
                            </div>
                            <div class="form-group">
                                 <label>Liên kết tới trang chi tiết :</label>
                                <?php
                                    $list_page = db_fetch_array('SELECT * FROM tbl_page WHERE active = 1 ') ;
                                    if(!empty($list_page)){
                                        $list_page = convert_show_select($list_page, array('k'=>'page_id','v'=>'title')) ;
                                    }
                                    $list_page[0] = 'Lựa chọn trang liên kết ' ;
                                    echo show_select($list_page, set_value('page_connect'),array('name'=>'page_connect')) ;
                                    ?>
                                 <p class="error"><?php echo get_error('page_connect') ; ?></p>
                            </div>
                                <label>Hình ảnh</label>
                                <div class="js main-up-file">
                                    <div class="up-file upload-file">
                                        <div class="input-file-container">
                                            <input class="input-file" name="img" id="my-file" type="file">
                                            <label tabindex="0" for="my-file" class="input-file-trigger">Chọn file tải lên</label>
                                            <input type="hidden" name="img_id" class="id" value="<?php echo set_value('img_id') ; ?>">
                                            <button class="add-file"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        <p class="file-return"><?php echo get_error('img_id') ; ?></p>
                                    </div>
                                    <img src="<?php echo set_value('url') ; ?>">
                                </div>
                            <div class="form-group">
                                <button type="submit" name="update" id="btn-submit">Xác nhận thay đổi</button>
                            </div>

                        </form>
                        <br /><p>Sửa lần cuối lúc: <?php echo format_date($info_support['modify_at']) ;?></p>
                        <p>Tạo lúc: <?php echo format_date($info_support['create_at']) ;?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php get_footer() ; ?>
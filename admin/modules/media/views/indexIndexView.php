<?php get_header() ; ?>
<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?page=add_cat" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách bài viết </h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ; ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="<?php echo $list_type['all']['url'] ;?>">Tất cả <span class="count">(<?php echo $list_type['all']['total'] ; ?>)</span></a> |</li>
                            <li class="publish"><a href="<?php echo $list_type['post']['url'] ;?>">Bài viết <span class="count">(<?php echo $list_type['post']['total'] ; ?>)</span></a> |</li>
                            <li><a href="<?php echo $list_type['product']['url'] ;?>">Sản phẩm <span class="count">(<?php echo $list_type['product']['total'] ; ?>)</span></a> |</li>
                            <li><a href="<?php echo $list_type['avatar']['url'] ;?>">Avatar <span class="count">(<?php echo $list_type['avatar']['total'] ; ?>)</span></a> |</li>
                            <li><a href="<?php echo $list_type['sytem']['url'] ;?>">Hệ thống <span class="count">(<?php echo $list_type['sytem']['total'] ; ?>)</span></a> |</li>
                            <li><a href="<?php echo $list_type['trash']['url'] ;?>">Thùng rác <span class="count">(<?php echo $list_type['trash']['total'] ; ?>)</span></a> |</li>
                            <?php
                                if(isset($total_search)){
                            ?>
                                <li><b>Tìm thấy <span class="count">(<?php echo $total_search ; ?>)</span></b> </li>
                            <?php } ?>
                        </ul>
                        <form method="GET" action="" class="form-s fl-right">
                            <input type="hidden" name="controller" value="<?php echo get_controller() ;?>">
                            <input type="hidden" name="mod" value="<?php echo get_module() ;?>">
                            <input type="hidden" name="action" value="<?php echo get_action() ;?>">
                            <input type="hidden" name="type" value="<?php echo $type ; ?>">
                            <input style="width: 70px ;padding: 0px 5px; " min="1" type="number" value="<?php echo set_value('per_page') ;?>" name="per_page" />
                            <input type="text" name="q" id="q" value="<?php set_value('q'); ?>">
                            <button>Tìm kiếm</button>
                        </form>
                </div>
                    <?php
                    if($type == 'trash' && $list_type['trash']['total'] > 0 ){
                        ?>
                        <div style="font-size: 16px "><a href="?mod=media&controller=index&action=drop&all">Xóa tất cả <i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                    <?php } ?>
                    <input id="upload-action" type="hidden" value="<?php echo base_url(); ?>?mod=media&controller=index&action=update" >
                        <ul id="list-img" class="js clearfix">
                            <?php
                                if(!empty($list_media['data'])){
                                    foreach ($list_media['data'] as $item){
                            ?>
                            <li class="main-up-file">
                                <img src="<?php echo $item['url'] ; ?>">
                                <div class="up-file upload-file">
                                        <div class="input-file-container">
                                            <input class="input-file" name="img" id="my-file" type="file">
                                            <label tabindex="0" for="my-file" class="input-file-trigger">Chọn file tải lên</label>
                                            <input type="hidden" name="id" class="id" value="<?php echo $item['media_id'] ;?>">
                                            <button class="add-file"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </div>
                                        <p class="file-return"></p>
                                </div>
                                <div class="wp-option">
                                    <div class="background"></div>
                                    <div class="option">
                                        <?php
                                            if($item['active'] != 2 ){
                                                ?>
                                            <a href="" class="edit" title="Tải ảnh mới"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                                            <?php } ?>
                                        <?php
                                        if($item['active'] == 2 ){
                                            ?>
                                            <a href="?mod=media&controller=index&action=drop&id=<?php echo $item['media_id'] ; ?>" title="Xóa ảnh"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    <?php } ?>
                                        <i title="Thông tin ảnh" class="fa fa-question-circle-o" aria-hidden="true">
                                            <ul class="info">
                                                <li><p>Tên: <?php echo $item['title'] ; ?></p></li>
                                                <li><p>Loại : <?php echo convert_type_file($item['type'],true) ; ?></p></li>
                                                <li><p>Trạng thái : <?php echo convert_active_media($item['active']) ; ?></p></li>
                                                <li><p>Tạo lúc : <?php echo format_date($item['create_at']) ; ?></p></li>
                                                <li><p>Người tạo : <?php echo get_info_user_by_id($item['create_by'],'fullname') ; ?></p></li>
                                            </ul>
                                        </i>
                                    </div>
                                </div>
                            </li>
                            <?php } } ?>
                        </ul>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <?php
                        if(isset($paging)){
                            echo paging_basic($paging['total'],$paging['page'],array('id'=>"list-paging",'url_page'=>$paging['url'],'label_active'=>'active')) ;
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>



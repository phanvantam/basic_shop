<?php get_header() ;
get_notifice_session() ;
?>
    <div id="main-content-wp" class="list-cat-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=theme&controller=menu&action=add" title="" id="add-new" class="fl-left">Thêm Menu</a>
                <h3 id="index" class="fl-left">Danh sách Menu </h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar() ; ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="actions">
                            <form method="POST" action="" class="form-actions">
                                <?php
                                $data_select[0] = 'Chọn tất cả' ;
                                echo show_select($data_select,$active,array('name'=>'menu_id')) ;
                                ?>
                                <input type="submit" name="sm_search" value="Áp dụng">

                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td style="width: 20%"><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Loại Menu</span></td>
                                    <td><span class="thead-text">Loại liên kết</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo </span></td>
                                    <td><span class="thead-text">Tạo lúc</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($list_menu)){
                                    $url_actions = '?mod=theme&controller=menu&action=actions' ;
                                    $stt = 0 ;
                                    foreach ($list_menu as $item) {
                                        $stt++ ;
                                        $class_key = $item['active'] == 2 ? 'fa-check-square-o' : 'fa-clock-o' ;
                                        $label_action = $item['active'] == 2 ? 'public' : 'pending' ;
                                        ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $stt ; ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <p style="color: #337ab7"><?php echo $item['title']; ?></p>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo $item['ordinal']; ?></span></td>
                                            <td>
                                                <div class="option-tool">
                                                    <a href="<?php echo '?mod='.get_module().'&controller='.get_controller().'&action=edit&id='.$item['menu_id'] ; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="<?php echo $url_actions.'&id='.$item['menu_id'].'&drop' ; ?>" title="Xóa" class="delete"><i class="fa fa-trash tool-if" aria-hidden="true"><p class="content">Xóa menu</p></i></a>
                                                    <a href="<?php echo $url_actions.'&id='.$item['menu_id'].'&'.$label_action ; ?>" title="<?php echo $label_action ; ?>"><i class="fa <?php echo $class_key ; ?>" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo convert_location_menu($item['location']); ?></span></td>
                                            <td>
                                                <span class="tbody-text"><?php echo convert_type_menu($item['type']); ?>
                                                   <?php if( !($item['type'] == 4 || $item['location'] == 2 && $item['parent_id'] == 0) ){ ?>
                                                    <i class="fa fa-info-circle tool-if" aria-hidden="true">
                                                        <p class="content">
                                                            <?php
                                                                if($item['type'] == 1){
                                                                    $result = db_fetch_row("SELECT title FROM tbl_page WHERE page_id = {$item['connect_to']}") ;
                                                                    echo 'Trang : '.$result['title'] ;
                                                                }elseif($item['type'] == 2){
                                                                    $result = db_fetch_row("SELECT title FROM tbl_category WHERE cat_id = {$item['connect_to']} && type = 1 ") ;
                                                                    echo 'Danh mục : '.$result['title'] ;
                                                                }elseif($item['type'] == 3){
                                                                    $result = db_fetch_row("SELECT title FROM tbl_category WHERE cat_id = {$item['connect_to']} && type = 2 ") ;
                                                                    echo 'Danh mục : '.$result['title'] ;
                                                                }
                                                            ?>
                                                        </p>
                                                       
                                                    </i> <?php } ?>
                                                </span>
                                            </td>
                                            <td><span class="tbody-text"><?php echo convert_active_post($item['active']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_info_user_by_id($item['create_by'],'fullname'); ?></span></td>
                                            <td><span class="tbody-text"><?php echo format_date($item['create_at']); ?></span></td>
                                        </tr>
                                    <?php  }} ?>
                                </tbody>
                                <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Thứ tự</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Loại Menu</span></td>
                                    <td><span class="thead-text">Loại liên kết</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo </span></td>
                                    <td><span class="thead-text">Tạo lúc</span></td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
<?php get_header() ; get_notifice_session(); ?>
<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=user&controller=index&action=add" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Danh sách người dùng</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar() ; ?>
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="<?php echo $list_status['all']['url'] ; ?>">Tất cả <span class="count">(<?php echo $list_status['all']['total'] ; ?>)</span></a> |</li>
                            <li class="publish"><a href="<?php echo $list_status['active']['url'] ; ?>">Đang hoạt động <span class="count">(<?php echo $list_status['active']['total'] ; ?>)</span></a> |</li>
                            <li class="pending"><a href="<?php echo $list_status['lock']['url'] ; ?>">Bị khóa <span class="count">(<?php echo $list_status['lock']['total'] ; ?>)</span></a></li>
                            <?php if(!empty($total_search)){ ?>
                                    <li>|<a href="">Tìm thấy <span class="count">(<?php echo $total_search ; ?>)</span></a></li>
                                <?php } ?>
                        </ul>
                        <form method="GET" action="" class="form-s fl-right">
                            <input type="hidden" name="controller" value="<?php echo get_controller() ;?>">
                            <input type="hidden" name="mod" value="<?php echo get_module() ;?>">
                            <input type="hidden" name="action" value="<?php echo get_action() ;?>">
                            <input type="hidden" name="type" value="<?php echo $type ;?>"/>
                            <input style="width: 70px ;padding: 0px 5px; " min="1" type="number" value="<?php echo set_value('per_page') ;?>" name="per_page" />
                            <input  type="text" name="q" id="q" value="<?php echo set_value('q'); ?>">
                            <button>Tìm kiếm</button>
                        </form>
                    </div>
                    <form method="POST" action="<?php echo  '?mod='.get_module().'&controller='.get_controller().'&action=actions' ;?>" class="form-actions">
                        <div class="actions"> 
                            <select name="actions">
                                <option value="">Tác vụ</option>
                                <option value="drop">Xóa danh sách</option>
                                <option value="lock">Khóa danh sách</option>
                                <option value="unlock">Mở khóa danh sách</option>
                            </select>
                            <input type="submit" name="sm_action" value="Áp dụng">

                        </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                <td><span class="thead-text">Avatar</span></td>
                                <td><span class="thead-text">Tên người dùng</span></td>
                                <td><span class="thead-text">Tác vụ</span></td>
                                <td><span class="thead-text">Email người dùng</span></td>
                                <td><span class="thead-text">Mức độ truy cập</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Tạo lúc</span></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(boolval($list_user['data'])){
                                $stt = $list_user['stt'] ;
                                foreach ($list_user['data'] as $item) {
                                    $stt++ ;
                                    $avatar = !empty($item['avatar']) ? get_media_by_id($item['avatar'],'url') : get_media_default('url',1) ;
                            ?>
                            <tr>
                                <td><input type="checkbox" name="id[]" value="<?php echo $item['user_id'] ; ?>" class="checkItem"></td>
                                <td><span class="tbody-text"><?php echo $stt ;?></span></td>
                                <td>
                                    <div class="tbody-thumb">
                                        <img src="<?php echo $avatar ; ?>" alt="">
                                    </div>
                                </td>
                                <td class="clearfix">
                                    <div class="tb-title fl-left">
                                        <a href="<?php echo $item['url']['info'] ; ?>" title=""><?php echo $item['fullname']; ?></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="option-tool">
                                        <a href="<?php echo $item['url']['edit'] ; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a href="<?php echo $item['url']['drop'] ; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <?php if($item['active'] == 2){ ?>
                                            <a href="<?php echo $item['url']['unlock'] ; ?>" title="Mở khóa" class="unlock"><i class="fa fa-unlock-alt" aria-hidden="true"></i></a>
                                        <?php }else{ ?>
                                            <a href="<?php echo $item['url']['lock'] ; ?>" title="Khóa người dùng" class="lock"><i class="fa fa-lock" aria-hidden="true"></i></a>
                                        <?php } ?>
                                    </div>
                                </td>

                                <td><span class="tbody-text"><?php echo $item['email']; ?></span></td>
                                <td><span class="tbody-text"><?php echo convert_level($item['level']); ?></span></td>
                                <td><span class="tbody-text"><?php echo convert_active_user($item['active']); ?></span></td>
                                <td><span class="tbody-text"><?php echo format_date($item['create_at']); ?></span></td>
                            </tr>
                            <?php  }} ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                <td><span class="thead-text">STT</span></td>
                                 <td><span class="thead-text">Avatar</span></td>
                                <td><span class="thead-text">Tên người dùng</span></td>
                                <td><span class="thead-text">Tác vụ</span></td>
                                <td><span class="thead-text">Email người dùng</span></td>
                                <td><span class="thead-text">Mức độ truy cập</span></td>
                                <td><span class="thead-text">Trạng thái</span></td>
                                <td><span class="thead-text">Tạo lúc</span></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    </form>
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
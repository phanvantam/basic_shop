<?php get_header() ;?>
    <div id="main-content-wp" class="list-post-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=page&controller=index&action=add" title="" id="add-new" class="fl-left">Thêm trang</a>
                <h3 id="index" class="fl-left">Danh sách trang </h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar() ; ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="<?php echo $list_status['all']['url'] ;?>">Tất cả <span class="count">(<?php echo $list_status['all']['total'] ;?>)</span></a> |</li>
                                <li class="publish"><a href="<?php echo $list_status['active']['url'] ; ?>">Đã đăng <span class="count">(<?php echo $list_status['active']['total'] ; ?>)</span></a> |</li>
                                <li><a href="<?php echo $list_status['pending']['url'] ; ?>">Chờ xét duyệt <span class="count">(<?php echo $list_status['pending']['total'] ; ?>)</span></a> |</li>
                                <li <?php echo compare(get_info_user('level'),array('2','3'),"style='display:none' "); ?>><a href="<?php echo $list_status['trash']['url'] ; ;?>">Thùng rác <span class="count">(<?php echo $list_status['trash']['total'] ; ?>)</span></a></li>
                                <?php if(isset($total_search)){ ?>
                                    <li>|<a href="">Tìm thấy <span class="count">(<?php echo $total_search ; ?>)</span></a></li>
                                <?php } ?>
                            </ul>
                            <form method="GET" action="" class="form-s fl-right">
                                <input type="hidden" name="controller" value="<?php echo get_controller() ;?>">
                                <input type="hidden" name="mod" value="<?php echo get_module() ;?>">
                                <input type="hidden" name="action" value="<?php echo get_action() ;?>">
                                <input type="hidden" name="type" value="<?php echo $type ; ?>">
                                <input style="width: 70px ;padding: 0px 5px; " min="1" type="number" value="<?php echo set_value('per_page') ;?>" name="per_page" />
                                <input type="text" name="q" id="q" value="<?php echo set_value('q'); ?>">
                                <button>Tìm kiến </button>
                            </form>
                        </div>
                           <form method="POST" action="<?php echo '?mod='.get_module().'&controller='.get_controller().'&action=actions' ;?>" class="form-actions">
                               <div class="actions">  
                                   <select name="actions">
                                    <option value="">Tác vụ</option>
                                    <option value="drop">Xóa </option>
                                    <option value="pending">Trở lại xét duyệt</option>
                                    <option value="public">Xét duyệt </option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td style="width: 30%"><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Slug</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo </span></td>
                                    <td><span class="thead-text">Tạo lúc</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($list_page['data'])){
                                    $stt = $list_page['stt'] ;
                                    foreach ($list_page['data'] as $item) {
                                        $stt++ ;
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="<?php echo $item['page_id'] ; ?>" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $stt ; ?></span></td>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="<?php echo base_url_frontend().$item['slug'].'.html' ; ?>" title=""><?php echo $item['title']; ?></a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option-tool">
                                                    <a href="<?php echo $item['url']['edit'] ; ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="<?php echo $item['url']['drop'] ; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <?php if($item['active'] == '1'){ ?>
                                                        <a href="<?php echo $item['url']['pending'] ; ?>" title="Trở lại xét duyệt"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                                                    <?php }else{ ?>
                                                        <a href="<?php echo $item['url']['public'] ; ?>" title="Xét duyệt ngay"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td><span class="tbody-text"><?php echo $item['slug']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo convert_active_post($item['active']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_info_user_by_id($item['create_by'],'fullname'); ?></span></td>
                                            <td><span class="tbody-text"><?php echo format_date($item['create_at']); ?></span></td>
                                        </tr>
                                    <?php  }} ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tiêu đề</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Slug</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Người tạo </span></td>
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
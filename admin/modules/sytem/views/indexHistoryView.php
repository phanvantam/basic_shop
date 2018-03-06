<?php get_header() ; ?>
    <div id="main-content-wp" class="list-post-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                
                <h3 style="margin-left: 226px;" id="index" class="fl-left">Lich sử đăng nhập </h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar() ; ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            
                           
                        </div>
                        <div class="actions">
                            <form method="GET" class="form-actions">
                                <input type="hidden" name="controller" value="<?php echo get_controller() ;?>">
                                <input type="hidden" name="mod" value="<?php echo get_module() ;?>">
                                <input type="hidden" name="action" value="<?php echo get_action() ;?>">
                                <input style="width: 70px ;padding: 0px 5px; " min="1" type="number" value="<?php echo set_value('per_page') ;?>" name="per_page" />
                                <?php
                                    $select = array('Chọn tất cả','Hôm nay','Hôm qua');
                                    echo show_select($select, set_value('time'), array('name'=>'time')) ;
                                ?>
                                <button>Tìm kiếm</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <form method="post" action="?mod=sytem&controller=history&action=drop">
                                <button id="drop-all"><i class="fa fa-trash tool-if" aria-hidden="true"></i></button>
                                    
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Người dùng</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Thêm </span></td>
                                    <td><span class="thead-text">Xóa</span></td>
                                    <td><span class="thead-text">Cập nhập</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($list_history['data'])){
                                    $stt = $list_history['stt'] ;
                                    $id_max = get_history_id_max(get_info_user('id')) ;
                                    foreach ($list_history['data'] as $item) {
                                        $stt++ ;
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="list_item[]" value="<?php echo $item['history_id'] ; ?>" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $stt ; ?></h3></span>
                                            <td><span class="tbody-text"><?php echo $item['username'] ; ?></h3></span> 
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <p><?php echo date('H',$item['happen_at']).' giờ '.date('i',$item['happen_at']).' phút '.' ngày '.date('d',$item['happen_at']).' tháng '.date('m',$item['happen_at']).' ngày '.date('Y',$item['happen_at']) ; ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option-tool">
                                                    <?php if($item['history_id'] != $id_max ){ ?>
                                                        <a href="<?php echo $item['url']['drop'] ; ?>" class="delete">
                                                            <i class="fa fa-trash tool-if" aria-hidden="true">
                                                                <b class="content">Xóa phiên truy cập </b>
                                                            </i>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            </td>

                                            <td><span class="tbody-text"><?php echo get_total_add_by_parent_id($item['history_id']) ; ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_total_drop_by_parent_id($item['history_id']) ; ?></span></td>
                                            <td><span class="tbody-text"><?php echo get_total_update_by_parent_id($item['history_id']) ; ?></span></td>
                                            <td><span class="tbody-text"><a href="<?php echo $item['url']['detail'] ; ?>">Xem thêm </a></span></td>
                                        </tr>
                                    <?php  }} ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Người dùng</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Thêm </span></td>
                                    <td><span class="thead-text">Xóa</span></td>
                                    <td><span class="thead-text">Cập nhập</span></td>
                                    <td><span class="thead-text">Chi tiết</span></td>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                        
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
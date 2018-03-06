<?php get_header() ; ?>
    <div id="main-content-wp" class="list-post-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=sytem&controller=history&action=index" title="" id="add-new" class="fl-left">Lịch sử đăng nhập</a>
                <h3 id="index" class="fl-left">Lich sử tác vụ của : <?php echo $title ; ?> </h3>
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
                            
                            <form method="GET" action="" class="form-actions">
                                <input type="hidden" name="controller" value="<?php echo get_controller() ;?>">
                                <input type="hidden" name="mod" value="<?php echo get_module() ;?>">
                                <input type="hidden" name="action" value="<?php echo get_action() ;?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['id'] ;?>">
                                <input style="width: 70px ;padding: 0px 5px; " min="1" type="number" value="<?php echo set_value('per_page') ;?>" name="per_page" />
                                <?php
                                    $select = array('all'=>'Chọn tất cả','add'=>'Thêm mới','edit'=>'Cập nhập','drop'=>'Xóa');
                                    echo show_select($select, set_value('type'), array('name'=>'type')) ;
                                ?>
                                <button>Tìm kiếm</button>
                            </form>    
                        </div>
                        <div class="table-responsive">
                            <form method="POST" action="?mod=sytem&controller=history&action=drop&detail=<?php echo $_GET['id'] ; ?>" >
                                 <button id="drop-all"><i class="fa fa-trash tool-if" aria-hidden="true"></i></button>
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Nội dung thao tác</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($list_history['data'])){
                                    $stt = $list_history['stt'] ;
                                    foreach ($list_history['data'] as $item) {
                                        $stt++ ;
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" name="list_item[]" value="<?php echo $item['history_id'] ; ?>" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $stt ; ?></h3></span>
                                               
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <p><?php echo $item['content']; ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option-tool">
                                                    <a href="<?php echo $item['url']['drop'] ; ?>" class="delete">
                                                        <i class="fa fa-trash tool-if" aria-hidden="true">
                                                            <b class="content">
                                                                Xóa lịch sử này                                                     
                                                            </b>
                                                        </i></a>
                                                </div>
                                            </td>

                                            <td><span class="tbody-text"><?php echo format_date($item['happen_at']) ; ?></span></td>
                                        </tr>
                                    <?php  }} ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Nội dung thao tác</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Thời gian</span></td>
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
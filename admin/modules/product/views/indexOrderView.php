<?php get_header() ; ?>
    <div id="main-content-wp" class="list-post-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?" title="" id="add-new" class="fl-left">Trang chủ</a>
                <h3 id="index" class="fl-left">Danh sách đơn hàng </h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar() ; ?>
            <div id="content" class="fl-right">
                <div class="section" id="detail-page">
                    <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="publish"><a href="<?php echo $list_status['active']['url'] ;?>">Đã xét duyệt <span class="count">(<?php echo $list_status['active']['total'] ; ?>)</span></a> |</li>
                                <li><a href="<?php echo $list_status['ship']['url'] ;?>">Đang vận chuyển <span class="count">(<?php echo $list_status['ship']['total'] ; ?>)</span></a> |</li>
                                <li><a href="<?php echo $list_status['pending']['url'] ;?>">Chờ xét duyệt <span class="count">(<?php echo $list_status['pending']['total'] ; ?>)</span></a> |</li>
                                <li <?php echo compare(get_info_user('level'),array('2','3'),"style='display:none' "); ?>><a href="<?php echo $list_status['trash']['url'] ;?>">Thùng rác <span class="count">(<?php echo $list_status['trash']['total'] ; ?>)</span></a></li>
                                <?php
                                    if(isset($total_search)){
                                ?>
                                <li>| <a href="">Tìm thấy </a><span class="count">(<?php echo $total_search ; ?>)</span></li>
                                        <?php
                                    }
                                ?>
                            </ul>
                            <form method="GET" action="" class="form-s fl-right">
                                <input type="hidden" name="controller" value="<?php echo get_controller() ;?>">
                                <input type="hidden" name="mod" value="<?php echo get_module() ;?>">
                                <input type="hidden" name="action" value="<?php echo get_action() ;?>">
                                <input type="hidden" name="type" value="<?php echo $type ; ?>">
                                <input style="width: 70px ;padding: 0px 5px; " min="1" type="number" value="<?php echo set_value('per_page') ;?>" name="per_page" />
                                <input type="text" name="q" id="q" value="<?php echo set_value('q'); ?>">
                                <button>Tìm kiếm</button>
                            </form>
                        </div>
                            <form method="POST" action="<?php echo '?mod='.get_module().'&controller='.get_controller().'&action=actions' ;?>" class="form-actions">
                                <div class="actions">
                                    <select name="actions">
                                        <option value="">Tác vụ</option>
                                        <option value="drop">Xóa </option>
                                        <option value="pending">Trở lại xét duyệt</option>
                                        <option value="public">Xét duyệt </option>
                                         <option value="ship">Vận chuyển </option>
                                    </select>
                                    <input type="submit" name="sm_action" value="Áp dụng">
                                </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Người mua</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>
                                    <td><span class="thead-text">Tổng giá </span></td>
                                    <td><span class="thead-text">Tạo lúc</span></td>
                                    <td><span class="thead-text">Chi tiết </span></td>

                                </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($list_order['data'])){
                                    $stt = $list_order['stt'] ;
                                    foreach ($list_order['data'] as $item) {
                                        $stt++ ;
                                ?>
                                        <tr>
                                            <td><input type="checkbox" name="id[]" value="<?php echo $item['order_id'] ; ?>" class="checkItem"></td>
                                            <td><span class="tbody-text"><?php echo $stt ;?></span></td>
                                            <td><span class="tbody-text" style="color: #0183f3"><?php echo $item['code_order']; ?></span></td>
                                            <td><span class="tbody-text" style="color: #0183f3"><?php echo $item['fullname']; ?></span></td>
                                            <td>
                                                <div class="option-tool">
                                                    <a href="<?php echo $item['url']['drop'] ; ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <?php if($item['active'] == 1 ){ ?>
                                                        <a href="<?php echo $item['url']['pending'] ; ?>" title="Trở lại xét duyệt"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                                                    <?php }elseif($item['active'] == 3 ){ ?>
                                                        <a href="<?php echo $item['url']['ship'] ; ?>" title="Vận chuyển ngay"><i class="fa fa-truck" aria-hidden="true"></i></a>
                                                    <?php }elseif($item['active'] == 2 ){ ?>
                                                        <a href="<?php echo $item['url']['public'] ; ?>" title="Hoàn thành đơn hàng"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </td>
                                            <td><span class="tbody-text"><?php echo convert_active_order($item['active']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['total_qty'] ; ?></span></td>
                                            <td><span class="tbody-text"><?php echo currency_format($item['total_price']); ?></span></td>
                                            <td><span class="tbody-text"><?php echo format_date($item['create_at']); ?></span></td>
                                            <td><a class="tbody-text" href="<?php echo $item['url']['detail']; ?>" >Xem chi tiết</a></td>
                                        </tr>
                                    <?php  }} ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Mã đơn hàng</span></td>
                                    <td><span class="thead-text">Người mua</span></td>
                                    <td><span class="thead-text">Tác vụ</span></td>
                                    <td><span class="thead-text">Trạng thái</span></td>
                                    <td><span class="thead-text">Số lượng</span></td>
                                    <td><span class="thead-text">Tổng giá </span></td>
                                    <td><span class="thead-text">Tạo lúc</span></td>
                                    <td><span class="thead-text">Chi tiết </span></td>

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
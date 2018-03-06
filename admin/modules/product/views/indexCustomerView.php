<?php get_header() ; ?>
    <div id="main-content-wp" class="list-post-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?controller=order&mod=product&action=index" title="" id="add-new" class="fl-left">Đơn hàng</a>
                <h3 id="index" class="fl-left">Danh sách khách hàng </h3>
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
                                <li class="publish"><a href="<?php echo $list_status['buy']['url'] ; ?>">Mua hàng <span class="count">(<?php echo $list_status['buy']['total'] ; ?>)</span></a> |</li>
                                <li><a href="<?php echo $list_status['subcribe']['url'] ; ?>">Đang theo dõi <span class="count">(<?php echo $list_status['subcribe']['total'] ; ?>)</span></a> </li>
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
                                <button>Tìm kiếm</button>
                            </form>
                        </div>
                      
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên</span></td>
                                    <td><span class="thead-text">Email </span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Tạo lúc</span></td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if(boolval($list_customer['data'])){
                                    $stt = $list_customer['stt'] ;
                                    foreach ($list_customer['data'] as $item) {
                                        $stt++ ;
                                ?>
                                        <tr>
                                            <td><span class="tbody-text"><?php echo $stt ;?></span></td>
                                            <td><span class="tbody-text" style="color: #0183f3"><?php echo $item['fullname']; ?></span></td>
                                            <td><span class="tbody-text" style="color: #0183f3"><?php echo $item['email']; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['address'] ; ?></span></td>
                                            <td><span class="tbody-text"><?php echo $item['phone'] ; ?></span></td>
                                            <td><span class="tbody-text"><?php echo format_date($item['create_at']); ?></span></td>
                                        </tr>
                                    <?php  }} ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên</span></td>
                                    <td><span class="thead-text">Email </span></td>
                                    <td><span class="thead-text">Địa chỉ</span></td>
                                    <td><span class="thead-text">Số điện thoại</span></td>
                                    <td><span class="thead-text">Tạo lúc</span></td>

                                </tr>
                                </tfoot>
                            </table>
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
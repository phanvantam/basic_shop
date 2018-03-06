<?php
    get_header() ;
?>
 <div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a class="active" href="<?php echo $paging['url_page'].'1' ; ?>" title="">Tìm kiếm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="wp-list" >
            <ul id="search-status" class="clearfix">
                <li><a href="<?php echo 'tim-kiem?type=product&q='. set_value('q')  ; ?>" class="<?php echo compare($type,'product','active'); ?>">Tìm kiếm sản phẩm</a> |</li>
                <li><a href="<?php echo 'tim-kiem?type=post&q='. set_value('q') ;  ; ?>" class="<?php echo compare($type,'post','active'); ?>">Tìm kiếm bài viết</a> |</li>
                <li><a>Tìm thấy <?php echo $total ; ?> kết quả </a></li>
            </ul>
            <ul class="clearfix">
                <?php if(isset($post)){ 
                    foreach($post as $item ){
                    ?>
                <li class="post clearfix">
                    <div class="post-thumb fl-left">
                        <a href="<?php echo $item['path']['detail'] ; ?>">
                            <img src="admin/<?php echo $item['url'] ; ?>">
                        </a>
                    </div>
                    <div class="post-content fl-left">
                        <a class="title"  href="<?php echo $item['path']['detail'] ; ?>"><?php echo $item['title'] ; ?></a>
                        <p class='excerpt'><?php echo $item['excerpt'] ; ?>...</p>
                        <div class="info">
                            <span class="create-date"><?php echo date('d/m/Y',$item['create_at']) ; ?></span>
                            <span class="view"><?php echo $item['view'] ; ?></span>
                        </div>
                    </div>
                </li>
                    <?php } } ?>

                <?php if(isset($product)){
                    foreach($product as $item ){
                ?>
                <li class="product">
                    <div class="thumb">
                        <a  href="<?php echo $item['path']['detail'] ; ?>">
                            <img src="<?php echo 'admin/'.$item['url'] ; ?>">
                        </a>
                    </div>
                    <div class="content">
                        <a  href="<?php echo $item['path']['detail'] ; ?>" class="name">Sony Xperia XA Ultra</a>
                        <div class="info clearfix">
                            <?php
                                            $new = empty($item['discount']) ? $item['price'] : $item['discount'] ;
                                            $old = !empty($item['discount']) ? $item['price'] : false  ; 
                                        ?>
                                        <span class="new"><?php echo currency_format($new) ; ?></span>
                                        <span class="old"><?php if($old){ echo currency_format($old);} ?></span>
                        </div>
                        <div class="action clearfix">
                                    <a href="<?php echo $item['path']['cart'] ; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="<?php echo $item['path']['cart'] ; ?>&checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                    </div>
                </li>
                <?php }} ?>
            </ul>
            <?php if( empty($post) && empty($product)){ ?>
                 <p id="data-empty">Không tìm thấy kết quả tìm kiếm nào </p>
            <?php } ?>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                     <?php 
                        if($paging['total'] > 1 ){
                            echo paging_basic($paging['total'],$paging['active'],array('class'=>'list-item clearfix','url_page'=>$paging['url_page'],'label_active'=>'active')) ;
                        }
                    ?>
                </div>
            </div>
        </div>
                  <div class="sidebar fl-left">
                <?php 
                    get_sidebar('menu'); 
                ?> 
                       <?php 
                    if(isset($list_discount)){
                ?>  
                    <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm khuyến mại</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php 
                                foreach($list_discount as $item ){ ?>
                            <li class="clearfix">
                                <a href="<?php echo $item['path']['detail'] ; ?>" title="" class="thumb fl-left">
                                    <img src="<?php echo 'admin/'.$item['url'] ; ?>" alt="">
                                </a>
                                <div class="info fl-right">
                                    <a href="<?php echo $item['path']['detail'] ; ?>" title="" class="product-name"><?php echo $item['name'] ; ?></a>
                                    <div class="price">
                                        <?php
                                            $new = empty($item['discount']) ? $item['price'] : $item['discount'] ;
                                            $old = !empty($item['discount']) ? $item['price'] : false  ; 
                                        ?>
                                        <span class="new"><?php echo currency_format($new) ; ?></span>
                                        <span class="old"><?php if($old){ echo currency_format($old);} ?></span>
                                    </div>
                                    <a href="<?php echo $item['path']['cart'].'&checkout' ; ?>" title="" class="buy-now">Mua ngay</a>
                                </div>
                            </li>
                                <?php } ?>
                        </ul>
                    </div>
                </div>
                <?php } ?> 
                <div class="section" id="banner-wp">
                    <div class="section-detail">
                        <a href="" title="" class="thumb">
                            <img src="public/images/banner.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php
    get_footer() ;
?>
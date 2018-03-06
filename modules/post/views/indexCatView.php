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
                        <a class="active" href="tin-tuc/<?php echo $post['slug']; ?>" title=""><?php echo $post['title'] ; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $post['title'] ; ?></h3>
                </div>
                <?php if(!empty($post['data'])){ ?>
                <div class="section-detail">
                    <ul class="list-item">
                        <?php foreach ($post['data'] as $item ){ ?>
                        <li class="clearfix">
                            <a href="<?php echo $item['path']['detail'] ; ?>" title="" class="thumb fl-left">
                                <img src="<?php echo 'admin/'.$item['url']; ?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="<?php echo $item['path']['detail'] ; ?>" title="" class="title"><?php echo $item['title'] ; ?></a>
                                <span class="create-date"><?php echo date('m/d/Y',$item['create_at']); ?></span>
                                <span class="view"><?php echo $item['view']; ?></span>
                                <span class="create-by"><?php echo $item['fullname'] ; ?></span>
                                <p class="desc"><?php echo $item['excerpt'] ; ?></p>
                            </div>
                           
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php }else{ ?>
                <p id="data-empty">Không tìm thấy sản phẩm nào</p>
                <?php } ?>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail">
                     <?php 
                        if($paging['total'] > 1 ){
                            echo paging_basic($paging['total'],$paging['active'],array('class'=>'list-item clearfix','url_page'=>$paging['url'],'label_active'=>'active')) ;
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
                <?php get_sidebar('menu') ; ?>
            <?php 
                    if(isset($list_favorite)){
                ?>  
                    <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php 
                                foreach($list_favorite as $item ){ ?>
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
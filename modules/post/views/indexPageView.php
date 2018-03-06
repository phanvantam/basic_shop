<?php get_header(); ?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a class="active" href="<?php echo $page['slug'].'.html'; ?>" title=""><?php echo $page['title'] ; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $page['title'] ; ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo date('d/m/Y - H:m:i',$page['create_at']) ; ?></span>
                    <div class="detail">
                        <?php echo $page['content'] ; ?>
                    </div>
                </div>
            </div>
        </div>
          <div class="sidebar fl-left">
                <?php 
                    get_sidebar('menu'); 
                ?> 
                     <?php 
                    if(isset($list_favorite)){
                ?>  
                    <div class="section" id="selling-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật </h3>
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
<?php get_footer(); ?>
<?php get_header() ; ?>

<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    
                    <li>
                        <a class="active" href="<?php echo $post['slug'].'-'.$post['post_id'].'.html' ; ?>" title=""><?php echo $post['title'] ; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $post['title'] ; ?></h3>
                </div>
                <div class="section-detail">
                      <span class="create-date"><?php echo date('m/d/Y',$post['create_at']); ?></span>
                      <span class="view"><?php echo $post['view']; ?></span>
                      <span class="create-by"><?php echo $post['fullname'] ; ?></span>
                    <div class="detail">
                        <p>
                            <img src="<?php echo 'admin/'.get_media_by_id($post['thumbnail'],'url') ; ?>">
                        </p>
                        <?php echo $post['content'] ; ?>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
            <div id="cmt-fb">
                <div class="fb-comments" data-href="<?php echo base_url().trim($_SERVER['REQUEST_URI'],'/') ; ?>" data-width="100%" data-numposts="5"></div>
            </div>
                </div>
            </div>
        </div>
         <div class="sidebar fl-left">
                <?php 
                    get_sidebar('menu') ;
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
<?php get_footer() ; ?>
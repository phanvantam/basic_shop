<?php get_header() ; ?>

<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo base_url(); ?>trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>san-pham/<?php echo $product['slug'].'-'.$product['product_id'].'.html'; ?>" class="active" title=""><?php echo $product['name'] ; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb">
                            <img id="zoom" src="<?php echo 'admin/'.get_media_by_id($product['thumb'],'url'); ?>" data-zoom-image="<?php echo 'admin/'.get_media_by_id($product['thumb'],'url'); ?>"/>
                        </a>
                        <div id="list-thumb">
                            <?php
                            if(!empty($product['img_involve'])){
                                $img_involve = implode(',',json_decode($product['img_involve']));
                                $list_img = db_fetch_array(" SELECT url FROM tbl_media WHERE media_id IN({$img_involve})") ;
                                foreach($list_img as $item ){
                            ?>
                            <a href="" data-image="<?php echo 'admin/'.$item['url']; ?>" data-zoom-image="<?php echo 'admin/'.$item['url']; ?>">
                                <img id="zoom" src="<?php echo 'admin/'.$item['url']; ?>" />
                            </a>
                                <?php }} ?>
                        </div>
                    </div>
                    <div class="thumb-respon-wp fl-left">
                        <img src="<?php echo 'admin/'.get_media_by_id($product['thumb'],'url'); ?>" alt="">
                    </div>
                    <div class="info fl-right">
                        <h3 class="product-name"><?php echo $product['name'] ; ?></h3>
                        <div class="desc">
                            <?php echo $product['info'] ; ?>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status"><?php if($product['total_product'] > 0) echo 'Còn hàng' ;else echo 'Hết hàng' ?></span>
                        </div>
                         <?php
                                            $new = empty($product['discount']) ? $product['price'] : $product['discount'] ;
                                            $old = !empty($product['discount']) ? $product['price'] : false  ; 
                                        ?>
                                        <span class="price"><?php echo currency_format($new) ; ?></span>
                                        <span class="old"><?php if($old){ echo currency_format($old);} ?></span>
                        <form method="post" action="?mod=product&controller=cart&action=add&id=<?php echo $product['product_id'] ; ?>">    
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="qty" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                            <button name="add" class="add-cart">Thêm giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Mô tả sản phẩm</h3>
                </div>
                <label for="show-depict" style="font-size: 17px;text-decoration: underline;">Xem bài viết :</label>
                <input type="checkbox" name="" id="show-depict">
                <div id="hide-depict" class="section-detail">
                    <?php echo $product['depict'] ; ?>
                </div>
            </div>
            
            <div id="cmt-fb">
                
                <div class="fb-comments" data-href="<?php echo base_url().$_SERVER['QUERY_STRING'] ; ?>" data-width="100%" data-numposts="5"></div>
            </div>
               
             <?php 
                    if(!empty($list_involve)){
                ?>
                 <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Cùng chuyên mục</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach ($list_involve as $item ){ ?>
                            <li>
                                <a href="<?php echo $item['path']['detail'] ; ?>" title="" class="thumb">
                                    <img src="<?php echo 'admin/'.$item['url'] ; ?>">
                                </a>
                                <a href="<?php echo $item['path']['detail'] ; ?>" title="" class="product-name"><?php echo $item['name'] ; ?></a>
                                <div class="price">
                                      <?php
                                            $new = empty($item['discount']) ? $item['price'] : $item['discount'] ;
                                            $old = !empty($item['discount']) ? $item['price'] : false  ; 
                                        ?>
                                        <span class="new"><?php echo currency_format($new) ; ?></span>
                                        <span class="old"><?php if($old){ echo currency_format($old);} ?></span>
                                </div>
                                <div class="action clearfix">
                                    <a href="<?php echo $item['path']['cart'] ; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="<?php echo $item['path']['cart'].'&checkout' ; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                 </div>
                            </li>
                        <?php } ?>
                        </ul>
                       
                    </div>
                </div>
                <?php } ?>
                
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

<?php get_footer() ; ?>
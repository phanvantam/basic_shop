<?php
    get_header() ;
?>
    <div id="main-content-wp" class="home-page clearfix">
        <div class="wp-inner">
            <div class="main-content fl-right">
                <div class="section" id="slider-wp">
                    <div class="section-detail">
                        <?php
                            $slider = get_slider() ;
                            if(!empty($slider)){
                                foreach ($slider as $item ){
                        ?>
                        <div class="item">
                            <img src="admin/<?php echo $item['url'] ; ?>" alt="">
                            <?php if(!empty($item['caption'])){
                               echo "<p class='caption'>{$item['caption']}</p>" ;
                            }
                            ?>

                        </div>
                        <?php }} ?>
                    </div>
                </div>
                <?php 
                    if(!empty($list_support)){    
                ?>
                <div class="section" id="support-wp" >
                    <div class="section-detail" id="support-wp" >
                        <ul class="list-item clearfix">
                            <?php foreach ($list_support as $item ){ 
                            ?>
                            <li style="margin: 0px auto ">
                                <div class="thumb">
                                    <a href="<?php echo $item['link'] ; ?>"><img src="<?php echo 'admin/'.$item['url'] ; ?>"></a>
                                </div>
                                <a href="<?php echo $item['link'] ; ?>"><h3 class="title"><?php echo $item['title'] ?></h3></a>
                                <p class="desc"><?php echo $item['depict'] ?></p>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                    <?php } ?>
                <?php 
                    if(!empty($list_favorite)){
                ?>
                 <div class="section" id="feature-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Sản phẩm nổi bật</h3>
                    </div>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php foreach ($list_favorite as $item ){ ?>
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
                
                <?php 
                   if(isset($product)){
                       foreach($product as $v ){
                ?>
                <div class="section" id="list-product-wp">
                    <div class="section-head">
                        <h3 class="section-title"><?php echo $v['title'] ; ?></h3>
                    </div>
                    <div class="section-detail">
                        <?php if(!empty($v['data'])){ ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($v['data'] as $item ){
                                  
                            ?>
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
                        <?php } ?>
                    </div>
                </div>
                    <?php } }?>
            </div>
            <div class="sidebar fl-left">
               <?php get_sidebar('menu'); ?>
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
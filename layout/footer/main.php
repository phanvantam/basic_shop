<div id="footer-wp">
    <div id="foot-body">
        <div class="wp-inner clearfix">
            <div class="block" id="info-company">
                <?php $info_sytem = get_info_sytem() ; ?>
                <h3 class="title"><?php echo $info_sytem['title'] ; ?></h3>
                <p class="desc"><?php echo $info_sytem['describe'] ; ?></p>
                <div id="payment">
                    <div class="thumb">
                        <img src="public/images/img-foot.png" alt="">
                    </div>
                </div>
            </div>
            <div class="block menu-ft" id="info-shop">
                <h3 class="title">Thông tin cửa hàng</h3>
                <ul class="list-item">
                    <li>
                        <p><?php echo $info_sytem['address'] ; ?></p>
                    </li>
                    <li>
                        <p><?php echo '0'.str_replace(',','.',number_format($info_sytem['tel'])) ; ?></p>
                    </li>
                    <li>
                        <p><?php echo $info_sytem['email'] ; ?></p>
                    </li>
                </ul>
            </div>
                <?php
                    $result = get_menu_footer() ;
                    if(!empty($result)){
                ?>        
            <div class="block menu-ft policy" id="info-shop">
                <h3 class="title"><?php echo $result['title'] ; ?></h3>
                <?php $result = db_fetch_array("SELECT * FROM tbl_menu WHERE parent_id = {$result['menu_id']} && active = 1 ORDER BY ordinal ASC ") ;?>
                <ul class="list-item">
                    <?php if(!empty($result)){
                        foreach($result as $item ){ 
                    ?>
                    <li>
                        <a href="<?php echo $item['link'] ; ?>" title=""><?php echo $item['title'] ; ?></a>
                    </li>
                    <?php }}?>
                </ul>
            </div>
                    <?php } ?>
            <div class="block" id="newfeed">
                <h3 class="title">Bảng tin</h3>
                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                <div id="form-reg">
                    <form method="POST" action="<?php echo base_url().'?mod=product&controller=subscribe&action=add' ;?>">
                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                        <button type="submit" class="add-subcribe" id="sm-reg">Đăng ký</button>
                       
                    </form>
                     <div id="notifice-subcribe"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="foot-bot">
        <div class="wp-inner">
            <p id="copyright">© Bản quyền thuộc về Vshop | Cung cấp bởi Vietsoz</p>
        </div>
    </div>
</div>
</div>

<div id="menu-respon">
    <a href="?page=home" title="" class="logo"><?php echo $info_sytem['title'] ; ?></a>
    <div id="menu-respon-wp">
        <?php
            $result = get_menu_respon() ;
            if(!empty($result)) {
                $result = show_ul_multi_data($result, 0, 1, array('name_id' => 'menu_id', 'id' => 'main-menu-respon', 'class' => 'sub-menu'));
                echo $result;
            }
        ?>
    </div>
</div>
<div id="btn-top"><img src="public/images/icon-to-top.png" alt=""/></div>
</div>
</body>
</html>
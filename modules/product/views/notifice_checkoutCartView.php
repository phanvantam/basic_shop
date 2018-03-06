<?php get_header(); ?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="gio-hang" title="">Giỏ hàng</a>
                    </li>
                    <li>
                        <a class="active" href="trang-chu.html" title=""> Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <p id="data-empty">Cảm ơn bạn đã tin tưởng và đặt hàng từ chúng tôi .<br />
            Chúng tôi đã gửi một email thông báo về đơn hàng đến  <a href="https://mail.google.com/"><?php if(!empty($email)) echo $email ;?></a> .
            <br />Bạn vui lòng truy cập email để <a href="https://mail.google.com/">xác nhận </a> đơn hàng . 
           

   
</div>
</div>

<?php get_footer(); ?>


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
                        <a class="active" href="trang-chu.html" title="">Xác nhận đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form  action="<?php echo base_url().'?mod=product&controller=subscribe&action=add' ;?>">
            <input type="hidden" name="email" value="<?php echo $info_buyer['email'] ; ?>">
            <p id="data-empty">Cảm ơn bạn đã tin tưởng và đặt hàng từ chúng tôi .<br />
            Vui lòng chờ chúng tôi xét duyệt và gửi hàng đến bạn .
            <br />Bạn hãy <a class="add-subcribe">click vào đây </a>để nhận thông tin ưu đãi sớm nhất từ chúng tôi .
        </form>   

   
</div>
    
</div>

<?php get_footer(); ?>


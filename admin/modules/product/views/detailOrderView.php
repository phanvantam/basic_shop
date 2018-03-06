<?php get_header(); ?>
<div id="main-content-wp" class="list-product-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=product&controller=order&action=index" title="" id="add-new" class="fl-left">Danh sách đơn hàng</a>
            <h3 id="index" class="fl-left">Đơn hàng</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="detail-exhibition fl-right">                       
            <div class="section" id="info">
                <div class="section-head">
                    <h3 class="section-title">Thông tin đơn hàng</h3>
                </div>
                <ul class="list-item">
                    <li>
                        <h3 class="title">Mã đơn hàng</h3>
                        <span class="detail"><?php echo $info_order['code_order']; ?></span>
                    </li>
                    <li>
                        <h3 class="title">Địa chỉ nhận hàng</h3>
                        <span class="detail"><?php echo $info_buyer['address'].' /sdt: '.$info_buyer['phone']; ?></span>
                    </li>
                    <li>
                        <h3 class="title">Thông tin vận chuyển</h3>
                        <span class="detail"><?php echo $info_order['payment_method'] != 'direct-pay' ? 'Thanh toán tại nhà ' : 'Thanh toán tại cửa hàng'; ?></span>
                    </li>
                
                </ul>
            </div>
            <div class="section">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm đơn hàng</h3>
                </div>
                <div class="table-responsive">
                    <table class="table info-exhibition">
                        <thead>
                            <tr>
                                <td class="thead-text">STT</td>
                                <td class="thead-text">Ảnh sản phẩm</td>
                                <td class="thead-text">Tên sản phẩm</td>
                                <td class="thead-text">Đơn giá</td>
                                <td class="thead-text">Số lượng</td>
                                <td class="thead-text">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detail_order as $item ){ 
                                    $stt = 0 ;
                                ?>
                                <tr>
                                    <td class="thead-text"><?php echo $stt+1 ; ?></td>
                                    <td class="thead-text">
                                        <div class="thumb">
                                            <img src="<?php echo $item['url'] ; ?>" alt="">
                                        </div>
                                    </td>
                                    <td class="thead-text"><?php echo $item['name'] ; ?></td>
                                    <td class="thead-text"><?php echo currency_format($item['price']) ; ?></td>
                                    <td class="thead-text"><?php echo $item['qty'] ; ?></td>
                                    <td class="thead-text"><?php echo currency_format($item['total_price']) ; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="section">
                <h3 class="section-title">Giá trị đơn hàng</h3>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <span class="total-fee">Tổng số lượng</span>
                            <span class="total">Tổng đơn hàng</span>
                        </li>
                        <li>
                            <span class="total-fee"><?php echo $info_order['total_qty'] ; ?> sản phẩm</span>
                            <span class="total"><?php echo currency_format($info_order['total_price']) ; ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
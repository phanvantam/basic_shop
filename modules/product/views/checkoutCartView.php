<?php get_header(); ?>
<div id="main-content-wp" class="checkout-page">
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
                        <a href="gio-hang/thanh-toan.html" class="active" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="" name="form-checkout">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" maxlength="100" name="fullname" value="<?php echo set_value('fullname'); ?>" id="fullname">
                            <p class="message"><?php echo get_error('fullname'); ?></p>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" value="<?php echo set_value('email'); ?>" maxlength="100"  name="email" id="email">
                            <p class="message"><?php echo get_error('email'); ?></p>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" maxlength="200" name="address" value="<?php echo set_value('address'); ?>" id="address">
                            <p class="message"><?php echo get_error('address'); ?></p>
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" maxlength="13" name="phone" value="<?php echo set_value('phone'); ?>" id="phone">
                            <p class="message"><?php echo get_error('phone'); ?></p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note"><?php echo set_value('phone'); ?></textarea>
                        </div>
                    </div>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cart['buy'] as $item ){ ?>
                            <tr class="cart-item">
                                <td class="product-name"><?php echo $item['name'] ; ?><strong class="product-quantity">x <?php echo $item['qty']; ?></strong></td>
                                <td class="product-total"><?php echo currency_format($item['sub_total']) ; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price"><?php echo currency_format($cart['info']['total']) ; ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <li>
                            <input type="radio" id="direct-payment" name="payment_method" <?php echo compare(set_value('payment_method'),'direct-payment', 'checked') ; ?> value="direct-payment">
                            <label for="direct-payment">Thanh toán tại cửa hàng</label>
                        </li>
                        <li>
                            <input type="radio" id="payment-home" name="payment_method"  <?php echo compare(set_value('payment_method'),'payment-home', 'checked') ; ?> value="payment-home">
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                    </ul>
                </div>
                <div class="place-order-wp clearfix">
                    <input type="submit" name="order_now" id="order-now" value="Đặt hàng" >
                </div>
            
            </div>
        </div>
        </form>
    </div>
</div>
<?php get_footer(); ?>
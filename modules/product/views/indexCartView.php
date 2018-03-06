<?php get_header() ; ?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="<?php echo base_url(); ?>trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a class="active" href="<?php echo base_url(); ?>gio-hang" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <?php 
                    
                    if($cart ){
                ?>
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <form method="post" action="?mod=product&controller=cart&action=update"> 
              
                <table class="table">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td colspan="2">Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $stt = 0 ;
                        foreach ($cart['buy'] as $item ){   
                            $stt++ ;
                        ?>
                        <tr>
                            <td><?php echo $stt ; ?></td>
                            <td>
                                <a href="san-pham/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>" title="" class="thumb">
                                    <img src="<?php echo 'admin/'. get_media_by_id($item['thumb'],'url') ; ?>" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="san-pham/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>" title="" class="name-product"><?php echo $item['name'] ; ?></a>
                            </td>
                            <td><?php echo currency_format($item['price']) ; ?></td>
                            <td>
                                <input type="number" min="0" name="qty[<?php echo $item['id'] ; ?>]" value="<?php echo $item['qty'] ; ?>" class="num-order">
                            </td>
                            <td><?php echo currency_format($item['sub_total']) ; ?></td>
                            <td>
                                <a href="?mod=product&controller=cart&action=drop&id=<?php echo $item['id']; ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($cart['info']['total']) ; ?></span></p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <div class="clearfix">
                                    <div class="fl-right">
                                        <button name='update' id="update-cart">Cập nhật giỏ hàng</button>
                                        <a href="<?php echo base_url().'gio-hang/thanh-toan.html'; ?>" title="" id="checkout-cart">Thanh toán</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </form> 
            </div>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="<?php echo base_url().'trang-chu.html'; ?>" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="?mod=product&controller=cart&action=drop&all" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
             <?php }else{?>
        <p id="data-empty">Bạn chưa thêm sản phẩm nào vào giỏ hàng <a href="<?php echo base_url().'trang-chu.html'; ?>" title="" id="buy-more"> Click vào đây để mua hàng </a><br/></p>
                    <?php } ?>
    </div>
</div>
<?php get_footer() ; ?>
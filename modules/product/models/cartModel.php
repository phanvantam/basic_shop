<?php 

// Thêm sản phẩm vào giỏ hàng
 function add_product_cart($info_product,$num_order){
     $id = $info_product['product_id'] ;
            $buy = array(
                           $id =>  array(  'id'=> $id ,
                                    'qty'=> $num_order ,
                                    'name'=>$info_product['name'],
                                    'price'=>$info_product['price'],
                                    'thumb'=>$info_product['thumb'],
                                    'slug'=>$info_product['slug'],
                                    'sub_total'=> $info_product['price'] * $num_order  
                                        )
                                 )
                    ;
            $cart = get_cart() ;
        if(!empty($cart)){
            if (array_key_exists($id,$cart['buy'])){
                $cart['buy'][$id]['qty'] += $num_order ;
                $cart['buy'][$id]['sub_total'] += $buy[$id]['sub_total'] ;
            }else{
                    $cart['buy'][$id] = $buy[$id];
                }
        }else{
                $cart['buy'] = $buy  ;     
            }
//        set_session(array('cart'=>$cart)) ;
            $_SESSION['cart'] = $cart ;
        update_info_cart() ;
}
// Đếm số sản phẩm trong giỏ hàng 
    function count_product_in_cart()
    {
        $cart = get_session('cart') ;
        if(!empty($cart['info']['qty']))
        {
            echo $cart['info']['qty'] ;
         }
     }

// Cập nhập laị sản phẩm trong giỏ hàng      
    function update_buy_cart($id,$num_order)
    {
        $cart = get_cart() ;
        if(!empty($cart))
        {
            if(array_key_exists($id,$cart['buy']))
            {
                $cart['buy'][$id]['qty'] = $num_order ;
                $cart['buy'][$id]['sub_total'] = $cart['buy'][$id]['price'] * $num_order  ;
            }
            set_session(array('cart'=>$cart)) ;
        }

    }
    
// Cập nhập thông tin giỏ hàng      
    function update_info_cart(){
        $cart = get_cart() ;  
        $total_qty = 0 ;
        $total_price = 0 ;    
        if(!empty($cart['buy'])){ 
            foreach ($cart['buy'] as $item){
                    $total_qty += $item['qty'] ;
                    $total_price += $item['sub_total'] ;
                }
        }
        $cart['info']['qty'] = $total_qty ;
        $cart['info']['total'] = $total_price ;
        set_session(array('cart'=>$cart)) ;
}

// Xóa sản phẩm trong giỏ hàng      
    function drop_product_in_cart_by_id($id){
        $cart = get_cart() ;
        if(!empty($cart)){
            if (array_key_exists($id,$cart['buy'])) {
                unset($cart['buy'][$id]) ;
                set_session(array('cart'=>$cart)) ;
                if( empty($cart['buy']) ){
                    unset($_SESSION['cart']) ;
                }    
                else{
                    update_info_cart(); 
                }    
            }
        }  
    }

// Thêm khách hàng đã thanh toán vào table customer 
    function add_customer($input){
        $data = get_colums_in_array(array('fullname','email','note','address','phone'),$input);
        $data['create_at'] = time() ;
        return db_insert('tbl_customer', $data);
    }
 
//  Ghi lại chi tiết đơn hàng 
    function add_detail_order($input,$id_order){
        $data = get_colums_in_array(array('name','qty','price'),$input);
        $data['total_price'] = $input['sub_total'] ;
        $data['connect_product'] = $input['id'] ;
        $data['order_id'] = $id_order ;
        db_insert('tbl_detail_order', $data);
    }
    
// Ghi lại đơn hàng 
    function add_order($id,$payment_method,$code){
        $result = get_cart() ;
        if($result){
            $data['total_price'] = $result['info']['total'] ;
            $data['total_qty'] = $result['info']['qty'] ;
            $data['buyer'] = $id ;
            $data['create_at'] = time() ;
            $max = db_fetch_row('SELECT MAX(order_id) as max FROM tbl_order ') ;
            $data['order_id'] = $max = $max['max'] + 1 ;
            $data['code_order'] = 'VSZ-'.$max ;
            $data['code_active'] = $code ;
            $data['payment_method'] = $payment_method ;
            $id_order = db_insert('tbl_order', $data);
            foreach($result['buy'] as $item ){
                add_detail_order($item,$id_order) ;
            }
            return $data['code_order'] ;
        }
    }

// Kiểm tra email này đã mua hàng lần nào chưa     
    function exits_email_in_db($email){
        $result = db_fetch_row(" SELECT customer_id FROM tbl_customer WHERE email = '{$email}' ");
        return $result['customer_id'] ;
    }

// Lấy thong tin đơn hàng theo mã xác nhận     
    function get_order_by_code($code){
        return db_fetch_row(" SELECT * FROM tbl_order WHERE code_active = '{$code}' ");
    }
    
    function update_customer($input,$id){
        $data = get_colums_in_array(array('fullname','note','address','phone'),$input);
        $data['create_at'] = time() ;
        $data['buy'] = 0 ;
        db_update('tbl_customer', $data," customer_id = {$id}");
    }
    
    function content_message_order($info,$cart){
        $info_product = null ;
        foreach ($cart['buy'] as $item ){
	    $info_product = $info_product.'<tr style="background-color: #dedede ;"><td style="padding: 10px 0px ;">' .$item['name']. '</td><td style="padding: 10px 0px ;">' .$item['qty']. '</td><td style="padding: 10px 0px ;">' . currency_format($item['price']).'</td><td style="padding: 10px 0px ;">' . currency_format($item['sub_total']). '</td></tr>' ;  
        }
        $info['payment_method'] = $info['payment_method'] == 'direct-payment' ? 'Thanh toán tại cửa hàng' : 'Thanh toán tại nhà ' ;
	return $content = '<p>Có phải bạn vừa đặt hàng từ chúng tôi ? <br />Nếu phải bạn vui lòng <a href="'. base_url().'gio-hang/xac-nhan.html?code='.$info['code_active'].'"> click vào đây </a>để xác nhận đơn hàng .<br />Nếu không bạn có thể bỏ qua mail này .'.	
                '<div style="width : 80% ; height: auto ;margin: 0px auto ;">
				<h1 style="text-align: center; font-size: 22px ;padding: 20px ;"> THÔNG TIN ĐƠN HÀNG </h1>
				<p style="font-size: 20px ;padding: 10px ;color:black ;">THÔNG TIN KHÁCH HÀNG</p>
				<table style="font-size: 16px ;padding: 5px ;width: 100% ;margin-left: 20px ;">
                                <tr>
						<td> Mã đơn hàng : </td>
						<td>' .$info['code_order']. '</td>
					</tr>
					<tr>
						<td> Tên </td>
						<td>' .$info['fullname']. '</td>
					</tr>
					<tr>
						<td>Số điện thoại </td>
						<td>' .$info['phone']. '</td>
					</tr>
					<tr>
						<td>Email </td>
						<td>' .$info['email']. '</td>
					</tr>
					<tr>
						<td>Địa chỉ </td>
						<td>' .$info['address']. '</td>
					</tr>
				</table>
				<p style="font-size:20px ;color: black ;padding: 10px ;">CHI TIẾT SẢN PHẨM</p>
				<table  style="font-size: 16px ;padding: 5px ;width: 100% ;margin:0px auto  ;text-align: center ;">
					<tr>
						<th> Sản phẩm  </th>
						<th> Số lượng  </th>
						<th> Gía tiền(VNĐ) </th>
						<th> Tổng cộng(VNĐ) </th>
					</tr>' .$info_product. 
					 
				'</table>
<div  style="font-size: 17px ;padding: 10px 10px ;width: 100% ;clear: both;margin: 10px  0px;border-top: 1px solid black ;">
						<p style="float: left ;display: inline-block;">Thông tin đơn hàng </p>
						<p style="float: right ;">' . currency_format($cart['info']['total']). '</p>
					</div>
<div  style="font-size: 17px ;padding: 10px 10px ;width: 100% ;clear: both;margin: 10px  0px;border-top: 1px solid black ;">
				<b style="float: left ;display: inline-block;"> Hình thức thanh toán </b>
						<p style="float: right ;">'.$info['payment_method'].'</p>
					</div>
<div  style="background-color:#ffd7d7 ;height:30px ;border-top: 1px solid black ;font-size: 17px ;padding:10px 10px ;width: 100% ;clear: both;margin: 10px  0px  ;">

						<b style="float: left ;display: inline-block;"> Tổng tiền đã thanh toán </b>
						<p style="float: right ;"> 0 đ </p>
					</div><p style="font-size: 20px ;padding: 10px ;color:black ;">Gi Chú Đơn Hàng </p>
					<p style="line-height: 30px ;font-size: 17px ;padding: 5px 10px ;color: #585858;">
                                '.$info['note'].'
					</p>
			</div>';
    }
    
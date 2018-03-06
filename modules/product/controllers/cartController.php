<?php

function construct(){
    load_model('cart') ;
    load_model('index') ;

}

function addAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $qty = 1 ;
    if(isset($_POST['add'])){
        $qty = $_POST['qty'] > 1 ? (int)$_POST['qty'] : 1 ;
    }
    $info_product = get_product_by_id($id) ;
    !empty($info_product) || redirect(base_url().'trang-chu.html') ; ;
    $info_product['price'] = empty($info_product['discount']) ? $info_product['price'] : $info_product['discount'] ;
    add_product_cart($info_product,$qty);
    if(isset($_GET['checkout']))
        redirect('gio-hang/thanh-toan.html') ;
    else
        redirect('gio-hang') ;   
}

function indexAction(){
    $data['cart'] = get_cart();
    load_view('indexCart',$data) ;
}

function updateAction(){
    if(isset($_POST['update'])){
        $data = $_POST['qty'] ;
        if(count($data) > 0 ){
            foreach ($data as $id => $qty ){
                if($qty < 1 )
                    drop_product_in_cart_by_id ($id) ;
                else{
                    update_buy_cart($id, $qty) ;
                    update_info_cart() ;
                }    
            }
            
        }
    }
    redirect ('gio-hang');
}

function dropAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    drop_product_in_cart_by_id($id) ;
    if(isset($_GET['all']))
        unset($_SESSION['cart']) ;
    redirect ('gio-hang');
}

function checkoutAction(){
    $data['cart'] = get_cart();
    !empty($data['cart'])|| redirect (base_url().'trang-chu.html');
    global $request,$error ;
    $request['payment_method'] = 'direct-payment' ;
    if(isset($_POST['order_now'])){
        $request = $_POST ;
        if(empty($request['fullname'])){
            $error['fullname'] = 'Không được để trống trường này ';
        }
        if(empty($request['address'])){
            $error['address'] = 'Không được để trống trường này ';
        }
        if(!check_tel($request['phone'])){
            $error['phone'] = 'Số điện thoại không hợp lệ ';
        }
        if(!check_email($request['email'])){
            $error['email'] = 'Email vưa nhập không hợp lệ ';
        }
        if(!isset($request['payment_method'])){
            $error['payment_method'] = 'Vui lòng chọn hình thức thanh toán ';
        }
        if(empty($error)){
            $cart = get_cart() ;
            if(!empty($cart)){
                $id_customer = exits_email_in_db($request['email']) ;
                if(!empty($id_customer)){
                    update_customer($request,$id_customer);
                }else{
                    $id_customer = add_customer($request);
                }
                $request['code_active'] = $code_active = md5($request['email'].time()) ;
                $request['code_order'] = add_order($id_customer,$request['payment_method'],$code_active);
                global  $config ;
                $recipie['email'] = $request['email'] ;
                $recipie['name'] = $request['fullname'];
                $content = content_message_order($request, $cart) ;
                $v['content'] = $content ;
                $v['title'] = 'Đặt hàng thành công ';
                unset($_SESSION['cart']) ;
                send_mail($v, $recipie, $config['email']) ;
                $_SESSION['order']['email'] = $request['email'] ;
                redirect(base_url().'gio-hang/thong-bao.html');
            }else{
                redirect('gio-hang') ;
            }    
        }
    }
    load_view('checkoutCart',$data) ;
}

function notifice_checkoutAction(){  
    $result = get_session('email','order') ;
    !empty($result['email']) || redirect(base_url().'trang-chu.html') ;
    unset($_SESSION['order']) ;
    $data['email'] = $result['email'] ;
    load_view('notifice_checkoutCart',$data) ;
}

function confirm_orderAction(){
    $code = isset($_GET['code']) ? (string)$_GET['code'] : '' ;
    $info_oreder = get_order_by_code($code) ;
    !empty($info_oreder) || redirect(base_url().'trang-chu.html') ;
    db_update('tbl_order',array('active'=>2,'code_active'=>'')," order_id = {$info_oreder['order_id']}") ;
    db_update('tbl_customer',array('buy'=>1), " customer_id = {$info_oreder['buyer']} ");
    $data['info_buyer'] = get_customer_by_id($info_oreder['buyer']) ;
    load_view('confirm_orderCart',$data);
}

function get_customer_by_id($id){
    return db_fetch_row(" SELECT * FROM tbl_customer WHERE customer_id = {$id}") ;
}

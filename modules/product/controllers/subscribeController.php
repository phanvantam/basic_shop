<?php

function construct(){
    load_model('subscribe') ;
}

function addAction(){
if(!empty($_POST['email'])){
    $email = $_POST['email'] ;
    if(check_email($email)){
        global $config ;
        $code_active = md5($email.time()) ;
        $recipie['email'] = $email ;
        $recipie['name'] = '';
        $content['title'] =' Nhận thông báo ';
        $content['content'] = '<p>Có phải bạn yêu cầu nhận thông báo ưu đãi của chúng tôi <p><p>Nếu phải bạn hãy <a href="'.base_url().'theo-doi/xac-nhan.html'.'?code='.$code_active .'">click vào đây</a> để xác nhận .</p><p>Nếu không hãy bỏ qua enail này .</p>';
               
        $info_customer = get_customer_by_email($email) ;
        $notifice = array() ;

        if(empty($info_customer)){
            send_mail($content, $recipie, $config['email']) ;
            add_customer_subscribe($email,$code_active);
            $notifice['content'] = "Chúng tôi đã gửi một mã xác nhận đến <a href='https://mail.google.com/'>{$email}</a>.<br />Ban vui lòng truy cập <a href='https://mail.google.com/'>hộp thư để xác nhận </a>đó là bạn .<br />Cảm ơn bạn đã quan tâm ";
        }else{
            if($info_customer['subcribe'] == 1 ){
                $notifice['content'] = "Email {$email} đã được đăng ký trước đó";
            }elseif ($info_customer['buy'] == 1 ) {
                 update_customer_subscribe($info_customer['customer_id'],$code_active) ;
                 $notifice['redirect'] = base_url().'theo-doi/xac-nhan.html'.'?code='.$code_active ;
            } elseif ($info_customer['subcribe'] == 2 ) {
                update_customer_subscribe($info_customer['customer_id'],$code_active) ;
                send_mail($content, $recipie, $config['email']) ;
                $notifice['content'] = "Chúng tôi đã gửi một mã xác nhận đến {$email}.Ban vui lòng truy cập hộp thư để xác nhận đó là bạn .Cảm ơn bạn đã quan tâm ";
            }else{
                update_customer_subscribe($info_customer['customer_id'],$code_active) ;
                send_mail($content, $recipie, $config['email']) ;
                $notifice['content'] = "Chúng tôi đã gửi một mã xác nhận đến email: {$email}Ban vui lòng truy cập hộp thư để xác nhận đó là bạn .Cảm ơn bạn đã quan tâm ";
            }
        }
    }else 
        $notifice['content'] = 'Emai không hợp lệ vui lòng nhập lại .' ;
 }else 
     $notifice['content'] = 'Vui lòng nhập email.' ;
    echo json_encode($notifice);
}

function confirm_subcribeAction(){
    $code = isset($_GET['code']) ? (string)$_GET['code'] : '' ;
    $result = exists_code($code) ;
    !empty($result) || redirect(base_url().'trang-chu.html') ;
    actived_customer_subscribe($result['customer_id']) ;
    load_view('confirmSubscribe',array('email'=>$result['email'])) ;
}
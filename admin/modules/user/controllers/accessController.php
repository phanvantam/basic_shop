<?php
function construct(){
    load_model('access') ;
}

// Xử lý đăng nhập 
function indexAction(){
    if(isset($_POST['login'])){
        global $error ,$request ;
        $request['email'] = isset($_POST['email']) ? (string)$_POST['email'] : null  ;
        $request['password'] = isset($_POST['password']) ? (string)$_POST['password'] : null ;
        if(empty($request['email'])){
            $error['email'] = 'vui lòng nhập tên hoặc email ' ;
        }
        elseif (!check_email($request['email']) ) {
            $error['email'] = 'Email không đúng định dạng ';
        }

        if(empty($request['password'])) {
            $error['password'] = 'vui lòng nhập mật khẩu  ';
        }
        elseif (!check_pass($request['password'])){
            $error['password'] = 'Mật khẩu không hợp lệ ' ;
        }

        if(empty($error)){
            $result = login($request['email'], $request['password']) ;
            if(!empty($result)) {
                if ($_POST['remember']) {
                    setcookie('email', $request['email'], time() + 3600);
                    setcookie('password', $request['password'], time() + 3600);
                } else {
                    drop_cookie(array('email', 'password'));
                }
                if((int)$result['active'] !== 1){
                    $error['login'] = 'Tai khoan chua duoc kich hoat ' ;
                }else{
                    $login = array('id'=>$result['user_id'],'name'=>$result['fullname'],'level'=>$result['level']) ;
                    set_session($login,'info') ;
                    $data_history['type'] = 'login' ;
                    $data_history['parent_id'] = 0 ;
                    add_history($data_history);
                    redirect('?');
                }
            }else{
                $error['login'] = 'Thông tin đăng nhập không chính xác ' ;
            }
        }
    }
    load_view('indexAccess') ;
}

function logoutAction(){
    drop_session('info',null);
    redirect('?mod=user&controller=access&action=index');
}

function reset_passAction(){
    if(isset($_GET['code'])){
        $code = empty($_GET['code']) ? null : (string)$_GET['code'] ;
        $email = empty($_GET['email']) ? null : (string)$_GET['email'] ;
        $id = exists_email_in_db($email) ;
        $error = false ;
        if((bool)$id){
            $code_time = exists_code_confirm('reset_pass', $id, $code) ;
            if(!empty($code_time)){
                if (($code_time + 3600 * 24) > time()) {
                    $error = true ;
                }
            }
        }
        if(!$error){
            redirect(base_url());
        }
    }
    elseif(isset($_POST['set_code'])){
        global $error ,$request;
        $request['email'] = isset($_POST['email']) ? (string)$_POST['email'] : null ;
        if (empty($request['email'])) {
            $error['email'] = 'Vui lòng nhập email';
        } elseif (!check_email($request['email'])) {
            $error['email'] = 'Email không hợp lệ ';
        }
        if (empty($error)) {
            $result = set_code_reset_pass($request['email']);
            if ($result) {
                global $config;
                load_helper('mail');
                $data['title'] = 'Lấy lại mật khẩu ';
                set_notifice_session(create_notifice('Chúng tôi đã gửi một mail tới '.$request['email'].'.Bạn vui lòng truy cập email để đặt lại mật khẩu mới ')) ;
                $link = base_url() . "?mod=user&controller=access&action=reset_pass&code=" . $result.'&email='.$request['email'] ;
                $data['content'] = 'Chúng tôi nhận được một yêu cầu lấy lại mật khẩu từ ' . $request['email'] . " nếu là bạn hãy <br /> Click vào link : <a href='{$link}'>{$link}</a>" . ' <br /> Nếu không hãy bỏ qua email này ';
                send_mail($data, array('email' => $request['email'], 'name' => null), $config['email']);
            } else {
                $error['email'] = 'Email không đúng ';
            }
        }
    }

    if (isset($_POST['reset'])) {
        global $error, $request ;
        $request['pass_new'] = isset($_POST['pass_new']) ? (string)$_POST['pass_new'] : null ;
        $request['confirm_pass'] = isset($_POST['confirm_pass']) ? (string)$_POST['confirm_pass'] : null ;
        $email = $_GET['email']  ;
        if(empty($request['pass_new'])){
            $error['pass_new'] = 'Vui lòng nhập mật khẩu mới ' ;
        }
        elseif (!check_pass($request['pass_new'])){
            $error['pass_new'] = 'Mật khẩu không hợp lệ ' ;
        }

        elseif(empty($request['confirm_pass'])){
            $error['confirm_pass'] = 'Vui lòng nhập mật khẩu mới ' ;
        }
        elseif ( !($request['confirm_pass'] === $request['pass_new']) ){
            $error['confirm_pass'] = 'Mật khẩu không khớp ' ;
        }
        if (empty($error)){
            reset_pass($request['pass_new'],$email) ;
            set_notifice_session(create_notifice('Mật khẩu của bạn đã được thay đổi thành công ')) ;
            redirect('?mod=user&controller=access&action=index');
            die();
        }
    }
    load_view('reset_passAccess') ;
}
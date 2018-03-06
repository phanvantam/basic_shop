<?php
function construct(){
    load_model('index') ;
}

function indexAction(){
    global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 2 ;
    
    switch($type){
        case 'lock':
            $result = get_user_locker($q,$page,$per_page) ;
            break ;
        case 'active':
            $result = get_user_active($q,$page,$per_page) ;
            break ;    
        default :
            $result = get_all_user($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_user'] = $result ;
    $data['list_status'] = get_list_status_of_user() ;
//    show_array($data) ;exit ;
    load_view('indexIndex',$data) ;
}



function change_passAction(){
     if(isset($_POST['update_pass'])) {
         global $error,$request,$notifice ;
         $request = get_colums_in_array(array('pass_old','pass_new','confirm_pass'),$_POST);
         $info_user = get_info_user_by_id(get_info_user('id')) ;
         if (empty($request['pass_old'])) {
             $error['pass_old'] = 'Không được để trống trường này  ';
         }
         elseif ( md5($request['pass_old'].$info_user['salt']) != $info_user['password'] ) {
             $error['pass_old'] = 'Mật khẩu không đúng';
         }

         if (empty($request['pass_new'])) {
             $error['pass_new'] = ' Không được để trống trường này ';
         }
         elseif (!check_pass($request['pass_new'])) {
             $error['pass_new'] = 'Mật khẩu không hợp lệ ';
         }

         elseif (empty($request['confirm_pass']) ){
             $error['confirm_pass'] = 'Không được để trống trường này  ';
         }
         elseif ($request['confirm_pass'] !== $request['pass_new']){
             $error['confirm_pass'] = 'Mật khẩu không khớp ';
         }
        if (empty($error)) {
            update_pass($request['pass_new'], get_info_user('id'));
            $notifice['update_pass'] = 'Thay đổi mật khẩu thành công ' ;
        }
     }
    load_view('change_passIndex') ;
}

/**
 *
 */
function update_infoAction(){
    global $error ,$notifice ,$request ;
    $id = get_info_user('id') ;
    $request = $info_user = get_info_user_by_id($id) ;
    if(isset($_POST['update_info'])){
        
        $request['fullname'] = isset($_POST['fullname']) ? filter_str($_POST['fullname']) : null ;
        if(empty($request['fullname']) ){
            $error['fullname'] = 'Không được để trống trường này ' ;
        }
        $request['facebook'] = isset($_POST['facebook']) ? $_POST['facebook'] : null ;
        $request['tel'] = isset($_POST['tel']) ? $_POST['tel'] : null ;
        if(!check_tel($request['tel']) && !empty($request['tel'])){
            $error['tel'] = 'Số điện thoại không hợp lệ ' ;
        }
        $request['address'] = isset($_POST['address']) ? $_POST['address'] : null ;
        if(empty($error)){
            $img_id = isset($_POST['img_id']) ? (int)$_POST['img_id'] : 0 ;
            $info_media = get_media_by_id($img_id) ;
            if( $info_media && $info_media['type'] == 1 && $info_media['active'] == 2 ){
                activate_media($request['fullname'],$id,$img_id) ;
                $id_media_drop = get_info_user_by_id($id,'avatar') ;
                $data['avatar'] = $img_id ;
                db_update('tbl_user',$data," user_id = {$id}") ;
                if(!empty($id_media_drop)){
                    drop_media_by_id($id_media_drop,true) ;
                }
            }

            $data['fullname'] = $request['fullname'] ;
            $data['facebook'] = $request['facebook'] ;
            $data['tel'] = $request['tel'] ;
            $data['address'] = $request['address'] ;
            $data['modify_at'] = time() ;
            $where = " `user_id` = {$id}";
            db_update('tbl_user',$data,$where) ;
            $_SESSION['info']['name'] = $request['fullname'] ;
            $notifice['update_info'] = 'Cập nhập thông tin thành công ' ;
        }
    }
    $data['info_user'] = get_colums_in_array(array('modify_at','create_at'),$info_user);
    $avatar_id = empty($info_user['avatar']) ? get_media_default('media_id',1) : $info_user['avatar'] ;
    $request['avatar'] = get_media_by_id($avatar_id,'url') ;
    load_view('update_infoIndex',$data) ;
}

function add_userAction(){
    if(isset($_POST['add_user'])){
//        show_array($_POST) ;
        global $error, $request ,$notifice;
        $request['fullname'] = isset($_POST['fullname']) ? filter_str($_POST['fullname']) : null ;
        if(empty($request['fullname'])){
            $error['fullname'] = 'Không được để trống trường này' ;
        }
        elseif (strlen($request['fullname']) > 100 ){
            $error['fullname'] = 'Tên này quá dài vui long chọn tên khác' ;
        }

        $request['email'] = isset($_POST['email']) ? (string)$_POST['email'] : null ;
        if(empty($request['fullname'])){
            $error['email'] = 'Không được để trống trường này' ;
        }
        elseif (!check_email($request['email'])){
            $error['email'] = 'Email không hợp lệ ' ;
        }
        elseif (exists_email_in_db($request['email'])){
            $error['email'] = 'Emai đã tồn tại ' ;
        }

        $request['pass'] = isset($_POST['pass']) ? (string)$_POST['pass'] : null ;
        $request['confirm_pass'] = isset($_POST['confirm_pass']) ? (string)$_POST['confirm_pass'] : null ;
        if (empty($request['pass'])) {
            $error['pass'] = ' Không được để trống trường này ';
        }
        elseif (!check_pass($request['pass'])) {
            $error['pass'] = 'Mật khẩu không hợp lệ ';
        }

        elseif (empty($request['confirm_pass']) ){
            $error['confirm_pass'] = 'Không được để trống trường này  ';
        }
        elseif ($request['confirm_pass'] !== $request['pass']){
            $error['confirm_pass'] = 'Mật khẩu không khớp ';
        }

        $request['level'] = isset($_POST['level']) ? (int)$_POST['level'] : null ;
        if($request['level'] < 2 || $request['level'] > 3 ){
            $error['level'] = 'Vui lòng chọn cấp độ truy cập' ;
        }
        if(empty($error)){
            $request['salt'] = md5($request['email'].time()) ;
            add_user($request, get_info_user('id')) ;
            redirect('?mod=user&controller=index&action=index');
        }
    }
    load_view('add_userIndex');
}

function show_infoAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_user = get_info_user_by_id($id) ;
    ( $info_user && $id != get_info_user('id') ) || die('User không tồn tại') ;
    if(empty($info_user['avatar'])){
        $info_user['avatar'] = get_media_default('media_id',1) ;
    }
    $info_user['avatar'] = !empty($info_user['avatar']) ? get_media_by_id($info_user['avatar'],'url') : get_media_default('url',1);
    load_view('show_infoIndex',array('info_user'=>$info_user)) ;
}

function editAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_user = get_info_user_by_id($id) ;
    ( $info_user && $id != get_info_user('id') ) || die('User không tồn tại') ;
    global $request ;
    $request = get_colums_in_array(array('fullname','email'),$info_user) ;
    $data['active'] = $info_user['level'] ;
    if(isset($_POST['edit_user'])){
//        show_array($_POST) ;
        global $error ,$notifice;
        $request['fullname'] = isset($_POST['fullname']) ? filter_str($_POST['fullname']) : null ;
        if(empty($request['fullname'])){
            $error['fullname'] = 'Không được để trống trường này' ;
        }
        elseif (strlen($request['fullname']) > 100 ){
            $error['fullname'] = 'Tên này quá dài vui long chọn tên khác' ;
        }

        $request['email'] = isset($_POST['email']) ? (string)$_POST['email'] : null ;
        if(empty($request['fullname'])){
            $error['email'] = 'Không được để trống trường này' ;
        }
        elseif (!check_email($request['email'])){
            $error['email'] = 'Email không hợp lệ ' ;
        }
        elseif (exists_email_in_db($request['email'])){
            $error['email'] = 'Emai đã tồn tại ' ;
        }
        if($request['email'] === $info_user['email']){
            unset($error['email']) ;
        }else{
            $info_user['salt'] = md5($request['email'].time()) ;
        }

        $request['pass'] = isset($_POST['pass']) ? (string)$_POST['pass'] : null ;
        if ( !empty($request['pass'])){
            $request['confirm_pass'] = isset($_POST['confirm_pass']) ? (string)$_POST['confirm_pass'] : null ;
            if(!check_pass($request['pass'])) {
                $error['pass'] = 'Mật khẩu không hợp lệ ';
            }
            elseif ($request['pass'] !== $request['confirm_pass']){
                $error['confirm_pass'] = 'Mật khẩu không khớp ';
            }
            else{
                $info_user['password'] = md5($request['pass'].$info_user['salt']) ;
            }
        }
        $request['level'] = isset($_POST['level']) ? (int)$_POST['level'] : null ;
        if($request['level'] < 2 || $request['level'] > 3 ){
            $error['level'] = 'Vui lòng chọn cấp độ truy cập' ;
        }else{
            $info_user['level'] = $request['level'] ;
        }
        if(empty($error)){
            $info_user['email'] = $request['email'] ;
            update_user($info_user) ;
            $notifice['edit_user'] = 'Thay đổi thông tin gười dùng thành công' ;
            $data['active'] = $info_user['level'] ;
        }
    }
    load_view('editIndex', $data) ;
}

function actionsAction(){
    $id[] = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $type = null ;
    if(isset($_POST['sm_action'])){
        $id = isset($_POST['id']) ? $_POST['id'] : $id ;
        $type = isset($_POST['actions']) ? $_POST['actions'] : $type ;
    }
    $id = implode(',',$id) ;
    if(isset($_GET['lock']) || $type == 'lock' ){
        lock_user($id);
    }
    elseif (isset($_GET['unlock']) || $type == 'unlock' ){
        unlock_user($id) ;
    }
    elseif (isset($_GET['drop']) || $type == 'drop' ){
        if(isset($_GET['type'])){
            $id = $_SESSION['drop']['id'] ;
            drop_user($id,$_GET['type']) ;
        }else{
            $_SESSION['drop']['id'] = $id ;
            $content = "Xóa người dùng và toàn bộ dữ liệu .<a href='?mod=user&controller=index&action=actions&type=all&drop'>Xác nhận </a><br /><br />Xóa người dùng và chuyển toàn bộ dữ liệu cho Admin <a href='?mod=user&controller=index&action=actions&type=move&drop'>. Xác nhận</a> ";
            set_notifice_session(create_notifice($content)) ;
        }
    }
    redirect('?mod=user&controller=index&action=index') ;
}
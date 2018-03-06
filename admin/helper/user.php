<?php

#Chức năng : Lấy thông tin của user từ Session 
#$k : Phần tử muốn chả về 
function get_info_user($k=null){
    $v = get_session('info');
    $v = $v['info'] ;
    if (key_exists($k,$v)){
        return $v[$k] ;
    }
    return $v ;
}

#chức năng : Lấy thông tin user theo id từ Database 
#$id : Id của người dùng 
#$index : Phần tử muốn chả về nếu có
function get_info_user_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_user` WHERE `user_id` = {$id} ") ;
    if(empty($result)){
        return false ;
    }
    if(empty($index)){
        return $result ;
    }else{
        if(key_exists($index, $result )){
            return $result[$index] ;
        }else{
            return false ;
        }
    }
}

#Chức năng : Kiểm tra email có tồn tại trong bảng user ko 
#$email : Biến email cần kiểm tra 
function exists_email_in_db($email){
    $sql = "SELECT user_id FROM `tbl_user` WHERE `email` = '{$email}' " ;
    $result = db_fetch_row($sql) ;
    if( (bool)$result){
        return $result['user_id'] ;
    }
    return false ;
}

#chức năng : Cập nhập lại code xác nhận trong table user 
#$k : Chỉ mục cần update 
#$v : Gía trị mới 
#$id : Id của người dùng 
function update_code_confirm($k,$v,$id){
    $data = array() ;
    $result = get_info_user_by_id($id,'code_confirm') ;
    $code_confirm = json_decode($result,true) ;
    $code_confirm[$k] = $v ;
    $data['code_confirm'] = json_encode($code_confirm) ;
    $where = " user_id  = {$id} " ;
    db_update('tbl_user',$data,$where) ;
}

#chức năng : Lấy code xác nhận trong table user 
#$k : Chỉ mục cần lấy
#$id : Id của người dùng 
function get_code_confirm($k, $id){
    $result = get_info_user_by_id($id,'code_confirm') ;
    $code_confirm = json_decode($result,true) ;
    if (key_exists($k, $code_confirm)){
        return $code_confirm[$k] ;
    }
    return false ;
}

#chức năng : Xóa code xác nhận trong table user 
#$k : Chỉ mục cần xóa
#$id : Id của người dùng 
function drop_code_confirm($k,$id){
    $data = array() ;
    $result = get_info_user_by_id($id,'code_confirm') ;
    $code_confirm = json_decode($result,true) ;
    unset($code_confirm[$k] ) ;
    $data['code_confirm'] = json_encode($code_confirm) ;
    $where = " user_id  = {$id} " ;
    db_update('tbl_user',$data,$where) ;
}

#chức năng : Kiểm tra code xác nhận trong table user có tồn tại ko 
#$k : Chỉ mục cần kiểm tra 
#$id : Id của người dùng
#$code : Gía trị so sánh 
function exists_code_confirm($k, $id, $code){
        $code_action = get_code_confirm($k, $id);
        if (!empty($code_action)) {
            if ($code_action['code'] === $code) {
                return $code_action['time'] ;
            }
        }
    return null ;
}

# Lấy avatar của user phiên hiện tại 
function get_avatar_user(){
    $result = get_info_user_by_id(get_info_user('id'),'avatar') ;
    $avatar_id = empty($result) ? get_media_default('media_id',1) : (int)$result ;
    return get_media_by_id($avatar_id,'url') ;
}
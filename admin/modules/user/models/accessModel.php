<?php
function login($email, $password){
    $sql = "SELECT `salt`,`user_id` FROM `tbl_user` WHERE `email` = '{$email}' " ;
    $result = db_fetch_row($sql) ;
   
    if(!empty($result)){
        $password = md5($password . $result['salt']) ;
        $sql = "SELECT `user_id`,`fullname`,`active`,`level` FROM `tbl_user` WHERE `user_id` = {$result['user_id']} && `password` = '{$password}' " ;
        $result = db_fetch_row($sql) ; 
        if(!empty($result)){
            return $result ;
        }
    }
    return false ;
}

function set_code_reset_pass($email){
    $result = db_fetch_row("SELECT `user_id`,`salt`,`password` FROM `tbl_user` WHERE `email` = '{$email}' ") ;
    if(!empty($result)){
        $code_change_pass = $result['salt'].$email.time().$result['password'] ;
        $data['code'] = md5($code_change_pass) ;
        $data['time'] = time() ;
        update_code_confirm('reset_pass' ,$data,$result['user_id']) ;
        return md5($code_change_pass) ;
    }
    return false ;
}

function exists_code_reset_pass($code, $email){
    $result = db_fetch_row("SELECT `user_id` FROM `tbl_user` WHERE `email` = '{$email}' ") ;
    if((bool)$result){
        return true ;
    }
    return false ;
}

function reset_pass($pass,$email){
    $result = db_fetch_row("SELECT `salt`,`user_id` FROM `tbl_user` WHERE `email` = '{$email}' ") ;
    drop_code_confirm('reset_pass',$result['user_id']) ;
    $data['password'] = md5($pass.$result['salt']) ;
    $where = " `email` = '{$email}' " ;
    db_update('tbl_user',$data,$where) ;
}
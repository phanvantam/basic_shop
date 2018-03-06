<?php
function update_pass($pass,$id){
    $result = db_fetch_row("SELECT `salt` FROM `tbl_user` WHERE `user_id` = '{$id}' ") ;
    $data['password'] = md5($pass.$result['salt']) ;
    $where = " `user_id` = '{$id}' " ;
    db_update('tbl_user',$data,$where) ;
}

function get_user_active($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_user WHERE level != 1 && active = 1 " ;
    if ((bool)$q)
        $sql .= "&& (`fullname` LIKE '%{$q}%' || `email` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY user_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_user($sql) ;
    return $result ;
}

function add_url_into_list_user($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['url']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['user_id'].'&drop' ;
        $item['url']['unlock'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['user_id'].'&unlock' ;
        $item['url']['lock'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['user_id'].'&lock' ;
        $item['url']['edit'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=edit'.'&id='.$item['user_id'] ;
        $item['url']['info'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=info'.'&id='.$item['user_id'] ;
    }
    return $result ;
}

 function get_list_status_of_user(){
    $sql = "SELECT * FROM tbl_user WHERE level != 1 " ;
    $path = base_url().'?controller='. get_controller().'&mod='. get_module().'&action='. get_action() ;
        //ALL
        $result['all']['total'] = db_num_rows($sql) ;
        $result['all']['url'] = $path.'&type=all' ;
        //ACTIVE
        $result['active']['total'] = db_num_rows($sql.' && active = 1 ') ;
        $result['active']['url'] = $path.'&type=active' ;
        //BLOCK
        $result['lock']['total'] = db_num_rows($sql.' && active = 2 ') ;
        $result['lock']['url'] = $path.'&type=lock' ;
    
        return $result ;
    }

function get_user_locker($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_user WHERE level != 1 && active = 2 " ;
    if ((bool)$q)
        $sql .= "&& (`fullname` LIKE '%{$q}%' || `email` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY user_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_user($sql) ;
    return $result ;
}

function get_all_user($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_user WHERE level != 1 " ;
    if ((bool)$q)
        $sql .= "&& (`fullname` LIKE '%{$q}%' || `email` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY user_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_user($sql) ;
    return $result ;
}

function add_user($data, $id){
    $data['password'] = md5($data['pass'].$data['salt']) ;
    $data['create_at'] = $data['modify_at'] = time() ;
    unset($data['pass']) ;
    unset($data['confirm_pass']) ;
    return db_insert('tbl_user',$data) ;
}

function update_user($data){
    $result = get_colums_in_array(array('fullname','email','password','level'),$data) ;
    $result['modify_at'] = time() ;
    db_update('tbl_user',$result, " user_id = {$data['user_id']}") ;
}

function lock_user($id){
    db_update('tbl_user',array('active' => 2 ), " user_id IN({$id})") ;
}

function unlock_user($id){
    db_update('tbl_user',array('active' => 1 ), " user_id IN({$id})") ;
}

function drop_user($id,$v){
    $tbl = array('post','product','media','filter','menu','category','slider','page');
    if($v == 'all'){
        foreach ($tbl as $name ){
            echo $name .'<br />';
            db_delete('tbl_'.$name," create_by IN({$id})") ;
        }
        $content = create_notifice('Xóa thành công người dùng và toàn bộ dữ liệu');
    }elseif($v == 'move'){
        $admin_id = get_info_user('id') ;
        foreach ($tbl as $name ){
            if($name != 'media')
                db_update('tbl_'.$name,array('create_by' => $admin_id,'modify_by' => $admin_id ), " create_by IN({$id}) || modify_by IN({$id})") ;
            else 
                db_update('tbl_'.$name,array('create_by' => $admin_id ), " create_by IN({$id})") ;
            }
        $content = create_notifice('Xóa thành công người dùng và dữ liệu đã được chuyển cho Admin ');
    }
    db_delete('tbl_user'," user_id IN({$id})") ;
    drop_media_by_id_conect($id);
    set_notifice_session($content);  
}

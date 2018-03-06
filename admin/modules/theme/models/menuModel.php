<?php

function get_menu_select_filter(){
    $result = db_fetch_array('SELECT * FROM tbl_menu WHERE parent_id = 0 && location != 1') ;
    if(empty($result)){
        return false ;
    }
    return $result ;
}

function get_menu_parent_footer(){
    $result = db_fetch_array('SELECT * FROM tbl_menu WHERE location = 2 && parent_id = 0 ') ;
    if(empty($result)){
        return false ;
    }
    return $result ;
}

function get_menu_parent_sidebar(){
    $result = db_fetch_array('SELECT * FROM tbl_menu WHERE location = 3 ') ;
    if(empty($result)){
        return false ;
    }
    return $result ;
}

function get_menu_parent_respon(){
    $result = db_fetch_array('SELECT * FROM tbl_menu WHERE location = 4 ') ;
    if(empty($result)){
        return false ;
    }
    return $result ;
}
function get_all_menu(){
    $result = db_fetch_array('SELECT * FROM tbl_menu ORDER BY location DESC') ;
    if(empty($result)){
        return false ;
    }
    return $result ;
}
function add_menu($data, $user_id){
    $data['modify_at'] = $data['create_at'] = time() ;
    $data['modify_by'] = $data['create_by'] = $user_id ;
    $history['content'] = 'Thêm thành công Menu : '.$data['title'] ;
    $history['type'] = 'add' ;
    add_history($history) ;
    return db_insert('tbl_menu',$data) ;
}

function update_menu($data,$id, $user_id){
    $data['modify_at'] = time() ;
    $data['modify_by'] = $user_id ;
    $history['content'] = 'Cập nhập thành công Menu : '.$data['title'] ;
    $history['type'] = 'edit' ;
    add_history($history) ;
    db_update('tbl_menu',$data," menu_id = {$id}") ;
}

function get_menu_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_menu` WHERE `menu_id` = {$id} ") ;
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

function get_menu_by_parent_id($id){
    $result = db_fetch_array("SELECT * FROM tbl_menu WHERE parent_id = {$id}") ;
    if(!empty($result)){
        return $result ;
    }
    return false ;
}

function public_menu($id){
    db_update('tbl_menu',array('active' =>1 ),"menu_id IN ({$id})") ;
}
function pending_menu($id){
    db_update('tbl_menu',array('active' =>2 ),"menu_id IN ({$id})") ;
}
function drop_page($id){
    db_delete('tbl_page',"page_id IN ({$id}) && active = 3 ") ;
    db_update('tbl_page',array('active' =>3 ),"page_id IN ({$id})") ;
}

function drop_menu($id){
    $result = get_menu_by_parent_id($id);
    if(!empty($result)){
        $content = create_notifice('Không thể xóa .Trong Menu còn các Menu cấp con ');
    }else{
        $info_menu = get_menu_by_id($id);
        $history['content'] = 'Xóa thành công Menu : '.$info_menu['title'].'.Tạo ngày '.date('d/m/Y',$info_menu['create_at']) ;
        $history['type'] = 'drop';
        add_history($history) ;
        db_delete('tbl_menu', " menu_id = {$id}") ;
        $content = create_notifice('Xóa thành công Menu : '.$info_menu['title']) ;
    }
    set_notifice_session($content);
}
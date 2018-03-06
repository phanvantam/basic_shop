<?php

function get_history_by_id($id){
    return db_fetch_row(" SELECT * FROM tbl_history WHERE `history_id` = {$id}");
}

function get_total_add_by_parent_id($id){
    $sql = " SELECT COUNT(history_id) as total FROM tbl_history WHERE parent_id = {$id} && type = 'add' " ;
    $result = db_fetch_row($sql);
    return $result['total'] ;
}

function get_total_update_by_parent_id($id){
    $sql = " SELECT COUNT(history_id) as total FROM tbl_history WHERE parent_id = {$id} && type = 'edit' " ;
    $result = db_fetch_row($sql);
    return $result['total'] ;
}

function get_total_drop_by_parent_id($id){
    $sql = " SELECT COUNT(history_id) as total FROM tbl_history WHERE parent_id = {$id} && type = 'drop' " ;
    $result = db_fetch_row($sql);
    return $result['total'] ;
}

function get_history_id_max($id){
    $result = db_fetch_row(" SELECT MAX(history_id) as max FROM tbl_history WHERE type = 'login' && user_id = {$id} ");
    return $result['max'] ;
}

function get_list_history($page,$per_page,$time){
    $sql = 'SELECT tbl_history.* ,tbl_user.fullname as username FROM `tbl_history` INNER JOIN tbl_user ON tbl_history.user_id = tbl_user.user_id WHERE type = "login" && parent_id = 0  ' ;
    switch ($time){
        case 1 : 
            $start = time() - ( date('H')*3600 + date('i')*60 ) ;
            $sql .= " && happen_at > {$start} ";
            break;
        case 2:
            $stop = time() - ( date('H')*3600 + date('i')*60 ) ;
            $start = $stop - 24*3600 ;
            $sql .= " && happen_at BETWEEN {$start} AND {$stop} ";
            break;
    }
    if(get_info_user('level') != 1 ){
        $sql .= ' && tbl_history.user_id = '.get_info_user('id') ;
    }
    
    $result['total_page'] = $total_page = total_page_by_query($sql, $per_page) ;
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql .= " ORDER BY happen_at DESC LIMIT {$start},{$per_page}" ;
    $result['data'] = add_url_into_list_history($sql) ;
    
    return $result ;
}

function get_detail_history($id,$page,$per_page,$type){
    $sql = 'SELECT *  FROM `tbl_history` WHERE parent_id = '.$id ;
    switch ($type){
        case 'add': 
            $sql .= " && type = 'add' ";
            break;
        case 'edit':
            $sql .= " && type = 'edit' ";
            break;
        case 'drop':
            $sql .= " && type = 'drop' ";
            break;
    }
    if(get_info_user('level') != 1 ){
        $sql .= ' && `user_id` = '.get_info_user('id') ;
    }
    $result['total_page'] = total_page_by_query($sql, $per_page) ;
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql .= " ORDER BY happen_at DESC LIMIT {$start},{$per_page}" ;
    $result['data'] = add_url_into_detail_history($sql) ;
    return $result ;
}

function add_url_into_list_history($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['url']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=drop'.'&id='.$item['history_id'] ;
        $item['url']['detail'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=detail'.'&id='.$item['history_id'] ;
    }
    return $result ;
}

function add_url_into_detail_history($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['url']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=drop'.'&id='.$item['history_id'].'&detail='.$item['parent_id'] ;
    }
    return $result ;
}
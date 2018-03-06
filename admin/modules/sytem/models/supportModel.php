<?php

function add_support($input,$user_id){
    $data = get_colums_in_array(array('title','page_connect','depict','link'),$input) ;
    $data['thumb'] = $input['img_id'] ;
    $data['create_at'] = $data['modify_at'] = time() ;
    return db_insert('tbl_support',$data) ;
}

function update_support($input,$support_id,$user_id){
    $data = get_colums_in_array(array('title','page_connect','depict','link'),$input) ;
    $data['thumb'] = $input['img_id'] ;
    $data['modify_at'] = time() ;
    db_update('tbl_support',$data," `id` = {$support_id}" ) ;
}


function get_support_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_support` WHERE `id` = {$id} ") ;
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

function public_support($id){
    db_update('tbl_support',array('active' =>1 ),"id IN ({$id})") ;
}
function pending_support($id){
    db_update('tbl_support',array('active' =>2 ),"id IN ({$id})") ;
}
function drop_support($id){
    db_delete('tbl_support',"id IN ({$id}) && active = 3 ") ;
    db_update('tbl_support',array('active' =>3 ),"id IN ({$id})") ;
}

function add_url_into_list_support($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['path']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['id'].'&drop' ;
        $item['path']['edit'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=edit'.'&id='.$item['id'] ;
        $item['path']['public'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['id'].'&public' ;
        $item['path']['pending'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['id'].'&pending' ;
    }
    return $result ;
}

function get_list_status_of_support(){
    $sql = "SELECT * FROM tbl_support WHERE " ;
    $path = base_url().'?controller='. get_controller().'&mod='. get_module().'&action='. get_action() ;
        //ALL
        $result['all']['total'] = db_num_rows($sql.' active != 3 ') ;
        $result['all']['url'] = $path.'&type=all' ;
        //ACTIVE
        $result['active']['total'] = db_num_rows($sql.' active = 1 ') ;
        $result['active']['url'] = $path.'&type=active' ;
        //Trash
        $result['trash']['total'] = db_num_rows($sql.' active = 3 ') ;
        $result['trash']['url'] = $path.'&type=trash' ;
        //PENDING
        $result['pending']['total'] = db_num_rows($sql.' active = 2 ') ;
        $result['pending']['url'] = $path.'&type=pending' ;
        
        return $result ;
    }
    
function get_support_trash($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT support.*,media.url FROM `tbl_support` as support INNER JOIN `tbl_media` as media ON support.thumb = media.media_id WHERE support.active = 3 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_support($sql) ;
    
    return $result ;
}    

function get_support_active($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT support.*,media.url FROM `tbl_support` as support INNER JOIN `tbl_media` as media ON support.thumb = media.media_id WHERE support.active = 1 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_support($sql) ;
    
    return $result ;
}

function get_all_support($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT support.*,media.url FROM `tbl_support` as support INNER JOIN `tbl_media` as media ON support.thumb = media.media_id WHERE support.active != 3 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_support($sql) ;
    
    return $result ;
}

function get_support_pending($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT support.*,media.url FROM `tbl_support` as support INNER JOIN `tbl_media` as media ON support.thumb = media.media_id WHERE support.active = 2 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_support($sql) ;
    
    return $result ;
}
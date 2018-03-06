<?php

function add_slider($input,$user_id){
    $data = get_colums_in_array(array('title'),$input) ;
    $data['thumb'] = $input['img_id'] ;
    $data['create_at'] = $data['modify_at'] = time() ;
    $data['create_by'] = $data['modify_by'] = $user_id ;
    return db_insert('tbl_slider',$data) ;
}

function update_slider($input,$slider_id,$user_id){
    $data = get_colums_in_array(array('title'),$input) ;
    $data['thumb'] = $input['img_id'] ;
    $data['modify_at'] = time() ;
    $data['modify_by'] = $user_id ;
    db_update('tbl_slider',$data," `slider_id` = {$slider_id}" ) ;
}


function get_slider_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_slider` WHERE `slider_id` = {$id} ") ;
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

function public_slider($id){
    db_update('tbl_slider',array('active' =>1 ),"slider_id IN ({$id})") ;
}
function pending_slider($id){
    db_update('tbl_slider',array('active' =>2 ),"slider_id IN ({$id})") ;
}
function drop_slider($id){
    db_delete('tbl_slider',"slider_id IN ({$id}) && active = 3 ") ;
    db_update('tbl_slider',array('active' =>3 ),"slider_id IN ({$id})") ;
}

function add_url_into_list_slider($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['path']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['slider_id'].'&drop' ;
        $item['path']['edit'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=edit'.'&id='.$item['slider_id'] ;
        $item['path']['public'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['slider_id'].'&public' ;
        $item['path']['pending'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['slider_id'].'&pending' ;
    }
    return $result ;
}

function get_list_status_of_slider(){
    $sql = "SELECT * FROM tbl_slider WHERE " ;
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
    
function get_all_slider($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT slider.*,media.url FROM `tbl_slider` as slider INNER JOIN `tbl_media` as media ON slider.thumb = media.media_id WHERE slider.active != 3  " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY slider_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_slider($sql) ;
    return $result ;
}

function get_slider_active($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT slider.*,media.url FROM `tbl_slider` as slider INNER JOIN `tbl_media` as media ON slider.thumb = media.media_id WHERE slider.active = 1 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY slider_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_slider($sql) ;
    return $result ;
}

function get_slider_pending($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT slider.*,media.url FROM `tbl_slider` as slider INNER JOIN `tbl_media` as media ON slider.thumb = media.media_id WHERE slider.active = 2  " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY slider_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_slider($sql) ;
    return $result ;
}

function get_slider_trash($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT slider.*,media.url FROM `tbl_slider` as slider INNER JOIN `tbl_media` as media ON slider.thumb = media.media_id WHERE slider.active = 3  " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY slider_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_slider($sql) ;
    return $result ;
}
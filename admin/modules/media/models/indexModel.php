<?php


function add_media($link, $type, $caption){
    $data['caption'] = $caption ;
    $data['url'] = $link ;
    $data['type'] = $type ;
    $data['create_at'] = time() ;
    $data['create_by'] = get_info_user('id') ;
    return db_insert('tbl_media',$data) ;
}

function get_list_type_media(){
    $sql = "SELECT * FROM tbl_media WHERE " ;
    $path = base_url().'?controller='. get_controller().'&mod='. get_module().'&action='. get_action() ;
        //All
        $result['all']['total'] = db_num_rows($sql.' 1 ') ;
        $result['all']['url'] = $path.'&type=all' ;
        //POST
        $result['post']['total'] = db_num_rows($sql.' active = 1 && type = 2 ') ;
        $result['post']['url'] = $path.'&type=post' ;
        //PRODUCT
        $result['product']['total'] = db_num_rows($sql.' active = 1 && type = 3  ') ;
        $result['product']['url'] = $path.'&type=product' ;
        //AVATAR
        $result['avatar']['total'] = db_num_rows($sql.' active = 1 && type = 1 ') ;
        $result['avatar']['url'] = $path.'&type=avatar' ;
        //DEFAULT
        $result['sytem']['total'] = db_num_rows($sql.' active = 3 ') ;
        $result['sytem']['url'] = $path.'&type=sytem' ;
        //TRASH
        $result['trash']['total'] = db_num_rows($sql.' active = 2 ') ;
        $result['trash']['url'] = $path.'&type=trash' ;
        
        return $result ;
    }

function add_url_into_list_media($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['path']['edit'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=edit'.'&id='.$item['media_id'] ;
        $item['path']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=drop'.'&id='.$item['media_id'] ;
    }
    return $result ;
}

function get_media_trash($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_media WHERE active = 2 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY media_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_media($sql) ;
    
    return $result ;
}

function get_media_avatar($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_media WHERE active = 1 && type = 1 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY media_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_media($sql) ;
    
    return $result ;
}

function get_media_post($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_media WHERE active = 1 && type = 2 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY media_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_media($sql) ;
    
    return $result ;
}

function get_media_product($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_media WHERE active = 1 && type = 3 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY media_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_media($sql) ;
    
    return $result ;
}

function get_media_sytem($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_media WHERE active = 3 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY media_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_media($sql) ;
    
    return $result ;
}

function get_all_media($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_media WHERE 1 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY media_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_media($sql) ;
    
    return $result ;
}
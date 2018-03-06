<?php


function exists_slug_page_in_db($slug){
    $result = db_num_rows("SELECT * FROM tbl_page WHERE `slug` = '{$slug}' ") ;
    if($result > 0 ){
        return true ;
    }
    return false ;
}

function add_page($input, $user_id){
    $data = get_colums_in_array(array('title','slug','content'),$input) ;
    $data['modify_at'] = $data['create_at'] = time() ;
    $data['modify_by'] = $data['create_by'] = $user_id ;
    $history['content'] = 'Thêm thành công trang : '.$input['title'] ;
    $history['type'] = 'add' ;
    add_history($history) ;
    return db_insert('tbl_page',$data) ;
}

function update_page($input,$page_id, $user_id){
    $data = get_colums_in_array(array('title','slug','content'),$input) ;
    $data['modify_at'] = time() ;
    $data['modify_by'] = $user_id ;
    $history['content'] = 'Cập nhập trang : '.$input['title'] ;
    $history['type'] = 'edit' ;
    add_history($history) ;
    db_update('tbl_page',$data," page_id = {$page_id}") ;
}

function get_page_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_page` WHERE `page_id` = {$id} ") ;
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

function get_page_active($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_page WHERE active = 1 " ;
    if ((bool)$q)
        $sql .= "&& (`title` LIKE '%{$q}%' || `slug` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY page_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_page($sql) ;
    return $result ;
}

function get_page_pending($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_page WHERE active = 2 " ;
    if ((bool)$q)
        $sql .= "&& (`title` LIKE '%{$q}%' || `slug` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY page_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_page($sql) ;
    return $result ;
}

function add_url_into_list_page($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['url']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['page_id'].'&drop' ;
        $item['url']['edit'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=edit'.'&id='.$item['page_id'] ;
        $item['url']['public'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['page_id'].'&public' ;
        $item['url']['pending'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['page_id'].'&pending' ;
    }
    return $result ;
}

function get_list_status_of_page(){
    $sql = "SELECT * FROM tbl_page WHERE " ;
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

function get_page_trash($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_page WHERE active = 3 " ;
    if ((bool)$q)
        $sql .= "&& (`title` LIKE '%{$q}%' || `slug` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY page_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_page($sql) ;
    return $result ;
}

function get_all_page($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_page " ;
    if ((bool)$q)
        $sql .= "&& (`title` LIKE '%{$q}%' || `slug` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY page_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_page($sql) ;
    return $result ;
}

function public_page($id){
    db_update('tbl_page',array('active' =>1 ),"page_id IN ({$id})") ;
}
function pending_page($id){
    db_update('tbl_page',array('active' =>2 ),"page_id IN ({$id})") ;
}
function drop_page($id){
    $result = db_fetch_array("SELECT title,create_at FROM tbl_page WHERE page_id IN({$id}) ");
    foreach($result as $item ){
        if($item['active'] != 3 ){
            $history['content'] = 'Đã đưa trang : " '.$item['title'].' " vào thùng rác ';
        }else{
            $history['content'] = 'Đã xóa trang : " '.$item['title'].' " được tạo lúc '.date('d/m/Y',$item['create_at']);
        }
        $history['type'] = 'edit' ;
        add_history($history) ;
    }
    db_delete('tbl_page',"page_id IN ({$id}) && active = 3 ") ;
    db_update('tbl_page',array('active' =>3 ),"page_id IN ({$id})") ;
}
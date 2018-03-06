<?php


function exists_slug_post_in_db($slug){
    $result = db_num_rows("SELECT * FROM tbl_post WHERE `slug` = '{$slug}' ") ;
    if($result > 0 ){
        return true ;
    }
    return false ;
}

function add_post($input, $user_id){
    $data = get_colums_in_array(array('title','slug','excerpt','content','cat_id'),$input) ;
    $data['thumbnail'] = $input['img_id'] ;
    $data['modify_at'] = $data['create_at'] = time() ;
    $data['modify_by'] = $data['create_by'] = $user_id ;
    $history['content'] = "Thêm bài viết : '{$input['title']}' " ;
    $history['type'] = 'add' ;
    add_history($history) ;
    return db_insert('tbl_post',$data) ;
}

function update_post($input,$post_id, $user_id){
    $data = get_colums_in_array(array('title','slug','excerpt','content','cat_id'),$input) ;
    $data['thumbnail'] = $input['img_id'] ;
    $data['modify_at'] = time() ;
    $data['modify_by'] = $user_id ;
    $history['content'] = "Cập nhập bài viết : '{$input['title']}' " ;
    $history['type'] = 'edit' ;
    add_history($history) ;
    return db_update('tbl_post',$data," post_id = {$post_id}") ;
}

function get_post_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id` = {$id} ") ;
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

function get_post_active($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT tbl_post.* , tbl_category.title as category,tbl_media.url as url_thumb FROM `tbl_post` INNER JOIN tbl_category ON tbl_post.cat_id = tbl_category.cat_id INNER JOIN tbl_media ON tbl_post.thumbnail = tbl_media.media_id WHERE tbl_post.active = 1 " ;
    if ((bool)$q)
        $sql .= "&& (tbl_post.title LIKE '%{$q}%' || tbl_post.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY post_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_post($sql) ;
    return $result ;
}

function get_post_pending($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
$sql = "SELECT tbl_post.* , tbl_category.title as category,tbl_media.url as url_thumb FROM `tbl_post` INNER JOIN tbl_category ON tbl_post.cat_id = tbl_category.cat_id INNER JOIN tbl_media ON tbl_post.thumbnail = tbl_media.media_id WHERE tbl_post.active = 2 " ;
    if ((bool)$q)
        $sql .= "&& ( tbl_post.title LIKE '%{$q}%' || tbl_post.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY post_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_post($sql) ;
    return $result ;
}

function add_url_into_list_post($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
//        show_array($item) ;exit ;
        $item['url']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['post_id'].'&drop' ;
        $item['url']['edit'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=edit'.'&id='.$item['post_id'] ;
        $item['url']['public'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['post_id'].'&public' ;
        $item['url']['pending'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['post_id'].'&pending' ;
    }
    return $result ;
}

 function get_list_status_of_post(){
    $sql = "SELECT * FROM tbl_post WHERE " ;
    $path = base_url().'?controller='. get_controller().'&mod='. get_module().'&action='. get_action() ;
        //ALL
        $result['all']['total'] = db_num_rows($sql.' 1 ') ;
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

function get_post_trash($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
$sql = "SELECT tbl_post.* , tbl_category.title as category,tbl_media.url as url_thumb FROM `tbl_post` INNER JOIN tbl_category ON tbl_post.cat_id = tbl_category.cat_id INNER JOIN tbl_media ON tbl_post.thumbnail = tbl_media.media_id WHERE tbl_post.active = 3 " ;
    if ((bool)$q)
        $sql .= "&& ( tbl_post.title LIKE '%{$q}%' || tbl_post.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY post_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_post($sql) ;
    return $result ;
}

function get_all_post($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT tbl_post.* , tbl_category.title as category,tbl_media.url as url_thumb FROM `tbl_post` INNER JOIN tbl_category ON tbl_post.cat_id = tbl_category.cat_id INNER JOIN tbl_media ON tbl_post.thumbnail = tbl_media.media_id WHERE 1 " ;
    if ((bool)$q)
        $sql .= "&& ( tbl_post.title LIKE '%{$q}%' || tbl_post.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY post_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_post($sql) ;
    return $result ;
}

function public_post($id){
    db_update('tbl_post',array('active' =>1 ),"post_id IN ({$id})") ;
}
function pending_post($id){
    db_update('tbl_post',array('active' =>2 ),"post_id IN ({$id})") ;
}
function drop_post($id){
    $result = db_fetch_array("SELECT * FROM tbl_post WHERE post_id IN({$id}) ") ;
    !empty($result) || redirect('?mod=post&controller=index&action=index') ;
    foreach($result as $item ){
        if($item['active'] != 3 ){
            $history['content'] = "Đã đưa bài viết : ' {$item['title']} ' vào thùng rác . " ;
        }else{
            
            db_delete('tbl_post',"post_id = {$item['post_id']} && active = 3 ") ;drop_media_by_id_conect($item['post_id']) ;
            $history['content'] = "Đã xóa bài viết : ' {$item['title']} ' ".'.Được tạo lúc '.date('d/m/Y',$item['create_at']) ;
        }
        $history['type'] = 'drop' ;
        add_history($history) ;
    }
     ;
    db_update('tbl_post',array('active' =>3 ),"post_id IN ({$id})") ;
}

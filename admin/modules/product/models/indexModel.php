<?php


function exists_slug_product_in_db($slug){
    $result = db_num_rows("SELECT * FROM tbl_product WHERE `slug` = '{$slug}' ") ;
    if($result > 0 ){
        return true ;
    }
    return false ;
}

function add_product($input, $user_id){
    $data = get_colums_in_array(array('slug','info','depict','cat_id','price','percen','discount','total_product'),$input) ;
    $data['thumb'] = $input['img_id'] ;
    $data['name'] = $input['title'] ;
    $data['modify_at'] = $data['create_at'] = time() ;
    $data['modify_by'] = $data['create_by'] = $user_id ;
    $history['content'] = "Thêm sản phẩm : ' {$input['title']} '";
    $history['type'] = 'add' ;
    add_history($history) ;
    return db_insert('tbl_product',$data) ;
}

function update_product($input,$product_id, $user_id){
    $data = get_colums_in_array(array('slug','info','depict','cat_id','price','percen','discount','total_product'),$input) ;
    $data['thumb'] = $input['img_id'] ;
    $data['name'] = $input['title'] ;
    $data['modify_at'] = time() ;
    $data['modify_by'] = $user_id ;
    $history['content'] = "Cập nhập sản phẩm : ' {$input['title']} '";
    $history['type'] = 'edit' ;
    add_history($history) ;
    return db_update('tbl_product',$data," product_id = {$product_id}") ;
}

function get_product_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id` = {$id} ") ;
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

function get_product_active($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT tbl_product.* , tbl_category.title as category ,tbl_media.url as url_thumb FROM `tbl_product`,`tbl_media`,tbl_category WHERE tbl_product.cat_id = tbl_category.cat_id && tbl_media.media_id = tbl_product.thumb && tbl_product.active = 1 " ;
    if ((bool)$q)
        $sql .= "&& ( tbl_product_name LIKE '%{$q}%' || tbl_product.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY product_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_product($sql) ;
    return $result ;
}

function get_product_pending($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT tbl_product.* , tbl_category.title as category ,tbl_media.url as url_thumb FROM `tbl_product`,`tbl_media`,tbl_category WHERE tbl_product.cat_id = tbl_category.cat_id && tbl_media.media_id = tbl_product.thumb && tbl_product.active = 2 " ;
    if ((bool)$q)
        $sql .= "&& ( tbl_product_name LIKE '%{$q}%' || tbl_product.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY product_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_product($sql) ;
    return $result ;
}

function add_url_into_list_product($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['url']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['product_id'].'&drop' ;
        $item['url']['edit'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=edit'.'&id='.$item['product_id'] ;
        $item['url']['public'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['product_id'].'&public' ;
        $item['url']['pending'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['product_id'].'&pending' ;
        $item['url']['favorite'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['product_id'].'&favorite' ;
    }
    return $result ;
}

 function get_list_status_of_product(){
    $sql = "SELECT * FROM tbl_product WHERE " ;
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
        //FAVORITE
        $result['favorite']['total'] = db_num_rows($sql.' active != 3 && favorite = 1 ') ;
        $result['favorite']['url'] = $path.'&type=favorite' ;
        
        return $result ;
    }

function get_product_trash($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT tbl_product.* , tbl_category.title as category ,tbl_media.url as url_thumb FROM `tbl_product`,`tbl_media`,tbl_category WHERE tbl_product.cat_id = tbl_category.cat_id && tbl_media.media_id = tbl_product.thumb && tbl_product.active = 3 " ;
    if ((bool)$q)
        $sql .= "&& ( tbl_product_name LIKE '%{$q}%' || tbl_product.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY product_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_product($sql) ;
    return $result ;
}

function get_all_product($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT tbl_product.* , tbl_category.title as category ,tbl_media.url as url_thumb FROM `tbl_product`,`tbl_media`,tbl_category WHERE tbl_product.cat_id = tbl_category.cat_id && tbl_media.media_id = tbl_product.thumb " ;
    if ((bool)$q)
        $sql .= "&& ( tbl_product_name LIKE '%{$q}%' || tbl_product.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY product_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_product($sql) ;
    return $result ;
}

function get_product_favorite($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT tbl_product.* , tbl_category.title as category ,tbl_media.url as url_thumb FROM `tbl_product` INNER JOIN `tbl_media` ON tbl_media.media_id = tbl_product.thumb INNER JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id WHERE tbl_product.active != 3 && favorite > 0 " ;
    if ((bool)$q)
        $sql .= "&& ( tbl_product.name LIKE '%{$q}%' || tbl_product.slug LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY product_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_product($sql) ;
    return $result ;
}

function public_product($id){
    db_update('tbl_product',array('active' =>1 ),"product_id IN ({$id})") ;
}
function favorite_product($id){
    $result = db_fetch_row("SELECT favorite FROM tbl_product WHERE product_id = {$id} ");
    $favorite = $result['favorite'] == 1 ? 0 : 1 ;
    db_update('tbl_product',array('favorite' =>$favorite ),"product_id IN ({$id})") ;
}
function pending_product($id){
    db_update('tbl_product',array('active' =>2 ),"product_id IN ({$id})") ;
}
function drop_product($id){
    $id = explode(',',$id) ;
    foreach ($id as $v ){
        $info = get_product_by_id($v) ;
        if( !empty($info) && (int)$info['active'] === 3 ){
            db_delete('tbl_product',"product_id = $v ") ;
            drop_media_by_id_conect($v);
            $history['content'] = "Xóa sản phẩm : ' {$info['name']} '";
        }else{
            $history['content'] = "Đã đưa sản phẩm : ' {$info['name']} ' vào thùng rác ";
            db_update('tbl_product',array('active' =>3 ),"product_id = {$v} ") ;
        }
        $history['type'] = 'drop' ;
        add_history($history) ;
    }
    set_notifice_session(create_notifice('Xóa sản phẩm thành công '));
}

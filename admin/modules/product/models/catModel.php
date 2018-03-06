<?php
function exists_title_in_db($title){
    $result = db_num_rows("SELECT * FROM tbl_category WHERE type = 2 && title = '{$title}' ") ;
    if($result > 0 ){
        return true ;
    }
    return false ;
}

function exists_slug_in_db($slug){
    $result = db_num_rows("SELECT * FROM tbl_category WHERE `slug` = '{$slug}' ") ;
    if($result > 0 ){
        return true ;
    }
    return false ;
}

function get_cat_by_id($id){
    $reult = db_fetch_row("SELECT * FROM tbl_category WHERE type = 2 && cat_id = {$id}") ;
    if(!empty($reult)){
        return $reult ;
    }
    return false ;
}

function get_cat_by_parent_id($id){
    $reult = db_fetch_array("SELECT * FROM tbl_category WHERE type = 2 && parent_id = {$id}") ;
    if(!empty($reult)){
        return $reult ;
    }
    return false ;
}

function add_cat($v,$user_id){
    $data['title'] = $v['title'] ;
    $data['parent_id'] = $v['parent_cat'] ;
    $data['slug'] = $v['slug'] ;
    $data['create_at'] = time() ;
    $data['create_by'] = $user_id ;
    $data['modify_at'] = time() ;
    $data['modify_by'] = $user_id ;
    $data['type'] = 2 ;
    $history['content'] = "Đã thêm danh mục : {$v['title']}" ;
    $history['type'] = 'add' ;
    add_history($history) ;
    return db_insert('tbl_category',$data) ;
}

function update_cat($v, $user_id, $cat_id){
    $data['title'] = $v['title'] ;
    $data['parent_id'] = $v['parent_cat'] ;
    $data['slug'] = $v['slug'] ;
    $data['modify_at'] = time() ;
    $data['modify_by'] = $user_id ;
    $history['content'] = "Đã cập nhập danh mục : {$v['title']}" ;
    $history['type'] = 'edit' ;
    add_history($history) ;
    db_update('tbl_category',$data," cat_id = {$cat_id}") ;
}

function get_all_cat_product(){
    $result = db_fetch_array('SELECT * FROM tbl_category WHERE type = 2 ') ;
    if(empty($result)){
        return false ;
    }
    return $result ;
}

function public_cat($id){
    db_update('tbl_category',array('active' =>1 ),"  type = 2 && cat_id = {$id}  ") ;
}

function pending_cat($id){
    db_update('tbl_category',array('active' =>2 )," type = 2 && cat_id = {$id}  ") ;
}

function check_cat_empty($id){
    $result = db_fetch_row(" SELECT product_id FROM tbl_product WHERE cat_id = {$id}");
    if(empty($result))
        return false ;
    return true ;
}

function drop_cat($id){
    $result = get_cat_by_parent_id($id) ;
    if(!empty($result)){
        $content = create_notifice('Không thể xóa danh mục này vì còn danh mục con ');
    }
    elseif (check_cat_empty($id)) {
        $content = create_notifice('Không thể xóa danh mục này vì có liên kết tới sản phẩm ');
    }
    else{
        $info_cat = get_cat_by_id($id);
        $history['content'] = 'Xóa thành công danh mục : "'.$info_cat['title'].'" .Được tạo lúc '.date('d/m/Y',$info_cat['crate_at']) ;
        $history['type'] = 'drop' ;
        $content = create_notifice($history['content']) ;
        add_history($history) ;
        db_delete('tbl_category', " type = 2 && cat_id = {$id}") ;
    }
    set_notifice_session($content) ;
}
<?php

#Chức năng : Lấy media theo id media 
#$index : Chỉ mục muôn chả về
function get_media_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_media` WHERE `media_id` = {$id} ") ;
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

#Chức năng thêm đường dẫn vào sản phẩm 
#$sql : Câu truy vấn sản phẩm
function add_path_product($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    if(!empty($result)){
        foreach ($result as &$item ){
            $item['path']['cart'] = $base_url.'?mod=product&controller=cart&action=add&id='.$item['product_id'] ;
            $item['path']['detail'] = $base_url.'san-pham/'.$item['slug'].'-'.$item['product_id'].'.html' ;
        }
    }    
    return $result ;
}

#Chức năng thêm đường dẫn vào bài viết 
#$sql : Câu truy vấn bài viết
function add_path_post($sql){
    $result = db_fetch_array($sql) ;
    if(!empty($result)){
    $base_url = base_url() ;
        foreach ($result as &$item ){
            $item['path']['detail'] = $base_url.$item['slug'].'-'.$item['post_id'].'.html' ;
        }
    }    
    return $result ;
}

#Chức năng : Lấy thông tin hệ thống 
#$index : Chỉ mục muốn chả về
function get_info_sytem($index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_sytem` ") ;
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

# Lấy danh sách slider
function get_slider(){
    return db_fetch_array('SELECT tbl_slider.*,tbl_media.url,tbl_media.caption FROM tbl_slider ,tbl_media WHERE tbl_media.media_id = tbl_slider.thumb && tbl_slider.active = 1  ') ;
}

# Lấy menu header
function get_menu_header(){
    return db_fetch_array(" SELECT * FROM tbl_menu WHERE location = 1 && active = 1 ORDER BY `ordinal` ASC ") ;
}
 
# Lấy menu sidebar 
function get_menu_sidebar(){
    return db_fetch_array(" SELECT * FROM tbl_menu WHERE location = 3 && active = 1 ORDER BY `ordinal` ASC ") ;
}

# Lấy mneu response
function get_menu_respon(){
    return db_fetch_array(" SELECT * FROM tbl_menu WHERE location = 4 && active = 1 ORDER BY `ordinal` ASC ") ;
}

# Lấy menu footer 
function get_menu_footer(){
    return db_fetch_row(" SELECT * FROM tbl_menu WHERE location = 2 && active = 1 && parent_id = 0 ORDER BY `ordinal` ASC ") ;
}

# Lấy danh sách hỗ trợ 
function get_list_support(){
    return db_fetch_array('SELECT tbl_support.*,tbl_media.url FROM tbl_support,tbl_media WHERE tbl_support.active = 1 && tbl_media.media_id = tbl_support.thumb ') ;
}

# Lấy da các sản phẩm nổi bật 
function get_product_favorite(){
    $per_page = get_info_sytem('per_page');
    $start = 0 ;
    $total_recod = db_fetch_row("SELECT COUNT(*) as total FROM tbl_product WHERE favorite = 1 && active = 1 ") ;
    $total_recod = $total_recod['total'] ;
    if($total_recod > $per_page ){
        $start = rand(1, $total_recod) ;
        if($start+$per_page > $total_recod){
            $start = $total_recod - $per_page ;
        }
    }
    $sql = "SELECT tbl_product.slug,tbl_product.product_id,tbl_product.name,tbl_product.price,tbl_product.discount, tbl_media.url FROM tbl_product INNER JOIN tbl_media ON tbl_media.media_id = tbl_product.thumb WHERE favorite = 1 && tbl_product.active = 1 LIMIT {$start},{$per_page}" ;
    $result = add_path_product($sql) ;
    if(!empty($result))
        return $result ;
    return false ;
}

# Lấy ra các sản phẩm đang giảm giá 
function get_product_discount(){
    $per_page = get_info_sytem('per_page');
    $start = 0 ;
    $total_recod = db_fetch_row("SELECT COUNT(*) as total FROM tbl_product WHERE discount > 0 && active = 1 ") ;
    $total_recod = $total_recod['total'] ;
    if($total_recod > $per_page ){
        $start = rand(1, $total_recod) ;
        if($start+$per_page > $total_recod){
            $start = $total_recod - $per_page ;
        }
    }
    $sql = "SELECT tbl_product.slug,tbl_product.product_id,tbl_product.name,tbl_product.price,tbl_product.discount, tbl_media.url FROM tbl_product INNER JOIN tbl_media ON tbl_media.media_id = tbl_product.thumb WHERE discount > 0 && tbl_product.active = 1 LIMIT {$start},{$per_page}" ;
    $result = add_path_product($sql) ;
    if(!empty($result))
        return $result ;
    return false ;
}

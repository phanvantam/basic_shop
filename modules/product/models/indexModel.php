<?php


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



function get_product_involve($cat_id,$id){
    $per_page = get_info_sytem('per_page');
    $start = 0 ;
    $total_recod = db_fetch_row("SELECT COUNT(*) as total FROM tbl_product WHERE active = 1 && cat_id = {$cat_id} && product_id != {$id} ") ;
    $total_recod = $total_recod['total'] ;
    if($total_recod > $per_page ){
        $start = rand(1, $total_recod) ;
        if($start+$per_page > $total_recod){
            $start = $total_recod - $per_page ;
        }
    }
    $sql = "SELECT tbl_product.slug,tbl_product.product_id,tbl_product.name,tbl_product.price,tbl_product.discount, tbl_media.url FROM tbl_product INNER JOIN tbl_media ON tbl_media.media_id = tbl_product.thumb WHERE cat_id = {$cat_id} && tbl_product.active = 1 && tbl_product.product_id != {$id} LIMIT {$start},{$per_page}" ;
    $result = add_path_product($sql) ;
    if(!empty($result))
        return $result ;
    return false ;
}
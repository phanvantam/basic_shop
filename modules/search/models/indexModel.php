<?php

function search_post_by_q($q,$page){
    $sql = "SELECT post_id,tbl_post.title,slug,excerpt,view,tbl_post.create_at,tbl_media.url FROM tbl_post INNER JOIN tbl_media ON tbl_post.thumbnail = tbl_media.media_id WHERE tbl_post.title LIKE '%{$q}%' && tbl_post.active = 1" ;
    $total = total_page_by_query($sql,10);
    $data['sql'] = $sql ;
    if($total > 0 ){
        $start =$page * 10 - 10 ;
        $sql.= " LIMIT {$start},10 " ;
        $return = add_path_post($sql) ;
        $data['data'] = $return ;
        $data['total'] = $total ;
        return $data ;
    }
    return false ;
}

function search_product_by_q($q,$page){
    $sql = "SELECT product_id,name,price,slug,discount,tbl_media.url FROM tbl_product INNER JOIN tbl_media ON tbl_product.thumb = tbl_media.media_id WHERE name LIKE '%{$q}%' && tbl_product.active = 1 " ;
    $total = total_page_by_query($sql,10);
    $data['sql'] = $sql ;
    if($total > 0 ){
        $start =$page * 10 - 10 ;
        $sql.= " LIMIT {$start},10 " ;
        $return = add_path_product($sql) ;
        $data['data'] = $return ;
        $data['total'] = $total ;
        return $data ;
    }
    return false ;
}

function get_all_product($page){
    $sql = "SELECT product_id,name,price,slug,discount,tbl_media.url FROM tbl_product INNER JOIN tbl_media ON tbl_product.thumb = tbl_media.media_id WHERE tbl_product.active = 1 " ;
    $total = total_page_by_query($sql,10);
    $data['sql'] = $sql ;
    if($total > 0 ){
        $start =$page * 10 - 10 ;
        $sql.= " LIMIT {$start},10 " ;
        $return = add_path_product($sql) ;
        $data['data'] = $return ;
        $data['total'] = $total ;
        return $data ;
    }
    return false ;
}

function get_all_post($page){
    $sql = "SELECT post_id,tbl_post.title,slug,excerpt,view,tbl_post.create_at,tbl_media.url FROM tbl_post INNER JOIN tbl_media ON tbl_post.thumbnail = tbl_media.media_id WHERE tbl_post.active = 1" ; ;
    $total = total_page_by_query($sql,10);
    $data['sql'] = $sql ;
    if($total > 0 ){
        $start =$page * 10 - 10 ;
        $sql.= " LIMIT {$start},10 " ;
        $return = add_path_post($sql) ;
        $data['data'] = $return ;
        $data['total'] = $total ;
        return $data ;
    }
    return false ;
}
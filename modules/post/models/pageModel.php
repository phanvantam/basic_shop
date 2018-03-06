<?php

function get_page_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_page` WHERE `page_id` = {$id} && active = 1 ") ;
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

function get_page_by_slug($slug, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_page` WHERE `slug` = '{$slug}' && active = 1 ") ;
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

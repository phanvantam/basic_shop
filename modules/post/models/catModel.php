<?php

function get_cat_by_id($id){
    $reult = db_fetch_row("SELECT * FROM tbl_category WHERE type = 1 && cat_id = {$id} && active = 1") ;
    if(!empty($reult)){
        return $reult ;
    }
    return false ;
}

function get_cat_by_slug($slug){
    $reult = db_fetch_row("SELECT * FROM tbl_category WHERE type = 1 && slug = '{$slug}' && active = 1") ;
    if(!empty($reult)){
        return $reult ;
    }
    return false ;
}

function get_list_cat_post(){
    return db_fetch_array('SELECT * FROM tbl_category WHERE type = 1 && active = 1 ') ;
}

function get_filter_by_type($type){
    return db_fetch_array(" SELECT * FROM tbl_filter WHERE type = {$type} && active = 1");
}

function get_filter_by_id($id, $index=null){
    $result = db_fetch_row("SELECT * FROM `tbl_filter` WHERE `filter_id` = {$id} ") ;
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
<?php

function get_post_by_id($id, $index=null){
    $result = db_fetch_row("SELECT tbl_post.*,tbl_user.fullname FROM `tbl_post` INNER JOIN tbl_user ON user_id = tbl_post.create_by WHERE `post_id` = {$id} ") ;
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

function update_view_post($id){
    $view = get_post_by_id($id,'view') ;
    $data['view'] = (int)$view + 1 ;
    db_update('tbl_post',$data," post_id = {$id}") ;
}

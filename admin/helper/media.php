<?php

function activate_media($title, $id_connect, $id){
    $data['title'] = filter_str($title) ;
    $data['active'] = 1 ;
    $data['id_connect'] = $id_connect ;
    $result = db_fetch_row("SELECT `url`,`type` FROM tbl_media WHERE media_id = {$id}") ;
    $base_url = 'public/images/'.convert_type_file($result['type']).'/';
    $name_img = to_slug(filter_str($title)) ;
    $data['url'] = $base_url.$name_img.'.png' ;
    if(file_exists($data['url'])){
        $i = 1 ;
        while ($i > 0){
            $name_img = to_slug(filter_str($title)).'(copy-'.$i.')' ;
            $data['url'] = $base_url.$name_img.'.png' ;
            if(file_exists($data['url'])){
                $i++ ;
            }else{
                $i = 0 ;
            }
        }
    }


    if(file_exists($result['url'])){
        rename($result['url'],$data['url']) ;
    }
    db_update('tbl_media',$data, " media_id = {$id}") ;
}

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

function drop_media_by_id($id,$v=false){
    $result = get_media_by_id($id) ;
    if(!empty($result)) {
        if (file_exists($result['url'])) {
            unlink($result['url']);
        }
        if ($v) {
            db_delete('tbl_media', " media_id = {$id}");
        }
    }
}

function update_img_involve($id,$product_id){
    $list_involve = db_fetch_row("SELECT `img_involve` FROM tbl_product WHERE product_id = {$product_id}") ;
    $list_involve = json_decode($list_involve['img_involve']) ;
    $result = array() ;
    foreach ($list_involve as $v ){
        if($v != $id ){
            $result[] = $v ;
        }
    }
    $list_involve = json_encode($result) ;
    db_update('tbl_product',array('img_involve' => $list_involve)," product_id = {$product_id}") ;
}

function drop_media_by_id_conect($id){
    $result = db_fetch_array("SELECT url FROM tbl_media WHERE id_connect IN ({$id}) ") ;
    if(!empty($result)) {
        foreach ($result as $v ){
            $error = true;
            if ($v['active'] == 3) {
                $error = false;
            } elseif (!file_exists($v['url'])) {
                $error = false;
            }
            if ($error) {
                unlink($v['url']);
            }
        }
            db_delete('tbl_media', " id_connect = {$id}");
    }
}

function get_media_default($index=null,$type){

    $result = db_fetch_row("SELECT * FROM tbl_media WHERE type = {$type} && active = 3 ") ;
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
<?php

function add_history($input){
    $data = get_colums_in_array(array('content','type'),$input);
    $data['happen_at'] = time() ;
    $data['user_id'] = get_info_user('id') ;
    if(!isset($input['parent_id'])){
        $info_user = get_info_user() ;
        $result = db_fetch_row(" SELECT MAX(history_id) as max FROM tbl_history WHERE type = 'login' && user_id = {$info_user['id']} ");
        $data['parent_id'] = $result['max'] ;
    }else
        $data['parent_id'] = $input['parent_id'] ;
    db_insert('tbl_history', $data) ;
}


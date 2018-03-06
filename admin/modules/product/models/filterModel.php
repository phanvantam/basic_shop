<?php
function add_filter($data,$id){
    $data['create_at'] = $data['modify_at'] = time() ;
    $data['create_by'] = $data['modify_by'] = $id ;
    $history['content'] = "Đã thêm bộ lọc : {$data['title']}" ;
    $history['type'] = 'add' ;
    add_history($history) ;
    db_insert('tbl_filter',$data) ;
}

function get_filter_by_id($id){
    $result  = db_fetch_row("SELECT * FROM `tbl_filter` WHERE `filter_id` = {$id}");
    if(empty($result)){
        return false ;
    }
    return $result ;
}

function update_filter($data,$filter_id,$id){
    $data['modify_at'] = time() ;
    $data['modify_by'] = $id ;
    $history['content'] = "Đã cập nhập bộ lọc : {$data['title']}" ;
    $history['type'] = 'edit' ;
    add_history($history) ;
    db_update('tbl_filter',$data," `filter_id` = {$filter_id}") ;
}


function get_filter_active($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_filter WHERE active = 1 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY filter_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_filter($sql) ;
    return $result ;
}

function get_filter_pending($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_filter WHERE active = 2 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY filter_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_filter($sql) ;
    return $result ;
}

function get_filter_trash($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_filter WHERE active = 3 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY filter_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_filter($sql) ;
    return $result ;
}

function get_all_filter($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_filter WHERE active != 3 " ;
    if ((bool)$q)
        $sql .= "&& `title` LIKE '%{$q}%' " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY filter_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_filter($sql) ;
    return $result ;
}

function add_url_into_list_filter($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['url']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['filter_id'].'&drop' ;
        $item['url']['edit'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=edit'.'&id='.$item['filter_id'] ;
        $item['url']['public'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['filter_id'].'&public' ;
        $item['url']['pending'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['filter_id'].'&pending' ;
    }
    return $result ;
}

 function get_list_status_of_filter(){
    $sql = "SELECT * FROM tbl_filter WHERE " ;
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
        return $result ;
    }

function public_filter($id){
    db_update('tbl_filter',array('active' =>1 ),"filter_id IN ({$id})") ;
}
function pending_filter($id){
    db_update('tbl_filter',array('active' =>2 ),"filter_id IN ({$id})") ;
}
function drop_filter($id){
    $result = db_fetch_array("SELECT * FROM tbl_filter WHERE filter_id IN ({$id})") ;
    foreach($result as $item ){
        if($item['active'] != 3 ){
            $history['content'] = "Đã đưa bộ lọc : {$item['title']} vào thùng rác " ;
            $history['type'] = 'drop' ;
        } else {
            $history['content'] = "Đã xóa bộ lọc : ' {$item['title']} '.Được tạo lúc ".date('d/m/Y',$item['create_at']) ;
            $history['type'] = 'drop' ;
        }
    }
    add_history($history) ;
    set_notifice_session(create_notifice('Xóa thành công ')) ; 
    db_delete('tbl_filter',"filter_id IN ({$id}) && active = 3 ") ;
    db_update('tbl_filter',array('active' =>3 ),"filter_id IN ({$id})") ;
}
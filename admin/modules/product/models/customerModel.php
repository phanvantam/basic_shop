<?php

function get_customer_by_id($id){
    return db_fetch_row(" SELECT * FROM tbl_customer WHERE customer_id = {$id}") ;
}

function get_list_status_of_page(){
    $sql = "SELECT * FROM tbl_customer WHERE " ;
    $path = base_url().'?controller='. get_controller().'&mod='. get_module().'&action='. get_action() ;
        //ALL
        $result['all']['total'] = db_num_rows($sql.' 1 ') ;
        $result['all']['url'] = $path.'&type=all' ;
        //BUY
        $result['buy']['total'] = db_num_rows($sql.' buy = 1 ') ;
        $result['buy']['url'] = $path.'&type=buy' ;
        //SUBCRIBE
        $result['subcribe']['total'] = db_num_rows($sql.' subcribe = 1 ') ;
        $result['subcribe']['url'] = $path.'&type=subcribe' ;

        return $result ;
    }

function get_customer_buy($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_customer WHERE buy = 1 " ;
    if ((bool)$q)
        $sql .= "&& (`email` LIKE '%{$q}%' || `fullname` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY customer_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = db_fetch_array($sql) ;
    
    return $result ;
}

function get_all_customer($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_customer WHERE 1 " ;
    if ((bool)$q)
        $sql .= "&& (`email` LIKE '%{$q}%' || `fullname` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY customer_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = db_fetch_array($sql) ;
    
    return $result ;
}

function get_customer_subcribe($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = "SELECT * FROM tbl_customer WHERE subcribe = 1 " ;
    if ((bool)$q)
        $sql .= "&& (`email` LIKE '%{$q}%' || `fullname` LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY customer_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = db_fetch_array($sql) ;
    
    return $result ;
}
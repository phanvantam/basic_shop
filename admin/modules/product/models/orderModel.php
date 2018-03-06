<?php 

function get_list_status_of_order(){
    $sql = "SELECT * FROM tbl_order WHERE " ;
    $path = base_url().'?controller='. get_controller().'&mod='. get_module().'&action='. get_action() ;
        //ALL
        $result['all']['total'] = db_num_rows($sql.' active != 4 ') ;
        $result['all']['url'] = $path.'&type=all' ;
        //ACTIVE
        $result['active']['total'] = db_num_rows($sql.' active = 1 ') ;
        $result['active']['url'] = $path.'&type=active' ;
        //Trash
        $result['trash']['total'] = db_num_rows($sql.' active = 4 ') ;
        $result['trash']['url'] = $path.'&type=trash' ;
        //PENDING
        $result['pending']['total'] = db_num_rows($sql.' active = 3 ') ;
        $result['pending']['url'] = $path.'&type=pending' ;
        //SGIPING
        $result['ship']['total'] = db_num_rows($sql.' active = 2 ') ;
        $result['ship']['url'] = $path.'&type=ship' ;
        
        return $result ;
    }

function add_url_into_list_order($sql){
    $result = db_fetch_array($sql) ;
    $base_url = base_url() ;
    foreach ($result as &$item ){
        $item['url']['drop'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['order_id'].'&drop' ;
        $item['url']['public'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['order_id'].'&public' ;
        $item['url']['pending'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['order_id'].'&pending' ;
        $item['url']['ship'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=actions'.'&id='.$item['order_id'].'&ship' ;
        $item['url']['detail'] = $base_url.'?controller='. get_controller().'&mod='. get_module().'&action=detail'.'&id='.$item['order_id'] ;
    }
    return $result ;
}    
    
function get_all_order($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = " SELECT tbl_order.*,tbl_customer.fullname FROM `tbl_order` INNER JOIN tbl_customer ON tbl_order.buyer = tbl_customer.customer_id WHERE active != 4 " ;
    if ((bool)$q)
        $sql .= " && (tbl_order.code_order LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY tbl_order.order_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_order($sql) ;
    
    return $result ;
}

function get_order_active($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = " SELECT tbl_order.*,tbl_customer.fullname FROM `tbl_order` INNER JOIN tbl_customer ON tbl_order.buyer = tbl_customer.customer_id WHERE active = 1 " ;
    if ((bool)$q)
        $sql .= " && (tbl_order.code_order LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY tbl_order.order_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_order($sql) ;
    
    return $result ;
}

function get_order_pending($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = " SELECT tbl_order.*,tbl_customer.fullname FROM `tbl_order` INNER JOIN tbl_customer ON tbl_order.buyer = tbl_customer.customer_id WHERE active = 3 " ;
    if ((bool)$q)
        $sql .= " && (tbl_order.code_order LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY tbl_order.order_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_order($sql) ;
    
    return $result ;
}

function get_order_wait_ship($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = " SELECT tbl_order.*,tbl_customer.fullname FROM `tbl_order` INNER JOIN tbl_customer ON tbl_order.buyer = tbl_customer.customer_id WHERE active = 2" ;
    if ((bool)$q)
        $sql .= " && (tbl_order.code_order LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY tbl_order.order_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_order($sql) ;
    
    return $result ;
}

function get_order_trash($q,$page,$per_page){
    $result['stt'] = $start = $page * $per_page - $per_page ;
    $sql = " SELECT tbl_order.*,tbl_customer.fullname FROM `tbl_order` INNER JOIN tbl_customer ON tbl_order.buyer = tbl_customer.customer_id WHERE active = 4 " ;
    if ((bool)$q)
        $sql .= " && (tbl_order.code_order LIKE '%{$q}%') " ;
    $result['total'] = db_num_rows($sql);
    $result['total_page'] = ceil($result['total'] / $per_page);
    $sql .= " ORDER BY tbl_order.order_id DESC LIMIT {$start},{$per_page} " ;
    $result['data'] = add_url_into_list_order($sql) ;
    
    return $result ;
}

function public_order($id){
    db_update('tbl_order',array('active' =>1 ),"order_id IN ({$id})") ;
}
function pending_order($id){
    db_update('tbl_order',array('active' =>3 ),"order_id IN ({$id})") ;
}
function ship_order($id){
    db_update('tbl_order',array('active' =>2 ),"order_id IN ({$id})") ;
}
function drop_order($id){
    $result = db_fetch_array("SELECT order_id FROM tbl_order WHERE order_id IN ({$id}) && active = 4 ");
    if(!empty($result)){
        $id_drop = array() ;
        foreach($result as $item ){
            $id_drop[] = $item['order_id'] ;
        }
        $id_drop = implode(',', $id_drop);
        db_delete('tbl_detail_order',"order_id IN ({$id_drop})") ;
        db_delete('tbl_order',"order_id IN ({$id_drop})") ;
    }
    db_update('tbl_order',array('active' =>4 ),"order_id IN ({$id})") ;
}

function get_order_by_id($id){
    return db_fetch_row(" SELECT * FROM tbl_order WHERE order_id = {$id}") ;
}

function get_detail_order($id){
    $detail_order = db_fetch_array(" SELECT * FROM tbl_detail_order WHERE order_id = {$id}") ;
    
foreach ($detail_order as &$item ){
    $result = get_product_by_id($item['connect_product']) ;
    $item['url'] = get_media_by_id($result['thumb'], 'url') ;
}
    return $detail_order ;
}
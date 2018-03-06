<?php

function construct(){
    load_model('order') ;
    load_model('index') ;
    load_model('customer') ;
}

function indexAction(){
     global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    
    switch($type){
        case 'trash':
            $result = get_order_trash($q,$page,$per_page) ;
            break ;
        case 'active':
            $result = get_order_active($q,$page,$per_page) ;
            break ;   
        case 'pending':
            $result = get_order_pending($q,$page,$per_page) ;
            break ;    
        case 'ship':
            $result = get_order_wait_ship($q,$page,$per_page) ;
            break ;    
        default :
            $result = get_all_order($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_order'] = $result ;
    $data['list_status'] = get_list_status_of_order() ;
//    show_array($data) ;exit ;
    load_view('indexOrder',$data) ;
}

function detailAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_order = get_order_by_id($id);
    $info_order || redirect('?controller=order&mod=product&action=index') ;
    $data['detail_order'] = get_detail_order($id) ;
    $data['info_order'] = $info_order ;
    $data['info_buyer'] = get_customer_by_id($info_order['buyer']);
    load_view('detailOrder',$data) ;
}

function actionsAction(){
    $id[] = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $type = null ;
    if(isset($_POST['sm_action'])){
        $id = isset($_POST['id']) ? $_POST['id'] : $id ;
        $type = isset($_POST['actions']) ? (int)$_POST['actions'] : $type ;
    }
    $id = implode(',',$id) ;
    if(isset($_GET['public']) || $type == 1 ){
        public_order($id);
    }
    elseif (isset($_GET['pending']) || $type == 3 ){
        pending_order($id) ;
    }
    elseif (isset($_GET['ship']) || $type == 2 ){
        ship_order($id) ;
    }
    elseif (isset($_GET['drop']) || $type == 4 ){
        drop_order($id) ;
    }
    redirect('?mod=product&controller=order&action=index') ;
}


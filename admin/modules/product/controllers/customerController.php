<?php

function construct(){
    load_model('customer') ;
}

function indexAction(){
        global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    
    switch($type){
        case 'subcribe':
            $result = get_customer_subcribe($q,$page,$per_page) ;
            break ;
        case 'buy':
            $result = get_customer_buy($q,$page,$per_page) ;
            break ;       
        default :
            $result = get_all_customer($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_customer'] = $result ;
    $data['list_status'] = get_list_status_of_page() ;
//    show_array($data) ;exit ;
    load_view('indexCustomer',$data) ;
}


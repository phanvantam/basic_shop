<?php
function construct(){
    load_model('index') ;
}

function indexAction(){
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $page = isset($_GET['page'])  && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $type = isset($_GET['type'])  ? (string)$_GET['type'] : 'product' ;
    $data = array() ;
    if(!empty($q)){
        if($type == 'product' ){
            $result = search_product_by_q($q, $page) ;
            $paging['url_page'] = "tim-kiem?type=product&q={$q}&page=" ;
            $paging['total'] = $result['total'] ;
            $data['product'] = $result['data'] ;
        }else{
            $result = search_post_by_q($q, $page) ;
            $paging['url_page'] = "tim-kiem?type=post&q={$q}&page=" ;
            $paging['total'] = $result['total'] ;
            $data['post'] = $result['data'] ;
        }
    }else {
        if($type == 'product' ){
            $result = get_all_product($page) ;
            $paging['url_page'] = "tim-kiem?type=product&page=" ;
            $paging['total'] = $result['total'] ;
            $data['product'] = $result['data'] ;
        }else{
            $result = get_all_post($page) ;
            $paging['active'] = $page ;
            $paging['url_page'] = "tim-kiem?type=post&page=" ;
            $paging['total'] = $result['total'] ;
            $data['post'] = $result['data'] ;
        }
        
    }  
    $paging['active'] = $page ;
    $data['total'] = isset($result['sql']) ? db_num_rows($result['sql']) : 0 ;
    $data['paging'] = $paging ;
    global $request ;
    $request['q'] = $q ;
//    show_array($data) ;die() ;
    $data['type'] = $type ;
    $data['list_discount'] = get_product_discount() ;
    load_view('indexIndex',$data) ;
}
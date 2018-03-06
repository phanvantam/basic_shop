<?php

function construct(){
    load_model('history');
}

function indexAction(){
    global $request ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && (int)$_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    $request['time'] = $time = isset($_GET['time']) && (int)$_GET['time'] > 0 ? (int)$_GET['time'] : 24 ;
    $result = get_list_history($page,$per_page,$time) ;
    $data['list_history'] = $result ;
    $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['page'] = $page ;
//    show_array($data) ;
    load_view('indexHistory',$data) ;
}

function detailAction(){
    global $request ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && (int)$_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    $request['type'] = $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $result = get_history_by_id($id,$page,$per_page,$type) ;
    ( !empty($result) && $result['type'] == 'login' ) || die('No') ;
    $data['title'] = get_info_user_by_id($result['user_id'],'fullname') ;
    $result = get_detail_history($id,$page,$per_page,$type) ;
    $data['list_history'] = $result ;
    $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    load_view('detailHistory',$data) ;
}

function dropAction(){
    $id[] = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    if(!empty($_POST['list_item'])){
        $id = $_POST['list_item'] ;
    }
    $info_user = get_info_user() ;
    $id_max = get_history_id_max($info_user['id']) ;
    foreach($id as $k => $v ){
        if($v == $id_max )
            unset($id[$k]) ;
    }
    $id = implode(',', $id); 
        if(!empty($id)){
            if($info_user['level'] == 1 ){
            db_delete('tbl_history'," parent_id IN({$id}) ") ;
            db_delete('tbl_history'," history_id IN({$id}) ") ;
        }else{
            db_delete('tbl_history'," parent_id IN({$id}) && user_id = {$info_user['id']} ") ;
            db_delete('tbl_history'," history_id IN({$id}) && user_id = {$info_user['id']} ") ;
        }    
    }
    if(isset($_GET['detail'])){
        $path = '?mod=sytem&controller=history&action=detail&id='.$_GET['detail'] ;
        redirect($path);
    }
    else    
        redirect('?mod=sytem&controller=history&action=index');
    
}

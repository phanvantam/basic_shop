<?php

function construct(){
    load_model('support') ;
}

function addAction(){
    global $request,$error ;
    $url_img = get_media_default('url',3) ;

    if(isset($_POST['add'])){
        $request = $_POST ;
        if(empty($request['title'])){
            $error['title'] = 'Không được để trống trường này ' ;
        }
        $info_media = get_media_by_id((int)$request['img_id']) ;
        if(empty($info_media) || $info_media['active'] != 2 ){
            $error['img_id'] = 'Vui lòng tải lên một ảnh ' ;
        }else{
            $url_img = $info_media['url'] ;
        }
        $info_page = db_fetch_row("SELECT * FROM tbl_page WHERE page_id = {$request['page_connect']} ") ;
        $request['link'] = null ;
        if(empty($info_page)){
            $request['page_connect'] = 0 ;
        }else
            $request['link'] = $info_page['slug'].'.html' ;
        if(empty($error)){
            $id_support = add_support($request,get_info_user('id')) ;
            activate_media($request['title'],$id_support,$info_media['media_id']) ;
            redirect("?mod=sytem&controller=support&action=index&type=2") ;
        }
    }
    $request['url'] = $url_img ;
    load_view('addSupport') ;
}

function editAction(){
    $support_id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_support = get_support_by_id($support_id) ;
    $info_support || redirect('?mod=sytem&controller=support&action=index');
    global $request,$error ;
    $url_img = get_media_by_id($info_support['thumb'],'url') ;
    $request = get_colums_in_array(array_keys($info_support),$info_support);
    $request['img_id'] = $info_support['thumb'] ;
   if(isset($_POST['update'])){
        $request = get_colums_in_array(array_keys($_POST),$_POST) ;
        if(empty($request['title'])){
            $error['title'] = 'Không được để trống trường này ' ;
        }
        $info_media = get_media_by_id((int)$request['img_id']) ;
        if(empty($info_media) || $info_media['active'] != 2 ){
            $error['img_id'] = 'Vui lòng tải lên một ảnh ' ;
            if($request['img_id'] == $info_support['thumb']){
                unset($error['img_id']) ;
            }
        }else{
            $url_img = $info_media['url'] ;
        }
        $request['link'] = null ;
        $info_page = db_fetch_row("SELECT * FROM tbl_page WHERE page_id = {$request['page_connect']} ") ;
        if(!$info_page){
            $request['page_connect'] = 0 ;
        }else
            $request['link'] = $info_page['slug'].'.html' ;
        if(empty($error)){
            update_support($request,$support_id,get_info_user('id')) ;
            activate_media($request['title'],$support_id,$info_media['media_id']) ;
            redirect("?mod=sytem&controller=support&action=index") ;
        }
    }
    $data['info_support'] = get_colums_in_array(array('create_at','modify_at'),$info_support) ;
    $request['url'] = $url_img ;
    load_view('editSupport',$data) ;
}

function indexAction(){
global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    
    switch($type){
        case 'trash':
            $result = get_support_trash($q,$page,$per_page) ;
            break ;
        case 'active':
            $result = get_support_active($q,$page,$per_page) ;
            break ;   
        case 'pending':
            $result = get_support_pending($q,$page,$per_page) ;
            break ;      
        default :
            $result = get_all_support($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_support'] = $result ;
    $data['list_status'] = get_list_status_of_support() ;
//    show_array($data) ;exit ;
    load_view('indexSupport',$data) ;
}

function actionsAction(){
    $id[] = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $type = null ;
    if(isset($_POST['sm_action'])){
        $id = isset($_POST['id']) ? $_POST['id'] : $id ;
        $type = isset($_POST['actions']) ? $_POST['actions'] : $type ;
    }
    $id = implode(',',$id) ;
    if(isset($_GET['public']) || $type == 'public' ){
        public_support($id);
    }
    elseif (isset($_GET['pending']) || $type == 'pending' ){
        pending_support($id) ;
    }
    elseif (isset($_GET['drop']) || $type == 'drop' ){
        drop_support($id) ;
    }
    redirect('?mod=sytem&controller=support&action=index') ;
}
<?php

function construct(){
    load_model('slider') ;
}

function addAction(){
    global $request,$error ;
    $request['url_img'] = get_media_default('url',2) ;

    if(isset($_POST['add_slider'])){
        $request = get_colums_in_array(array('title','caption','img_id'),$_POST) ;
        if(empty($request['title'])){
            $error['title'] = 'Không được để trống trường này ' ;
        }
        $info_media = get_media_by_id((int)$request['img_id']) ;
        if(empty($info_media) || $info_media['active'] != 2 ){
            $error['img_id'] = 'Vui lòng tải lên một ảnh ' ;
        }else{
            $request['url_img'] = $info_media['url'] ;
        }
        if(empty($error)){
            $id_slider = add_slider($request,get_info_user('id')) ;
            activate_media($request['title'],$id_slider,$info_media['media_id']) ;
            db_update('tbl_media',array('caption'=>$request['caption'])," media_id = {$info_media['media_id']}") ;
            redirect("?mod=theme&controller=slider&action=index&type=2") ;
        }
    }
    load_view('addSlider') ;
}

function editAction(){
    $slider_id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_slider = get_slider_by_id($slider_id) ;
    $info_slider ||  redirect("?mod=theme&controller=slider&action=index") ; ;
    global $request,$error ;
    $request['url_img'] = get_media_by_id($info_slider['thumb'],'url') ;
    $request['title'] = $info_slider['title'] ;
    $request['caption'] = get_media_by_id($info_slider['thumb'],'caption') ;
    $request['img_id'] = $info_slider['thumb'] ;

    if(isset($_POST['edit_slider'])){
        $request = get_colums_in_array(array('title','caption','img_id'),$_POST) ;
        if(empty($request['title'])){
            $error['title'] = 'Không được để trống trường này ' ;
        }
        $info_media = get_media_by_id((int)$request['img_id']) ;
        if(empty($info_media) || $info_media['active'] != 2 && (int)$request['img_id'] != $info_slider['thumb'] ){
            $error['img_id'] = 'Vui lòng tải lên một ảnh ' ;
        }else{
            $request['url_img'] = $info_media['url'] ;
        }
        if(empty($error)){
            update_slider($request,$slider_id,get_info_user('id')) ;
            activate_media($request['title'],$slider_id,$info_media['media_id']) ;
            db_update('tbl_media',array('caption'=>$request['caption'])," media_id = {$info_media['media_id']}") ;
            redirect("?mod=theme&controller=slider&action=index") ;
        }
    }
    $data['info_slider'] = get_colums_in_array(array('create_at','create_by','modify_at','modify_by'),$info_slider) ;
    load_view('editSlider',$data) ;
}

function indexAction(){
    global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    
    switch($type){
        case 'trash':
            $result = get_slider_trash($q,$page,$per_page) ;
            break ;
        case 'active':
            $result = get_slider_active($q,$page,$per_page) ;
            break ;   
        case 'pending':
            $result = get_slider_pending($q,$page,$per_page) ;
            break ;      
        default :
            $result = get_all_slider($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_slider'] = $result ;
    $data['list_status'] = get_list_status_of_slider() ;
//    show_array($data) ;exit ;
    load_view('indexSlider',$data) ;
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
        public_slider($id);
    }
    elseif (isset($_GET['pending']) || $type == 'pending' ){
        pending_slider($id) ;
    }
    elseif (isset($_GET['drop']) || $type == 'drop' ){
        drop_slider($id) ;
    }
    redirect('?mod=theme&controller=slider&action=index') ;
}
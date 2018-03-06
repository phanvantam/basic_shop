<?php
function construct(){
    load_model('index') ;
}

function addAction(){
    if(isset($_POST['add_page'])){
        global $request ,$error , $notifice ;
        $request['title'] = isset($_POST['title']) ? filter_str($_POST['title']) : null ;
        $request['slug'] = isset($_POST['slug']) ? to_slug(filter_str($_POST['slug'])) : null ;
        $request['content'] = isset($_POST['content']) ? $_POST['content'] : null ;

        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này ' ;
        } elseif (empty($request['slug'])){
            $request['slug'] = to_slug($request['title']) ;
        }

        if(!empty($request['slug']) && exists_slug_page_in_db($request['slug']) ){
            $error['slug'] = 'Slug đã tồn tại ' ;
        }

        if(empty($request['content'])){
            $error['content'] = 'Vui lòng nhập vào nội dung' ;
        }
        if(empty($error)){
            add_page($request, get_info_user('id')) ;
            $history['content'] = 'Thêm trang : '.$request['title'] ;
            $history['type'] = 'add' ;
            add_history($history);
            redirect('?mod=page&controller=index&action=index&type=2') ;
        }
    }
    load_view('addIndex') ;
}

function editAction(){
    $page_id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_page = get_page_by_id($page_id);
    global  $request ;
    $request  = get_colums_in_array(array_keys($info_page),$info_page) ;
    !empty($info_page) || die('page không tồn tại ') ;
    if(isset($_POST['edit_page'])){
        global$error , $notifice ;
        $request['title'] = isset($_POST['title']) ? filter_str($_POST['title']) : null ;
        $request['slug'] = isset($_POST['slug']) ? to_slug(filter_str($_POST['slug'])) : null ;
        $request['content'] = isset($_POST['content']) ? $_POST['content'] : null ;

        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này ' ;
        } elseif (empty($request['slug'])){
            $request['slug'] = to_slug($request['title']) ;
        }

        if(!empty($request['slug']) && exists_slug_page_in_db($request['slug']) ){
            $error['slug'] = 'Slug đã tồn tại ' ;
        }
        if($request['slug'] === $info_page['slug']){
            unset($error['slug']) ;
        }
        if(empty($request['content'])){
            $error['content'] = 'Vui lòng nhập vào nội dung' ;
        }
        if(empty($error)){
            update_page($request,$page_id ,get_info_user('id')) ;
            $notifice['edit_page'] = 'Cập nhập thành công ' ;
            redirect('?mod=page&controller=index&action=index') ;
        }
    }
    $data['info_page'] = $info_page ;
    load_view('editIndex',$data) ;
}

function indexAction(){
    global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    
    switch($type){
        case 'trash':
            $result = get_page_trash($q,$page,$per_page) ;
            break ;
        case 'active':
            $result = get_page_active($q,$page,$per_page) ;
            break ;   
        case 'pending':
            $result = get_page_pending($q,$page,$per_page) ;
            break ;      
        default :
            $result = get_all_page($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_page'] = $result ;
    $data['list_status'] = get_list_status_of_page() ;
//    show_array($data) ;exit ;
    load_view('indexIndex',$data) ;
}

function actionsAction(){
    $id[] = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $type = null ;
    if(isset($_POST['sm_action'])){
        $id = isset($_POST['id']) ? $_POST['id'] : $id ;
        $type = isset($_POST['actions']) ? $_POST['actions'] : $type ;
    }
    
    $id = implode(',',$id) ;
    if(isset($_GET['public']) || $type == 'public' )
        public_page($id);
    elseif (isset($_GET['pending']) || $type == 'pending' )
        pending_page($id) ;
    elseif (isset($_GET['drop']) || $type == 'drop' )
        drop_page($id) ;
    redirect('?mod=page&controller=index&action=index') ;
}
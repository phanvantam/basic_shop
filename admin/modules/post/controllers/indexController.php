<?php
function construct(){
    load_model('index') ;
    load_model('cat') ;
}

function indexAction(){
    global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    
    switch($type){
        case 'trash':
            $result = get_post_trash($q,$page,$per_page) ;
            break ;
        case 'active':
            $result = get_post_active($q,$page,$per_page) ;
            break ;   
        case 'pending':
            $result = get_post_pending($q,$page,$per_page) ;
            break ;      
        default :
            $result = get_all_post($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_post'] = $result ;
    $data['list_status'] = get_list_status_of_post() ;
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
    if((isset($_GET['public']) || $type == 'public' ) && get_info_user('level') != 3 ){
        public_post($id);
    }
    elseif ( (isset($_GET['pending']) || $type == 'pending' ) && get_info_user('level') != 3 ){
        pending_post($id) ;
    }
    elseif (isset($_GET['drop']) || $type == 'drop' ){
        drop_post($id) ;
    }
    redirect('?mod=post&controller=index&action=index') ;
}

function addAction(){
    $url_img = get_media_default('url',2) ;
    if(isset($_POST['add_post'])){
//        show_array($_POST) ;
        global $error ,$request ;
        $request['title'] = isset($_POST['title']) ? filter_str($_POST['title']) : null ;
        $request['name_img'] = isset($_POST['name_img']) ? filter_str($_POST['name_img']) : null ;
        $request['slug'] = isset($_POST['slug']) ? to_slug(filter_str($_POST['slug'])) : null ;
        $request['excerpt'] = isset($_POST['excerpt']) ? htmlentities($_POST['excerpt']) : null ;
        $request['content'] = isset($_POST['content']) ? $_POST['content'] : null ;
        $request['img_id'] = isset($_POST['img_id']) ? (int)$_POST['img_id'] : 0 ;
        $active = $request['cat_id'] = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0 ;

        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này' ;
        }else if(empty($request['slug'])){
            $request['slug'] = to_slug($request['title']) ;
        }


        if(!empty($request['slug']) && exists_slug_post_in_db($request['slug'])){
            $error['slug'] = 'Slug nay đã tồn tại ' ;
        }

        if(empty($request['excerpt'])){
            $error['excerpt'] = 'Không dược bỏ trống trường này ' ;
        }
        if(empty($request['content'])){
            $error['content'] = 'Không dược bỏ trống trường này ' ;
        }

        $info_media = get_media_by_id($request['img_id']) ;
        if( !($info_media && $info_media['type'] == 2 && $info_media['active'] == 2) ){
            $error['img'] = 'Vui lòng tải lên một ảnh cho bài viết ' ;
        }else{
            $url_img = $info_media['url'] ;
        }

        if( !get_cat_by_id($request['cat_id'])){
            $error['cat_id'] = 'Chưa chọn danh mục nào ' ;
        }

        if(empty($error)){
//            show_array($_POST) ;
            $post_id = add_post($request,get_info_user('id')) ;
            activate_media($request['title'],$post_id,$request['img_id']) ;
            redirect('?mod=post&controller=index&action=index') ;
        }
    }
    $list_cat = get_all_cat_post() ;
    if(!empty($list_cat)){
        $result['list_cat'] = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0));
    }
    $result['active'] = isset($active) ? $active : 0 ;
    $result['url_img'] = $url_img ;
    load_view('addIndex',$result) ;
}

function editAction(){
    $post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_post = get_post_by_id($post_id) ;
    $info_post || redirect('?mod=post&controller=index&action=index') ;
    if(get_info_user('level') == 3 ){
        $info_post['create_at'] != get_info_user('id') || redirect('?mod=post&controller=index&action=index') ;
    }
    $url_img = get_media_by_id($info_post['thumbnail'],'url') ;
    global  $request ;
    $request = get_colums_in_array(array('title','slug','excerpt','content'),$info_post) ;
    $request['img_id'] = $info_post['thumbnail'] ;
    $active = $info_post['cat_id'] ;
    if(isset($_POST['edit_post'])){
//        show_array($_POST) ;
        global $error ,$notifice ;
        $request['title'] = isset($_POST['title']) ? filter_str($_POST['title']) : null ;
        $request['name_img'] = isset($_POST['name_img']) ? filter_str($_POST['name_img']) : null ;
        $request['slug'] = isset($_POST['slug']) ? to_slug(filter_str($_POST['slug'])) : null ;
        $request['excerpt'] = isset($_POST['excerpt']) ? htmlentities($_POST['excerpt']) : null ;
        $request['content'] = isset($_POST['content']) ? $_POST['content'] : null ;
        $request['img_id'] = isset($_POST['img_id']) ? (int)$_POST['img_id'] : 0 ;
        $active = $request['cat_id'] = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0 ;

        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này' ;
        }elseif(empty($request['slug'])){
            $request['slug'] = to_slug($request['title']) ;
        }


        if(!empty($request['slug']) && exists_slug_post_in_db($request['slug'])){
            $error['slug'] = 'Slug nay đã tồn tại ' ;
        }
        if($request['slug'] === $info_post['slug']){
            unset($error['slug']) ;
        }

        if(empty($request['excerpt'])){
            $error['excerpt'] = 'Không dược bỏ trống trường này ' ;
        }
        if(empty($request['content'])){
            $error['content'] = 'Không dược bỏ trống trường này ' ;
        }

        $info_media = get_media_by_id($request['img_id']) ;
        if( !($info_media && $info_media['type'] == 2 ) ){
            $error['img'] = 'Vui lòng tải lên một ảnh cho bài viết ' ;
        }else{
            $url_img = $info_media['url'] ;
        }

        if( !get_cat_by_id($request['cat_id'])){
            $error['cat_id'] = 'Chưa chọn danh mục nào ' ;
        }
        if(empty($error)){
//            show_array($_POST) ;
            update_post($request,$post_id,get_info_user('id')) ;
            activate_media($request['title'],$info_post['post_id'],$request['img_id']) ;
            $notifice['edit_post'] = 'Cập nhập bài viết thành công ' ;
            redirect('?mod=post&controller=index&action=index') ;
        }
    }
    $list_cat = get_all_cat_post() ;
    if(!empty($list_cat)){
        $result['list_cat'] = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0));
    }
    $result['url_img'] = $url_img ;
    $result['active'] = $active ;
    $result['info_post'] = get_colums_in_array(array('modify_at','modify_by','create_at','create_by'),$info_post) ;
    load_view('editIndex',$result) ;
}
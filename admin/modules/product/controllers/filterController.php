<?php
function construct(){
    load_model('cat') ;
    load_model('filter') ;
}

function addAction(){
    if(isset($_POST['add_filter'])){
        global $request ,$error ;
        $request['title'] = isset($_POST['title']) ? $_POST['title'] : null ;
        $request['type'] = !empty($_POST['type_filter']) && $_POST['type_filter'] < 3 ? $_POST['type_filter'] : 1 ;
        if(empty($request['title'])){
            $error['title'] = 'Vui lòng nhập tên bộ lọc' ;
        }
        if($request['type'] == 1){
            $request['min_price'] = !empty((int)$_POST['min_price']) ? str_replace(',','',filter_str($_POST['min_price'])) : 0 ;
            $request['max_price'] = !empty($_POST['max_price']) ? str_replace(',','',filter_str($_POST['max_price'])) : 0 ;
            if($request['min_price'] < 0 ){
                $error['min_price'] = 'Gía phải lớn hơn không ' ;
            }
            if($request['max_price'] <= $request['min_price']){
                $error['max_price'] = 'Gía kết thúc phải cao hơn giá bắt dầu' ;
            }
            if(empty($error)){
                $data_add = get_colums_in_array(array('title','min_price','max_price','type'),$request) ;
            }
        }else{
            $active = $request['cat_id'] = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 1 ;
            $result = get_cat_by_id($request['cat_id']) ;
            if(empty($result) || $result['active'] > 1){
                $error['cat_id'] = 'Vui lòng chọn một danh mục ' ;
            }
            $data_add = get_colums_in_array(array('title','cat_id','type'),$request) ;
        }
        if(empty($error)){
            add_filter($data_add,get_info_user('id')) ;
            redirect('?mod=product&controller=filter&action=index&type=2') ;
        }
        if(isset($request['max_price']) && isset($request['min_price'])){
            $request['max_price'] = number_format($request['max_price']) ;
            $request['min_price'] = number_format($request['min_price']) ;
        }
    }
    $list_cat = get_all_cat_product() ;
    if(!empty($list_cat)){
        $data['list_cat'] = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0),true);
    }
    $data['type_filter'] = isset($request['type']) ? $request['type'] : 1 ;
    load_view('addFilter', $data);
}

function editAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_filter = get_filter_by_id($id) ;
    $info_filter || redirect("?mod=product&controller=filter&action=index") ; ;
    global $request ;
    $request = $info_filter ;
    if(isset($_POST['edit_filter'])){
        $request = array() ;
        global $error ;
        $request['title'] = isset($_POST['title']) ? $_POST['title'] : null ;
        $request['type'] = !empty($_POST['type_filter']) && $_POST['type_filter'] < 3 ? $_POST['type_filter'] : 1 ;
        if(empty($request['title'])){
            $error['title'] = 'Vui lòng nhập tên bộ lọc' ;
        }
        if($request['type'] == 1){
            $request['min_price'] = isset($_POST['min_price']) ? str_replace(',','',filter_str($_POST['min_price'])) : 0 ;
            $request['max_price'] = !empty($_POST['max_price']) ? str_replace(',','',filter_str($_POST['max_price'])) : 0 ;
            if($request['min_price'] < 0 ){
                $error['min_price'] = 'Gía phải lớn hơn không ' ;
            }
            if($request['max_price'] <= $request['min_price']){
                $error['max_price'] = 'Gía kết thúc phải cao hơn giá bắt dầu' ;
            }
            if(empty($error)){
                $data_edit = get_colums_in_array(array('title','min_price','cat_id','max_price','type'),$request) ;
            }
        }else{
            $active = $request['cat_id'] = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 1 ;
            $result = get_cat_by_id($request['cat_id']) ;
            if(empty($result)  || $result['active'] > 1){
                $error['cat_id'] = 'Vui lòng chọn một danh mục ' ;
            }
            $data_edit = get_colums_in_array(array('title','cat_id','type','min_price','max_price'),$request) ;
        }
        if(empty($error)){
            update_filter($data_edit,$info_filter['filter_id'],get_info_user('id')) ;
            redirect("?mod=product&controller=filter&action=index") ;
        }
    }
    $list_cat = get_all_cat_product() ;
    if(!empty($list_cat)){
        $data['list_cat'] = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0),true);
    }
    if(isset($request['max_price']) && isset($request['min_price'])){
        $request['max_price'] = number_format($request['max_price']) ;
        $request['min_price'] = number_format($request['min_price']) ;
    }

    $data['info_filter'] = get_colums_in_array(array('modify_at','modify_by'),$info_filter);
    load_view('editFilter', $data);
}

function indexAction(){
    global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    
    switch($type){
        case 'trash':
            $result = get_filter_trash($q,$page,$per_page) ;
            break ;
        case 'active':
            $result = get_filter_active($q,$page,$per_page) ;
            break ;   
        case 'pending':
            $result = get_filter_pending($q,$page,$per_page) ;
            break ;      
        default :
            $result = get_all_filter($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_filter'] = $result ;
    $data['list_status'] = get_list_status_of_filter() ;
//    show_array($data) ;exit ;
    load_view('indexFilter',$data) ;
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
        public_filter($id);
    }
    elseif (isset($_GET['pending']) || $type == 'pending' ){
        pending_filter($id) ;
    }
    elseif (isset($_GET['drop']) || $type == 'drop' ){
        drop_filter($id) ;
    }
    redirect('?mod=product&controller=filter&action=index') ;
}
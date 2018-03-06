<?php
function construct(){
    load_model('cat') ;
}
function addAction(){
    if(isset($_POST['add'])){
        global $request, $error, $notifice ;
        $request['title'] = isset($_POST['title']) ? filter_str($_POST['title']) : null ;
        $request['slug'] = isset($_POST['slug']) ? filter_str($_POST['slug']) : null ;
        $active = $request['parent_cat'] = isset($_POST['parent_cat']) ? (int)$_POST['parent_cat'] : 0 ;

        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này ' ;
        }
        elseif(exists_title_in_db($request['title'])){
            $error['title'] = 'Tiêu đề này dã tồn tại  ' ;
        }
        elseif(empty($request['slug'])){
            $request['slug'] = $request['title'] ;
        }

        if(!empty($request['slug'])){
            $request['slug'] = to_slug($request['slug']) ;
        }
        if(exists_slug_in_db($request['slug'])){
            $error['slug'] = 'Slug đã tồn tại ' ;
        }

        if(!empty($request['parent_cat']) && !get_cat_by_id($request['parent_cat']) ){
            $request['parent_cat'] = 0 ;
        }
        if(empty($error)){
            add_cat($request,get_info_user('id')) ;
            redirect('?mod=post&controller=cat&action=index&type=2') ;
        }
    }
    $list_cat = get_all_cat_post() ;
    if(!empty($list_cat)){
        $data['list_cat'] = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0));
    }
    load_view('addCat',$data) ;
}

function editAction(){
    $cat_id = empty($_GET['id']) ? 0 : (int)$_GET['id'] ;
    $info_cat = get_cat_by_id($cat_id) ;
    $info_cat || redirect('?mod=post&controller=cat&action=index') ; 
    global $request, $error ;
    $request = get_colums_in_array(array_keys($info_cat),$info_cat);
    if(isset($_POST['edit'])){
        $request['title'] = isset($_POST['title']) ? filter_str($_POST['title']) : null ;
        $request['slug'] = isset($_POST['slug']) ? filter_str($_POST['slug']) : null ;
        $request['parent_cat'] = isset($_POST['parent_cat']) ? (int)$_POST['parent_cat'] : 0 ;
        $cat_active = $request['active'] = isset($_POST['active']) ? (int)$_POST['active'] : 2 ;

        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này ' ;
        }
        elseif(exists_title_in_db($request['title'])){
            $error['title'] = 'Tiêu đề này dã tồn tại  ' ;
        }
        elseif(empty($request['slug'])){
            $request['slug'] = $request['title'] ;
        }
        if($info_cat['title'] === $request['title']){
            unset($error['title']) ;
        }

        if(!empty($request['slug'])){
            $request['slug'] = to_slug($request['slug']) ;
        }
        if(exists_slug_in_db($request['slug'])){
            $error['slug'] = 'Slug đã tồn tại ' ;
        }
        if($info_cat['slug'] === $request['slug']){
            unset($error['slug']) ;
        }

        if(!empty($request['parent_cat']) && !get_cat_by_id($request['parent_cat']) ){
            $request['parent_cat'] = 0 ;
        } elseif ($info_cat['cat_id'] == $request['parent_cat']){
            $request['parent_cat'] = $info_cat['parent_id'] ;
        }else{
            $result = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>$info_cat['cat_id']));
            $result = check_value_exits_array($request['parent_cat'],array('data'=>$result,'k'=>array('cat_id'))) ;
            if($result){
                $request['parent_cat'] = $info_cat['parent_id'] ;
            }
        }

        if(empty($error)){
            update_cat($request,get_info_user('id'), $cat_id) ;
            redirect('?mod=post&controller=cat&action=index') ;
        }
    }
    $list_cat = get_all_cat_post() ;
    $data['info_cat'] = $info_cat ;
    $data['list_cat'] = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0));
    load_view('editCat',$data) ;
}

function indexAction(){
    $list_cat = get_all_cat_post() ;
    if(!empty($list_cat)){
        if(isset($_POST['sm_search']) && isset($_POST['cat_id']) && (int)$_POST['cat_id'] > 0 ){
            global $request ;
            $request['active'] = $cat_id =  (int)$_POST['cat_id'] ;
            $list_cat = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>$cat_id));
            $list_cat[] = get_cat_by_id($cat_id) ;
        }else{

        }$list_cat = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0));
        $data['list_cat'] = convert_level_to_str($list_cat,'---','title') ;
        $data['data_select'] = convert_show_select(get_cat_by_parent_id(0),array('k'=>'cat_id','v'=>'title')) ;
    }
    load_view('indexCat',$data) ;
}

function actionsAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    if(isset($_GET['public'])){
        public_cat($id);
    }
    elseif (isset($_GET['pending'])){
        pending_cat($id) ;
    }elseif(isset($_GET['drop'])){
        drop_cat($id) ;
    }
    redirect('?mod=post&controller=cat&action=index') ;
}
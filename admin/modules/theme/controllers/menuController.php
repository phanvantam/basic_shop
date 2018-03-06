<?php
function construct(){
    load_model('menu') ;
}

function addAction(){
    if(isset($_POST['add_menu'])){
        global $request ,$error ;
        $request = $_POST ;
        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này ' ;
        } 
        switch ($request['location']){
            case 2:$info_menu = get_menu_by_id($request['parent_footer']) ;
                    if(!empty($request['parent_id']) && !$info_menu && $info_menu['parent_id'] > 0 && $info_menu['parent_id'] != 2 ){
                        $error['parent_footer'] = 'Vui lòng chọn một danh mục' ;
                    }else{
                        $request['parent_id'] = $request['parent_footer'] ;
                    }
                    break;
            case 3: $info_menu = get_menu_by_id($request['parent_sidebar']) ;  
                    if( !empty($request['parent_sidebar']) && (empty($info_menu) || $info_menu['location'] != 3) ){
                        $error['parent_sidebar'] = 'Vui lòng chọn một danh mục' ;
                    }else{
                        $request['parent_id'] = $request['parent_sidebar'] ;
                    }
                    break;
            case 4: $info_menu = get_menu_by_id($request['parent_respon']) ;  
                    if(  !empty($request['parent_sidebar']) && (empty($info_menu) || $info_menu['location'] != 4) ){
                        $error['parent_respon'] = 'Vui lòng chọn một danh mục' ;
                    }else{
                        $request['parent_id'] = $request['parent_respon'] ;
                    }
                    break;
            default : $request['parent_id'] = 0 ;        
        }
        if(empty($request['ordinal'])){
            $request['ordinal'] = 1 ;
        }

        if($request['type'] == 3 ){
            $active = $request['cat_product'] = isset($_POST['cat_product']) ? (int)$_POST['cat_product'] : 0 ;
            $info_cat = db_fetch_row("SELECT active,slug FROM tbl_category WHERE cat_id = {$active} && type = 2 && active = 1 ") ;
            if( empty($info_cat))
                $error['cat_product'] = 'Vui lòng chọn một danh mục ' ;
            else 
                $link = 'san-pham/'.$info_cat['slug'] ;
        }elseif($request['type'] == 2 ){
            $active = $request['cat_post'] = isset($_POST['cat_post']) ? (int)$_POST['cat_post'] : 0 ;
            $info_cat = db_fetch_row("SELECT active,slug FROM tbl_category WHERE cat_id = {$active} && type = 1 && active = 1 ") ;
            if( empty($info_cat))
                $error['cat_post'] = 'Vui lòng chọn một danh mục ' ;
            else 
                $link = 'tin-tuc/'.$info_cat['slug'] ;
        }elseif($request['type'] == 1 ){
            $active = $request['page_id'] = isset($_POST['page_id']) ? (int)$_POST['page_id'] : 0 ;
            $info_page = db_fetch_row("SELECT * FROM tbl_page WHERE page_id = {$active} && active = 1 ") ;
            if( empty($info_page))
                $error['page_id'] = 'Vui lòng chọn một trang' ;
            else 
                $link = $info_page['slug'].'.html' ;
        }elseif($request['type'] == 4){
            $link = 'trang-chu.html';
        }

        if(empty($error)){
            
            $data_add = get_colums_in_array(array('title','parent_id','type','ordinal','location'),$request) ;
            $data_add['link'] = $link ;
            $data_add['connect_to'] = $active ;
            add_menu($data_add, get_info_user('id')) ;
            redirect('?mod=theme&controller=menu&action=index') ;
        }
    }
    $data['menu_active'] = isset($request['parent_id']) ? $request['parent_id'] : 0 ;
    $data['type'] = isset($request['type']) ? $request['type'] : 1 ;
    $data['active'] = isset($active) ? $active : 0 ;
    $data['location_active'] = isset($request['location']) ? $request['location'] : 1 ;
    load_view('addMenu',$data) ;
}

function editAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_menu = get_menu_by_id($id) ;
    $info_menu || die('Menu không tồn tại ');
    global $request ;
    $request = $info_menu ;
    switch ($info_menu['location']){
        case 2 : $request['parent_footer'] = $info_menu['parent_id'] ;
            break;
        case 3 : $request['parent_sidebar'] = $info_menu['parent_id'] ;
            break;
        case 4 : $request['parent_respon'] = $info_menu['parent_id'] ;
            break;
    }
    $active = $info_menu['connect_to'] ;
    $data['info_menu'] = get_colums_in_array(array('modify_at','modify_by'),$info_menu) ;
    if(isset($_POST['edit_menu'])){
        global $error ;
        $request = get_colums_in_array(array_keys($_POST),$_POST) ;
        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này ' ;
        }
         switch ($info_menu['location']){
            case 2:$info = get_menu_by_id($request['parent_footer']) ;
                    if(!empty($request['parent_id']) && !$info && $info['parent_id'] > 0 && $info['parent_id'] != 2 ){
                        $error['parent_footer'] = 'Vui lòng chọn một danh mục' ;
                    }else{
                        $request['parent_id'] = $request['parent_footer'] == $info_menu['menu_id'] ? $info_menu['parent_id'] : $request['parent_footer'] ;
                    }
                    break;
            case 3: $info = get_menu_by_id($request['parent_sidebar']) ;  
                    if( !empty($request['parent_sidebar']) && (empty($info) || $info['location'] != 3) ){
                        $error['parent_sidebar'] = 'Vui lòng chọn một danh mục' ;
                    }else{
                        $request['parent_id'] = $request['parent_sidebar'] == $info_menu['menu_id'] ? $info_menu['parent_id'] : $request['parent_sidebar'] ;
                    }
                    break;
            case 4: $info = get_menu_by_id($request['parent_respon']) ;  
                    if(  !empty($request['parent_sidebar']) && (empty($info) || $info['location'] != 4) ){
                        $error['parent_respon'] = 'Vui lòng chọn một danh mục' ;
                    }else{
                        $request['parent_id'] = $request['parent_respon'] == $info_menu['menu_id'] ? $info_menu['parent_id'] : $request['parent_respon'] ;
                    }
                    break;
            default : $request['parent_id'] = 0 ;        
        }
        if(empty($request['ordinal'])){
            $request['ordinal'] = 1 ;
        }
        if($request['type'] == 3 ){
            $active = $request['cat_product'] = isset($_POST['cat_product']) ? (int)$_POST['cat_product'] : 0 ;
            $info_cat = db_fetch_row("SELECT active,slug FROM tbl_category WHERE cat_id = {$active} && type = 2 && active = 1 ") ;
            if( empty($info_cat))
                $error['cat_product'] = 'Vui lòng chọn một danh mục ' ;
            else 
                $link = 'san-pham/'.$info_cat['slug'] ;
        }elseif($request['type'] == 2 ){
            $active = $request['cat_post'] = isset($_POST['cat_post']) ? (int)$_POST['cat_post'] : 0 ;
            $info_cat = db_fetch_row("SELECT active,slug FROM tbl_category WHERE cat_id = {$active} && type = 1 && active = 1 ") ;
            if( empty($info_cat))
                $error['cat_post'] = 'Vui lòng chọn một danh mục ' ;
            else 
                $link = $info_cat['slug'] ;
        }elseif($request['type'] == 1 ){
            $active = $request['page_id'] = isset($_POST['page_id']) ? (int)$_POST['page_id'] : 0 ;
            $info_page = db_fetch_row("SELECT * FROM tbl_page WHERE page_id = {$active} && active = 1 ") ;
            if( empty($info_page))
                $error['page_id'] = 'Vui lòng chọn một trang' ;
            else 
                $link = $info_page['slug'].'.html' ;
        }elseif($request['type'] == 4){
            $link = 'trang-chu.html';
        }
        
        if(empty($error)){
            $data_add = get_colums_in_array(array('title','parent_id','type','ordinal'),$request) ;
            $data_add['link'] = $link ;
            $data_add['connect_to'] = $active ;
            update_menu($data_add,$id,get_info_user('id')) ;
            redirect('?mod=theme&controller=menu&action=index') ;
        }
    }
    $data['type'] = $request['type'] ;
    $data['active'] = $active ;
    $data['location_active'] = isset($request['location']) ? $request['location'] : 1 ;
    load_view('editMenu', $data) ;
}

function indexAction(){
    $list_menu = get_all_menu() ;
    if(!empty($list_menu)){
        if(isset($_POST['sm_search']) && isset($_POST['menu_id']) && (int)$_POST['menu_id'] > 0 ){
            $active = $menu_id =  (int)$_POST['menu_id'] ;
            $list_menu = multi_data_add_level($list_menu,array('name_id'=>'menu_id','level'=>0,'parent_id'=>$menu_id));
            $list_menu[] = get_menu_by_id($menu_id) ;
        }
        $list_menu = multi_data_add_level($list_menu,array('name_id'=>'menu_id','level'=>0,'parent_id'=>0));
        $data['list_menu'] = convert_level_to_str($list_menu,'---','title') ;
        $data['data_select'] = convert_show_select(get_menu_select_filter(),array('k'=>'menu_id','v'=>'title')) ;
    }
    $data['active'] = isset($active) ? $active : 0 ;
    load_view('indexMenu',$data) ;
}

function actionsAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    if(isset($_GET['public'])){
        public_menu($id);
    }
    elseif (isset($_GET['pending'])){
        pending_menu($id) ;
    }elseif (isset($_GET['drop'])) {
        drop_menu($id) ;
    }
    redirect('?mod=theme&controller=menu&action=index') ;
}
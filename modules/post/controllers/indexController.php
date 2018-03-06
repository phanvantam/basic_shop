<?php
function construct(){
    load_model('cat') ;
    load_model('index') ;
}

function detailAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_post = get_post_by_id($id) ;
    !empty($info_post) && $info_post['active'] == 1 || redirect(base_url().'trang-chu.html') ;
    $data['post'] = $info_post ;
    $result = get_session('view') ;
    $views = $result['view'] ;
    if(boolval($views)){
        if($views['time'] > time() - 60*5 ){
            if(!in_array($id,$views['data'] )){
                $_SESSION['view']['data'][] = $id ;    
                update_view_post($id);
            }
        }else{
            update_view_post($id);
            $view['data'][] = $id ;
            $view['time'] = time() ;
            set_session($view,'view');
        }
    }else{
        update_view_post($id);
        $view['data'][] = $id ;
        $view['time'] = time() ;
        set_session($view,'view');
    }
    $data['cat'] = get_cat_by_id($info_post['cat_id']) ;
    $data['list_discount'] = get_product_discount() ;
    load_view('detailIndex',$data) ;
}
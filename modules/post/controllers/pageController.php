<?php

function construct(){
    load_model('page');
}

function indexAction(){
    if(!empty($_GET['id'])){
        $id = (int)$_GET['id'] ;
        $info_page = get_page_by_id($id) ;
    }
    elseif(!empty($_GET['slug'])){
        $slug = (string)$_GET['slug'] ;
        $info_page = get_page_by_slug($slug) ;
    }
    
    $info_page || redirect(base_url().'trang-chu.html') ;
    $data['page'] = $info_page ;
    $data['list_favorite'] = get_product_favorite() ;
    load_view('indexPage',$data) ;
}
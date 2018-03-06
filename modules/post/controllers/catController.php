<?php

function construct(){
    load_model('cat') ;
}

function indexAction(){
    $data = array() ;
    if(!empty($_GET['id'])){
        $cat_id = (int)$_GET['id'] ;
        $info_cat = get_cat_by_id($cat_id) ;
    }
    elseif(!empty($_GET['slug'])){
        $slug = (string)$_GET['slug'] ;
        $info_cat = get_cat_by_slug($slug) ;
    }
    
    $cat_id = !empty($info_cat) ? $info_cat['cat_id'] : redirect(base_url().'trang-chu.html') ;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
    $list_cat = get_list_cat_post() ;                       
    $children = multi_data_add_level($list_cat,$cat_id,1,array('name_id'=>'cat_id'));
    $per_page = get_info_sytem('per_page') ;
    $start = $page * $per_page - $per_page ;
    $id_query[] = $cat_id ;
    //Lấy ra danh mục con nếu có 
    if(!empty($children)){
    foreach ($children as $item){
          $id_query[] = $item['cat_id'] ;                          
         }
    }                       
    $id_query = implode(',', $id_query) ;
    $sql = "SELECT post.*,media.url,user.fullname FROM tbl_post as post INNER  JOIN tbl_media as media ON post.thumbnail = media.media_id INNER  JOIN tbl_user as user ON post.create_by = user.user_id WHERE post.cat_id IN ({$id_query}) " ;
    $data['paging']['total'] = total_page_by_query($sql, $per_page);
    $data['paging']['active'] = $page ;
    $data['paging']['url'] = base_url().$info_cat['slug'].'?page=' ;
    $sql .= " ORDER BY post.post_id DESC LIMIT {$start},{$per_page} " ;
    $data['post']['data'] = add_path_post($sql) ;
    $data['post']['title'] = $info_cat['title'] ;
    $data['post']['slug'] = $info_cat['slug'] ;
    $data['list_favorite'] = get_product_favorite() ;  
//    show_array($data['post']) ;exit();
    load_view('indexCat',$data) ;
}
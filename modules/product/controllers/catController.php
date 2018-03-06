<?php

function construct(){
    load_model('cat') ;
}

function indexAction(){
    $sort = array() ;
    $sort[2] = ' ORDER BY product.name DESC ' ;
    $sort[1] = ' ORDER BY product.name ASC ' ;
    $sort[4] = ' ORDER BY product.price ASC ' ;
    $sort[3] = ' ORDER BY product.price DESC ' ;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1 ;
    $data['ordinal'] = $ordinal = isset($_GET['ordinal']) && (int)$_GET['ordinal'] <= count($sort) && (int)$_GET['ordinal'] > 0 ? (int)$_GET['ordinal'] : 2 ;
    if(isset($_GET['r_cat'])){
        $info_filter = get_filter_by_id($_GET['r_cat']) ;
        if(!empty($info_filter))
            $cat_id = $info_filter['cat_id'] ;
        else
            $cat_id = 0 ;
    }
    
    $data['filter_active'] = get_colums_in_array(array('r_cat','r_price'),$_GET);
     if( isset($_GET['slug']) && !empty($cat_id) ){
        $cat_id = isset($_GET['id']) ? $_GET['id'] : $cat_id ;
        $info_cat = get_cat_by_id($cat_id) ;
    }
    elseif(!empty($_GET['slug'])){
        $slug = (string)$_GET['slug'] ;
        $info_cat = get_cat_by_slug($slug) ;
    }
    $paging['url'] = 'san-pham/'.$_GET['slug'].'?' ;
    $cat_id = !empty($info_cat) ? $info_cat['cat_id'] : redirect(base_url().'trang-chu.html') ;
    $list_cat = get_list_cat_product() ;                       
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
    $sql = "SELECT product.slug,product.name,product.product_id,product.price,product.discount, media.url FROM tbl_product as product INNER JOIN tbl_media as media ON media.media_id = product.thumb WHERE cat_id IN({$id_query})" ;
    if(isset($_GET['r_price'])){
        $filter_id = (int)$_GET['r_price'] ;
        $info_filter = get_filter_by_id($filter_id) ;
        $q_price = " && product.price BETWEEN {$info_filter['min_price']} AND {$info_filter['max_price']}" ;
    }
    $sql = isset($q_price) ? $sql.$q_price : $sql ;
    $total_page = total_page_by_query($sql, $per_page) ;
    $sql .= " {$sort[$ordinal]} LIMIT {$start},{$per_page}" ;
    $product['total'] = db_num_rows($sql) ;
    $product['data'] = add_path_product($sql) ;  
    $product['title'] = $info_cat['title'] ;
    $data['paging']['active'] = $page ;
    $paging['total_page'] = $total_page ;
    $paging['active'] = $page ;
    ;
    if(isset($_GET['r_price']) && isset($_GET['r_cat']))
        $paging['url'] = $paging['url'].'r_price='.$_GET['r_price'].'&r_cat='.$_GET['r_cat'].'&page=' ;
    else{    
        if(isset($_GET['r_price']))
            $paging['url'] = $paging['url'].'r_price='.$_GET['r_price'].'&page=' ;
        elseif(isset($_GET['r_cat']))
            $paging['url'] = $paging['url'].'r_cat='.$_GET['r_cat'].'&page=' ;
        else{
            $paging['url'] = $paging['url'].'page=' ;
        }
    }    
    $data['paging'] = $paging ;
    $product['slug'] = $info_cat['slug'] ;
    $data['product'] = $product ;
    load_view('indexCat',$data) ;                        
}
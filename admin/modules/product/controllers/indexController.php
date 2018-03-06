<?php
// Controller xư lý product

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
            $result = get_product_trash($q,$page,$per_page) ;
            break ;
        case 'active':
            $result = get_product_active($q,$page,$per_page) ;
            break ;   
        case 'pending':
            $result = get_product_pending($q,$page,$per_page) ;
            break ;    
        case 'favorite':
            $result = get_product_favorite($q,$page,$per_page) ;
            break ;      
        default :
            $result = get_all_product($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_product'] = $result ;
    $data['list_status'] = get_list_status_of_product() ;
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
    if(isset($_GET['public']) || $type == 'public' ){
        public_product($id);
    }
    elseif (isset($_GET['pending']) || $type == 'pending' ){
        pending_product($id) ;
    }
    elseif (isset($_GET['drop']) || $type == 'drop' ){
        drop_product($id) ;
    }
    elseif (isset($_GET['favorite'])){
        favorite_product($id) ;
    }
    redirect('?mod=product&controller=index&action=index') ;
}

function addAction(){
    global $request ;
    $request['url_img'] = get_media_default('url',2) ;
    if(isset($_POST['add_product'])){
        global $error  ;
        $request['title'] = isset($_POST['title']) ? filter_str($_POST['title']) : null ;
        $request['slug'] = isset($_POST['slug']) ? to_slug(filter_str($_POST['slug'])) : null ;
        $request['info'] = isset($_POST['info']) ? htmlentities($_POST['info']) : null ;
        $request['depict'] = isset($_POST['depict']) ? $_POST['depict'] : null ;
        $request['img_id'] = isset($_POST['img_id']) ? (int)$_POST['img_id'] : 0 ;
        $request['cat_id'] = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0 ;
        $request['price'] = isset($_POST['price']) ? str_replace(',','',filter_str($_POST['price'])) : null ;
        $request['total_product'] = isset($_POST['total_product']) && $_POST['total_product'] > 0  ? filter_str($_POST['total_product']) : null ;


        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này' ;
        }elseif(empty($request['slug'])){
            $request['slug'] = to_slug($request['title']) ;
        }

        if(empty($request['price'])){
            $error['price'] = 'Vui lòng nhập vào giá' ;
        }
        elseif (isset($_POST['show-discount'])){
            $request['percen'] = isset($_POST['percen']) && $_POST['percen'] > 0 ? filter_str($_POST['percen']) : null ;
            $request['discount'] = isset($_POST['discount']) ? str_replace(' ','',filter_str($_POST['discount'])) : null ;
            if( empty($request['percen']) && !empty($request['discount'])){
                $error['percen'] = 'Vui lòng nhập phần trăm' ;
            }
            if( !empty($request['percen']) && empty($request['discount'])){
                $error['discount'] = 'Vui lòng nhập giá khuyến mại' ;
            }
        }
        if(!empty($request['slug']) && exists_slug_product_in_db($request['slug'])){
            $error['slug'] = 'Slug nay đã tồn tại ' ;
        }

        if(empty($request['total_product'])){
            $error['total_product'] = 'Vui lòng nhập số lượng của sản phẩm ' ;
        }
        if(empty($request['info'])){
            $error['info'] = 'Không dược bỏ trống trường này ' ;
        }
        if(empty($request['depict'])){
            $error['depict'] = 'Không dược bỏ trống trường này ' ;
        }

        $info_media = get_media_by_id($request['img_id']) ;
        if( !($info_media && $info_media['type'] == 3) ){
            $error['img'] = 'Vui lòng tải lên một ảnh cho bài viết ' ;
        }else{
            $request['url_img'] = $info_media['url'] ;
        }

        if(!empty($_POST['img_involve'])){
            foreach ($_POST['img_involve'] as $v ){
                if($v > 0 ){
                    $data_img = get_media_by_id($v) ;
                    if($data_img){
                        $list_involve[] = get_colums_in_array(array('media_id','url','active'),$data_img) ;
                    }
                }

            }
        }

        if( !get_cat_by_id($request['cat_id'])){
            $error['cat_id'] = 'Chưa chọn danh mục nào ' ;
        }
        if(empty($error)){
            $product_id = add_product($request,get_info_user('id')) ;
            activate_media($request['title'],$product_id,$request['img_id']) ;
            if(!empty($list_involve )){
                foreach ($list_involve as &$v ){
                    if( $v['active'] == 2 ){
                        activate_media($request['title'],$product_id,$v['media_id']) ;
                        $v['url'] = get_media_by_id($v['media_id'],'url') ;
                    }
                    $img_involve[] = $v['media_id'] ;
                }
                db_update('tbl_product',array('img_involve'=>json_encode($img_involve))," product_id = {$product_id}") ;
            }
            redirect('?mod=product&controller=index&action=index&type=2') ;
        }
        $request['price'] = empty($request['price']) ? 0 : number_format($request['price']) ;
        $request['discount'] = empty($request['discount']) ? 0 : number_format($request['discount']) ;
    }
    if(isset($list_involve)){
        $data['list_involve'] = $list_involve ;
    }
    $list_cat = get_all_cat_product() ;
    if(!empty($list_cat)){
        $data['list_cat'] = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0));
    }
    load_view('addIndex',$data) ;
}

function editAction(){
    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_product = get_product_by_id($product_id) ;
    $info_product || redirect('?mod=product&controller=index&action=index') ;
    if(get_info_user('level') == 3 ){
        $info_product['create_at'] != get_info_user('id') || redirect('?mod=product&controller=index&action=index') ;
    }
    
    global $request ;
    $request = get_colums_in_array(array_keys($info_product),$info_product) ;
    $request['url_img'] = get_media_by_id($info_product['thumb'],'url') ;
    $request['title'] = $info_product['name'] ;
    $request['img_id'] = $info_product['thumb'] ;
    if(isset($_POST['edit_product'])){
        global $error ;
        $request['title'] = isset($_POST['title']) ? filter_str($_POST['title']) : null ;
        $request['slug'] = isset($_POST['slug']) ? to_slug(filter_str($_POST['slug'])) : null ;
        $request['info'] = isset($_POST['info']) ? htmlentities($_POST['info']) : null ;
        $request['depict'] = isset($_POST['depict']) ? $_POST['depict'] : null ;
        $request['img_id'] = isset($_POST['img_id']) ? (int)$_POST['img_id'] : 0 ;
        $request['cat_id'] = isset($_POST['cat_id']) ? (int)$_POST['cat_id'] : 0 ;
        $request['price'] = isset($_POST['price']) ? str_replace(',','',filter_str($_POST['price'])) : null ;
        $request['total_product'] = isset($_POST['total_product']) && $_POST['total_product'] > 0  ? filter_str($_POST['total_product']) : null ;


        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này' ;
        }elseif(empty($request['slug'])){
            $request['slug'] = to_slug($request['title']) ;
        }

        if(empty($request['price'])){
            $error['price'] = 'Vui lòng nhập vào giá' ;
        }
        elseif (isset($_POST['show-discount'])){
            $request['percen'] = isset($_POST['percen']) && $_POST['percen'] > 0 ? filter_str($_POST['percen']) : null ;
            $request['discount'] = isset($_POST['discount']) ? filter_str($_POST['discount']) : null ;
            if( empty($request['percen']) && !empty($request['discount'])){
                $error['percen'] = 'Vui lòng nhập phần trăm' ;
            }
            if( !empty($request['percen']) && empty($request['discount'])){
                $error['discount'] = 'Vui lòng nhập giá khuyến mại' ;
            }
        }
        if(!empty($request['slug']) && exists_slug_product_in_db($request['slug'])){
            $error['slug'] = 'Slug nay đã tồn tại ' ;
        }
        if($request['slug'] === $info_product['slug']){
            unset($error['slug']) ;
        }

        if(empty($request['total_product'])){
            $error['total_product'] = 'Vui lòng nhập số lượng của sản phẩm ' ;
        }
        if(empty($request['info'])){
            $error['info'] = 'Không dược bỏ trống trường này ' ;
        }
        if(empty($request['depict'])){
            $error['depict'] = 'Không dược bỏ trống trường này ' ;
        }

        $info_media = get_media_by_id($request['img_id']) ;
        if( !($info_media && $info_media['type'] == 3) && $info_media['active'] == 2 ){
            $error['img'] = 'Vui lòng tải lên một ảnh cho bài viết ' ;
        }else{
            $request['url_img'] = $info_media['url'] ;
        }

        if(!empty($_POST['img_involve'])){
            foreach ($_POST['img_involve'] as $v ){
                if($v > 0 ){
                    $data_img = get_media_by_id($v) ;
                    if($data_img){
                        $list_involve[] = get_colums_in_array(array('media_id','url','active'),$data_img) ;
                    }
                }

            }
        }

        if( !get_cat_by_id($request['cat_id'])){
            $error['cat_id'] = 'Chưa chọn danh mục nào ' ;
        }
        if(empty($error)){
            update_product($request,$product_id,get_info_user('id')) ;
            activate_media($request['title'],$product_id,$request['img_id']) ;
            if(!empty($list_involve )){
                foreach ($list_involve as &$v ){
                    if( $v['active'] == 2 ){
                        activate_media($request['title'],$product_id,$v['media_id']) ;
                        $v['url'] = get_media_by_id($v['media_id'],'url') ;
                    }
                    $img_involve[] = $v['media_id'] ;
                }
                db_update('tbl_product',array('img_involve'=>json_encode($img_involve))," product_id = {$product_id}") ;
            }
            redirect('?mod=product&controller=index&action=index') ;
        }
    }
    $request['price'] = empty($request['price']) ? null : number_format($request['price']) ;
    $request['discount'] = empty($request['discount']) ? null : number_format($request['discount']) ;
    if(!empty($info_product['img_involve'])){
        $list_involve = json_decode($info_product['img_involve']) ;
        foreach($list_involve as &$v){
            $item = get_media_by_id($v) ;
            $item['media_id'] = $v ;
            $v = get_colums_in_array(array('media_id','url'),$item) ;
        }
    }
    if(!empty($info_product['percen'])){
        $_POST['show-discount'] = true ;
    }
    if(isset($list_involve)){
        $data['list_involve'] = $list_involve ;
    }
    $list_cat = get_all_cat_product() ;
    if(!empty($list_cat)){
        $data['list_cat'] = multi_data_add_level($list_cat,array('name_id'=>'cat_id','level'=>0,'parent_id'=>0));
    }

    $data['info_product'] = $info_product ;
    load_view('editIndex',$data) ;
}


<?php
function construct(){
    load_model('index') ;
}

function indexAction(){
    global $request ;
    $type = isset($_GET['type']) ? $_GET['type'] : 'all' ;
    $page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1 ;
    $q = isset($_GET['q']) ? filter_str($_GET['q']) : null ;
    $request['per_page'] = $per_page = isset($_GET['per_page']) && $_GET['per_page'] > 0 ? (int)$_GET['per_page'] : 10 ;
    
    switch($type){
        case 'trash':
            $result = get_media_trash($q,$page,$per_page) ;
            break ;
        case 'post':
            $result = get_media_post($q,$page,$per_page) ;
            break ;   
        case 'product':
            $result = get_media_product($q,$page,$per_page) ;
            break ;   
        case 'sytem':
            $result = get_media_sytem($q,$page,$per_page) ;
            break ;  
        case 'avatar':
            $result = get_media_avatar($q,$page,$per_page) ;
            break ;      
        default :
            $result = get_all_media($q,$page,$per_page) ;
            break ;    
    }
    
    if(boolval($q)){
        $data['total_search'] = $result['total'] ;
    }

    $request['q'] = $q ;
    if($result['total_page']  > 1 ) 
        $data['paging'] = array('page'=>$page,'total'=>$result['total_page'],'url'=> '?'.str_replace("&page={$page}",'',$_SERVER['QUERY_STRING']).'&page=') ;
    $data['type'] = $type ;
    $data['list_media'] = $result ;
    $data['list_type'] = get_list_type_media() ;
//    show_array($data) ;exit ;
    load_view('indexIndex',$data) ;
}
function  addAction(){
    if($_SERVER['REQUEST_METHOD'] == 'POST' ){
        $error = null ;
        $json = array() ;
        $caption = isset($_POST['caption']) ? $_POST['caption'] :  null ;

        if(!isset($_FILES['img'])){
            $json['error'] = 'Bạn chưa chọn file' ;
        }else{
            $img = $_FILES['img'] ;
            $type_file = pathinfo($img['name'], PATHINFO_EXTENSION);
            $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
            if($img['error'] > 0 ){
                $error = 'Đã xảy ra lỗi khi tải lên' ;
            }
            elseif (!in_array(strtolower($type_file), $type_fileAllow)) {
                $error = "File bạn vừa chọn hệ thống không hỗ trợ";
            }
            elseif($img['size'] > 2097152 ){
                $error = 'Chỉ được tải lên tập tin rưới 2MB' ;
            }
                $type = empty($_POST['type']) ? 0 : (int)$_POST['type'] ;
                if($type < 1 || $type > 4){
                    $error = 'Xảy ra lỗi không xác định ' ;
                }
                if(empty($error)){
                    $img_id = isset($_POST['img_id']) ? (int)$_POST['img_id'] : 0 ;
                    $url = get_media_by_id($img_id,'url') ;
                    $path = 'public/images/'.convert_type_file($type).'/'.md5(time().$img['name']).'.'.$type_file ;
                    move_uploaded_file($img['tmp_name'],$path) ;
                    $json['id'] = $img_id ;
                    if(!empty($url)){
                        if(file_exists($url)){
                            unlink($url);
                            remove_cache() ;
                        }
                        db_update('tbl_media',array('url'=>$path,'caption'=>$caption,'active'=>2)," media_id = {$img_id}") ;
                    }else{
                        $json['id'] = add_media($path,$type, $caption);
                    }
                    $json['url'] = $path ;
                }else{
                    $json['error'] = $error  ;
                }
        }
        echo json_encode($json) ;
    }
}

function updateAction(){
    $id = isset($_POST['img_id']) ? (int)$_POST['img_id'] : 0 ;
    $info_media = get_media_by_id($id) ;
    !empty($info_media) || die('Khoong ton tai') ;
    $error = null ;
    $json = array() ;
    if(!isset($_FILES['img'])){
        $json['error'] = 'Bạn chưa chọn file' ;
    }else{
        $img = $_FILES['img'] ;
        $type_file = pathinfo($img['name'], PATHINFO_EXTENSION);
        $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
        if($img['error'] > 0 ){
            $error = 'Đã xảy ra lỗi khi tải lên' ;
        }
        elseif (!in_array(strtolower($type_file), $type_fileAllow)) {
            $error = "File bạn vừa chọn hệ thống không hỗ trợ";
        }
        elseif($img['size'] > 2097152 ){
            $error = 'Chỉ được tải lên tập tin rưới 2MB' ;
        }
        if(empty($error)){
            if(file_exists($info_media['url'])){
                unlink($info_media['url']) ;
            }
            $path = 'public/images/'.convert_type_file($info_media['type']).'/'.md5(time().$img['name']).'.'.$type_file ;
            move_uploaded_file($img['tmp_name'],$path) ;
            rename($path,$info_media['url']) ;
            $json['url'] = $info_media['url'] ;
            $json['id'] = $info_media['id'] ;
        }else{
            $json['error'] = $error ;
        }
    }
    echo json_encode($json) ;
}

function dropAction(){
    $id[] = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $error = $redirect = true ;
    $info_media = get_media_by_id($id[0]) ;
    if(!empty($info_media) && $info_media['active'] != 2 ){
        $error = false ;
    }
    if(isset($info_media) && isset($_GET['involve']) && $_GET['product_id'] == $info_media['id_connect'] && $info_media['type'] == 3 ){
        $error = true ;
        $redirect = false ;
        update_img_involve($info_media['media_id'], $info_media['id_connect']) ;
    }
    if(isset($_GET['all'])){
        $result = db_fetch_array("SELECT media_id FROM tbl_media WHERE active = 2 && id_connect = 0 ") ;
        if(!empty($result)){
            foreach ($result as $item){
                $id[] = $item['media_id'] ;
            }
        }
    }

    if(!empty($id) && $error ){
        foreach ($id as $v){
            drop_media_by_id($v, true ) ;
        }
        if($redirect){
            redirect('?mod=media&controller=index&action=index') ;
        }
    }
}
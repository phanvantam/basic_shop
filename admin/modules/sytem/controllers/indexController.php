<?php

function construct(){
    load_model('index') ;
}

function indexAction(){
    $info_sytem = get_info_sytem() ;
    global $request,$error ;
    $request = $info_sytem ;
    if(isset($_POST['edit_sytem'])){
        $request = get_colums_in_array(array('title','describe','tel','per_page','email','address'),$_POST) ;
        if(empty($request['title'])){
            $error['title'] = 'Không được bỏ trống trường này ' ;
        }
        if(empty($request['describe'])){
            $error['describe'] = 'Không được bỏ trống trường này ' ;
        }
        if(empty((int)$request['tel']) && (int)$request['tel'] != 0 ){
            $error['tel'] = 'Không được bỏ trống trường này ' ;
        }elseif(!check_tel((int)$request['tel'])){
            $error['tel'] = 'Số điện thoại không hợp lệ ' ;
        }
        if((int)$request['per_page'] > 10 || (int)$request['per_page'] < 3 ){
            $error['per_page'] = 'Số trang hiển thị không hợp lệ ' ;
        }
        if(empty($error)){
            global $notifice ;
            update_info_sytem($request) ;
            $notifice['edit'] = 'Thay đổi thông tin website thành công' ;
        }
    }
    load_view('indexIndex') ;
}
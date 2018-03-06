<?php
function convert_level($level){
    $name = array(1 =>'Admin',2 =>'Quản lý',3 =>'Cộng tác viên') ;
    if(key_exists($level, $name)){
        return $name[$level] ;
    }
}
function convert_active_user($active){
    $name = array(1 =>'Hoạt động',2 =>'Block') ;
    if(key_exists($active, $name)){
        return $name[$active] ;
    }
}

function convert_type_filter($active){
    $name = array(1 =>'Lọc giá',2 =>'Lọc danh mục') ;
    if(key_exists($active, $name)){
        return $name[$active] ;
    }
}

function convert_active_post($active){
    $name = array(1 =>'Đã đăng ',2 =>'Chờ xét duyệt',3=> 'Chờ xóa') ;
    if(key_exists($active, $name)){
        return $name[$active] ;
    }
}

function convert_active_order($active){
    $name = array(1 =>'Đã xét duyệt ',2=>'Đang vận chuyển',3 =>'Chờ xét duyệt',4=> 'Chờ xóa') ;
    if(key_exists($active, $name)){
        return $name[$active] ;
    }
}

function convert_type_menu($active){
    $name = array(1 =>'Trang',2 =>'Bài viết',3=> 'Sản phẩm',4=>'Trang chủ') ;
    if(key_exists($active, $name)){
        return $name[$active] ;
    }
}

function convert_active_media($active){
    $name = array(1 =>'Đã hoạt động ',2 =>'Ảnh rác',3=> 'Ảnh hệ thống') ;
    if(key_exists($active, $name)){
        return $name[$active] ;
    }
}

function convert_type_file($type,$show=false){
    $name_sytem = array(1 =>'avatar',2 =>'post',3 =>'product') ;
    $name_show = array(1 =>'Ảnh đại diện',2 =>'Ảnh bài viết',3 =>'Ảnh sản phẩm') ;
    $name = $show ? $name_show : $name_sytem ;
    if(key_exists($type, $name)){
        return $name[$type] ;
    }
}

function convert_type_widget($type){
    $name = array(1 =>'Sản phẩm',2 =>'Bài viết') ;
    if(key_exists($type, $name)){
        return $name[$type] ;
    }
}
function convert_location_widget($v){
    $name = array(1=>'Trang chủ ',2=>'Trang chi tiết') ;
    if(key_exists($v, $name)){
        return $name[$v] ;
    }
}

function convert_location_menu($v){
    $name = array(2=>'Menu Footer',1=>'Menu Header',3 =>'Menu Sidebar',4=>'Menu Respon') ;
    if(key_exists($v, $name)){
        return $name[$v] ;
    }
}

function convert_style_widget($v){
    $name = array(2=>'Danh sách',1=>'Slider') ;
    if(key_exists($v, $name)){
        return $name[$v] ;
    }
}

function convert_type_data_widget($v){
    $name = array(1=>'Sản phẩm bán chạy ',2=>'Sản phẩm mới',3=>'Sản phẩm liên quan',4=>'Bài viết mới nhất',5=>'Bài viết nhiều lượt xem',6=>'Bài viết liên quan') ;
    if(key_exists($v, $name)){
        return $name[$v] ;
    }
}


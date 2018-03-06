<?php

#Chức năng : Trả về đường dẫn cơ bản của website 
#$url : Đường dẫn cần nối thêm 
#$v : True sẽ trả về cả controller ,mod và action 
function base_url($url = "",$v=false) {
    global $config;
    $result = $config['base_url'] ;
    if($v)
        return $result.'?mod='. get_module().'&controller='. get_controller().'&action='. get_action().$url;
    return $result.$url ;       
}

#Chức năng : Trả về đường dẫn cơ bản của website 
#$url : Đường dẫn cần nối thêm 
#$v : True sẽ trả về cả controller ,mod và action 
function base_url_frontend() {
    return $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].'/' ;      
}

#Chức năng : Điều hướng trang web 
#$path : Trang đích  
function redirect($path){
    header("location: {$path}") ;
    exit ;
}
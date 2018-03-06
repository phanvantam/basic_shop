<?php

#Chức năng : Gán giá trị cho session với tên và cấp độ 
#$index : Tên phần tử  
#$parent_id : Phần tử cha 
function set_session($data=array(),$parent=null){
    if(empty($data)){
        return false ;
    } 
    foreach ($data as $k => $v){
        if(empty($parent)){
            $_SESSION[$k]= $v ;
        }else{
            $_SESSION[$parent][$k]= $v ;
        }
    }
}

#Chức năng : Lấy giá trị của session theo tên và cấp độ 
#$index : Tên phần tử cần lấy 
#$parent_id : Phần tử cha của phần tử cần lấy 
function get_session($index, $parent=null){
    if(empty($index)){
        return false ;
    } 
    if(!is_array($index)){
        $index = array($index) ;
    }
    foreach ($index as $k ){
        if(empty($parent)){
            if(empty( $_SESSION[$k])){
                $result[$k] = null ;
            } else {
                $result[$k] = $_SESSION[$k] ;
            }        
        }else{
            if(empty( $_SESSION[$parent][$k])){
                $result[$k] = null ;
            } else {
                $result[$k] = $_SESSION[$parent][$k] ;
            } 
        }
    }
    return $result ;
}

#Chức năng : Xoa session với tên và cấp độ 
#$index : Tên phần tử cần xóa   
#$parent_id : Phần tử cha
function drop_session($index, $parent = null ){
    if(empty($index)){
        return false ;
    }
    if(!is_array($index)){
        $index = array($index) ;
    }
    foreach ($index as $k ){
        if(empty($parent)){
            if(isset( $_SESSION[$k])){
                unset($_SESSION[$k]) ;
            }
        }else{
            if(isset( $_SESSION[$parent][$k])){
                unset($_SESSION[$parent][$k]);
            }
        }
    }
}

#chức năng : Thiết lập thông báo trên session 
#$content : Nội dung thông báo 
function set_notifice_session($content){
    $_SESSION['notifice'] = $content ;
}

# Lấy thông báo trên session và xóa sau khi lấy 
function get_notifice_session(){
    if(isset($_SESSION['notifice'])){
        $content = $_SESSION['notifice'] ;
        unset($_SESSION['notifice']) ;
        echo $content;
    }
    return false ;
}
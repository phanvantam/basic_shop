<?php

#Chức năng : Lọc các ký tự đặc biệt ra khỏi chuỗi 
#$str : Chuỗi cần lọc 
    function filter_str($str){
        $list_char = '/(|"|,|.|;|$|&|(|)|@|!|#|^|*|_|=|\|/|?|[|]|<|>|+|~|:|\')/' ;
        $str = str_replace($list_char,'-', $str) ;
        return trim($str) ;
    }

#Chức năng : Tạo ra một chuỗi slug từ chuỗi vào  
#$str : Chuỗi đầu vào 
function to_slug($str) {
$str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}
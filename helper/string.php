<?php

#Chức năng : Lọc các ký tự đặc biệt ra khỏi chuỗi 
#$str : Chuỗi cần lọc 
    function filter_str($str){
        $list_char = '/(|"|,|.|;|$|&|(|)|@|!|#|^|*|_|=|\|/|?|[|]|<|>|+|~|:|\')/' ;
        $str = str_replace($list_char,'-', $str) ;
        return trim($str) ;
    }


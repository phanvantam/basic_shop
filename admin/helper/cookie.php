<?php

function get_cookie($name){
    $result = array() ;
    if(is_array($name)){   
        foreach ($name as $v){
            if(isset($_COOKIE[$v])){
                $result[$v] = $_COOKIE[$v] ;
            }else{
                $result[$v] = null ;
            }
        }    
    }else{
        if(isset($_COOKIE[$name])){
            $result = $_COOKIE[$name] ;
        }else{
            $result = null ;
        }
    }
    return $result  ;
}

function drop_cookie($index){
    if(is_array($index)){
        foreach ($index as $name){
            setcookie($name,'', time()-3600);
        }
    }else{
        setcookie($index,'', time()-3600);
    }
}

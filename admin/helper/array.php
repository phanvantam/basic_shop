<?php

function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

function get_colums_in_array($index=array(), $data=array()){
    if(empty($index) || empty($data) ){
        return false ;
    }
    $result = array() ;
    foreach($index as $v){
        if(isset($data[$v])){
            $result[$v] = $data[$v] ;
        }else{
            $result[$v] = null ;
        }
    }
    return $result ;
}
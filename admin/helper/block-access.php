<?php

function check_access($level){
    global $config ;
    switch ($level){
        case 2:
            $data = $config['access']['manager'] ;        
            break;
        case 3: 
            $data = $config['access']['personnel'] ;               
            break;
        default: return true ;
    }
    $mod = get_module() ;
    $c = get_controller() ;
    $action = get_action() ;
    if(key_exists($mod,$data) ){
        if( count($data[$mod]) > 0 ){
            if(key_exists($c,$data[$mod]) ){
                if( count($data[$mod][$c]) > 0){
                    if(key_exists($action,$data[$mod][$c])){
                        return false ;
                    }
                }else 
                    return false ;
            }
        }else 
            return false ;
    }
    return true ;
}
<?php


#Chức năng : Lấy dữ liệu từ trang web khác thông qua Url 
#$url : Đường dẫn tới trang web cần lấy 
function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

function get_notifice($index){
    global $notifice;
    if (!empty($notifice[$index])) {
        return $notifice[$index];
    }
}

function multi_data_add_level($data,$option,$filter=false){
    $result = array() ;
    foreach($data as &$item){
        if($item['parent_id'] == $option['parent_id']){
            $active = !isset($item['active']) || $item['active'] == 1 ? true : false ;
            $active = $filter ? $active : true ;
            if( $active){
                $item['level'] = $option['level'] ;
                $result[] = $item ;
                $result = array_merge($result,multi_data_add_level($data,array('name_id'=>$option['name_id'],'level'=>$option['level']+1,'parent_id'=>$item[$option['name_id']]),$filter));
            }
        }
        unset($item);
    }
    return $result ;
}

function check_value_exits_array($v, $option){
    foreach ($option['data'] as $item ){
        foreach ($option['k'] as $k ){
            if($item[$k] == $v ){
                return true ;
            }
        }
    }
    return false ;
}

function convert_level_to_str($data,$str,$text){
    foreach($data as &$v ){
        $v[$text] = str_repeat($str,$v['level']).' '.$v[$text] ;
    }
    return $data ;
}

function convert_show_select($data, $option){
    $result = array() ;
    foreach($data as $v ){
        $result[$v[$option['k']]] = $v[$option['v']] ;
    }
    return $result ;
}

function compare($v1 ,$v2, $result){
    if(!is_array($v2))
        $v2 = array($v2);
    foreach($v2 as $v ){
        if($v == $v1){
            return $result ;
        }
    }    
}
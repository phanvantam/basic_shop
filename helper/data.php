<?php

#Chức năng : So sánh các giá trị và trả về kết quả nếu đúng 
#v1,$v2 : Là các giá trị để so sánh 
#$result : là kết quả được trả về 
function compare($v1 ,$v2, $result){
    if($v1 == $v2){
        return $result ;
    }
}

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

#Chức năng : Xắp sếp dữ liệu theo cấp độ
#$data : Dữ liệu cần xắp xếp
#$parent_id : Cấp cha bắt đầu lọc 
#$level : Xác định cấp độ của menu 
#$option : Chứa các lựa chọn khác 
function multi_data_add_level($data,$parent_id,$level,$option){
    $result = array() ;
    foreach($data as &$item){
        if($item['parent_id'] == $parent_id){
                $item['level'] = $level ;
                $result[] = $item ;
                $result = array_merge($result,multi_data_add_level($data,$item[$option['name_id']],$level+1,$option));
        }
        unset($item);
    }
    return $result ;
}



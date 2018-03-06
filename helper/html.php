<?php

#Chức năng : Xuất dữ liệu theo kiểu select 
#$data  : Dữ liệu cần xuất
#$active : Phần tử đang hoạt động 
#$option : Chứa các lựa chọn thêm vào vd : id,class,name cho select 
    function show_select($data,$active=0,$option=array()){
        $class = isset($option['class']) ? $option['class'] : null ;
        $id = isset($option['id']) ? $option['id'] : null ;
        $style = isset($option['style']) ? $option['style'] : null ;
        $name = isset($option['name']) ? $option['name'] : null ;
        if(!empty($data)){
            $result = "<select class='{$class}' name='{$name}' id='{$id}' style='{$style}' >" ;
            foreach ($data as $k => $v ){
                $label_active = null ;
                if($k == $active ){
                    $label_active = 'selected' ;
                }
                $result .= "<option value='{$k}' {$label_active}>{$v}</option>" ;
            }
            $result .= '</select>' ;
            return $result ;
        }
    }
  
#Chức năng : Khởi tạo thông báo Html
#$content : Nội dung thông báo     
    function create_notifice($content){
        $html = '<div id="notifice">
                    <div class="dim-background"></div>
                        <div class="content">
                            <i class="fa fa-times-circle" aria-hidden="true"></i>'
                                    .$content.
                        '</div>
                  </div>' ;
        return $html ;                            
    }
    
#Chức năng : Xuất dữ liệu theo ul,li lồng nhau 
#$data : Dữ liệu cần xuất 
#$parent_id : Cấp cha bắt đầu lọc 
#$level : Xác định cấp độ của menu 
#$option : Chứa các lựa chọn thêm vào vd : id,class
function show_ul_multi_data($data,$parent_id,$level,$option){
    $id = isset($option['id']) && $level == 1 ? $option['id'] : null ;
    $class = isset($option['class']) && $level > 1 ? $option['class'] : null ;
    $main_class = isset($option['main_class']) && $level == 1 ? $option['main_class'] : null ;
    $result = '' ;
    foreach($data as &$item){
        if($item['parent_id'] == $parent_id ){
                $result .= "<li><a href='{$item['link']}'>{$item['title']}</a> " ;
                $result .= show_ul_multi_data($data,$item[$option['name_id']],$level+1,$option) ;
                $result .= '</li>' ;
            }
        unset($item);
    }
    if(!empty($result)){
        return "<ul id='{$id}' class='{$class}{$main_class}'>" .$result. '</ul>';
    }
}

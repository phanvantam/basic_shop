<?php

    function show_select($data,$active=0,$option=array()){
        $attr = isset($option['attr']) ? $option['attr'] : null ;
        $class = isset($option['class']) ? $option['class'] : null ;
        $id = isset($option['id']) ? $option['id'] : null ;
        $style = isset($option['style']) ? $option['style'] : null ;
        $name = isset($option['name']) ? $option['name'] : null ;
        if(!empty($data)){
            $result = "<select class='{$class}' {$attr} name='{$name}' id='{$id}' style='{$style}' >" ;
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
<?php 
    function paging_basic($total_page,$active = 1 ,$option = array()){
        $class = isset($option['class']) ? $option['class'] : null ;
        $id = isset($option['id']) ? $option['id'] : null ;
        $url_page = $option['url_page'] ;
        $next = $active + 1 > $total_page ? 0 : $active + 1 ;
        $back = $active - 1 < 0 ? 0 : $active - 1 ;
        $result = "<ul id='{$id}' class='{$class}'>" ;
        if ($back) {
            $result .= "<li><a href='{$url_page}{$back}'>Trở lại</a></li>" ;
        }
        for ($i = 1 ;$i <= $total_page;$i++ ){
            $label_active = isset($option['label_active']) ? $option['label_active'] : null ;
            if ($active != $i ) {
                $label_active = null ;
            }
            $result .= "<li><a class='{$label_active}' href='{$url_page}{$i}'>{$i}</a></li>" ;
        }
        if ($next) {
            $result .= "<li><a href='{$url_page}{$next}'>Kế tiếp</a></li>" ;
        }
        $result .= '</ul>' ;
        return $result ;
    }

    function total_page_by_query($sql, $per_page){
        $total_recod = db_num_rows($sql) ;
        $total_page = ceil($total_recod / $per_page) ;
        return $total_page ;
    }

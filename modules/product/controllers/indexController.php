<?php
function construct(){
    load_model('cat') ;
    load_model('index') ;
}
function indexAction(){
    $data = array() ;
    
    $main_cat = db_fetch_array(" SELECT cat_id ,title FROM tbl_category WHERE type = 2 && parent_id = 0 && active = 1 ") ;
                    $list_cat = get_list_cat_product() ;
                    if(!empty($main_cat)){
                        $product = array() ;
                        foreach ($main_cat as $k => $v ){
                            $product[$k]['title'] = $v['title'] ; 
                            $result = array() ;
                            $result[] = $v['cat_id'] ;
                            $children = multi_data_add_level($list_cat,$v['cat_id'],1,array('name_id'=>'cat_id'));
                            $per_page = get_info_sytem('per_page') ;
                            $start = 0 ;
                            if(!empty($children)){
                                foreach ($children as $item){
                                    $result[] = $item['cat_id'] ;
                                }
                            }
                            $cat_id = implode(',', $result) ;
                            $total_recod = db_fetch_row("SELECT COUNT(*) as total FROM tbl_product WHERE cat_id IN({$cat_id}) && active = 1 ") ;
                            $total_recod = $total_recod['total'] ;
                            if($total_recod > $per_page ){
                                $start = rand(1, $total_recod) ;
                                if($start+$per_page > $total_recod){
                                    $start = $total_recod - $per_page ;
                                }
                            }
                            $sql = "SELECT tbl_product.slug,tbl_product.product_id,tbl_product.name,tbl_product.price,tbl_product.discount, tbl_media.url FROM tbl_product INNER JOIN tbl_media ON tbl_media.media_id = tbl_product.thumb WHERE cat_id IN({$cat_id}) && tbl_product.active = 1 LIMIT {$start},{$per_page}" ;
                            $product[$k]['data'] = add_path_product($sql) ;
                    }
                    $data['product'] = $product ;
                            }
    $data['list_favorite'] = get_product_favorite() ;   
    $data['list_discount'] = get_product_discount() ;
    $data['list_support'] = get_list_support() ;
    load_view('indexIndex',$data) ;
}

function detailAction(){
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0 ;
    $info_product = get_product_by_id($id) ;
    $info_product || redirect('?') ;
    $data['product'] = $info_product ;
    $data['list_favorite'] = get_product_favorite() ;
    $data['list_involve'] = get_product_involve($info_product['cat_id'],$id) ;
    load_view('detailIndex',$data) ;
}
<?php get_header() ; ?>
    <div id="main-content-wp" class="add-cat-page menu-page">
        <div class="section" id="title-page">
            <div class="clearfix">
                <a href="?mod=theme&controller=menu&action=index" title="" id="add-new" class="fl-left">Danh sách Menu</a>
                <h3 id="index" class="fl-left">Thêm Menu</h3>
            </div>
        </div>
        <div class="wrap clearfix">
            <?php get_sidebar() ; ?>
            <div id="content" class="fl-right">
                <div class="section-detail clearfix">
                    <div id="list-menu" class="fl-left">
                        <form  method="POST" action="">
                            <div class="form-group">
                                <label for="title">Tên menu</label>
                                <input type="text" name="title" maxlength="100" value="<?php echo set_value('title'); ?>" id="title">
                                <p class="message"><?php echo get_error('title') ; ?></p>
                            </div>
                            <div class="form-group clearfix">
                                <label id="type-menu">Liên kết với trang :</label>
                                <input type="radio" id="type-menu" class="switch" <?php if($type==1){echo 'checked'; $page_active = $active ;}else $page_active = 0 ; ?> value="1" name="type">
                                <div class="content-hidden">
                                    <?php
                                    $list_page = db_fetch_array('SELECT * FROM tbl_page WHERE active = 1 ') ;
                                    if(!empty($list_page)){
                                        $list_page = convert_show_select($list_page, array('k'=>'page_id','v'=>'title')) ;
                                    }
                                    $list_page[0] = 'Lựa chọn trang liên kết ' ;
                                    echo show_select($list_page,$page_active,array('name'=>'page_id')) ;
                                    ?>
                                    <p class="message"><?php echo get_error('page_id') ; ?></p>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label id="type-menu">Liên kết với danh mục sản phẩm :</label>
                                <input type="radio" id="type-menu" class="switch" value="3" <?php if($type==3){echo 'checked'; $product_active = $active ;}else $product_active = 0 ; ?> name="type">
                                <div class="content-hidden">
                                    <?php
                                    $cat_product = db_fetch_array('SELECT * FROM tbl_category WHERE type = 2 && active = 1 ') ;
                                    if(!empty($cat_product)){
                                        $cat_product = multi_data_add_level($cat_product,array('parent_id'=>0,'level'=>0,'name_id'=>'cat_id'),true) ;
                                        $cat_product = convert_level_to_str($cat_product, '---', 'title') ;
                                        $cat_product = convert_show_select($cat_product, array('k'=>'cat_id','v'=>'title')) ;
                                    }
                                    $cat_product[0] = 'Lựa chọn danh mục liên kết ' ;
                                    echo show_select($cat_product,$product_active,array('name'=>'cat_product')) ;
                                    ?>
                                    <p class="message"><?php echo get_error('cat_product') ; ?></p>
                                </div>
                            </div>
                            <div class="form-group clearfix">
                                <label id="type-menu">Liên kết với danh mục bài viết :</label>
                                <input type="radio" id="type-menu" class="switch" value="2" <?php if($type==2){echo 'checked'; $post_active = $active ;}else $post_active = 0 ; ?> name="type">
                                <div class="content-hidden">
                                    <?php
                                    $cat_post = db_fetch_array('SELECT * FROM tbl_category WHERE type = 1 && active = 1 ') ;
                                    if(!empty($cat_post)){
                                        $cat_post = multi_data_add_level($cat_post,array('parent_id'=>0,'level'=>0,'name_id'=>'cat_id'),true) ;
                                        $cat_post = convert_level_to_str($cat_post, '---', 'title') ;
                                        $cat_post = convert_show_select($cat_post, array('k'=>'cat_id','v'=>'title')) ;
                                    }
                                    $cat_post[0] = 'Lựa chọn danh mục liên kết ' ;
                                    echo show_select($cat_post,$post_active,array('name'=>'cat_post')) ;
                                    ?>
                                    <p class="message"><?php echo get_error('cat_post') ; ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="type-home">Liên kết với trang chủ :</label>
                                <input type="radio" id="type-home"  <?php if($type==4){echo 'checked'; $page_active = $active ;}else $page_active = 0 ; ?> value="4" name="type">
                            </div>
                            <div class="form-group clearfix">
                                <label>Chọn loại menu : </label>
                                <?php
                                    $list_location[1] = 'Menu header' ;
                                    $list_location[2] = 'Menu footer' ;
                                    $list_location[3] = 'Menu sidebar ' ;
                                    $list_location[4] = 'Menu response' ;
                                    $hide_footer = $location_active == 2 ? 'block' : 'none' ;
                                    $hide_sidebar = $location_active == 3 ? 'block' : 'none'  ;
                                    $hide_respon = $location_active == 4 ? 'block' : 'none'  ;
                                    echo show_select($list_location,$location_active,array('name'=>'location')) ;
                                ?>
                                <p class="message"><?php echo get_error('parent_id') ; ?></p>
                            </div>
                            <div class="form-group clearfix" style="display:<?php echo $hide_footer ; ?>" id="select-parent-footer">
                                <label>Danh mục cha :</label>
                                <?php
                                $list_menu = get_menu_parent_footer() ;
                                if($list_menu){
                                    $list_menu= convert_show_select($list_menu, array('k'=>'menu_id','v'=>'title')) ;
                                }
                                $list_menu[0] = 'Lựa chọn menu cha ' ;
                                echo show_select($list_menu,$menu_active,array('name'=>'parent_footer')) ;
                                ?>
                                <p class="message"><?php echo get_error('parent_footer') ; ?></p>
                            </div>
                            <div class="form-group clearfix" style="display:<?php echo $hide_sidebar ; ?>" id="select-parent-sidebar">
                                <label>Danh mục cha :</label>
                                <?php
                                $list_menu = get_menu_parent_sidebar() ;
                                if($list_menu){
                                    $list_menu= convert_show_select($list_menu, array('k'=>'menu_id','v'=>'title')) ;
                                }
                                $list_menu[0] = 'Lựa chọn menu cha ' ;
                                echo show_select($list_menu,$menu_active,array('name'=>'parent_sidebar')) ;
                                ?>
                                <p><?php echo get_error('parent_sidebar') ; ?></p>
                            </div>
                             <div class="form-group clearfix" style="display:<?php echo $hide_respon ; ?>" id="select-parent-respon">
                                <label>Danh mục cha :</label>
                                <?php
                                $list_menu = get_menu_parent_respon() ;
                                if($list_menu){
                                    $list_menu= convert_show_select($list_menu, array('k'=>'menu_id','v'=>'title')) ;
                                }
                                $list_menu[0] = 'Lựa chọn menu cha ' ;
                                echo show_select($list_menu,$menu_active,array('name'=>'parent_respon')) ;
                                ?>
                                <p class="message"><?php echo get_error('parent_respon') ; ?></p>
                            </div>
                            <div class="form-group">
                                <label for="menu-order">Thứ tự</label>
                                <input type="number" min="1" name="ordinal" value="<?php echo set_value('ordinal'); ?>" id="menu-order">
                            </div>
                           
                            <div class="form-group">
                                <button type="submit" name="add_menu" id="btn-save-list">Thêm menu  </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php get_footer() ; ?>
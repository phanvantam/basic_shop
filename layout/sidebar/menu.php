 <?php
                    $result = get_menu_sidebar() ;
                        if(!empty($result)){
                            $result = show_ul_multi_data($result,0,1,array('name_id'=>'menu_id','main_class'=>'list-item','class'=>'sub-menu')) ;
                            if(!empty($result)){
                ?>
                <div class="section" id="category-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Danh mục</h3>
                    </div>
                    <div class="secion-detail">
                        <?php
                            echo $result ;
                        ?>
                    </div>
                </div>
                 <?php
                        }}
                ?>
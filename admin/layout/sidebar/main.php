<div id="sidebar" class="fl-left">
    <?php $level = get_info_user('level') ; ?>
    <ul id="sidebar-menu">
        <li <?php echo compare($level,array('2','3'),"style='display:none' "); ?> class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-user icon"></span>
                <span class="title">Quản lý thành viên</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?mod=user&controller=index&action=add_user" title="Thêm thành viên" class="nav-link">Thêm thành viên</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=user&controller=index&action=index" title="Danh sách thành viên" class="nav-link">Danh sách thành viên </a>
                </li>
            </ul>
        </li>
        <li class="nav-item"  <?php echo compare($level,3,"style='display:none' "); ?>>
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-map icon"></span>
                <span class="title">Trang</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?mod=page&controller=index&action=add" title="Thêm mới" class="nav-link">Thêm mới</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=page&controller=index&action=index" title="Danh sách các trang" class="nav-link">Danh sách các trang</a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-pencil-square-o icon"></span>
                <span class="title">Bài viết</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?mod=post&controller=index&action=add" title="Thêm mới bài viết" class="nav-link">Thêm mới bài viết</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=post&controller=index&action=index" title="Danh sách bài viết" class="nav-link">Danh sách bài viết</a>
                </li>
                <div  <?php echo compare($level,3,"style='display:none' "); ?> >
                    <li class="nav-item">
                        <a href="?mod=post&controller=cat&action=add" title="Thêm danh mục" class="nav-link">Thêm danh mục </a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=post&controller=cat&action=index" title="Danh mục bài viết" class="nav-link">Danh mục bài viết</a>
                    </li>
                </div>
                
            </ul>
        </li>
        <li class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-product-hunt icon"></span>
                <span class="title">Sản phẩm</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?mod=product&controller=index&action=add" title="Thêm sản phẩm" class="nav-link">Thêm sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=product&controller=index&action=index" title="Danh sách sản phẩm" class="nav-link">Danh sách sản phẩm</a>
                </li>
                <div  <?php echo compare($level,3,"style='display:none' "); ?> >
                     <li class="nav-item">
                        <a href="?mod=product&controller=cat&action=add" title="Thêm danh mục" class="nav-link">Thêm danh mục </a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=product&controller=cat&action=index" title="" class="nav-link">Danh mục sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=product&controller=filter&action=add" title="Thêm bộ lọc" class="nav-link">Thêm bộ lọc</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=product&controller=filter&action=index" title="Danh sách bộ lọc" class="nav-link">Danh sách bộ lọc</a>
                    </li>
                </div>
               
            </ul>
        </li>
        <li <?php echo compare($level,3,"style='display:none' "); ?>  class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-database icon"></span>
                <span class="title">Bán hàng</span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?controller=order&mod=product&action=index" title="" class="nav-link">Danh sách đơn hàng</a>
                </li>
                <li class="nav-item">
                    <a href="?mod=product&controller=customer&action=index" title="" class="nav-link">Danh sách khách hàng</a>
                </li>
            </ul>
        </li>
        <li <?php echo compare($level,3,"style='display:none' "); ?>  class="nav-item">
            <a href="" title="" class="nav-link nav-toggle">
                <span class="fa fa-th-list icon"></span>
                <span class="title">Quản lý Menu </span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?mod=theme&controller=menu&action=add" title="Thêm menu " class="nav-link">Thêm menu </a>
                </li>
                <li class="nav-item">
                    <a href="?mod=theme&controller=menu&action=index" title="Danh sách menu" class="nav-link">Danh sách menu</a>
                </li>
            </ul>
        </li>
        <li <?php echo compare($level,3,"style='display:none' "); ?> class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <span class="fa fa-cubes icon"></span>
                <span class="title">Khối giao diện</span>
            </a>
            <ul class="sub-menu">
              
                <li class="nav-item">
                    <a href="?mod=theme&controller=slider&action=add" title="Thêm slider " class="nav-link">Thêm slider  </a>
                </li>
                <li class="nav-item">
                    <a href="?mod=theme&controller=slider&action=index" title="Danh sách slider " class="nav-link">Danh sách slider </a>
                </li>
                <div  <?php echo compare($level,array('2','3'),"style='display:none' "); ?> > 
                    <li class="nav-item">
                        <a href="?mod=sytem&controller=support&action=add" title="Thêm mới" class="nav-link">Thêm thông tin hỗ trợ</a>
                    </li>
                    <li class="nav-item">
                        <a href="?mod=sytem&controller=support&action=index" title="Danh sách các trang" class="nav-link">Danh sách hỗ trợ</a>
                    </li>
                </div>
            </ul>
        </li>
        <li <?php echo compare($level,array('2','3'),"style='display:none' "); ?> class="nav-item">
            <a href="#" title="" class="nav-link nav-toggle">
                <span class="fa fa-desktop icon"></span>
                <span class="title">Hệ thống </span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="?mod=media&controller=index&action=index" title="Media" class="nav-link">Quản lý media</a>
                </li>
                
                <li class="nav-item">
                    <a href="?mod=sytem&controller=index&action=index" title="" class="nav-link">Thông tin Website</a>
                </li>
              
            </ul>
        </li>
    </ul>
</div>

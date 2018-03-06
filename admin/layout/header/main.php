<!DOCTYPE html>
<html>
<head>
    <title>AdminV1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="public/reset.css" rel="stylesheet" type="text/css"/>
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="public/style.css" rel="stylesheet" type="text/css"/>
    <link href="public/responsive.css" rel="stylesheet" type="text/css"/>

    <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
    <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="plugins/ckeditor/ckeditor.js"></script>
</head>
<body>
<div id="site">
    <div id="container">
        <div id="header-wp">
            <div class="wp-inner clearfix">
                <a href="?" title="" id="logo" class="fl-left">
                    <?php 
                        $info_sytem = db_fetch_row("SELECT * FROM `tbl_sytem` ") ;
                        echo $info_sytem['title'] ;
                    ?>
                </a>
                <ul id="main-menu" class="fl-left">
                     <?php $level = get_info_user('level') ; ?>
                    <li <?php echo compare($level,3,"style='display:none' "); ?>>
                        <a href="?mod=page&controller=index&action=index" title="">Trang</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?mod=page&controller=index&action=add" title="">Thêm mới</a>
                            </li>
                            <li>
                                <a href="?mod=page&controller=index&action=index" title="">Danh sách trang</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?mod=post&controller=index&action=index" title="">Bài viết</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?mod=post&controller=index&action=add" title="">Thêm mới</a>
                            </li>
                            <li>
                                <a href="?mod=post&controller=index&action=index" title="">Danh sách bài viết</a>
                            </li>
                            <li  <?php echo compare($level,3,"style='display:none' "); ?>>
                                <a href="?mod=post&controller=cat&action=index" title="">Danh mục bài viết</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?mod=product&controller=index&action=index" title="">Sản phẩm</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?mod=product&controller=index&action=add" title="">Thêm mới</a>
                            </li>
                            <li>
                                <a href="?mod=product&controller=index&action=index" title="">Danh sách sản phẩm</a>
                            </li>
                            <li  <?php echo compare($level,3,"style='display:none' "); ?>>
                                <a href="?mod=product&controller=cat&action=index" title="">Danh mục sản phẩm</a>
                            </li>
                        </ul>
                    </li>
                    <li  <?php echo compare($level,3,"style='display:none' "); ?> >
                        <a href="?controller=order&mod=product&action=index" title="">Bán hàng</a>
                        <ul class="sub-menu">
                            <li>
                                <a href="?controller=order&mod=product&action=index" title="">Danh sách đơn hàng</a>
                            </li>
                            <li>
                                <a href="?mod=product&controller=customer&action=index" title="">Danh sách khách hàng</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php echo compare($level,3,"style='display:none' "); ?>>
                        <a href="?mod=theme&controller=menu&action=index" title="">Menu</a>
                    </li>
                </ul>
                <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                    <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <h3 id="account" class="fl-left"><?php echo get_info_user('name') ; ?></h3>
                        <div id="thumb-circle" class="fl-right">
                            <img src="<?php echo get_avatar_user() ; ?>">
                        </div>

                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="?mod=user&controller=index&action=update_info" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                        <li><a href="?mod=user&controller=index&action=change_pass" title="Đổi mật khẩu">Đổi mật khẩu</a></li>
                        <li><a href="?mod=sytem&controller=history&action=index" title="Đổi mật khẩu">Lịch sử truy cập </a></li>
                        <li><a href="?mod=user&controller=access&action=logout" title="Thoát">Thoát</a></li>
                    </ul>
                </div>
            </div>
        </div>
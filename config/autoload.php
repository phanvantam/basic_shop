<?php
defined('APPPATH') OR exit('Không được quyền truy cập phần này');

/*
| -------------------------------------------------------------------
| AUTO-LOADER
| -------------------------------------------------------------------
| Đây là những phần được load tự động khi ứng dụng khởi động
|
| 1. Libraries
| 2. Helper file
|
*/

 # Autoload Libraries
 # Demo : $autoload['lib'] = array('validation', 'pagging');
$autoload['lib'] = array('validation','paging');

#Autoload Helper
 # Demo : $autoload['helper'] = array('data','string');
$autoload['helper'] = array('data','format','sytem','html','url','array','session','cart','mail','string');









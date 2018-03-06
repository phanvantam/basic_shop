<?php

defined('APPPATH') OR exit('Không được quyền truy cập phần này');

# get Controller name
function get_controller() {
    global $config;
    $controller = isset($_GET['controller']) ? $_GET['controller'] : $config['default_controller'];
    return $controller;
}

#get Module name

function get_module() {
    global $config;
    $module = isset($_GET['mod']) ? $_GET['mod'] : $config['default_module'];
    return $module;
}

#get Action name
function get_action() {
    global $config;
    $action = isset($_GET['action']) ? $_GET['action'] : $config['default_action'];
    return $action;
}

# Chức năng : Load các Library được yêu cầu vào chương trình
# $name : Tên của library
function load_library($name)
{
    $path = LIBPATH . DIRECTORY_SEPARATOR . "{$name}.php";
    if (file_exists($path)) {
        require "$path";
    } else {
        echo "Module :{$name} không tồn tại";
    }
}

# Chức năng : Load các helper được yêu cầu vào chương trình
# $name : Tên của helper 
function load_helper( $name)
{
    $path = HELPERPATH . DIRECTORY_SEPARATOR . "{$name}.php";
    if (file_exists($path)) {
        require "$path";
    } else {
        echo "Helper :{$name} không tồn tại";
    }
}

#Chức năng : Gọi các hàm được chỉ định 
#$list_function : Là một array có value là tên hàm cần gọi 
function call_function($list_function = array()) {
    if (is_array($list_function)) {
        foreach ($list_function as $f) {
            if (function_exists($f())) {
                $f();
            }
        }
    }
}

#Chức năng : Load các view theo yêu cầu 
#$name : Tên view 
#$data_send : Là một array có  k => Tên biến and v => Gía trị biến 
function load_view($name, $data_send = array()) {
    global $data;
    $data = $data_send;
    $path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $name . 'View.php';
    if (file_exists($path)) {
        if (is_array($data)) {
            foreach ($data as $key_data => $v_data) {
                $$key_data = $v_data;
            }
        }
        require $path;
    } else {
        echo "Không tìm thấy {$path}";
    }
}

#Chức năng : Load model theo yêu cầu có thể load qua module khác  
#$name : Tên model 
#$module : Tên module 
function load_model($name, $module = null ) {
    $module = boolval($module) ? $module : get_module() ;
    $path = MODULESPATH . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . $name . 'Model.php';
    if (file_exists($path)) {
        require $path;
    } else {
        echo "Không tìm thấy {$path}";
    }
}

#Chức năng : Gọi header theme 
#$name : Tên header cần gọi
function get_header($name = 'main') {
    global $data;
    $path = LAYOUTPATH . DIRECTORY_SEPARATOR .'header'.DIRECTORY_SEPARATOR . $name . '.php';
    if (file_exists($path)) {
        if (is_array($data)) {
            foreach ($data as $key => $a) {
                $$key = $a;
            }
        }
        require $path;
    } else {
        echo "Không tìm thấy {$path}";
    }
}

#Chức năng : Gọi footer theme 
#$name : Tên footer cần gọi 
function get_footer($name = 'main') {
    global $data;
    $path = LAYOUTPATH . DIRECTORY_SEPARATOR .'footer'.DIRECTORY_SEPARATOR. $name . '.php';
    if (file_exists($path)) {
        if (is_array($data)) {
            foreach ($data as $key => $a) {
                $$key = $a;
            }
        }
        require $path;
    } else {
        echo "Không tìm thấy {$path}";
    }
}

#Chức năng : Gọi sidebar theme 
#$name : Tên sidebar cần gọi 
function get_sidebar($name = '') {
    global $data;
    if (empty($name)) {
        $name = 'main';
    }
    $path = LAYOUTPATH . DIRECTORY_SEPARATOR.'sidebar'.DIRECTORY_SEPARATOR. $name . '.php';
    if (file_exists($path)) {
        if (is_array($data)) {
            foreach ($data as $key => $a) {
                $$key = $a;
            }
        }
        require $path;
    } else {
        echo "Không tìm thấy {$path}";
    }
}

#Chức năng : Gọi một phần giao  diện  
#$name : Tên part cần gọi 
function get_template_part($name) {
    global $data;
    if (empty($name))
        return FALSE;
    $path = LAYOUTPATH . DIRECTORY_SEPARATOR .'template'.DIRECTORY_SEPARATOR. "{$name}.php";
    if (file_exists($path)) {
            foreach ($data as $key => $a) {
                $$key = $a;
            }
        require $path;
    } else {
        echo "Không tìm thấy {$path}";
    }
}

?>
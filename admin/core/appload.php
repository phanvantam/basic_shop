<?php
defined('APPPATH') OR exit('Không được quyền truy cập phần này');

# Include file config/database
require CONFIGPATH . DIRECTORY_SEPARATOR . 'database.php';

# Include file config/config
require CONFIGPATH . DIRECTORY_SEPARATOR . 'config.php';

# Include file config/email
require CONFIGPATH . DIRECTORY_SEPARATOR . 'email.php';

# Include file config/access
require CONFIGPATH . DIRECTORY_SEPARATOR . 'access.php';

# Include file config/autoload
require CONFIGPATH . DIRECTORY_SEPARATOR . 'autoload.php';

# Include core database
require LIBPATH . DIRECTORY_SEPARATOR . 'database.php';

# Include core base

require COREPATH . DIRECTORY_SEPARATOR . 'base.php';



#Chạy autoload cho hệ thống 
if (is_array($autoload)) {
    foreach ($autoload as $type => $list_auto) {
        if (!empty($list_auto)) {
            foreach ($list_auto as $name) {
                if($type == 'helper')
                    load_helper ($name) ;
                else
                    load_library($name);
            }
        }
    }
}




#Kết nối database 
db_connect($db);

require COREPATH . DIRECTORY_SEPARATOR . 'router.php';

















<?php

$config['access']['manager'] = array(
    'user' => array('index'=>array('index'=>'','add_user'=>'','actions'=>'','edit'=>'')) ,
    'sytem' => array('index'=>array(),'support'=>array()),
    'media'=> array('index'=>array('index'=>''))
);

$config['access']['personnel'] = array(
    'user' => array('index'=>array('index'=>'','add_user'=>'','actions'=>'','edit'=>'')) ,
    'sytem' => array('index'=>array(),'support'=>array()),
    'theme' => array(),
    'page'=>array(),
    'post'=>array('cat'=>array()),
    'product'=>array('cat'=>array(),'filter'=>array(),'order'=>array(),'customer'=>array()),
    'media'=> array('index'=>array('index'=>''))
);
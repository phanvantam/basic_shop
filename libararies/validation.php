<?php

function check_email($email)
{
    $partten = "/^[\w_\.]{6,32}@([\w]{2,12})(\.[a-zA-Z]{2,12})+$/" ;
    if (preg_match($partten,$email)) {
        return true ;
    }
    return false ;

}
function check_tel($tel)
{
    $partten = "/^[\d]{9,12}$/" ;
    if (preg_match($partten,$tel)) {
        return true ;
    }
    return false ;
}


function set_value($index)
{
    global $request  ;
    if (isset($request[$index])) {
       return $request[$index] ;
    }
}
//@ ham : get_error
//@ tham so : (str) $name_error    ten loi
//@ tra ve : Echo ra loi name
function get_error($name_error){
    global $error ;
    if (!empty($error[$name_error])) {
        return $error[$name_error] ;
    }
}

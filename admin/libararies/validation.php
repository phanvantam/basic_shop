<?php
function check_name($user_name)
{
    $partten =  "/^[^1-9\.<>\^&%$#@!]{4,10}$/" ;
    if (preg_match($partten,$user_name)) {
        return true ;
    }
    return false ;

}
function check_pass($pass)
{
    $partten =  "/^([\w_\.!@#$%^&*()]+){6,31}$/" ;
    if (preg_match($partten,$pass)) {
        return true ;
    }
    return false ;
}
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


//@ ham : set_value
//@ tham so : (str) $name bien can export
//@ tra ve : Echo ra bien name
function set_value($index,$value=true)
{
    global $request  ;
    if (isset($request[$index])) {
       return $request[$index] ;
    }else{
        if(!$value){
            return null ;
        }
        $result = get_cookie($index) ;
        if((bool)$result){
            return $result ;
        }
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

<?php

function get_customer_by_email($email){
    return db_fetch_row("SELECT * FROM tbl_customer WHERE email = '{$email}' ") ;
}

function add_customer_subscribe($email,$code_active){
    $data['email'] = $email ;
    $data['code_active'] = $code_active ;
    db_insert('tbl_customer', $data);
}

function actived_customer_subscribe($id){
    db_update('tbl_customer',array('subcribe'=>1,'code_active'=>'')," customer_id = {$id} ");
}

function update_customer_subscribe($id,$code_active){
    $data['code_active'] = $code_active ;
    db_update('tbl_customer',$data," customer_id = {$id} ");
}

function exists_code($code){
    return db_fetch_row(" SELECT * FROM tbl_customer WHERE code_active = '{$code}' ") ;
}
<?php

function get_info_sytem(){
    return db_fetch_row('SELECT * FROM tbl_sytem') ;
}

function update_info_sytem($input){
    db_update('tbl_sytem',$input,'1') ;
}

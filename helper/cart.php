<?php

#Lấy danh sách giỏ hàng 
function get_cart(){
    if(isset($_SESSION['cart'])){
        return $_SESSION['cart'] ;
    }
    return false ;
}

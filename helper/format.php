<?php

#Chức năng  : Định dạng tiền tệ 
#$number : Gía tiền 
#$suffix : Đơn vị nối vào 
function currency_format($number, $suffix = 'đ'){
    return str_replace(',','.',number_format($number).$suffix);
}

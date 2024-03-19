<?php
function product_view($limit){
    $sql="SELECT * FROM sanpham ORDER BY luot_xem DESC LIMIT ".$limit;
    return get_all($sql);  
} 

function product_all($limit){
    $sql="SELECT * FROM sanpham ORDER BY id DESC LIMIT ".$limit;
    return get_all($sql);  
} 


function product_category($id){
    $sql="SELECT * FROM sanpham WHERE ma_danh_muc = $id";
    return get_all($sql);  
} 
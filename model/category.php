<?php
function category_all(){
    $sql="SELECT * FROM danhmuc";
    return get_all($sql);  
} 
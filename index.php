<?php

require_once "model/global.php";
require_once "model/pdo.php";
require_once "model/product.php";
require_once "model/category.php";

if(isset($_GET['page'])){
    switch ($_GET['page']) {
        case 'productcategory':
            if(isset($_GET['idcat'])){
                $idcat=$_GET['idcat'];
            }else{
                $idcat=0;
            }
            $spdm=product_category($idcat);
            include_once 'view/productcategory.php';
            break;
        
        default:
            $dssp_view=product_view(10);
            $dssp=product_all(10);
            $category=category_all();
            include_once 'view/home.php';
            break;
    }
}else{
    $dssp_view=product_view(10);
    $dssp=product_all(10);
    $category=category_all();
    include_once 'view/home.php';
}
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
        case 'product':
            if(isset($_GET['trang'])){
                $trang=$_GET['trang'];
            }else{
                $trang=1;
            }
            if(isset($_GET['limit'])){
                $limit=$_GET['limit'];
            }else{
                $limit=SOLUONG_SP;
            }
            $datapro= product_all_limit(0,0);
            $productall= product_all_limit($limit,$trang);
            include_once 'view/product.php';
            break;
        
        default:
            $dssp_view=product_view(10);
            $dssp=product_all_limit(0,10);
            $category=category_all();
            include_once 'view/home.php';
            break;
    }
}else{
    $dssp_view=product_view(10);
    $dssp=product_all_limit(0,10);
    $category=category_all();
    include_once 'view/home.php';
}
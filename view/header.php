<?php
if(isset($_SESSION['user']['giohang'])){
    $countgiohang=count($_SESSION["user"]["giohang"]);
}else{
    $countgiohang=0;
}

if(isset($_SESSION['user'])){
    extract($_SESSION['user']);
    $html_account='<li><a href="index.php?page=info"><span class="icon icon-person"></span></a></li>
    <li><a href="index.php?page=loginlogout">Log out</a></li>';
 }else{
    $html_account='<li><a href="index.php?page=login">Log in</a></li>
                    <li><a href="index.php?page=signup">Sign up</a></li>';
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://view/layout/fonts/.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="view/layout/fonts//icomoon/style.css">
    <link rel="stylesheet" href="view/layout/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/layout/css/magnific-popup.css">
    <link rel="stylesheet" href="view/layout/css/jquery-ui.css">
    <link rel="stylesheet" href="view/layout/css/owl.carousel.min.css">
    <link rel="stylesheet" href="view/layout/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="view/layout/css/aos.css">
    <link rel="stylesheet" href="view/layout/css/style.css">
    <link rel="stylesheet" href="view/layout/css/login.css">
    <link rel="stylesheet" href="view/layout/css/signup.css">
    <link rel="stylesheet" href="view/layout/css/donhang_hoso.css">
</head>

<body>
    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            <div class="site-navbar-top">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                            <form action="index.php" class="site-block-top-search" method="post">
                                <!-- Sử dụng method="get" để dùng query string -->
                                <input type="hidden" name="page" value="product">
                                <!-- Thêm trường ẩn để truyền giá trị page -->
                                <span class="icon icon-search2"></span>
                                <input type="text" name="kyw" class="border-0" placeholder="Search">
                                <!-- Hiển thị giá trị của kyw nếu có -->
                                <button type="submit"
                                    style="outline: none;border: none;background-color: #7971EA;color: #fff;padding: 5px 10px;border-radius: 3px;cursor: pointer;">Search</button>
                            </form>
                        </div>
                        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                            <div class="site-logo">
                                <a href="index.php" class="js-logo-clone">Lopie</a>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                            <div class="site-top-icons">
                                <ul>
                                    <li><?php
                                    if(isset($_SESSION['user']) && isset($_SESSION['user']['ten_nguoi_dung'])){
                                        echo "Xin chào " . $_SESSION['user']['ten_nguoi_dung'] ."!!!";
                                    } else {
                                        echo "";
                                    }                                    
                                    ?></li>
                                    <li>
                                        <a href="index.php?page=viewcart" class="site-cart">
                                            <span class="icon icon-shopping_cart"></span>
                                            <span class="count"><?=$countgiohang;?></span>
                                        </a>
                                    </li>
                                    <?=$html_account;?>
                                    <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                            class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="site-navigation text-right text-md-center" role="navigation">
                <div class="container">
                    <ul class="site-menu js-clone-nav d-none d-md-block">
                        <li class="has-children active">
                            <a href="index.php">Home</a>
                            <ul class="dropdown">
                                <li><a href="#">Menu One</a></li>
                                <li><a href="#">Menu Two</a></li>
                                <li><a href="#">Menu Three</a></li>
                            </ul>
                        </li>
                        <li><a href="index.php?page=product">Shop</a></li>
                        <li><a href="index.php?page=about">About</a></li>
                        <li><a href="index.php?page=contact">Contact</a></li>
                    </ul>
                </div>
            </nav>
        </header>
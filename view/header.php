<?php
if (isset($_SESSION['user']['giohang'])) {
    $countgiohang = count($_SESSION["user"]["giohang"]);
} else {
    $countgiohang = 0;
}

if (isset($_SESSION['user'])) {
    extract($_SESSION['user']);
    $html_account = '<li><a href="index.php?page=info"><span class="icon icon-person"></span></a></li>
    <li><a href="index.php?page=loginlogout">Đăng xuất</a></li>';
} else {
    $html_account = '<li><a href="index.php?page=login" style="margin-right: 4px;">Đăng nhập</a></li>/
                    <li><a href="index.php?page=signup">Đăng ký</a></li>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lopie</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="view/layout/images/logo.jpg">
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
                            <form action="index.php?page=product" class="site-block-top-search" method="post">
                                <input type="hidden" name="page" value="product">
                                <span class="icon icon-search2"></span>
                                <input type="text" name="kyw" class="border-0" placeholder="Tìm kiếm sản phẩm...">
                                <button type="submit"
                                    style="outline: none;border: none;background-color: #7971EA;color: #fff;padding: 5px 10px;border-radius: 3px;cursor: pointer;"
                                    name="btn_search">Tìm kiếm</button>
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
                                        if (isset($_SESSION['user']) && isset($_SESSION['user']['ten_nguoi_dung'])) {
                                            echo "Xin chào " . $_SESSION['user']['ten_nguoi_dung'] . "!!!";
                                        } else {
                                            echo "";
                                        }
                                        ?></li>
                                    <li>
                                        <a href="index.php?page=viewcart" class="site-cart">
                                            <span class="icon icon-shopping_cart"></span>
                                            <span class="count"><?= $countgiohang; ?></span>
                                        </a>
                                    </li>
                                    <?= $html_account; ?>
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
                        <li class="active"><a href="index.php">Trang chủ</a></li>
                        <li><a href="index.php?page=product">Sản phẩm</a></li>
                        <li><a href="index.php?page=about">Về chúng tôi</a></li>
                        <li><a href="index.php?page=contact">Liên hệ</a></li>
                    </ul>
                </div>
            </nav>
        </header>
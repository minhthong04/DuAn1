<?php
$html_showproductall = "";
foreach ($productall as $item) {
    extract($item);
    $html_showproductall .= '<div class="col-sm-6 col-md-6 col-lg-4 mb-5 mb-lg-0" data-aos="fade" data-aos-delay="200" style="padding-top: 30px;">
                                <a class="block-2-item" href="index.php?page=productdetail&id=' . $id . '">
                                <figure class="image">
                                    <img src="uploads/' . $hinh_san_pham . '" alt="" class="img-fluid">
                                </figure>
                                <div class="text">
                                    <span class="text-uppercase" style="font-weight: 400;">' . number_format($gia_san_pham, 0, ",", ".") . '<sup>đ</sup></span>
                                    <h3 style="font-size: 1.3rem;">' . $ten_san_pham . '</h3>
                                    <form action="index.php?page=addtocartproduct" method="post">
                                        <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" style="outline: none;border: none;background-color: #7971EA;color: #fff;padding: 5px 10px;border-radius: 3px;cursor: pointer;">
                                        <input type="hidden" name="soluong" value="1">
                                        <input type="hidden" name="id" value="' . $id . '">
                                        <input type="hidden" name="ten_san_pham" value="' . $ten_san_pham . '">
                                        <input type="hidden" name="hinh_san_pham" value="' . $hinh_san_pham . '">
                                        <input type="hidden" name="gia_san_pham" value="' . $gia_san_pham . '">
                                    </form>
                                </div>
                                </a>
                            </div>';
}

$html_categoryinproduct = "";
foreach ($category as $item) {
    extract($item);
    $link = 'index.php?page=product&trang=' . $trang . '&idcat=' . $id . '&orderby=' . $orderby . '&kyw=' . $kyw;
    $html_categoryinproduct .= '<li class="mb-1"><a href="' . $link . '" class="d-flex"><span>' . $ten_danh_muc . '</span></a></li>';
}
?>

<?php include_once "header.php"; ?>

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Sản phẩm</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">

        <div class="row mb-5">
            <div class="col-md-9 order-2">

                <div class="row">
                    <div class="col-md-12 mb-5">
                        <div class="float-md-left mb-4">
                            <h2 class="text-black h5">Tất cả sản phẩm</h2>
                        </div>
                        <div class="d-flex" style="">
                            <div class="dropdown mr-1 ml-md-auto">

                            </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" id="dropdownMenuReference" data-toggle="dropdown">Mặc định</button>
                                <div class="dropdown-menu" name="filter" aria-labelledby="dropdownMenuReference">
                                    <a class="dropdown-item" href="index.php?page=product">Mặc định</a>
                                    <a class="dropdown-item" href="index.php?page=product&trang=<?= $trang ?>&idcat=<?= $idcat ?>&orderby=ASCPRICE&kyw=<?= $kyw ?>">Giá thấp đến cao</a>
                                    <a class="dropdown-item" href="index.php?page=product&trang=<?= $trang ?>&idcat=<?= $idcat ?>&orderby=DESCPRICE&kyw=<?= $kyw ?>">Giá cao đến thấp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">

                    <?= $html_showproductall; ?>

                </div>
                <div class="row" data-aos="fade-up">
                    <div class="col-md-12 text-center">
                        <div class="site-block-27">
                            <ul>
                                <?= $phantrang; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 order-1 mb-5 mb-md-0">
                <div class="border p-4 rounded mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Danh mục</h3>
                    <ul class="list-unstyled mb-0">
                        <?= $html_categoryinproduct; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>
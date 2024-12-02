<?php
$html_dssp_vew = "";
foreach ($dssp_view as $item) {
    extract($item);
    $html_dssp_vew .= '<div class="item">
                    <div class="block-4 text-center">
                    <a class="block-2-item" href="index.php?page=productdetail&id=' . $id . '">
                      <figure class="block-4-image">
                        <img src="uploads/' . $hinh_san_pham . '" alt="Image placeholder" class="img-fluid">
                      </figure>
                      <div class="block-4-text p-4">
                        <h3><a href="#">' . $ten_san_pham . '</a></h3>
                        <p class="mb-0">' . $luot_xem . ' Lượt xem</p>
                        <p class="text-primary font-weight-bold">' . number_format($gia_san_pham, 0, ",", ".") . '<sup>đ</sup></p>
                        <form action="index.php?page=addtocarthome" method="post">
                            <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" style="outline: none;border: none;background-color: #7971EA;color: #fff;padding: 5px 10px;border-radius: 3px;cursor: pointer;">
                            <input type="hidden" name="soluong" value="1">
                            <input type="hidden" name="id" value="' . $id . '">
                            <input type="hidden" name="ten_san_pham" value="' . $ten_san_pham . '">
                            <input type="hidden" name="hinh_san_pham" value="' . $hinh_san_pham . '">
                            <input type="hidden" name="gia_san_pham" value="' . $gia_san_pham . '">
                        </form>
                        </div>
                        <a/>
                    </div>
                  </div>';
}

$html_dssp = "";
foreach ($dssp as $item) {
    extract($item);
    $html_dssp .= '<div class="item">
                <div class="block-4 text-center">
                    <a class="block-2-item" href="index.php?page=productdetail&id=' . $id . '">
                    <figure class="block-4-image">
                    <img src="uploads/' . $hinh_san_pham . '" alt="Image placeholder" class="img-fluid">
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="#">' . $ten_san_pham . '</a></h3>
                    <p class="mb-0">' . $luot_xem . ' Lượt xem</p>
                    <p class="text-primary font-weight-bold">' . number_format($gia_san_pham, 0, ",", ".") . '<sup>đ</sup></p>
                    <form action="index.php?page=addtocarthome" method="post">
                    <input type="submit" value="Thêm vào giỏ hàng" name="add_to_cart" style="outline: none;border: none;background-color: #7971EA;color: #fff;padding: 5px 10px;border-radius: 3px;cursor: pointer;">
                    <input type="hidden" name="soluong" value="1">
                    <input type="hidden" name="id" value="' . $id . '">
                    <input type="hidden" name="ten_san_pham" value="' . $ten_san_pham . '">
                    <input type="hidden" name="hinh_san_pham" value="' . $hinh_san_pham . '">
                    <input type="hidden" name="gia_san_pham" value="' . $gia_san_pham . '">
                </form>
                  </div>
                  <a/>
                </div>
              </div>';
}

$html_category = "";
foreach ($category as $item) {
    extract($item);
    $linkcategory = "index.php?page=productcategory&idcat=" . $id;
    $html_category .= '<div class="col-sm-6 col-md-6 col-lg-4 mb-4 mb-lg-0" data-aos="fade" data-aos-delay="">
                            <a class="block-2-item" href="' . $linkcategory . '">
                            <figure class="image">
                                <img src="uploads/' . $anh_danh_muc . '" alt="" class="img-fluid">
                            </figure>
                            <div class="text">
                                <span class="text-uppercase">Bộ sưu tập</span>
                                <h3>' . $ten_danh_muc . '</h3>
                            </div>
                            </a>
                        </div>';
}
?>

<?php include_once "header.php"; ?>

<div class="site-blocks-cover" style="background-image: url(view/layout/images/hero_1.jpg);" data-aos="fade">
    <div class="container">
        <div class="row align-items-start align-items-md-center justify-content-end">
            <div class="col-md-5 text-center text-md-left pt-5 pt-md-0">
                <h1 class="mb-2">Tìm kiếm món đồ yêu thích của bạn</h1>
                <div class="intro-text text-center text-md-left">
                    <p class="mb-4">Mọi thứ bạn cần tìm kiếm đang ở trang web chúng tôi, bạn có thể mua hàng và thanh
                        toán một cách dễ dàng. </p>
                    <p>
                        <a href="index.php?page=product" class="btn btn-sm btn-primary">Mua ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section site-section-sm site-blocks-1">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-truck"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Miễn phí giao hàng</h2>
                    <p>Miễn phí giao hàng với các tỉnh trên Việt Nam, và với những khách hàng lần đầu trải nghiệm mua
                        hàng.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-refresh2"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Miễn phí hoàn trả</h2>
                    <p>Đối với khách hàng mặt không vừa hoặc chọn sai số lượng chúng tôi có thể hoàn trả cho bạn hoàn
                        toàn miễn phí.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="icon mr-4 align-self-start">
                    <span class="icon-help"></span>
                </div>
                <div class="text">
                    <h2 class="text-uppercase">Nhân viên hỗ trợ</h2>
                    <p>Chúng tôi có đội ngũ nhân viên hỗ trợ nhiệt tình giúp bạn có thể chọn đúng size các món đồ bạn
                        yêu thích.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section site-blocks-2">
    <div class="container">
        <div class="row">
            <?= $html_category; ?>
        </div>
    </div>
</div>

<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Sản phẩm nhiều lượt xem</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    <?= $html_dssp_vew; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section block-8">
    <div class="container">
        <div class="row justify-content-center  mb-5">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Big Sale!</h2>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 mb-5">
                <a href="#"><img src="view/layout/images/blog_1.jpg" alt="Image placeholder"
                        class="img-fluid rounded"></a>
            </div>
            <div class="col-md-12 col-lg-5 text-center pl-md-5">
                <h2><a href="#">Giảm giá 50% tất cả các mặt hàng mới</a></h2>
                <p>Tất cả các sản phẩm mới ra đều được giảm giá nhân nhân ngày khai trương cửa hàng để giúp khách hàng
                    có thể tiếp cận sản phẩm một cách dễ dàng</p>
                <p><a href="index.php?page=product" class="btn btn-primary btn-sm">Mua ngay</a></p>
            </div>
        </div>
    </div>
</div>

<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Các sản phẩm của chúng tôi</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    <?= $html_dssp; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>
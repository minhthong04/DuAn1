<?php include_once "header.php"; ?>

<?php

$thongbaocart = ""; // Khởi tạo biến thông báo giỏ hàng rỗng
$html_showcart = ""; // Khởi tạo biến hiển thị giỏ hàng
if (isset($_SESSION['user']['giohang']) && !empty($_SESSION['user']['giohang'])) {
    $i = 0;
    foreach ($_SESSION['user']['giohang'] as $item) {
        extract($item);
        $gia_san_pham_int = intval($gia_san_pham); // Chuyển giá sản phẩm thành số nguyên
        $soluong_int = intval($soluong); // Chuyển số lượng thành số nguyên
        $linkdelete = "index.php?page=viewcart&del=" . $i;
        // Show sản phẩm trong giỏ hàng
        $html_showcart .= '<tr>
        <td class="product-thumbnail">
            <img src="uploads/' . $hinh_san_pham . '" alt="Image" class="img-fluid">
        </td>
        <td class="product-name">
            <h2 class="h5 text-black">' . $ten_san_pham . '</h2>
        </td>
        <td class="product-price js-product-price">' . $gia_san_pham . '</td>
        <td>
        <div class="input-group mb-3">
        <div class="input-group-btn">
            <a href="index.php?page=decrease&i='.$i.'">
                <button class="btn btn-outline-primary" type="button">&minus;</button>
            </a>
        </div>
        <div class="quantity form-control text-center">'.$soluong_int.'</div>
        <div class="input-group-btn">
            <a href="index.php?page=increase&i='.$i.'">
                <button class="btn btn-outline-primary" type="button">&plus;</button>
            </a>
        </div>
    </div>
        </td>
        <td class="total">' . $soluong_int * $gia_san_pham_int . '</td>
        <td><a href="' . $linkdelete . '" class="btn btn-primary btn-sm">X</a></td>
    </tr>';

        // Tiếp tục vòng lặp bằng cách tăng giá trị của $i
        $i++;
    }
} else {
    // Hiển thị thông báo giỏ hàng rỗng
    $thongbaocart = "<tr>
                          <td colspan='6' style='font-size: 30px;font-weight: bold;color: #7971ea;'>Giỏ hàng trống !!!</td>
                      </tr>";
}

if (empty($_SESSION['user']['giohang'])) {
    $html_viewcarttocheckout = '<a href="#>
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block">Thanh toán giỏ hàng</button>
                                </div>
                                <p style="color: red;font-weight: bold;font-size: 12px;">Bạn phải mua ít nhất 1 sản phẩm để có thể thanh toán!</p>
                            </a>';
} elseif (empty($_SESSION['user']['email']) && empty($_SESSION['user']['dia_chi']) && empty($_SESSION['user']['so_dien_thoai'])) {
    $html_viewcarttocheckout = '<a href="#">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block">Thanh toán giỏ hàng</button>
                                </div>
                                <p style="color: red;font-weight: bold;font-size: 12px;text-align: center;">Bạn phải cập nhật Email, Số điện thoại và địa chỉ giao hàng mới có thể thanh toán!</p>
                            </a>';
} else {
    $html_viewcarttocheckout = '<a href="index.php?page=checkout">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block" >Thanh toán giỏ hàng</button>
                                </div>
                            </a>';
}

?>


<style>

    /* Custom CSS for quantity input */
.input-group {
    max-width: 120px;
    margin: 0 auto;
}

.input-group-btn {
    width: 33.333%;
    padding: 0;
}

.quantity {
    text-align: center;
    width: 33.333%;
    border-left: 0;
    border-right: 0;
}

.quantity-input {
    width: 33.333%;
    padding-left: 0;
}

</style>

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Giỏ hàng</strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row mb-5">
            <form class="col-md-12" method="post">
                <div class="site-blocks-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="product-thumbnail">Hình ảnh</th>
                                <th class="product-name">Tên sản phẩm</th>
                                <th class="product-price">Giá sản phẩm</th>
                                <th class="product-quantity">Số lượng</th>
                                <th class="product-total">Tổng giá</th>
                                <th class="product-remove">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= $thongbaocart; ?>
                            <?= $html_showcart; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <button class="btn btn-outline-primary btn-sm btn-block">Tiếp tục mua sắm</button>
                    </div>
                </div>

            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Tổng giá đơn hàng</h3>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Tổng giá sản phẩm</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black"><?= number_format(tongdonhang(), 0, ",", ".") ?></strong>
                            </div>
                        </div>

                        <div class="row" style="justify-content:center;">
                            <?= $html_viewcarttocheckout ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>
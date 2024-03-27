<?php include_once "header.php";?>

<?php

$thongbaocart = ""; // Khởi tạo biến thông báo giỏ hàng rỗng
$html_showcart = ""; // Khởi tạo biến hiển thị giỏ hàng
if(isset($_SESSION['user']['giohang']) && !empty($_SESSION['user']['giohang'])){
    $i=0;
    foreach($_SESSION['user']['giohang'] as $item) {
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
            <div class="input-group mb-3" style="max-width: 120px;">        
                <a href="index.php?page=decrease&i=' . $i . '">
                    <button class="btn btn-outline-primary" type="button">&minus;</button>
                </a>
                <div class="form-control text-center quantity">' . $soluong_int . '</div>
                <a href="index.php?page=increase&i=' . $i . '">
                    <button class="btn btn-outline-primary" type="button">&plus;</button>
                </a>
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
                          <td colspan='6' style='font-size: 30px;font-weight: bold;color: #7971ea;'>Giỏ hàng rỗng !!!</td>
                      </tr>";
}
?>




<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong
                    class="text-black">Cart</strong></div>
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
                                <th class="product-thumbnail">Image</th>
                                <th class="product-name">Product</th>
                                <th class="product-price">Price</th>
                                <th class="product-quantity">Quantity</th>
                                <th class="product-total">Total</th>
                                <th class="product-remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?=$thongbaocart;?>
                            <?=$html_showcart;?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <button class="btn btn-outline-primary btn-sm btn-block">Continue Shopping</button>
                    </div>
                </div>
            
            </div>
            <div class="col-md-6 pl-5">
                <div class="row justify-content-end">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12 text-right border-bottom mb-5">
                                <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black"><?=number_format(tongdonhang(),0,",",".")?></strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black"><?=number_format(tongdonhang(),0,",",".")?></strong>
                            </div>
                        </div>

                        <div class="row">
                            <a href="index.php?page=checkout">
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-lg py-3 btn-block">Proceed To Checkout</button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php";?>
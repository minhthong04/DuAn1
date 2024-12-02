<?php include_once "header.php"; ?>

<?php
$html_checkoutproduct = "";
if (isset($_SESSION['user']['giohang'])) {
    foreach ($_SESSION['user']['giohang'] as $item) {
        extract($item);
        $html_checkoutproduct .= '<tr>
                                <td>' . $ten_san_pham . ' <strong class="mx-2">x</strong> ' . $soluong . '</td>
                                <td>' . number_format($tong_gia, 0, ",", ".") . '<sup>đ</sup></td>
                            </tr>';
    }
}
if (isset($_SESSION['user'])) {
}


if (isset($_GET['code']) && isset($_GET['message']) && isset($_GET['data'])) {

    header('Location: index.php?page=thankyou');
    exit();
}


if (isset($infousercheckout)) {
}
?>

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
    </div>
</div>
<div class=" site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <form action="index.php?page=checkout" method="post" enctype="multipart/form-data">
                    <h2 class=" h3 mb-3 text-black">Chi tiết thanh toán (Cập nhật thông tin trong trang người dùng)</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">Họ và tên</label>
                                <input type="text" class="form-control" id="c_companyname" name="firstname" value="<?= $infousercheckout['ten_nguoi_dung'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">Địa chỉ giao hàng</label>
                                <input type="text" class="form-control" id="c_companyname" name="deliveryaddress" value="<?= $infousercheckout['dia_chi'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">Địa chỉ email</label>
                                <input type="text" class="form-control" id="c_companyname" name="email" value="<?= $infousercheckout['email'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">Số điện thoại</label>
                                <input type="text" class="form-control" id="c_companyname" name="phone" value="<?= $infousercheckout['so_dien_thoai'] ?>">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Áp dụng voucher</h2>
                        <div class="p-3 p-lg-5 border">
                            <label for="c_code" class="text-black mb-3">Nếu có voucher hãy nhập vào đây</label>
                            <div class="input-group w-75">
                                <from action="index.php?page=checkout" method="post" style="display: flex;">
                                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2" name="voucher">
                                    <div class="input-group-append">
                                        <input type="submit" value="APPLY" class="btn btn-primary btn-sm" name="btn_voucher">
                                    </div>
                                </from>
                                <?php
                                if (isset($error_message)) {
                                    echo "$error_message";
                                }; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Các sản phẩm đã mua</h2>
                        <div class="p-3 p-lg-5 border">
                            <table class="table site-block-order-table mb-5">
                                <thead>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                </thead>
                                <tbody>
                                    <?= $html_checkoutproduct; ?>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Tổng giá</strong></td>
                                        <td class="text-black">
                                            <?= number_format(tongdonhang(), 0, ",", ".") ?><sup>đ</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Đã giảm <?php
                                                                                                if (isset($_SESSION['phantramgiam'])) {
                                                                                                    echo  $_SESSION['phantramgiam'] . "%";
                                                                                                } else {
                                                                                                    echo "0%";
                                                                                                }
                                                                                                ?></strong>
                                        </td>
                                        <td class="text-black">
                                            <?php
                                            // Kiểm tra nếu tồn tại giá trị giảm giá từ session thì hiển thị nó
                                            if (isset($_SESSION['daxaivoucher'])) {
                                                echo number_format($_SESSION['daxaivoucher'], 0, ",", ".") . "<sup>đ</sup>";
                                            } else {
                                                echo "0<sup>đ</sup>"; // Nếu không có giá trị thì hiển thị 0
                                            }
                                            ?>
                                        </td>
                                        <td class="text-black font-weight-bold"><a href="index.php?page=voucherdelete">Delete voucher</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Phương thức thanh toán</h2>
                                <div class="p-3 p-lg-5 border">
                                    <label for="payment_method" class="text-black mb-3">Chọn phương thức thanh toán của bạn</label>
                                    <form action="index.php?page=checkout" method="post">
                                        <input type="hidden" name="payment_method" value="0">
                                        <input type="hidden" name="idnguoidung" value="<?= $_SESSION['user']['id'] ?>">
                                        <input type="submit" class="btn btn-primary btn-lg py-3 btn-block" name="btn_place_order" value="COD">
                                    </form>
                                    <?php
                                    if (isset($thongbaocod)) {
                                        echo "$thongbaocod";
                                    }; ?>
                                    <form action="index.php?page=checkout" method="post">
                                        <input type="hidden" name="payment_method" value="1">
                                        <input type="hidden" name="idnguoidung" value="<?= $_SESSION['user']['id'] ?>">
                                        <input type="hidden" class="form-control" id="c_companyname" name="firstname" value="<?= $infousercheckout['ten_nguoi_dung'] ?>">
                                        <input type="hidden" class="form-control" id="c_companyname" name="deliveryaddress" value="<?= $infousercheckout['dia_chi'] ?>">
                                        <input type="hidden" class="form-control" id="c_companyname" name="email" value="<?= $infousercheckout['email'] ?>">
                                        <input type="hidden" class="form-control" id="c_companyname" name="phone" value="<?= $infousercheckout['so_dien_thoai'] ?>">

                                        <input type="submit" class="btn btn-primary btn-lg py-3 btn-block" name="redirect" value="VNPAY" style="margin-top: 16px;background-color: #ed1c24;border: none;">
                                    </form>
                                    <?php
                                    if (isset($thongbaovnpay)) {
                                        echo "$thongbaovnpay";
                                    }; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </form> -->
    </div>

</div>


<?php include_once "footer.php"; ?>
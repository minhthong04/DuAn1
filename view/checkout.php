<?php include_once "header.php";?>

<?php
$html_checkoutproduct="";
if(isset($_SESSION['user']['giohang'])){
foreach ($_SESSION['user']['giohang'] as $item) {
    extract($item);
    $html_checkoutproduct.='<tr>
                                <td>'.$ten_san_pham.' <strong class="mx-2">x</strong> '.$soluong.'</td>
                                <td>'.number_format($tong_gia,0,",",".").'<sup>đ</sup></td>
                            </tr>';
}
}
if(isset($_SESSION['user'])){
}

// Kiểm tra xem dữ liệu trả về từ VNPAY đã được gửi chưa
if (isset($_GET['code']) && isset($_GET['message']) && isset($_GET['data'])) {
    // Xử lý dữ liệu trả về từ VNPAY ở đây
    // Ví dụ: Lưu dữ liệu vào cơ sở dữ liệu, kiểm tra tính hợp lệ của giao dịch, v.v.

    // Sau khi xử lý xong, chuyển hướng người dùng đến trang cảm ơn
    header('Location: index.php?page=thankyou');
    exit();
}
?>

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a
                    href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong
                    class="text-black">Checkout</strong></div>
        </div>
    </div>
</div>
<div class=" site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <form action="index.php?page=checkout" method="post" enctype="multipart/form-data">
                    <h2 class=" h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border">

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">First Name</label>
                                <input type="text" class="form-control" id="c_companyname" name="firstname"
                                    value="<?=$_SESSION['user']['ten_nguoi_dung']?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">delivery address</label>
                                <input type="text" class="form-control" id="c_companyname" name="deliveryaddress"
                                    value="<?=$_SESSION['user']['ten_nguoi_dung']?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">Email</label>
                                <input type="text" class="form-control" id="c_companyname" name="email"
                                    value="<?=$_SESSION['user']['email']?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">Phone</label>
                                <input type="text" class="form-control" id="c_companyname" name="phone"
                                    value="<?=$_SESSION['user']['so_dien_thoai']?>">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                        <div class="p-3 p-lg-5 border">
                            <label for="c_code" class="text-black mb-3">Enter your coupon code if you have
                                one</label>
                            <div class="input-group w-75">
                                <from action="index.php?page=checkout" method="post" style="display: flex;">
                                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code"
                                        aria-label="Coupon Code" aria-describedby="button-addon2" name="voucher">
                                    <div class="input-group-append">
                                        <input type="submit" value="APPLY" class="btn btn-primary btn-sm"
                                            name="btn_voucher">
                                    </div>
                                </from>
                                <?php
                                    if(isset($error_message)){
                                        echo "$error_message";
                                    }
                                    ;?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Your Order</h2>
                        <div class="p-3 p-lg-5 border">
                            <table class="table site-block-order-table mb-5">
                                <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                </thead>
                                <tbody>
                                    <?=$html_checkoutproduct;?>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Cart total</strong></td>
                                        <td class="text-black">
                                            <?=number_format(tongdonhang(),0,",",".")?><sup>đ</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Voucher applied</strong>
                                        </td>
                                        <td class="text-black">
                                            <?php 
                                            // Kiểm tra nếu tồn tại giá trị giảm giá từ session thì hiển thị nó
                                            if(isset($_SESSION['daxaivoucher'])){
                                                echo number_format($_SESSION['daxaivoucher'], 0, ",", ".") . "<sup>đ</sup>";
                                            } else {
                                                echo "0<sup>đ</sup>"; // Nếu không có giá trị thì hiển thị 0
                                            }
                                            ?>
                                        </td>
                                        <td class="text-black font-weight-bold"><a
                                                href="index.php?page=voucherdelete">Delete voucher</a></td>

                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Payment Method</h2>
                                <div class="p-3 p-lg-5 border">
                                    <label for="payment_method" class="text-black mb-3">Select your payment
                                        method</label>
                                    <form action="index.php?page=checkout" method="post">
                                        <input type="hidden" name="payment_method" value="0">
                                        <input type="hidden" name="idnguoidung" value="<?=$_SESSION['user']['id']?>">
                                        <input type="submit" class="btn btn-primary btn-lg py-3 btn-block"
                                            name="btn_place_order" value="COD">
                                    </form>
                                    <?php
                                    if(isset($thongbaocod)){
                                        echo "$thongbaocod";
                                    }
                                    ;?>

                                    <form action="index.php?page=checkout" method="post">
                                        <input type="hidden" name="payment_method" value="1">
                                        <input type="hidden" name="idnguoidung" value="<?=$_SESSION['user']['id']?>">
                                        <input type="submit" class="btn btn-primary btn-lg py-3 btn-block"
                                            name="redirect" value="VNPAY"
                                            style="margin-top: 16px;background-color: #ed1c24;border: none;">
                                    </form>
                                    <?php
                                    if(isset($thongbaovnpay)){
                                        echo "$thongbaovnpay";
                                    }
                                    ;?>
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


<?php include_once "footer.php";?>
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

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <h2 class="h3 mb-3 text-black">Billing Details</h2>
                <div class="p-3 p-lg-5 border">
                    <form action="" method="post">
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
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row mb-5">
                    <div class="col-md-12">
                        <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                        <div class="p-3 p-lg-5 border">
                            <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                            <div class="input-group w-75">
                                <form action="index.php?page=checkout" method="post" style="display: flex;">
                                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code"
                                        aria-label="Coupon Code" aria-describedby="button-addon2" name="voucher">
                                    <div class="input-group-append">
                                        <input type="submit" value="APPLY" class="btn btn-primary btn-sm"
                                            name="btn_voucher">
                                    </div>
                                </form>
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
                                        <td class="text-black"><?=number_format(tongdonhang(),0,",",".")?><sup>đ</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Voucher applied</strong></td>
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
                                        <td class="text-black font-weight-bold"><a href="index.php?page=voucherdelete">Delete voucher</a></td>

                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Payment Method</h2>
                                <div class="p-3 p-lg-5 border">
                                    <form action="">
                                        <label for="payment_method" class="text-black mb-3">Select your payment
                                            method</label>
                                        <select class="form-control" id="payment_method" name="payment_method">
                                            <option value="cod">COD</option>
                                            <option value="vnpay">VNPAY</option>
                                        </select>
                                    </form>
                                </div>
                            </div>


                            <div class="form-group">
                                <button class="btn btn-primary btn-lg py-3 btn-block"
                                    onclick="window.location='thankyou.html'">Place Order</button>
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
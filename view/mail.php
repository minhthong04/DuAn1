<?php

?>

<?php
if (isset($_SESSION['user']['giohang'])) {
    $mailContent = '';

    // Duyệt qua mảng sản phẩm trong session "giohang"
    foreach ($_SESSION['user']['giohang'] as $index => $product) {
        $productName = $product['ten_san_pham'];
        $quantity = $product['soluong'];
        $totalPrice = number_format($product['tong_gia'], 0, ",", ".");

        // Tạo chuỗi cho mỗi sản phẩm
        $productInfo = ($index + 1) . ". $productName x $quantity = $totalPrice";

        // Thêm thông tin sản phẩm vào nội dung email
        $mailContent .= $productInfo;
    }
}
if (is_array($order_info)) {
    $paymentText = "";
    if ($order_info['phuong_thuc_thanh_toan'] == 0) {
        $paymentText = "COD";
    } elseif ($order_info['phuong_thuc_thanh_toan'] == 1) {
        $paymentText = "VNPAY";
    } else {
        $paymentText = 'Other';
    }
}

if (isset($_SESSION['user'])) {
}

if (isset($infousercheckout)) {
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
//Create an instance; passing `true` enables exceptions
if (isset($_POST['btn_place_order']) || isset($_POST['redirect'])) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'thonggaming24604@gmail.com';                     //SMTP username
        $mail->Password   = 'icpanmdjefnxhfmq';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        //Recipients
        $mail->setFrom('thonggaming24604@gmail.com', 'LOPIE');
        $mail->addAddress($infousercheckout['email'], $_SESSION['user']['ten_nguoi_dung']);    //Add a recipient
        $mail->addReplyTo('thonggaming24604@gmail.com', 'Test Mail');


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'YOUR ORDER AT LOPIE';
        $mail->Body = '
        Xác nhận đơn hàng của bạn<br><br>
        Chào ' . $_SESSION['user']['ten_nguoi_dung'] . ',<br><br>
        Chúng tôi xin chân thành cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi. Đơn hàng của bạn đã được xác nhận và đang được xử lý. Dưới đây là thông tin chi tiết về đơn hàng của bạn:<br><br>
        - Mã Đơn Hàng: ' . $order_info['id'] . '<br>
        - Ngày Đặt Hàng: ' . $order_info['ngay_thanh_toan'] . '<br>
        - Phương Thức Thanh Toán: ' . $paymentText . '<br><br>
        Dưới đây là danh sách sản phẩm bạn đã đặt:
        <br>
        <br>
        ' . $mailContent . '<sup>đ</sup>
        <br>
        Tổng cộng: ' . number_format(tongdonhang(), 0, ",", ".") . '<sup>đ</sup><br><br>
        Thông tin vận chuyển:<br>
        - Họ và tên: ' . $_SESSION['user']['ten_nguoi_dung'] . '<br>
        - Địa chỉ: ' . $_SESSION['user']['dia_chi'] . '<br>
        - Số điện thoại: ' . $_SESSION['user']['so_dien_thoai'] . '<br><br>
        Nếu có bất kỳ câu hỏi hoặc thắc mắc nào, vui lòng liên hệ với chúng tôi qua email hoặc số điện thoại được cung cấp bên dưới.<br><br>
        Chân thành,<br>
        LOPIE';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

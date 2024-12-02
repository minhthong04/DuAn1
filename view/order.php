<?php
$html_order = '';
$payment = '';
$orderstatus = '';
$thongbaoorder = ''; // Khởi tạo biến thông báo

if (isset($order) && !empty($order)) {
    foreach ($order as $item) {
        extract($item);
        if ($phuong_thuc_thanh_toan == 0) {
            $payment = "COD";
        } elseif ($phuong_thuc_thanh_toan == 1) {
            $payment = "VNPAY";
        } else {
            $payment = "Không xác định!!";
        }

        if ($trang_thai_don_hang == 0) {
            $orderstatus = "Đang xác nhận";
        } elseif ($trang_thai_don_hang == 1) {
            $orderstatus = "Đang giao";
        } elseif ($trang_thai_don_hang == 2) {
            $orderstatus = "Đã giao";
        } else {
            $orderstatus = "Không xác định!!";
        }
        $html_order .= '<tr>
                        <td>' . $ten . '</td>
                        <td>' . $dia_chi . '</td>
                        <td>' . $email . '</td>
                        <td>' . $sdt . '</td>
                        <td>' . $ma_giam_gia . '</td>
                        <td>' . $orderstatus . '</td>
                        <td>' . $payment . '</td>
                        <td>' . $ngay_thanh_toan . '</td>
                        <td>
                            <a href="index.php?page=orderdel&id=' . $id . '" class="cancel-btn">X</a>
                        </td>
                        <td>
                            <a href="index.php?page=orderdetail&id=' . $id . '" class="detail-btn">Detail</a>
                        </td>
                    </tr>';
    }
} else {
    // Hiển thị thông báo giỏ hàng rỗng
    $thongbaoorder = "<tr>
                        <td colspan='10' style='font-size: 30px;font-weight: bold;color: #7971ea;'>Bạn chưa có đơn hàng nào !!!</td>
                    </tr>";
}


$html_admin = '';
if ($showinfo['vai_tro'] == 1) {
    $html_admin = '<a href="index.php?page=admin" class="info-left__link">Quản lí admin</a>';
} else {
    $html_admin = '';
}

?>

<?php include_once "header.php"; ?>

<div class="container-info">
    <div class="info-left">
        <a href="index.php?page=info" class="info-left__link">Hồ sơ</a>
        <a href="index.php?page=order" class="info-left__link" style="color: #7971ea;">Trạng thái đơn hàng</a>
        <?= $html_admin ?>
    </div>
    <div class="info-right">
        <table>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Mã giảm giá</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Phương thức thanh toán</th>
                    <th>Ngày thanh toán</th>
                    <th>Hủy đơn hàng</th>
                    <th>Xem chi tiết đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                <?= $html_order; ?>
                <?= $thongbaoorder; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once "footer.php"; ?>
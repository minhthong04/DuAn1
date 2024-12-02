<?php
$html_orderdetail = '';
$i = 1;
if (isset($orderdetail)) {
    foreach ($orderdetail as $item) {
        extract($item);
        $html_orderdetail .= '<tr>
                                <td>' . $i . '</td>
                                <td>' . $ten_san_pham . '</td>
                                <td>' . $don_gia . '</td>
                                <td>' . $so_luong . '</td>
                                <td>' . $ma_don_hang . '</td>
                            </tr>';

        $i++;
    }
}

?>

<?php include_once "header.php"; ?>

<div class="container-info">
    <div class="info-left">
        <a href="index.php?page=info" class="info-left__link">Hồ sơ</a>
        <a href="index.php?page=order" class="info-left__link">Trạng thái đơn hàng</a>

    </div>
    <div class="info-right">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Đơn giá</th>
                    <th>Số lượng</th>
                    <th>Mã đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                <?= $html_orderdetail; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include_once "footer.php"; ?>
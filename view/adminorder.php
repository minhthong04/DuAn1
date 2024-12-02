<?php include_once "adminheader.php"; ?>
<?php
$html_adminorder = "";
$i = 1;
foreach ($adminorder as $item) {
    extract($item);
    $voucher = ($ma_giam_gia == 0) ? 'không áp dụng' : 'đã áp dụng';

    $user_type = ($ma_nguoi_dung == 1) ? 'admin' : 'user';

    // Kiểm tra trạng thái đơn hàng để quyết định xem có hiển thị nút xóa hay không
    $allow_delete = ($trang_thai_don_hang == 0) ? true : false;

    $html_adminorder .= '<tr>
        <td>' . $i . '</td>
        <td>' . $user_type . '</td>
        <td>' . $ngay_thanh_toan . '</td>
        <td>' . $tong_tien . '</td>
        <td>' . $ten . '</td>
        <td>' . $dia_chi . '</td>
        <td>' . $email . '</td>
        <td>' . $sdt . '</td>
        <td>' . $voucher . '</td>
        <td>
            <form action="index.php?page=orderstatus" method="post">
                <select class="form-select" id="order-status" name="orderstatus">
                    <option value="0" ' . ($trang_thai_don_hang == 0 ? 'selected' : '') . '>Đang xác nhận</option>
                    <option value="1" ' . ($trang_thai_don_hang == 1 ? 'selected' : '') . '>Đang giao</option>
                    <option value="2" ' . ($trang_thai_don_hang == 2 ? 'selected' : '') . '>Đã giao</option>
                </select>
                <input type="hidden" value="' . $id . '" name="id">
                <input type="submit" value="Trạng Thái" name="btn_orderstatus" class="btn btn-warning">
            </form>
        </td>
        <td>
            <a href="index.php?page=adminorderdel&id=' . $id . '" class="btn btn-danger">
                <i class="fa-solid fa-trash"></i>XÓA
            </a>
        </td>';

    // Kiểm tra điều kiện trước khi hiển thị nút xóa
    $i++;
}
?>
<style>
    .table-scrollable {
        max-height: 530px;
        /* Đặt chiều cao tối đa của bảng */
        overflow-x: auto;
        /* Cho phép cuộn ngang khi nội dung bảng vượt ra khỏi khung nhìn */
    }
</style>

<div class="main-content">
    <h3 class="title-page">ĐƠN HÀNG</h3>

    <div class="table-scrollable">
        <table id="example" class="table table-striped table-bordered" style="width: 100%">
            <thead class="table-primary">
                <tr>
                    <th style="white-space: nowrap;">STT</th> <!-- Sử dụng white-space: nowrap để đảm bảo chỉ hiển thị trên một dòng -->
                    <th style="white-space: nowrap;">Vai trò</th>
                    <th style="white-space: nowrap;">Ngày thanh toán </th>
                    <th style="white-space: nowrap;">Tổng tiền</th>
                    <th style="white-space: nowrap;">Tên người mua</th>
                    <th style="white-space: nowrap;">Địa chỉ</th>
                    <th style="white-space: nowrap;">Email</th>
                    <th style="white-space: nowrap;">Số điện Thoại</th>
                    <th style="white-space: nowrap;">Mã Giảm Giá</th>
                    <th style="white-space: nowrap;">Trạng thái đơn hàng</th>

                    <th style="white-space: nowrap;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?= $html_adminorder; ?>
            </tbody>
            <tfoot>
                <tr>
                    <!-- Nếu bạn muốn thêm chân trang bảng, bạn có thể thêm các thẻ tfoot ở đây -->
                </tr>
            </tfoot>
        </table>
    </div>

</div>


</div>
<script src="assets/js/main.js"></script>
<script>
    new DataTable("#example");
</script>
</body>

</html>
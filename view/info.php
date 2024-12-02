<?php
$html_admin = '';
if ($showinfo['vai_tro'] == 1) {
    $html_admin = '<a href="index.php?page=admin" class="info-left__link">Quản lí admin</a>';
} else {
    $html_admin = '';
}
?>

<?php

$showinfo = showinfo($id);
if ($showinfo) {
?>

    <?php include_once "header.php"; ?>

    <div class="container-info">
        <div class="info-left">
            <a href="index.php?page=info" class="info-left__link" style="color: #7971ea;">Hồ sơ</a>
            <a href="index.php?page=order" class="info-left__link">Trạng thái đơn hàng</a>
            <?=$html_admin?>
        </div>
        <div class="info-right">
            <form action="index.php?page=updateinfo" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="avatar">Ảnh:</label>
                    <!-- Không cần làm gì với trường ảnh -->
                    <img src="uploads/<?= $showinfo['anh']; ?>" alt="Avatar" style="max-width: 300px;">
                </div>
                <div class="form-group">
                    <label for="avatar">Ảnh:</label>
                    <input type="file" id="avatar" name="avatar">
                </div>
                <div class="form-group">
                    <label for="username">Tên người dùng:</label>
                    <input type="text" id="username" name="username" value="<?= $showinfo['ten_nguoi_dung'] ?>" <?php if ($showinfo['vai_tro'] == 1) echo 'readonly'; ?>>
                </div>
                <?php
                if (isset($thongbaotennguoidung)) {
                    echo "$thongbaotennguoidung";
                }
                ?>
                <div class="form-group">
                    <label for="account">Tài khoản:</label>
                    <input type="text" id="account" name="account" value="<?= $showinfo['tai_khoan'] ?>" <?php if ($showinfo['vai_tro'] == 1) echo 'readonly'; ?>>
                </div>
                <?php
                if (isset($thongbaotaikhoan)) {
                    echo "$thongbaotaikhoan";
                }
                ?>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="text" id="password" name="password" value="<?= $showinfo['mat_khau'] ?>" <?php if ($showinfo['vai_tro'] == 1) echo 'readonly'; ?>>
                </div>
                <?php
                if (isset($thongbaotaikhoan)) {
                    echo "$thongbaotaikhoan";
                }
                ?>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $showinfo['email'] ?>" <?php if ($showinfo['vai_tro'] == 1) echo 'readonly'; ?>>
                </div>
                <?php
                if (isset($thongbaoemail)) {
                    echo "$thongbaoemail";
                }
                ?>
                <div class="form-group">
                    <label for="address">Địa chỉ:</label>
                    <textarea id="address" name="address" rows="4" <?php if ($showinfo['vai_tro'] == 1) echo 'readonly'; ?>><?= $showinfo['dia_chi'] ?></textarea>
                </div>
                <?php
                if (isset($thongbaodiachi)) {
                    echo "$thongbaodiachi";
                }
                ?>
                <div class="form-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="number" id="phone" name="phone" value="<?= $showinfo['so_dien_thoai'] ?>" <?php if ($showinfo['vai_tro'] == 1) echo 'readonly'; ?>>
                </div>
                <?php
                if (isset($thongbaosodienthoai)) {
                    echo "$thongbaosodienthoai";
                }
                ?>
                <div class="form-group">
                    <label for="role">Vai trò:</label>
                    <input type="text" id="role" name="role" value="<?php
                                                                    if ($showinfo['vai_tro'] == 0) {
                                                                        echo "User";
                                                                    } elseif ($showinfo['vai_tro'] == 1) {
                                                                        echo "Admin";
                                                                    } else {
                                                                        echo "Không xác định!";
                                                                    }
                                                                    ?>" readonly>
                </div>
                <input type="hidden" id="id" name="id" value="<?= $showinfo['id'] ?>">
                <div class="form-group">
                    <input type="submit" value="Updateinfo" name="btn_update">
                </div>
            </form>

        </div>
    </div>


    <?php include_once "footer.php"; ?>

<?php
} else {
    // Trường hợp không có dữ liệu trong biến $showinfo
    echo "Không tìm thấy thông tin người dùng để hiển thị.";
}
?>
<?php include_once "header.php"; ?>

<div class="container-info">
    <div class="info-left">
        <a href="index.php?page=info" class="info-left__link" style="color: #7971ea;">Hồ sơ</a>
        <a href="index.php?page=order" class="info-left__link">Trạng thái đơn hàng</a>
    </div>
    <div class="info-right">
        <form action="index.php?page=updateinfo" method="post" enctype="multipart/form-data">
            <?php
            // Kiểm tra xem session user có tồn tại không
            if (isset($_SESSION['user'])) {
                // Truy cập thông tin của session user
                $user = $_SESSION['user'];

                // Load thông tin vào các trường input của form
            }
            ?>
            <div class="form-group">
                <label for="avatar">Ảnh:</label>
                <input type="file" id="avatar" name="avatar">
            </div>
            <div class="form-group">
                <!-- Hiển thị hình ảnh người dùng -->
                <img src="uploads/<?= $user['anh'] ?>" alt="Avatar" style="max-width: 300px;">
            </div>
            <div class="form-group">
                <label for="username">Tên người dùng:</label>
                <input type="text" id="username" name="username" value="<?= $user['ten_nguoi_dung'] ?>">
            </div>
            <div class="form-group">
                <label for="account">Tài khoản:</label>
                <input type="text" id="account" name="account" value="<?= $user['tai_khoan'] ?>">
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="text" id="password" name="password" value="<?= $user['mat_khau'] ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $user['email'] ?>">
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <textarea id="address" name="address" rows="4"><?= $user['dia_chi'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" value="<?= $user['so_dien_thoai'] ?>">
            </div>
            <div class="form-group">
                <label for="role">Vai trò:</label>
                <input type="text" id="role" name="role" value="<?= $user['vai_tro'] ?>">
            </div>
            <input type="hidden" id="id" name="id" value="<?= $user['id'] ?>">
            <div class="form-group">
                <input type="submit" value="Update info" name="btn_update">
            </div>
        </form>
    </div>
</div>

<?php include_once "footer.php"; ?>
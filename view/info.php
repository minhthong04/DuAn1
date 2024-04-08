<?php 
// Kiểm tra xem session user có tồn tại không
if(isset($showinfo)) {
    // Truy cập thông tin của session user
?>

<?php include_once "header.php";?>

<div class="container-info">
    <div class="info-left">
        <a href="index.php?page=info" class="info-left__link" style="color: #7971ea;">Hồ sơ</a>
        <a href="index.php?page=order" class="info-left__link">Trạng thái đơn hàng</a>
    </div>
    <div class="info-right">
        <form action="index.php?page=updateinfo" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="avatar">Ảnh:</label>
                <!-- Không cần làm gì với trường ảnh -->
                <img src="uploads/<?= $showinfo['anh'];?>" alt="Avatar" style="max-width: 300px;">
            </div>
            <div class="form-group">
                <label for="username">Tên người dùng:</label>
                <input type="text" id="username" name="username" value="<?= $showinfo['ten_nguoi_dung'] ?>"
                    style="cursor: pointer;" readonly>
            </div>
            <div class="form-group">
                <label for="account">Tài khoản:</label>
                <input type="text" id="account" name="account" value="<?= $showinfo['tai_khoan'] ?>"
                    style="cursor: pointer;" readonly>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="text" id="password" name="password" value="<?= $showinfo['mat_khau'] ?>"
                    style="cursor: pointer;" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $showinfo['email'] ?>" style="cursor: pointer;"
                    readonly>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ:</label>
                <textarea id="address" name="address" rows="4" readonly
                    style="cursor: pointer;"><?= $showinfo['dia_chi'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" value="<?= $showinfo['so_dien_thoai'] ?>"
                    style="cursor: pointer;" readonly>
            </div>
            <div class="form-group">
                <label for="role">Vai trò:</label>
                <input type="text" id="role" name="role" value="<?= $showinfo['vai_tro'] ?>" style="cursor: pointer;"
                    readonly>
            </div>
            <input type="hidden" id="id" name="id" value="<?= $showinfo['id'] ?>">
            <div class="form-group">
                <input type="submit" value="Update info" name="btn_update">
            </div>
        </form>
    </div>
</div>


<?php include_once "footer.php";?>

<?php 
} else {
    // Trường hợp không có dữ liệu trong biến $showinfo
    echo "Không tìm thấy thông tin người dùng để hiển thị.";
}
?>
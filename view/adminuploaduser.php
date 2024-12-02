<?php
if (is_array($user) && (count($user) > 0)) {
    $imgpath = PATH_IMG_USER . $user['anh']; // uploads/tenhing.jpg
    if (is_file($imgpath)) {
        $img = '<img src="' . $imgpath . '" width="320px">';
    } else {
        $img = "";
    }
}
// Các phần mã khác ở đây
?>


<?php include_once "adminheader.php"; ?>
<div class="main-content">
    <h3 class="title-page">Sửa người dùng</h3>
    <?php
    // Hiển thị thông báo lỗi nếu có
    if (isset($_GET['error']) && !empty($_GET['error'])) {
        echo "<div class='alert alert-danger'>" . $_GET['error'] . "</div>";
    }
    ?>
    <form class="addPro" action="index.php?page=nguoidungupload&id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <?= $img; ?>
        <div class="form-group">
            <label for="exampleInputFile">Ảnh sản phẩm</label>
            <div class="custom-file">
                <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
            </div>
        </div>
        <div class="form-group">
            <label for="name">Tên TÀI KHOẢN:</label>
            <input type="text" class="form-control" name="accout" id="name" value="<?= ($user['tai_khoan'] != "") ? $user['tai_khoan'] : "" ?>">
        </div>
        <?php
        if (isset($thongbaotentaikhoan)) {
            echo "$thongbaotentaikhoan";
        } else {
            echo "";
        }
        ?>
        <div class="form-group">
            <label for="price">PASS:</label>
            <div class="input-group mb-3">
                <input type="text" name="pass" id="price" class="form-control" value="<?= ($user['mat_khau'] != "") ? $user['mat_khau'] : "" ?>">
            </div>
        </div>
        <?php
        if (isset($thongbaomatkhau)) {
            echo "$thongbaomatkhau";
        } else {
            echo "";
        }
        ?>
        <div class="form-group">
            <label>NAME USER:</label>
            <input type="text" name="nameuser" id="price" class="form-control" value="<?= ($user['ten_nguoi_dung'] != "") ? $user['ten_nguoi_dung'] : "" ?>">
        </div>
        <?php
        if (isset($thongbaonameuser)) {
            echo "$thongbaonameuser";
        } else {
            echo "";
        }
        ?>
        <div class="form-group">
            <label> delivery address:</label>
            <input type="text" name="address" id="price" class="form-control" value="<?= ($user['dia_chi'] != "") ? $user['dia_chi'] : "" ?>">
        </div>
        <input type="hidden" name="id" value="<?= ($user['id'] != "") ? $user['id'] : "" ?>">
        <?php
        if (isset($thongbaodiachi)) {
            echo "$thongbaodiachi";
        } else {
            echo "";
        }
        ?>
        <div class="form-group">
            <button type="submit" name="uploaduser" class="btn btn-primary">HOÀN THÀNH</button>
        </div>
    </form>
</div>

<script>
    new DataTable('#example');
</script>
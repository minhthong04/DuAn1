<?php
if (is_array($sp) && (count($sp) > 0)) {
    $imgpath = PATH_IMG_USER . $sp['hinh_san_pham']; // uploads/tenhing.jpg
    if (is_file($imgpath)) {
        $img = '<img src="' . $imgpath . '" width="320px">';
    } else {
        $img = "";
    }
}
$html_cat_select_all = "";
foreach ($admincatalog as $item) {
    extract($item);
    if ($id == $sp['ma_danh_muc']) {
        $ss = "selected";
    } else {
        $ss = "";
    }
    $link = 'index.php?page=sanpham&iddm' . $id;
    $html_cat_select_all .= '<option value="' . $id . '" ' . $ss . '>' . $ten_danh_muc . '</option>';
}
?>

<?php include_once "adminheader.php"; ?>
<div class="main-content">
    <h3 class="title-page">
        Sửa sản phẩm
    </h3>

    <form class="addPro" action="index.php?page=updateproduct&id=<?= ($sp['id'] != "") ? $sp['id'] : "" ?>" method="POST" enctype="multipart/form-data">
        <?= $img; ?>
        <div class="form-group">
            <label for="exampleInputFile">Ảnh sản phẩm</label>
            <div class="custom-file">
                <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
            </div>
        </div>
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" class="form-control" name="name" id="name" value="<?= ($sp['ten_san_pham'] != "") ? $sp['ten_san_pham'] : "" ?>">
        </div>
        <?php
        if (isset($thongbaotensanpham)) {
            echo "$thongbaotensanpham";
        } else {
            echo "";
        }
        ?>
        <div class="form-group">
            <label for="categories">Danh mục:</label>
            <select class="form-select" name="iddm" aria-label="Default select example">
                <option value="0" selected>Chọn danh mục</option>
                <?= $html_cat_select_all; ?>
            </select>
        </div>
        <?php
        if (isset($thongbaoiddm)) {
            echo "$thongbaoiddm";
        } else {
            echo "";
        }
        ?>
        <div class="form-group">
            <label for="price">Giá gốc:</label>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" name="price" id="price" class="form-control" value=" <?= ($sp['gia_san_pham'] != "") ? $sp['gia_san_pham'] : "" ?>">
            </div>
        </div>
        <?php
        if (isset($thongbaogiasanpham)) {
            echo "$thongbaogiasanpham";
        } else {
            echo "";
        }
        ?>

        <div class="form-group">
            <label>Mô tả ngắn</label>
            <input type="text" name="description" id="price" class="form-control" value=" <?= ($sp['mo_ta_san_pham'] != "") ? $sp['mo_ta_san_pham'] : "" ?>">
        </div>
        <?php
        if (isset($thongbaomota)) {
            echo "$thongbaomota";
        } else {
            echo "";
        }
        ?>
        <input type="hidden" name="id" value="<?= ($sp['id'] != "") ? $sp['id'] : "" ?>">
        <div class="form-group">
            <button type="submit" name="updateproduct" class="btn btn-primary">HOÀN THÀNH</button>
        </div>
    </form>
</div>



<script>
    new DataTable('#example');
</script>
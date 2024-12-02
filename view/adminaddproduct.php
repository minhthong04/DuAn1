<?php

$html_cat_select_all = "";
foreach ($admincatalog as $item) {
    extract($item);
    //    $link = 'index.php?page=sanpham&iddm'.$id;
    $html_cat_select_all .= '<option value="' . $id . '">' . $ten_danh_muc . '</option>';
}
?>

<?php include_once "adminheader.php"; ?>
<div class="main-content">
    <h3 class="title-page">
        Thêm sản phẩm
    </h3>

    <form class="addPro" action="index.php?page=adminaddproduct" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="exampleInputFile">Ảnh sản phẩm</label>
            <div class="custom-file">
                <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
            </div>
        </div>
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sả phẩm">
        </div>
        <?php
        if (isset($thongbaotensanpham)) {
            echo "$thongbaotensanpham";
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
        }
        ?>
        <div class="form-group">
            <label for="price">Giá:</label>
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" name="price" id="price" class="form-control">
            </div>
        </div>
        <?php
        if (isset($thongbaonhapgiasanpham)) {
            echo "$thongbaonhapgiasanpham";
        }
        ?>

        <div class="form-group">
            <label>Mô tả</label>
            <textarea class="form-control" name="description" rows="3" placeholder="Nhập 1 đoạn mô tả ngắn về sản phẩm" style="height: 78px;"></textarea>
        </div>
        <?php
                if (isset($thongbaonhapmotasanpham)) {
                    echo "$thongbaonhapmotasanpham";
                }
                ?>
        <div class="form-group">
            <button type="submit" name="addproduct" class="btn btn-primary">Thêm sản phẩm</button>
        </div>
    </form>
</div>

<script>
    new DataTable('#example');
</script>
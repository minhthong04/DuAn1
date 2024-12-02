<?php
$html_productcategory = "";
foreach ($spdm as $item) {
    extract($item);
    $html_productcategory .= '<div class="item">
                                <div class="block-4 text-center">
                                    <a class="block-2-item" href="index.php?page=productdetail&id=' . $id . '">
                                <figure class="block-4-image">
                                    <img src="uploads/' . $hinh_san_pham . '" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">' . $ten_san_pham . '</a></h3>
                                    <p class="mb-0">' . $luot_xem . ' Lượt xem</p>
                                    <p class="text-primary font-weight-bold">' . number_format($gia_san_pham, 0, ",", ".") . '</p>
                                    <form action="index.php?page=addtocartproductcategory&idcat=' . $ma_danh_muc . '" method="post">
                                        <input type="submit" value="Add to cart" name="add_to_cart" style="outline: none;border: none;background-color: #7971EA;color: #fff;padding: 5px 10px;border-radius: 3px;cursor: pointer;">
                                        <input type="hidden" name="soluong" value="1">
                                        <input type="hidden" name="id" value="' . $id . '">
                                        <input type="hidden" name="ten_san_pham" value="' . $ten_san_pham . '">
                                        <input type="hidden" name="hinh_san_pham" value="' . $hinh_san_pham . '">
                                        <input type="hidden" name="gia_san_pham" value="' . $gia_san_pham . '">
                                </form>
                                </div>
                                <a/>
                                </div>
                            </div>';
}
?>

<?php include_once "header.php"; ?>

<?php
if (is_array($spdm)) {
    extract($spdm);
}
?>
<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Sản phẩm danh mục
                    <?php
                    if ($ma_danh_muc == 1) {
                        echo "Men";
                    } elseif ($ma_danh_muc == 2) {
                        echo "Women";
                    } elseif ($ma_danh_muc == 3) {
                        echo "Boy";
                    } else {
                        echo "Unknown";
                    }
                    ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    <?= $html_productcategory; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once "footer.php"; ?>
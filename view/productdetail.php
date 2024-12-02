<?php include_once "header.php"; ?>

<?php
$html_splienquan = '';
foreach ($splienquan as $item) {
    $html_splienquan .= '<div class="item">
                            <div class="block-4 text-center">
                                <a class="block-2-item" href="index.php?page=productdetail&id=' . $item['id'] . '">
                                    <figure class="block-4-image">
                                        <img src="uploads/' . $item['hinh_san_pham'] . '" alt="Image placeholder" class="img-fluid">
                                    </figure>
                                    <div class="block-4-text p-4">
                                        <h3><a href="#">' . $item['ten_san_pham']  . '</a></h3>
                                        <p class="mb-0">' . $item['luot_xem']  . ' Lượt xem</p>
                                        <p class="text-primary font-weight-bold">' . number_format($item['gia_san_pham'], 0, ",", ".") . '</p>
                                    </div>
                                </a>
                            </div>
                        </div>';
}
if (is_array($detail)) {
    extract($detail);
}
$html_comment = '';
// Kiểm tra xem người dùng đã đăng nhập và đã mua sản phẩm chưa
if (!empty($checkorderdetail) && !empty($checkuserorder)) {
    $html_comment = '
            <div class="comment-form">
                <h3>Add a Comment</h3>
                <form action="index.php?page=productdetail&id=' . $id . '" method="post">
                    <textarea name="comment" rows="4" placeholder="Your Comment"></textarea>
                    <input type="hidden" name="iduser" value="' . $_SESSION['user']['id'] . '">
                    <input type="hidden" name="idproduct" value="' . $id . '">
                    <button type="submit" name="btn_comment">Đăng</button>
                </form>
            </div>';
} else {
    // Nếu đã comment, thông báo cho người dùng
    $html_comment = '';
}


$html_showcomment = '';
foreach ($showcomment as $item) {
    extract($item);
    $html_showcomment .= '<div class="comment">
                                <div class="user-info">
                                    <img src="uploads/' . $anh . '" alt="User Avatar" class="user-avatar">
                                    <div>
                                        <div class="user-name">' . $ten_nguoi_dung . '</div>
                                        <div class="comment-time">' . $ngay_tao . '</div>
                                    </div>
                                </div>
                                <div class="comment-content">' . $noi_dung . '</div>
                            </div>';
}









if (is_array($detail)) {
    extract($detail);
}

?>

<style>
    .container-comment {
        max-width: 1140px;
        margin: 0 auto;
        padding: 40px;
    }

    h2 {
        margin-bottom: 20px;
        text-align: center;
    }

    .comment {
        margin-bottom: 20px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 20px;
    }

    .user-info {
        display: flex;
        align-items: center;
    }

    .user-avatar {
        object-fit: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .user-name {
        font-weight: bold;
    }

    .comment-time {
        margin-left: auto;
        color: #666;
    }

    .comment-content {
        margin-top: 10px;
    }

    .comment-form {
        margin-top: 30px;
    }

    .comment-form textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .comment-form button {
        padding: 10px 20px;
        background-color: #7971ea;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Responsive Styles */
    @media (max-width: 1199.98px) {
        .container-comment {
            padding: 20px;
        }
    }

    @media (max-width: 991.98px) {
        .container-comment {
            padding: 10px;
        }
    }
</style>

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Trang chủ</a> <span class="mx-2 mb-0">/</span> <a href="index.php">Sản phẩm</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?= $ten_san_pham ?></strong></div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="uploads/<?= $hinh_san_pham ?>" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h2 class="text-black"><?= $ten_san_pham ?></h2>
                <p><?= $mo_ta_san_pham ?></p>
                <p><strong class="text-primary h4"><?= number_format($gia_san_pham, 0, ",", ".") ?><sup>đ</sup></strong></p>
                <form action="index.php?page=addtocartproductdetail&id=<?= $id ?>" method="post">
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" name="soluong" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Add to cart" name="add_to_cart" class="buy-now btn btn-sm btn-primary">
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="ten_san_pham" value="<?= $ten_san_pham ?>">
                    <input type="hidden" name="hinh_san_pham" value="<?= $hinh_san_pham ?>">
                    <input type="hidden" name="gia_san_pham" value="<?= $gia_san_pham ?>">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Sản phẩm liên quan</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    <?= $html_splienquan; ?>

                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="container-comment">
    <h2>Bình luận</h2>

    <?= $html_showcomment; ?>

    <!-- Add more comments as needed -->
    <?= $html_comment; ?>

    <?php if (isset($thongbaobinhluan)) : ?>
        <?= $thongbaobinhluan; ?>
    <?php endif; ?>
</div>


<?php include_once "footer.php"; ?>
<?php
function product_view($limit)
{
    $sql = "SELECT * FROM sanpham ORDER BY luot_xem DESC LIMIT " . $limit;
    return get_all($sql);
}

function product_all_limit($limit, $trang, $idcat, $orderby, $kyw)
{
    $sql = "SELECT * FROM sanpham WHERE 1";

    // Thêm điều kiện lọc theo mã danh mục (nếu có)
    if ($idcat > 0) {
        $sql .= " AND ma_danh_muc = " . $idcat;
    }
    if ($kyw != "") {
        $sql .= " AND ten_san_pham like '%" . $kyw . "%'";
    }

    // Thêm điều kiện lọc theo các tiêu chí khác (nếu có)
    switch ($orderby) {
        case "ASCPRICE":
            $sql .= " ORDER BY gia_san_pham ASC";
            break;
        case "DESCPRICE":
            $sql .= " ORDER BY gia_san_pham DESC";
            break;
        default:
            // Mặc định sử dụng sắp xếp theo id giảm dần
            $sql .= " ORDER BY id DESC";
            break;
    }

    // Thêm điều kiện limit (nếu có)
    if ($limit > 0 && $trang > 0) {
        $begin = ($trang - 1) * $limit;
        $sql .= " LIMIT " . $begin . ", " . $limit;
    } elseif ($limit > 0) {
        $sql .= " LIMIT " . $limit;
    }

    return get_all($sql);
}


function product_men($id)
{
    $sql = "SELECT * FROM sanpham WHERE ma_danh_muc = " . $id;
    return get_all($sql);
}

function product_category($id)
{
    $sql = "SELECT * FROM sanpham WHERE ma_danh_muc = $id";
    return get_all($sql);
}


function splienquan($id, $iddmsp)
{
    $sql = "SELECT * FROM sanpham WHERE ma_danh_muc = $iddmsp AND id != $id";
    return get_all($sql);
}


// Chọn 1 sản phẩm theo ID
function product_select_one($id)
{
    $sql_select = "SELECT * FROM sanpham WHERE id = " . $id;
    $product = get_one($sql_select);
    if ($product) {
        // Tăng số lượt xem của sản phẩm
        $updated_view = $product['luot_xem'] + 1;
        $sql_update_view = "UPDATE sanpham SET luot_xem = $updated_view WHERE id = $id";
        get_execute($sql_update_view);
    }

    return $product;
}

function addcomment($iduser, $idproduct, $comment)
{
    $sql = "INSERT INTO binhluan(ma_nguoi_dung, ma_san_pham, noi_dung) 
    VALUES ('$iduser', '$idproduct','$comment')";
    return get_execute($sql);
}

// Show binh luan trang chi tiet
function showcomment($id)
{
    $sql = "SELECT binhluan.*, nguoidung.ten_nguoi_dung , nguoidung.anh
            FROM binhluan 
            INNER JOIN nguoidung ON binhluan.ma_nguoi_dung = nguoidung.id 
            WHERE binhluan.ma_san_pham = " . $id;
    return get_all($sql);
}
function checkorderdetail($id)
{
    $sql = "select * from chitietdonhang where ma_san_pham=" . $id;
    return get_one($sql);
}

function checkuserorder($id)
{
    $sql = "select * from donhang where ma_nguoi_dung=" . $id;
    return get_one($sql);
}


function check_couppon($coupon_code)
{
    $sql = "select * from magiamgia where code=" . $coupon_code;
    return get_all($sql);
}

function check_voucher($voucher)
{
    $sql = "SELECT * FROM magiamgia WHERE code = '$voucher'";
    $valid_voucher = get_all($sql);

    if ($valid_voucher) {
        // Kiểm tra nếu số lượng voucher còn lớn hơn 0
        if ($valid_voucher[0]['so_luong'] > 0) {
            // Giảm số lượng voucher đi 1 trong cơ sở dữ liệu
            $updated_quantity = $valid_voucher[0]['so_luong'] - 1;
            // Cập nhật số lượng voucher mới vào cơ sở dữ liệu
            $sql_update = "UPDATE magiamgia SET so_luong = $updated_quantity WHERE code = '$voucher'";
            get_execute($sql_update);
        } else {
            // Nếu số lượng voucher đã hết, trả về null
            $valid_voucher = null;
        }
    }

    return $valid_voucher;
}


// Chọn 1 sản phẩm theo ID
function orderproduct($id)
{
    $sql = "select * from sanpham where id=" . $id;
    return get_all($sql);
}


function back_voucher($voucher)
{
    $sql = "SELECT * FROM magiamgia WHERE code = '$voucher'";
    $valid_voucher = get_all($sql);

    if ($valid_voucher) {
        // Kiểm tra nếu số lượng voucher còn lớn hơn 0
        if ($valid_voucher[0]['so_luong'] > 0) {
            // Giảm số lượng voucher đi 1 trong cơ sở dữ liệu
            $updated_quantity = $valid_voucher[0]['so_luong'] + 1;
            // Cập nhật số lượng voucher mới vào cơ sở dữ liệu
            $sql_update = "UPDATE magiamgia SET so_luong = $updated_quantity WHERE code = '$voucher'";
            get_execute($sql_update);
        } else {
            // Nếu số lượng voucher đã hết, trả về null
            $valid_voucher = null;
        }
    }

    return $valid_voucher;
}


function phantrang($datapro, $trang, $idcat, $orderby, $kyw)
{
    if ($idcat == 0) {
        $sotrang = ceil(count($datapro) / SOLUONG_SP);
    } elseif ($idcat == 1) {
        $sotrang = ceil(count(product_men(1)) / SOLUONG_SP);
    } elseif ($idcat == 2) {
        $sotrang = ceil(count(product_men(2)) / SOLUONG_SP);
    } elseif ($idcat == 3) {
        $sotrang = ceil(count(product_men(3)) / SOLUONG_SP);
    }
    $kq = "";
    if ($sotrang > 1 && $kyw === "") {
        if ($trang > 1) {
            $kq .= '<li><a href="index.php?page=product&trang=' . ($trang - 1) . '&idcat=' . $idcat . '&orderby=' . $orderby . '">&lt;</a></li>';
        }
        for ($i = 0; $i < $sotrang; $i++) {
            $link = 'index.php?page=product&trang=' . ($i + 1) . '&idcat=' . $idcat . '&orderby=' . $orderby . '&kyw=' . $kyw;
            if ($trang == ($i + 1)) {
                $acti = 'class="active"';
            } else {
                $acti = '';
            }
            $kq .= '<li ' . $acti . '><a href="' . $link . '">' . ($i + 1) . '</a></li>';
        }
        if ($trang < $sotrang) {
            $kq .= '<li><a href="index.php?page=product&trang=' . ($trang + 1) . '&idcat=' . $idcat . '&orderby=' . $orderby . '">&gt;</a></li>';
        }
        return $kq;
    } else {
        return "";
    }
}



// ADMIN

// admin function
function adminsanphamlist()
{
    $sql = "SELECT * FROM sanpham";
    return get_all($sql);
}
function sanpham_insert($name, $price, $iddm, $img, $description)
{
    $sql = "INSERT INTO sanpham(ten_san_pham, gia_san_pham, ma_danh_muc, hinh_san_pham, mo_ta_san_pham) 
    VALUES ('$name', '$price','$iddm','$img','$description')";
    return get_execute($sql);
}
/// admin xoa san pham 
function sanpham_delete($id)
{
    $sql = "DELETE FROM sanpham WHERE id=" . $id;
    return get_execute($sql);
}
// admin xoa file hinh anh san pham 
function get_img($id)
{
    $sql = "SELECT hinh_san_pham from sanpham WHERE id=" . $id;
    return get_one($sql);
}
//updata san pham 
function sanpham_update($name, $price, $idcatalog, $img, $description, $id)
{
    if ($img != "") {
        $sql = "UPDATE sanpham SET ten_san_pham='$name',gia_san_pham='$price',ma_danh_muc=' $idcatalog',hinh_san_pham='$img',mo_ta_san_pham='$description' WHERE id=$id";
        return get_execute($sql);
    } else {
        $sql = "UPDATE sanpham SET ten_san_pham='$name',gia_san_pham='$price',ma_danh_muc=' $idcatalog',mo_ta_san_pham='$description' WHERE id=$id";
        return get_execute($sql);
    }
}

function tongsanphamadmin()
{
    $sql = "SELECT * from sanpham";
    return get_all($sql);
}
/// trang home  tong  don hang san pham thanh vien 
function tongdonhangadmin()
{
    $sql = "SELECT * from donhang";
    return get_all($sql);
}
function tongdanhmucadmin()
{
    $sql = "SELECT * from danhmuc";
    return get_all($sql);
}



function tongthanhvienadmin()
{
    $sql = "SELECT * from nguoidung";
    return get_all($sql);
}

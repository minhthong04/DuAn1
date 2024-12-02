<?php
function category_all()
{
    $sql = "SELECT * FROM danhmuc";
    return get_all($sql);
}


// ADMIN 

function admincatalog()
{
    $sql = "SELECT * FROM danhmuc";

    return get_all($sql);
}
function category_insert($ten_danh_muc, $img)
{
    $ngay_update = date('Y-m-d H:i:s'); // Lấy ngày và giờ hiện tại
    $sql = "INSERT INTO danhmuc(ten_danh_muc,anh_danh_muc,ngay_update) 
    VALUES ('$ten_danh_muc', '$img','$ngay_update')";
    return get_execute($sql);
}
function danhmuc_delete($id)
{
    $sql = "DELETE FROM danhmuc WHERE id=" . $id;
    return get_execute($sql);
}
// admin xoa file hinh anh san pham 
function get_anh_danhmuc($id)
{
    $sql = "SELECT anh_danh_muc from danhmuc WHERE id=" . $id;
    return get_one($sql);
}
/// upload danh muc 
function danhmuc_select_one($id)
{
    $sql = "select * from danhmuc where id=" . $id;
    return get_one($sql);
}
function danhmuc_update($category, $img, $id)
{
    if ($img != "") {
        $sql = "UPDATE danhmuc SET ten_danh_muc='$category',anh_danh_muc='$img' WHERE id=$id";
        return get_execute($sql);
    } else {
        $sql = "UPDATE danhmuc SET  ten_danh_muc='$category' WHERE id=$id";
        return get_execute($sql);
    }
}

function get_danhmuc_by_image($img_path, $id)
{
    $sql = "SELECT * FROM danhmuc WHERE id != $id AND anh_danh_muc = '$img_path'";
    return get_all($sql);
}

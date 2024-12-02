<?php
function check_login($username, $pass)
{
    $sql = "SELECT * FROM nguoidung WHERE tai_khoan = '$username' AND mat_khau = '$pass' ";
    return get_one($sql);
}

function check_signup($tennguoidung, $taikhoan, $matkhau)
{
    // Kiểm tra xem tên người dùng hoặc tên tài khoản đã tồn tại trong cơ sở dữ liệu
    $sql = "SELECT * FROM nguoidung WHERE tai_khoan = '$taikhoan'"; 
    $result = get_all($sql);

    // Nếu có bản ghi trùng, trả về false
    if ($result) {
        return false;
    } else {
        // Nếu không có bản ghi trùng, thêm người dùng vào cơ sở dữ liệu và trả về true
        $sql = "INSERT INTO nguoidung (ten_nguoi_dung, tai_khoan, mat_khau) 
                    VALUES ('$tennguoidung', '$taikhoan', '$matkhau')";
        return get_execute($sql);
    }
}

function order()
{
    $sql = "SELECT * FROM donhang ORDER BY ngay_thanh_toan DESC";
    return get_all($sql);
}



function orderdel($id)
{
    $order_status_query = "SELECT trang_thai_don_hang FROM donhang WHERE id = $id";
    $order_status_result = get_one($order_status_query);

    if ($order_status_result && count($order_status_result) > 0) {
        $order_status = $order_status_result[0]['trang_thai_don_hang'];

        if ($order_status == 0) {
            $sql_detail = "DELETE FROM chitietdonhang WHERE ma_don_hang=" . $id;
            $result_detail = get_execute($sql_detail);

            $sql_order = "DELETE FROM donhang WHERE id=" . $id;
            $result_order = get_execute($sql_order);

            return $result_detail && $result_order;
        } else {
            // Nếu đơn hàng không ở trạng thái "Đang xác nhận", không thực hiện xóa
            return false;
        }
    } else {
        // Không tìm thấy thông tin trạng thái đơn hàng, không thực hiện xóa
        return false;
    }
}

function orderdetail($id)
{
    $sql = "SELECT cd.*, sp.ten_san_pham 
                FROM chitietdonhang cd
                INNER JOIN sanpham sp ON cd.ma_san_pham = sp.id
                WHERE cd.ma_don_hang = $id
                ORDER BY cd.id DESC";
    return get_all($sql);
}

function updateinfo($avatar, $username, $account, $password, $email, $address, $phone, $id)
{
    if ($avatar != "") {
        $sql_update = "UPDATE nguoidung SET 
                            anh = '$avatar', 
                            ten_nguoi_dung = '$username', 
                            tai_khoan = '$account', 
                            mat_khau = '$password', 
                            email = '$email', 
                            dia_chi = '$address', 
                            so_dien_thoai = '$phone' 
                            WHERE id = $id";
    } else {
        // Chuẩn bị truy vấn SQL khi không có avatar
        $sql_update = "UPDATE nguoidung SET 
                            ten_nguoi_dung = '$username', 
                            tai_khoan = '$account', 
                            mat_khau = '$password', 
                            email = '$email', 
                            dia_chi = '$address', 
                            so_dien_thoai = '$phone' 
                            WHERE id = $id";
    }

    // Thực thi truy vấn SQL
    return get_execute($sql_update);
}


function showinfo($id)
{
    $sql = "SELECT * FROM nguoidung WHERE id=" . $id;
    return get_one($sql);
}

function infousercheckout($iduser){
    $sql = "SELECT * FROM nguoidung WHERE id=" . $iduser;
    return get_one($sql);
}

// ADMIN



function adminuserlist()
{
    $sql = "SELECT * FROM nguoidung";
    return get_all($sql);
}

function adminuserhome()
{
    $sql = "SELECT * FROM nguoidung ORDER BY ngay_tao DESC ";
    return get_all($sql);
}
function user_insert($accout, $pass, $nameuser, $img, $phone, $email, $address)
{
    $ngay_update = date('Y-m-d H:i:s'); // Lấy ngày và giờ hiện tại
    $sql = "INSERT INTO nguoidung(tai_khoan,mat_khau,ten_nguoi_dung,anh,so_dien_thoai,email,dia_chi,ngay_update) 
        VALUES ('$accout', '$pass', '$nameuser','$img','$phone','$email','$address','$ngay_update')";
    return get_execute($sql);
}
/// admin xoa user
function user_delete($id)
{
    $sql = "DELETE FROM nguoidung WHERE id=" . $id;
    return get_execute($sql);
}
// admin xoa file hinh anh user
function get_anh_user($id)
{
    $sql = "SELECT anh from nguoidung WHERE id=" . $id;
    return get_one($sql);
}
/// upload user
function user_select_one($id)
{
    $sql = "select * from nguoidung where id=" . $id;
    return get_one($sql);
}
function user_update($account, $pass, $address, $img, $nameuser, $id)
{
    if ($img != "") {
        $sql = "UPDATE nguoidung SET tai_khoan='$account', mat_khau='$pass', dia_chi='$address', anh='$img', ten_nguoi_dung='$nameuser' WHERE id=$id";
        return get_execute($sql);
    } else {
        $sql = "UPDATE nguoidung SET tai_khoan='$account', mat_khau='$pass', dia_chi='$address', ten_nguoi_dung='$nameuser'WHERE id=$id";
        return get_execute($sql);
    }
}


function adminorderdel($id)
{
    $order_status_query = "SELECT trang_thai_don_hang FROM donhang WHERE id = $id";
    $order_status_result = get_all($order_status_query);

    if ($order_status_result && count($order_status_result) > 0) {
        $order_status = $order_status_result[0]['trang_thai_don_hang'];
        echo "$id";

        if ($order_status == 0) {
            $sql_detail = "DELETE FROM chitietdonhang WHERE ma_don_hang=" . $id;
            $result_detail = get_execute($sql_detail);

            $sql_order = "DELETE FROM donhang WHERE id=" . $id;
            $result_order = get_execute($sql_order);

            return $result_detail && $result_order;
        } else {
            // Nếu đơn hàng không ở trạng thái "Đang xác nhận", không thực hiện xóa
            return false;
        }
    } else {
        // Không tìm thấy thông tin trạng thái đơn hàng, không thực hiện xóa
        return false;
    }
}

//admin binh luan 
function adminbinhluanlist(){
    $sql = "SELECT * FROM binhluan order by id desc";
    return get_all($sql);

}
// xoa binh luan 
function binhluan_delete($id){
    $sql = "DELETE FROM binhluan WHERE id=".$id;
    return get_execute($sql);
}
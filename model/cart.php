<?php

function tongdonhang() {
    $tongdonhang = 0;
    if(isset($_SESSION['user']["giohang"])) {
        foreach ($_SESSION['user']["giohang"] as $item) {
                $soluong = intval($item['soluong']);
                $gia_san_pham = intval($item['gia_san_pham']);
                $tongdonhang += $soluong * $gia_san_pham;
        }
    }
    return $tongdonhang;
}


function insert_donhang($idnguoidung, $tongtien, $firstname, $deliveryaddress, $email, $phone, $voucher, $payment_method){
    $sql = "INSERT INTO donhang(ma_nguoi_dung, tong_tien, ten, dia_chi, email, sdt, ma_giam_gia, phuong_thuc_thanh_toan) 
            VALUES ('$idnguoidung', '$tongtien', '$firstname', '$deliveryaddress', '$email', '$phone', '$voucher', '$payment_method')";
    return get_execute($sql);
}

function insert_chitietdonhang($ma_san_pham, $tong_gia, $so_luong, $id_donhang){
    $sql = "INSERT INTO chitietdonhang(ma_san_pham, don_gia, so_luong, ma_don_hang) 
            VALUES ('$ma_san_pham', '$tong_gia', '$so_luong', '$id_donhang')";
    return get_execute($sql);
}

function get_order_information($id){
    $sql = "SELECT * FROM donhang WHERE ma_nguoi_dung = '$id' ORDER BY id DESC" ;
    return get_one($sql); 
}

function iddonhang($id){
    $sql = "SELECT id FROM donhang WHERE ma_nguoi_dung = '$id' ORDER BY id DESC" ;
    return get_one($sql); 
}

function phantramgiam($code){
    $sql = "SELECT phan_tram_giam FROM magiamgia WHERE code='".$code."'";
    return get_one($sql); 
}
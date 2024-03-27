<?php
function product_view($limit){
    $sql="SELECT * FROM sanpham ORDER BY luot_xem DESC LIMIT ".$limit;
    return get_all($sql);  
} 

function product_all_limit($limit, $trang, $idcat, $orderby) {
    $sql = "SELECT * FROM sanpham WHERE 1";

    // Thêm điều kiện lọc theo mã danh mục (nếu có)
    if ($idcat > 0) {
        $sql .= " AND ma_danh_muc = " . $idcat;
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


function product_men($id){
    $sql="SELECT * FROM sanpham WHERE ma_danh_muc = ".$id;
    return get_all($sql);  
} 

function product_category($id){
    $sql="SELECT * FROM sanpham WHERE ma_danh_muc = $id";
    return get_all($sql);  
} 

function product_select_one($id){
    $sql="select * from sanpham where id=".$id;
    return get_one($sql);  
}

function check_couppon($coupon_code){
    $sql="select * from magiamgia where code=".$coupon_code;
    return get_all($sql);  
}

function check_voucher($voucher){
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
    


function phantrang($datapro,$trang,$idcat,$orderby){
    if($idcat==0){
        $sotrang=ceil(count($datapro)/SOLUONG_SP);
    }elseif($idcat==1){
        $sotrang=ceil(count(product_men(1))/SOLUONG_SP);
    }elseif($idcat==2){
        $sotrang=ceil(count(product_men(2))/SOLUONG_SP);
    }elseif($idcat==3){
        $sotrang=ceil(count(product_men(3))/SOLUONG_SP);
    }
    $kq="";
    if($sotrang>1){
        if ($trang > 1) {
            $kq.='<li><a href="index.php?page=product&trang='.($trang-1).'&idcat='.$idcat.'&orderby='.$orderby.'">&lt;</a></li>';
        }    
        for($i=0;$i<$sotrang;$i++){
            $link='index.php?page=product&trang='.($i+1).'&idcat='.$idcat.'&orderby='.$orderby;
            if($trang==($i+1)){
                $acti='class="active"';
            }else{
                $acti='';
            }
            $kq.='<li '.$acti.'><a href="'.$link.'">'.($i+1).'</a></li>';
        }
        if ($trang < $sotrang) {
            $kq.='<li><a href="index.php?page=product&trang='.($trang-1).'&idcat='.$idcat.'">&gt;</a></li>';



        }            
        return $kq;
    }else{
        return "";
    }
}

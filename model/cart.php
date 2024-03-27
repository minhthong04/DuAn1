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

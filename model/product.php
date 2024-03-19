<?php
function product_view($limit){
    $sql="SELECT * FROM sanpham ORDER BY luot_xem DESC LIMIT ".$limit;
    return get_all($sql);  
} 

function product_all_limit($limit,$trang){
    $sql="select * from sanpham where 1";
    if($trang>0){
       $begin=($trang-1)*$limit;
       $sql.=" order by id desc limit ".$begin.",".$limit;
    }
    return get_all($sql);   
} 


function product_category($id){
    $sql="SELECT * FROM sanpham WHERE ma_danh_muc = $id";
    return get_all($sql);  
} 



function phantrang($datapro,$trang){
    $sotrang=ceil(count($datapro)/SOLUONG_SP);
    $kq="";
    if($sotrang>1){
        if ($trang > 1) {
            $kq.='<li><a href="index.php?page=product&trang='.($trang-1).'">&lt;</a></li>';
            }
        for($i=0;$i<$sotrang;$i++){
            $link="index.php?page=product&trang=".($i+1);
            if($trang==($i+1)){
                $acti='class="active"';
            }else{
                $acti='';
            }
            $kq.='<li '.$acti.'><a href="'.$link.'">'.($i+1).'</a></li>';
        }
        if ($trang < $sotrang) {
            $kq.='<li><a href="index.php?page=product&trang='.($trang+1).'">&gt;</a></li>';
        }            
        return $kq;
    }else{
        return "";
    }
}
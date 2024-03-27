<?php
    function check_login($username,$pass){
        $sql="SELECT * FROM nguoidung WHERE tai_khoan = '$username' AND mat_khau = '$pass' ";
        return get_one($sql);  
    }

    // function user_register($fullname,$email,$pass,$image){
    //     $conn=connect();
    //     $sql="INSERT INTO nguoidung(HoTen,Email,MatKhau,HinhAnh) 
    //     VALUES('$fullname','$email','$pass','$image')";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();
    // }
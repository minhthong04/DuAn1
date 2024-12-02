<?php
// Kiểm tra nếu biến $tongdonhang tồn tại
if(isset($tongdonhang)){
    // Sử dụng hàm count() để đếm số phần tử trong mảng $tongdonhang
    $demtongdonhang = count($tongdonhang);
}
if(isset($tongsanpham)){
    // Sử dụng hàm count() để đếm số phần tử trong mảng $tongdonhang
    $demtongsanpham = count($tongsanpham);
}
if(isset($tongthanhvien)){
    // Sử dụng hàm count() để đếm số phần tử trong mảng $tongdonhang
    $demtongthanhvien = count($tongthanhvien);
}

if(isset($tongdanhmuc)){
    // Sử dụng hàm count() để đếm số phần tử trong mảng $tongdonhang
    $demtongdanhmuc = count($tongdanhmuc);
}




?>
<?php
$html_adminuserhome = "";
$i = 1;
$userCount = 0; // Đếm số lượng người dùng đã được thêm vào danh sách

foreach ($adminuserhome as $item) {
    extract($item);

    if ($vai_tro == 0 && $userCount < 3) { // Kiểm tra vai trò và số lượng người dùng
        $html_adminuserhome .= '<tr>
            <td>' . $i . '</td>
            <td>' . $tai_khoan . '</td>
            <td>' . ($vai_tro == 0 ? 'user' : 'admin') . '</td>
            <td>'.$ngay_tao.'</td>
        </tr>';
        $i++;
        $userCount++;
    }
}

?>
<?php
$html_adminorder="";
$i=1;
$total_amount=0;

 foreach($adminorder as $item) {
  extract($item);
  if ($trang_thai_don_hang == 2) { // Chỉ tính doanh thu từ các đơn hàng đã giao
    $total_amount += $tong_tien;
}

  if ($trang_thai_don_hang == 0) {
    $trangthai = 'Đang xác nhận';
} elseif ($trang_thai_don_hang == 1) {
    $trangthai = 'Đang giao';
} elseif ($trang_thai_don_hang == 2) {
    $trangthai = 'Đã giao';
} else {
    $trangthai = 'Không xác định';
}

  $html_adminorder.='  <tr>
  
  <td>'.$i.'</td>
  <td>'.$tong_tien.'</td>
  <td>'.$trangthai.'</td>
  
  ';
  $i++;
}


?>

<?php include_once "adminheader.php";?>

            <div class="main-content">
                <h3 class="title-page">
                    Dashboards
                </h3>
                <section class="statistics row">
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="products.html">
                            <div class="card mb-3 widget-chart">
                                <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                                    <h5>
                                        Tổng đơn hàng
                                    </h5>
                                </div>
                                <span class="widget-numbers"><?=$demtongdonhang?></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="user.html">
                            <div class="card mb-3 widget-chart">

                                <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                                    <h5>
                                        Tổng danh mục
                                    </h5>
                                </div>
                                <span class="widget-numbers"><?=$demtongdanhmuc?></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="caterogies.html">
                            <div class="card mb-3 widget-chart">
                                <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                                    <h5>
                                        Tổng thành viên
                                    </h5>
                                </div>
                                <span class="widget-numbers"><?=$demtongthanhvien?></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-6 col-xl-3">
                        <a href="#">
                            <div class="card mb-3 widget-chart">
                                <div class="widget-subheading fsize-1 pt-2 opacity-10 text-warning font-weight-bold">
                                    <h5>
                                        Tổng Sản Phẩm
                                    </h5>
                                </div>
                                <span class="widget-numbers"><?=$demtongsanpham?></span>
                            </div>
                        </a>
                    </div>
                </section>
                
                <section class=" row gx-5">
                    <div class="col">
                        <div class="card chart">
                            <!-- <form action="#" method="post">
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" placeholder="Username"
                                        aria-label="Username">
                                    <span class="input-group-text">Đến ngày</span>
                                    <input type="date" class="form-control" placeholder="Server" aria-label="Server">
                                    <button type="button" class="btn btn-primary">Xem</button>
                                </div>
                            </form> -->
                            <p>Tổng doanh thu: <span><?=$total_amount?></span></p>

                            <table class="revenue table table-hover">
                                <thead>
                                    
                                    <th>Mã đơn hàng</th>
                                    <th>Doanh thu</th>
                                    <th>Trạng thái </th>
                                </thead>
                                <tbody>
                                <?=$html_adminorder;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                
                    
                    <div class="col">
                        <div class="card chart">
                            <h4>Khách hàng mới</h4>
                            <table class="revenue table table-hover">
                                <thead>
                                    <th>1</th>
                                    <th>Username</th>
                                    <th>Vai Trò</th>
                                    <th>ngày Tạo</th>
                                </thead>
                                <tbody>
                                <?=$html_adminuserhome;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script>
        new DataTable('#example');
    </script>
</body>

</html>
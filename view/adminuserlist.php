
<?php include_once "adminheader.php";?>
<?php 
$html_adminuserlist = "";
$i=1;
foreach ($adminuserlist as $item) {
    extract($item);

    $role = ($vai_tro == 0) ? 'user' : 'admin'; // Kiểm tra vai trò

    $html_adminuserlist .= '<tr>
        <td>' . $i. '</td>
        <td>' . $tai_khoan . '</td>
        <td>' . $mat_khau . '</td>
        <td><img src="uploads/'.$anh.'" width="100"  /></td>
        <td>' . $role . '</td> <!-- Hiển thị vai trò -->
        <td>' . $ngay_tao . '</td>
        <td>' . $ten_nguoi_dung . '</td>
        <td>' . $dia_chi. '</td>
        <td>' . $ngay_update . '</td>

        <td>
            <a href="index.php?page=nguoidungupload&id='.$id.'" class="btn btn-warning">
                <i class="fa-solid fa-pen-to-square"></i> fix
            </a>
            <a href="index.php?page=deluser&id='.$id.'" class="btn btn-danger">
                <i class="fa-solid fa-trash"></i> remove
            </a>
        </td>
    </tr>';
    $i++;
}
?>



<div class="main-content">
          <h3 class="title-page">Thành Viên</h3>
          <div class="d-flex justify-content-end">
            <a href="index.php?page=nguoidungadd" class="btn btn-primary mb-2"
              >Thêm thành viên</a
            >
          </div>
          <table id="example" class="table table-striped table-bordered" style="width: 100%">
            <thead class="table-primary" >
              <tr>
                <th style="white-space: nowrap;">STT</th>
                <th style="white-space: nowrap;">Tài khoản</th>
                <th style="white-space: nowrap;">Mật khẩu</th> 
                <th style="white-space: nowrap;">Hình ảnh</th>
                <th style="white-space: nowrap;">vai trò</th>
                <th style="white-space: nowrap;">Ngày tạo</th>
                <th style="white-space: nowrap;">Tên người dùng</th>
                <th style="white-space: nowrap;">Địa chỉ</th>
                <th style="white-space: nowrap;">Ngày cập nhập</th>
                <th style="white-space: nowrap;">Sửa/xóa</th>
              </tr>
            </thead>
            <tbody>
            
            <?=$html_adminuserlist;?>
            </tbody>
            <tfoot>
             
              <tr>
             
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
    <script src="assets/js/main.js"></script>
    <script>
      new DataTable("#example");
    </script>
  </body>
</html>

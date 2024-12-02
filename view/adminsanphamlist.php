<?php include_once "adminheader.php";?>
<?php 
$html_adminsanphamlist="";
$i=1;
 foreach($adminsanphamlist as $item) {
  extract($item);

  if ($ma_danh_muc == 1) {
      $category_name = "Nam";
  } elseif ($ma_danh_muc == 2) {
      $category_name = "Nữ";
  } elseif ($ma_danh_muc == 3) {
      $category_name = "Trẻ em";
  }
  $html_adminsanphamlist.='  <tr>
  <td>'.$i.'</td>
  <td>'. $category_name.'</td>
  <td><img src=" uploads/'.$hinh_san_pham.'" width="100"  /></td>
  <td>'.$ten_san_pham.'</td>
  <td>'.$luot_xem.'</td>
  <td>
    <a href="index.php?page=updateproduct&id='.$id.'" class="btn btn-warning"
      ><i class="fa-solid fa-pen-to-square"></i> SỬA</a
    >
    <a href="index.php?page=delproduct&id='.$id.'" class="btn btn-danger"
      ><i class="fa-solid fa-trash"></i>XÓA</a
    >
  </td>
</tr>
      ';
      $i++;
 
}

?>
<div class="main-content">
    <h3 class="title-page">Sản phẩm</h3>
    <div class="d-flex justify-content-end">
        <a href="index.php?page=sanphamadd" class="btn btn-primary mb-2">Thêm sản phẩm</a>
    </div>
    <table id="example" class="table table-striped table-bordered" style="width: 100%">
        <thead class="table-primary" >
            <tr>
                <th  style="white-space: nowrap;">STT</th>
                <th  style="white-space: nowrap;">Danh mục</th>
                <th  style="white-space: nowrap;">Hình ảnh</th>
                <th  style="white-space: nowrap;">Tên sản phẩm </th>
                <th  style="white-space: nowrap;">View</th>
                <th  style="white-space: nowrap;">Xóa/Sửa</th>
            </tr>
        </thead>
        <tbody>

            <?=$html_adminsanphamlist;?>
        </tbody>
        <tfoot>

            
              
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
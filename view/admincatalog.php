
<?php include_once "adminheader.php";?>
<?php 
$html_admincatalog="";
$i=1;
 foreach($admincatalog as $item) {
  extract($item);
  
  
  $html_admincatalog.='  <tr>
  <td>'.$i.'</td>
  <td>'.$ten_danh_muc.'</td>
  <td><img src="uploads/'.$anh_danh_muc.'" width="100"  /></td>
  <td>'.$ngay_tao_danh_muc.'</td>
  <td>'.$ngay_update.'</td>
  

  <td>
    <a href="index.php?page=fixdanhmuc&id='.$id.'" class="btn btn-warning"
      ><i class="fa-solid fa-pen-to-square"></i> SỬA</a
    >
    <a href="index.php?page=deldanhmuc&id='.$id.'" class="btn btn-danger"
      ><i class="fa-solid fa-trash"></i>XÓA</a
    >
  </td>
</tr>
      ';
      $i++;
 }

?>


<div class="main-content">
          <h3 class="title-page">Danh Mục</h3>
          <div class="d-flex justify-content-end">
            <a href="index.php?page=danhmucadd" class="btn btn-primary mb-2"
              >Thêm Danh Mục</a
            >
          </div>
          <table id="example" class="table table-striped table-bordered" style="width: 100%">
            <thead class="table-primary" >
              <tr>
                <th style="white-space: nowrap;">STT</th>
                <th style="white-space: nowrap;">Danh mục</th>
                <th style="white-space: nowrap;">Hình ảnh</th>
                <th style="white-space: nowrap;">Ngày tạo </th> 
                <th style="white-space: nowrap;">Ngày cập nhập </th>
                <th style="white-space: nowrap;">Sửa/Xóa</th>
              </tr>
            </thead>
            <tbody>
            
            <?=$html_admincatalog;?>
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

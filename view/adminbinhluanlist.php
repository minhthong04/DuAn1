
<?php include_once "adminheader.php";?>
<?php 
$html_adminbinhluanlist = "";
$i=1;
foreach ($adminbinhluanlist as $item) {
    extract($item);

   

    $html_adminbinhluanlist .= '<tr>
        <td>' . $i. '</td>
        <td>' . $ma_nguoi_dung . '</td>
        <td>' . $ma_san_pham . '</td>
        <td>' . $noi_dung . '</td> 
        <td>' . $ngay_tao . '</td>
        

        <td>
        <a href="index.php?page=delbinhluan&id='.$id.'" class="btn btn-warning">
         <i class="fa-solid fa-pen-to-square"></i> remove
        </a>
            
        </td>
    </tr>';
    $i++;
}
?>



<div class="main-content">
          <h3 class="title-page">Bình Luận</h3>
         
          <table id="example" class="table table-striped table-bordered" style="width: 100%">
            <thead class="table-primary" >
              <tr>
                <th style="white-space: nowrap;">STT</th>
                <th style="white-space: nowrap;">Mã người dùng</th>
                <th style="white-space: nowrap;">Mã sản phẩm</th> 
                <th style="white-space: nowrap;">Bình luận</th>
                <th style="white-space: nowrap;">Ngày bình luận</th>
                <th style="white-space: nowrap;">Xóa</th>
              </tr>
            </thead>
            <tbody>
            
            <?=$html_adminbinhluanlist;?>
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

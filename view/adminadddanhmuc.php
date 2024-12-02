

<?php include_once "adminheader.php";?>
<div class="main-content">
                <h3 class="title-page">
                    Thêm Danh Mục
                </h3>
                
                <form class="addPro" action="index.php?page=adminadddanhmucadd" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh sản phẩm</label>
                        <div class="custom-file">
                            <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên danh mục:</label>
                        <input type="text" class="form-control" name="tendanhmuc" id="name" placeholder="Nhập tên sả phẩm">
                    </div>
                    <?php
        if (isset($thongbaotendanhmuc)) {
            echo "$thongbaotendanhmuc";
        }
        ?>
                  
                    <div class="form-group">
                        <button type="submit" name="addanhmuc" class="btn btn-primary">HOÀN THÀNH</button>
                    </div>
                </form>
            </div>

            <script>
                new DataTable('#example');
            </script>
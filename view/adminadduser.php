

<?php include_once "adminheader.php";?>
<div class="main-content">
                <h3 class="title-page">
                   THÊM NGƯỜI DÙNG
                </h3>
                
                <form class="addPro" action="index.php?page=adminadduser" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh Người Dùng</label>
                        <div class="custom-file">
                            <input type="file" name="img" class="custom-file-input" id="exampleInputFile ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">TÀI KHOẢN NGƯỜI DÙNG:</label>
                        <input type="text" class="form-control" name="accout" id="name"  >
                    </div>
                    <?php 
                     if(isset($thongbaotentaikhoan)){
                        echo"$thongbaotentaikhoan";
                     }
                    ?>
                    <div class="form-group">
                        <label for="price">MẬT KHẨU:</label>
                        <div class="input-group mb-3">
                          
                            <input type="text" name="pass" id="price" class="form-control">
                        </div>
                    </div>
                    <?php 
                     if(isset($thongbaomatkhau)){
                        echo"$thongbaomatkhau";
                     }
                    ?>
                    <div class="form-group">
                        <label for="price_sale">TÊN NGƯỜI DÙNG:</label>
                        <div class="input-group mb-3">
                          
                            <input type="text" name="nameuser" id="price_sale" class="form-control"
                                >
                        </div>
                    </div>
                    <?php 
                     if(isset($thongbaotennguoidung)){
                        echo"$thongbaotennguoidung"; 
                     }
                    ?>
                    <div class="form-group">
                        <label for="price_sale">SỐ ĐIỆN THOẠI:</label>
                        <div class="input-group mb-3">
                          
                            <input type="text" name="phone" id="price_sale" class="form-control"
                                >
                        </div>
                    </div>
                    <?php 
                     if(isset($thongbaosdt)){
                        echo"$thongbaosdt";
                     }
                    ?>
                    <div class="form-group">
                        <label for="price_sale">EMAIL:</label>
                        <div class="input-group mb-3">
                          
                            <input type="text" name="email" id="price_sale" class="form-control"
                                >
                        </div>
                    
                    </div>
                    <?php 
                     if(isset($thongbaoemail)){
                        echo"$thongbaoemail";
                     }
                    ?>
                    <div class="form-group">
                        <label for="price_sale">ĐỊA CHỈ NGƯỜI DÙNG:</label>
                        <div class="input-group mb-3">
                          
                            <input type="text" name="address" id="price_sale" class="form-control"
                                >
                        </div>
                    </div>
                    <?php 
                     if(isset($thongbaodiachi)){
                        echo"$thongbaodiachi";
                     }
                    ?>
                   
                    <div class="form-group">
                        <button type="submit" name="adduser" class="btn btn-primary">Hoàn Thành</button>
                    </div>
                </form>
            </div>

            <script>
                new DataTable('#example');
            </script>
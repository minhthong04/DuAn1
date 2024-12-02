<?php
if(is_array($danhmuc)&&(count($danhmuc)>0)){
    $imgpath=PATH_IMG_USER.$danhmuc['anh_danh_muc']; // uploads/tenhing.jpg
    if(is_file($imgpath)){
        $img='<img src="'.$imgpath.'" width="320px">';
    }else{
        $img="";
    }
}

// ?>

<?php include_once "adminheader.php";?>
<div class="main-content">
                <h3 class="title-page">
                    Sửa Danh Mục
                </h3>
                
                <form class="addPro" action="index.php?page=fixdanhmuc&id=<?= ($danhmuc['id'] != "") ? $danhmuc['id'] : "" ?>" method="POST" enctype="multipart/form-data">
                    <?=$img;?>
                    <div class="form-group">
                        <label for="exampleInputFile">Ảnh sản phẩm</label>
                        <div class="custom-file">
                            <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên Danh Mục</label>
                        <input type="text" class="form-control" name="category" id="name" value="<?=($danhmuc['ten_danh_muc']!="")?$danhmuc['ten_danh_muc']:""?>">
                    </div>
                    <?php
        if (isset($thongbaotendanhmuc)) {
            echo "$thongbaotendanhmuc";
        } else {
            echo "";
        }
        ?>
                    
                    <input type="hidden" name="id" value="<?=($danhmuc['id']!="")?$danhmuc['id']:""?>">
                    <div class="form-group">
                        <button type="submit" name="uploaddanhmuc" class="btn btn-primary">HOÀN tHÀNH</button>
                    </div>
                </form>
            </div>

            <script>
                new DataTable('#example');
            </script>
<?php
$html_productcategory="";
foreach ($spdm as $item) {
    extract($item);
    $html_productcategory.='<div class="item">
                                <div class="block-4 text-center">
                                <figure class="block-4-image">
                                    <img src="uploads/'.$hinh_san_pham.'" alt="Image placeholder" class="img-fluid">
                                </figure>
                                <div class="block-4-text p-4">
                                    <h3><a href="#">Tank Top</a></h3>
                                    <p class="mb-0">Finding perfect t-shirt</p>
                                    <p class="text-primary font-weight-bold">$50</p>
                                </div>
                                </div>
                            </div>';
}
?>

<?php include_once "header.php";?>

<?php
if(is_array($spdm)){
    extract($spdm);
}
?>
<div class="site-section block-3 site-blocks-2 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 site-section-heading text-center pt-4">
                <h2>Products of
                    <?php 
                        if($ma_danh_muc == 1){
                            echo "Men";
                        } elseif($ma_danh_muc == 2){
                            echo "Women";
                        } elseif($ma_danh_muc == 3){
                            echo "Boy";
                        } else {
                            echo "Unknown";
                        }
                    ?> category
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="nonloop-block-3 owl-carousel">
                    <?=$html_productcategory;?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once "footer.php";?>
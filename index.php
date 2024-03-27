<?php
session_start();
// session_destroy();
require_once "model/global.php";
require_once "model/pdo.php";
require_once "model/product.php";
require_once "model/category.php";
require_once "model/cart.php";
require_once "model/user.php";

if(isset($_GET['page'])){
    switch ($_GET['page']) {

        case 'productcategory':
            if(isset($_GET['idcat'])){
                $idcat=$_GET['idcat'];
            }else{
                $idcat=0;
            }
            // Sản phẩm theo từng loại danh mục
            $spdm=product_category($idcat);
            include_once 'view/productcategory.php';
            break;

        case 'product':
            if(isset($_GET['trang'])){
                $trang=$_GET['trang'];
            }else{
                $trang=1;
            }
            if(isset($_GET['limit'])){
                $limit=$_GET['limit'];
            }else{
                $limit=SOLUONG_SP;
            }
            if(isset($_GET['idcat'])){
                $idcat=$_GET['idcat'];
            }else{
                $idcat=0;
            }
            if(isset($_GET['orderby'])){
                $orderby = $_GET['orderby'];
            } else {
                $orderby = "";
            }
            // Dữ liệu ban đầu không được lọc
            $datapro = product_all_limit(0, 0, 0, ""); 
            //Show sản phẩm
            $productall = product_all_limit(9, $trang, $idcat,$orderby);
            //Load danh mục
            $category = category_all();
            //Phân trang
            $phantrang = phantrang($datapro, $trang, $idcat,$orderby);            
            include_once 'view/product.php';
            break;

            case 'addtocarthome':
                // Kiểm tra xem session user có tồn tại không
                if(!isset($_SESSION['user'])) {
                    // Nếu không tồn tại, chuyển hướng người dùng đến trang đăng nhập
                    header('location: index.php?page=login');
                    exit; // Dừng thực thi mã PHP tiếp theo
                }
                if(isset($_POST['add_to_cart'])){
                    $id=$_POST['id'];
                    $ten_san_pham=$_POST['ten_san_pham'];
                    $hinh_san_pham=$_POST['hinh_san_pham'];
                    $gia_san_pham=$_POST['gia_san_pham'];
                    $soluong=$_POST['soluong'];
                    $i=0;
                    $bitrung=0;
                    foreach ($_SESSION['user']['giohang'] as $item) {
                        if($id==$item["id"]){
                            $_SESSION['user']['giohang'][$i]['soluong']+=1;
                            $_SESSION['user']['giohang'][$i]['tong_gia'] = $gia_san_pham * $_SESSION['user']['giohang'][$i]['soluong'];
                            $bitrung=1;
                            break;
                        }
                        $i++;
                    }
                    // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào
                    if($bitrung==0){
                        $sp=[
                            "ten_san_pham"=>$ten_san_pham,
                            "hinh_san_pham"=>$hinh_san_pham,
                            "gia_san_pham"=>$gia_san_pham,
                            "soluong"=>$soluong,
                            "id"=>$id,
                            "tong_gia" => $gia_san_pham * $soluong // Tính tổng giá ban đầu
                            
                        ];
                        echo $soluong;
                        $_SESSION['user']['giohang'][] = $sp;
                    }
                    header('location: index.php?page=home');
                }
                break;
            

        case 'addtocartproduct':
            if(isset($_POST['add_to_cart'])){
                $id = $_POST['id'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $hinh_san_pham = $_POST['hinh_san_pham'];
                $gia_san_pham = $_POST['gia_san_pham'];
                $soluong = $_POST['soluong'];
                $i = 0;
                $bitrung = 0;
                foreach ($_SESSION["giohang"] as $item) {
                    if($id == $item["id"]){
                        $_SESSION["giohang"][$i]['soluong'] += 1;
                        $bitrung = 1;
                        break;
                    }
                    $i++;
                }
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào
                if($bitrung == 0){
                    $sp = [
                        "ten_san_pham" => $ten_san_pham,
                        "hinh_san_pham" => $hinh_san_pham,
                        "gia_san_pham" => $gia_san_pham,
                        "soluong" => $soluong,
                        "id" => $id
                    ];
                    $_SESSION["giohang"][] = $sp;
                }
                // Sau khi thêm sản phẩm vào giỏ hàng, chuyển hướng về trang sản phẩm với các tham số orderby và idcat
                $redirect_url = 'index.php?page=product';
                if(isset($_GET['orderby'])){
                    $redirect_url .= '&orderby='.$_GET['orderby'];
                }
                if(isset($_GET['idcat'])){
                    $redirect_url .= '&idcat='.$_GET['idcat'];
                }
                if(isset($_GET['trang'])){
                    $redirect_url .= '&trang='.$_GET['trang'];
                }
                header('location: ' . $redirect_url);
            }
            break;
        
        case 'addtocartproductdetail':
            if(isset($_POST['add_to_cart'])){
                $id=$_POST['id'];
                $ten_san_pham=$_POST['ten_san_pham'];
                $hinh_san_pham=$_POST['hinh_san_pham'];
                $gia_san_pham=$_POST['gia_san_pham'];
                $soluong=$_POST['soluong'];
                $i=0;
                $bitrung=0;
                foreach ($_SESSION["giohang"] as $item) {
                    if($id==$item["id"]){
                        $_SESSION["giohang"][$i]['soluong']+=1;
                        $bitrung=1;
                        break;
                    }
                    $i++;
                }
                // $sp=[$ten_san_pham,$hinh_san_pham,$gia_san_pham,$soluong];
                if($bitrung==0){
                    $sp=[
                        "ten_san_pham"=>$ten_san_pham,
                        "hinh_san_pham"=>$hinh_san_pham,
                        "gia_san_pham"=>$gia_san_pham,
                        "soluong"=>$soluong,
                        "id"=>$id
                    ];
                    // array_push($_SESSION["giohang"],$sp);
                    $_SESSION["giohang"][]=$sp;
                }
                $redirect_url = 'index.php?page=productdetail';
                if(isset($_GET['id'])){
                    $redirect_url .= '&id='.$_GET['id'];
                }
                header('location: ' . $redirect_url);
                }
            break;

        case 'viewcart':
            if(isset($_GET['del'])){
                $del=$_GET['del'];
                array_splice($_SESSION['user']["giohang"],$del,1);
                header('location: index.php?page=viewcart');
            }
            include_once 'view/viewcart.php';
            break;

        case 'productdetail':
            // detail
            if(isset($_GET["id"])&&($_GET["id"]>0)){
                $id=$_GET["id"];
                $detail=product_select_one($id);
            }
            include_once 'view/productdetail.php';
        break;

        case 'increase':
            if(isset($_GET['i'])) {
                $i = $_GET['i'];
                
                // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
                if(isset($_SESSION['user']['giohang'][$i])) {
                    // Tăng số lượng của sản phẩm lên 1
                    $_SESSION['user']['giohang'][$i]['soluong']+= 1;
                    
                    // Lấy giá sản phẩm từ session
                    $gia_san_pham = $_SESSION['user']['giohang'][$i]['gia_san_pham'];
                    
                    // Cập nhật tổng giá cho sản phẩm sau khi tăng số lượng
                    $_SESSION['user']['giohang'][$i]['tong_gia'] = $gia_san_pham * $_SESSION['user']['giohang'][$i]['soluong'];
                }
            }
            
            // Chuyển hướng người dùng về trang giỏ hàng
            header('Location: index.php?page=viewcart');
            break;
        

        case 'decrease':
            if(isset($_GET['i'])) {
                $i = $_GET['i'];
                if(isset($_SESSION['user']['giohang'][$i])) {
                    if ($_SESSION['user']['giohang'][$i]['soluong'] > 1) {
                        $_SESSION['user']['giohang'][$i]['soluong']--;
                    }
                }
            }
            // Chuyển hướng người dùng về trang giỏ hàng
            header('Location: index.php?page=viewcart');
            break;

        case 'about':
            include_once 'view/about.php';
            break;    
            
        case 'contact':
            include_once 'view/contact.php';
            break;
        
            case 'login':
                if (isset($_POST['btn_login'])) {
                    $taikhoan = $_POST['tai_khoan'];
                    $matkhau = $_POST['mat_khau'];
                    $data = check_login($taikhoan, $matkhau);
                    if ($data) {
                        $_SESSION['user'] = $data;
                        // Chỉ gán giỏ hàng cho người dùng nếu họ đã đăng nhập thành công
                        if (isset($_SESSION['giohang'])) {
                            $_SESSION['user']['giohang'] = $_SESSION['giohang'];
                        }
                        header('Location: index.php?page=home');
                    } else {
                        $thongbao = "<p style='color: red;font-weight: bold;'>Đăng nhập không thành công, xin hãy kiểm tra thông tin và đăng nhập lại!!!</p>";
                    }
                }
                include_once 'view/login.php';
                break;
        case 'loginlogout':
            unset($_SESSION['user']);
            if (isset($_SESSION['user']['giohang'])) {
                $_SESSION['giohang'] = $_SESSION['user']['giohang'];
            }
            // Xóa thông tin giỏ hàng từ session người dùng
            unset($_SESSION['user']['giohang']);
            header('Location: index.php?page=home');
            break;
        case 'mail':
            if(isset($_POST['btn_login'])){
            header('Location: index.php?page=home');
            }
            include_once 'view/mail.php';
            break;

        case 'checkout-test':
            if(isset($_POST['place_order'])){
                // Lấy thông tin từ form
                $billing_details = [
                    'firstname' => $_POST['firstname'],
                    'deliveryaddress' => $_POST['deliveryaddress'],
                    'email' => $_POST['email'],
                    'phone' => $_POST['phone']
                ];
                $payment_method = $_POST['payment_method'];
        
                // Kiểm tra mã coupon
                $coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : '';
                $discount = 0;
                if (!empty($coupon_code)) {
                    // Kiểm tra mã coupon trong cơ sở dữ liệu
                    $valid_coupon = check_coupon($coupon_code);
                    if ($valid_coupon) {
                        // Nếu mã coupon hợp lệ, áp dụng giảm giá cho tổng giá trị giỏ hàng
                        $discount = 0.9; // Giảm giá 10%
        
                        // Cập nhật giảm giá cho tổng giá trị của giỏ hàng
                        tongdonhang() * $discount;
                    } else {
                        // Nếu không hợp lệ, hiển thị thông báo lỗi
                        $error_message = "Invalid coupon code";
                    }
                }
        
                // Lưu thông tin vào cơ sở dữ liệu
                $order_id = save_order($billing_details, $payment_method, $coupon_code, $discount);
                

                
        
                // Chuyển hướng người dùng đến trang cảm ơn
                header('Location: index.php?order_id=' . $order_id);
                exit;
            }
            include_once 'view/checkout.php';
            break;
        case 'checkout':
            if(isset($_POST['btn_voucher'])){
                $voucher= isset($_POST['voucher']) ? $_POST['voucher'] : '';
                if(!empty($voucher)){
                    $valid_voucher = check_voucher($voucher);
                    if($valid_voucher){
                        $discount = 0.9;
                        $daxaivoucher = tongdonhang() *  $discount;
                        // Lưu giá trị giảm giá vào session
                        $_SESSION['daxaivoucher'] = $daxaivoucher;
                    }else{
                        $error_message = "<p style='color: red'>Mã code bạn nhập không hợp lệ!!!</p>";
                    }
                }
            }
            include_once 'view/checkout.php';
            break;
        case 'voucherdelete':
            if(isset($_SESSION['daxaivoucher'])){
                unset($_SESSION['daxaivoucher']);
                header('Location: index.php?page=checkout');
            }
            include_once 'view/checkout.php';
            break;
        default:
            $dssp_view=product_view(10);
            $dssp=product_all_limit(10,0,0,"");
            $category=category_all();
            include_once 'view/home.php';
            break;
    }
}else{
    $dssp_view=product_view(10);
    $dssp=product_all_limit(10,0,0,"");
    $category=category_all();
    include_once 'view/home.php';
}
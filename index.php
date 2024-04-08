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
                
                if(isset($_POST['btn_search'])){
                    $kyw=$_POST['kyw'];
                }else{
                    $kyw="";
                }
                // Dữ liệu ban đầu không được lọc
                $datapro = product_all_limit(0, 0, 0, "", ""); 
                //Show sản phẩm
                if($kyw===""){
                    $productall = product_all_limit(9, $trang, $idcat, $orderby, "");
                }else{
                    $productall = product_all_limit(0, $trang, $idcat, $orderby, $kyw);
                }
                //Load danh mục
                $category = category_all();
                //Phân trang
                $phantrang = phantrang($datapro, $trang, $idcat, $orderby, $kyw);            
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
                            "tong_gia" => $gia_san_pham * $soluong, // Tính tổng giá ban đầu
                            "iduser" => $_SESSION['user']['id']
                            
                        ];
                        $_SESSION['user']['giohang'][] = $sp;
                        $_SESSION["giohang"][] = $sp;
                    }
                    header('location: index.php?page=home');
                }
                break;
            

        case 'addtocartproduct':
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
                    $_SESSION['user']['giohang'][] = $sp;
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
                if(isset($_GET['kyw'])){
                    $redirect_url .= '&kyw='.$_GET['kyw'];
                }
                header('location: ' . $redirect_url);
            }
            break;
        
        case 'addtocartproductdetail':
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
                // $sp=[$ten_san_pham,$hinh_san_pham,$gia_san_pham,$soluong];
                if($bitrung==0){
                    $sp=[
                        "ten_san_pham"=>$ten_san_pham,
                        "hinh_san_pham"=>$hinh_san_pham,
                        "gia_san_pham"=>$gia_san_pham,
                        "soluong"=>$soluong,
                        "id"=>$id,
                        "tong_gia" => $gia_san_pham * $soluong // Tính tổng giá ban đầu
                        
                    ];
                    // array_push($_SESSION["giohang"],$sp);
                    $_SESSION['user']['giohang'][] = $sp;
                    $_SESSION["giohang"][] = $sp;
                }
                $redirect_url = 'index.php?page=productdetail';
                if(isset($_GET['id'])){
                    $redirect_url .= '&id='.$_GET['id'];
                }
                header('location: ' . $redirect_url);
                }
            break;

        case 'viewcart':
            if(empty($_SESSION['user']['giohang'])){
                $thongbaoviewcart="<p style='color: red;font-weight: bold;font-size: 12px;'>Bạn phải mua ít nhất 1 sản phẩm để có thể thanh toán</p>";
            include_once 'view/viewcart.php';
                exit;
            }
            if(isset($_GET['del'])){
                $del=$_GET['del'];
                array_splice($_SESSION['user']["giohang"],$del,1);
                header('location: index.php?page=viewcart');
            }
            include_once 'view/viewcart.php';
            break;

        case 'productdetail':
            // Lấy ID từ đường dẫn đưa vào $id
            if(isset($_GET["id"])&&($_GET["id"]>0)){
                $id=$_GET["id"];
                // đưa id vào hàm để lấy sản phẩm theo ID
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
                          // Lấy giá sản phẩm từ session
                    $gia_san_pham = $_SESSION['user']['giohang'][$i]['gia_san_pham'];
                    
                    // Cập nhật tổng giá cho sản phẩm sau khi tăng số lượng
                    $_SESSION['user']['giohang'][$i]['tong_gia'] = $gia_san_pham * $_SESSION['user']['giohang'][$i]['soluong'];
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
                // lấy dữ liệu từ form bên view về
                if (isset($_POST['btn_login'])) {
                    $taikhoan = $_POST['tai_khoan'];
                    $matkhau = $_POST['mat_khau'];
                    // Kiểm tra tài khoản có trống
                    if(empty($taikhoan) && empty($matkhau)) {
                        $thongbaotaikhoan = "<p style='color: red;font-weight: bold;'>Tài khoản không được để trống!</p>";
                        $thongbaomatkhau = "<p style='color: red;font-weight: bold;'>Mật khẩu không được để trống!</p>";
                    // Kiểm tra tài khoản đủ ký tự không
                    }elseif(strlen($taikhoan) < 3 && empty($matkhau)){
                        $thongbao = "<p style='color: red;font-weight: bold;'>Tài khoản không được bé hơn 3 ký tự và mật khẩu không được để trống!</p>";
                    // Kiểm tra xem mật khẩu có bị bỏ trống không
                    }elseif(empty($matkhau)) {
                        $thongbao = "<p style='color: red;font-weight: bold;'>Vui lòng nhập mật khẩu!</p>";
                    // nếu check lỗi không sai thì đưa vào db để kiểm tra
                    }else{
                        $data = check_login($taikhoan, $matkhau);
                        if ($data) {
                            $_SESSION['user'] = $data;
                            // Lưu ID người dùng đã đăng nhập vào một biến
                            $logged_in_user_id = $_SESSION['user']['id'];
            
                            // So sánh ID người dùng đã đăng nhập với ID trong session giỏ hàng
                            if (isset($_SESSION['giohang']) && isset($_SESSION['user']['id'])) {
                                foreach ($_SESSION['giohang'] as $item) {
                                    if ($logged_in_user_id === $item['iduser']) {
                                        $_SESSION['user']['giohang'] = $_SESSION['giohang'];
                                        break; // Thoát khỏi vòng lặp ngay sau khi tìm thấy sản phẩm của người dùng
                                    }
                                }
                            }
                            unset($_SESSION['giohang']);
                            header('Location: index.php?page=home');
                            exit; // Dừng thực thi mã PHP tiếp theo sau khi chuyển hướng
                        }
                    }
                }
                include_once 'view/login.php';
                break;
            
            

                case 'loginlogout':
                    if (isset($_SESSION['user'])) {
                        $_SESSION['giohang'] = $_SESSION['user']['giohang'];
                    }
                    // Xóa thông tin giỏ hàng từ session người dùng
                    unset($_SESSION['user']);
                    header('Location: index.php?page=home');
                    break;
                
                
                    case 'signup':
                        // lấy dữ liệu từ form bên view về
                        if (isset($_POST['btn_signup'])) {
                            $tennguoidung = $_POST['tennguoidung'];
                            $taikhoan = $_POST['taikhoan'];
                            $matkhau = $_POST['matkhau'];
                            $nhaplaimatkhau = $_POST['nhaplaimatkhau'];
                    
                            // Kiểm tra nếu cả 4 trường đều để trống
                            if (empty($tennguoidung) && empty($taikhoan) && empty($matkhau) && empty($nhaplaimatkhau)) {
                                $thongbao = "<p style='color: red;font-weight: bold;'>Không được để trống các trường!</p>";
                            } else {
                                // Kiểm tra từng trường một
                                if (empty($tennguoidung) && empty($taikhoan)) {
                                    $thongbao = "<p style='color: red;font-weight: bold;'>Tên người dùng và tài khoản không được để trống!</p>";
                                } elseif (empty($tennguoidung)) {
                                    $thongbao = "<p style='color: red;font-weight: bold;'>Tên người dùng không được để trống!</p>";
                                } elseif (empty($taikhoan)) {
                                    $thongbao = "<p style='color: red;font-weight: bold;'>Tài khoản không được để trống!</p>";
                                } elseif (empty($matkhau)) {
                                    $thongbao = "<p style='color: red;font-weight: bold;'>Mật khẩu không được để trống!</p>";
                                } elseif (empty($nhaplaimatkhau)) {
                                    $thongbao = "<p style='color: red;font-weight: bold;'>Nhập lại mật khẩu không được để trống!</p>";
                                } else {
                                    // Kiểm tra xem mật khẩu có khớp không
                                    if ($matkhau !== $nhaplaimatkhau) {
                                        $thongbao = "<p style='color: red;font-weight: bold;'>Mật khẩu nhập lại không đúng!</p>";
                                    } else {
                                        // Kiểm tra xem mật khẩu có đủ ký tự không
                                        if (strlen($matkhau) < 3) {
                                            $thongbao = "<p style='color: red;font-weight: bold;'>Mật khẩu phải chứa ít nhất 3 ký tự!</p>";
                                        } else {
                                            // Kiểm tra xem tài khoản đã tồn tại trong cơ sở dữ liệu hay không
                                            $signup_result = check_signup($tennguoidung, $taikhoan, $matkhau);
                                            if ($signup_result === false) {
                                                $thongbao = "<p style='color: red;font-weight: bold;'>Tài khoản đã tồn tại!</p>";
                                            } else {
                                                // Chuyển hướng người dùng đến trang đăng nhập
                                                header('Location: index.php?page=login');
                                                exit; // Dừng kịch bản tiếp theo
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        include_once 'view/signup.php';
                        break;
                    
                
                
                
                



            case 'thankyou':
                include_once 'view/thankyou.php';
                break;

            case 'checkout':
            // Trong phần xử lý khi người dùng nhấn nút "APPLY"
            if(isset($_POST['btn_voucher'])){
                $_SESSION['voucher'] = isset($_POST['voucher']) ? $_POST['voucher'] : '';
                if(!empty($_SESSION['voucher'])){
                    $valid_voucher = check_voucher($_SESSION['voucher']);
                    if($valid_voucher){
                        $phantramgiam = phantramgiam($_SESSION['voucher']);
                        $tongtien = tongdonhang(); // Lấy tổng số tiền đơn hàng
                        $daxaivoucher = ($tongtien * (INT)$phantramgiam['phan_tram_giam'])/100; // Tính toán số tiền được giảm
                        // Lưu giá trị giảm giá vào session
                        $_SESSION['daxaivoucher'] = $daxaivoucher;
                        // Lấy ID của voucher từ mã voucher
                    } else {
                        $error_message = "<p style='color: red'>Mã code bạn nhập không hợp lệ!!!</p>";
                    }
                }
            }
            


            if (isset($_POST['btn_place_order'])) {
                if(empty($_SESSION['user']['giohang'])){
                    $thongbaocod="<p style='color: red;font-weight: bold;font-size: 12px;'>Bạn phải mua ít nhất 1 sản phẩm để có thể thanh toán</p>";
                include_once 'view/checkout.php';
                    exit;
                }
                $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
                $deliveryaddress = isset($_POST['deliveryaddress']) ? $_POST['deliveryaddress'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
                $idnguoidung = isset($_POST['idnguoidung']) ? $_POST['idnguoidung'] : '';
        
                // Kiểm tra xem voucher có được áp dụng không
                if (isset($_SESSION['daxaivoucher'])) {
                    $voucher_use = $_SESSION['voucher'];
                    $tongtien = $_SESSION['daxaivoucher'];
                } else {
                    $voucher_use = 0;
                    $tongtien = tongdonhang();
                }
        
                // Kiểm tra và xử lý các dữ liệu khác được gửi đến từ form
                insert_donhang($idnguoidung, $tongtien, $firstname, $deliveryaddress, $email, $phone, $voucher_use, $payment_method);
                unset($_SESSION['voucher']);
                unset($_SESSION['daxaivoucher']);
                $id = $_SESSION['user']['id'];
                $order_info = get_order_information($id); // Lấy thông tin đơn hàng
                // Nếu chọn COD, gửi email và chuyển hướng đến trang cảm ơn
                header('Location: index.php?page=thankyou');
                include_once 'view/mail.php'; // Gửi email
                $iddonhang = iddonhang($id)['id'];
                // Lặp qua các sản phẩm trong giỏ hàng để thêm vào chi tiết đơn hàng
                foreach ($_SESSION['user']['giohang'] as $item) {
                    $soluong = $item['soluong'];
                    $masanpham = $item['id'];
                    $dongia = $item['gia_san_pham'] * $item['soluong'];
                    
                    // Thêm chi tiết đơn hàng vào cơ sở dữ liệu
                    insert_chitietdonhang($masanpham, $dongia, $soluong, $iddonhang);
                }
                unset($_SESSION['user']['giohang']);
                unset($_SESSION['giohang']);
            }

            if (isset($_POST['redirect'])) {
                if(empty($_SESSION['user']['giohang'])){
                    $thongbaovnpay="<p style='color: red;font-weight: bold;font-size: 12px;'>Bạn phải mua ít nhất 1 sản phẩm để có thể thanh toán</p>";
                include_once 'view/checkout.php';
                    exit;
                }
                $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
                $deliveryaddress = isset($_POST['deliveryaddress']) ? $_POST['deliveryaddress'] : '';
                $email = isset($_POST['email']) ? $_POST['email'] : '';
                $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
                $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
                $idnguoidung = isset($_POST['idnguoidung']) ? $_POST['idnguoidung'] : '';
        
                // Kiểm tra xem voucher có được áp dụng không
                if (isset($_SESSION['daxaivoucher'])) {
                    $voucher_use = $_SESSION['voucher'];
                    $tongtien = $_SESSION['daxaivoucher'];
                } else {
                    $voucher_use = 0;
                    $tongtien = tongdonhang();
                }
        
                // Kiểm tra và xử lý các dữ liệu khác được gửi đến từ form
                insert_donhang($idnguoidung, $tongtien, $firstname, $deliveryaddress, $email, $phone, $voucher_use, $payment_method);
                unset($_SESSION['voucher']);
                unset($_SESSION['daxaivoucher']);
                $id = $_SESSION['user']['id'];
                $order_info = get_order_information($id); // Lấy thông tin đơn hàng
                include_once 'view/mail.php'; 
                include_once 'view/vnpay.php'; 
                $iddonhang = iddonhang($id)['id'];
                // Lặp qua các sản phẩm trong giỏ hàng để thêm vào chi tiết đơn hàng
                foreach ($_SESSION['user']['giohang'] as $item) {
                    $soluong = $item['soluong'];
                    $masanpham = $item['id'];
                    $dongia = $item['gia_san_pham'] * $item['soluong'];
            
                    // Thêm chi tiết đơn hàng vào cơ sở dữ liệu
                    insert_chitietdonhang($masanpham, $dongia, $soluong, $iddonhang);
                }
                unset($_SESSION['user']['giohang']);
                unset($_SESSION['giohang']);
            }
        
            include_once 'view/checkout.php';
            break;
            
            case 'mail':
                include_once 'view/mail.php';
                break;
            case 'vnpay':
                include_once 'view/vnpay.php';
                break;
            case 'order':
                $order=order();
                include_once 'view/order.php';
                break;
            case 'orderdel':

                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    orderdel($id);
                }
                $order=order();
                include_once 'view/order.php';
                break;
            case 'orderdetail':
                if(isset($_GET['id'])){
                    $id=$_GET['id'];
                    $orderdetail=orderdetail($id);
                }
                include_once 'view/orderdetail.php';
                break;
            case 'info':
                if(isset($_SESSION['user']['id'])){
                    $id = $_SESSION['user']['id'];
                    $showinfo = showinfo($id);
                }
                include_once 'view/info.php';
                break;

                case 'updateinfo':
                    if(isset($_POST['btn_update'])) {
                        // Lấy thông tin từ $_POST
                        $username = $_POST['username'];
                        $account = $_POST['account'];
                        $password = $_POST['password'];
                        $email = $_POST['email'];
                        $address = $_POST['address'];
                        $phone = $_POST['phone'];
                        $role = $_POST['role'];
                        $id = $_POST['id']; // Lấy ID từ trường input ẩn
                        $avatar = $_FILES['avatar']['name'];
                        if($avatar!=""){
                            //upload hinh anh
                            $targtet_file=PATH_IMG_USER.$img;
                            move_uploaded_file($_FILES["avatar"]["tmp_name"], $targtet_file);
                            }else{
                                $$avatar="";
                            }
                        
                        updateinfo($avatar, $username, $account, $password, $email, $address, $phone, $role, $id);
;
                        
                        // Tiếp tục xử lý các thông tin này, chẳng hạn lưu vào cơ sở dữ liệu hoặc thực hiện các hành động cần thiết khác
                    header('Location: index.php?page=info');
                        
                        // Redirect hoặc include view tùy thuộc vào logic của bạn
                    }
                    include_once 'view/info.php';
                    break;
                
                
                

        case 'voucherdelete':
            if(isset($_SESSION['daxaivoucher'])){
                unset($_SESSION['daxaivoucher']);
                back_voucher($_SESSION['voucher']);
                header('Location: index.php?page=checkout');
            }
            include_once 'view/checkout.php';
            break;
        
        default:
            $dssp_view=product_view(10);
            $dssp=product_all_limit(10,0,0,"","");
            $category=category_all();
            include_once 'view/home.php';
            break;
    }
}else{
    $dssp_view=product_view(10);
    $dssp=product_all_limit(10,0,0,"","");
    $category=category_all();
    include_once 'view/home.php';
}
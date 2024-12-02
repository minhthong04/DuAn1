<?php
session_start();
// session_destroy();
require_once "model/global.php";
require_once "model/pdo.php";
require_once "model/product.php";
require_once "model/category.php";
require_once "model/cart.php";
require_once "model/user.php";

if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'productcategory':
            if (isset($_GET['idcat'])) {
                $idcat = $_GET['idcat'];
            } else {
                $idcat = 0;
            }
            // Sản phẩm theo từng loại danh mục
            $spdm = product_category($idcat);
            include_once 'view/productcategory.php';
            break;
    
        case 'product':
            if (isset($_GET['trang'])) {
                $trang = $_GET['trang'];
            } else {
                $trang = 1;
            }
            if (isset($_GET['limit'])) {
                $limit = $_GET['limit'];
            } else {
                $limit = SOLUONG_SP;
            }
            if (isset($_GET['idcat'])) {
                $idcat = $_GET['idcat'];
            } else {
                $idcat = 0;
            }
            if (isset($_GET['orderby'])) {
                $orderby = $_GET['orderby'];
            } else {
                $orderby = "";
            }
            if (isset($_POST['btn_search'])) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            // Dữ liệu ban đầu không được lọc
            $datapro = product_all_limit(0, 0, 0, "", "");
            //Show sản phẩm
            if ($kyw === "") {
                $productall = product_all_limit(9, $trang, $idcat, $orderby, "");
            } else {
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
            if (!isset($_SESSION['user'])) {
                // Nếu không tồn tại, chuyển hướng người dùng đến trang đăng nhập
                header('location: index.php?page=login');
                exit; // Dừng thực thi mã PHP tiếp theo
            }
            if (isset($_POST['add_to_cart'])) {
                $id = $_POST['id'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $hinh_san_pham = $_POST['hinh_san_pham'];
                $gia_san_pham = $_POST['gia_san_pham'];
                $soluong = $_POST['soluong'];
                $i = 0;
                $bitrung = 0;
                foreach ($_SESSION['user']['giohang'] as $item) {
                    if ($id == $item["id"]) {
                        $_SESSION['user']['giohang'][$i]['soluong'] += 1;
                        $_SESSION['user']['giohang'][$i]['tong_gia'] = $gia_san_pham * $_SESSION['user']['giohang'][$i]['soluong'];
                        $bitrung = 1;
                        break;
                    }
                    $i++;
                }
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào
                if ($bitrung == 0) {
                    $sp = [
                        "ten_san_pham" => $ten_san_pham,
                        "hinh_san_pham" => $hinh_san_pham,
                        "gia_san_pham" => $gia_san_pham,
                        "soluong" => $soluong,
                        "id" => $id,
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
            if (!isset($_SESSION['user'])) {
                // Nếu không tồn tại, chuyển hướng người dùng đến trang đăng nhập
                header('location: index.php?page=login');
                exit; // Dừng thực thi mã PHP tiếp theo
            }
            if (isset($_POST['add_to_cart'])) {
                $id = $_POST['id'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $hinh_san_pham = $_POST['hinh_san_pham'];
                $gia_san_pham = $_POST['gia_san_pham'];
                $soluong = $_POST['soluong'];
                $i = 0;
                $bitrung = 0;
                foreach ($_SESSION['user']['giohang'] as $item) {
                    if ($id == $item["id"]) {
                        $_SESSION['user']['giohang'][$i]['soluong'] += 1;
                        $_SESSION['user']['giohang'][$i]['tong_gia'] = $gia_san_pham * $_SESSION['user']['giohang'][$i]['soluong'];
                        $bitrung = 1;
                        break;
                    }
                    $i++;
                }
                // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào
                if ($bitrung == 0) {
                    $sp = [
                        "ten_san_pham" => $ten_san_pham,
                        "hinh_san_pham" => $hinh_san_pham,
                        "gia_san_pham" => $gia_san_pham,
                        "soluong" => $soluong,
                        "id" => $id,
                        "tong_gia" => $gia_san_pham * $soluong // Tính tổng giá ban đầu
                    ];
                    $_SESSION['user']['giohang'][] = $sp;
                    $_SESSION["giohang"][] = $sp;
                }
                // Sau khi thêm sản phẩm vào giỏ hàng, chuyển hướng về trang sản phẩm với các tham số orderby và idcat
                $redirect_url = 'index.php?page=product';
                if (isset($_GET['orderby'])) {
                    $redirect_url .= '&orderby=' . $_GET['orderby'];
                }
                if (isset($_GET['idcat'])) {
                    $redirect_url .= '&idcat=' . $_GET['idcat'];
                }
                if (isset($_GET['trang'])) {
                    $redirect_url .= '&trang=' . $_GET['trang'];
                }
                if (isset($_GET['kyw'])) {
                    $redirect_url .= '&kyw=' . $_GET['kyw'];
                }
                header('location: ' . $redirect_url);
            }
            break;

        case 'addtocartproductcategory':
            if (!isset($_SESSION['user'])) {
                header('location: index.php?page=login');
                exit;
            }
            if (isset($_POST['add_to_cart'])) {
                $id = $_POST['id'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $hinh_san_pham = $_POST['hinh_san_pham'];
                $gia_san_pham = $_POST['gia_san_pham'];
                $soluong = $_POST['soluong'];
                $i = 0;
                $bitrung = 0;
                foreach ($_SESSION['user']['giohang'] as $item) {
                    if ($id == $item["id"]) {
                        $_SESSION['user']['giohang'][$i]['soluong'] += 1;
                        $_SESSION['user']['giohang'][$i]['tong_gia'] = $gia_san_pham * $_SESSION['user']['giohang'][$i]['soluong'];
                        $bitrung = 1;
                        break;
                    }
                    $i++;
                }
                if ($bitrung == 0) {
                    $sp = [
                        "ten_san_pham" => $ten_san_pham,
                        "hinh_san_pham" => $hinh_san_pham,
                        "gia_san_pham" => $gia_san_pham,
                        "soluong" => $soluong,
                        "id" => $id,
                        "tong_gia" => $gia_san_pham * $soluong
                    ];
                    $_SESSION['user']['giohang'][] = $sp;
                    $_SESSION["giohang"][] = $sp;
                }
                $redirect_url = 'index.php?page=productcategory';
                if (isset($_GET['idcat'])) {
                    $redirect_url .= '&idcat=' . $_GET['idcat'];
                }
                header('location: ' . $redirect_url);
            }
            break;

        case 'addtocartproductdetail':
            if (!isset($_SESSION['user'])) {
                header('location: index.php?page=login');
                exit; // Dừng thực thi mã PHP tiếp theo
            }
            if (isset($_POST['add_to_cart'])) {
                $id = $_POST['id'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $hinh_san_pham = $_POST['hinh_san_pham'];
                $gia_san_pham = $_POST['gia_san_pham'];
                $soluong = $_POST['soluong'];
                $i = 0;
                $bitrung = 0;
                foreach ($_SESSION['user']['giohang'] as $item) {
                    if ($id == $item["id"]) {
                        $_SESSION['user']['giohang'][$i]['soluong'] += 1;
                        $_SESSION['user']['giohang'][$i]['tong_gia'] = $gia_san_pham * $_SESSION['user']['giohang'][$i]['soluong'];
                        $bitrung = 1;
                        break;
                    }
                    $i++;
                }
                // $sp=[$ten_san_pham,$hinh_san_pham,$gia_san_pham,$soluong];
                if ($bitrung == 0) {
                    $sp = [
                        "ten_san_pham" => $ten_san_pham,
                        "hinh_san_pham" => $hinh_san_pham,
                        "gia_san_pham" => $gia_san_pham,
                        "soluong" => $soluong,
                        "id" => $id,
                        "tong_gia" => $gia_san_pham * $soluong // Tính tổng giá ban đầu
                    ];
                    // array_push($_SESSION["giohang"],$sp);
                    $_SESSION['user']['giohang'][] = $sp;
                    $_SESSION["giohang"][] = $sp;
                }
                $redirect_url = 'index.php?page=productdetail';
                if (isset($_GET['id'])) {
                    $redirect_url .= '&id=' . $_GET['id'];
                }
                header('location: ' . $redirect_url);
            }
            break;

        case 'viewcart':
            if (isset($_GET['del'])) {
                $del = $_GET['del'];
                array_splice($_SESSION['user']["giohang"], $del, 1);
                header('location: index.php?page=viewcart');
            }
            if (!empty($_SESSION['user']['giohang'])) {
                $thongbaocart = "<p style='color: red;font-weight: bold;font-size: 12px;'>Bạn phải mua ít nhất 1 sản phẩm để có thể thanh toán</p>";
            }
            include_once 'view/viewcart.php';
            break;

        case 'productdetail':
            // Lấy ID từ đường dẫn đưa vào $id
            if (isset($_GET["id"]) && ($_GET["id"] > 0)) {
                $id = $_GET["id"];

                // đưa id vào hàm để lấy sản phẩm theo ID
                $detail = product_select_one($id);
                $iddmsp = $detail['ma_danh_muc'];
                $checkorderdetail = checkorderdetail($id);
                $showcomment = showcomment($id);
                $splienquan = splienquan($id, $iddmsp);
                if (isset($_SESSION['user'])) {
                    $iduser = $_SESSION['user']['id'];
                    $checkuserorder = checkuserorder($iduser);
                }
            }
            // Kiểm tra nút gửi comment được nhấn
            // Kiểm tra nút gửi comment được nhấn
            if (isset($_POST['btn_comment'])) {
                $check = true;
                $iduser = $_POST['iduser'];
                $idproduct = $_POST['idproduct'];
                $comment = $_POST['comment'];
                if (empty($comment)) {
                    $thongbaobinhluan = "<p style='color: red;font-weight: bold;font-size: 12px;'>Bạn phải nhập bình luận để có thể gửi</p>";
                    $check = false;
                }
                if ($check == true) {
                    addcomment($iduser, $idproduct, $comment);
                    // Redirect lại trang với ID giữ nguyên
                    header("Location: index.php?page=productdetail&id=" . $idproduct);
                    exit();
                } else {
                    if (isset($_GET["id"]) && ($_GET["id"] > 0)) {
                        $id = $_GET["id"];
                        // đưa id vào hàm để lấy sản phẩm theo ID
                        $detail = product_select_one($id);
                        $iddmsp = $detail['ma_danh_muc'];
                        $checkorderdetail = checkorderdetail($id);
                        $showcomment = showcomment($id);
                        $splienquan = splienquan($id, $iddmsp);
                        if (isset($_SESSION['user'])) {
                            $iduser = $_SESSION['user']['id'];
                            $checkuserorder = checkuserorder($iduser);
                        }
                        include_once 'view/productdetail.php';
                    }
                }
            }
            include_once 'view/productdetail.php';
            break;

        case 'comment':

            break;

        case 'increase':
            if (isset($_GET['i'])) {
                $i = $_GET['i'];
                // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
                if (isset($_SESSION['user']['giohang'][$i])) {
                    // Tăng số lượng của sản phẩm lên 1
                    $_SESSION['user']['giohang'][$i]['soluong'] += 1;
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
            if (isset($_GET['i'])) {
                $i = $_GET['i'];
                if (isset($_SESSION['user']['giohang'][$i])) {
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
                if (empty($taikhoan)) {
                    $thongbaotaikhoan = "<p style='color: red;font-weight: bold;'>Tài khoản không được để trống!</p>";
                }
                if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $taikhoan)) {
                    $thongbaotaikhoan = "<p style='color: red;font-weight: bold;'>Tài khoản không được chứa ký tự đặc biệt!</p>";
                }
                if (empty($matkhau)) {
                    $thongbaomatkhau = "<p style='color: red;font-weight: bold;'>Mật khẩu không được để trống!</p>";
                }
                if (!preg_match('/[A-Z]/', $matkhau) || !preg_match('/[0-9]/', $matkhau)) {
                    $thongbaomatkhau = "<p style='color: red;font-weight: bold;'>Mật khẩu cần chứa ít nhất một ký tự viết hoa và một chữ số!</p>";
                } else {
                    // nếu check lỗi không sai thì đưa vào db để kiểm tra
                    $data = check_login($taikhoan, $matkhau);
                    if ($data) {
                        $_SESSION['user'] = $data;
                        $logged_in_user_id = $_SESSION['user']['id'];
                        if (isset($_SESSION['giohang']) && isset($_SESSION['user']['id'])) {
                            foreach ($_SESSION['giohang'] as $item) {
                                if ($logged_in_user_id === $item['iduser']) {
                                    $_SESSION['user']['giohang'] = $_SESSION['giohang'];
                                    break;
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
            $isValidData = true;
            // lấy dữ liệu từ form bên view về
            if (isset($_POST['btn_signup'])) {
                $tennguoidung = $_POST['tennguoidung'];
                $taikhoan = $_POST['taikhoan'];
                $matkhau = $_POST['matkhau'];
                $nhaplaimatkhau = $_POST['nhaplaimatkhau'];
                $thongbaotennguoidung = '';
                $thongbaotaikhoan = '';
                $thongbaomatkhau = '';
                $thongbaonhaplaimatkhau = '';
                if (empty($tennguoidung)) {
                    $thongbaotennguoidung .= "<p style='color: red;font-weight: bold;'>Tên người dùng không được để trống!</p>";
                    $isValidData = false;
                } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $tennguoidung)) {
                    $thongbaotennguoidung .= "<p style='color: red;font-weight: bold;'>Tên người dùng không được chứa ký tự đặc biệt!</p>";
                    $isValidData = false;
                }
                if (empty($taikhoan)) {
                    $thongbaotaikhoan .= "<p style='color: red;font-weight: bold;'>Tài khoản không được để trống!</p>";
                    $isValidData = false;
                } elseif (strlen($taikhoan) < 5 && preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $taikhoan)) {
                    $thongbaotaikhoan .= "<p style='color: red;font-weight: bold;'>Tài khoản phải có ít nhất 5 ký tự và không chứa ký tự đặc biệt!!</p>";
                    $isValidData = false;
                } elseif (strlen($taikhoan) < 5) {
                    $thongbaotaikhoan .= "<p style='color: red;font-weight: bold;'>Tài khoản phải có ít nhất 5 ký tự!!</p>";
                    $isValidData = false;
                } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $taikhoan)) {
                    $thongbaotaikhoan .= "<p style='color: red;font-weight: bold;'>Tài khoản không được chứa ký tự đặc biệt!</p>";
                    $isValidData = false;
                }
                if (empty($matkhau)) {
                    $thongbaomatkhau .= "<p style='color: red;font-weight: bold;'>Mật khẩu không được để trống!</p>";
                    $isValidData = false;
                } elseif (!preg_match('/[A-Z]/', $matkhau) || !preg_match('/[0-9]/', $matkhau)) {
                    $thongbaomatkhau .= "<p style='color: red;font-weight: bold;'>Mật khẩu cần chứa ít nhất một ký tự viết hoa và một chữ số!</p>";
                    $isValidData = false;
                }
                if (empty($nhaplaimatkhau)) {
                    $thongbaonhaplaimatkhau .= "<p style='color: red;font-weight: bold;'>Nhập lại mật khẩu không được để trống!</p>";
                    $isValidData = false;
                } elseif ($kmathau !== $nhaplaimatkhau) {
                    $thongbaonhaplaimatkhau .= "<p style='color: red;font-weight: bold;'>Mật khẩu nhập lại không đúng!</p>";
                    $isValidData = false;
                }
                // Kiểm tra biến cờ trước khi thêm dữ liệu vào cơ sở dữ liệu
                if ($isValidData == true) {
                    $signup_result = check_signup($tennguoidung, $taikhoan, $matkhau);
                    if ($signup_result === false) {
                        $thongbao = "<p style='color: red;font-weight: bold;'>Tài khoản đã tồn tại!</p>";
                    } else {
                        header('Location: index.php?page=login');
                        exit; // Dừng kịch bản tiếp theo
                    }
                }
            }
            include_once 'view/signup.php';
            break;

        case 'thankyou':
            include_once 'view/thankyou.php';
            break;

        case 'checkout':
            if (isset($_SESSION['user'])) {
                $iduser = $_SESSION['user']['id'];
                $infousercheckout = infousercheckout($iduser);
            }
            // Trong phần xử lý khi người dùng nhấn nút "APPLY"
            if (isset($_POST['btn_voucher'])) {
                $_SESSION['voucher'] = isset($_POST['voucher']) ? $_POST['voucher'] : '';
                if (!empty($_SESSION['voucher'])) {
                    $valid_voucher = check_voucher($_SESSION['voucher']);
                    if ($valid_voucher) {
                        $phantramgiam = phantramgiam($_SESSION['voucher']);
                        $tongtien = tongdonhang(); // Lấy tổng số tiền đơn hàng
                        $daxaivoucher = ($tongtien * (int)$phantramgiam['phan_tram_giam']) / 100; // Tính toán số tiền được giảm
                        // Lưu giá trị giảm giá vào session
                        $_SESSION['daxaivoucher'] = $daxaivoucher;
                        $_SESSION['phantramgiam'] = (($tongtien - $_SESSION['daxaivoucher']) / $tongtien) * 100;
                        // Lấy ID của voucher từ mã voucher
                    } else {
                        $error_message = "<p style='color: red'>Mã code bạn nhập không hợp lệ!!!</p>";
                    }
                }
            }
            if (isset($_POST['btn_place_order'])) {
                if (empty($_SESSION['user']['giohang'])) {
                    $thongbaocod = "<p style='color: red;font-weight: bold;font-size: 12px;'>Bạn phải mua ít nhất 1 sản phẩm để có thể thanh toán</p>";
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
                insert_donhang($idnguoidung, $tongtien, $firstname, $deliveryaddress, $email, $phone, $voucher_use, $payment_method);
                unset($_SESSION['voucher']);
                unset($_SESSION['daxaivoucher']);
                unset($_SESSION['phantramgiam']);
                $id = $_SESSION['user']['id'];
                $infousercheckout = infousercheckout($id);
                $order_info = get_order_information($id);
                header('Location: index.php?page=thankyou');
                include_once 'view/mail.php';
                $iddonhang = iddonhang($id)['id'];
                foreach ($_SESSION['user']['giohang'] as $item) {
                    $soluong = $item['soluong'];
                    $masanpham = $item['id'];
                    $dongia = $item['gia_san_pham'] * $item['soluong'];
                    insert_chitietdonhang($masanpham, $dongia, $soluong, $iddonhang);
                }
                unset($_SESSION['user']['giohang']);
                unset($_SESSION['giohang']);
            }
            if (isset($_POST['redirect'])) {
                if (empty($_SESSION['user']['giohang'])) {
                    $thongbaovnpay = "<p style='color: red;font-weight: bold;font-size: 12px;'>Bạn phải mua ít nhất 1 sản phẩm để có thể thanh toán</p>";
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
                insert_donhang($idnguoidung, $tongtien, $firstname, $deliveryaddress, $email, $phone, $voucher_use, $payment_method);
                unset($_SESSION['voucher']);
                unset($_SESSION['daxaivoucher']);
                unset($_SESSION['phantramgiam']);
                unset($_SESSION['user']['giohang']);
                unset($_SESSION['giohang']);
                $id = $_SESSION['user']['id'];
                $infousercheckout = infousercheckout($id);
                $order_info = get_order_information($id);
                include_once 'view/vnpay.php';
                include_once 'view/mail.php';

                $iddonhang = iddonhang($id)['id'];
                foreach ($_SESSION['user']['giohang'] as $item) {
                    $soluong = $item['soluong'];
                    $masanpham = $item['id'];
                    $dongia = $item['gia_san_pham'] * $item['soluong'];
                    insert_chitietdonhang($masanpham, $dongia, $soluong, $iddonhang);
                }
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
            if (isset($_SESSION['user']['id'])) {
                $id = $_SESSION['user']['id'];
                $showinfo = showinfo($id);
            }
            $order = order();
            include_once 'view/order.php';
            break;

        case 'orderdel':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                orderdel($id);
            }
            if (isset($_SESSION['user']['id'])) {
                $id = $_SESSION['user']['id'];
                $showinfo = showinfo($id);
            }
            $order = order();
            include_once 'view/order.php';
            break;

        case 'orderdetail':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $orderdetail = orderdetail($id);
            }
            include_once 'view/orderdetail.php';
            break;

        case 'info':
            if (isset($_SESSION['user']['id'])) {
                $id = $_SESSION['user']['id'];
                $showinfo = showinfo($id);
            }
            include_once 'view/info.php';
            break;

        case 'updateinfo':
            $isValidData = true;
            if (isset($_POST['btn_update'])) {
                $thongbaoemail = "";
                $thongbaodiachi = "";
                $thongbaosodienthoai = "";
                // Lấy thông tin từ $_POST
                $username = $_POST['username'];
                $account = $_POST['account'];
                $password = $_POST['password'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $id = $_POST['id']; // Lấy ID từ trường input ẩn
                $avatar = $_FILES['avatar']['name'];
                // Kiểm tra từng trường dữ liệu và không được để trống
                if (empty($username)) {
                    $thongbaotennguoidung .= "<p style='color:red;'>Tên người dùng không được để trống.</p>";
                    $isValidData = false;
                }
                if (empty($account)) {
                    $thongbaotaikhoan .= "<p style='color:red;'>Tài khoản không được để trống.</p>";
                    $isValidData = false;
                }
                if (empty($password)) {
                    $thongbaomatkhau .= "<p style='color:red;'>Mật khẩu không được để trống.</p>";
                    $isValidData = false;
                }
                if (empty($email)) {
                    $thongbaoemail .= "<p style='color:red;'>Email không được để trống.</p>";
                    $isValidData = false;
                } elseif (!preg_match('/^\S+@\S+\.\S+$/', $email)) {
                    $thongbaoemail .= "<p style='color:red;'>Email không hợp lệ.</p>";
                    $isValidData = false;
                }
                if (empty($address)) {
                    $thongbaodiachi .= "<p style='color:red;'>Địa chỉ không được để trống.</p>";
                    $isValidData = false;
                } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $address)) {
                    $thongbaodiachi .= "<p style='color: red;font-weight: bold;'>Tên người dùng không được chứa ký tự đặc biệt!</p>";
                    $isValidData = false;
                }
                if (empty($phone)) {
                    $thongbaosodienthoai .= "<p style='color:red;'>Số điện thoại không được để trống.</p>";
                    $isValidData = false;
                } elseif (!preg_match('/^\d{10,11}$/', $phone)) {
                    $thongbaosodienthoai .= "<p style='color:red;'>Số điện thoại phải có đúng 10 hoặc 11 số.</p>";
                    $isValidData = false;
                }
                // Nếu dữ liệu hợp lệ, tiến hành cập nhật thông tin và upload ảnh
                if ($isValidData) {
                    if ($avatar != "") {
                        // Upload hình ảnh
                        $target_file = PATH_IMG_USER . $avatar; // uploads/anime.png
                        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
                    } else {
                        $avatar = ""; // Nếu không có ảnh được chọn, gán giá trị rỗng
                    }
                    updateinfo($avatar, $username, $account, $password, $email, $address, $phone, $id);
                    header('Location: index.php?page=info');
                    exit();
                } else {
                    // Hiển thị form thông tin và thông báo lỗi
                    include_once 'view/info.php';
                }
            } else {
                // Nếu không có dữ liệu được gửi từ form, hiển thị form thông tin mà không có thông báo lỗi
                include_once 'view/info.php';
            }
            break;

        case 'voucherdelete':
            if (isset($_SESSION['user'])) {
                $iduser = $_SESSION['user']['id'];
                $infousercheckout = infousercheckout($iduser);
            }
            if (isset($_SESSION['daxaivoucher']) && isset($_SESSION['phantramgiam'])) {
                unset($_SESSION['daxaivoucher']);
                unset($_SESSION['phantramgiam']);
                if (isset($_SESSION['voucher'])) {
                    back_voucher($_SESSION['voucher']);
                    unset($_SESSION['voucher']);
                }
                header('Location: index.php?page=checkout');
                exit; // Đảm bảo không có mã HTML hoặc mã PHP nào được thực thi sau khi chuyển hướng.
            }
            include_once 'view/checkout.php';
            break;


            // làm admin 

        case 'admin':
            $adminuserlist = adminuserlist();
            $adminuserhome = adminuserhome();
            $adminorder = adminorder();
            $tongdonhang = tongdonhangadmin();
            $tongsanpham = tongsanphamadmin();
            $tongdanhmuc = tongdanhmucadmin();
            $tongthanhvien = tongthanhvienadmin();
            include_once "view/adminhome.php";
            break;

        case 'adminsanphamlist':
            $adminsanphamlist = adminsanphamlist();
            include_once "view/adminsanphamlist.php";
            break;
        case 'adminbinhluanlist':
            $adminbinhluanlist = adminbinhluanlist();
            include_once "view/adminbinhluanlist.php";
            break;
        case 'adminuserlist':
            $adminuserlist = adminuserlist();
            include_once "view/adminuserlist.php";
            break;

        case 'admincatalog':
            $admincatalog = admincatalog();
            include_once "view/admincatalog.php";
            break;

        case 'adminorder':
            $adminorder = adminorder();
            include_once "view/adminorder.php";
            break;

        case 'sanphamadd':
            $admincatalog = admincatalog();
            include_once "view/adminaddproduct.php";
            break;

        case 'adminaddproduct':
            $thongbaotensanpham = "";
            $thongbaonhapgiasanpham = ""; // Khai báo biến thông báo
            $thongbaonhapmotasanpham = "";
            $thongbaoiddm = "";
            if (isset($_POST['addproduct'])) {
                $isValidData = true;
                // Lấy dữ liệu từ form
                $name = $_POST['name'];
                $price = $_POST['price'];
                $iddm = $_POST['iddm'];
                $img = $_FILES['img']['name'];
                $description = $_POST['description'];
                // Kiểm tra form
                if (empty($name)) {
                    $thongbaotensanpham .= "<p style='color:red; font-weight:bold;'>Tên sản phẩm không được để trống</p>";
                    $isValidData = false;
                } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name)) {
                    $thongbaotensanpham .= "<p style='color: red;font-weight: bold;'>Tên sản phẩm không được chứa ký tự đặc biệt!</p>";
                    $isValidData = false;
                }
                if (empty($price)) {
                    $thongbaonhapgiasanpham .= "<p style='color:red; font-weight:bold;'>Giá phẩm không được để trống</p>";
                    $isValidData = false;
                } elseif (!is_numeric($price)) {
                    $thongbaonhapgiasanpham .= "<p style='color: red;font-weight: bold;'>Giá sản phẩm chỉ được chứa số</p>";
                    $isValidData = false;
                }
                if ($iddm == 0) {
                    $thongbaoiddm .= "<p style='color:red; font-weight:bold;'>Phải chọn 1 danh mục</p>";
                    $isValidData = false;
                }
                if (strlen($description) < 15) {
                    $thongbaonhapmotasanpham .= "<p style='color: red;font-weight: bold;'>Mô tả sản phẩm phải chứa ít nhất 15 ký tự </p>";
                    $isValidData = false;
                }
                if ($isValidData) {
                    // Thực hiện insert sản phẩm vào database
                    sanpham_insert($name, $price, $iddm, $img, $description);
                    // Upload hình ảnh
                    $target_file = PATH_IMG_USER . $img;
                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                    // Chuyển hướng về trang danh sách sản phẩm sau khi thêm
                    header("Location: index.php?page=adminsanphamlist");
                    exit(); // Dừng việc thực thi mã ngay tại đây sau khi header đã được gửi
                }
            }
            // Nếu không có dữ liệu được gửi từ form, hiển thị form để thêm sản phẩm
            $admincatalog = admincatalog();
            include_once "view/adminaddproduct.php";
            break;

        case 'delproduct':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $img = PATH_IMG_USER . get_img($id)['hinh_san_pham'];
                // var_dump($img);
                if (is_file($img)) {
                    unlink($img);
                }
                try {
                    // Gọi hàm xóa sản phẩm
                    sanpham_delete($id);
                } catch (\Throwable $th) {
                    echo ("Khong duoc xoa!");
                }
                $adminsanphamlist = adminsanphamlist();
                include_once "view/adminsanphamlist.php";
            } else {
                $admincatalog = admincatalog();
                include_once "view/adminaddproduct.php";
            }
            break;
        case 'updateproduct':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $sp = product_select_one($id);
            }
            $admincatalog = admincatalog();
            if (isset($_POST['updateproduct'])) {
                $isValidData = true;
                $name = $_POST['name'];
                $price = $_POST['price'];
                $idcatalog = $_POST['iddm'];
                $id = $_POST['id'];
                $description = $_POST['description'];
                $img = $_FILES['img']['name'];
                // kiem tra loi form 
                $thongbaotensanpham = "";
                $thongbaogiasanpham = "";
                $thongbaomota = "";
                $thongbaoiddm = "";

                if (empty($name)) {
                    $thongbaotensanpham .= "<p style='color:red; font-weight:bold;'>Tên sản phẩm không được để trống</p>";
                    $isValidData = false;
                } elseif (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name)) {
                    $thongbaotensanpham .= "<p style='color: red;font-weight: bold;'>Tên sản phẩm không được chứa ký tự đặc biệt!</p>";
                    $isValidData = false;
                }
                if (empty($price)) {
                    $thongbaogiasanpham .= "<p style='color:red; font-weight:bold;'>Giá phẩm không được để trống</p>";
                    $isValidData = false;
                } elseif (!is_numeric($price)) {
                    $thongbaogiasanpham .= "<p style='color: red;font-weight: bold;'>Giá sản phẩm chỉ được chứa số</p>";
                    $isValidData = false;
                }
                if ($idcatalog == 0) {
                    $thongbaoiddm .= "<p style='color:red; font-weight:bold;'>Phải chọn 1 danh mục</p>";
                    $isValidData = false;
                }
                if (empty($description)) {
                    $thongbaomota .= "<p style='color:red; font-weight:bold;'>Không được để trống</p>";
                    $isValidData = false;
                } elseif (strlen($description) < 15) {
                    $thongbaomota .= "<p style='color: red;font-weight: bold;'>Mô tả sản phẩm phải chứa ít nhất 15 ký tự </p>";
                    $isValidData = false;
                }
                if ($isValidData) {
                    if ($img != "") {
                        //upload hinh anh
                        $targtet_file = PATH_IMG_USER . $img;
                        move_uploaded_file($_FILES["img"]["tmp_name"], $targtet_file);
                    } else {
                        $img = "";
                    }
                    //insert into
                    sanpham_update($name, $price, $idcatalog, $img, $description, $id);
                    header("location:  index.php?page=adminsanphamlist");
                } else {
                    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                        $id = $_GET['id'];
                        $sp = product_select_one($id);
                    }
                    include_once  "view/adminuploadproduct.php";
                }
            }
            include_once  "view/adminuploadproduct.php";
            break;

            //// nguoi dung 
            // them nguoi dung 
        case 'nguoidungadd':
            include_once "view/adminadduser.php";
            break;

        case 'adminadduser':
            $thongbaotentaikhoan = "";
            $thongbaomatkhau = "";
            $thongbaotennguoidung = "";
            $thongbaoemail = "";
            $thongbaosdt = "";
            $thongbaodiachi = "";
            if (isset($_POST['adduser'])) {

                $isValidData = true;
                // Lấy dữ liệu về
                $accout = $_POST['accout'];
                $pass = $_POST['pass'];
                $nameuser = $_POST['nameuser'];
                $img = $_FILES['img']['name'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];

                // Kiểm tra form
                if (empty($accout)) {
                    $thongbaotentaikhoan .= "<p style='color: red;font-weight: bold;'>Tài khoản không được để trống!</p>";
                    $isValidData = false;
                } elseif (strlen($accout) < 5 || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accout)) {
                    $thongbaotentaikhoan .= "<p style='color: red;font-weight: bold;'>Tài khoản phải có ít nhất 5 ký tự và không chứa ký tự đặc biệt!</p>";
                    $isValidData = false;
                }

                if (empty($pass)) {
                    $thongbaomatkhau .= "<p style='color: red;font-weight: bold;'>Mật khẩu không được để trống!</p>";
                    $isValidData = false;
                } elseif (!preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass)) {
                    $thongbaomatkhau .= "<p style='color: red;font-weight: bold;'>Mật khẩu cần chứa ít nhất một ký tự viết hoa và một chữ số!</p>";
                    $isValidData = false;
                }
                if (empty($nameuser)) {
                    $thongbaotennguoidung .= "<p style='color: red;font-weight: bold;'>Tên người dùng không được để trống!</p>";
                    $isValidData = false;
                } elseif (strlen($nameuser) < 5) {
                    $thongbaotennguoidung .= "<p style='color: red;font-weight: bold;'>Tên người dùng chứa ít nhất 5 kí tự!</p>";
                    $isValidData = false;
                }
                if (empty($phone)) {
                    $thongbaosdt .= "<p style='color: red;font-weight: bold;'>Số điện thoại không được để trống!</p>";
                    $isValidData = false;
                } elseif (strlen($phone) < 10 || strlen($phone) > 11 || !is_numeric($phone)) {
                    $thongbaosdt .= "<p style='color: red;font-weight: bold;'>Số điện thoại phải chứa 10 hoặc 11 số và chỉ được chứa ký tự số!</p>";
                    $isValidData = false;
                }
                if (empty($email)) {
                    $thongbaoemail .= "<p style='color: red;font-weight: bold;'>Email không được để trống!</p>";
                    $isValidData = false;
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $thongbaoemail .= "<p style='color: red;font-weight: bold;'>Email không hợp lệ!</p>";
                    $isValidData = false;
                }
                if (empty($address)) {
                    $thongbaodiachi .= "<p style='color: red;font-weight: bold;'>Địa chỉ không được để trống!</p>";
                    $isValidData = false;
                }
                if ($isValidData) {
                    // Insert vào cơ sở dữ liệu
                    user_insert($accout, $pass, $nameuser, $img, $phone, $email, $address);
                    // Upload hình ảnh
                    $targtet_file = PATH_IMG_USER . $img;
                    move_uploaded_file($_FILES["img"]["tmp_name"], $targtet_file);
                    // Chuyển hướng trở lại danh sách người dùng
                    $adminuserlist = adminuserlist();
                    header("Location: index.php?page=adminuserlist");
                    exit();
                } else {
                    include_once "view/adminadduser.php";
                }
            } else {
                include_once "view/adminadduser.php";
            }
            break;
            // xoa nguoi dung 
        case 'deluser':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $img = PATH_IMG_USER . get_anh_user($id)['anh'];
                if (is_file($img)) {
                    unlink($img);
                }
                try {
                    // Gọi hàm xóa sản phẩm
                    user_delete($id);
                } catch (\Throwable $th) {
                    echo ("Khong duoc xoa!");
                }
                $adminuserlist = adminuserlist();
                include_once "view/adminuserlist.php";
            } else {
                include_once "view/adminadduser.php";
            }
            break;

            // upload user chuyen trang
        case 'nguoidungupload':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $user = user_select_one($id);
            }
            if (isset($_POST['uploaduser'])) {
                $isValidData = true;
                $accout = $_POST['accout'];
                $pass = $_POST['pass'];
                $id = $_POST['id'];
                $address = $_POST['address'];
                $nameuser = $_POST['nameuser'];
                $img = $_FILES['img']['name'];
                // bat loi form
                $thongbaotentaikhoan = "";
                $thongbaomatkhau = "";
                $thongbaodiachi = "";
                $thongbaonameuser = "";
                if (empty($accout)) {
                    $thongbaotentaikhoan .= "<p style='color: red;font-weight: bold;'>Tài khoản không được để trống!</p>";
                    $isValidData = false;
                } elseif (strlen($accout) < 5 || preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $accout)) {
                    $thongbaotentaikhoan .= "<p style='color: red;font-weight: bold;'>Tài khoản phải có ít nhất 5 ký tự và không chứa ký tự đặc biệt!</p>";
                    $isValidData = false;
                }
                if (empty($pass)) {
                    $thongbaomatkhau .= "<p style='color: red;font-weight: bold;'>Mật khẩu không được để trống!</p>";
                    $isValidData = false;
                } elseif (!preg_match('/[A-Z]/', $pass) || !preg_match('/[0-9]/', $pass)) {
                    $thongbaomatkhau .= "<p style='color: red;font-weight: bold;'>Mật khẩu cần chứa ít nhất một ký tự viết hoa và một chữ số!</p>";
                    $isValidData = false;
                }
                if (empty($nameuser)) {
                    $thongbaonameuser .= "<p style='color: red;font-weight: bold;'>Tên người dùng không được để trống!</p>";
                    $isValidData = false;
                } elseif (strlen($nameuser) < 5) {
                    $thongbaonameuser .= "<p style='color: red;font-weight: bold;'>Tên người dùng chứa ít nhất 5 kí tự!</p>";
                    $isValidData = false;
                }
                if (empty($address)) {
                    $thongbaodiachi .= "<p style='color: red;font-weight: bold;'> Địa chỉ không được để trống!</p>";
                    $isValidData = false;
                }
                if ($isValidData) {
                    if ($img != "") {
                        //upload hinh anh
                        $targtet_file = PATH_IMG_USER . $img;
                        move_uploaded_file($_FILES["img"]["tmp_name"], $targtet_file);
                    } else {
                        $img = "";
                    }
                    //insert into
                    user_update($accout, $pass, $address, $img, $nameuser, $id);

                    header("location:  index.php?page=adminuserlist");
                } else {
                    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                        $id = $_GET['id'];
                        $user = user_select_one($id);
                    }
                    include_once  "view/adminuploaduser.php";
                }
            }
            include_once  "view/adminuploaduser.php";
            break;

        case 'danhmucadd':
            include_once "view/adminadddanhmuc.php";
            break;

        case 'adminadddanhmucadd':
            if (isset($_POST['addanhmuc'])) {
                $thongbaotendanhmuc = "";
                $isValidData = true;
                //Lay du lieu ve
                $ten_danh_muc = $_POST['tendanhmuc'];
                echo "$ten_danh_muc";
                $img = $_FILES['img']['name'];
                if (empty($ten_danh_muc)) {
                    $thongbaotendanhmuc .= "<p style='color: red;font-weight: bold;'> Tên danh mục không được để trống!</p>";
                    $isValidData = false;
                }
                if ($isValidData) {  //insert into 
                    category_insert($ten_danh_muc, $img);
                    // echo"$iddm";
                    //upload hinh anh
                    $targtet_file = PATH_IMG_USER . $img;
                    move_uploaded_file($_FILES["img"]["tmp_name"], $targtet_file);
                    //tro ve dssp
                    $admincatalog = admincatalog();
                    header("Location: index.php?page=admincatalog");
                } else {
                    include_once "view/adminadddanhmuc.php";
                }
            } else {
                include_once "view/adminadddanhmuc.php";
            }
            break;

        case 'deldanhmuc':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $img_path = PATH_IMG_USER . get_anh_danhmuc($id)['anh_danh_muc'];
                // Kiểm tra xem hình ảnh đang được sử dụng bởi danh mục khác không
                $other_categories = get_danhmuc_by_image($img_path, $id);
                var_dump($orther_categories);
                // Nếu không có danh mục nào sử dụng hình ảnh này, thì mới thực hiện xóa
                if (empty($other_categories)) {
                    // Kiểm tra xem tệp hình ảnh tồn tại trước khi xóa
                    if (is_file($img_path)) {
                        // Thực hiện xóa hình ảnh
                        unlink($img_path);
                    }
                    try {
                        // Gọi hàm xóa danh mục
                        danhmuc_delete($id);
                    } catch (\Throwable $th) {
                        echo ("Không thể xóa!");
                    }
                } else {
                    // Nếu hình ảnh được sử dụng bởi danh mục khác, không thực hiện xóa
                    echo "Hình ảnh đang được sử dụng bởi danh mục khác. Bạn cần xóa các danh mục này trước.";
                }
                // Cập nhật lại danh sách danh mục sau khi xóa
                $admincatalog = admincatalog();
                include_once "view/admincatalog.php";
            } else {
                include_once "view/adminadddanhmuc.php";
            }
            break;

            //update danh muc 
        case 'fixdanhmuc':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $danhmuc = danhmuc_select_one($id);
            }
            if (isset($_POST['uploaddanhmuc'])) {
                $isValidData = true;
                $category = $_POST['category'];
                $id = $_POST['id'];
                $img = $_FILES['img']['name'];
                //kiem tra loi form  
                $thongbaotendanhmuc = "";
                if (empty($category)) {
                    $thongbaotendanhmuc .= "<p style='color: red;font-weight: bold;'> Tên danh mục không được để trống!</p>";
                    $isValidData = false;
                }
                if ($isValidData) {
                    // Kiểm tra xem có hình ảnh được tải lên không
                    if ($img != "") {
                        // Tạo tên file mới nếu tên trùng lặp
                        $target_file = PATH_IMG_USER . $img;
                        // Di chuyển hình ảnh vào thư mục đích
                        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                    } else {
                        $img = "";
                    }
                    // Cập nhật thông tin danh mục
                    danhmuc_update($category, $img, $id);
                    header("location:  index.php?page=admincatalog");
                } else {
                    if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                        $id = $_GET['id'];
                        $danhmuc = danhmuc_select_one($id);
                    }
                    include_once  "view/adminuploaddanhmuc.php";
                }
            }
            include_once "view/adminuploaddanhmuc.php";
            break;

        case 'orderstatus':
            if (isset($_POST['btn_orderstatus'])) {
                $id = $_POST['id'];
                $orderstatus = $_POST['orderstatus'];
            }
            capnhattrangthai($orderstatus, $id);
            $adminorder = adminorder();
            include_once "view/adminorder.php";
            break;
        case 'adminorderdel':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $adminorder = adminorderdel($id);
            }
            $adminorder = adminorder();
            include_once "view/adminorder.php";
            break;
        case 'delbinhluan':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $id = $_GET['id'];
                $adminbinhluanlist = binhluan_delete($id);
            }
            $adminbinhluanlist = adminbinhluanlist();
            include_once "view/adminbinhluanlist.php";
            break;
        default:
            $dssp_view = product_view(10);
            $dssp = product_all_limit(10, 0, 0, "", "");
            $category = category_all();
            include_once 'view/home.php';
            break;
    }
} else {
    $dssp_view = product_view(10);
    $dssp = product_all_limit(10, 0, 0, "", "");
    $category = category_all();
    include_once 'view/home.php';
}

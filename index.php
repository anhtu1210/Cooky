<!-- Controller user-->
<?php
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

include("model/pdo.php");
include("global.php");
include("model/taikhoan.php");
include("model/loai.php");
include("model/hang-hoa.php");
include("model/product.php");
include("model/comment.php");
include("model/cart.php");
include("view/header-site.php");
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

$listdanhmuc = loadall_danhmuc_trangchu();
$listdanhmuc_all = loadall_danhmuc();
$newProductList = hang_hoa_select_moi_nhat("created_at", 12);
$topViewProductList = hang_hoa_select_moi_nhat("luotxem", 12);

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        case 'order-history':
            $list_bill = bill_select_all($_SESSION['user']['id']);
            include("view/cart/order-history.php");
            break;
        case 'product':
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
                if ($category_id == 1) {
                    $categoryDetail['name'] = 'Tất cả';
                    $productList = hang_hoa_select_all_no_param();
                    include("view/product-list.php");
                } elseif ($category_id > 0) {
                    $categoryDetail = loadone_danhmuc($category_id);
                    $productList = hang_hoa_select_all("", $category_id);
                    include("view/product-list.php");
                }
            } else {
                include("view/home-page.php");
            }
            break;
        case 'product-detail':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                $productDetail = product_select_by_id($id);
                if ($productDetail) {
                    extract($productDetail);
                    $categoryDetail = loadone_danhmuc($iddm); // Sửa tham số truyền vào từ $id thành $iddm
                    $productRelated = related_products($id, $iddm);
                    $list_comment = comment_select_all($id);
                    include("view/product-detail.php");
                } else {
                    include("view/home-page.php"); // Sửa đường dẫn từ site/home-page.php thành view/home-page.php
                }
            } else {
                include("view/home-page.php");
            }
            break;

        case 'checkout':
            include("view/cart/checkout.php");
            break;
        case 'login':
            if (isset($_POST['dangnhap']) && ($_POST['dangnhap'])) {
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                $thongbao_user = ""; // Khởi tạo thông báo lỗi cho tên người dùng
                $thongbao_pass = ""; // Khởi tạo thông báo lỗi cho mật khẩu

                if (isset($_POST['dangnhap'])) {
                    $user = $_POST['user'];
                    $pass = $_POST['pass'];
                    // Kiểm tra trường tên người dùng
                    if (empty($user)) {
                        $thongbao_user = "Tên người dùng không được bỏ trống!";
                    }
                    // Kiểm tra trường mật khẩu
                    if (empty($pass)) {
                        $thongbao_pass = "Mật khẩu không được bỏ trống";
                    } elseif (strlen($pass) < 6) {
                        $thongbao_pass = "Mật khẩu phải chứa ít nhất 6 ký tự";
                    }
                    // Nếu cả hai trường đều không rỗng, tiến hành kiểm tra người dùng
                    if (!empty($user) && !empty($pass) && strlen($pass) >= 6) {
                        // Tiếp tục kiểm tra người dùng
                        // Đặt mã kiểm tra người dùng ở đây
                        $checkuser = checkuser($user, $pass);
                        if (is_array($checkuser)) {
                            $_SESSION['user'] = $checkuser;
                            header('Location: index.php');
                            exit;
                        } else {
                            $thongbao = "Đăng nhập thất bại. Vui lòng kiểm tra lại hoặc điền email đăng ký để lấy lại mật khẩu!";
                        }
                    }
                }
            }
            include "view/auth/login.php";
            break;
        case 'register':
            if (isset($_POST['dangky']) && ($_POST['dangky'])) {
                $email = $_POST['email'];
                $user = $_POST['user'];
                $pass = $_POST['pass'];

                $thongbao_user = ""; // Khởi tạo thông báo lỗi cho tên người dùng
                $thongbao_pass = ""; // Khởi tạo thông báo lỗi cho mật khẩu
                $thongbao_email = ""; // Khởi tạo thông báo lỗi cho mật khẩu
                if (empty($user)) {
                    $thongbao_user = "Tên người dùng không được bỏ trống!";
                } else {
                    $user_exists = kiem_tra_nguoi_dung_ton_tai($user);
                    if ($user_exists) {
                        $thongbao_user = "Tên người dùng đã tồn tại!";
                    }
                }
                if (empty($pass) || strlen($pass) < 6) {
                    $thongbao_pass = "Mật khẩu không được bỏ trống và >= 6 kí tự!";
                }
                if (empty($email)) {
                    $thongbao_email .= "Vui lòng nhập email!";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $thongbao_email .= "Email không hợp lệ!";
                }
                if (!empty($user) && !empty($pass) && strlen($pass) >= 6 && !empty($email) && !$user_exists) {
                    insert_taikhoan($email, $user, $pass);
                    $thongbao = "Đã đăng ký thành công. Vui lòng đăng nhập!";
                }
            }

            include "view/auth/register.php";
            break;
        case 'profile-edit':
            // Validate form profile-edit
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['username'] = isset($_POST['username']) ? $_POST['username'] : "";
                $data['email'] = isset($_POST['email']) ? $_POST['email'] : "";
                $data['address'] = isset($_POST['address']) ? $_POST['address'] : "";
                $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : "";
                // Validate username
                if (empty($data['username'])) {
                    $error['username'] = "* Tên người dùng không được để trống";
                }
                // Validate email
                if (empty($data['email'])) {
                    $error['email'] = "* Email không được để trống";
                } else if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $data['email'])) {
                    $error['email'] = '* Vui lòng nhập lại, email không đúng định dạng';
                }
                // Validate address
                if (empty($data['address'])) {
                    $error['address'] = "* Địa chỉ người dùng không được để trống";
                }
                // Validate phone
                if (empty($data['phone'])) {
                    $error['phone'] = "* Số điện thoại không được để trống";
                } else if (!preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $data['phone'])) {
                    $error['phone'] = 'Vui lòng nhập lại, số điện thoại không đúng định dạng';
                }
                if (!$error) {
                    $id = $_POST['id'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $phone = $_POST['phone'];

                    $image = $_FILES['image']['name'];
                    $target_dir = "./upload/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    account_update($id, $username, $email, $phone, $address, $image);
                    $message_success = "Cập nhật thông tin thành công";
                    $_SESSION['user'] = taikhoan_select_by_id($id);
                    header('Location: index.php?act=edit_taikhoan');
                    exit;
                }
            }
            include("view/auth/profile-edit.php");
            break;
        case 'forgot-password':
            // Validate form forgot-password
            $error = [];
            $data = [];

            if (isset($_POST['submit'])) {
                $data['email'] = isset($_POST['email']) ? $_POST['email'] : "";

                // Validate email
                if (empty($data['email'])) {
                    $error['email'] = "* Email không được để trống";
                } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $error['email'] = '* Vui lòng nhập lại, email không đúng định dạng';
                } elseif (!account_exist($data['email'])) {
                    $error['email'] = "* Email chưa được đăng ký thành viên";
                }

                // Nếu không có lỗi
                if (empty($error)) {
                    $email = $_POST['email'];
                    $resetCode = substr(md5(rand(100000, 999999)), 0, 10); // Tạo mã reset ngẫu nhiên
                    reset_code_update($resetCode, $email); // Cập nhật mã reset trong cơ sở dữ liệu

                    // Gửi email và kiểm tra kết quả
                    $emailSent = user_send_reset_password($email, $resetCode);
                    if ($emailSent) {
                        // Lưu thông tin trong phiên và chuyển hướng
                        $_SESSION['email'] = $email;
                        $_SESSION['reset_code'] = $resetCode;
                        header('Location: index.php?act=reset-code');
                        exit();
                    } else {
                        $message_error = "Có lỗi xảy ra khi gửi email.";
                    }
                }
            }
            include "view/auth/forgot-password.php";
            break;
        case 'reset-code':
            // Validate form reset-code
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['resetCode'] = isset($_POST['resetCode']) ? $_POST['resetCode'] : "";
                if (empty($data['resetCode'])) {
                    $error['resetCode'] = "* Mã xác nhận không được để trống";
                } else if ($_POST['resetCode'] != $_SESSION['reset_code']) {
                    $error['resetCode'] = "* Mã xác nhận không chính xác";
                }
                if (!$error) {
                    header('Location: index.php?act=reset-password');
                    exit();
                }
            }
            include "view/auth/reset-code-form.php";
            break;
            // Đặt lại mật khẩu
        case 'reset-password':
            // Validate form reset-password
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['newPassword'] = isset($_POST['newPassword']) ? $_POST['newPassword'] : "";
                // Validate password
                if (empty($data['newPassword'])) {
                    $error['newPassword'] = "* Mật khẩu không được để trống";
                } else if (strlen($data['newPassword']) < 6) {
                    $error['newPassword'] = "* Mật khẩu phải có ít nhất 6 ký tự";
                }
                if (!$error) {
                    $email = $_SESSION['email'];
                    $newPassword = $_POST['newPassword'];
                    password_update($newPassword, $email);
                    $message_success = "Cập nhật mật khẩu thành công";
                    // Remove $_SESSION after completion
                    unset($_SESSION['email']);
                    unset($_SESSION['reset_code']);
                }
            }
            include "view/auth/reset-password-form.php";
            break;
        case 'logout':
        case 'thoat':
            session_unset();
            header('Location: index.php');
            include "view/login.php";
            break;
        case 'form_account':
            include("view/auth/form_account.php");
            break;
        case 'add-comment':
            
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $content = $_POST['noidung'];
                $id_product = $_POST['id_product'];
                $id_user = $_SESSION['user']['id'];
                $created_at = date('Y-m-d H:i:s');
                comment_insert($content, $id_user, $id_product, $created_at);
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
            include("view/comment-form.php");
            break;
        case 'view-cart':
            include("view/cart/view-cart.php");
            break;
        case 'add-to-cart':
            if (isset($_POST['add-to-cart']) && ($_POST['add-to-cart'])) {
                $id = $_POST['id']; // 0
                // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
                $productExists = false;
                $cartLength = count($_SESSION['cart']);
                for ($i = 0; $i < $cartLength; $i++) {
                    if ($_SESSION['cart'][$i][0] == $id) {
                        // Sản phẩm đã tồn tại, cập nhật số lượng
                        $_SESSION['cart'][$i][6] += 1;
                        $_SESSION['cart'][$i][7] = $_SESSION['cart'][$i][6] * $_SESSION['cart'][$i][2];
                        $productExists = true;
                        break;
                    }
                }
                // Sản phẩm không tồn tại, thêm mới vào giỏ hàng
                if (!$productExists) {
                    $name = $_POST['name']; // 1
                    $price = $_POST['price']; // 2
                    $discount = $_POST['discount']; // 3
                    $weight = $_POST['weight']; // 4
                    $image = $_POST['image']; // 5
                    $quantityDefault = 1; // 6
                    $totalMoney = ($discount == 0) ? $quantityDefault * $price : $quantityDefault * $discount; // 7

                    $arrayProductAdd = [$id, $name, $price, $discount, $weight, $image, $quantityDefault, $totalMoney];
                    array_push($_SESSION['cart'], $arrayProductAdd);
                }
            }
            include("view/cart/view-cart.php");
            break;
        case 'delete-cart':
            if (isset($_GET['id-cart'])) {
                // Delete 1 item cart
                array_splice($_SESSION['cart'], $_GET['id-cart'], 1);
            } else {
                // Delete all cart
                $_SESSION['cart'] = [];
            }
            header('Location: index.php?act=view-cart');
            break;
        case 'checkout':
            include("view/cart/checkout.php");
            break;
        case 'complete':
            // Create bill
            if (isset($_POST['agree-to-order']) && ($_POST['agree-to-order'])) {
                // Người dùng hoặc khách vãng lai
                $id_user = (isset($_SESSION['user'])) ? $_SESSION['user']['id'] : 0;
                $username = $_POST['username'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $note = $_POST['note'];
                $pay_method = $_POST['pay-method'];
                $order_date = date('Y-m-d H:i:s');
                $total_order = getTotalOrder();
                // Create bill
                $id_bill = bill_insert($id_user, $username, $address, $phone, $note, $email, $pay_method, $order_date, $total_order);
                // insert into cart
                foreach ($_SESSION['cart'] as $cart) {
                    $priceProduct = ($cart[3] == 0) ? $cart[2] : $cart[3];
                    cart_insert($_SESSION['user']['id'], $cart[0], $cart[5], $cart[1], $priceProduct, $cart[6], $cart[7], $id_bill);
                }
                // Thông tin người mua
                $customer_invoice_info = bill_select_by_id_bill($id_bill);
                // Chi tiết hóa đơn giỏ hàng
                $detail_invoice_info = cart_select_by_id_bill($id_bill);
                $_SESSION['cart'] = [];
            }
            include("view/cart/complete.php");
            break;
        case 'home':
            header("Location: index.php");
            break;
        case 'dowcooky':
            include("view/dow.php");
            break;
        case 'search':
            if (isset($_GET['keyword']) && $_GET['keyword'] !== "") {
                $searchKeyword = $_GET['keyword'];
                $productList = product_search_by_keyword($searchKeyword);
                include("view/search.php");
            } else {
                include("view/home-page.php");
            }
            break;
        case 'huydh':
            if (isset($_GET['id']) && ($_GET['id'])) {
                $id = $_GET['id']; // Lấy giá trị của ID từ tham số GET
                update_bill_status2($id);
                $message_success = "Cập nhật trạng thái thành công";
            }
            $list_bill = bill_select_all($_SESSION['user']['id']);
            include("view/cart/order-history.php");
            break;
        default:
            include("view/homepage.php");
            break;
    }
} else {
    include("view/homepage.php");
}
include("view/footer-site.php");
?>
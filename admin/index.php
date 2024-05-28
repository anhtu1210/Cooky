<!-- Controller admin -->
<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include("./layout/header-admin.php");
include("./layout/sidebar-admin.php");
include("./layout/top-navbar.php");
include("./layout/header-admin.php");
include("../model/pdo.php");
include("../model/loai.php");
include("../model/hang-hoa.php");
include("../model/cart.php");
include("../model/thong-ke.php");
include("../model/taikhoan.php");
include("../model/comment.php");


$ROOT_PATH = '/CookyFood-PHP';
$ADMIN_PATH = "$ROOT_PATH/admin";
$SITE_PATH = "$ROOT_PATH/site";
$imagePath = "upload/";

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        case 'comment':
            $list_comment = comment_select_all(0);
            include("./comment/list.php");
            break;
        case 'comment-delete':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                comment_delete($_GET['id']);
            }
            $list_comment = comment_select_all(0);
            include("./comment/list.php");
            break;
        case 'statistics':
            $list_statistics_product = thong_ke_hang_hoa();
            $list_statistics_comment = thong_ke_binh_luan();
            include("statistics/list.php");
            break;
        case 'chart-category':
            $list_statistics_product = thong_ke_hang_hoa();
            include("./statistics/chart-category.php");
            break;
        case 'chart-comment':
            $list_statistics_comment = thong_ke_binh_luan();
            include("./statistics/chart-comment.php");
            break;
        case 'category':
            $listdanhmuc = loadall_danhmuc();
            include("category/list.php");
            break;
        case 'category-add':
            $errors = [];

        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $categoryName = $_POST['categoryName'];
            $image = $_FILES['image']['name'];
            if (empty($categoryName)) {
                $errors[] = "Vui lòng nhập tên danh mục";
            }
            if (empty($image)) {
                $errors[] = "Vui lòng chọn ảnh cho danh mục";
            }
            if (empty($errors)) {
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    insert_danhmuc($categoryName, $image);
                    $thongbao = "Thêm thành công";
                } else {
                    $errors[] = "Đã xảy ra lỗi khi tải lên ảnh, vui lòng thử lại.";
                }
            }
        }
        include("category/add.php");
            break;

        case 'category-detail':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $category = loadone_danhmuc($_GET['id']);
            }
            include("./category/update.php");
            break;
        case 'null':
            include("layout/null.php");
            break;

        case 'category-update':
            if (isset($_POST["submit"]) && ($_POST["submit"])) {
                $id = $_POST["id"];
                $tenloai = $_POST['categoryName'];
                $image = $_FILES['image']['name'];
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                update_danhmuc($id, $tenloai, $image);
                $thongbao = "Cập nhật thành công";
                loadall_danhmuc();
            }
            $listdanhmuc = loadall_danhmuc();
            include("category/list.php");
            break;
        case 'category-delete':
            if (isset($_GET['id']) && ($_GET['id'])) {
                delete_danhmuc($_GET['id']);
            }
            $listdanhmuc = loadall_danhmuc();
            include("category/list.php");
            break;
        case 'product':
            $keyword = isset($_POST["search"]) && $_POST["search"] ? $_POST['keyword'] : "";
            $category_id = isset($_POST["search"]) && $_POST["search"] ? $_POST['category_id'] : 0;

            $listdanhmuc = loadall_danhmuc();
            $list_product = hang_hoa_select_all($keyword, $category_id);
            include("product/list.php");
            break;
            case 'product-add':
                if (isset($_POST["submit"]) && ($_POST["submit"])) {
                    $category_id = $_POST['category_id'];
                    $productName = $_POST['productName'];
                    $price = $_POST['price'];
                    $discount = $_POST['discount'];
                    $weight = $_POST['weight'];
                    $description = $_POST['description'];
            
                    $error = array();
                    if (empty($category_id)) {
                        $error['category_id'] = "Vui lòng chọn danh mục sản phẩm";
                    }
                    if (empty($productName)) {
                        $error['productName'] = "Vui lòng nhập tên sản phẩm";
                    }
                    if (!is_numeric($price) || $price <= 0) {
                        $error['price'] = "Giá sản phẩm phải là một số dương";
                    }
                    if (!empty($discount) && (!is_numeric($discount) || $discount < 0 || $discount >= 100)) {
                        $error['discount'] = "Chiết khấu phải là một số từ 0 đến 99";
                    }

                    if (!is_numeric($weight) || $weight <= 0) {
                        $error['weight'] = "Trọng lượng phải là một số dương";
                    }

                    if (empty($error)) {
                        $image = $_FILES['image']['name'];
                        $target_dir = "../upload/";
                        $target_file = $target_dir . basename($_FILES["image"]["name"]);
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                        hang_hoa_insert($productName, $price, $discount, $image, $weight, $description, $category_id);
                        $message_success = "Đã thêm thành công sản phẩm";
                    }
                }
                $listdanhmuc = loadall_danhmuc();
                include("product/add.php");
                break;
            
        case 'product-detail':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $product = hang_hoa_select_by_id($_GET['id']);
            }
            $listdanhmuc = loadall_danhmuc();
            include("./product/update.php");
            break;
        case 'product-update':
            if (isset($_POST["submit"]) && $_POST["submit"]) {
                $id = $_POST["id"];
                $category_id = $_POST["category_id"];
                $productName = $_POST["productName"];
                $price = $_POST["price"];
                $discount = $_POST["discount"];
                $weight = $_POST["weight"];
                $description = $_POST["description"];

                $image = $_FILES['image']['name'];
                $target_dir = "../upload/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                hang_hoa_update($id, $productName, $price, $discount, $image, $weight, $description, $category_id);
                $message_success = "Cập nhật thành công sản phẩm";
            }
            $list_product = hang_hoa_select_all("", 0);
            $listdanhmuc = loadall_danhmuc();
            include("product/list.php");
            break;
        case 'product-delete':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                hang_hoa_delete($_GET['id']);
            }
            $list_product = hang_hoa_select_all("", 0);
            include("product/list.php");
            break;
        
        // Controller order
        case 'order':
            $keyword = isset($_POST['keyword']) && $_POST['keyword'] != "" ? $_POST['keyword'] : "";
            $list_bill = bill_select_all_manager($keyword, 0);
            include("./order/list.php");
            break;
        case 'order-detail':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $order = bill_select_by_id_bill($_GET['id']);
            }
            include("./order/update.php");
            break;
        case 'order-update':
            if (isset($_POST["submit"]) && $_POST["submit"]) {
                $id = $_POST['id'];
                $id_user = $_POST['id_user'];
                $bill_status = $_POST['bill_status'];
                update_bill_status($id, $bill_status);
                $message_success = "Cập nhật trạng thái thành công";
            }
            $list_bill = bill_select_all_manager("", 0);
            include("./order/list.php");
            break;
        case 'account':
            $list_account = loadall_taikhoan();
            include("./account/list.php");
            break;
        case 'account-delete-soft':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                account_delete_soft($_GET['id']);
            }
            $list_account = loadall_taikhoan();
            include("./account/list.php");
            break;
        case 'account-revert':
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                account_revert($_GET['id']);
            }
            $list_account = loadall_taikhoan();
            include("./account/list.php");
            break;
            case 'account-detail':
                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $account = taikhoan_select_by_id($_GET['id']);
                }
                include("./account/update.php");
                break;
            case 'account-update':
                if (isset($_POST["submit"]) && $_POST["submit"]) {
                    $id = $_POST['id'];
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $phone = $_POST['phone'];
        
                    $image = $_FILES['image']['name'];
                    $target_dir = "../upload/";
                    $target_file = $target_dir . basename($_FILES["image"]["name"]);
                    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        
                    account_update($id, $username, $email, $phone, $address, $image);
                    $message_success = "Cập nhật thông tin thành công";
                }
                $list_account = loadall_taikhoan();
                include("./account/list.php");
                break;
                
        default:
        include("./layout/null.php");
        break;
     }
}
include("./layout/footer-admin.php")
?>
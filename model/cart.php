<?php
require_once 'pdo.php';
function getTotalOrder()
{
    $totalAllCart = 0;
    foreach ($_SESSION['cart'] as $cart) {
        $totalMoney = ($cart[3] == 0) ? ($cart[2] * $cart[6]) : ($cart[3] * $cart[6]);
        $totalAllCart += $totalMoney;
    }
    return $totalAllCart;
}
function bill_insert($id_user, $username, $address, $phone, $note, $email, $pay_method, $order_date, $total_order)
{
    // Định nghĩa biến kết nối PDO
    $pdo = new PDO("mysql:host=localhost;dbname=duan1", "root", "");
    // Thiết lập chế độ báo lỗi để bật bắt các ngoại lệ PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Chuẩn bị câu truy vấn
    $sql = "INSERT INTO bill(id_user, bill_name, bill_address, bill_phone, bill_note, bill_email, bill_pay_method, order_date, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    try {
        // Chuẩn bị và thực thi câu truy vấn sử dụng prepared statement
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_user, $username, $address, $phone, $note, $email, $pay_method, $order_date, $total_order]);
        
        // Trả về ID cuối cùng được chèn vào
        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        // Xử lý ngoại lệ nếu có lỗi xảy ra
        // Ví dụ: Log lỗi, thông báo cho người dùng, v.v.
        return false;
    }
}

function cart_insert($id_user, $id_product, $image, $name, $price, $quantity, $into_money, $id_bill)
{
    $sql = "INSERT INTO cart(id_user , id_product , image, name, price, quantity, into_money, id_bill ) VALUES ('$id_user', '$id_product', '$image', '$name', '$price', '$quantity', '$into_money', '$id_bill')";
    pdo_execute($sql);
}
function bill_select_by_id_bill($id)
{
    $sql = "SELECT * FROM bill WHERE id =" . $id;
    $bill = pdo_query_one($sql);
    return $bill;
}
function cart_select_by_id_bill($id_bill)
{
    $sql = "SELECT * FROM cart WHERE id_bill =" . $id_bill;
    $cart = pdo_query($sql);
    return $cart;
}
// Lịch sử đơn hàng
function bill_select_all($id_user)
{
    $sql = "SELECT * FROM bill WHERE 1";
    if ($id_user > 0) $sql .= " AND id_user =" . $id_user;
    $sql .= " ORDER BY id DESC";
    $list_bill = pdo_query($sql);
    return $list_bill;
}
// Quản lý đơn hàng và tìm kiếm theo mã đơn hàng
function bill_select_all_manager($keyword = "", $id_user = 0)
{
    $sql = "SELECT * FROM bill WHERE 1";
    if ($id_user > 0) $sql .= " AND iduser =" . $id_user;
    if ($keyword != "") $sql .= " AND id  LIKE '%" . $keyword . "'";
    $sql .= " ORDER BY id DESC";
    $list_bill = pdo_query($sql);
    return $list_bill;
}
// Lấy trạng thái đơn hàng
function get_order_status($bill_status)
{
    switch ($bill_status) {
        case '0':
            $status = "Chờ xác nhận";
            break;
        case '1':
            $status = "Đang xử lý";
            break;
        case '2':
            $status = "Đang giao hàng";
            break;
        case '3':
            $status = "Đã giao hàng";
            break;
        case '4':
            $status = "Đã hủy"; // Khách hàng hủy
            break;
        case '5':
            $status = "Bị hủy bỏ"; // Admin hủy
            break;

        default:
            $status = "Chờ xác nhận";
            break;
    }
    return $status;
}
// Trả về class theo order status
function get_order_status_class($bill_status)
{
    switch ($bill_status) {
        case '0':
            $class = "waiting-confirmation";
            break;
        case '1':
            $class = "processing text-primary";
            break;
        case '2':
            $class = "shipping text-warning";
            break;
        case '3':
            $class = "delivered text-success";
            break;
        case '4':
            $class = "refuse text-danger"; // Khách hàng hủy
            break;
        case '5':
            $class = "canceled text-danger"; // Admin hủy
            break;

        default:
            $class = "waiting-confirmation";
            break;
    }
    return $class;
}
// Cập nhật trạng thái đơn hàng
function update_bill_status($id, $bill_status)
{
    $sql = "UPDATE bill SET bill_status = '" . $bill_status . "' WHERE id =" . $id;
    pdo_query($sql);
}
function update_bill_status2($id)
{
    $sql = "UPDATE bill SET bill_status = 4 WHERE id =" . $id;
    pdo_query($sql);
}

<?php
include("../../model/pdo.php");
include("../../model/cart.php");
include("../../global.php");
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $orderId = $_GET['id'];
    $customerInfo = bill_select_by_id_bill($orderId);
    $orderDetail = cart_select_by_id_bill($orderId);
    extract($customerInfo);
    $pay_method = ($bill_pay_method	  == 1) ? "Thanh toán khi nhận hàng" : "Thanh toán online";
    // Hiển thị dữ liệu chi tiết đơn hàng dưới dạng HTML
    // Thông tin khách hàng
    echo '<table class="table border-0">
        <tbody>
            <tr class="border-0">
                <td scope="row" class="border-0">
                    <span class="item-label font-weight-bold">Tên khách hàng: </span>
                    <span class="item-content">' . $bill_name . '</span>
                </td>
                <td class="border-0">
                    <span class="item-label font-weight-bold">Số điện thoại: </span>
                    <span class="item-content">' . $bill_phone . '</span>
                </td>
                <td class="border-0">
                    <span class="item-label font-weight-bold">Mã đơn hàng: </span>
                    <span class="item-content">' . $id . '</span>
                </td>
            </tr>
            <tr>
                <td scope="row" class="border-0">
                    <span class="item-label font-weight-bold">Email: </span>
                    <span class="item-content">' . $bill_email . '</span>
                </td>
                <td class="border-0">
                    <span class="item-label font-weight-bold">Địa chỉ: </span>
                    <span class="item-content">' . $bill_address . '</span>
                </td>
                <td class="border-0">
                    <span class="item-label font-weight-bold">Tổng giá trị: </span>
                    <span class="item-content">' . formatCurrency($total) . '</span>
                </td>
            </tr>
            <tr>
                <td scope="row" class="border-0">
                    <span class="item-label font-weight-bold">Phương thức thanh toán: </span>
                    <span class="item-content text-info">' . $pay_method . '</span>
                </td>
                <td class="border-0">
                    <span class="item-content">
                        <form method="post" action="../generate_invoice_pdf.php" class="btn-print-invoice">
                            <input type="hidden" value="' . $orderId . '" name="idbill"/>
                            <input class="btn btn-primary btn-sm" type="submit" name="print_invoice" value="In hóa đơn">
                        </form>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>';
    // Thông tin sản phẩm trong giỏ hàng
    echo '
    <table class="table">
    <thead>
        <tr>
            <th class="font-weight-bold text-center">ID</th>
            <th class="font-weight-bold text-center">Tên món ăn</th>
            <th class="font-weight-bold text-center">Hình ảnh</th>
            <th class="font-weight-bold text-center">Số lượng</th>
            <th class="font-weight-bold text-center">Đơn giá</th>
            <th class="font-weight-bold text-center">Tổng tiền</th>
        </tr>
    </thead>
    <tbody>';
    foreach ($orderDetail as $product) {
        extract($product);
        $pathImage ="../upload/" . $image;
        $showImage = "<img class='border rounded' src='{$pathImage}' alt='{$name}'height='100' width='100' style='object-fit: cover'/>";
        echo '<tr>
        <td class="text-center" scope="row">' . $product['id'] . '</td>
        <td class="text-center">' . $name . '</td>
        <td class="text-center">' . $showImage . '</td>
        <td class="text-center">' . $quantity . '</td>
        <td class="text-center">' . formatCurrency($price) . '</td>
        <td class="text-center">' . formatCurrency($into_money) . '</td>
    </tr>';
    }
    echo '</tbody>
</table>';
} else {
    echo 'Không có dữ liệu chi tiết đơn hàng.';
}

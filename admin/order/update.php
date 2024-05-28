<?php
if (is_array($order)) {
    extract($order);
    $bill_pay_method_text = ($bill_pay_method == 1) ? "Thanh toán khi nhận hàng" : "Thanh toán online";
}
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý đơn hàng</li>
            <li class="breadcrumb-item" aria-current="page">Cập nhật đơn hàng</li>
        </ol>
    </nav>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?act=order">
        <i class="fa-solid fa-list-ul"></i> Danh sách đơn hàng
    </a>
    <form action="index.php?act=order-update" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col">
                <label for="id">Mã đơn hàng</label>
                <input type="number" name="id" id="id" class="form-control form-control-sm" value="<?= isset($id) && $id > 0 ? $id : '' ?>" readonly>
            </div>
            <div class="form-group col">
                <label for="bill_name">Tên Khách hàng</label>
                <input type="text" name="bill_name" id="bill_name" class="form-control form-control-sm" value="<?= $bill_name ?>" readonly>
                <input type="hidden" name="id_user" id="id_user" class="form-control form-control-sm" value="<?= $id_user ?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="order_date">Ngày đặt hàng</label>
                <input type="text" name="order_date" id="order_date" class="form-control form-control-sm" value="<?= $order_date ?>" readonly>
            </div>
            <div class="form-group col">
                <label for="bill_pay_method_text">Phương thức thanh toán</label>
                <input type="hidden" name="bill_pay_method" id="bill_pay_method" class="form-control form-control-sm" value="<?= $bill_pay_method ?>">
                <input type="text" name="bill_pay_method_text" id="bill_pay_method_text" class="form-control form-control-sm" value="<?= $bill_pay_method_text ?>" readonly>
            </div>
        </div>
        <div class="form-group">
            <label for="productName">Trạng thái đơn hàng</label>
            <select name="bill_status" class="form-control form-control-sm">
    <option value="<?= $bill_status ?>" disabled class="text-info">
        Trạng thái hiện tại: <?= get_order_status($bill_status) ?>
    </option>
    <?php
    $list_status = array(
        '0' => 'Chờ xác nhận',
        '1' => 'Đang xử lý',
        '2' => 'Đang giao hàng',
        '3' => 'Đã giao hàng',
        '4' => 'Đã hủy',
    );
    foreach ($list_status as $value => $label) {
        $selected = ($bill_status == $value) ? 'selected' : '';
        $disabled = ($bill_status == 4) ? ($value != 4 ? 'disabled' : '') : ''; // Disable option if current status is 'Bị hủy bỏ'
        echo '<option  value="' . $value . '" ' . $selected . ' ' . $disabled . '>' . $label . '</option>';
    }
    ?>
</select>

        </div>
        <?php
        if (isset($message_success) && !empty($message_success)) {
            displayToastrMessageSuccess($message_success);
        }
        ?>
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="CẬP NHẬT" />
    </form>
</div>
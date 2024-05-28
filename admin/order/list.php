
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý đơn hàng</li>
        </ol>
    </nav>
    <!-- Search by order id -->
    <div class="mb-2">
        <form class="form-inline" action="index.php?act=order" method="POST">
            <input type="text" name="keyword" class="form-control form-control-sm mr-1 " placeholder="Tìm kiếm đơn hàng theo mã..." style="width: 220px">
            <input type="submit" name="search" class="btn btn-primary btn-sm mr-3" value="Tìm kiếm" />
        </form>
    </div>
    <?php if (isset($list_bill) && is_array($list_bill) && !empty($list_bill)) : ?>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="font-weight-bold w-20px" scope="col">#</th>
                    <th class="font-weight-bold" scope="col">Mã đơn hàng</th>
                    <th class="font-weight-bold" scope="col">Tên khách hàng</th>
                    <th class="font-weight-bold" scope="col">Ngày đặt hàng</th>
                    <th class="font-weight-bold" scope="col">Phương thức thanh toán</th>
                    <th class="font-weight-bold" scope="col">Trạng thái đơn hàng</th>
                    <th class="font-weight-bold" scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_bill as $bill) : ?>
                    <?php
                    extract($bill);
                    $order_status = get_order_status($bill['bill_status']);
                    $classNameStatus = get_order_status_class($bill['bill_status']);
                    ?>
                    <tr class="text-center">
                        <td scope="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                            </div>
                        </td>
                        <th><?= $bill['id'] ?></th>
                        <td class="text-primary"><?= $bill['bill_name'] ?></td>
                        <td><?= $bill['order_date'] ?></td>
                        <td class="text-info"><?= $bill['bill_pay_method'] == 1 ? 'Thanh toán khi nhận hàng' : 'Thanh toán online' ?></td>
                        <td class="<?= $classNameStatus ?>"><?= $order_status ?></td>
                        <td>
                            <a href="index.php?act=order-detail&id=<?= $bill['id'] ?>" title="Sửa" class="btn btn-outline-warning btn-sm border border-0"><i class="fa-regular fa-pen-to-square"></i></a>
                            <!-- Button to trigger the modal -->
                            <button type="button" class="btn btn-outline-info btn-sm border border-0" title="Chi tiết đơn hàng" data-order-id="<?= $bill['id'] ?>" onclick="showOrderDetail(<?= $bill['id'] ?>)">
                                <i class="fa-solid fa-circle-info"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="text-center">
            <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695886519/cooky%20market%20-%20PHP/e2i0tysgmmogurexye75.jpg" width="505px" alt="No data" />
        </div>
    <?php endif; ?>
    <!-- Order detail modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-order-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const orderId = button.getAttribute('data-order-id');
                confirmDelete(orderId);
            });
        });
    });

    function showOrderDetail(orderId) {
        fetch('order/order-detail.php?id=' + orderId)
            .then(response => response.text())
            .then(data => {
                const modalBody = document.querySelector('.modal-body');
                modalBody.innerHTML = data;
                $('#myModal').modal('show');
            })
            .catch(error => {
                console.error('Lỗi khi tải dữ liệu chi tiết đơn hàng: ' + error);
            });
    }
</script>
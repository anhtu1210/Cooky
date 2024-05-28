
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý người dùng</li>
        </ol>
    </nav>

    <?php if (isset($list_account) && is_array($list_account) && !empty($list_account)) : ?>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="font-weight-bold" scope="col">ID</th>
                    <th class="font-weight-bold" scope="col">Tên người dùng</th>
                    <th class="font-weight-bold" scope="col">Ảnh đại diện</th>
                    <th class="font-weight-bold" scope="col">Email</th>
                    <th class="font-weight-bold" scope="col">Điện thoại</th>
                    <th class="font-weight-bold" scope="col">Địa chỉ</th>
                    <th class="font-weight-bold" scope="col">Vai trò</th>
                    <th class="font-weight-bold" scope="col">Trạng thái</th>
                    <th class="font-weight-bold" scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_account as $account) : ?>
                    <?php
                    extract($account);
                    $formatRole = ($role == 1)
                        ? "<strong class='text-danger text-uppercase'>Admin</strong>"
                        : "<strong class='text-primary text-uppercase'>User</strong>";
                    $pathImage = "../upload/" . $image;
                    $showImage = is_file($pathImage)
                        ? "<img class='border rounded' src='{$pathImage}' alt='{$user}'height='100' width='100' style='object-fit: cover'/>"
                        : "<img class='border rounded' src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg' alt='Không có ảnh' height='100' width='100'>";
                    ?>
                    <tr class="text-center">
                        <th><?= $id ?></th>
                        <td class="text-primary"><?= $user ?></td>
                        <td><?= $showImage ?></td>
                        <td><?= $email ?></td>
                        <td><?= $tel?></td>
                        <td><?= $adress ?></td>
                        <td><?= $formatRole ?></td>
                        <td class="text-success">Hoạt động</td>
                        <td>
                            <a href="index.php?act=account-delete-soft&id=<?= $id ?>" title="Xóa" class="btn btn-outline-danger btn-sm border border-0 delete-account-button" data-account-id="<?= $id ?>"><i class="fa-regular fa-trash-can"></i></a>
                            <a href="index.php?act=account-detail&id=<?= $id ?>" title="Sửa" class="btn btn-outline-info btn-sm border border-0"><i class="fa-regular fa-pen-to-square"></i></a>
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
</div>
<script>
    function confirmDelete(accountId) {
        Swal.fire({
            title: 'Bạn chắc chắn xóa?',
            text: 'Bạn có chắc chắn muốn xóa tài khoản này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Xác nhận',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?act=account-delete-soft&id=' + accountId;
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-account-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const accountId = button.getAttribute('data-account-id');
                confirmDelete(accountId);
            });
        });
    });
</script>
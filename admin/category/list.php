<!-- Danh sách danh mục -->
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý danh mục</li>
        </ol>
    </nav>
    <div class="btn-add mb-3">
        <a class="text-light text-decoration-none btn btn-primary btn-sm" href="index.php?act=category-add">
            <i class="fa-solid fa-plus"></i> Thêm mới danh mục
        </a>
    </div>
    <table class="table">
        <thead>
            <tr class="text-center">
                <th class="font-weight-bold w-20px" scope="col">#</th>
                <th class="font-weight-bold" scope="col">ID</th>
                <th class="font-weight-bold" scope="col">Tên danh mục</th>
                <th class="font-weight-bold" scope="col">Hình ảnh</th>
                <th class="font-weight-bold" scope="col">Ngày tạo</th>
                <th class="font-weight-bold" scope="col">Ngày cập nhật</th>
                <th class="font-weight-bold" scope="col">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($listdanhmuc as $danhmuc) {
                extract($danhmuc);
                $format_date_create = date('d/m/Y', strtotime($created_at));
                $format_date_update = ($updated_at == "0000-00-00 00:00:00")
                    ? "<small class='text-primary'>Chưa cập nhật</small>"
                    : date('d/m/Y', strtotime($updated_at));
                $hinhpath = "../upload/" . $image;
                $showImage = is_file($hinhpath)
                    ? "<img class='border rounded' src='{$hinhpath}' alt='{$name}'height='100' width='100' style='object-fit: cover'/>"
                    : "<img class='border rounded' src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg' alt='Không có ảnh' height='100' width='100'>";
            ?>
                <tr class="text-center">
                    <td scope="row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="">
                        </div>
                    </td>
                    <td><?= $id ?></td>
                    <td class="text-primary"><?= $name ?></td>
                    <td><?= $showImage ?></td>
                    <td><?= $format_date_create ?></td>
                    <td><?= $format_date_update ?></td>
                    <td>
                        <a href="index.php?act=category-delete&id=<?= $id ?>" title="Xóa" class="btn btn-outline-danger btn-sm border border-0 delete-category-button" data-category-id="<?= $id ?>"><i class="fa-regular fa-trash-can"></i></a>
                        <a href="index.php?act=category-detail&id=<?= $id ?>" title="Sửa" class="btn btn-outline-info btn-sm border border-0"><i class="fa-regular fa-pen-to-square"></i></a>
                    </td>
                </tr>
            <?php
            }
            ?>
            </tr>

        </tbody>
    </table>

</div>
<script>
    function confirmDelete(categoryId) {
        Swal.fire({
            title: 'Bạn có chắc chắn xóa?',
            text: 'Bạn sẽ không thể khôi phục lại!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Xác nhận',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?act=category-delete&id=' + categoryId;
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-category-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const categoryId = button.getAttribute('data-category-id');
                confirmDelete(categoryId);
            });
        });
    });
</script>
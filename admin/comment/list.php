<!-- Danh sách bình luận -->

<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý bình luận</li>
        </ol>
    </nav>
    <?php if (isset($list_comment) && is_array($list_comment) && !empty($list_comment)) : ?>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="font-weight-bold" scope="col">ID</th>
                    <th class="font-weight-bold" scope="col">Tên người dùng</th>
                    <th class="font-weight-bold" scope="col">Tên sản phẩm</th>
                    <th class="font-weight-bold" scope="col">Nội dung bình luận</th>
                    <th class="font-weight-bold" scope="col">Ngày bình luận</th>
                    <th class="font-weight-bold" scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_comment as $comment) : ?>
                    <?php
                    extract($comment);
                    $result = comment_by_user_and_product($id_user, $id_product);
                    // Get data of 2 table account & product
                    $username_result = $result[0]['user'];
                    $productName_result = $result[0]['name'];
                    ?>
                    <tr class="text-center">
                        <th><?= $id ?></th>
                        <td class="text-primary"><?= $username_result ?></td>
                        <td><strong><?= $productName_result ?></strong><small class="text-danger">( id: <?= $id_product ?> )</small></td>
                        <td><?= $content ?></td>
                        <td><?= $created_at ?></td>
                        <td>
                            <a href="index.php?act=comment-delete&id=<?= $id ?>" title="Xóa" class="btn btn-outline-danger btn-sm border border-0 delete-comment-button" data-comment-id="<?= $id ?>"><i class="fa-regular fa-trash-can"></i></a>
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
    function confirmDelete(commentId) {
        Swal.fire({
            title: 'Bạn chắc chắn xóa?',
            text: 'Bạn có chắc chắn muốn xóa bình luận này?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Xác nhận',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?act=comment-delete&id=' + commentId;
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-comment-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const commentId = button.getAttribute('data-comment-id');
                confirmDelete(commentId);
            });
        });
    });
</script>
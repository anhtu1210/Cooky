<!-- Cập nhật danh mục -->
<?php
if (is_array($category)) {
    extract($category);
}
$pathImage = isset($image) ? "../upload/{$image}" : "https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg";
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý danh mục</li>
            <li class="breadcrumb-item" aria-current="page">Cập nhật danh mục</li>
        </ol>
    </nav>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?act=category">
        <i class="fa-solid fa-list-ul"></i> Danh sách danh mục
    </a>
    <form action="index.php?act=category-update" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="hidden" name="id" id="id" class="form-control" value="<?= isset($id) && $id > 0 ? $id : '' ?>">
            <label for="categoryName">Tên danh mục</label>
            <input type="text" name="categoryName" id="categoryName" class="form-control form-control-sm" value="<?= isset($name) && !empty($name) ? $name : '' ?>">
            <small class="text-danger"></small>
        </div>
        <div class="form-group">
            <img class='border rounded' id="preview-image" src="<?= $pathImage ?>" alt="<?= $name ?>" height='115' width='115' style='object-fit: cover'>
            <input class="form-control form-control-sm d-none" type="file" id="image" name="image" onchange="previewImage(this)">
            <label for="image" class="form-label label-for-file mt-3">
                <i class="fa-solid fa-file-image"></i>&nbsp;Chọn ảnh
            </label>
        </div>
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="CẬP NHẬT" />
    </form>
</div>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $('#image').on('change', function() {
            previewImage(this);
        });
    });
</script>
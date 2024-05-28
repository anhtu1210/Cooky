<!-- Thêm sản phẩm -->
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
            <li class="breadcrumb-item" aria-current="page">Thêm mới sản phẩm</li>
        </ol>
    </nav>
    <?php
    if (isset($message_success) && !empty($message_success)) {
        echo '<small class="message-error" style="color:red; font-size:20px;margin-left: 34%;">'.$message_success.'</small>' ;
    }
    ?><br>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?act=product">
        <i class="fa-solid fa-list-ul"></i> Danh sách sản phẩm 
    </a> 
    
    <form action="index.php?act=product-add" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="form-group col">
            <label for="productName">Tên sản phẩm</label>
            <input type="text" name="productName" id="productName" class="form-control form-control-sm" value="<?= isset($_POST['productName']) ? htmlspecialchars($_POST['productName']) : '' ?>">
            <small class="text-danger"><?= isset($error['productName']) ? $error['productName'] : "" ?></small>
        </div>
        <div class="form-group col">
            <label for="productName">Danh mục</label>
            <select name="category_id" class="form-control form-control-sm">
                <?php
                foreach ($listdanhmuc as $danhmuc) {
                    extract($danhmuc);
                    echo '<option value="' . $id . '">' . $name . '</option>';
                }
                ?>
            </select>
            
        </div>
    </div>
    <div class="row">
        <div class="form-group col">
            <label for="price">Giá gốc</label>
            <input type="number" name="price" id="price" class="form-control form-control-sm" value="<?= isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '' ?>">
            <small class="text-danger"><?= isset($error['price']) ? $error['price'] : "" ?></small>
        </div>
        <div class="form-group col">
            <label for="discount">Giảm giá</label>
            <input type="number" name="discount" id="discount" class="form-control form-control-sm" value="<?= isset($_POST['discount']) ? htmlspecialchars($_POST['discount']) : '' ?>">
            <small class="text-danger"><?= isset($error['discount']) ? $error['discount'] : "" ?></small>
        </div>
    </div>
    <div class="form-group">
        <label for="weight">Trọng lượng (g)</label>
        <input type="number" name="weight" id="weight" class="form-control form-control-sm" value="<?= isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : '' ?>">
        <small class="text-danger"><?= isset($error['weight']) ? $error['weight'] : "" ?></small>
    </div>
    <div class="form-group d-flex align-items-center">
        <div>
            <img class='border rounded' id="preview-image" src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg' alt='Không có ảnh' height='115' width='115'>
            <input class="form-control form-control-sm d-none" type="file" id="image" name="image" onchange="previewImage(this)">
            <label for="image" class="form-label label-for-file mt-3">
                <i class="fa-solid fa-file-image"></i>&nbsp;Chọn ảnh
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="description">Mô tả chi tiết</label>
        <textarea class="form-control form-control-sm" name="description" id="description" rows="3"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
    </div>
    <input type="submit" class="btn btn-primary btn-block" name="submit" value="THÊM MỚI" />
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
</script>
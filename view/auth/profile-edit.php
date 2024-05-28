<main class="page-container">
    <div class="page-wrapper">
        <h1 class="title-user">Thông tin cá nhân</h1>
        <div class="form-container">
            <?php
            if(isset($_SESSION['user'])&& (is_array($_SESSION['user']))){
                extract($_SESSION['user']);
                // Preview image
                $pathImage = isset($image) ? "./upload/{$image}" : "https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg";
            }
            ?>
            <form action="index.php?act=profile-edit" class="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $id ?>" />
                <div class="row">
                    <label class="label" for="username">Họ tên:</label>
                    <input class="input" type="text" name="username" id="username" placeholder="Họ tên" value="<?= $user ?>" />
                </div>
                <div style="margin-left: 150px;">
                    <small class="message-error"><?= isset($error['username']) ? $error['username'] : "" ?></small>
                </div>
                <div class="row">
                    <label class="label" for="username">Ảnh đại diện:</label>
                    <div class="form-group">
                        <img class='border rounded' id="preview-image" src="<?= $pathImage ?>" height='115' width='115' />
                        <input class="form-control form-control-sm d-none" type="file" id="image" name="image" onchange="previewImage(this)">
                        <label for="image" class="form-label label-for-file mt-3">
                            <i class="fa-solid fa-file-image"></i>&nbsp;Chọn ảnh
                        </label>
                    </div>
                </div>
                <div class="row">
                    <label class="label" for="email">Email:</label>
                    <input class="input" type="text" name="email" id="email" placeholder="Email" value="<?= $email ?>" />
                </div>
                <div style="margin-left: 150px;">
                    <small class="message-error"><?= isset($error['email']) ? $error['email'] : "" ?></small>
                </div>
                <div class="row">
                    <label class="label" for="address">Địa chỉ:</label>
                    <input class="input" type="text" name="address" id="address" placeholder="Địa chỉ chi tiết" value="<?= $adress ?>" />
                </div>
                <div style="margin-left: 150px;">
                    <small class="message-error"><?= isset($error['address']) ? $error['address'] : "" ?></small>
                </div>
                <div class="row">
                    <label class="label" for="phone">Điện thoại:</label>
                    <input class="input" type="text" name="phone" id="phone" placeholder="Số điện thoại" value="<?= $tel ?>" />
                </div>
                <div style="margin-left: 150px;">
                    <small class="message-error"><?= isset($error['phone']) ? $error['phone'] : "" ?></small>
                </div>
                <?php
                if (isset($message_success) && !empty($message_success)) {
                    displayToastrMessageSuccess($message_success);
                }
                ?>
                <div class="form-group-button">
                    <input name="submit" class="btn" type="submit" value="Cập nhật" />
                    <a class="btn" href="index.php?act=profile">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
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
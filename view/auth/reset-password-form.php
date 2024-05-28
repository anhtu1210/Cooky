<div class="container_login">
        <div class="box_login3">
        <div class="title_login">
        <a href="#"><button class="box_dangnhap3">ĐẶT LẠI MẬT KHẨU</button></a>
            </div>
            <div class="formtaikhoan">  
                <form action="index.php?act=reset-password" accept-charset="UTF-8" id="resetPasswordForm" method="POST">
                    <div class="form-group input-login getPassword">
                    <h3>Nhập mật Khẩu Mới*</h3>
                        <input class="login_user" type="password" id="newPassword" placeholder="Mật khẩu mới" name="newPassword">
                    </div>
                    <small class="message-error"><?= isset($error['newPassword']) ? $error['newPassword'] : "" ?></small>
                    <?php
                    if (isset($message_success) && !empty($message_success)) {
                        echo '<small class="message-error">'.$message_success.'</small>' ;
                    }
                    ?>
                    <input type="submit" class="button_submit3" value="Xác nhận" name="submit">
                    <a class="btn-return" style="color:black;margin-top:10px;" href="index.php?act=login" role="button">Về trang đăng nhập!</a>
                    
                </form>
            </div>
            </div>
        </div>
    </div>


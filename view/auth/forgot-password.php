
<div class="container_login">
    <div class="box_login3">
         <div class="title_login">
        <a href="#"><button class="box_dangnhap3">QUÊN MẬT KHẨU</button></a>
            </div>
        <div class="formtaikhoan">
       <form action="index.php?act=forgot-password" method="post">
            <h3>Nhập địa chỉ email*</h3>
            <input type="email" class="login_user" name="email" placeholder="Email.." > <br>
       <br> <small class="message-error"><?= isset($error['email']) ? $error['email'] : "" ?></small>
            <input type="submit" class="button_submit3" value="GỬI" name="submit">
       </form>
       </div>
    </div>
</div>

<div class="container_login">
    <div class="box_login">
         <div class="title_login">
        <a href="#"><button class="box_dangnhap">ĐĂNG NHẬP</button></a>
        <a href="index.php?act=register"><button class="box_dangky">ĐĂNG KÝ </button></a>
            </div>
        <div class="formtaikhoan">
        <form action="index.php?act=login" method="post">
        <input type="text" class="login_user" name="user" placeholder="Tên đăng nhập" value="<?php echo isset($_POST['user']) ? htmlspecialchars($_POST['user']) : ''; ?>"> <br>
        <?php if (!empty($thongbao_user)) { ?>
            <span style="color: red;"><?php echo $thongbao_user; ?></span><br>
        <?php } ?>
        <input type="password" class="login_user" name="pass" placeholder="Mật khẩu"> <br>
        <?php if (!empty($thongbao_pass)) { ?>
            <span style="color: red;"><?php echo $thongbao_pass; ?></span><br>
        <?php } ?>
      
        <input type="submit" class="button_submit" value="ĐĂNG NHẬP" name="dangnhap">

            <div class="user-foot">
                <a href="index.php?act=forgot-password" class="clearfix">Quên mật khẩu?</a>
                <p class="clearfix">Hoặc đăng nhập với</p>
                <div class="loginwith">
                    <li class="loginFb">
                        <span>
                            <i class="fa-brands fa-facebook-f"></i>
                        </span>
                        <a href="#">Đăng nhập bằng Facebook</a>
                    </li>
                    <li class="loginGg">
                        <span>
                            <i class="fa-brands fa-google"></i>
                        </span>
                        <a href="#">Đăng nhập bằng Google</a>
                    </li>
                </div>
            </div>
        </form>

       </div>
       <h2 class="thongbao"><br>
       <?php 
       if(isset($thongbao)&&($thongbao !="")){
        echo '<span style="color:red;">'.$thongbao.'</span>';
       }
       ?>
       </h2>
    </div>
    </div>

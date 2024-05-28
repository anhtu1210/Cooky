<?php 
function insert_taikhoan($email,$user,$pass)
{
    $sql = "INSERT INTO taikhoan (email,user,pass) values('$email','$user','$pass')";
    pdo_execute($sql);
}
function checkuser($user,$pass)
{
    $sql = "SELECT * FROM taikhoan where user='".$user."' AND pass='".$pass."'";
    $sp = pdo_query_one($sql);
    return $sp;
}
function account_update($id, $username, $email, $phone, $address, $image)
{
    if ($image != "") {
        $sql = "UPDATE taikhoan SET user='" . $username . "', email='" . $email . "', tel='" . $phone . "', image='" . $image . "', adress='" . $address . "' WHERE id=" . $id;
    } else {
        $sql = "UPDATE taikhoan SET user='" . $username . "', email='" . $email . "', tel='" . $phone . "', adress='" . $address . "' WHERE id=" . $id;
    }
    pdo_execute($sql);
}

function checkemail($email)
{
    $sql = "SELECT * FROM taikhoan where email='".$email."'";
    $sp = pdo_query_one($sql);
    return $sp;
}
function loadall_taikhoan()
{
    $sql = "SELECT * FROM taikhoan order by id desc";
    $listtaikhoan = pdo_query($sql);
    return $listtaikhoan;
}
function delete_taikhoan($id)
{
    $sql = "DELETE FROM taikhoan where id=" . $id;
    pdo_execute($sql);
}
function taikhoan_select_by_id($id)
{
    $sql = "SELECT * FROM taikhoan WHERE id=" . $id;
    return pdo_query_one($sql);
}
function taikhoan_lock_select_all()
{
    $sql = "SELECT * FROM taikhoan WHERE deleted = 1 ORDER BY id ASC";
    $list_account = pdo_query($sql);
    return $list_account;
}
function account_delete_soft($id)
{
    $sql = "DELETE FROM taikhoan where id=" . $id;
    pdo_execute($sql);
}
function account_revert($id)
{
    $updated_at = date("Y-m-d H:i:s");
    $sql = "UPDATE taikhoan SET deleted = 0, updated_at ='" . $updated_at . "' WHERE id =" . $id;
    pdo_execute($sql);
}
function kiem_tra_nguoi_dung_ton_tai($user)
{
    $sql = "SELECT count(*) FROM taikhoan WHERE user=?";
    return pdo_query_value($sql, $user) > 0;
}
function account_exist($email)
{
    $sql = "SELECT count(*) FROM taikhoan WHERE email=?";
    return pdo_query_value($sql, $email) > 0;
}
function reset_code_update($reset_code, $email)
{
    $sql = "UPDATE taikhoan SET reset_code = '" . $reset_code . "' WHERE email = '" . $email . "'";
    pdo_execute($sql);
}
function password_update($password, $email)
{
    $sql = "UPDATE taikhoan SET pass = '" . $password . "', reset_code = '0' WHERE email = '" . $email . "'";
    pdo_execute($sql);
}
function user_send_reset_password($email, $resetCode)
{
    global $SMTP_USERNAME;
    global $SMTP_PASSWORD;

    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        $mail->SMTPDebug = 0; // Enable verbose debug output
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $SMTP_USERNAME; // SMTP username
        $mail->Password = $SMTP_PASSWORD; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port = 465; // TCP port to connect to
        // Config send & receive
        $mail->setFrom($SMTP_USERNAME, 'CookyFood');
        $mail->addAddress($email);
        $mail->isHTML(true);

        $subject = 'Thiết lập lại mật khẩu đăng nhập CookyFood';
        $message = "<div style='width: 484px; margin: 0 auto; font-size: 15px;'>";
        $message .= "<div style='text-align: center; margin-bottom: 37px;'><img src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1696750251/cooky%20market%20-%20PHP/extwq2ppklepp82jtwfh.png' alt='Cong Dinh' width='179px'/></div>";
        $message .= "Xin chào quý khách, <br><br>";
        $message .= "Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu CookyFood của bạn.<br><br>";
        $message .= 'Mã xác nhận của bạn là: <strong style="color: #f22726">' . $resetCode . '</strong><br><br>';
        $message .= "Nếu bạn không yêu cầu thiết lập lại mật khẩu, vui lòng bỏ qua email này.<br><br>";
        $message .= "Cảm ơn bạn đã tham gia và đồng hành cùng CookyFood.<br><br><br>";
        $message .= "Trân trọng, <br>";
        $message .= "Đội ngũ CookyFood";
        $message .= "</div>";

        $mail->Subject = $subject;
        $mail->Body    = $message;
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


?>
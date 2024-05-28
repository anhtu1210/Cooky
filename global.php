<?php
// global variable
$ROOT_PATH = '/CookyFood-PHP';
$ADMIN_PATH = "$ROOT_PATH/admin";
$SITE_PATH = "$ROOT_PATH/site";
$imagePath = "upload/";

function formatCurrency($amount)
{
    return number_format($amount) . 'đ';
}
function displayToastrMessageSuccess($message_success)
{
    echo '<script>';
    echo 'toastr.success("' . $message_success . '", "Thành công")';
    echo '</script>';
}
function displayToastrMessageError($message_error)
{
    echo '<script>';
    echo 'toastr.error("' . $message_error . '", "Thất bại")';
    echo '</script>';
}
function displayToastrMessageWarning($message_warning)
{
    echo '<script>';
    echo 'toastr.warning("' . $message_warning . '", "Cảnh báo")';
    echo '</script>';
}
// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendors/PHPMailer/src/Exception.php';
require 'vendors/PHPMailer/src/PHPMailer.php';
require 'vendors/PHPMailer/src/SMTP.php';

// PHPMailer config
$SMTP_USERNAME = "dinhdcph14290@fpt.edu.vn";
$SMTP_PASSWORD = "efflqcdnskpoeqms";
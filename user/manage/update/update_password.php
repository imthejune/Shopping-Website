<?php
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
$password3 = isset($_POST['password3']) ? $_POST['password3'] : '';

include '../../../connect.php'; 
$sql_password = "SELECT * FROM `member` WHERE user_id = '$user_id' and user_password = '$password1' ";
$result_password = $con->query($sql_password);

if (mysqli_num_rows($result_password) == 0) {
    echo "<script>";
    echo "alert(\" รหัสผ่านไม่ถูกต้อง\");";
    echo "window.history.back()";
    echo "</script>";
    return;
} 
else if ($password2 != $password3) {
    echo "<script>";
    echo "alert(\" รหัสผ่านไม่ถูกต้อง\");";
    echo "window.history.back()";
    echo "</script>";
    return;
} else {
    include '../../../connect.php';
    $sql = "UPDATE `member` SET `user_password`='$password2' where user_id = $user_id";
    $result = $con->query($sql);
    if ($result) {
        echo "<script>";
        echo "alert(\" บันทึกสำเร็จ\");";
        echo "window.history.back()";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert(\" บันทึกไม่สำเร็จ\");";
        echo "window.history.back()";
        echo "</script>";
    }
}

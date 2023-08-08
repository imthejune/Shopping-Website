<?php
session_start();
$user_name = isset($_POST['user']) ? $_POST['user'] : '';
$user_password = isset($_POST['password']) ? $_POST['password'] : '';

if ($user_name != "" && $user_password != "") {
    include '../connect.php';
    $sql = "select * from member  where  user_name='" . $user_name . "' and  user_password='" . $user_password . "' ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["user_name"] = $row["user_name"];
        $_SESSION["status"] = $row["status"];
        if ($_SESSION["status"] == 'admin') {
            Header("Location: ../admin/admin.php");
        } else if ($_SESSION["status"] == 'user') {
            Header("Location: ../user/user.php?nextpage=product");
        } 
    }
    else {
        echo "<script>";
        echo "alert(\" ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง\");";
        echo "window.history.back()";
        echo "</script>";
    }
}
else {
    echo "<script>";
    echo "alert(\" ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง\");";
    echo "window.history.back()";
    echo "</script>";
}

<?php

$user_name = isset($_POST['user']) ? $_POST['user'] : '';
$user_password = isset($_POST['password']) ? $_POST['password'] : '';
$Fname = isset($_POST['Fname']) ? $_POST['Fname'] : '';
$Lname = isset($_POST['Lname']) ? $_POST['Lname'] : '';
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';

// echo $user;
// echo '<br>';
// echo $password;
// echo '<br>';
// echo $Fname;
// echo '<br>';
// echo $Lname;
// echo '<br>';
// echo $tel;
// echo '<br>';
// echo $email;
// echo '<br>';
// echo $address;


include "../connect.php";
$sql_user = "SELECT * FROM `member` WHERE user_name = '$user_name' ";
$result_user = $con->query($sql_user);
$sql_email = "SELECT * FROM `member` WHERE email = '$email' ";
$result_email = $con->query($sql_email);
// echo mysqli_num_rows($result_user);
// echo mysqli_num_rows($result_email);

if (mysqli_num_rows($result_user) >= 1) {
    echo "<script>";
    echo "alert(\" ขออภัย ชื่อบัญชีนี้ถูกใช้ไปแล้ว กรุณาลองใหม่อีกครั้ง\");";
    echo "window.history.back()";
    echo "</script>";
    return;
} else if (mysqli_num_rows($result_email) >= 1) {
    echo "<script>";
    echo "alert(\" ขออภัย อีเมลนี้ถูกใช้ไปแล้ว กรุณาลองใหม่อีกครั้ง\");";
    echo "window.history.back()";
    echo "</script>";
    return;
}
//'".$Username."','".$Password."','".$Email."'
else {
    $sql = "   insert into `member`( `user_name`, `user_password`, `frist_name`, `last_name`, `address`, `tel`, `email`, `status`) 
values ('$user_name','$user_password','$Fname','$Lname','$address','$tel','$email','user') ";

    $result = $con->query($sql);

    if ($result) {
        echo "<script type='text/javascript'>";
        echo "alert('ลงทะเบียนสำเร็จ');";
        echo "window.location = '../login.php'; ";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ลงทะเบียนไม่สำเร็จ');";
        echo "window.location = '../login.php'; ";
        echo "</script>";
    }
}

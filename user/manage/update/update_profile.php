<?php
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

$Fname = isset($_POST['Fname']) ? $_POST['Fname'] : '';
$Lname = isset($_POST['Lname']) ? $_POST['Lname'] : '';
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';

// echo $Fname ;
// echo "<br>" ;
// echo $Lname ;
// echo "<br>" ;
// echo $tel ;
// echo "<br>" ;
// echo $email ;
// echo "<br>" ;
// echo $address ;
// echo "<br>" ;
// echo $user_id ;
// echo "<br>" ;

include '../../../connect.php'; 

$sql = "UPDATE `member` SET `frist_name`='$Fname',`last_name`='$Lname',
`tel`='$tel',`email`='$email',`address`='$address' where user_id = $user_id";
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
?>
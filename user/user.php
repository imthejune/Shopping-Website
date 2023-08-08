<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$status = isset($_SESSION['status']) ? $_SESSION['status'] : '';

if ($user_name == "" && $status != "user") {
    echo "<script type='text/javascript'>";
    echo "alert('กรุณาลงชื่อเข้าใช้');";
    echo "window.location = '../login.php'; ";
    echo "</script>";
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300,400,700&amp;subset=thai" />
    <link rel="stylesheet" href="../img/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../css/menu.scss">
    <link rel="stylesheet" href="../css/style.scss">
    <link rel="stylesheet" href="../admin/admin.scss">
    <link rel="stylesheet" href="user.scss">
    <title>Document</title>
</head>

<body>
    <?php include '../menu/menubar_user.php';
    ?>

    <?php
    $nextpage = isset($_GET['nextpage']) ? $_GET['nextpage'] : '';
    // echo $nextpage;

    if ($nextpage == 'product') {
        include 'product.php';
    } else if ($nextpage == 'cart') {
        include 'order/cart.php';
    } else if ($nextpage == 'manage') {
        include 'manage.php';
    } else {
        include 'product.php';
    }


    ?>

</body>

</html>
<?php
session_start();
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
$status = isset($_SESSION['status']) ? $_SESSION['status'] : '';

if ($user_name == "" && $status != "admin") {
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
    <link rel="stylesheet" href="menu_admin.scss">
    <link rel="stylesheet" href="../css/style.scss">
    <link rel="stylesheet" href="admin.scss">
    <link rel="stylesheet" href="../user/user.scss">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>admin</title>
</head>

<body>
    <?php
    $nextpage = isset($_GET['nextpage']) ? $_GET['nextpage'] : '';
    include '../menu/menubar_admin.php';
    ?>


    <div style="padding-left: 80px">
        <?php

        // echo $nextpage;

        if ($nextpage == 'home') {
            include 'home.php';
        } else if ($nextpage == 'member') {
            include 'member.php';
        } else if ($nextpage == 'manager') {
            include 'manager.php';
        } else if ($nextpage == 'report') {
            include 'report.php';
        } else {
            include 'home.php';
        }


        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "aLengthMenu": [
                    [-1, 15, 25, 50, 100],
                    ["All", 15, 25, 50, 100]
                ],
                "iDisplayLength": 15
            });
        });
    </script>

</body>

</html>
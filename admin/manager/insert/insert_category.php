<?php
$name = isset($_POST['name']) ? $_POST['name'] : '';

if ($name != "") {
    include '../../../connect.php';
    $sql = "INSERT INTO `category`(`category_name`) VALUES ('$name')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>";
        echo "alert(\" บันทึกสำเร็จ\");";
        echo "window.location = '../../admin.php?nextpage=manager&managerpage=category'; ";
        echo "</script>";
        
    } else {
        echo "<script>";
        echo "alert(\" บันทึกไม่สำเร็จ\");";
        echo "window.history.back()";
        echo "</script>";
    }
    
} else {
    echo "<script>";
    echo "alert(\" กรุณากรอกข้อมูลให้ครบ \");";
    echo "window.history.back()";
    echo "</script>";
}

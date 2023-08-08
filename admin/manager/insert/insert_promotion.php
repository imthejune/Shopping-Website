<?php
$name = isset($_POST['name']) ? $_POST['name'] : '';
$discount = isset($_POST['discount']) ? $_POST['discount'] : '';

if ($name != "") {
    include '../../../connect.php';
    $sql = "INSERT INTO `promotion`(`promotion_name`,`promotion_discount`) VALUES ('$name',$discount)";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>";
        echo "alert(\" บันทึกสำเร็จ\");";
        echo "window.location = '../../admin.php?nextpage=manager&managerpage=promotion'; ";
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

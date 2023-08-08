<?php
$id = isset($_POST['up_id']) ? $_POST['up_id'] : '';
$name = isset($_POST['up_name']) ? $_POST['up_name'] : '';
include '../../../connect.php'; 
$sql = "UPDATE `category` SET  category_name='$name'where category_id = $id";
$result = $con->query($sql);


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
<?php

$id = isset($_GET['id']) ? $_GET['id'] : '';
include '../../../connect.php'; 
$sql = "DELETE FROM `category` where category_id =  $id";

$result = $con->query($sql);

if ($result) {
    echo "<script>";
    echo "alert(\" ลบสำเร็จ\");";
    echo "window.location = '../../admin.php?nextpage=manager&managerpage=category'; ";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert(\" ลบไม่สำเร็จ\");";
    echo "window.history.back()";
    echo "</script>";
}

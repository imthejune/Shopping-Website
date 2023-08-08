<?php
// *** update order status ***
$id = isset($_GET['id']) ? $_GET['id'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

include '../../../connect.php';

if ($status == 'ชำระเงินไม่สำเร็จ') {
    $sql = "UPDATE `order` SET `order_status`='$status' , `payment_status`='ชำระเงินไม่สำเร็จ' , `comment`='$comment' where order_id = $id";
    $result = $con->query($sql);

    if ($result) {
        echo "<script>";
        echo "window.location = '../../../email_check_payment.php?failed_id=$id'; ";
        echo "</script>";
    }
    
} else if ($status == 'กำลังเตรียมจัดส่ง') {
    $sql = "UPDATE `order` SET `order_status`='$status' , `payment_status`='ชำระเงินสำเร็จ' , `comment`='$comment' where order_id = $id";
    $result = $con->query($sql);

    if ($result) {
        echo "<script>";
        echo "window.location = '../../../email_check_payment.php?pass_id=$id'; ";
        echo "</script>";
    }
    
} else {
    echo "<script>";
    echo "alert(\" บันทึกไม่สำเร็จ\");";
    echo "window.history.back()";
    echo "</script>";
}
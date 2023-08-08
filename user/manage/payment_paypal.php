<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
date_default_timezone_set('Asia/Bangkok');

include '../../connect.php'; 

// UPDATE `order` SET `bank_date`= '2010-06-20 08:47:00' WHERE order_id = 61

$sql = "UPDATE `order` SET  bank_name='Paypal',bank_date='" . date("Y-m-d-H-i-s") . "',`order_status`='กำลังเตรียมจัดส่ง',`payment_status`='ชำระเงินสำเร็จ' where order_id = $id";
$result = $con->query($sql);


if ($result) {
    echo "<script>";
    echo "window.location = '../../../email_payment.php?id=$id'; ";
    echo "</script>";    
} else {
    echo "<script>";
    echo "alert(\" บันทึกไม่สำเร็จ\");";
    echo "window.history.back()";
    echo "</script>";
}
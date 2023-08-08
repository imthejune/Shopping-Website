<?php
// ***update order status
$id = isset($_GET['id']) ? $_GET['id'] : '';
$delivery_date = isset($_POST['delivery_date']) ? $_POST['delivery_date'] : '';
$tracking_number = isset($_POST['tracking_number']) ? $_POST['tracking_number'] : '';

include '../../../connect.php';

$sql = "UPDATE `order` SET `order_status`='อยู่ระหว่างขนส่ง' , `delivery_date`='$delivery_date' , `tracking_number`='$tracking_number' where order_id = $id";

$result = $con->query($sql);

/*
echo $id; 
echo "<br>";
echo $delivery_date;
echo "<br>";
echo $tracking_number;
*/

if ($result) {
    echo "<script>";
    echo "window.location = '../../../email_delivery.php?id=$id'; ";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert(\" บันทึกไม่สำเร็จ\");";
    echo "window.history.back()";
    echo "</script>";
}
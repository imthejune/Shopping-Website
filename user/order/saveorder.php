<?php
session_start();
$user_id = $_SESSION["user_id"];

$name = isset($_POST['name']) ? $_POST['name'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$price_total = isset($_POST['bill']) ? $_POST['bill'] : '';
$price_post = isset($_POST['Ppost']) ? $_POST['Ppost'] : '';
$total = isset($_POST['checkbill']) ? $_POST['checkbill'] : '';
$post = isset($_POST['post']) ? $_POST['post'] : '';
date_default_timezone_set('Asia/Bangkok');




include '../../connect.php';

$sql = "INSERT INTO `order`(`user_id`, `order_name`, `order_address`, `order_tel`, `order_date`, `order_total`, `order_post`,`order_status`,`payment_status`,`email`) 
VALUES($user_id,'$name','$address','$tel','" . date("Y-m-d H:i:s") . "','$total','$post','รอการชำระเงิน','ยังไม่ชำระเงิน','$email')";
$result = mysqli_query($con, $sql);

$strOrderID = mysqli_insert_id($con);


for ($i = 0; $i <= (int) $_SESSION["intLine"]; $i++) {

    $Sproduct = (isset($_POST["Sproduct$i"])) ? $_POST["Sproduct$i"] : '';
    $Sqty = (isset($_POST["Sqty$i"])) ? $_POST["Sqty$i"] : '';
    $Total = 0;

    if (!empty($Sproduct)) {
        $sql = "SELECT * FROM product WHERE product_id = $Sproduct";
        $result = $con->query($sql);
        $data = mysqli_fetch_array($result);
        $Total = $data["product_price_total"] * $Sqty;
        $query = "INSERT INTO order_detail (order_id,product_id,order_qty,order_sum)
        VALUES ('$strOrderID','$Sproduct',$Sqty,$Total) ";
        $result = mysqli_query($con, $query);
    }
}
$_SESSION['strProductID']=null;
echo "<script>";
echo "alert(\"สั่งซื้อสำเร็จ\");";
echo "window.location = '../user.php'; ";
echo "</script>";


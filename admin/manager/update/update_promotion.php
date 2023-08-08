<?php
$id = isset($_POST['up_id']) ? $_POST['up_id'] : '';
$name = isset($_POST['up_name']) ? $_POST['up_name'] : '';
$discount = isset($_POST['discount']) ? $_POST['discount'] : '';
include '../../../connect.php';
include "../../../environment.php";
$sql = "UPDATE `promotion` SET  promotion_name='$name',promotion_discount=$discount where promotion_id = $id";
$result = $con->query($sql);

$sql_product = "SELECT * from  $join_product where p.promotion_id = $id ";
$result_pro = $con->query($sql_product);
while ($data = mysqli_fetch_array($result_pro)) {
    $discount_new = (($data["product_price_start"] / 100) * $discount);
    $p_total = $data["product_price_start"] - $discount_new;
    $id_product = $data["product_id"] ; 
    $sql_upproduct = "UPDATE `product` SET product_price_total=$p_total where product_id = $id_product";
    $result_uppro = $con->query($sql_upproduct);
}




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

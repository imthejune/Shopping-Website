<?php
$id = isset($_POST['id']) ? $_POST['id'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$price_start = isset($_POST['price_start']) ? $_POST['price_start'] : '';
$price_total = isset($_POST['price_total']) ? $_POST['price_total'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$qty = isset($_POST['qty']) ? $_POST['qty'] : '';
$unit = isset($_POST['unit']) ? $_POST['unit'] : '';
$detail = isset($_POST['detail']) ? $_POST['detail'] : '';
$promotion_d = isset($_POST['promotion']) ? $_POST['promotion'] : '';
$product_new = isset($_POST['product_new']) ? $_POST['product_new'] : '';


include '../../../connect.php';
$sql_select = "SELECT * from  promotion where promotion_discount = $promotion_d";
$result_select = $con->query($sql_select);
$data = mysqli_fetch_array($result_select);
$promotion = $data["promotion_id"];

$data = [$id, $name, $promotion, $price_start, $price_total, $category, $qty, $unit, $detail];



foreach ($data as &$value) {
    if ($value == null || $value == "") {
        echo "<script>";
        echo "alert(\" กรุณากรอกข้อมูลให้ครบ \");";
        echo "window.history.back()";
        echo "</script>";
        return;
    }
}
$sql = "UPDATE `product` SET 
product_name='$name',product_price_start=$price_start,product_price_total=$price_total,product_detail='$detail',
product_qty=$qty,product_new='$product_new',category_id=$category,unit_id=$unit,promotion_id=$promotion
where product_id = $id";
$result = $con->query($sql);


if ($result) {
    echo "<script>";
    echo "alert(\" บันทึกสำเร็จ\");";
    echo "window.location = '../../admin.php?nextpage=manager&managerpage=product'; ";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert(\" บันทึกไม่สำเร็จ\");";
    echo "window.history.back()";
    echo "</script>";
}
?>
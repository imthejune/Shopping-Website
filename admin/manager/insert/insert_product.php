<?php
$name = isset($_POST['name']) ? $_POST['name'] : '';
$price_start = isset($_POST['price_start']) ? $_POST['price_start'] : '';
$price_total = isset($_POST['price_total']) ? $_POST['price_total'] : '';
$category = isset($_POST['category']) ? $_POST['category'] : '';
$qty = isset($_POST['qty']) ? $_POST['qty'] : '';
$unit = isset($_POST['unit']) ? $_POST['unit'] : '';
$detail = isset($_POST['detail']) ? $_POST['detail'] : '';
$promotion_d = isset($_POST['promotion']) ? $_POST['promotion'] : '';
$product_new = isset($_POST['product_new']) ? $_POST['product_new'] : '';

$data = [$name, $promotion_d, $price_start, $price_total, $category, $qty, $unit, $detail];

foreach ($data as &$value) {
    if ($value == null || $value == "") {
        echo "<script>";
        echo "alert(\" กรุณากรอกข้อมูลให้ครบ \");";
        echo "window.history.back()";
        echo "</script>";
        return;
    }
}

//เช็ครูป
$MAX_SIZE = 1000000;
if ($_FILES['inputimg']['size'] > 0) {
    if ($_FILES['inputimg']['size'] > $MAX_SIZE) //ตรวจสอบขนาด
    {
        echo "<body onload=\"window.alert('ขนาดรูปใหญ่เกินกว่า 1 MB'); return history.back();\">";
        return;
    }
    else{
        $ext1 = pathinfo(basename($_FILES['inputimg']['name']), (PATHINFO_EXTENSION));
        $new_image_name = 'img_' . uniqid() . "." . $ext1;
        $image_path = "../../../img/upload/";
        $upload_path = $image_path . $new_image_name;
        //อัพโหลด
        $success = move_uploaded_file($_FILES['inputimg']['tmp_name'], $upload_path);
        if ($success == FALSE) {
          echo "อัพภาพไม่ได้";
          exit();
        }
        $pro_image = $new_image_name;
    }
}



include '../../../connect.php';
$sql_select = "SELECT * from  promotion where promotion_discount = $promotion_d";
$result_select = $con->query($sql_select);
$data = mysqli_fetch_array($result_select);
$promotion = $data["promotion_id"];

$sql_insert = " INSERT INTO `product`(`product_name`, `product_price_start`, 
    `product_price_total`, `product_detail`, `product_qty`, `product_new`, `picture`, 
    `category_id`, `unit_id`, `promotion_id`) 
    VALUES ('$name','$price_start','$price_total','$detail','$qty','$product_new','$pro_image','$category','$unit','$promotion')";
$result = mysqli_query($con, $sql_insert);

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
    
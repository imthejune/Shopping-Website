<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
$bank_name = isset($_POST['Wname']) ? $_POST['Wname'] : '';
$bank_date = isset($_POST['bank_date']) ? $_POST['bank_date'] : '';

include '../../connect.php'; 

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
        $image_path = "../../img/bank/";
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

// UPDATE `order` SET `bank_date`= '2010-06-20 08:47:00' WHERE order_id = 61

$sql = "UPDATE `order` SET  bank_name='$bank_name',bank_date='$bank_date',bank_img='$pro_image',`order_status`='กำลังตรวจสอบ',`payment_status`='ยังไม่ชำระเงิน' where order_id = $id";
$result = $con->query($sql);


if ($result) {
    echo "<script>";
    echo "window.location = '../../email_payment.php?id=$id'; ";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert(\" บันทึกไม่สำเร็จ\");";
    echo "window.history.back()";
    echo "</script>";
}
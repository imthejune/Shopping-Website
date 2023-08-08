<div class="row mb-3 row_cart text-center">
    <div class="col-1">รหัส</div>
    <div class="col-2">วันที่</div>
    <div class="col-3">ที่อยู่</div>
    <div class="col-2">ราคารวม</div>
    <div class="col-2">เพิ่มเติม</div>
    <div class="col-2">สถานะ</div>
</div>

<?php
include '../connect.php';
include "../environment.php";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$sql = "SELECT * from  `order` where user_id =  $user_id  ORDER BY order_id ASC";

$result = $con->query($sql);
$result_array = array();
$i = 0;

if (mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูล";
}
while ($data = mysqli_fetch_array($result)) {
    $i++;
    $order_status = $data["order_status"];
    $date=date_create($data['order_date']);
    
    if ($order_status == 'รอการชำระเงิน') {
        $color_status = 'status1';
    }
    else if ($order_status == 'กำลังตรวจสอบ') {
        $color_status = 'status2';
    }
    else if ($order_status == 'กำลังเตรียมจัดส่ง') {
        $color_status = 'status3';
    }
    else if ($order_status == 'อยู่ระหว่างขนส่ง') {
        $color_status = 'status4';
    }
?>

    <div class="row mb-1 text-center" style="background-color:#fff;align-items: center;">

        <div class="col-1">
            <div><?php echo $data["order_id"] ?></div>
        </div>
        <div class="col-2">
            <div><?php echo date_format($date,"d/m/y");?></div>
        </div>
        <div class="col-3" style="text-overflow: ellipsis;overflow: hidden;text-align: left;">
            <span style="white-space: nowrap;"><?php echo $data["order_address"] ?></span>
        </div>
        <div class="col-2">
            <div>฿<?php echo $data["order_total"] ?>.00</div>
        </div>
        <div class="col-2 pt-2 pb-2">
            <div style="padding: 0px 30px;">
                <a href="user.php?nextpage=manage&page=order_detail&pageback=orderall&id=<?php echo $data["order_id"] ?>"> <button class="btn_show">ดู</button></a>
            </div>
        </div>
        <div class="col-2 <?php echo $color_status; ?>" >
            <?php echo $order_status ?>
        </div>

    </div>
<?php } ?>
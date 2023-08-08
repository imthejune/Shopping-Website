<div class="row mb-3 row_cart text-center">
    <div class="col-1">รหัส</div>
    <div class="col-2">วันที่</div>
    <div class="col-5">ที่อยู่</div>
    <div class="col-2">ราคารวม</div>
    <div class="col-2"></div>
</div>

<?php
include '../connect.php';
include "../environment.php";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$sql = "SELECT * from  `order` where user_id =  $user_id and order_status = 'อยู่ระหว่างขนส่ง' ORDER BY order_id ASC";

$result = $con->query($sql);
$result_array = array();
$i = 0;
if (mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูล";
}
while ($data = mysqli_fetch_array($result)) {
    $i++;
    $date = date_create($data['order_date']);
    $showstatus = $data["order_status"] ;
?>

    <div class="row mb-1 text-center" style="background-color:#fff;align-items: center;">

        <div class="col-1">
            <div><?php echo $data["order_id"] ?></div>
        </div>
        <div class="col-2">
            <div><?php echo date_format($date, "d/m/y"); ?></div>
        </div>
        <div class="col-5" style="text-overflow: ellipsis;overflow: hidden;">
            <span style="white-space: nowrap;">฿<?php echo $data["order_address"] ?>.00</span>
        </div>
        <div class="col-2">
            <div>฿<?php echo $data["order_total"] ?>.00</div>
        </div>
        <div class="col-2 p-0">
            <a href="user.php?nextpage=manage&page=order_detail&pageback=order_transport&id=<?php echo $data["order_id"] ?>"> <button class="btn_transport">อยู่ระหว่างขนส่ง</button></a>
        </div>

    </div>
<?php } ?>
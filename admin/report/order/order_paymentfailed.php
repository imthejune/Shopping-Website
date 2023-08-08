<form action="admin.php?nextpage=report&page=order_paymentfailed" method="POST">
    <div class="row">
        <div class="col-2"><input class="form-control" type="number" name="search" placeholder="ค้นหา..."></div>
        <div><span>วันที่เริ่มต้น</span></div>
        <div class="col-3"><input class="form-control" type="datetime-local" name="start"></div>
        <div><span>ถึง</span></div>
        <div class="col-3"><input class="form-control" type="datetime-local" name="end"></div>
        <div class="col-2"><button class="btn btn-success btn-md">ค้นหา</button></div>
    </div><br>
</form>

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
$start = isset($_POST['start']) ? $_POST['start'] : '';
$end = isset($_POST['end']) ? $_POST['end'] : '';
$search_name = isset($_POST['search']) ? $_POST['search'] : '';
$search_name =  trim($search_name);
$search = "%" . $search_name . "%";
if ($start != "" && $end != "") {
    $sql = "SELECT * FROM `order` WHERE order_status = 'ชำระเงินไม่สำเร็จ' AND order_date BETWEEN '$start' AND '$end'  ORDER BY order_id ASC";
} else if ($search != "") {
    $sql = "SELECT * from  `order` where order_status = 'ชำระเงินไม่สำเร็จ' AND order_id like '$search'  ORDER BY order_id ASC";
}


$result = $con->query($sql);
$result_array = array();
$i = 0;
if (mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูล";
}
while ($data = mysqli_fetch_array($result)) {
    $i++;
    $date = date_create($data['order_date']);
    $showstatus = $data["order_status"];
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
            <a href="admin.php?nextpage=report&page=order_detail&pageback=order_paymentfailed&id=<?php echo $data["order_id"] ?>"> <button class="btn_Wbill">ตรวจสอบ</button></a>
        </div>

    </div>
<?php } ?>
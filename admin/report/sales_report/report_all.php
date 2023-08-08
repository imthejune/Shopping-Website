<?php
include '../connect.php';
include "../environment.php";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$start = isset($_POST['start']) ? $_POST['start'] : '';
$end = isset($_POST['end']) ? $_POST['end'] : '';
$search_name = isset($_POST['search']) ? $_POST['search'] : '';
$search_name =  trim($search_name);
$search = "%" . $search_name . "%";
?>
<div class="row">
    <div class="col-2"></div>
    <div class="col-3"><span>วันที่เริ่มต้น</span></div>
    <div class="col-3"><span>ถึง</span></div>
    <div class="col-2"></div>
</div>
<form action="admin.php?nextpage=report&managerpage=sales_summary&page=report_all" method="POST">
    <div class="row">
        <div class="col-2"><input class="form-control" type="text" name="search" placeholder="ค้นหา..."></div>
        <div class="col-3"><input class="form-control" type="datetime-local" name="start"></div>
        <div class="col-3"><input class="form-control" type="datetime-local" name="end"></div>
        <div class="col-2"><button class="btn btn-success btn-md">ค้นหา</button></div>
    </div><br>
</form>
<form action="../lib/tcpdf/genpdf_sales_report.php" target="_blank" method="POST">
    <div class="row">
        <div class="col-3" hidden><input class="form-control" type="datetime-local" name="start_pdf" value="<?php echo $start ?>"></div>
        <div class="col-3" hidden><input class="form-control" type="datetime-local" name="end_pdf" value="<?php echo $end ?>"></div>
        <div class="col-4"><button class="btn btn-success btn-md">ออกรายงาน</button></div>
    </div><br>
</form>

<div class="row mb-3 row_cart text-center">
    <div class="col-2">สินค้า</div>
    <div class="col-3"></div>
    <div class="col-2">จำนวน</div>
    <div class="col-2">ราคา</div>
</div>

<?php
$start = isset($_POST['start']) ? $_POST['start'] : '';
$end = isset($_POST['end']) ? $_POST['end'] : '';
$search_name = isset($_POST['search']) ? $_POST['search'] : '';
$search_name =  trim($search_name);
$search = "%" . $search_name . "%";

$where_daterange = null;
if ($start != '' and $end != '') {
    $where_daterange = " AND order_date BETWEEN '$start' AND '$end'";
}
$where_name = null;
if ($search != '' and $search_name != '') {
    $where_name = " AND product_name LIKE '$search'";
}

$sql = "SELECT product_name , `picture` , SUM(`order_qty`) AS QTY , SUM(`order_sum`) AS Price FROM `order_detail` AS od
        INNER JOIN product AS p ON od.`product_id` = p.`product_id`
        INNER JOIN `order` AS o ON od.`order_id` = o.`order_id`
        WHERE payment_status = 'ชำระเงินสำเร็จ' $where_daterange $where_name
        GROUP BY od.product_id";
$result = $con->query($sql);
$i = 0;

if (mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูล";
}
while ($data = mysqli_fetch_array($result)) {

?>

    <div class="row mb-1 text-center" style="background-color:#fff;align-items: center;">

        <div class="col-2">
            <div><?php echo $data["product_name"] ?></div>
        </div>
        <div class="col-3">
            <div><img style="object-fit: cover; height: 120px; width: 120px;" src="../img/upload/<?php echo $data['picture']; ?>" alt=""></div>
        </div>
        <div class="col-2 pt-2 pb-2">
            <div><?php echo $data["QTY"] ?></div>
        </div>
        <div class="col-2">
            <div><?php echo number_format($data["Price"]) ?></div>
        </div>

    </div>
<?php } ?>
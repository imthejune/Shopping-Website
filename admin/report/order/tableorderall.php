<div class="text-center">
    <table id="dataTable" class="display" style="width:100%">
        <!-- script dataTable in admin.php -->
        <thead>
            <th>รหัส</th>
            <th>วันที่</th>
            <th>ที่อยู่</th>
            <th>ราคารวม</th>
            <th>เพิ่มเติม</th>
            <th>สถานะ</th>
        </thead>
</div>

<?php
include '../connect.php';
include "../environment.php";
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$sql = "SELECT * from  `order` ORDER BY order_id ASC";

$result = $con->query($sql);
$result_array = array();
$i = 0;

if (mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูล";
}
while ($data = mysqli_fetch_array($result)) {
    $i++;
    $order_status = $data["order_status"];
    $date = date_create($data['order_date']);

    if ($order_status == 'รอการชำระเงิน') {
        $color_status = 'status1';
    } else if ($order_status == 'กำลังตรวจสอบ') {
        $color_status = 'status2';
    } else if ($order_status == 'กำลังเตรียมจัดส่ง') {
        $color_status = 'status3';
    } else if ($order_status == 'อยู่ระหว่างขนส่ง') {
        $color_status = 'status4';
    }
?>

    <div class="row mb-1 text-center" style="background-color:#fff;align-items: center;">

        <tbody>
            <?php if (mysqli_num_rows($result) == 0) {
                echo "ไม่พบข้อมูล";
            }
            while ($data = mysqli_fetch_array($result)) {
                $i++;
                $order_status = $data["order_status"];
                $date = date_create($data['order_date']);

                if ($order_status == 'รอการชำระเงิน') {
                    $color_status = 'status1';
                } else if ($order_status == 'กำลังตรวจสอบ') {
                    $color_status = 'status2';
                } else if ($order_status == 'กำลังเตรียมจัดส่ง') {
                    $color_status = 'status3';
                } else if ($order_status == 'อยู่ระหว่างขนส่ง') {
                    $color_status = 'status4';
                }

            ?>

                <tr>
                    <td><?php echo $data["order_id"] ?></td>
                    <td><?php echo date_format($date, "d/m/y"); ?></td>
                    <td><?php echo $data["order_address"] ?></td>
                    <td><?php echo $data["order_total"] ?></td>
                    <td><button class="btn_show">ดู</button></td>
                    <td <?php echo $color_status; ?>><?php echo $order_status ?></td>
                </tr>

            <?php } ?>
        </tbody>
        </table>

    </div>
<?php } ?>
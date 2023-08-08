<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable</title>

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/plug-ins/1.10.21/api/fnFilterClear.js"></script>
</head>

<body>
    <?php
    include 'lib/phpmailer/vendor/bootstraps.html';
    include 'connect.php';

    $sql = "SELECT * from  `order` ORDER BY order_id ASC";
    $result = $con->query($sql);
    $result_array = array();
    $i = 0;
    ?>

    <table border="0" cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Minimum age:</td>
                <td><input type="number" id="min" name="min"></td>
                <td>Maximum age:</td>
                <td><input type="number" id="max" name="max"></td>
                <td></td>
                <td><button class="btn btn-warning" id="fnFilterClear" name="fnFilterClear">Reset</button></td>
            </tr>
        </tbody>
    </table>
    <table id="dataTable" class="display">
        <thead>
            <th>รหัส</th>
            <th>วันที่</th>
            <th>ที่อยู่</th>
            <th>ราคารวม</th>
            <th>เพิ่มเติม</th>
            <th>สถานะ</th>
        </thead>
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
                    <td style="text-align: center;"><?php echo $data["order_id"] ?></td>
                    <td><?php echo date_format($date, "d/m/y"); ?></td>
                    <td><?php echo $data["order_address"] ?></td>
                    <td><?php echo $data["order_total"] ?></td>
                    <td><button class="btn_show">ดู</button></td>
                    <td <?php echo $color_status; ?>><?php echo $order_status ?></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.21/api/fnFilterClear.js"></script>
    <script type="text/javascript" src="jquery.dataTables.js"></script>
    <script type="text/javascript" src="dataTables.filter.range.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').keyup(function() {
                table.draw();
            });

        });

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = parseInt($('#min').val(), 10);
                var max = parseInt($('#max').val(), 10);
                var total = parseFloat(data[3]) || 0; // use data for the age column

                if ((isNaN(min) && isNaN(max)) ||
                    (isNaN(min) && total <= max) ||
                    (min <= total && isNaN(max)) ||
                    (min <= total && total <= max)) {
                    return true;
                }
                return false;
            }
        );
    </script>
</body>

</html>
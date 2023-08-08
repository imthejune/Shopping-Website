<div class="row mb-3  text-center" style="background-color: #fff;">
    <?php


    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $page = isset($_GET['pageback']) ? $_GET['pageback'] : '';
    include "../connect.php";
    $sql = "SELECT * FROM `order` WHERE order_id = $id ";
    $result = $con->query($sql);
    $data = mysqli_fetch_array($result);
    $date = date_create($data['order_date']);
    $date_delivery = date_create($data['delivery_date']);


    if ($data["order_post"] == 30) {
        $post = "แบบธรรมดา 30 บาท";
    } else  if ($data["order_post"] == 40) {
        $post = "EMS 40 บาท";
    } else  if ($data["order_post"] == 50) {
        $post = "Kerry 50 บาท";
    }
    ?>
    <div class="col-1 p-1">
        <a href="admin.php?nextpage=report&page=<?php echo $page ?>">
            <button class="btn_back" id="btnsubmit "><i class="fas fa-arrow-left"></i></button></a>
    </div>

    <div class="col-2  d-flex align-items-center pt-1 ">
        <span>รหัสสั่งซื้อ : <?php echo $data['order_id'] ?></span>
    </div>
    <div class="col-4 d-flex align-items-center pt-1">
        <span>ชื่อผู้สั่งซื้อ : <?php echo $data['order_name'] ?></span>
    </div>
    <div class="col-5 d-flex align-items-center pt-1">
        <span>ราคารวม : ฿<?php echo $data['order_total'] ?>.00</span>
    </div>
    <div class="col-1 ">
    </div>
    <div class="col-6 d-flex align-items-center pt-1">
        <span>วัน-เวลา : <?php echo date_format($date, "d/m/y H:i:s"); ?></span>
    </div>
    <div class="col-5 d-flex align-items-center  pt-1">
        <span>เบอร์โทร : <?php echo $data['order_tel'] ?></span>
    </div>
    <div class="col-1 d-flex align-items-center ">
    </div>
    <div class="col-6 d-flex align-items-center  pt-1 pb-1">
        <span style="text-align: left;word-break: break-all;">ที่อยู่ : <?php echo $data['order_address'] ?></span>
    </div>
    <div class="col-5 d-flex  pt-1 pb-1">
        <span>สถานะ : <?php echo $data['order_status'] ?></span>
    </div>
    <div class="col-2 p-2">
        <div <?php if ($data['order_status'] != "อยู่ระหว่างขนส่ง") {
                    echo 'hidden';
                } ?>><a class="btn btn-success" href="../lib/tcpdf/genpdf_delivery.php?id=<?php echo $data["order_id"] ?>" target="_blank">ออกรายการสั่งซื้อ</a></div>
        <div <?php if (
                    $data['order_status'] != "รอการชำระเงิน" && $data['order_status'] != "กำลังตรวจสอบ" &&
                    $data['order_status'] != "ชำระเงินไม่สำเร็จ" && $data['order_status'] != "กำลังเตรียมจัดส่ง"
                ) {
                    echo 'hidden';
                } ?>><a class="btn btn-success" href="../lib/tcpdf/genpdf.php?id=<?php echo $data["order_id"] ?>" target="_blank">ออกรายการสั่งซื้อ</a></div>
    </div>

</div>

<div class="row mb-3 row_cart text-center">
    <div class="col-1">ลำดับ</div>
    <div class="col-6"></div>
    <div class="col-2">ราคา</div>
    <div class="col-1">จำนวน</div>
    <div class="col-2 text-right">ราคารวม</div>
</div>



<?php
include '../connect.php';
include "../environment.php";

$sql = "SELECT * from  $join_order_detail where od.order_id =  $id  ORDER BY od.order_id ASC";

$result = $con->query($sql);
$result_array = array();
$i = 0;
if (mysqli_num_rows($result) == 0) {
    echo "ไม่พบข้อมูล";
}
while ($datarow = mysqli_fetch_array($result)) {
    $i++;
?>
    <div class="row mb-1 text-center" style="background-color:#fff;align-items: center;">
        <div class="col-1">
            <?php echo $i ?>
        </div>
        <div class="col-6 d-flex">
            <div class="pt-1 pb-1" style="width: 100px; height: 100px;">
                <img src="../img/upload/<?php echo $datarow["picture"]; ?>" style=" object-fit: cover;" class="w-100 h-100" alt="">
            </div>
            <span class="ml-2 pt-1 pb-1" style="line-break: anywhere;"><?php echo $datarow["product_name"]; ?></span>
        </div>
        <div class="col-2">฿<?php echo $datarow["product_price_total"]; ?>.00</div>
        <div class="col-1"><?php echo $datarow["order_qty"]; ?></div>
        <div class="col-2 text-right">฿<?php echo $datarow["order_sum"]; ?>.00</div>
    </div>
<?php } ?>

<div class="row mb-1 row_cart text-center">
    <div class="col-1"></div>
    <div class="col-9 text-right">ค่าจัดส่ง (<?php echo $post; ?>)</div>
    <div class="col-2 text-right">฿<?php echo $data["order_post"]; ?>.00</div>
</div>

<div class="row mb-1 row_cart text-center">
    <div class="col-1"></div>
    <div class="col-6"></div>
    <div class="col-3" style="color: red;">ราคาสุทธิ</div>
    <div class="col-2 text-right" style="color: red;">฿<?php echo $data["order_total"]; ?>.00</div>
</div>

<div class="row  pb-3 mb-4" style="background-color:#fff;" <?php if ($data['order_status'] != "กำลังตรวจสอบ") {
                                                                echo 'hidden';
                                                            } ?>>
    <div class="col-12 p-0 check">
        <span> ตรวจสอบการชำระเงิน</span>
    </div>
    <div class="col-6  text-center">
        <div class="pt-4">
            <img src="../img/bank/<?php echo $data["bank_img"]; ?>" style="width: 100%; height: 370px;object-fit: contain;" alt="">
        </div>
        <a href="report/order/img_show.php?id=<?php echo $data["bank_img"]; ?>" target="_black">ดูขนาดจริง</a>
    </div>

    <div class="col-6">
        <form action="report/order/confirm_payment.php?id=<?php echo $data['order_id'] ?>" method="post">
            <div class="pt-4">
                <span>ธนาคาร : <?php echo $data["bank_name"]; ?></span>
            </div>
            <div class="pt-2">
                <span>วันที่ชำระเงิน : <?php $date_bank = date_create($data["bank_date"]);
                                        echo date_format($date_bank, "d/m/y H:i:s"); ?></span>
            </div>

            <div class="pt-2">
                <span>สถานะข้อมูล : </span>
                <span><input type="radio" name="status" id="status" value="กำลังเตรียมจัดส่ง" onclick="status_show(true)"> ผ่าน</span>
                <span><input type="radio" name="status" id="status" value="ชำระเงินไม่สำเร็จ" onclick="status_show(false)"> ไม่ผ่าน</span>
            </div>
            <div class="pt-2" id="status_detail" hidden>
                <span>หมายเหตุ : </span>
                <textarea id="comment" name="comment" class="form-control" style="width: 100%;" required></textarea>
            </div>
            <div class="pt-2">
                <button type="submit" class="btn_show2">ยืนยัน</button>
            </div>

        </form>
    </div>


</div>

<div class="row  pb-3 mb-4" style="background-color:#fff;" <?php if ($data['order_status'] != "กำลังเตรียมจัดส่ง") {
                                                                echo 'hidden';
                                                            } ?>>
    <div class="col-12 p-0 check">
        <span>จัดส่งสินค้า</span>
    </div>

    <div class="col-6">
        <form action="report/order/tracking_number.php?id=<?php echo $data['order_id'] ?>" method="post">
            <div class="col-6 pt-4">
                <span>วัน - เวลา</span>
                <input class="form-control" type="datetime-local" id="delivery_date" name="delivery_date" required>
            </div>
            <div class="col-6 pt-2">
                <span>เลขพัสดุ</span>
                <input class="form-control" type="text" id="tracking_number" name="tracking_number" required>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn_show2">ยืนยัน</button>
            </div>

        </form>
    </div>


</div>

<div class="row mb-4 text-center" style="background-color: #00cc00;align-items: center; " <?php if ($data['order_status'] != "อยู่ระหว่างขนส่ง") {
                                                                                                echo 'hidden';
                                                                                            } ?>>
    <div class="col-12" style="text-align: left; height: 40px; display: flex; align-items: center;color:#fff">
        <span>วันที่จัดส่ง : </span>
        <span class="pl-2"><?php echo date_format($date_delivery, "d/m/y H:i:s"); ?></span>
    </div>
    <div class="col-12" style="text-align: left; height: 40px; display: flex; align-items: center;color:#fff">
        <span>เลขพัสดุ : </span>
        <span class="pl-2"><?php echo $data["tracking_number"]; ?></span>
    </div>
</div>

<div class="row mb-4 text-center" style="background-color: #ffcc00;align-items: center; " <?php if ($data['order_status'] != "ชำระเงินไม่สำเร็จ") {
                                                                                                echo 'hidden';
                                                                                            } ?>>
    <div class="col-12" style="text-align: left; height: 40px; display: flex; align-items: center;color:#FF0000">
        <span>***หมายเหตุ : </span>
        <span class="pl-2"><?php echo $data["comment"]; ?></span>
    </div>
</div>

<script>
    var payment = document.getElementById('payment');
    var bank = document.getElementById('bank');
    var Payapl = document.getElementById('Payapl');
    var Fbank = document.getElementById('Fbank');
    var FPayapl = document.getElementById('FPayapl');

    bank.onclick = function() {
        Fbank.hidden = false;
        FPayapl.hidden = true;
    }
    Payapl.onclick = function() {
        FPayapl.hidden = false;
        Fbank.hidden = true;
    }

    function status_show(i) {
        document.getElementById('status_detail').hidden = i;
        document.getElementById('comment').disabled = i;

    }


    function readURL(input) {
        // var picz = [];
        if (input.files && input.files[0]) {

            var reader = new FileReader();
            reader.onload = function(e) {
                // picz.push(e.target.result);
                document.getElementById('icon').style = "display:none";
                document.getElementById('show_img').style = "display:block";
                document.getElementById('show_img').src = e.target.result;
                document.getElementById('close').style = "display:block;    color: #e9ecef;";
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function delete_pic() {
        document.getElementById('show_img').style = "display:none";
        document.getElementById('icon').style = "display:block";
        document.getElementById('close').style = "display:none";
        // document.getElementById('show').src ="";
        picz = null;
    }
</script>
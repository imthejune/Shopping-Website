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
        <a href="user.php?nextpage=manage&page=<?php echo $page ?>">
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
                } ?>><a class="btn btn-success" href="../lib/tcpdf/genpdf_delivery.php?id=<?php echo $data["order_id"] ?>" target="_black">ออกรายการสั่งซื้อ</a></div>
        <div <?php if (
                    $data['order_status'] != "รอการชำระเงิน" && $data['order_status'] != "กำลังตรวจสอบ" &&
                    $data['order_status'] != "ชำระเงินไม่สำเร็จ" && $data['order_status'] != "กำลังเตรียมจัดส่ง"
                ) {
                    echo 'hidden';
                } ?>><a class="btn btn-success" href="../lib/tcpdf/genpdf.php?id=<?php echo $data["order_id"] ?>" target="_black">ออกรายการสั่งซื้อ</a></div>
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

<div class="row mb-4 text-center" style="background-color:#fff;align-items: center;" <?php if ($data['order_status'] != "รอการชำระเงิน" && $data['order_status'] != "ชำระเงินไม่สำเร็จ") {
                                                                                            echo 'hidden';
                                                                                        } ?>>
    <a href="#payment" class="w-100"><button class="btn_submit" id="btn_bill">ชำระเงิน</button></a>
</div>

<div class="row  mb-4 text-center" style="background-color: #00cc00;align-items: center; " <?php if ($data['order_status'] != "อยู่ระหว่างขนส่ง") {
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

<div id="payment" hidden style=" background-color:#fff">

    <div class="row">
        <div class="col-6 p-0">
            <a href="#Wdate" class="w-100"><button class="btn_bill" id="bank">ชำระผ่านธนาคาร</button></a>
        </div>
        <div class="col-6 p-0 d-flex">
            <a href="#Paypal" class="w-100"><button class="btn_bill" id="Payapl">ชำระผ่าน Paypal</button></a>
        </div>
        <form action="manage/payment.php?id=<?php echo $data['order_id'] ?>" method="post" class="w-100" id="Fbank" enctype="multipart/form-data">
            <div class="col-4 pt-2">
                <span> ธนาคาร :</span>
                <select name="Wname" id="Wname" class="form-control" required>
                    <option value="" disabled selected>เลือกธนาคาร</option>
                    <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                    <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                    <option value="ธนาคารไทยพาณิชย์">ธนาคารไทยพาณิชย์</option>
                    <option value="ธนาคารกรุงเทพ">ธนาคารกรุงไทย</option>
                    <option value="ธนาคารออมสิน">ธนาคารออมสิน</option>
                </select>
            </div>

            <div class="col-4 pt-2">
            </div>

            <div class="col-4 pt-2">
            </div>
            <div class="col-4 pt-2">
                <span> วัน-เวลา :</span>
                <input class="form-control" type="datetime-local" id="bank_date" name="bank_date" required>
            </div>
            <div class="col-4 pt-2">
            </div>
            <div class="col-4 pt-2">
            </div>
            <div class="col-12 pt-2">
                <span> อัพโหลดรูปภาพ (ขนาดไม่เกิน 1 mb)</span>
                <div class="pic-box d-flex justify-content-center align-items-center">
                    <i class="far fa-times-circle inner_position_left" id="close" style="display:none" onclick="delete_pic()"></i>
                    <input type="file" class="input_file" id="inputimg" name="inputimg" accept='image/*' onchange="readURL(this)" required>
                    <div>
                        <i class="fa fa-image fa-2x " id="icon"></i>
                    </div>
                    <div>
                        <img class="pic-box picsize" id="show_img" src="" alt="test1" style="display:none">
                    </div>
                </div>
            </div>
            <div class="col-12 pt-2  pb-3">
                <button class="btn_submit" type="submit" id="btn_bill">ชำระเงิน</button>
            </div>
        </form>

        <form action="manage/payment_paypal.php" method="post" class="w-100" id="FPayapl">
            <div class="col-12 pt-2 pb-3">

                <!-- Include the PayPal JavaScript SDK -->
                <script src="https://www.paypal.com/sdk/js?client-id=AVuAlV-Qy0bPxWPh9t2VVYyoAj6vWflaSbz4X9WuQvBbouyfQtFzFCNC3YoVufHEJqovnLiRc5vScnKV&currency=THB"></script>

                <!-- Set up a container element for the button -->
                <div class="col-12 pt-2 pb-3 text-center" id="paypal-button-container"></div>

                <script>
                    // Render the PayPal button into #paypal-button-container
                    paypal.Buttons({

                        // Set up the transaction
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: '<?php echo $data["order_total"]; ?>'
                                    }
                                }]
                            });
                        },

                        // Finalize the transaction
                        onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                                // Show a success message to the buyer
                                alert('การชำระเงินเสร็จสมบูรณ์โดย ' + details.payer.name.given_name + '!');
                                location.href = "manage/payment_paypal.php?id=<?php echo $data['order_id'] ?>";
                            });
                        }


                    }).render('#paypal-button-container');
                </script>

            </div>
        </form>
    </div>


</div>



<script>
    var btn_bill = document.getElementById('btn_bill');
    var payment = document.getElementById('payment');
    var bank = document.getElementById('bank');
    var Payapl = document.getElementById('Payapl');
    var Fbank = document.getElementById('Fbank');
    var FPayapl = document.getElementById('FPayapl');

    btn_bill.onclick = function() {
        btn_bill.hidden = true;
        payment.hidden = !payment.hidden;
        FPayapl.hidden = true;
    }

    bank.onclick = function() {
        Fbank.hidden = false;
        FPayapl.hidden = true;
    }
    Payapl.onclick = function() {
        FPayapl.hidden = false;
        Fbank.hidden = true;
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
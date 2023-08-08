<div class="container pt-3" style="max-width: 1300px;">
    <div class="row">
        <div class="col-8 p-0 pr-4">
            <div style="padding-left: 10px; background-color: #ffa31a;font-size: 18px;">รายการสินค้า</div>
            <div class="row mb-3 row_cart text-center">
                <div class="col-1"></div>
                <div class="col-7"></div>
                <div class="col-2">ราคา</div>
                <div class="col-2">จำนวน</div>
            </div>

            <form action="order/check_qtynew.php" method="post">

                <!-- mascord -->
                <div style="position: fixed; z-index: 50; bottom: 10px;  right: 1px;">
                    <div>
                        <input type="image" src="../img/data/mascord.png" alt="Submit Form" style="width: 100px;cursor:pointer;outline: none;" />
                    </div>
                </div>


                <?php
                include '../connect.php';
                include "../environment.php";
                $intLine = (isset($_SESSION['intLine'])) ? $_SESSION['intLine'] : '';
                $strProductID = (isset($_SESSION['strProductID'])) ? $_SESSION['strProductID'] : '';
                $Total = 0;
                $Checkbill = 0;
                $Pdata = array();
                $SumTotal = 0;
                $status = false;
                for ($i = 0; $i <= (int) $intLine; $i++) {
                    if (!empty($strProductID[$i])) {
                        $sql = "SELECT * FROM $join_product WHERE product_id = '" . $_SESSION["strProductID"][$i] . "' ";
                        $result = $con->query($sql);
                        $data = mysqli_fetch_array($result);
                        $Total = $_SESSION["strQty"][$i] * $data["product_price_total"];
                        $SumTotal = $SumTotal + $Total;
                        $Checkbill = $SumTotal + 30;
                        $Pdata[] = $i;
                        $status = true;
                ?>

                        <div class="row mb-1" style="background-color:#fff;align-items: center;">

                            <div class="col-1">
                                <a class="btnDelete" href="order/deletecart.php?Line=<?php echo $i; ?>">
                                    <i class="de_icon fas fa-minus-circle" style="font-size: xx-large;"></i>
                                </a>
                            </div>
                            <div class="col-7 d-flex">
                                <div class="pt-1 pb-1" style="width: 100px; height: 100px;">
                                    <img src="../img/upload/<?php echo $data["picture"]; ?>" style=" object-fit: cover;" class="w-100 h-100" alt="">
                                </div>
                                <span class="ml-2 pt-1 pb-1" style="line-break: anywhere;"><?php echo $data["product_name"]; ?></span>
                            </div>
                            <div class="col-2 text-center">
                                <div class="cart_price1">฿<?php echo $data["product_price_total"]; ?></div>
                                <div class="cart_price2">฿<?php echo $data["product_price_start"]; ?></div>
                                <div class="cart_price3">-<?php echo $data["promotion_discount"]; ?>%</div>
                            </div>
                            <div class="col-2 text-center d-flex" style="align-items: center;">
                                <i class="fas fa-minus icon_qty_m" style="color: black !important;" id="minus" onclick="minus(<?php echo $i ?>,<?php echo $data['product_price_total']; ?>)"></i>
                                <input class="form-control input_qty" type="text" value="<?php echo $_SESSION["strQty"][$i]; ?>" name="qty<?php echo $i ?>" id="qty<?php echo $i ?>" maxlength="4" onkeypress="return isNumberKey(event,<?php echo $data['product_qty']; ?>,<?php echo $i ?>)" onchange="Calculate(<?php echo $i ?>,<?php echo $data['product_price_total']; ?>,<?php echo $data['product_qty']; ?>)">
                                <i class="fas fa-plus icon_qty_p" id="plus" style="color: black !important;" onclick="plus(<?php echo $i ?>,<?php echo $data['product_qty']; ?>,<?php echo $data['product_price_total']; ?>)"></i>
                            </div>
                            <input type="text" hidden name="total<?php echo $i ?>" id="total<?php echo $i ?>" value="<?php echo $Total ?>">
                        </div>
                <?php }
                }
                $json_array = json_encode($Pdata); ?>

            </form>

        </div>

        <div class="col-4 p-0" <?php if ($status == false) {
                                    echo "style='display : none'";
                                } ?>>

            <form action="order/saveorder.php" method="post">

                <div>
                    <?php
                    include '../connect.php';
                    include "../environment.php";
                    $intLine = (isset($_SESSION['intLine'])) ? $_SESSION['intLine'] : '';
                    $strProductID = (isset($_SESSION['strProductID'])) ? $_SESSION['strProductID'] : '';
                    $Total = 0;
                    $Checkbill = 0;
                    $Pdata = array();
                    $SumTotal = 0;
                    $status = false;
                    for ($i = 0; $i <= (int) $intLine; $i++) {
                        if (!empty($strProductID[$i])) {
                            $sql = "SELECT * FROM $join_product WHERE product_id = '" . $_SESSION["strProductID"][$i] . "' ";
                            $result = $con->query($sql);
                            $data = mysqli_fetch_array($result);
                            $Total = $_SESSION["strQty"][$i] * $data["product_price_total"];
                            $SumTotal = $SumTotal + $Total;
                            $Checkbill = $SumTotal + 30;
                            $Pdata[] = $i;
                            $status = true;

                    ?>
                            <div class="row">
                                <div class="col-12 d-flex">
                                    <input type="text" hidden name="Sproduct<?php echo $i ?>" id="Sproduct<?php echo $i ?>" value="<?php echo $data["product_id"]; ?>">
                                    <input type="text" hidden value="<?php echo $_SESSION["strQty"][$i]; ?>" name="Sqty<?php echo $i ?>" id="Sqty<?php echo $i ?>" maxlength="4">
                                </div>
                            </div>


                    <?php
                        }
                    }

                    ?>
                </div>


                <div style="padding-left: 10px; background-color: #ffa31a;font-size: 18px;">ที่อยู่ในการจัดส่ง</div>
                <div class="row Rprofile pb-2 mb-2" style="background-color: #fff">
                    <?php
                    $sqlmember = "SELECT * FROM member WHERE user_id = '" . $_SESSION["user_id"] . "' ";
                    $result = $con->query($sqlmember);
                    $data = mysqli_fetch_array($result);
                    ?>
                    <div class="col-10 pl-2 pt-2 d-flex">
                        <span><i class="fas fa-user"></i></span>
                        <div class="pl-2">
                            <input id="name" name="name" value="<?php echo $data["frist_name"]; ?>&nbsp;<?php echo $data["last_name"]; ?>" disabled> </div>
                    </div>
                    <div class="col-2 pl-2 pt-2" style=" text-align:end;">
                        <a href="#" id="Cname">แก้ไข</a>
                    </div>
                    <div class="col-10 pl-2 pt-2 d-flex">
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <div class="pl-2">
                            <textarea class="w-100" name="address" id="address" cols="50" rows="4" disabled><?php echo $data["address"]; ?></textarea>
                        </div>
                    </div>
                    <div class="col-2 pl-2 pt-2" style=" text-align:end;">
                        <a href="#" id="CAddress">แก้ไข</a>
                    </div>

                    <div class="col-10 pl-2 pt-2 d-flex">
                        <span><i class="fas fa-phone-alt"></i></span>
                        <div class="pl-2">
                            <input id="tel" name="tel" value="<?php echo $data["tel"]; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-2 pl-2 pt-2" style=" text-align:end;">
                        <a href="#" id="CTel">แก้ไข</a>
                    </div>
                    <div class="col-10 pl-2 pt-2 d-flex">
                        <span><i class="fas fa-envelope"></i></span>
                        <div class="pl-2">
                            <input id="email" name="email" value="<?php echo $data["email"]; ?>" disabled>
                        </div>
                    </div>
                    <div class="col-2 pl-2 pt-2" style=" text-align:end;">
                        <a href="#" id="CEmail">แก้ไข</a>
                    </div>
                </div>

                <div style="padding-left: 10px; background-color: #ffa31a;font-size: 18px;">ตัวเลือกในการจัดส่ง</div>
                <div class="row Rprofile pb-2 mb-2" style="background-color: #fff;">
                    <div class="col-12 pt-2">
                        <div class="d-flex align-items-center">
                            <input type="radio" checked name="post" id="post" value="30" onclick="pricepost(30)">
                            <span class="pl-2">฿30.00</span>
                            <span class="pl-1" style="font-size: 13px;">แบบธรรมดา</span>
                        </div>

                        <div class="d-flex align-items-center">
                            <input type="radio" name="post" id="post" value="40" onclick="pricepost(40)">
                            <span class="pl-2">฿40.00</span>
                            <span class="pl-1" style="font-size: 13px;">EMS</span>
                        </div>


                        <div class="d-flex align-items-center">
                            <input type="radio" name="post" id="post" value="50" onclick="pricepost(50)">
                            <span class="pl-2">฿50.00</span>
                            <span class="pl-1" style="font-size: 13px;">Kerry</span>
                        </div>


                    </div>
                </div>

                <div style="padding-left: 10px; background-color: #ffa31a;font-size: 18px;">สรุปข้อมูลคำสั่งซื้อ</div>
                <div class="row Rprofile pb-2 mb-2" style="background-color: #fff">
                    <div class="col-9 pl-2 pt-2 d-flex">
                        <span>ยอดรวม</span>
                    </div>
                    <div class="col-3 pl-2 pt-2" style=" text-align:end;">
                        <span id="showbill">$<?php echo $SumTotal; ?>.00</span>
                        <input type="text" name="bill" id="bill" value="<?php echo $SumTotal; ?>" hidden>

                    </div>
                    <div class="col-9 pl-2 pt-2 d-flex">
                        <span>ค่าจัดส่ง</span>
                    </div>
                    <div class="col-3 pl-2 pt-2" style=" text-align:end;">
                        <input type="text" name="Ppost" id="Ppost" value="30" hidden>
                        <span id="showpost">$30.00</span>
                    </div>
                    <div class="col-9 pl-2 pt-2 d-flex">
                        <span>ยอดรวมทั้งสิ้น</span>
                    </div>
                    <div class="col-3 pl-2 pt-2" style=" text-align:end;">
                        <input type="text" name="checkbill" id="checkbill" value="<?php echo $Checkbill; ?>" hidden>
                        <span id="showcheckbill">$<?php echo $Checkbill; ?>.00</span>
                    </div>
                    <div class="col-12 pt-2">
                        <button class="btn_submit" id="btnsubmit">สั่งซื้อ</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</div>


<script>
    var Cname = document.getElementById('Cname');
    var CnameT = true;
    var CAddress = document.getElementById('CAddress');
    var CAddressT = true;
    var CTel = document.getElementById('CTel');
    var CTelT = true;
    var CEmail = document.getElementById('CEmail');
    var CEmailT = true;
    var btnsubmit = document.getElementById('btnsubmit');
    Cname.onclick = function() {
        if (CnameT) {
            Cname.innerHTML = 'บันทึก'
        } else {
            Cname.innerHTML = 'แก้ไข'
        }
        CnameT = !CnameT;
        document.getElementById('name').disabled = CnameT;
    }

    CAddress.onclick = function() {
        if (CAddressT) {
            CAddress.innerHTML = 'บันทึก'
        } else {
            CAddress.innerHTML = 'แก้ไข'
        }
        CAddressT = !CAddressT;
        document.getElementById('address').disabled = CAddressT;
    }
    CTel.onclick = function() {
        if (CTelT) {
            CTel.innerHTML = 'บันทึก'
        } else {
            CTel.innerHTML = 'แก้ไข'
        }
        CTelT = !CTelT;
        document.getElementById('tel').disabled = CTelT;
    }
    CEmail.onclick = function() {
        if (CEmailT) {
            CEmail.innerHTML = 'บันทึก'
        } else {
            CEmail.innerHTML = 'แก้ไข'
        }
        CEmailT = !CEmailT;
        document.getElementById('email').disabled = CEmailT;
    }

    btnsubmit.onclick = function() {
        document.getElementById('name').disabled = false;
        document.getElementById('tel').disabled = false;
        document.getElementById('address').disabled = false;
        document.getElementById('email').disabled = false;
    }


    function pricepost(price) {
        console.log(price);
        document.getElementById('showpost').innerHTML = '$' + price + '.00';
        document.getElementById('Ppost').value = price;
        let aa = document.getElementById("bill");
        let bill = parseInt(aa.value);
        document.getElementById('showcheckbill').innerHTML = '$' + (price + bill) + '.00';
        document.getElementById('checkbill').value = price + bill;
    }

    function minus(id, price) {
        let qty = document.getElementById("qty" + id);
        let total_row = document.getElementById("total" + id);
        let new_qty = parseInt(qty.value);
        if (new_qty <= 0) {
            return;
        } else if (new_qty > 1) {
            let total = new_qty - 1;
            qty.value = total;
            let Sqty = document.getElementById("Sqty" + id);
            Sqty.value = total;
            let newtotal = price * total;
            total_row.value = newtotal;
        }

        let bill = document.getElementById("bill");
        let showbill = document.getElementById("showbill");
        let data = <?php echo $json_array; ?>;
        let newsum = 0;
        for (i = 0; i <= data.length - 1; i++) {
            let new1 = document.getElementById("total" + data[i]);
            let bill1 = parseInt(new1.value);
            newsum = newsum + bill1;
        }
        bill.value = newsum;
        showbill.innerHTML = "฿" + newsum + ".00";

        let aa = document.getElementById('Ppost').value;
        let post = parseInt(aa);
        document.getElementById('showcheckbill').innerHTML = '$' + (post + newsum) + '.00';
        document.getElementById('checkbill').value = post + newsum;
    }

    function plus(id, pro_qty, price) {
        let qty = document.getElementById("qty" + id);
        let total_row = document.getElementById("total" + id);
        let new_qty = parseInt(qty.value);
        if (new_qty >= pro_qty) {
            return;
        } else if (new_qty >= 0) {
            let total = new_qty + 1;
            qty.value = total;
            let Sqty = document.getElementById("Sqty" + id);
            Sqty.value = total;
            let newtotal = price * total;
            total_row.value = newtotal;

        } else {
            qty.value = 0;
        }

        let bill = document.getElementById("bill");
        let showbill = document.getElementById("showbill");
        let data = <?php echo $json_array; ?>;
        let newsum = 0;
        for (i = 0; i <= data.length - 1; i++) {
            let new1 = document.getElementById("total" + data[i]);
            let bill1 = parseInt(new1.value);
            newsum = newsum + bill1;
        }
        bill.value = newsum;
        showbill.innerHTML = "฿" + newsum + ".00";

        let aa = document.getElementById('Ppost').value;
        let post = parseInt(aa);
        document.getElementById('showcheckbill').innerHTML = '$' + (post + newsum) + '.00';
        document.getElementById('checkbill').value = post + newsum;
    }

    function Calculate(id, price, pro_qty) {
        let qty = document.getElementById("qty" + id);
        let total_row = document.getElementById("total" + id);
        let bill = document.getElementById("bill");
        let showbill = document.getElementById("showbill");
        let new_qty = parseInt(qty.value);
        let newtotal = price * new_qty;
        total_row.value = newtotal;
        let data = <?php echo $json_array; ?>;
        let newsum = 0;
        let Sqty = document.getElementById("Sqty" + id);

        Sqty.value = qty.value;
        if (qty.value > pro_qty) {
            qty.value = pro_qty;
            Sqty.value = qty.value;
            return;
        }
        if (qty.value == "") {
            qty.value = 1;
            Sqty.value = 1;
            return;
        }

        for (i = 0; i <= data.length - 1; i++) {
            let new1 = document.getElementById("total" + data[i]);
            let bill1 = parseInt(new1.value);
            newsum = newsum + bill1;
        }
        bill.value = newsum;
        showbill.innerHTML = "฿" + newsum + ".00";


        let aa = document.getElementById('Ppost').value;
        let post = parseInt(aa);
        document.getElementById('showcheckbill').innerHTML = '$' + (post + newsum) + '.00';
        document.getElementById('checkbill').value = post + newsum;
    }

    function isNumberKey(evt, pro_qty, id) {
        let key = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        let qty = document.getElementById("qty" + id);
        let total_row = document.getElementById("total" + id);
        let new_qty = parseInt(qty.value);
        if (pro_qty < new_qty) {
            qty.value = pro_qty;
            return false;
        }
        if (key.includes(evt.key)) {
            return true;
        } else {
            return false
        }


    }
</script>
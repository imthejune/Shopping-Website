<!-- mascord -->
<div style="position: fixed;
    z-index: 50;
    bottom: 10px;
    right: 1px;">
    <div style="float: right; margin-top: 16px;">
        <a href="user.php?nextpage=cart">
            <img src="../img/data/mascord.png" alt="" style="width: 100px;cursor:pointer"></a>
    </div>

</div>

<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="d-flex flex-row-reverse">
            <span class="close">&times;</span>
        </div>
        <div class="container h-100">
            <div class="col-12">
                <h2>ข้อมูลเพิ่มเติม</h2>
                <hr>
            </div>
            <form action="order/check_qty.php" method="post">
                <div class="row row_modal">
                    <div class="col-6">
                        <div style="height: 450px;">
                            <img class="pic-box picsize_modal" id="m_picture" src="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12 pb-2">
                                <span>รหัสสินค้า : </span>
                                <span id="m_id"></span>
                                <input type="text" name="id_product" id="id_product" hidden>
                            </div>
                            <div class="col-12 pb-2">
                                <span>ชื่อสินค้า : </span>
                                <span id="m_name"></span>
                            </div>
                            <div class="col-12 pb-2">
                                <span>โปรโมชั่น : </span>
                                <span id="m_promotion"></span>
                            </div>
                            <div class="col-6 pb-2" style="text-decoration: line-through;">
                                <span>ราคาเริ่มต้น : </span>
                                <span id="m_price_start"></span>
                            </div>
                            <div class="col-6 pb-2" style="color: #f57224;">
                                <span>ราคาขาย : </span>
                                <span id="m_price_total"></span>
                                <span>บาท</span>
                            </div>
                            <div class="col-12 pb-2">
                                <span>ประเภท : </span>
                                <span id="m_category"></span>
                            </div>
                            <div class="col-6 pb-2">
                                <span>คงเหลือ : </span>
                                <input type="text" name="qty_product" id="qty_product" hidden>
                                <span id="m_qty"></span>
                                <span id="m_unit"></span>
                            </div>
                            <div class="col-6 pb-2">
                            </div>
                            <div class="col-6 pb-2">
                                <span>สินค้าใหม่ : </span>
                                <span id="m_new"></span>
                            </div>
                            <div class="col-6 pb-2">
                            </div>
                            <div class="col-12 pb-2">
                                <span>รายละเอียดสินค้า : </span>
                                <div style="overflow: overlay;height: 110px;background: whitesmoke;">
                                    <span id="m_detail"></span>
                                </div>
                            </div>
                            <div class="col-4 pt-2"></div>
                            <div class="col-5 pt-2 d-flex" style="align-items:center">
                                <span>จำนวน</span>
                                <div class="d-flex ml-2" style="position:relative;align-items: center;">
                                    <i class="fas fa-minus icon_qty_m" id="minus" style="left: 5px;"></i>
                                    <input class="form-control input_qty" type="text" name="qty" maxlength="4" id="qty"  onkeypress="return isNumberKey(event)">
                                    <i class="fas fa-plus icon_qty_p" id="plus" style="right: 5px;"></i> </div>

                            </div>
                            <div class="col-3 pt-2">
                                <!-- <a href="order/check_qty.php"> -->
                                <input id="order" type="submit" class="btn btn-warning w-100" value="สั่งซื้อ" style="color: #fff;">
                                <!-- </a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

<div class="container" style="z-index: 10;">
    <div class="row">
        <div class="col-12">
            <form action="user.php" method="post" id="row_cate">
                <div class="pl-3 mt-3 mb-3">
                    <div class="d-flex">
                        <select class="form-control col-3" name="search_category" id="search_category">
                            <option value="" selected disabled>ประเภทสินค้า</option>
                            <?php
                            include "../connect.php";
                            $sql = "SELECT * from category order by category_id asc  ";
                            $result = $con->query($sql);
                            while ($data = mysqli_fetch_array($result)) {
                            ?>
                                <option value="<?php echo $data["category_id"]; ?>"><?php echo $data["category_name"]; ?></option>
                            <?php } ?>
                        </select>
                        <?php

                        ?>&nbsp;
                        <input type="search" class="form-control col-sm-3" name="search_product" id="search_product" placeholder="ค้นหา...">&nbsp;&nbsp;
                        <input type="submit" class="btn btn-success ml-1" value="ค้นหา">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="user.php" method="post" id="row_cate">
                <div class="pl-3 mt-3 mb-3">
                    <div class="d-flex">
                        <input type="number" class="form-control col-2" name="price_min" id="price_min" placeholder="ราคาต่ำสุด..." required>&nbsp;&nbsp;
                        <input type="number" class="form-control col-2" name="price_max" id="price_max" placeholder="ราคาสูงสุด..." required>&nbsp;&nbsp;
                        <input type="submit" class="btn btn-success ml-1" value="ค้นหา">
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <?php
        include "../connect.php";
        include "../environment.php";
        $search_product = isset($_POST['search_product']) ? $_POST['search_product'] : '';
        $search_category = isset($_POST['search_category']) ? $_POST['search_category'] : '';
        $price_min = isset($_POST['price_min']) ? $_POST['price_min'] : '';
        $price_max = isset($_POST['price_max']) ? $_POST['price_max'] : '';
        
        if ($price_min != "" && $price_max != "") {
            $sql = "SELECT * FROM $join_product WHERE `product_price_total` BETWEEN $price_min AND $price_max ORDER BY product_price_total ASC";
        } else if ($search_category != "" && $search_product != "") {
            $sql = "SELECT * from  $join_product where  p.category_id =  $search_category and p.product_name like '%$search_product%' or p.product_price_total = '$search_product' ORDER BY product_id ASC";
        } else if ($search_product != "") {
            $sql = "SELECT * from  $join_product where  p.product_name like '%$search_product%' or p.product_price_total = '$search_product' ORDER BY product_id ASC";
        } else if ($search_category != "") {
            $sql = "SELECT * from  $join_product where  p.category_id =  $search_category  ORDER BY product_id ASC";
        } else {
            $sql = "SELECT * from  $join_product ORDER BY product_id ASC";
        }

        $result = $con->query($sql);
        $result_array = array();
        if (mysqli_num_rows($result) == 0) {
            echo "ไม่พบข้อมูล";
        }
        while ($data = mysqli_fetch_array($result)) {
            $result_array[] = $data;

        ?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-3 pb-3" onclick="showdata(<?php echo $data['product_id']; ?>)">
                <div class="card_body">
                    <div class="col-12 w-100 h-50 p-0">
                        <img class="w-100 h-100" style="object-fit: cover;" src="../img/upload/<?php echo $data['picture']; ?>" alt="">
                    </div>
                    <div class="col-12 pl-2 pr-2">
                        <div style="overflow: hidden;">
                            <div class="d-flex mt-2 card_name">
                                <span class=""><?php echo $data['product_name']; ?></span>
                            </div>
                        </div>
                        <div class="d-flex mt-2 card_price">
                            <span>฿&nbsp;</span>
                            <span><?php echo $data['product_price_total']; ?>.00</span>
                        </div>
                        <div class="d-flex mt-2 card_discount">
                            <span style="text-decoration: line-through;">
                                <span>฿&nbsp;</span><span class="price"><?php echo $data['product_price_start']; ?>.00</span>
                            </span>
                            <span class="ml-1">-<?php echo $data['promotion_discount']; ?>%</span>

                        </div>
                        <hr style="    margin-top: 0.5rem;margin-bottom: 0px;">
                        <div class="w-100 d-flex card_more">
                            ข้อมูลเพิ่มเติม
                        </div>
                    </div>
                </div>


            </div>

        <?php  }
        $json_array = json_encode($result_array);
        ?>

    </div>

</div>


<script>
    var qty_product = document.getElementById("qty_product");
    var minus = document.getElementById("minus");
    var qty = document.getElementById("qty");
    var plus = document.getElementById("plus");

    minus.onclick = function() {
        let new_qty = parseInt(qty.value);
        if (new_qty <= 0) {
            return;
        } else if (new_qty >= 1) {
            let total = new_qty - 1;
            qty.value = total;
        } else {
            qty.value = 0;
        }
    }

    plus.onclick = function() {
        let new_qty = parseInt(qty.value);
        let new_qty_product = parseInt(qty_product.value);
        console.log(new_qty_product);
        if (new_qty >= new_qty_product) {
            return;
        } else if (new_qty >= 0) {
            let total = new_qty + 1;
            qty.value = total;
        } else {
            qty.value = 0;
        }
    }


    document.addEventListener("keyup", event => {
        if (event.keyCode === 27) {
            modal.style.display = "none";
        }
    });
    


    //checknumber
    function isNumberKey(evt) {
        let key = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
       
        if (key.includes(evt.key)) {
            return true;
        } else {
            return false
        }

        if (new_qty >= new_qty_product) {
            return;
        }
    }



    //modal
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];

    function showdata(id, qty) {
        modal.style.display = "block";
        let data = <?php echo $json_array; ?>;
        data.forEach(element => {
            if (element[0] == id) {
                DataOrder = element;
                document.getElementById("m_id").innerHTML = element[0];
                document.getElementById("id_product").value = element[0];
                document.getElementById("m_name").innerHTML = element[1] + "  " + element[2];
                document.getElementById("m_price_start").innerHTML = element[2];
                document.getElementById("m_price_total").innerHTML = element[3];
                document.getElementById("m_detail").innerHTML = element[4];
                document.getElementById("m_qty").innerHTML = element[5];
                document.getElementById("qty_product").value = element[5];
                document.getElementById("m_new").innerHTML = element[6];
                document.getElementById("m_picture").src = '../img/upload/' + element['picture'];
                document.getElementById("m_category").innerHTML = element['category_name'];
                document.getElementById("m_unit").innerHTML = element['unit_name'];
                document.getElementById("m_promotion").innerHTML = element['promotion_name'];
                document.getElementById("qty").value = 1;
            }
        });
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }

    }
</script>
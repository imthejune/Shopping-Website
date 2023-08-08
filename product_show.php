<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300,400,700&amp;subset=thai" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="css/menu.scss">
    <link rel="stylesheet" href="css/style.scss">
    <link rel="stylesheet" href="admin/admin.scss">
    <title>Document</title>
</head>

<body>
    <?php include 'menu/menubar.php';  ?>


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
                            <div class="col-3 pt-2"></div>
                            <div class="col-6 pt-2 d-flex" style="    align-items:center">
                                <span>จำนวน</span>
                                <input type="number" name="" id="total_qty" class="form-control ml-2">
                            </div>
                            <div class="col-3 pt-2">
                                <a href="login.php" onClick="return confirm('กรุณาเข้าสู่ระบบ');"> <input type="button" class="btn btn-warning w-100" value="สั่งซื้อ" style="color: #fff;"></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="pl-3 mt-3 mb-3">
            <form action="product_show.php" method="post" id="row_cate">
                <div class="w-50 d-flex">
                    <select class="form-control mr-2" name="search_category" id="search_category">
                        <option value="" selected disabled>ประเภทสินค้า</option>
                        <?php
                        include "connect.php";
                        $sql = "SELECT * from category order by category_id asc  ";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $data["category_id"]; ?>"><?php echo $data["category_name"]; ?></option>
                        <?php } ?>
                    </select>
                    <?php

                    ?>
                    <input type="search" class="form-control" name="search_product" id="search_product" placeholder="ค้นหา...">
                    <input type="submit" class="btn btn-success ml-2" value="ค้นหา">
                </div>
            </form>
        </div>
        <div class="pl-3 mt-3 mb-3">
            <form action="product_show.php" method="post" id="row_cate">
                <div class="d-flex">
                    <input type="number" class="form-control col-2" name="price_min" id="price_min" placeholder="ราคาต่ำสุด..." required>&nbsp;&nbsp;
                    <input type="number" class="form-control col-2" name="price_max" id="price_max" placeholder="ราคาสูงสุด..." required>&nbsp;&nbsp;
                    <input type="submit" class="btn btn-success ml-1" value="ค้นหา">
                </div>
            </form>
        </div>

        <div class="row">
            <?php
            include "connect.php";
            include "environment.php";
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
                            <img class="w-100 h-100" style="object-fit: cover;" src="img/upload/<?php echo $data['picture']; ?>" alt="">
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
    </div>


    <script>
        document.addEventListener("keyup", event => {
            if (event.keyCode === 27) {
                modal.style.display = "none";
            }
        });


        //modal
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("myBtn");
        var span = document.getElementsByClassName("close")[0];

        function showdata(id) {
            modal.style.display = "block";
            let data = <?php echo $json_array; ?>;
            console.log(data);
            data.forEach(element => {
                if (element[0] == id) {
                    document.getElementById("m_id").innerHTML = element[0];
                    document.getElementById("m_name").innerHTML = element[1] + "  " + element[2];
                    document.getElementById("m_price_start").innerHTML = element[2];
                    document.getElementById("m_price_total").innerHTML = element[3];
                    document.getElementById("m_detail").innerHTML = element[4];
                    document.getElementById("m_qty").innerHTML = element[5];
                    document.getElementById("m_new").innerHTML = element[6];
                    document.getElementById("m_picture").src = 'img/upload/' + element['picture'];
                    document.getElementById("m_category").innerHTML = element['category_name'];
                    document.getElementById("m_unit").innerHTML = element['unit_name'];
                    document.getElementById("m_promotion").innerHTML = element['promotion_name'];
                    document.getElementById("total_qty").value = 0;

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


</body>

</html>
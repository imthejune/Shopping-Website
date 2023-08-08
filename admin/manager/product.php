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
                        <div class="col-6 pb-2">
                            <span>ราคาเริ่มต้น : </span>
                            <span id="m_price_start"></span>
                        </div>
                        <div class="col-6 pb-2">
                            <span>ราคาขาย : </span>
                            <span id="m_price_total"></span>
                        </div>
                        <div class="col-12 pb-2">
                            <span>ประเภท : </span>
                            <span id="m_category"></span>
                        </div>
                        <div class="col-6 pb-2">
                            <span>จำนวน : </span>
                            <span id="m_qty"></span>
                        </div>
                        <div class="col-6 pb-2">
                            <span>หน่วยสินค้า : </span>
                            <span id="m_unit"></span>
                        </div>
                        <div class="col-6 pb-2">
                            <span>สินค้าใหม่ : </span>
                            <span id="m_new"></span>
                        </div>
                        <div class="col-6 pb-2">
                        </div>
                        <div class="col-12 pb-2">
                            <span>รายละเอียดสินค้า : </span>
                            <div style="overflow: overlay;height: 185px;background: whitesmoke;">
                                <span id="m_detail"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div>
    <div class="row pt-1">
        <button type="button" onclick="AddCategory()" id="btn_add" class="btn btn-success">เพิ่มสินค้า</button>
        <span style="display: none; font-size: 20px;" id="add">เพิ่มสินค้า</span>
        <span style="display: none; font-size: 20px;" id="update">แก้ไขสินค้า</span>
    </div>

    <!-- ตาราง -->
    <form action="admin.php?nextpage=manager&managerpage=product" method="post" id="row_cate">
        <div class="mt-3">
            <div class="w-25 d-flex">
                <input type="search" class="form-control" name="search_product" id="search_product" placeholder="ค้นหา...">
                <input type="submit" class="btn btn-success ml-2" value="ค้นหา">
            </div>
            <div class="select_product mt-2 ">
                <div class="row  row_select">
                    <div class="col-1 h_l">รหัสสินค้า</div>
                    <div class="col-3 h_c">ชื่อสินค้า</div>
                    <div class="col-1 h_c">ประเภท</div>
                    <div class="col-2 h_c">ราคา</div>
                    <div class="col-1 h_c">โปรโมชั่น</div>
                    <div class="col-1 h_c">จำนวน</div>
                    <div class="col-1 h_c">สินค้าค้าใหม่</div>
                    <div class="col-2 h_r"></div>

                </div>

                <?php
                include "../connect.php";
                include "../environment.php";
                $search_product = isset($_POST['search_product']) ? $_POST['search_product'] : '';

                if ($search_product != "") {
                    $sql = "SELECT * from  $join_product where p.product_id like '%$search_product%'  or p.product_name like '%$search_product%' or p.product_price_total = '$search_product' ORDER BY product_id ASC";
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
                    <div class="row row_select">
                        <div class="col-1 r_c">
                            <div><?php echo $data["product_id"]; ?></div>
                        </div>
                        <div class="col-3 r_c">
                            <div><?php echo $data["product_name"]; ?></div>
                        </div>
                        <div class="col-1 r_c">
                            <div><?php echo $data["category_name"]; ?></div>
                        </div>
                        <div class="col-2 r_c">
                            <div><?php echo $data["product_price_total"]; ?></div>
                        </div>
                        <div class="col-1 r_c">
                            <div><?php echo $data["promotion_name"]; ?></div>
                        </div>
                        <div class="col-1 r_c">
                            <div><?php echo $data["product_qty"]; ?></div>
                        </div>
                        <div class="col-1 r_c">
                            <div><?php echo $data["product_new"]; ?></div>
                        </div>
                        <div class="col-2 r_r p-0">
                            <div class="row h-100">
                                <div class="col-4 pl-2 pr-2 h-100 ">
                                    <input type="button" value="ข้อมูล" id="myBtn" class="btn btn_row btn-primary" onclick="showdata(<?php echo $data['product_id']; ?>)" style="width: 45px;padding: 3px 0px;">
                                </div>
                                <div class="col-4 pl-2 pr-2 h-100">
                                    <a href="admin.php?nextpage=manager&managerpage=product&id=<?php echo $data["product_id"]; ?>" class="btn btn_row btn-warning" style="width: 45px;padding: 3px 0px;">แก้ไข</a>
                                </div>
                                <div class="col-4 pl-2 pr-2 h-100">
                                    <a href="manager/delete/delect_product.php?id=<?php echo $data["product_id"]; ?>" class="btn btn_row btn-danger" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');" style="width: 45px; padding: 3px 0px;">ลบ</a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                }
                $json_array = json_encode($result_array);
                ?>

            </div>
        </div>
    </form>



    <!-- เพิ่ม -->
    <form action="manager/insert/insert_product.php" method="post" enctype="multipart/form-data">
        <div class="row mt-3 add_form" style="display: none" id="form_add">
            <div class="col-12 pt-3 pb-3">
                <div class="pic-box d-flex justify-content-center align-items-center">
                    <i class="far fa-times-circle inner_position_left" id="close" style="display:none" onclick="delete_pic()"></i>
                    <input type="file" class="input_file" id="inputimg" name="inputimg" accept='image/*' onchange="readURL(this)">
                    <div>
                        <i class="fa fa-image fa-2x " id="icon"></i>
                    </div>
                    <div>
                        <img class="pic-box picsize" id="show_img" src="" alt="test1" style="display:none">
                    </div>
                </div>
            </div>
            <div class="col-5 ">
                <span>ชื่อสินค้า : </span><br>
                <input type="text" class="form-control" name="name" style="height: fit-content;">
            </div>
            <div class="col-3 ">
                <span>โปรโมชั่น : </span><br>
                <div class="form-group">

                    <select class="form-control" name="promotion" id="promotion" onchange="SumPrice(price_start.value,this.value)">
                        <option value="" disabled selected>เลือกโปรโมชั่น</option>
                        <?php
                        include "../connect.php";
                        $sql = "SELECT * from  promotion ORDER BY 'promotion_id' ASC ";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $data["promotion_discount"]; ?>"><?php echo $data["promotion_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-2 ">
                <span>ราคาเริ่มต้น : </span><br>
                <input type="number" class="form-control" name="price_start" id="price_start" onchange="SumPrice(this.value,promotion.value)" onkeyup="SumPrice(this.value,promotion.value)" style="height: fit-content;">
            </div>
            <div class="col-2 ">
                <span>ราคาขาย : </span><br>
                <input type="text" class="form-control" id="show_price" style="height: fit-content;" disabled>
                <input type="text" class="form-control" name="price_total" id="price_total" style="height: fit-content;" hidden>
            </div>
            <div class="col-4 ">
                <span>ประเภทสินค้า : </span><br>
                <div class="form-group">
                    <select class="form-control" name="category">
                        <option value="" disabled selected>เลือกประเภทสินค้า</option>
                        <?php
                        include "../connect.php";
                        $sql = "SELECT * from  category ORDER BY 'category_id' ASC ";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $data["category_id"]; ?>"><?php echo $data["category_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <span>จำนวน : </span><br>
                <input type="text" class="form-control" name="qty" style="height: fit-content;">
            </div>
            <div class="col-2 ">
                <span>หน่วยสินค้า : </span><br>
                <div class="form-group">
                    <select class="form-control" name="unit">
                        <option value="" disabled selected>เลือกหน่วยสินค้า</option>
                        <?php
                        include "../connect.php";
                        $sql = "SELECT * from  unit ORDER BY 'unit_id' ASC ";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $data["unit_id"]; ?>"><?php echo $data["unit_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-2 ">
                <span>สินค้าใหม่</span><br>
                <div>
                </div>
                <input class="form-control" type="checkbox" name="product_new" value="new">
            </div>
            <div class="col-2 "></div>
            <div class="col-12 mt-2">
                <span>รายละเอียดสินค้า : </span><br>
                <div class="form-group mt-2">
                    <textarea class="form-control" name="detail" cols="30" rows="10" maxlength="500"></textarea>
                </div>
            </div>
            <div class="col-6 p-0">
                <span></span><br>
                <button type="submit" class="btn btn-success ml-3">บันทึก</button>
            </div>

        </div>
    </form>

    <!-- แก้ไข -->
    <form action="manager/update/update_product.php" method="post">
        <div class="row mt-3" style="display: none" id="form_update">
            <?php
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            if ($id != '') {
                echo "<script>";
                echo " document.getElementById('row_cate').style.display = 'none'; ";
                echo " document.getElementById('btn_add').style.display = 'none';";
                echo " document.getElementById('update').style.display = 'block';";
                echo " document.getElementById('form_update').style.display = '-webkit-box';";
                echo "</script>";
                include "../connect.php";
                include "../environment.php";
                $sql = "SELECT * from  $join_product where product_id = $id  ";
                // $sql = "SELECT * FROM `category` where category_id = '$id'  ";
                $result = $con->query($sql);
                $data1 = mysqli_fetch_array($result);
            }
            ?>

            <div class="col-12 pt-3 pb-3">
                <div class="pic-box d-flex justify-content-center align-items-center">
                    <div>
                        <img class="pic-box picsize" id="show_img" src="../img/upload/<?php echo $data1["picture"]; ?>">
                    </div>
                </div>
            </div>

            <div class="col-4 pb-3">
                <span>รหัสสินค้า : </span><br>
                <input type="text" class="form-control" name="id" value="<?php echo $data1["product_id"]; ?>" style="height: fit-content;" disabled>
                <input type="text" class="form-control" name="id" value="<?php echo $data1["product_id"]; ?>" style="height: fit-content;" hidden>

            </div>
            <div class="col-8"></div>
            <div class="col-5 ">
                <span>ชื่อสินค้า : </span><br>
                <input type="text" class="form-control" name="name" value="<?php echo $data1["product_name"]; ?>" style="height: fit-content;">
            </div>
            <div class="col-3 ">
                <span>โปรโมชั่น : </span><br>
                <div class="form-group">

                    <select class="form-control" name="promotion" id="promotion" onchange="UpdateSumPrice(price_start.value,this.value)">
                        <option value="" disabled>เลือกโปรโมชั่น</option>
                        <?php
                        include "../connect.php";
                        $sql = "SELECT * from  promotion ORDER BY 'promotion_id' ASC ";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $data["promotion_discount"]; ?>" <?php if ($data1["promotion_id"] == $data["promotion_id"]) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $data["promotion_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-2 ">
                <span>ราคาเริ่มต้น : </span><br>
                <input type="number" class="form-control" name="price_start" value="<?php echo $data1["product_price_start"]; ?>" id="price_start" onchange="UpdateSumPrice(this.value,promotion.value)" onkeyup="SumPrice(this.value,promotion.value)" style="height: fit-content;">
            </div>
            <div class="col-2 ">
                <span>ราคาขาย : </span><br>
                <input type="text" class="form-control" id="upshow_price" style="height: fit-content;" value="<?php echo $data1["product_price_total"]; ?>" disabled>
                <input type="text" class="form-control" name="price_total" id="upprice_total" style="height: fit-content;" value="<?php echo $data1["product_price_total"]; ?>" hidden>
            </div>
            <div class="col-4 ">
                <span>ประเภทสินค้า : </span><br>
                <div class="form-group">
                    <select class="form-control" name="category">
                        <option value="" disabled selected>เลือกประเภทสินค้า</option>
                        <?php
                        include "../connect.php";
                        $sql = "SELECT * from  category ORDER BY 'category_id' ASC ";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $data["category_id"]; ?>" <?php if ($data1["category_id"] == $data["category_id"]) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $data["category_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-2">
                <span>จำนวน : </span><br>
                <input type="text" class="form-control" name="qty" style="height: fit-content;" value="<?php echo $data1["product_qty"]; ?>">
            </div>
            <div class="col-2 ">
                <span>หน่วยสินค้า : </span><br>
                <div class="form-group">
                    <select class="form-control" name="unit">
                        <option value="" disabled selected>เลือกหน่วยสินค้า</option>
                        <?php
                        include "../connect.php";
                        $sql = "SELECT * from  unit ORDER BY 'unit_id' ASC ";
                        $result = $con->query($sql);
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?php echo $data["unit_id"]; ?>" <?php if ($data1["unit_id"] == $data["unit_id"]) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $data["unit_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-1 ">
                <span>สินค้าใหม่</span><br>
                <input class="form-control" type="checkbox" name="product_new" value="new" <?php if ($data1["product_new"] == "new") {
                                                                                                echo "checked";
                                                                                            } ?>>
            </div>
            <div class="col-3 "></div>
            <div class="col-12 mt-2">
                <span>รายละเอียดสินค้า : </span><br>
                <div class="form-group">
                    <textarea class="form-control" name="detail" cols="30" rows="10" maxlength="500"> <?php echo $data1["product_detail"]; ?></textarea>
                </div>
            </div>
            <div class="col-6 pb-5">
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>

        </div>


</div>
</form>

<script>
    document.addEventListener("keyup", event => {
        if (event.keyCode === 27) {
            modal.style.display = "none";
        }
    });

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

    function AddCategory() {
        document.getElementById('row_cate').style.display = "none";
        document.getElementById('btn_add').style.display = "none";
        document.getElementById('add').style.display = "block";
        document.getElementById('form_add').style.display = "-webkit-box";
    }

    function SumPrice(p_start, promotion) {
        if (p_start != undefined && p_start != "") {
            var discount_new = ((p_start / 100) * promotion);
            discount = Math.round(discount_new);
            document.getElementById('price_total').value = (p_start - discount);
            document.getElementById('show_price').value = (p_start - discount);
        } else {
            document.getElementById('price_total').value = "";
            document.getElementById('show_price').value = "";
        }
    }

    function UpdateSumPrice(start, promotion) {
        p_start = parseInt(start);
        if (p_start != undefined && p_start != "") {
            var discount_new = ((p_start / 100) * promotion);
            discount = Math.round(discount_new);
            document.getElementById('upprice_total').value = (p_start - discount);
            document.getElementById('upshow_price').value = (p_start - discount);
        } else {
            document.getElementById('upprice_total').value = "";
            document.getElementById('upshow_price').value = "";
        }
    }

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
                document.getElementById("m_name").innerHTML = element[1]+"  "+element[2];
                document.getElementById("m_price_start").innerHTML = element[2];
                document.getElementById("m_price_total").innerHTML = element[3];
                document.getElementById("m_detail").innerHTML = element[4];
                document.getElementById("m_qty").innerHTML = element[5];
                document.getElementById("m_new").innerHTML = element[6];
                document.getElementById("m_picture").src = '../img/upload/' + element['picture'];
                document.getElementById("m_category").innerHTML = element['category_name'];
                document.getElementById("m_unit").innerHTML = element['unit_name'];
                document.getElementById("m_promotion").innerHTML = element['promotion_name'];

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


</div>
<div>

    <div class="row pt-1">
        <button type="button" onclick="AddCategory()" id="btn_add" class="btn btn-success">เพิ่มโปรโมชั่น</button>
        <span style="display: none; font-size: 20px;" id="add">เพิ่มโปรโมชั่น</span>
        <span style="display: none; font-size: 20px;" id="update">แก้ไขโปรโมชั่น</span>
    </div>

    <!-- ตาราง -->
    <form action="admin.php?nextpage=manager&managerpage=promotion" method="post" id="row_cate">
        <div class="mt-3">
            <div class="w-25 d-flex">
                <input type="search" class="form-control" name="search_product" id="search_product" placeholder="ค้นหา...">
                <input type="submit" class="btn btn-success ml-2" value="ค้นหา">
            </div>
            <div class="select_product mt-3">
                <div class="row  row_select">
                    <div class="col-2 h_l">รหัสโปรโมชั่น</div>
                    <div class="col-6 h_c">ชื่อโปรโมชั่น</div>
                    <div class="col-2 h_c">ส่วนลด</div>
                    <div class="col-2 h_r"></div>

                </div>

                <?php
                include "../connect.php";

                $search_product = isset($_POST['search_product']) ? $_POST['search_product'] : '';

                if ($search_product != "") {
                    $sql = "SELECT * from promotion where promotion_id like '%$search_product%' or promotion_name like '%$search_product%' order by promotion_id asc  ";
                } else {
                    $sql = "SELECT * from promotion order by promotion_id asc  ";
                }
                $result = $con->query($sql);
                if (mysqli_num_rows($result) == 0) {
                    echo "ไม่พบข้อมูล";
                }
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="row row_select">
                        <div class="col-2 r_c">
                            <div><?php echo $data["promotion_id"]; ?></div>
                        </div>
                        <div class="col-6 r_c">
                            <div><?php echo $data["promotion_name"]; ?></div>
                        </div>
                        <div class="col-2 r_c">
                            <div><?php echo $data["promotion_discount"]; ?></div>
                        </div>
                        <div class="col-2 r_r">
                            <div class="row h-100">
                                <div class="col-6 pl-2 pr-2 h-100">
                                    <a href="admin.php?nextpage=manager&managerpage=promotion&id=<?php echo $data["promotion_id"]; ?>" class="btn btn_row btn-warning">แก้ไข</a>
                                </div>
                                <div class="col-6 pl-2 pr-2 h-100">
                                    <a href="manager/delete/delect_promotion.php?id=<?php echo $data["promotion_id"]; ?>" class="btn btn_row btn-danger" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');">ลบ</a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </form>


    <!-- เพิ่ม -->
    <form action="manager/insert/insert_promotion.php" method="post">
        <div class="row mt-3 add_form" style="display: none" id="form_add">
            <div class="col-6">
                <span>ชื่อโปรโมชั่น : </span><br>
                <input type="text" class="form-control" name="name" style="height: fit-content;">
            </div>
            <div class="col-3">
                <span>ส่วนลด : </span><br>
                <input type="text" class="form-control" name="discount" style="height: fit-content;">
            </div>
            <div class="col-3">
                <span></span><br>
                <button type="submit" class="btn btn-success ml-3">บันทึก</button>
            </div>

        </div>
    </form>

    <!-- แก้ไข -->
    <form action="manager/update/update_promotion.php" method="post">
        <div class="row mt-3 add_form" style="display: none" id="form_update">
            <?php
            $promotion_id = isset($_GET['id']) ? $_GET['id'] : '';
            if ($promotion_id != '') {
                echo "<script>";
                echo " document.getElementById('row_cate').style.display = 'none'; ";
                echo " document.getElementById('btn_add').style.display = 'none';";
                echo " document.getElementById('update').style.display = 'block';";
                echo " document.getElementById('form_update').style.display = '-webkit-box';";
                echo "</script>";
                include "../connect.php";
                $sql = "SELECT * FROM `promotion` where promotion_id = '$promotion_id'  ";
                $result = $con->query($sql);
                $data1 = mysqli_fetch_array($result);
            }
            ?>
            <div class="col-2">
                <span>รหัสโปรโมชั่น : </span><br>
                <input type="text" class="form-control mb-2" style="height: fit-content;" value="<?php echo $data1["promotion_id"]; ?>" disabled>
                <input type="text" class="form-control mb-2" name="up_id" style="height: fit-content; display: none;" value="<?php echo $data1["promotion_id"]; ?>">
            </div>
            <div class="col-6 ">
                <span>ชื่อโปรโมชั่น : </span><br>
                <input type="text" class="form-control" name="up_name" style="height: fit-content;" value="<?php echo $data1["promotion_name"]; ?>">
            </div>
            <div class="col-2 ">
                <span>ส่วนลด : </span><br>
                <input type="text" class="form-control" name="discount" style="height: fit-content;" value="<?php echo $data1["promotion_discount"]; ?>">
            </div>
            <div class="col-2">
                <span></span><br>
                <button type="submit" class="btn btn-success">บันทึก</button>
            </div>


        </div>
    </form>




    <script>
        function AddCategory() {
            document.getElementById('row_cate').style.display = "none";
            document.getElementById('btn_add').style.display = "none";
            document.getElementById('add').style.display = "block";
            document.getElementById('form_add').style.display = "-webkit-box";
        }
    </script>


</div>
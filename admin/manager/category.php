<div>

    <div class="row pt-1">
        <button type="button" onclick="AddCategory()" id="btn_add" class="btn btn-success">เพิ่มประเภทสินค้า</button>
        <span style="display: none; font-size: 20px;" id="add">เพิ่มประเภทสินค้า</span>
        <span style="display: none; font-size: 20px;" id="update">แก้ไขประเภทสินค้า</span>
    </div>

    <!-- ตาราง -->
    <form action="admin.php?nextpage=manager&managerpage=category" method="post" id="row_cate">
        <div class="mt-3">
            <div class="w-25 d-flex">
                <input type="search" class="form-control" name="search_product" id="search_product" placeholder="ค้นหา...">
                <input type="submit" class="btn btn-success ml-2" value="ค้นหา">
            </div>
            <div class="select_product mt-3">
                <div class="row  row_select">
                    <div class="col-2 h_l">รหัสประเภทสินค้า</div>
                    <div class="col-8 h_c">ชื่อประเภทสินค้า</div>
                    <div class="col-2 h_r"></div>

                </div>

                <?php
                include "../connect.php";

                $search_product = isset($_POST['search_product']) ? $_POST['search_product'] : '';

                if ($search_product != "") {
                    $sql = "SELECT * from category where category_id like '%$search_product%' or category_name like '%$search_product%' 
                    order by category_id asc  ";
                } else {
                    $sql = "SELECT * from category order by category_id asc  ";
                }
                $result = $con->query($sql);
                if (mysqli_num_rows($result) == 0) {
                    echo "ไม่พบข้อมูล";
                }
                while ($data = mysqli_fetch_array($result)) {
                ?>
                    <div class="row row_select">
                        <div class="col-2 r_c">
                            <div><?php echo $data["category_id"]; ?></div>
                        </div>
                        <div class="col-8 r_c">
                            <div><?php echo $data["category_name"]; ?></div>
                        </div>
                        <div class="col-2 r_r">
                            <div class="row h-100">
                                <div class="col-6 pl-2 pr-2 h-100">
                                    <a href="admin.php?nextpage=manager&managerpage=category&id=<?php echo $data["category_id"]; ?>" class="btn btn_row btn-warning">แก้ไข</a>
                                </div>
                                <div class="col-6 pl-2 pr-2 h-100">
                                    <a href="manager/delete/delect_category.php?id=<?php echo $data["category_id"]; ?>" class="btn btn_row btn-danger" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');">ลบ</a>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </form>


    <!-- เพิ่ม -->
    <form action="manager/insert/insert_category.php" method="post">
        <div class="row mt-3 add_form" style="display: none" id="form_add">
            <div class="col-6">
                <span>ชื่อประเภทสินค้า : </span><br>
                <input type="text" class="form-control" name="name" style="height: fit-content;">
            </div>
            <div class="col-6">
                <span></span><br>
                <button type="submit" class="btn btn-success ml-3">บันทึก</button>
            </div>

        </div>
    </form>

    <!-- แก้ไข -->
    <form action="manager/update/update_category.php" method="post">
        <div class="row mt-3 add_form" style="display: none" id="form_update">
            <?php
            $category_id = isset($_GET['id']) ? $_GET['id'] : '';
            if ($category_id != '') {
                echo "<script>";
                echo " document.getElementById('row_cate').style.display = 'none'; ";
                echo " document.getElementById('btn_add').style.display = 'none';";
                echo " document.getElementById('update').style.display = 'block';";
                echo " document.getElementById('form_update').style.display = '-webkit-box';";
                echo "</script>";
                include "../connect.php";
                $sql = "SELECT * FROM `category` where category_id = '$category_id'  ";
                $result = $con->query($sql);
                $data1 = mysqli_fetch_array($result);
            }
            ?>
            <div class="col-6 ">
                <span>รหัสโปรโมชั่น : </span><br>
                <input type="text" class="form-control mb-2" style="height: fit-content;" value="<?php echo $data1["category_id"]; ?>" disabled>
                <input type="text" class="form-control mb-2" name="up_id" style="height: fit-content; display: none;" value="<?php echo $data1["category_id"]; ?>">
            </div>
            <div class="col-6 ">
                <span>ชื่อประเภทสินค้า : </span><br>
                <input type="text" class="form-control" name="up_name" style="height: fit-content;" value="<?php echo $data1["category_name"]; ?>">

            </div>
            <div class="col-6 ">
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
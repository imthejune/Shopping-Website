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
                            <span>รหัสสมาชิก: </span>
                            <span id="m_id"></span>
                        </div>
                        <div class="col-6 pb-2">
                            <span>ชื่อผู้ใช้ : </span>
                            <span id="m_user"></span>
                        </div>
                        <div class="col-6 pb-2">
                            <span>สถานะ : </span>
                            <span id="m_status"></span>
                        </div>
                        <div class="col-12 pb-2">
                            <span>ชื่อ : </span>
                            <span id="m_name"></span>
                        </div>
                        <div class="col-6 pb-2">
                            <span>เบอร์โทร : </span>
                            <span id="m_tel"></span>
                        </div>
                        <div class="col-6 pb-2">
                        </div>
                        <div class="col-12 pb-2">
                            <span>อีเมล : </span>
                            <div class="w-100" style="overflow: auto;">
                                <span id="m_email"></span>
                            </div>
                        </div>
                        <div class="col-12 pb-2">
                            <span>ที่อยู่ : </span>
                            <div style="overflow: overlay;height: 185px;background: whitesmoke;">
                                <span id="m_address"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container pt-3">
    <h2>จัดการข้อมูลสมาชิก</h2>

    <form action="admin.php?nextpage=member" method="post">
        <div class="row pt-3">
            <div class="d-flex w-50">
                <select class="form-control w-50" name="status">
                    <option value="" selected>ทั้งหมด</option>
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
                <div class="d-flex align-items-center ml-2">
                    <span class="pl-2" style="position: absolute"><i class="fas fa-search"></i></span>
                    <input class="form-control" style="padding-left: 30px" type="search" placeholder="ค้นหาสมาชิก" name="search_product">
                </div>
                <input type="submit" class="btn btn-success ml-2" value="ค้นหา">
            </div>
        </div>
        <div class="select_data mt-3">
            <div class="row  row_select">
                <div class="col-1 h_l">รหัสสมาชิก</div>
                <div class="col-2 h_c">ชื่อผู้ใช้</div>
                <div class="col-2 h_c">ชื่อ-นามสกุล</div>
                <div class="col-3 h_c">ที่อยู่</div>
                <div class="col-1 h_c">เบอร์โทร์</div>
                <div class="col-1 h_c">อีเมล</div>
                <div class="col-2 h_r"></div>

            </div>

            <?php
            include "../connect.php";
            $status = isset($_POST['status']) ? $_POST['status'] : '';
            $search_product = isset($_POST['search_product']) ? $_POST['search_product'] : '';
            if ($status != "" && $search_product == "") {
                $sql = "SELECT * from member where  status = '$status' order by user_id asc  ";
            } else if ($status != "" && $search_product != "") {
                $sql = "SELECT * from member  where (user_name like '%$search_product%' or frist_name like '%$search_product%'
                or last_name like '%$search_product%' or tel like '%$search_product%' or email like '%$search_product%'
                or address like '%$search_product%') and status = '$status'
                order by user_id asc  ";
            } else if ($search_product != "") {
                $sql = "SELECT * from member  where user_name like '%$search_product%' or frist_name like '%$search_product%'
                or last_name like '%$search_product%' or tel like '%$search_product%' or email like '%$search_product%'
                or address like '%$search_product%'
                order by user_id asc  ";
            } else {
                $sql = "SELECT * from member order by user_id asc  ";
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
                        <div><?php echo $data["user_id"]; ?> </div>
                    </div>
                    <div class="col-2 r_c">
                        <div><?php echo $data["user_name"]; ?></div>
                    </div>
                    <div class="col-2 r_c">
                        <div title="<?php echo $data["frist_name"]; ?>"><?php echo $data["frist_name"]; ?></div>
                    </div>
                    <div class="col-3 r_c">
                        <div title="<?php echo $data["address"]; ?>"><?php echo $data["address"]; ?></div>
                    </div>
                    <div class="col-1 r_c">
                        <div><?php echo $data["tel"]; ?></div>
                    </div>
                    <div class="col-1 r_c">
                        <div title="<?php echo $data["email"]; ?>"><?php echo $data["email"]; ?></div>
                    </div>
                    <div class="col-2 r_r">
                        <div class="row h-100">
                            <div class="col-6 pl-2 pr-2 h-100">
                                <input type="button" value="ข้อมูล" id="myBtn" class="btn btn_row btn-primary" onclick="showdata(<?php echo $data['user_id']; ?>)" style="width: 45px;padding: 3px 0px;">
                            </div>
                            <div class="col-6 pl-2 pr-2 h-100">
                                <a href="" class="btn_row btn btn-danger">ลบ</a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php }
            $json_array = json_encode($result_array); ?>

        </div>
    </form>
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
                document.getElementById("m_user").innerHTML = element['user_name'];
                document.getElementById("m_status").innerHTML = element['status'];
                document.getElementById("m_name").innerHTML = element['frist_name'] + "   " + element['last_name'];
                document.getElementById("m_tel").innerHTML = element['tel'];
                document.getElementById("m_email").innerHTML = element['email'];
                document.getElementById("m_address").innerHTML = element['address'];
                if(element['status'] == "admin"){
                    document.getElementById("m_picture").src = '../img/data/admin.png';
                    document.getElementById("m_status").style.color = 'red' ;
                }
                else if(element['status'] == "user"){
                    document.getElementById("m_picture").src = '../img/data/user.png';
                    document.getElementById("m_status").style.color = '#212529';
                }
                


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
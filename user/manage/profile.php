<?php
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
include "../connect.php";
$sql = "SELECT * FROM `member` WHERE user_id = $user_id ";
$result = $con->query($sql);
$data = mysqli_fetch_array($result);
?>
<form action="manage/update/update_profile.php" method="post">
    <div class="row" style="background-color: #fff;">
        <div class="col-4 pt-2">
            <span>ชื่อ : </span>
            <input class="form-control" type="text" value="<?php echo $data["frist_name"]; ?>" name="Fname" id="Fname" required>
        </div>
        <div class="col-4 pt-2">
            <span>นามสกุล : </span>
            <input class="form-control" type="text" value="<?php echo $data["last_name"]; ?>" name="Lname" id="Lname" required>
        </div>
        <div class="col-4 pt-2">
        </div>

        <div class="col-4 pt-2">
            <span>เบอร์โทร : </span>
            <input class="form-control" type="text" value="<?php echo $data["tel"]; ?>" name="tel" id="tel" required>
        </div>
        <div class="col-4 pt-2">
            <span>อีเมล : </span>
            <input class="form-control" type="text" value="<?php echo $data["email"]; ?>" name="email" id="email" required>
        </div>
        <div class="col-4 pt-2">
        </div>
        <div class="col-8 pt-2">
            <textarea class="form-control" name="address" id="address" rows="4" required><?php echo $data["address"]; ?></textarea>
        </div>
        <div class="col-4 pt-2">
        </div>
        <div class="col-4 pt-2 pb-3">
            <button class="btn_singin" id="btnsubmit">บันทึก</button>
        </div>
    </div>
</form>

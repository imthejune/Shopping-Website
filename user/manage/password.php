<form action="manage/update/update_password.php" method="post">
    <div class="row" style="background-color: #fff;">
        <div class="col-4 pt-2">
            <span>รหัสผ่านเก่า : </span>
            <div class="d-flex align-items-center">
                <i id="Picon1" class="fas fa-eye-slash" style="position: absolute;  right: 23px;" onclick="showpassword(1)"></i>
                <input class="form-control" type="password" value="" name="password1" id="password1" required>
            </div>
        </div>
        <div class="col-4 pt-2">
        </div>
        <div class="col-4 pt-2">
        </div>
        <div class="col-4 pt-2">
            <span>รหัสผ่านใหม่ : </span>
            <div class="d-flex align-items-center">
                <i id="Picon2" class="fas fa-eye-slash" style="position: absolute;  right: 23px;" onclick="showpassword(2)"></i>
                <input class="form-control" type="password" value="" name="password2" id="password2" required>
            </div>
        </div>
        <div class="col-4 pt-2">
        </div>
        <div class="col-4 pt-2">
        </div>
        <div class="col-4 pt-2">
            <span>ยืนยันรหัสผ่าน : </span>
            <div class="d-flex align-items-center">
                <i id="Picon3" class="fas fa-eye-slash" style="position: absolute;  right: 23px;" onclick="showpassword(3)"></i>
                <input class="form-control" type="password" value="" name="password3" id="password3" required>
            </div>
        </div>
        <div class="col-4 pt-2">
        </div>
        <div class="col-4 pt-2">
        </div>



        <div class="col-4 pt-2 pb-3">
            <button class="btn_singin" id="btnsubmit">บันทึก</button>
        </div>
    </div>

    <script>
        function showpassword(i) {
            var Picon = document.getElementById("Picon" + i);
            var pasword = document.getElementById("password" + i);
            if (pasword.type === "password") {
                pasword.type = "text";
                Picon.classList.remove("fa-eye-slash");
                Picon.classList.add("fa-eye");
            } else {
                pasword.type = "password";
                Picon.classList.remove("fa-eye");
                Picon.classList.add("fa-eye-slash");
            }
        }
    </script>

</form>
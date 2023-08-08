<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit:300,400,700&amp;subset=thai" />
    <link rel="stylesheet" href="css/menu.scss">
    <link rel="stylesheet" href="css/style.scss">
    <link rel="stylesheet" href="img/fontawesome/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <?php
    include 'menu/menubar.php';  ?>
    <form action="login/singup_member.php" method="post">
        <div class="container mt-3 ">
            <div class="row lg_form">

                <div class="col-4 p-0">
                    <img class="h-100 w-100" style="border-radius: 10px 0px 0px 10px;object-fit: cover;" src="img/data/singin.jpg" alt="">
                </div>
                <div class="col-8" style="padding: 15px 40px;">
                    <span style="font-size: 45px;">สมัครสมาชิก</span>
                    <div class="row">
                        <div class="col-6 pt-2">
                            <span>ชื่อผู้ใช้ : </span>
                            <input class="form-control" type="text" name="user" id="user" onkeypress="return KeyCode(this)" required>
                        </div>
                        <div class="col-6 pt-2">
                            <span>รหัสผ่าน : </span>
                            <div class="d-flex align-items-center">
                                <i id="Picon" class="fas fa-eye-slash" style="position: absolute;  right: 23px;" onclick="showpassword()"></i>
                                <input class="form-control" style="padding-right: 30px;" type="password" name="password"  id="password" required>
                            </div>
                        </div>
                        <div class="col-6 pt-2">
                            <span>ชื่อ : </span>
                            <input class="form-control" type="text" name="Fname" id="Fname" required>
                        </div>
                        <div class="col-6 pt-2">
                            <span>นามสกุล : </span>
                            <input class="form-control" type="text" name="Lname" id="Lname" required>
                        </div>
                        <div class="col-6 pt-2">
                            <span>เบอร์โทร : </span>
                            <input class="form-control" type="text" name="tel" id="tel" maxlength="10" onkeypress="return KeyNum(this)" required>
                        </div>
                        <div class="col-6 pt-2">
                            <span>อีเมล : </span>
                            <input class="form-control" type="text" name="email" id="email" onkeypress="return KeyCode(this)" required>
                        </div>
                        <div class="col-12 pt-2">
                            <span>ที่อยู่ : </span>
                            <textarea class="form-control" name="address" id="address" rows="4" required></textarea>
                        </div>
                        <div class="col-4 pt-2">
                            <button class="btn_singin" id="btnsubmit">สมัครสมาชิก</button>
                        </div>
                        <div class="col-4 pt-2">
                        </div>
                        <div class="col-4 pt-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>

    <script>
        function KeyNum() {
            if (event.keyCode >= 48 && event.keyCode <= 57 ) //48-57(ตัวเลข)
            {
                return true;
            } else {
                alert("กรอกได้เฉพาะ 0-9");
                return false;
            }
        }

        function KeyCode() {
            if (event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode >= 97 && event.keyCode <= 122) //48-57(ตัวเลข) ,65-90(Eng ตัวพิมพ์ใหญ่ ) ,97-122(Eng ตัวพิมพ์เล็ก)
            {
                return true;
            } else {
                alert("กรอกได้เฉพาะ a-z และ 0-9");
                return false;
            }
        }


        function showpassword() {
            var Picon = document.getElementById("Picon");
            var pasword = document.getElementById("password");
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

</body>

</html>
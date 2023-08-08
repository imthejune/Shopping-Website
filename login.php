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
    <link rel="stylesheet" href="img/fontawesome/css/all.min.css">
    <title>Document</title>

    <!--    กำหนด client ID ที่เราได้สร้างไว้-->
    <!-- <meta name="google-signin-client_id" content="224136776597-62gski02k28pungl7hl81irbc65n91dq.apps.googleusercontent.com"> -->
    <!--    ต้องมีการเรียกใช้งาน Google Platform Library ในหน้าที่มีการใช้งาน Google Sign In-->
    <!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
</head>

<body>
    <?php
    include 'menu/menubar.php';  ?>


    <form action="login/check.php" method="post">
        <div class="container mt-3 ">
            <div class="row lg_form">
                <div class="col-6 p-0">
                    <img class="h-100 w-100" style="border-radius: 10px 0px 0px 10px;" src="img/data/login.jpg" alt="">
                </div>
                <div class="col-6">
                    <div class="p-5">
                        <span style="font-size: 45px">เข้าสู่ระบบ</span>
                        <div class="row">
                            <div class="col-12 mt-2 mb-2">
                                <span>ชื่อผู้ใช้ : </span>
                                <input class="form-control" type="text" name="user" id="user" value="1">
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <span>รหัสผ่าน : </span>
                                <div class="d-flex align-items-center">
                                    <i id="Picon" class="fas fa-eye-slash" style="position: absolute;  right: 23px;" onclick="showpassword()"></i>
                                    <input class="form-control" type="password" name="password" style="padding-right: 30px;" id="password" value="1">
                                </div>
                            </div>
                            <div class="col-12 mt-2 mb-2">
                                <input class="btn_singin" type="submit" value="เข้าสู่ระบบ">
                            </div>
                            <div class="col-12 mt-5 mb-2">
                                <a href="singup.php">สมัครสมาชิก</a> | <a href="#">ลืมรหัสผ่าน</a>
                            </div>
                        </div>


                        <!-- <div class="g-signin2" data-onsuccess="onSignIn"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
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
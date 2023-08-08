<?php $page = isset($_GET['page']) ? $_GET['page'] : ''; ?>
<div class="row pt-3">
    <div class="pl-5 pr-4 col-3 Mcol">
        <div class="Bcol">
            <div style="background-color: #ffa31a;">
                <span>จัดการบัญชีของฉัน</span>
            </div>
            <div class="Dcol">
                <div>
                    <a class="<?php if ($page == 'profile') {
                                    echo 'manu_active';
                                } ?>" href="user.php?nextpage=manage&page=profile">ข้อมูลทั่วไป</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'password') {
                                    echo 'manu_active';
                                } ?>" href="user.php?nextpage=manage&page=password">เปลี่ยนรหัสผ่าน</a>
                </div>
            </div>
        </div>
        <div class="Bcol">
            <div style="background-color: #ffa31a;">
                <span>รายการสั่งซื้อของฉัน</span>
            </div>
            <div class="Dcol">
                <div>
                    <a class="<?php if ($page == 'orderall') {
                                    echo 'manu_active';
                                } ?>" href="user.php?nextpage=manage&page=orderall">ทั้งหมด</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_wait') {
                                    echo 'manu_active';
                                } ?>" href="user.php?nextpage=manage&page=order_wait">ที่ต้องชำระเงิน</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_paymentfailed') {
                                    echo 'manu_active';
                                } ?>" href="user.php?nextpage=manage&page=order_paymentfailed">ชำระเงินไม่สำเร็จ</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_delivery') {
                                    echo 'manu_active';
                                } ?>" href="user.php?nextpage=manage&page=order_delivery">กำลังเตรียมจัดส่ง</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_transport') {
                                    echo 'manu_active';
                                } ?>" href="user.php?nextpage=manage&page=order_transport">อยู่ระหว่างการขนส่ง</a>
                </div>
            </div>
        </div>
    </div>


    <div class="col-9">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        if ($page == 'profile') {
            include 'manage/profile.php';
        } else if ($page == 'password') {
            include 'manage/password.php';
        } else if ($page == 'orderall') {
            include 'manage/orderall.php';
        } else if ($page == 'order_detail') {
            include 'manage/order_detail.php';
        } else if ($page == 'order_wait') {
            include 'manage/order_wait.php';
        } else if ($page == 'order_paymentfailed') {
            include 'manage/order_paymentfailed.php';
        } else if ($page == 'order_delivery') {
            include 'manage/order_delivery.php';
        } else if ($page == 'order_transport') {
            include 'manage/order_transport.php';
        }
        ?>
    </div>
</div>


<script>

</script>
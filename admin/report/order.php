<div class="row pt-3">
    <div class="col-3 Mcol p-0">
        <div class="Bcol">
            <div style="background-color: #ffa31a;">
                <span>รายการสั่งซื้อ</span>
            </div>
            <div class="Dcol">
                <div>
                    <a class="<?php if ($page == 'orderall') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&page=orderall">ทั้งหมด</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_wait') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&page=order_wait">รอการชำระเงิน</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_wait') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&page=order_check">รอการตรวจสอบ</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_wait') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&page=order_paymentfailed">ชำระเงินไม่สำเร็จ</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_delivery') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&page=order_delivery">เตรียมจัดส่ง</a>
                </div>
                <div>
                    <a class="<?php if ($page == 'order_transport') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&page=order_transport">จัดส่งสำเร็จ</a>
                </div>
                <div hidden>
                    <a class="<?php if ($page == 'tableorderall') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&page=tableorderall">DataTable</a>
                </div>
            </div>
        </div>
    </div>


    <div class="col-9">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        if ($page == 'orderall') {
            include 'order/orderall.php';
        } else if ($page == 'order_detail') {
            include 'order/order_detail.php';
        } else if ($page == 'order_wait') {
            include 'order/order_wait.php';
        } else if ($page == 'order_check') {
            include 'order/order_check.php';
        } else if ($page == 'order_paymentfailed') {
            include 'order/order_paymentfailed.php';
        } else if ($page == 'order_delivery') {
            include 'order/order_delivery.php';
        } else if ($page == 'order_transport') {
            include 'order/order_transport.php';
        } else if ($page == 'tableorderall') {
            include 'order/tableorderall.php';
        } else {
            include 'order/orderall.php';
        }
        ?>
    </div>
</div>
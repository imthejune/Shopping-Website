<div class="row pt-3">
    <div class="col-3 Mcol p-0">
        <div class="Bcol">
            <div style="background-color: #ffa31a;">
                <span>สรุปการขายสินค้า</span>
            </div>
            <div class="Dcol">
                <div>
                    <a class="<?php if ($page == 'report_all') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&managerpage=sales_summary&page=report_all">ทั้งหมด</a>
                </div>
                <div>
                    <a class="<?php if ($page == '1day') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&managerpage=sales_summary&page=1day">1 วัน ล่าสุด</a>
                </div>
                <div>
                    <a class="<?php if ($page == '30day') {
                                    echo 'manu_active';
                                } ?>" href="admin.php?nextpage=report&managerpage=sales_summary&page=30day">30 วัน ล่าสุด</a>
                </div>
            </div>
        </div>
    </div>


    <div class="col-9">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : '';
        if ($page == 'report_all') {
            include 'sales_report/report_all.php';
        } else if ($page == '1day') {
            include 'sales_report/1day.php';
        } else if ($page == '30day') {
            include 'sales_report/30day.php';
        } else {
            include 'sales_report/report_all.php';
        }
        ?>
    </div>
</div>
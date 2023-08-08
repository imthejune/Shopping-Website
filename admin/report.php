<div style="padding: 40px;">
    <h2>จัดการบัญชี</h2>
    <div class="row pt-2 pb-2" style="background-color: #fff">
       <div class="d-flex">
           <div class="memu_menage" id="order"><a href="admin.php?nextpage=report&managerpage=order"><i class="fas fa-shopping-cart "></i> รายงานการสั่งซื้อ</a></div>
           <div class="memu_menage" id="sales_summary"><a href="admin.php?nextpage=report&managerpage=sales_summary"><i class="fas fa-sort-amount-up"></i> สรุปการขายสินค้า</a></div>
       </div>
    </div>
    <hr>
    
    <div>
    <?php
        $managerpage = isset($_GET['managerpage']) ? $_GET['managerpage'] : '';
        if ($managerpage == 'order') {
            include 'report/order.php';
        } else if ($managerpage == 'sales_summary') {
            include 'report/sales_summary.php';
        }else{
            include 'report/order.php';
            $managerpage = 'order';
        }

        echo "<script>";
        echo "document.getElementById('$managerpage').classList.add('active_meneger');";
        echo "</script>";

        ?>
    </div>

</div>


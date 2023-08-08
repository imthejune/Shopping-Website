<div style="padding: 40px;">
    <h2>จัดการข้อมูลสินค้า</h2>

    <div class="row pt-2 pb-2" style="background-color: #fff">
       <div class="d-flex">
           <div class="memu_menage" id="product"><a href="admin.php?nextpage=manager&managerpage=product"><i class="fas fa-shopping-cart "></i> สินค้า</a></div>
           <div class="memu_menage" id="category"><a href="admin.php?nextpage=manager&managerpage=category"><i class="fas fa-sort-amount-up"></i> ประเภทสินค้า</a></div>
           <div class="memu_menage" id="promotion"><a href="admin.php?nextpage=manager&managerpage=promotion"><i class="fas fa-percentage"></i> โปรโมชั่น</a></div>
           <div class="memu_menage" id="new_product"><a href="admin.php?nextpage=manager&managerpage=new_product"><i class="far fa-newspaper"></i> สินค้าแนะนำ</a></div>
       </div>
    </div>
    <hr>
    
    <div>
    <?php
        $managerpage = isset($_GET['managerpage']) ? $_GET['managerpage'] : '';
        if ($managerpage == 'product') {
            include 'manager/product.php';
        } else if ($managerpage == 'category') {
            include 'manager/category.php';
        } else if ($managerpage == 'promotion') {
            include 'manager/promotion.php';
        } else if ($managerpage == 'new_product') {
            include 'manager/new_product.php';
        }else{
            include 'manager/product.php';
            $managerpage = 'product';
        }

        echo "<script>";
        echo "document.getElementById('$managerpage').classList.add('active_meneger');";
        echo "</script>";

        ?>
    </div>

</div>


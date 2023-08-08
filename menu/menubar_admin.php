<!-- mobile -->
<div class="mobile">
  <ul class="nav">
    <a href="../admin/admin.php?nextpage=home">
      <li>
        <i class="fas fa-home icon_h" <?php
                                      if ($nextpage  == 'home') {
                                        echo "style='color: red;'";
                                      }
                                      ?>></i>
        <div>หน้าหลัก</div>
      </li>
    </a>
    <a href="../admin/admin.php?nextpage=member">
      <li>
        <i class="fas fa-users icon_h" <?php
                                        if ($nextpage  == 'member') {
                                          echo "style='color: red;'";
                                        }
                                        ?>></i>
        <div>สมาชิก</div>
      </li>
    </a>
    <a href="../admin/admin.php?nextpage=manager">
      <li>
        <i class="fas fa-cogs icon_h" <?php
                                      if ($nextpage  == 'manager') {
                                        echo "style='color: red;'";
                                      }
                                      ?>></i>
        <div>จัดการ</div>
      </li>
    </a>
    <a href="../admin/admin.php?nextpage=report">
      <li>
        <i class="fas fa-file-alt icon_h" <?php
                                          if ($nextpage  == 'report') {
                                            echo "style='color: red;'";
                                          }
                                          ?>></i>
        <div>รายงาน</div>
      </li>
    </a>
    <li>
      <i class="fas fa-sign-out-alt "></i>
      <div><a href="../login/logout.php">ออกจากระบบ</a></div>
    </li>
  </ul>
</div>
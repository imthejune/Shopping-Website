<div class="row row_menu">
  <div class="col-2">
    <a href="user.php">
      <img src="../img/data/logo.png" alt="" style="width: 80%">
    </a>

  </div>
  <div class="col-10 d-flex justify-content-end row_sp">
    <div>
      <a href="user.php?nextpage=product">สินค้า</a>
    </div>

    <div class="dropdown">
      <a href="user.php?nextpage=manage">บัญชีของ <?php echo $user_name ?></a>
      <div class="dropdown-content">
        <div>
          <div style="transform: rotate(180deg);justify-content: center; display: flex;">
            <i style="color: #a6a6a6;margin-top: -6px;" class="fas fa-caret-down"></i>
          </div>
        </div>

        <div style=" border: 1px solid  #a6a6a6;background-color:#fff;min-width: 100%; box-shadow: 0px 1px 1px 0px  rgba(0,0,0,0.2); padding: 10px 20px;">
          <a style="font-size: 13px;padding: 0px" href="user.php?nextpage=manage&page=profile">จัดการบัญชีของฉัน</a><br>
          <a style="font-size: 13px;padding: 0px" href="user.php?nextpage=manage&page=orderall">รายการสั่งซื้อของฉัน</a><br>
          <a style="font-size: 13px;padding: 0px" href="../login/logout.php">ออกจากระบบ</a>
        </div>

      </div>
    </div>
  </div>

</div>
</div>
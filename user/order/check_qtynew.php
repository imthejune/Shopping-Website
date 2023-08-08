<?php
ob_start();
session_start();

$intLine = (isset($_SESSION['intLine'])) ? $_SESSION['intLine'] : '';

for ($i=0; $i <=(int)$intLine; $i++) { 
    $_SESSION["strQty"][$i] = $_POST["qty$i"];
}

header("location:../user.php?nextpage=product");

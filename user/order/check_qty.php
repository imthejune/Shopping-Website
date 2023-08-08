<?php
ob_start();
session_start();


if (!isset($_SESSION["intLine"])) {
    if (isset($_POST["id_product"])) {
        $_SESSION["intLine"] = 0;
        $_SESSION["strProductID"][0] = $_POST["id_product"];
        $_SESSION["strQty"][0] = $_POST["qty"];
      
        header("location:../user.php?nextpage=cart");
    }
} else {

    $key = array_search($_POST["id_product"], $_SESSION["strProductID"]);
    if ((string) $key != "") {
        $_SESSION["strQty"][$key] = $_SESSION["strQty"][$key] + $_POST["qty"];
    } else {
        $_SESSION["intLine"] = $_SESSION["intLine"] + 1;
        $intNewLine = $_SESSION["intLine"];
        $_SESSION["strProductID"][$intNewLine] = $_POST["id_product"];
        $_SESSION["strQty"][$intNewLine] = $_POST["qty"];
    }
    header("location:../user.php?nextpage=cart");
}



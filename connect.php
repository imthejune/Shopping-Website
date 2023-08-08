<?php
$host = "localhost";
$user = "root";
$password = "";
$dbName = "barnshop_db";

$con = new mysqli($host,$user,$password,$dbName);

//check connection

  if($con->connect_error)
  {
    die("ไม่สามารถเชื่อมต่อฐานข้อมูล" . $con->connect_error);
  }

?>

<?php
session_start();
$_SESSION["username"]="guest";
$_SESSION["previlege"]=3;
header("Location:main_area.php");
?>

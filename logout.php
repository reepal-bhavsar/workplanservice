<?php
session_start();
unset($_SESSION['uid']);
unset($_SESSION['uname']);
unset($_SESSION['ufname']);
unset($_SESSION['ulname']);

header("Location:index.php");
?>
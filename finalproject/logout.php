<?php
session_start();
session_unset();
session_destroy();
setcookie('user', '', 0, '/');
setcookie('password', '', 0, '/');
header('location:index.php');
?>

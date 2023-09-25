<?php
session_start();
unset($_SESSION['admin_id']);
unset($_SESSION['Username']);
unset($_SESSION['Password']);
header('location: ../admin-login.php');
die();

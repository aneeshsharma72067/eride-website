<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['username']);
unset($_SESSION['email']);
unset($_SESSION['phone']);
unset($_SESSION['first_name']);
unset($_SESSION['last_name']);
unset($_SESSION['address']);
header('location: ../');
die();

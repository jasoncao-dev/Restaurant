<?php
require_once 'database.php';
session_start();
if (count($_SESSION) == 0) {header('location: index.php');}
close_order($db, $_SESSION['oid']);
header('location: cart.php');

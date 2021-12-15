<?php
require_once ("../settings.php");
require_once(__ROOT__."/database.php");
session_start();
$id = $_GET['id'];
if (count($_SESSION) == 0 or $_SESSION['is_admin'] == 0) {
    $path = 'location: ../index.php';
    header($path);
}
delete_menu_item($db, $_GET['mid']);
header('location: index.php');
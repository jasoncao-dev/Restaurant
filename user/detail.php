<?php
require_once ("../settings.php");
require_once(__ROOT__ . '/database.php');
session_start();

$id = $_GET['id'];
?>
    <html lang="en">
<head>
    <title>FOOdash food delivery</title>
</head>
<?php display_restaurant_detail($db, $id);?>
<a href="SignIn.php">Sign Up / Sign In</a>
<?php display_menu($db, $id);

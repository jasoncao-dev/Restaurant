<?php
include_once "database.php";
session_start();
?>
<html lang="en">
<head>
    <title>FOOdash food delivery</title>
</head>
<h1>
    Welcome to FOOdash your food delivery provider!! please select a restaurant bellow!
</h1>
<a href="SignIn.php">Sign Up / Sign In</a>
<?php
display_restaurant_list($db);
?>
</html>

<?php
require_once ("../settings.php");
require_once(__ROOT__ . '/database.php');
session_start();
?>
<html lang="en">
<head>
    <title>FOOdash food delivery</title>
</head>
<h1>
    Welcome to FOOdash your food delivery provider!! please select a restaurant bellow!
</h1>
<?php
display_restaurant_list($db);
?>
</html>
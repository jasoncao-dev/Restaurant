<?php
include_once 'database.php';
$id = $_GET['id'];
?>
<html lang="en">
<head>
    <title>FOOdash food delivery</title>
</head>
<?php echo "<pre>"; display_restaurant_detail($db, $id);?>
<a href="SignIn.php">Sign Up / Sign In</a>
<?php display_menu($db, $id);

<?php
require_once ("../settings.php");
require_once(__ROOT__.'/database.php');
session_start();
if (count($_SESSION) == 0) {header('location: index.php');}
$mid = $_GET['mid'];
if(count($_GET) > 1){
    $amount = $_GET['num'];
    remove_item($db, $mid, $amount);
}
else{
    remove_item($db, $mid);
}
header('location: cart.php');
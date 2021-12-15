<?php
    require_once ("../settings.php");
    require_once(__ROOT__."/database.php");
if (count($_SESSION) == 0 or $_SESSION['is_admin'] == 0) {
    $path = 'location: ../index.php';
    header($path);
}
    echo "<pre>";
    
    if ($_POST["image"] == null) $_POST["image"] = "https://i1.wp.com/servedcatering.com/wp-content/uploads/2021/05/menu-item-placeholder.png?fit=607%2C400&ssl=1";
    
    print_r($_POST);
    $restaurant["name"] = $_POST["name"];
    $restaurant["image"] = $_POST["image"];
    $restaurant["category"] = $_POST["category"];
    $restaurant["phone"] = $_POST["phone"];
    $restaurant["street"] = $_POST["street"];
    $restaurant["city"] = $_POST["city"];
    $restaurant["state"] = $_POST["state"];
    $restaurant["zip"] = $_POST["zip"];

    add_restaurant($db, $restaurant);
    header('location: ./index.php');

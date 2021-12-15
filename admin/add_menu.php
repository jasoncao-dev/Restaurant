<?php
    require_once ("../settings.php");
    require_once(__ROOT__."/database.php");

    /*if (count($_SESSION) == 0 or $_SESSION['is_admin'] == 0) {
        $path = 'location: ./index.php';
        header($path);
    }*/

    //if (isset($_POST)) header('location: ./index.php');
    
    if ($_POST["image"] == null) $_POST["image"] = "https://i1.wp.com/servedcatering.com/wp-content/uploads/2021/05/menu-item-placeholder.png?fit=607%2C400&ssl=1";
    
    print_r($_POST);
    $menu_item["rid"] = $_POST["rid"];
    $menu_item["name"] = $_POST["name"];
    $menu_item["description"] = $_POST["description"];
    $menu_item["price"] = $_POST["price"];
    $menu_item["image"] = $_POST["image"];

    add_menu_item($db, $menu_item);
    header('location: ./detail.php?id='.$menu_item['rid'].'');

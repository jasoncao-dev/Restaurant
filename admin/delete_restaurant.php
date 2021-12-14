<?php
    require_once ("../settings.php");
    require_once(__ROOT__."/database.php");

    echo "<pre>";
    
    print_r($_POST);

    $restaurant["AID"] = $_POST["AID"];
    $restaurant["RID"] = $_POST["RID"];

    delete_restaurant($db, $restaurant);
    header('location: ./index.php');

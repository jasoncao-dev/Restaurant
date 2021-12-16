<?php
require_once ("../settings.php");
require_once(__ROOT__.'/database.php');
session_start();
// checks for session when you enter index.php
if($_SESSION['is_logged'] != 1){
    // redirects you if sessions are not present
    header("location: ../signin.php");
}
if(!count($_POST) > 0){
    header('location ./index.php');
    die('error');
}
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die(message('error', 'Your email is invalid. <a href="signin.php">click here<a/>'));

// check if password length is between 8 and 16 characters
if (strlen($_POST['password']) < 8) die(message('error', 'Please enter a password >=8 characters. <a href="signin.php">click here<a/>'));
if (strlen($_POST['password']) > 16) die(message('error', 'Please enter a password <= 16 characters. <a href="signin.php">click here<a/>'));

$user_info = array(
    "name" => $_POST["name"],
    "email" => $_POST["email"],
    "phone" => $_POST["phone"],
    "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
    "street" => $_POST["street"],
    "city" => $_POST["city"],
    "state" => $_POST["state"],
    "zip" => $_POST["zip"]
);
update_user($db, $user_info);
header('location: index.php');


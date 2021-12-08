<?php

if ($_POST['action'] == 'signup') signup();
else signin();

function signup()
{ //Format: name;username;password
    $user_info = array(
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "phone" => $_POST["phone"],
        "password" => password_hash($_POST["password"]),
        "street" => $_POST["street"],
        "city" => $_POST["city"],
        "state" => $_POST["state"],
        "zip" => $_POST["zip"]
    );

    // check if the email is valid
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die(message('error', 'Your email is invalid. <a href="signin.php">click here<a/>'));

    // check if password length is between 8 and 16 characters
    if (strlen($_POST['password']) < 8) die(message('error', 'Please enter a password >=8 characters. <a href="signin.php">click here<a/>'));
    if (strlen($_POST['password']) > 16) die(message('error', 'Please enter a password <= 16 characters. <a href="signin.php">click here<a/>'));

    // check if the password contains at least 2 special characters
    $pattern = '/^(?=.*[!@#$%^&*-])/';
    if (!preg_match($pattern, $_POST['password'])) die(message('error', 'password should contain special character. <a href="signin.php">click here<a/>'));

    if (($handle = fopen('data.csv', 'r')) === FALSE) { //Check if open file successfully
        die('Cannot open file data.csv');
        return;
    }
    while (!feof($handle)) {
        $line = explode(';', trim(fgets($handle)));
        if (count($line) < 3) continue;
        if ($line[1] == $_POST['username']) {
            die('This username is already register. Please try to use another one.');
            header('location: authors.php');
        }
    }
    fclose($handle);
    //add email and hashed password to file
    $handle = fopen('data.csv', 'a+');
    fwrite($handle, $_POST['name'] . ';' . $_POST['username'] . ';' . password_hash($_POST['password'], PASSWORD_DEFAULT) . PHP_EOL);
    fclose($handle);
    //Write confirmation message and ask the user to sign in
    session_start();
    $_SESSION['name'] = $line[0];
    $_SESSION['username'] = $line[1];
    header('location: index.php');
}

function signin()
{
    if (!file_exists('data.csv')) { //Check if file exists
        die('File is not found!');
    }
    if (($handle = fopen('data.csv', 'r')) === FALSE) { //Check if open file successfully
        die('Cannot open file data.csv');
        return;
    }
    while (!feof($handle)) {
        $line = explode(';', trim(fgets($handle)));
        if (count($line) < 3) continue;
        if ($line[1] == $_POST['username']) {
            if (!password_verify($_POST['password'], $line[2])) die('Password is not correct');
            else {
                //Start the session and send the user to the quotes page
                session_start();
                $_SESSION['name'] = $line[0];
                $_SESSION['username'] = $line[1];
                header('location: quotes/quotes.php');
            }
        }
    }
    fclose($handle);
    die('The username is not registered');
}
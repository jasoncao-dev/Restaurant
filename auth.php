<?php
require_once("database.php");
print_r($_POST);
if (count($_POST)> 2) signup($db);
else signin($db);

function signup($db)
{ //Format: name;username;password

    // check if the email is valid
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die(message('error', 'Your email is invalid. <a href="signin.php">click here<a/>'));

    // check if password length is between 8 and 16 characters
    if (strlen($_POST['password']) < 8) die(message('error', 'Please enter a password >=8 characters. <a href="signin.php">click here<a/>'));
    if (strlen($_POST['password']) > 16) die(message('error', 'Plea42:23se enter a password <= 16 characters. <a href="signin.php">click here<a/>'));

    // check if the password contains at least 2 special characters
    //$pattern = '/^(?=.*[!@#$%^&*-])/';
    //if (!preg_match($pattern, $_POST['password'])) die(message('error', 'password should contain special character. <a href="signin.php">click here<a/>'));
    $user_info = array(
        "name" => $_POST["name"],
        "email" => $_POST["email"],
        "phone" => $_POST["phone"],
        "password" => password_hash($_POST["password"], 1),
        "street" => $_POST["street"],
        "city" => $_POST["city"],
        "state" => $_POST["state"],
        "zip" => $_POST["zipcode"]
    );
    create_user($user_info, $db);

    //Write confirmation message and ask the user to sign in
   ?>
    <script>
        alert('User has been created please log in!')
    </script>
<?php
    header('location: signin.php');
}

function signin($db) {
    if(!check_if_exists($db, "users", "email", $_POST['email'] )){
        die(message('error', 'email not registered, please sign up. <a href="signin.php">click here<a/>'));
    }
    if(!check_password($db, $_POST['email'], hash($_POST['password'], 1 ))){
        die(message('error', 'incorrect password, please try again. <a href="signin.php">click here<a/>'));
    }
    else {
        //Start the session and send the user to the quotes page
        session_start();
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['eamil'] = $_POST['email'];
        $_SESSION["is_logged"] = true;
        $_SESSION['UID'] = get_uid($db, $_POST['email']);
        if(checks_for_order($db,$_SESSION['UID'])){
            $_SESSION['OID'] = get_oid($db, $_SESSION['UID']);
        }
        else{
           $_SESSION['OID'] = create_oid($db, $_SESSION['UID']);
        }
        header('location: users/index.php');
    }
    }
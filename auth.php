<?php
require_once("database.php");
print_r($_POST);
if ($_POST['action'] == 'signup') signup($db);
else signin($db);

function signup($db)
{ //Format: name;username;password

    // check if the email is valid
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) die(message('error', 'Your email is invalid. <a href="signin.php">click here<a/>'));

    // check if password length is between 8 and 16 characters
    if (strlen($_POST['password']) < 8) die(message('error', 'Please enter a password >=8 characters. <a href="signin.php">click here<a/>'));
    if (strlen($_POST['password']) > 16) die(message('error', 'Please enter a password <= 16 characters. <a href="signin.php">click here<a/>'));

    // check if the password contains at least 2 special characters
    /*
    $pattern = '/^(?=.*[!@#$%^&*-])/';
    if (!preg_match($pattern, $_POST['password'])) {
        echo "Something happened.";
        die();
    }*/
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
    echo "<pre>";
    print_r($_POST);
    if(!check_if_exists($db, "users", "email", $_POST['email'] )) {
        echo 'email is not registered';
        die();
    }
    if(!check_password($db, $_POST['email'], $_POST['password'] )){
        echo 'incorrect password';
        die();
    }
    else {
        //Start the session and send the user to the user's page
        session_start();
        $uid = get_uid($db, $_POST['email']);
        $isAdmin = check_is_admin($db, $uid);
        $_SESSION['name'] = get_name_by_email($db, $_POST['email']);
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['uid'] = $uid;
        $_SESSION['is_logged'] = true;
        $_SESSION['is_admin'] = $isAdmin;
        if ($isAdmin) header('location: ./admin/index.php');
        else header('location: ./user/index.php');
    }
}
<?php
require_once("database.php");
require_once("./themes/header.php");
require_once("./themes/footer.php");
if ($_POST['action'] == 'signup') signup($db);
elseif ($_GET['a']== 'signout') signout();
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

    if(check_if_exists($db, "users", "email", $_POST['email'] )) {
        //if($result->rowCount()==0
        //$result->fetch()
        if(check_password($db, $_POST['email'], $_POST['password'] )){
            //Start the session and send the user to the user's page
            session_start();
            $uid = get_uid($db, $_POST['email']);
            if(checks_for_order($db, $uid)){$OID = get_oid($db,$uid);}
            else{$OID = create_oid($db, $uid);}
            $isAdmin = check_is_admin($db, $uid);
            $_SESSION['name'] = get_name_by_email($db, $_POST['email']);
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['uid'] = $uid;
            $_SESSION['oid'] = $OID;
            $_SESSION['is_logged'] = true;
            $_SESSION['is_admin'] = $isAdmin;
            //die(json_encode(['status'=>1,'message'=>'Welcome']));
            if ($isAdmin) header('location: ./admin/index.php');
            else header('location: ./user/index.php');
        }
        else header('location: signin.php?id=1');
    }
    else header('location: signin.php?id=1');
}

function signout(){
    session_start(); //to ensure you are using same session
    session_destroy(); //destroy the session
    header("location: ./index.php"); //to redirect back to "index.php" after logging out
}
<?php

if ($_SESSION["is_logged"] = true) {
    header("location: index.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Sign In</title>
    <style>
        .flex {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: center;
        }

        .box {
            padding: 100px 200px 50px 200px;
        }

        .textBox {
            background-color: lightgray;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="flex">
    <!--Create sign in form-->
    <div class="box">
        <div class="textBox">
            <h2>Sign In as Existing User</h2>
        </div>
        <form action="auth.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <br>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" value="signin">Submit</button>
        </form>
    </div>

    <!--Create sign up form-->
    <div class="box">
        <div class="textBox">
            <h2>Create A New User!</h2>
        </div>
        <form action="auth.php" method="POST" class="row g-3">
            <!--Name Field-->
            <div class="col-md-4">
                <label for="name" class="form-label">Full name</label>
                <input type="text" class="form-control is-valid" id="validationServer01" value="" required>
            </div>
            </br>
            <!--Email Field-->
            <div class="col-md-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            </br>
            <!--Phone number field-->
            <div class="col-md-4">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control is-valid" id="validationServer01" value="" required>
            </div>
            <br>
            <!--Password Field-->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" required>
            </div>
            </br>
            </br>
            <!--Address Information-->
            <h3>Address Information</h3>
            </br>
            <!--Street Field-->
            <div class="col-md-6">
                <label for="street" class="form-label">Street</label>
                <input type="text" class="form-control is-invalid" id="validationServer03"
                       aria-describedby="validationServer03Feedback" required>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Please provide a valid Street Name.
                </div>
            </div>
            </br>
            <!--City Field-->
            <div class="col-md-6">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control is-invalid" id="validationServer03"
                       aria-describedby="validationServer03Feedback" required>
                <div id="validationServer03Feedback" class="invalid-feedback">
                    Please provide a valid city.
                </div>
            </div>
            </br>
            <!--State Field-->
            <div class="col-md-3">
                <label for="state" class="form-label">State</label>
                <select class="form-select is-invalid" id="validationServer04"
                        aria-describedby="validationServer04Feedback" required>
                    <option selected disabled value="">select</option>
                    <option>Kentucky</option>
                    <option>Ohio</option>
                    <option>Indiana</option>
                </select>
                <div id="validationServer04Feedback" class="invalid-feedback">
                    Please select a valid state.
                </div>
            </div>
            </br>
            <!--Zip Code-->
            <div class="col-md-3">
                <label for="zip" class="form-label">Zip</label>
                <input type="text" class="form-control is-invalid" id="validationServer05"
                       aria-describedby="validationServer05Feedback" required>
                <div id="validationServer05Feedback" class="invalid-feedback">
                    Please provide a valid zip.
                </div>
            </div>
            </br>
            <div class="col-12">
                <button class="btn btn-primary" type="submit" value="signup">Submit form</button>
            </div>
        </form>
    </div>
</div>

</body>

</html>
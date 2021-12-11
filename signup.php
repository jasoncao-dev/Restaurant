<?php
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link href="http://fonts.cdnfonts.com/css/apercu" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="./css/styles.css">

    <!--Title & Icon -->
    <title>FooDash Signup</title>
    <link rel="icon" href="./images/icon.png" type="image/png">
</head>

<body class="d-flex flex-column h-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-1 navbar-light shadow-sm bg-white fixed-top">
        <div class="container justify-content-center">
            <a href="./index.php" class="navbar-brand">
            <!-- Logo Image -->
            <img src="./images/logo.png" width="45" alt="" class="d-inline-block align-middle mr-2">
            <!-- Logo Text -->
            <span class="fw-bolder text-color fs-4">FooDash</span>
            </a>
        </div>
    </nav>

    <main class="flex-shrink-0">

    </main>

    <div class="container">
        <section id="signup" class="container form-register p-5 justify-items-start border rounded bg-white" style="margin-top: 80px">
            <h3 class="form-title">Register your account</h3>
            <p class="lead pt-1 pb-3">Create your access credentials.</p>
        
            <div id="error-report" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
                <span id="error-log"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        
            <form id="register" class="account-create mt-3" action="auth.php" method="POST">
                <div class="row g-2">
                    <div class="col-sm-6 pe-2">
                        <h5 class="form-title">Personal Information</h5>
                        <!-- Full name -->
                        <div class="form-group mb-3">
                                <label for="name" class="form-label">Full name <span class="text-danger">&ast;</span></label>
                                <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="name">
                        </div>
                        <!-- Email address -->
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email address <span class="text-danger">&ast;</span></label>
                            <input type="email" class="form-control p-2-5 px-4 rounded-pill" name="email" required/>
                        </div>
                        <!-- Password -->
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password <span class="text-danger">&ast;</span></label>
                            <input type="password" class="form-control p-2-5 px-4 rounded-pill" name="password" required/>
                        </div>
                    </div>
                    <div class="col-sm-6 ps-2">
                        <h5 class="form-title">Address Information</h5>
                        <!-- Street -->
                        <div class="form-group mb-3">
                            <label for="street" class="form-label">Street Address <span class="text-danger">&ast;</span></label>
                            <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="street" required/>
                        </div>
                        <!-- City -->
                        <div class="form-group mb-3">
                            <label for="city" class="form-label">City <span class="text-danger">&ast;</span></label>
                            <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="city" required/>
                        </div>
                        <!-- State & Zipcode -->
                        <div class="form-group mb-3">
                            <div class="row g-2">
                                    <div class="col-sm-6">
                                    <label for="state" class="form-label">State <span class="text-danger">&ast;</span></label>
                                    <select class="form-select p-2-5 px-4 rounded-pill" required>
                                        <option selected disabled value="">Select a state</option>
                                        <option value="AL">Alabama</option>
                                        <option value="AK">Alaska</option>
                                        <option value="AZ">Arizona</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="CA">California</option>
                                        <option value="CO">Colorado</option>
                                        <option value="CT">Connecticut</option>
                                        <option value="DE">Delaware</option>
                                        <option value="DC">District Of Columbia</option>
                                        <option value="FL">Florida</option>
                                        <option value="GA">Georgia</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="ID">Idaho</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IN">Indiana</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="ME">Maine</option>
                                        <option value="MD">Maryland</option>
                                        <option value="MA">Massachusetts</option>
                                        <option value="MI">Michigan</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="MT">Montana</option>
                                        <option value="NE">Nebraska</option>
                                        <option value="NV">Nevada</option>
                                        <option value="NH">New Hampshire</option>
                                        <option value="NJ">New Jersey</option>
                                        <option value="NM">New Mexico</option>
                                        <option value="NY">New York</option>
                                        <option value="NC">North Carolina</option>
                                        <option value="ND">North Dakota</option>
                                        <option value="OH">Ohio</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="OR">Oregon</option>
                                        <option value="PA">Pennsylvania</option>
                                        <option value="RI">Rhode Island</option>
                                        <option value="SC">South Carolina</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="TX">Texas</option>
                                        <option value="UT">Utah</option>
                                        <option value="VT">Vermont</option>
                                        <option value="VA">Virginia</option>
                                        <option value="WA">Washington</option>
                                        <option value="WV">West Virginia</option>
                                        <option value="WI">Wisconsin</option>
                                        <option value="WY">Wyoming</option>
                                    </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="zip" class="form-label">Zipcode <span class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="zip">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-group mb-3 text-center">
                    <label class="form-label">
                        <input type="checkbox" name="agree-term" class="form-check-input" required/>
                        I agree will all
                        <a href="" class="term-service text-main">Terms of Service</a>
                        and <a href="" class="term-service text-main">Privacy Policies</a>.<span class="text-danger">&ast;</span>
                    </label>
                    
                </div>
                <div class="d-grid gap-2 col-4 mx-auto mb-3">
                    <button type="submit" class="btn btn-color text-light p-2-5 rounded-pill" name="action" value="signup">Sign up</button>
                </div>
            </form>
            <div class="text-center">
                <p>Already registered? <a id="redirect" href="./signin.php"><button class="btn btn-link btn-access-account p-0">Access your account</button></a>
            </div>
        </section>

        <!-- Footer -->
        <footer class="footer py-3 bg-light navbar-fixed-bottom border-top shadow-sm bg-white">
            <div class="container">
                <div class="d-flex align-items-center justify-content-center">
                    <a href="/" class="me-2 mb-0 align-items-center text-muted text-decoration-none lh-1">
                            <img src="./images/logo.png" width="45" alt="" class="d-inline-block align-middle mr-2">
                            <span class="fw-bolder text-color">FooDash</span>
                    </a>
                    <span class="text-muted">© 2021 Company, Inc</span>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <script>
        window.$ = window.jQuery = require('jquery')
    </script>

    <script>
        if (typeof module === 'object') {
            window.module = module;
            module = undefined;
        }
    </script>
</body>

</html>
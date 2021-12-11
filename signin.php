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
    <link rel="stylesheet" type="text/css" href="/css/styles.css">

    <!-- Title & Icon -->
    <title>FooDash Login</title>
    <link rel="icon" href="./images/icon.png" type="image/png">

    <style>
        @import url('http://fonts.cdnfonts.com/css/apercu');

        body {
            font-family: 'Apercu', sans-serif;
            background-color: #f8f9fa;
        }

        .text-color {
            color: #ed151e;
        }

        .btn-color {
            background-color: #ed151e;
            border-color: #ed151e;
        }

        .btn-color:hover {
            background-color: #cf131b;
            border-color: #cf131b;
        }
        
        .p-2-5 {
            padding: 0.70rem;
        }

        .form-account-access {
            max-width: 28rem;
        }

        .form-account-access .icon {
            width: 13%;
            padding-right: 5px;
        }

        .break-line {
            height: 1px;
            width: 40%;
            background-color: #E0E0E0;
            margin-top: 10px
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-1 navbar-light shadow-sm bg-white fixed-top">
        <div class="container justify-content-center">
            <a href="./index.php" class="navbar-brand">
            <img src="./images/logo.png" width="45" alt="" class="d-inline-block align-middle mr-2">
            <span class="fw-bolder text-color fs-4">FooDash</span>
            </a>
        </div>
    </nav>

    <!-- Main page -->
    
    <main class="flex-shrink-0">
        <div class="container">
            <section id="signin" class="container form-account-access justify-items-start p-5 bg-white shadow-sm" style="margin-top: 80px;">
                <h3>Access your account</h3>
                <p class="lead pt-1">Enter your credentials below</p>

                <div id="error-report" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
                    <span id="error-log"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <form id="login" class="account-create mt-3" action="auth.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email address <span class="text-danger">&ast;</span></label>
                        <input type="email" class="form-control p-2-5 px-4 rounded-pill" name="email"
                            required />
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Password <span class="text-danger">&ast;</span></label>
                        <input type="password" class="form-control p-2-5 px-4 rounded-pill" name="password"
                            required />
                    </div>
                    <div class="d-grid gap-2 col-7 mx-auto mb-3 mt-4">
                        <button type="submit" class="btn btn-primary btn-color p-2-5 rounded-pill" name="action" value="signin">Sign
                            in</button>
                    </div>
                </form>
                <div class="text-center">
                    <p>Don't have an account?<br><a id="redirect" href="./signup.php"><button
                                class="btn btn-link btn-create-account p-0">Register your account</button></p></a>
                </div>
            </section>
            <section id="signup" class="container form-account-access my-5 justify-items-start d-none">
                <h2 class="form-title">Register your account</h2>
                <p class="lead pt-1 pb-3">Create your access credentials.</p>
            
                <div id="error-report" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
                    <span id="error-log"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            
                <form id="register" class="account-create mt-3">
                    <div class="form-group mb-3">
                        <label for="firstname" class="form-label">Full name <span class="text-danger">&ast;</span></label>
                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email address <span class="text-danger">&ast;</span></label>
                        <input type="email" class="form-control p-2-5 px-4 rounded-pill" name="email" placeholder="Enter your email address" required/>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Password <span class="text-danger">&ast;</span></label>
                        <input type="password" class="form-control p-2-5 px-4 rounded-pill" name="password" placeholder="Enter your password" required/>
                        <div class="form-text">Password should be at least 8 characters.</div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">
                            <input type="checkbox" name="agree-term" class="form-check-input" required/>
                            I agree will all
                            <a href="" class="term-service text-main">Terms of Service</a>
                            and <a href="" class="term-service text-main">Privacy Policies</a>.<span class="text-danger">&ast;</span>
                        </label>
                        
                    </div>
                    <div class="d-grid gap-2 col-7 mx-auto mb-3">
                        <button type="submit" class="btn btn-primary p-2-5 rounded-pill" name="action" value="signup">Sign up</button>
                    </div>
                </form>
                <div class="text-center">
                    <p>Already registered? <a id="redirect" href="./signup.php"><button class="btn btn-link btn-access-account p-0">Access your account</button></a>
                </div>
            </section>
        </div>
    </main>

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
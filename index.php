<?php
include_once "database.php";
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
    <title>FooDash - Food Delivery</title>
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

        .btn-outline-color {
            border: 2px solid #ed151e;
            color: #ed151e;
        }

        .btn-outline-color:hover {
            background-color: #cf131b;
            border-color: #cf131b;
            color: white;
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

        header.masthead {
            padding-top: 15.5rem;
            padding-bottom: 8rem;
            text-align: center;
            color: #fff;
            background-image: url("./images/bg.jpeg");
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-position: center center;
            background-size: cover;
        }

        .search-form .form {
            position: relative
        }

        .search-form .form .fa-search {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #9ca3af
        }

        .search-form .form span {
            position: absolute;
            right: 17px;
            top: 13px;
            padding: 2px;
            border-left: 1px solid #d1d5db
        }

        .search-form .left-pan {
            padding-left: 7px
        }

        .search-form .left-pan i {
            padding-left: 10px
        }

        .search-form .form-input {
            height: 55px;
            text-indent: 33px;
            border-radius: 75px
        }

        .search-form .form-input:focus {
            box-shadow: none;
            border: none
        }

        .card-img-top {
            width: 100%;
            height: 15vw;
            object-fit: cover;
        }

        
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-1 navbar-light shadow-sm bg-white fixed-top">
        <div class="container justify-content-space-between">
            <a href="./index.php" class="navbar-brand">
            <!-- Logo Image -->
            <img src="./images/logo.png" width="45" alt="" class="d-inline-block align-middle mr-2">
            <!-- Logo Text -->
            <span class="fw-bolder text-color fs-4">FooDash</span>
            </a>
            <div>
                <a href="./signup.php"><button class="btn btn-color rounded-pill px-3 p-2 text-light me-1">Sign Up</button></a>
                <a href="./signin.php"><button class="btn btn-outline-color rounded-pill px-3 p-2">Sign In</button></a>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
            <div class="d-flex flex-column container justify-content-center">
                <div class="text-color lead pb-2">Welcome To FooDash!</div>
                <div class="text-color h1 fw-bolder pb-4">Restaurants and more,<br>delivered to your door</div>
                <div class="container search-form">
                    <div class="row height d-flex justify-content-center align-items-center">
                        <div class="col-md-5">
                            <div class="form rounded-pill"> <i class="fa fa-search"></i> <input type="text" class="form-control form-input" placeholder="Search anything..."> <span class="left-pan"><i class="fas fa-arrow-right text-color fw-bolder fs-4"></i></span> </div>
                        </div>
                    </div>
                </div>
            </div>
    </header>

    <!-- Main page -->
    
    <main class="flex-shrink-0">
        <div class="container">
            <section class="p-5">
                <h3 class="pb-2">Local Restaurants</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                        display_restaurant_list($db);
                    ?>
                    <div class="col">
                        <div class="card h-100">
                        <img src="http://s3-media2.fl.yelpcdn.com/bphoto/MmgtASP3l_t4tPCL1iAsCg/o.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Redtree Coffee Shop</h5>
                            <p class="card-text text-muted">3210 Madison Rd, Cincinnati, OH 45209</p>
                            <button class="btn btn-sm btn-color rounded-pill text-light">Coffee</button>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                        <img src="https://s3-media3.fl.yelpcdn.com/bphoto/mF6opgJT5qO28dMp_A7Fnw/o.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Nada</h5>
                            <p class="card-text text-muted">525 Race St, Cincinnati, OH 45202</p>
                            <button class="btn btn-sm btn-color rounded-pill text-light">Mexican</button>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                        <img src="https://s3-media1.fl.yelpcdn.com/bphoto/B7YKqxZJLK6gXRidNFMn5A/o.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Maplewood Kitchen and Bar</h5>
                            <p class="card-text text-muted">525 Race St, Cincinnati, OH 45202</p>
                            <button class="btn btn-sm btn-color rounded-pill text-light">Breakfast & Brunch</button>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                        <img src="https://s3-media3.fl.yelpcdn.com/bphoto/mF6opgJT5qO28dMp_A7Fnw/o.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a short card.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                        <img src="https://s3-media1.fl.yelpcdn.com/bphoto/B7YKqxZJLK6gXRidNFMn5A/o.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                        <img src="https://theme-assets.getbento.com/sensei/fd4d458.sensei/assets/images/catering-item-placeholder-704x520.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
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
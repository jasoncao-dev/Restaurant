<?php
include_once "database.php";
session_start();
if (count($_SESSION) != 0) {
    if ($_SESSION['is_admin']) {
        $path = 'location: ./admin/index.php';
        header($path);
    }
    else if ($_SESSION['is_logged']) {
        $path = 'location: ./user/index.php';
        header($path);
    }
}
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

    <!-- Title & Icon -->
    <title>FooDash - Food Delivery</title>
    <link rel="icon" href="./images/icon.png" type="image/png">

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
                <a href="./signup.php"><button class="btn btn-color rounded-pill px-3 p-2 text-light me-1">Sign
                        Up</button></a>
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
                        <div class="form rounded-pill"> <i class="fa fa-search"></i> <input type="text"
                                class="form-control form-input" placeholder="Search anything..."> <span
                                class="left-pan"><i class="fas fa-arrow-right text-color fw-bolder fs-4"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page -->

    <main class="flex-shrink-0 mb-5">
        <div class="container">
            <section class="p-5">
                <h3 class="pb-2">Local Restaurants</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php
                        display_restaurant_list($db);
                    ?>
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
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>
<?php print_r($_SESSION)?>

</html>
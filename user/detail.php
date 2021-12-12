<?php
    require_once ("../settings.php");
    require_once(__ROOT__.'/database.php');
    session_start();
    $id = $_GET['id'];
    if (count($_SESSION) == 0) {
        $path = 'location: ../index.php';
        header($path);
    }
    $user_name = $_SESSION['name'];
    $restaurant = display_restaurant_detail($db, $id);
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
    <link rel="stylesheet" type="text/css" href="../css/styles.css">

    <!-- Title & Icon -->
    <title>FooDash - Food Delivery</title>
    <link rel="icon" href="../images/icon.png" type="image/png">

</head>

<body class="d-flex flex-column h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg py-1 navbar-light shadow-sm bg-white fixed-top">
        <div class="container justify-content-space-between">
            <a href="./index.php" class="navbar-brand">
            <!-- Logo Image -->
            <img src="../images/logo.png" width="45" alt="" class="d-inline-block align-middle mr-2">
            <!-- Logo Text -->
            <span class="fw-bolder text-color fs-4">FooDash</span>
            </a>
            <div>
                <a href=""><svg class="me-1 img-thumbnail rounded-circle" style="max-width: 3rem; height: 3rem;" viewBox="-1.5 -1.5 8 8" xmlns="http://www.w3.org/2000/svg" fill="#ed151e"><rect x="0" y="0" width="1" height="1"></rect><rect x="0" y="3" width="1" height="1"></rect><rect x="0" y="4" width="1" height="1"></rect><rect x="1" y="0" width="1" height="1"></rect><rect x="1" y="1" width="1" height="1"></rect><rect x="1" y="2" width="1" height="1"></rect><rect x="1" y="3" width="1" height="1"></rect><rect x="2" y="0" width="1" height="1"></rect><rect x="2" y="1" width="1" height="1"></rect><rect x="2" y="2" width="1" height="1"></rect><rect x="2" y="3" width="1" height="1"></rect><rect x="2" y="4" width="1" height="1"></rect><rect x="4" y="0" width="1" height="1"></rect><rect x="4" y="3" width="1" height="1"></rect><rect x="4" y="4" width="1" height="1"></rect><rect x="3" y="0" width="1" height="1"></rect><rect x="3" y="1" width="1" height="1"></rect><rect x="3" y="2" width="1" height="1"></rect><rect x="3" y="3" width="1" height="1"></rect></svg></a>
                <span style="font-size: 0.9rem;"><?=$user_name?></span>
                <button class="btn btn-outline-color btn-lg rounded-circle ms-1" style="border: 0px; padding-left: 12px; padding-right: 12px;"><i class="fas fa-shopping-cart"></i></button>
                <span style="font-size: 0.9rem;">Cart</span>
            </div>
        </div>
    </nav>

    <!-- Cover-->
    <header class="cover" style="background-image: url('<?=$restaurant['image']?>')">
    </header>

    <!-- Main page -->
    <main class="flex-shrink-0 mb-5">
        <div class="container">
            <section>
                <div class="clearfix">
                    <img src="<?=$restaurant['image']?>" class="img-thumbnail rounded-circle res-thumbnail float-start me-2">
                    <h3 class="pt-2"><?=$restaurant['name']?></h3>
                    <p class="card-text text-muted"><?=$restaurant['street']?>, <?=$restaurant['city']?>, <?=$restaurant['state']?><?=$restaurant['zip']?></p>
                </div>
            </section>
            <section class="">
                <h3 class="pb-2">Menu</h3>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php display_menu($db, $id);?>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer py-3 bg-light navbar-fixed-bottom border-top shadow-sm bg-white">
        <div class="container">
            <div class="d-flex align-items-center justify-content-center">
                <a href="/" class="me-2 mb-0 align-items-center text-muted text-decoration-none lh-1">
                        <img src="../images/logo.png" width="45" alt="" class="d-inline-block align-middle mr-2">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $('#add').on('click', function(event) {
            alert('Add to order')
            console.log(event.target.value)
        })
    </script>
</body>
</html>



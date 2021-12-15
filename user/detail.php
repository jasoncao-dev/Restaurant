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
    $cart = display_cart($db);
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
                <a href="./account.php?id=<?=$_SESSION['uid']?>"><svg class="me-1 img-thumbnail rounded-circle" style="max-width: 3rem; height: 3rem;" viewBox="-1.5 -1.5 8 8" xmlns="http://www.w3.org/2000/svg" fill="#ed151e"><rect x="0" y="0" width="1" height="1"></rect><rect x="0" y="3" width="1" height="1"></rect><rect x="0" y="4" width="1" height="1"></rect><rect x="1" y="0" width="1" height="1"></rect><rect x="1" y="1" width="1" height="1"></rect><rect x="1" y="2" width="1" height="1"></rect><rect x="1" y="3" width="1" height="1"></rect><rect x="2" y="0" width="1" height="1"></rect><rect x="2" y="1" width="1" height="1"></rect><rect x="2" y="2" width="1" height="1"></rect><rect x="2" y="3" width="1" height="1"></rect><rect x="2" y="4" width="1" height="1"></rect><rect x="4" y="0" width="1" height="1"></rect><rect x="4" y="3" width="1" height="1"></rect><rect x="4" y="4" width="1" height="1"></rect><rect x="3" y="0" width="1" height="1"></rect><rect x="3" y="1" width="1" height="1"></rect><rect x="3" y="2" width="1" height="1"></rect><rect x="3" y="3" width="1" height="1"></rect></svg></a>
                <span style="font-size: 0.9rem;"><?=$user_name?></span>
                <a href="./cart.php" class="text-decoration-none"><button class="btn btn-outline-color btn-lg rounded-circle position-relative ms-1" style="border: 0px; padding-left: 12px; padding-right: 12px;"><i class="fas fa-shopping-cart"></i>
                    <?php
                        if ($cart != null) {?>
                            <span class="position-absolute top-10 start-90 translate-middle p-1 bg-danger border border-light rounded-circle" style="color: #ed151e;">
                        <?php
                    }?>
                </button>
                <span style="font-size: 0.9rem;" class="text-dark">Cart</span></a>
                <a href="../auth.php?a=signout"><button type="submit" class="btn btn-color text-light p-2-5 rounded-pill ms-2" name="action" value="signout">Sign out</button></a>
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
                    <img src="<?=$restaurant['image']?>"
                        class="img-thumbnail rounded-circle res-thumbnail float-start me-2">
                    <h3 class="pt-2"><?=$restaurant['name']?></h3>
                    <p class="card-text text-muted"><?=$restaurant['street']?>, <?=$restaurant['city']?>,
                        <?=$restaurant['state']?> <?=$restaurant['zip']?></p>
                </div>
            </section>
            <section class="row mb-5">
                <div class="col-md-9">
                    <h3 class="pb-2">Menu</h3>
                    <div class="row row-cols-1 row-cols-md-2 g-4">
                        <?php display_menu($db, $id);?>
                    </div>
                </div>
                <div class="col-md-3 ps-3">
                    <h3 class="pb-2">Your cart</h3>
                    <?php
                        if ($cart == null) {
                            ?><span id="cart-text" class="text-muted fst-italic">There is nothing in your cart.</span><?php
                        } else {
                            foreach($cart as $item) { ?>
                                <div id="<?=$item['RID']?>" class="card mb-2">
                                    <div class="row g-1">
                                        <div class="col-md-4">
                                            <img src="<?=$item['image']?>" class="img-fluid rounded-start menu-thumbnail" style="width: 8rem; height: 8rem;">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?=$item['name']?></h5>
                                                <button class="btn btn-sm btn-color rounded-pill text-light"><?=$item['price']?></button>
                                                <p class="card-text text-muted pt-1">x <?=$item['amount']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    ?>
                    <a href="./cart.php"><button id="checkout" class="btn btn-color text-light rounded-pill mx-auto mt-3">Check out</button></a>
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
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $('.add-to-order').on('click', function(event) {
        $('#cart-text').addClass('d-none')
        $(`#${event.target.value}`).removeClass('d-none');
        $(`#${event.target.value}`).addClass('in-cart');
    })

    $('#checkout').on('click', function(event) {

    })
    </script>
</body>

</html>
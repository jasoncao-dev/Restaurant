<?php
require_once ("../settings.php");
require_once(__ROOT__."/database.php");
session_start();

if (count($_SESSION) == 0 or $_SESSION['is_admin'] == 0) {
    $path = 'location: ../index.php';
    header($path);
}
if(count($_POST) > 0){
    $menu["name"] = $_POST["name"];
    $menu["description"] = $_POST["description"];
    $menu["price"] = $_POST["price"];
    $menu["image"] = $_POST["image"];
    $menu['mid'] = $_GET['mid'];
    update_menu_item($db, $menu);
    header('location: ./detail.php?id='.$_POST['id']);
}
$menu = get_menu_item($db, $_GET['mid']);
//print_r($_GET);
//print_r($menu)

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
        <div class="container justify-content-center">
            <a href="./index.php" class="navbar-brand">
            <img src="../images/logo.png" width="45" alt="" class="d-inline-block align-middle mr-2">
            <span class="fw-bolder text-color fs-4">FooDash</span>
            </a>
        </div>
    </nav>
<?php //print_r($menu)?>
    <!-- Main page -->
    <main class="flex-shrink-0 mb-5">
    <div class="container">
        <section id="update_menu" class="container form-register p-5 justify-items-start border rounded bg-white" style="margin-top: 80px">
            <h3 class="form-title">Update Menu Item</h3>

            <div id="error-report" class="alert alert-warning alert-dismissible fade show d-none" role="alert">
                <span id="error-log"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <form id="update_menu" class="account-create mt-3" action="modify.php?mid=<?=$_GET['mid']?>" method="POST">
                <div class="row g-2">
                    <div class="col-sm-12 pe-2">
                        <h5 class="form-title">Menu Information</h5>
                        <input type="hidden" value="<?=$_GET['id']?>" name="id"/>
                        <!-- Menu name -->
                        <div class="form-group mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">&ast;</span></label>
                                <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="name" required value="<?=$menu['name']?>">
                        </div>
                        <!-- Description -->
                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description <span class="text-danger">&ast;</span></label>
                            <textarea type="text" class="form-control p-2-5 px-4 rounded-pill" name="description" required value="<?=$menu['description']?>"></textarea>
                        </div>
                        <!-- Price -->
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">&ast;</span></label>
                            <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="price" required value="<?=$menu['price']?>"/>
                        </div>
                        <!-- Image -->
                        <div class="form-group mb-3">
                            <label for="img" class="form-label">Image (post a link for image)</label>
                            <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="image" value="<?=$menu['image']?>" required/>
                        </div>
                    </div>
                </div>
                <br>
                <div class="d-grid gap-2 col-4 mx-auto mb-3">
                    <button type="submit" class="btn btn-color text-light p-2-5 rounded-pill" name="action" value="update_menu">Update</button>
                </div>
            </form>
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
</script>
</body>
</html>
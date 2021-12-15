<?php
    require_once ("../settings.php");
    require_once(__ROOT__.'/database.php');
    session_start();
    //echo '<pre>';
    //print_r($_SESSION);
    if (count($_SESSION) == 0) {
        $path = 'location: ../index.php';
        header($path);
    }
    if ($_SESSION['is_logged'] == true) { //Prevent regular user to enter admin page
        if ($_SESSION['is_admin'] == false) {
            $path = 'location: ../user/index.php';
            header($path);
        }
    }
    $user_name = $_SESSION['name'];
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
                <a href="./account.php?id=<?=$_SESSION['uid']?>"><svg class="me-1 img-thumbnail rounded-circle"
                        style="max-width: 3rem; height: 3rem;" viewBox="-1.5 -1.5 8 8"
                        xmlns="http://www.w3.org/2000/svg" fill="#ed151e">
                        <rect x="0" y="0" width="1" height="1"></rect>
                        <rect x="0" y="3" width="1" height="1"></rect>
                        <rect x="0" y="4" width="1" height="1"></rect>
                        <rect x="1" y="0" width="1" height="1"></rect>
                        <rect x="1" y="1" width="1" height="1"></rect>
                        <rect x="1" y="2" width="1" height="1"></rect>
                        <rect x="1" y="3" width="1" height="1"></rect>
                        <rect x="2" y="0" width="1" height="1"></rect>
                        <rect x="2" y="1" width="1" height="1"></rect>
                        <rect x="2" y="2" width="1" height="1"></rect>
                        <rect x="2" y="3" width="1" height="1"></rect>
                        <rect x="2" y="4" width="1" height="1"></rect>
                        <rect x="4" y="0" width="1" height="1"></rect>
                        <rect x="4" y="3" width="1" height="1"></rect>
                        <rect x="4" y="4" width="1" height="1"></rect>
                        <rect x="3" y="0" width="1" height="1"></rect>
                        <rect x="3" y="1" width="1" height="1"></rect>
                        <rect x="3" y="2" width="1" height="1"></rect>
                        <rect x="3" y="3" width="1" height="1"></rect>
                    </svg></a>
                <span style="font-size: 0.9rem;"><?=$user_name?></span>
                <a href="../auth.php?a=signout"><button type="submit" class="btn btn-color text-light p-2-5 rounded-pill ms-2" name="action" value="signout">Sign out</button></a>
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
            <section class="p-5 pb-0">
                <!-- Modal add-res -->
                <div class="modal fade" id="add-res" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add a new restaurant</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="add-restaurant" class="account-create mt-3" action="add_restaurant.php"
                                method="POST">
                                <div class="modal-body">
                                    <!-- Name -->
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="name">
                                    </div>
                                    <!-- Image -->
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image (post a link for image or leave blank)</label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="image" />
                                    </div>
                                    <!-- Category -->
                                    <div class="form-group mb-3">
                                        <label for="category" class="form-label">Category <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="category">
                                    </div>
                                    <!-- Phone number -->
                                    <div class="form-group mb-3">
                                        <label for="phone" class="form-label">Phone number <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="phone"
                                            required />
                                    </div>
                                    <!-- Street -->
                                    <div class="form-group mb-3">
                                        <label for="street" class="form-label">Street Address <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="street"
                                            required />
                                    </div>
                                    <!-- City -->
                                    <div class="form-group mb-3">
                                        <label for="city" class="form-label">City <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="city"
                                            required />
                                    </div>
                                    <!-- State & Zipcode -->
                                    <div class="form-group mb-3">
                                        <div class="row g-2">
                                            <div class="col-sm-6">
                                                <label for="state" class="form-label">State <span
                                                        class="text-danger">&ast;</span></label>
                                                <select class="form-select p-2-5 px-4 rounded-pill" name="state"
                                                    required>
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
                                                <label for="zip" class="form-label">Zipcode <span
                                                        class="text-danger">&ast;</span></label>
                                                <input type="text" class="form-control p-2-5 px-4 rounded-pill"
                                                    name="zip">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <section class="p-5">
                <h3 class="pb-2">Local Restaurants</h3>
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div type="button" data-bs-toggle="modal" data-bs-target="#add-res">
                            <div class="card h-100">
                                <img src="https://i1.wp.com/servedcatering.com/wp-content/uploads/2021/05/menu-item-placeholder.png?fit=607%2C400&ssl=1" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title text-dark placeholder-glow">
                                        Add new restaurant
                                    </h5>
                                    <p class="card-text text-muted pt-1 placeholder-glow">
                                        <span class="placeholder col-7"></span>
                                        <span class="placeholder col-4"></span>
                                        <span class="placeholder col-4"></span>
                                        <span class="placeholder col-6"></span>
                                    </p>
                                </div>
                            </div>
</div>
                    </div>
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
</body>

</html>
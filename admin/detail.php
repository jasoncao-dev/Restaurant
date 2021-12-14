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
                <a href=""><svg class="me-1 img-thumbnail rounded-circle" style="max-width: 3rem; height: 3rem;"
                        viewBox="-1.5 -1.5 8 8" xmlns="http://www.w3.org/2000/svg" fill="#ed151e">
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
                <button id="cart" class="btn btn-outline-color btn-lg rounded-circle ms-1"
                    style="border: 0px; padding-left: 12px; padding-right: 12px;"><i
                        class="fas fa-shopping-cart"></i></button>
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
                <div class="clearfix" style="margin-bottom: -3rem;">
                    <img src="<?=$restaurant['image']?>"
                        class="img-thumbnail rounded-circle res-thumbnail float-start me-2">
                    <h3 class="pt-2"><?=$restaurant['name']?></h3>
                    <p class="card-text text-muted"><?=$restaurant['street']?>, <?=$restaurant['city']?>,
                        <?=$restaurant['state']?> <?=$restaurant['zip']?></p>
                </div>
            </section>
            <section style="margin-bottom: 2rem;">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add-menu">
                    Add new menu item
                </button>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#update-res">
                    Update
                </button>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                    data-bs-target="#delete-res">
                    Delete
                </button>

                <!-- Modal create new menu item -->
                <div class="modal fade" id="add-menu" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new menu item</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="register" class="account-create mt-3" action="add_menu.php" method="POST">
                                <div class="modal-body">
                                    <input value="<?=$id?>" type="hidden" name="rid">
                                    <!-- Name -->
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="name">
                                    </div>
                                    <!-- Image -->
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image (post a link for image or leave
                                            blank)</label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="image" />
                                    </div>
                                    <!-- Description -->
                                    <div class="form-group mb-3">
                                        <label for="description" class="form-label">Description <span
                                                class="text-danger">&ast;</span></label>
                                        <textarea type="description" class="form-control p-2-5 px-4 rounded-pill"
                                            name="description" required></textarea>
                                    </div>
                                    <!-- Price -->
                                    <div class="form-group mb-3">
                                        <label for="price" class="form-label">Price <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="price">
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

                <!-- Modal update restaurant -->
                <div class="modal fade" id="update-res" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Update restaurant's information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="update-restaurant" class="account-create mt-3" action="update_restaurant.php"
                                method="POST">
                                <div class="modal-body">
                                    <input type="hidden" name="AID" value="<?=$restaurant['AID']?>" />
                                    <input type="hidden" name="RID" value="<?=$id?>" />
                                    <!-- Name -->
                                    <div class="form-group mb-3">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="name"
                                            value="<?=$restaurant['name']?>" required>
                                    </div>
                                    <!-- Image -->
                                    <div class="form-group mb-3">
                                        <label for="image" class="form-label">Image (post a link for image or leave
                                            blank)</label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="image"
                                            value="<?=$restaurant['image']?>" />
                                    </div>
                                    <!-- Category -->
                                    <div class="form-group mb-3">
                                        <label for="category" class="form-label">Category <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="category"
                                            value="<?=$restaurant['category']?>" required>
                                    </div>
                                    <!-- Phone number -->
                                    <div class="form-group mb-3">
                                        <label for="phone" class="form-label">Phone number <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="phone"
                                            value="<?=$restaurant['phone']?>" required />
                                    </div>
                                    <!-- Street -->
                                    <div class="form-group mb-3">
                                        <label for="street" class="form-label">Street Address <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="street"
                                            value="<?=$restaurant['street']?>" required />
                                    </div>
                                    <!-- City -->
                                    <div class="form-group mb-3">
                                        <label for="city" class="form-label">City <span
                                                class="text-danger">&ast;</span></label>
                                        <input type="text" class="form-control p-2-5 px-4 rounded-pill" name="city"
                                            value="<?=$restaurant['city']?>" required />
                                    </div>
                                    <!-- State & Zipcode -->
                                    <div class="form-group mb-3">
                                        <div class="row g-2">
                                            <div class="col-sm-6">
                                                <label for="state" class="form-label">State <span
                                                        class="text-danger">&ast;</span></label>
                                                <select class="form-select p-2-5 px-4 rounded-pill" name="state"
                                                    required>
                                                    <option selected disabled value=""><?=$restaurant['state']?>
                                                    </option>
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
                                                    name="zip" value="<?=$restaurant['zip']?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Model delete restaurant -->
                <!-- Modal -->
                <div class="modal fade" id="delete-res" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete this restaurant</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="update-restaurant" class="account-create mt-3" action="delete_restaurant.php"
                                method="POST">
                                <input type="hidden" name="AID" value="<?=$restaurant['AID']?>" />
                                <input type="hidden" name="RID" value="<?=$id?>" />
                                <div class="modal-body">
                                    Are you sure that you want to delete this restaurant?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
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
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
<!-- Header -->
    <?php
        require_once('./themes/header.php');
    ?>

    <!-- Main page -->
    
    <main class="flex-shrink-0">
        <div class="container">
            <section id="signin" class="container form-account-access justify-items-start p-5 bg-white shadow-sm" style="margin-top: 80px;">
                <h3>Access your account</h3>
                <p class="lead pt-1">Enter your credentials below</p>

                <?php
                    if(count($_GET) > 0) {
                        if ($_GET['id'] == 1) {
                            echo '<div id="message" class="alert alert-warning">Incorrect email or password.</div>';
                        } else echo '<div id="message" class="alert alert-warning">This email is already registered. Please sign in.</div>';
                    }       
                ?>
                

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
</body>

</html>
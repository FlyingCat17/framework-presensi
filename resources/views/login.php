<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E Presensi | Login</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url ?>/assets/img/logo/new_logo/logo-login.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="<?= base_url ?>/assets/css/app.min.css" rel="stylesheet">

</head>

<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('<?= base_url ?>/assets/images/bg-login.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto ">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <img class="img-fluid" alt="" src="<?= base_url ?>/assets/img/logo/new_logo/logo.png" width="190">
                                    </div>
                                    <h2 class="font-weight-bold text-center mb-2">LOGIN PAGE</h2>
                                    <form action="" method="POST">
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="userName">Username:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-user"></i>
                                                <input type="text" class="form-control" id="userName" name="username" placeholder="Username">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center">
                                                <button class="btn btn-success w-100">Login</button>
                                            </div>
                                        </div>
                                    </form>
                                    <?php Flasher::flash(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class="text-white">© 2022 NekoID</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Legal</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href="">Privacy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="<?= base_url ?>/assets/js/vendors.min.js"></script>

    <!-- notif -->
    <script src="<?= base_url ?>/assets/js/jquery.min.js"></script>
    <script src="<?= base_url ?>/assets/js/bootstrap.bundle.min.js"></script>
    <!-- page js -->

    <!-- Core JS -->
    <script src="<?= base_url ?>/assets/js/app.min.js"></script>

</body>

</html>